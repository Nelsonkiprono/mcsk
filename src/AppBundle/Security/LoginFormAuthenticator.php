<?php
/*********************************************************************************
 * Karbon Framework is a PHP5 Framework developed by Maxx Ng'ang'a
 * (C) 2016 Crysoft Dynamics Ltd
 * Karbon V 1.0
 * Maxx
 * 4/18/2017
 ********************************************************************************/

namespace AppBundle\Security;


use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private $formFactory;
    private $em;
    private $router;
    private $passwordEncoder;
    private $redirectFailureUrl;
    private $redirectSuccessUrl;

    /**
     * LoginFormAuthenticator constructor.
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router, UserPasswordEncoder $passwordEncoder, String $redirectFailureUrl = null, String $redirectSuccessUrl = null)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->redirectFailureUrl = $redirectFailureUrl;
        $this->redirectSuccessUrl = $redirectSuccessUrl;
    }

    public function getCredentials(Request $request)
    {
        $isLoginSubmit = ($request->getPathInfo() == '/login/' || $request->getPathInfo() == '/profile/login' || $request->getPathInfo() == '/login/admin' || $request->getPathInfo() == '/login/profile') && $request->isMethod('POST');

        if(!$isLoginSubmit){
            return;
        }

        $this->redirectFailureUrl = $request->request->get('_failure_path');
        $this->redirectSuccessUrl = $request->request->get('_target_path');

        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);
        $data = $form->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_username']
        );

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
       $username = $credentials['_username'];

        $user = $this->em->getRepository('AppBundle:User')
            ->findOneBy([
                'email'=> $username,
                'isActive'=>true
            ]);

        if (!$user){
            throw new CustomUserMessageAuthenticationException('Wrong email.');
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
        $username = $credentials['_username'];

        if($this->passwordEncoder->isPasswordValid($user,$password)){
            $actual_user = $this->em->getRepository('AppBundle:User')
                ->findOneBy([
                    'email'=> $username,
                    'isActive'=>true
                ]);

            if (in_array('ROLE_COMMITTEE', $actual_user->getRoles(), true)) {
                $datenow = new \DateTime("now");
                if($datenow > $actual_user->getAccountExpiresAt()){
                    //time has passed
		   throw new CustomUserMessageAuthenticationException('Account expired! Contact Admin to renew!');
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }


        }

        throw new CustomUserMessageAuthenticationException('Wrong password.');
        return false;
    }

    protected function getLoginUrl()
    {
        if ($this->redirectFailureUrl==""){
            $this->redirectFailureUrl="profile-login";
        }
        return $this->router->generate($this->redirectFailureUrl);
    }

    protected function getDefaultSuccessRedirectUrl(){

        return $this->router->generate($this->redirectSuccessUrl);
    }

}
