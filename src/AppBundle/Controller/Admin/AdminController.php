<?php
/**
 * Created by PhpStorm.
 * User: Mgeni
 * Date: 5/24/2017
 * Time: 3:53 PM
 */
namespace AppBundle\Controller\Admin;

use AppBundle\Entity\NextOfKin;
use AppBundle\Entity\Profile;
use AppBundle\Entity\CorporateProfile;
use AppBundle\Entity\User;
use AppBundle\Form\NewAdministratorForm;
use AppBundle\Form\EditAdministratorForm;
use AppBundle\Form\ProfileReviewForm;
use AppBundle\Form\ConfirmMpesaForm;
use AppBundle\Form\ConfirmCorporateForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WhiteOctober;
use SendGrid;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMINISTRATOR')")
 */
class AdminController extends Controller
{
    
     /**
     * @param Request $request
     * @param Profile $profile
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/applications/{id}/edit",name="confirm-application-payment")
     */
    public function confirmPayment(Request $request, Profile $profile){
        $em = $this->getDoctrine()->getManager();

        $admin = $this->get('security.token_storage')->getToken()->getUser();
        $profile->setProgress("Complete");
        $profile->setIsPaid(true);
        $profile->setMpesaStatus("Success");
        $profile->setMpesaPaymentDate(new \DateTime());
        $form = $this->createForm(ConfirmMpesaForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $profile = $form->getData();
            $transactionArray = array("a" => $form['mpesaConfirmationCode']->getData(), "b" => $form['mpesaPaymentDate']->getData(), "c" => $form['mpesaNumber']->getData(), "d" => $form['mpesaAmount']->getData(),"e"=>$profile->getId());
           
           
            $em->persist($profile);
           $em->flush();
            
           // $this->sendPaymentEmail($profile->getFirstName(), $profile->getEmailAddress(), $transactionArray);
           
            return $this->redirectToRoute('new-users');
        }
        return $this->render('admin/payment.htm.twig',[
            'mpesaForm'=>$form->createView()
        ]);
    }
     /**
     * @param Request $request
     * @param CorporateProfile $profile
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/applications/corporate/{id}/edit",name="confirm-corporate-application-payment")
     */
    public function confirmCorporatePayment(Request $request, CorporateProfile $profile){
        $em = $this->getDoctrine()->getManager();

        $admin = $this->get('security.token_storage')->getToken()->getUser();
        $profile->setProgress("Complete");
        $profile->setIsPaid(true);
        $profile->setMpesaStatus("Success");
        $profile->setMpesaPaymentDate(new \DateTime());
        $form = $this->createForm(ConfirmCorporateForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $profile = $form->getData();
            $transactionArray = array("a" => $form['mpesaConfirmationCode']->getData(), "b" => $form['mpesaPaymentDate']->getData(), "c" => $form['mpesaNumber']->getData(), "d" => $form['mpesaAmount']->getData(),"e"=>$profile->getId());
           
           
            $em->persist($profile);
           $em->flush();
            
            $this->sendPaymentEmail($profile->getCompanyName(), $profile->getEmailAddress(), $transactionArray);
           
            return $this->redirectToRoute('new-users');
        }
        return $this->render('admin/payment.htm.twig',[
            'mpesaForm'=>$form->createView()
        ]);
    }
     /**
     * @Route("/users/recordings/{id}/review",name="review-recordings")
     */
    public function reviewProfileAction(Request $request, Profile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProfileReviewForm::class);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){
            $comment = $request->request->get('comment');
            $approval = $request->request->get('approval');
           // var_dump($approval);exit;
            if ($approval =="Approved"){
                $profile->setProfileStatus("Approved");
                $profile->setIsMembershipApproved(true);
                $profile->setMembershipApprovedAt(new \DateTime());
                $profile->setMembershipApprovedBy($user);

                $twigTemplate = "membershipApproved.htm.twig";
                $accountStatus = "MSCK Portal Profile Approved";
            }else{
                $profile->setProfileStatus("Rejected");
                $profile->setIsMembershipApproved(false);
                $profile->setMembershipApprovedBy($user);
                $profile->setMembershipApprovedAt(new \DateTime());

                $twigTemplate = "rejected.htm.twig";
                $accountStatus = "MCSK Portal Profile Status";
            }
            $profile->setStatusDescription($comment);
            $profile->setProcessedBy($user);
            $profile->setProcessedAt(new \DateTime());

            $em->persist($profile);
            $em->flush();

         //   $this->sendEmail($profile->getFirstName(),$accountStatus,$profile->getEmailAddress(),$twigTemplate,null);

       //     return $this->redirectToRoute('open-profiles');
        }
        return $this->render('admin/reports/review.htm.twig',[
            'profile'=>$profile,
            'profileReviewForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/corporate/recordings/{id}/review",name="review-corporate-recordings")
     */
    public function reviewCorporateProfileAction(Request $request, CorporateProfile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CorporateReviewForm::class);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){
            $comment = $request->request->get('comment');
            $approval = $request->request->get('approval');

            if ($approval =="Approved"){
                $profile->setProfileStatus("Approved");
                $profile->setIsMembershipApproved(true);
                $profile->setMembershipApprovedAt(new \DateTime());
                $profile->setMembershipApprovedBy($user);

                $twigTemplate = "membershipApproved2.htm.twig";
                $accountStatus = "MCSK Portal Profile Approved";
            }else{
                $profile->setProfileStatus("Rejected");
                $profile->setIsMembershipApproved(false);
                $profile->setMembershipApprovedBy($user);
                $profile->setMembershipApprovedAt(new \DateTime());

                $twigTemplate = "rejected.htm.twig";
                $accountStatus = "MCSK Portal Profile Status";
            }

            $profile->setStatusDescription($comment);
            $profile->setProcessedBy($user);
            $profile->setProcessedAt(new \DateTime());

            $em->persist($profile);
            $em->flush();

            $this->sendEmail($profile->getFirstDirectorNames(),$accountStatus,$profile->getEmailAddress(),$twigTemplate,null);

            return $this->redirectToRoute('open-corporate-profiles');
        }
        return $this->render('admin/reports/corporate-review.htm.twig',[
            'profile'=>$profile,
            'profileReviewForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/users/admin/pending",name="pending-admin-accounts")
     */
    public function pendingAdminAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")
            ->findAllPendingAdminUsers();

        return $this->render('admin/pending-admin-accounts.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/users/administrators",name="admin-accounts")
     */
    public function adminAccountsAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")
            ->findAllAdministratorUsers();

        return $this->render('admin/admin-users.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/user/account/{id}/approve",name="approve-admin-account")
     */
    public function approveAccountAction(Request $request, User $user){
        $admin = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $user->setIsActive(true);
        $user->setIsPasswordCreated(true);
        $user->setApprovedBy($admin);

        $em->persist($user);
        $em->flush();

        $this->sendEmail($user->getFirstName(),"Administrator Account Approved",$user->getEmail(),"accountApproved.htm.twig",null);

        return new Response(null,204);
    }
    /**
     * @Route("/administrator/new",name="new-administrator")
     */
    public function newAdministratorAction(Request $request){
        $admin = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $accountToken = time();

        $user = new User();
        $user->setIsActive(true);
        $user->setIsTermsAccepted(true);
        $user->setPhoneNumber("1234");

        $user->setPlainPassword(base64_encode(random_bytes(10)));
        $user->setAccountCreatedBy($admin);
        $user->setPasswordResetToken($accountToken);
        $user->setMiddleName('Admin');

        $form = $this->createForm(NewAdministratorForm::class,$user);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){
            $user=$form->getData();

            $role = $request->request->get('role');

            if ($role=="Membership") {
                $user->setRoles(["ROLE_MEMBERSHIP"]);
                $user->setIsCommitteeMember("false");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Membership");
            }elseif ($role =="Board"){
                $user->setRoles(["ROLE_BOARD"]);
                $user->setIsCommitteeMember("false");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Board");

                $file = $form['imageFile']->getData();
                //$filename = $file->getClientOriginalName();
                $filename = uniqid('', true).'.'.$file->guessExtension();
                $file->move("../web/assets/signatures", $filename);
                $user->setSignatureFile($filename);

            }elseif ($role =="Administrator"){
                $user->setRoles(["ROLE_ADMINISTRATOR"]);
                $user->setIsCommitteeMember("false");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Admin");
            }elseif ($role =="Committee"){
                $user->setRoles(["ROLE_COMMITTEE"]);
                $user->setIsCommitteeMember("true");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Committee");
            }elseif ($role =="Committee Chair"){
                 $user->setRoles(["ROLE_COMMITTEE"]);
                 $user->setIsCommitteeMember("true");
                 $user->setIsCommitteeChairMember("true");
                $user->setActualRole("Committee Chair");
            }
            
            $user->setAccountCreatedAt( new \DateTime());
            $em->persist($user);
            $em->flush();

            $this->sendEmail($user->getFirstName(),"MCSK Portal Administrator Account",$user->getEmail(),"adminAccountCreated.htm.twig",$user->getId());

            return $this->redirectToRoute('admin-accounts');
        }
        return $this->render(':admin:new.htm.twig',[
            'adminForm'=>$form->createView()
        ]);
    }

    /**
     * @Route("/administrator/{id}/update",name="update-administrator")
     */
    public function updateAdministratorAction(Request $request,User $user){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(EditAdministratorForm::class,$user);

        $form->handleRequest($request);


        if ($form->isValid() && $form->isSubmitted()){
            $user=$form->getData();

            $role = $request->request->get('role');

            if ($role=="Membership") {
                $user->setRoles(["ROLE_MEMBERSHIP"]);
                $user->setIsCommitteeMember("false");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Member");
            }elseif ($role =="Board"){
                $user->setRoles(["ROLE_BOARD"]);
                $user->setIsCommitteeMember("false");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Board");

                unlink("../web/assets/signatures/".$user->getSignatureFile());

                $file = $form['imageFile']->getData();
                //$filename = $file->getClientOriginalName();
                $filename = uniqid('', true).'.'.$file->guessExtension();
                $file->move("../web/assets/signatures", $filename);
                $user->setSignatureFile($filename);

            }elseif ($role =="Administrator"){
                $user->setRoles(["ROLE_ADMINISTRATOR"]);
                $user->setIsCommitteeMember("false");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Admin");
            }elseif ($role =="Committee"){
                $user->setRoles(["ROLE_COMMITTEE"]);
                $user->setIsCommitteeMember("true");
                $user->setIsCommitteeChairMember("false");
                $user->setActualRole("Committee");
            }elseif ($role =="Committee Chair"){
                $user->setRoles(["ROLE_COMMITTEE"]);
                $user->setIsCommitteeMember("true");
                $user->setIsCommitteeChairMember("true");
                $user->setActualRole("Committee Chair");
            }
            $em->persist($user);
            $em->flush();

            //$this->sendEmail($user->getFirstName(),"MCSK Portal Administrator Account",$user->getEmail(),"adminAccountCreated.htm.twig",$user->getId());

            return $this->redirectToRoute('admin-accounts');
        }

        return $this->render(':admin:new_updated.htm.twig',[
            'adminForm'=>$form->createView(),
            'user'=>$user
        ]);
    }

    protected function sendEmail($firstName,$subject,$emailAddress,$twigTemplate,$code){
       /** $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('portal@mcsk.or.ke','MCSK Online Portal Team')
            ->setTo($emailAddress)
            ->setBody(
                $this->renderView(
                    'Emails/adminAccountCreated.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);**/
        $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');

        $body=$this->renderView(
                    'Emails/adminAccountCreated.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "portal@mcsk.or.ke");
//$subject = $subject;
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);

    }

    /**
     * @Route("/member/update",name="update-member")
     */
    public function updateRoleFunction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $memberId = $request->request->get('pk');
        $roleValue = $request->request->get('value');

        switch ($roleValue) {
            case 1:
                $role = ["ROLE_MEMBERSHIP"];
                break;
            case 2:
                $role = ["ROLE_BOARD"];
                break;
            case 3:
                $role = ["ROLE_ADMINISTRATOR"];
                break;
            case 4:
                $role = ["ROLE_COMMITTEE"];
                break;
            default:
                $role = ["ROLE_MEMBERSHIP"];
                break;
        }

        $member = $em->getRepository("AppBundle:User")
            ->findOneBy([
                'id'=>$memberId
            ]);

        if ($member){
            $member->setRoles($role);
            $em->persist($member);
            $em->flush();
            return new Response(null,200);
        }else{
            return new Response(null,500);
        }
    }
    /**
     * @Route("/users/access",name="access-logs")
     */
    public function userAccessLogsAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")
            ->findAllUserLogs();

        return $this->render(':admin/reports:users.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/users/all",name="all-users")
     */
    public function allUsersAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")
            ->findAllUsers();

        return $this->render(':admin/reports:all-users.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/users/custom-report",name="custom-report")
     */
    public function customReport(){
        $em = $this->getDoctrine()->getManager();

        $nrUsersProf=[];
        $nrUsersCorProf=[];
        $regions=['Nairobi',
            'Coast',
            'Central',
            'Rift Valley',
            'Nyanza',
            'Eastern',
            'Western'];

        foreach ($regions as $region) {
            $users =$em->getRepository("AppBundle:Profile")
                ->findNrUsersByRegion($region);
            $nrUsersProf[$region] = $users;
        }

        foreach ($regions as $region) {
            $users =$em->getRepository("AppBundle:CorporateProfile")
                ->findNrUsersByRegion($region);
            $nrUsersCorProf[$region] = $users;
        }

        return $this->render(':admin/reports:custom-reports.htm.twig',[
            'nrNairobi' => $nrUsersProf['Nairobi']+$nrUsersCorProf['Nairobi'],
            'nrCoast' => $nrUsersProf['Coast']+$nrUsersCorProf['Coast'],
            'nrCentral' => $nrUsersProf['Central']+$nrUsersCorProf['Central'],
            'nrRift' => $nrUsersProf['Rift Valley']+$nrUsersCorProf['Rift Valley'],
            'nrNyanza' => $nrUsersProf['Nyanza']+$nrUsersCorProf['Nyanza'],
            'nrEastern' => $nrUsersProf['Eastern']+$nrUsersCorProf['Eastern'],
            'nrWestern' => $nrUsersProf['Western']+$nrUsersCorProf['Western'],
            'nrIndividual' =>  $em->getRepository("AppBundle:User")
                ->findNrUsersByCategory("Individual"),
            'nrDeceasedProducer' => $em->getRepository("AppBundle:User")
                ->findNrUsersByCategory("Deceased Producer"),
            'nrSoleProprietorship' => $em->getRepository("AppBundle:User")
                ->findNrUsersByCategory("Sole Proprietorship"),
            'nrLimitedCompany' => $em->getRepository("AppBundle:User")
                ->findNrUsersByCategory("Limited Company"),
        ]);
    }
    /**
     * @Route("/users/year",name="users-by-year")
     */
    public function usersByYearAction(){
        $em = $this->getDoctrine()->getManager();

        $nrUsers=[];
        $years=['2018','2019','2020','2021','2022'];

        foreach ($years as $year) {
            $users =$em->getRepository("AppBundle:Profile")
                ->findNrUsersByYear($year);
            $nrUsers[$year] = $users;
        }
       // var_dump($nrUsers);exit;
        $nr2018 = $nrUsers['2018'];
        $nr2019 = $nrUsers['2019'];
        $nr2020 = $nrUsers['2020'];
        $nr2021 = $nrUsers['2021'];
        $nr2022 = $nrUsers['2022'];

        $userNumbers = $nr2018.','.$nr2019.','.$nr2020.','.$nr2021.','.$nr2022;

        return $this->render(':admin/reports:users-by-year.htm.twig',[
            'userNumbers'=>$userNumbers
        ]);
    }
    /**
     * @Route("/users/approved/year",name="approved-users-by-year")
     */
    public function usersApprovedByYearAction(){
        $em = $this->getDoctrine()->getManager();

        $nrUsers=[];
        $years=['2018','2019','2020','2021','2022'];

        foreach ($years as $year) {
            $users =$em->getRepository("AppBundle:Profile")
                ->findNrApprovedUsersByYear($year);
            $nrUsers[$year] = $users;
        }
       // var_dump($nrUsers);exit;
        $nr2018 = $nrUsers['2018'];
        $nr2019 = $nrUsers['2019'];
        $nr2020 = $nrUsers['2020'];
        $nr2021 = $nrUsers['2021'];
        $nr2022 = $nrUsers['2022'];

        $userNumbers = $nr2018.','.$nr2019.','.$nr2020.','.$nr2021.','.$nr2022;

        return $this->render(':admin/reports:users-by-year.htm.twig',[
            'userNumbers'=>$userNumbers
        ]);
    }
    /**
     * @Route("/users/declined/year",name="rejected-users-by-year")
     */
    public function usersRejectedByYearAction(){
        $em = $this->getDoctrine()->getManager();

        $nrUsers=[];
        $years=['2018','2019','2020','2021','2022'];

        foreach ($years as $year) {
            $users =$em->getRepository("AppBundle:Profile")
                ->findNrRejectedUsersByYear($year);
            $nrUsers[$year] = $users;
        }
       // var_dump($nrUsers);exit;
        $nr2018 = $nrUsers['2018'];
        $nr2019 = $nrUsers['2019'];
        $nr2020 = $nrUsers['2020'];
        $nr2021 = $nrUsers['2021'];
        $nr2022 = $nrUsers['2022'];

        $userNumbers = $nr2018.','.$nr2019.','.$nr2020.','.$nr2021.','.$nr2022;

        return $this->render(':admin/reports:users-by-year.htm.twig',[
            'userNumbers'=>$userNumbers
        ]);
    }
    /**
     * @Route("/users/payments",name="payment-reports")
     */
    public function userPaymentReportsAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findPaymentReports();

        return $this->render(':admin/reports:payments.htm.twig',[
            'users'=>$users
        ]);
    }

    public function sendPaymentEmail($firstName, $emailAddress, $code)
    {
        /**$message = \Swift_Message::newInstance()->setSubject('MCSK Online Portal Profile')->setFrom('mcsk@patchcreate.com', 'MCSK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
            'Emails/paid.htm.twig', array('name' => $firstName, 'code' => $code)), 'text/html');
        $this->get('mailer')->send($message);**/
        $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');

         $body=$this->renderView(
            'Emails/paid.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "finance@mcsk.or.ke");
$subject = "MCSK Online Portal Profile";
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);

    }

    public function sendSms($message,$phone){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vaspro.co.ke/v3/BulkSMS/api/create",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array(
                "apiKey" => "bd58e5def8d1ef9df0436e84bc9394d8",
                "shortCode" => "MCSK",
                "message" => $message,
                "recipient" => $phone,
                "callbackURL" => "",
                "enqueue" => 0)),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        /*if ($err) {
            return new Response(
                "CURL Error #:" . $err
            );

        } else {
            return new Response(
                $response
            );
        }*/
    }
}
