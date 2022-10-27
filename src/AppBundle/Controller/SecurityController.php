<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\AdministratorRegistrationForm;
use AppBundle\Form\LoginForm;
use AppBundle\Form\NewAdministratorForm;
use AppBundle\Form\ResetPasswordForm;
use AppBundle\Form\PasswordResetForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    /**
     * @Route("/account/{code}/activate",name="user-activate-account")
     */
    public function userFirstLoginAction(Request $request,$code){
        $em = $this->getDoctrine()->getManager();

        $idNumber = base64_decode($code);

        $profile = $em->getRepository("AppBundle:Profile")
            ->findOneBy([
                'idNumber'=>$code
            ]);
        $user = $profile->getWhoseProfile();
        //$user->setRoles('["R"]')
        $form = $this->createForm(ResetPasswordForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            $user->setIsPasswordCreated(true);
            $em->persist($user);
            $em->flush();

            return $this->render('user/accountUpdated.htm.twig');
        }

        if ($user->getIsPasswordCreated()){
            $activated = true;
        }else{
            $activated = false;
        }

        return $this->render('user/activate.htm.twig',[
            'user'=>$user,
            'activationForm'=>$form->createView(),
            'isActivated'=>$activated
        ]);
    }
    /**
     * @Route("/account/admin/{id}/activate",name="user-activate-account")
     */
    public function adminFirstLoginAction(Request $request,User $user){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ResetPasswordForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            $user->setIsPasswordCreated(true);
            $em->persist($user);
            $em->flush();

            return $this->render('user/adminAccountUpdated.htm.twig');
        }

        if ($user->getIsPasswordCreated()){
            $activated = true;
        }else{
            $activated = false;
        }

        return $this->render('user/adminActivate.htm.twig',[
            'user'=>$user,
            'activationForm'=>$form->createView(),
            'isActivated'=>$activated
        ]);
    }
    /**
     * @Route("admin/user/account/{id}/delete-account",name="delete-account")
     */
    public function deleteUserAction(Request $request,User $user){
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('admin-accounts'));
    }
    /**
     * @Route("/account/{id}/reset-password",name="user-reset-password")
     */
    public function resetPasswordAction(Request $request,User $user){
        $em = $this->getDoctrine()->getManager();

       /* $user = $em->getRepository("AppBundle:User")
            ->findOneBy([
                'passwordResetToken'=>$code
            ]);
            */

        $form = $this->createForm(ResetPasswordForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            $user->setIsResetTokenValid(false);
            $em->persist($user);
            $em->flush();

            return $this->render('user/passwordUpdated.htm.twig');
        }

        if ($user->getIsResetTokenValid()){
            $validToken = true;
        }else{
            $validToken = false;
        }

        return $this->render('user/reset-password.htm.twig',[
            'user'=>$user,
            'passwordResetForm'=>$form->createView(),
            'isTokenValid'=>$validToken
        ]);
    }
    /**
     * @Route("/{id}/reset-password",name="user-reset-password")
     */
    public function resetAction(Request $request,User $user){
        $em = $this->getDoctrine()->getManager();

       /* $user = $em->getRepository("AppBundle:User")
            ->findOneBy([
                'passwordResetToken'=>$code
            ]);
            */

        $form = $this->createForm(ResetPasswordForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            $user->setIsResetTokenValid(false);
            $em->persist($user);
            $em->flush();

            return $this->render('user/passwordUpdated.htm.twig');
        }

        if ($user->getIsResetTokenValid()){
            $validToken = true;
        }else{
            $validToken = false;
        }

        return $this->render('user/reset-password.htm.twig',[
            'user'=>$user,
            'passwordResetForm'=>$form->createView(),
            'isTokenValid'=>$validToken
        ]);
    }
  
    /**
     * @Route("/login/",name="login")
     *
     */
    public function loginUserAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(
            'user/login.htm.twig',
            [
                'loginForm' => $form->createView(),
                'error' => $error,
            ]);
    }
    /**
     * @Route("/login/profile",name="profile-login")
     *
     */
    public function profileLoginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(
            'user/profileLogin.htm.twig',
            [
                'loginForm' => $form->createView(),
                'error' => $error,
            ]);
    }

    /**
     * @Route("/account/request",name="request-admin-account")
     */
    public function requestAccountAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setIsActive(false);
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setIsPasswordCreated(false);

        $form = $this->createForm(AdministratorRegistrationForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("admin-account-requested");
        }
        return $this->render(':admin:register.htm.twig',[
            'registerForm'=>$form->createView()
        ]);

    }
    /**
     * @Route("/account/admin/requested",name="admin-account-requested")
     */
    public function accountCreatedAction(Request $request){
        return $this->render(':admin:created.htm.twig');
    }

    /**
     * @Route("/login/admin",name="security-login")
     *
     */
    public function loginAdminAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(
            'admin/login.htm.twig',
            array(
                'loginForm' => $form->createView(),
                'error' => $error,
            ));
    }
    
     /**
     * @Route("/login/profile/reset-password",name="user_request_password_reset")
     */
    public function requestPasswordReset(Request $request){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(PasswordResetForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $email = $form["email"]->getData();

            $user = $em->getRepository('AppBundle:User')
                ->findOneBy([
                    'email'=> $email,
                ]);

            if (!$user or in_array('ROLE_USER', $user->getRoles(), false)){
                return $this->render(
                    'user/forgot-password.htm.twig',
                    array(
                        'passwordResetForm' => $form->createView(),
                        'error' => 'Invalid email! Try Again',
                        'success' => ''
                    ));
            }

            $resetToken = $user->getId();
            
            $user->setPasswordResetToken($resetToken);
            $user->setIsResetTokenValid(true);

            $em->persist($user);
            $em->flush();

            $this->sendEmail($user->getFirstName(),"Password Reset",$user->getEmail(),"selfpasswordReset.htm.twig",$resetToken);
            return $this->render(
                'user/forgot-password.htm.twig',
                array(
                    'passwordResetForm' => $form->createView(),
                    'error' => '',
                    'success' => 'Password reset email sent. Check your email'
                ));
        }

        return $this->render(
            'user/forgot-password.htm.twig',
            array(
                'passwordResetForm' => $form->createView(),
                'error' => '',
                'success' => ''
            ));
    }

    protected function sendEmail($firstName,$subject,$emailAddress,$twigTemplate,$code){
        $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
        /**$message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('mcsk@mcsk.co.ke','MCSK Online Portal Team')
            ->setTo($emailAddress)
            ->setBody(
                $this->renderView(
                    'Emails/'.$twigTemplate,
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);**/
        $body=$this->renderView(
                'Emails/'.$twigTemplate,
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "mcsk@mcsk.or.ke");
//$subject = $subject;
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);

    }

    /**
     * @Route("/logout",name="security_logout")
     */
    public function logoutAction(){
        return $this->redirectToRoute('security-login');
    }
    /**
     * @Route("/logout",name="user_logout")
     */
    public function logoutUserAction(){
        return $this->redirectToRoute('profile-login');
    }
}
