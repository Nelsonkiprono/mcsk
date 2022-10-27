<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\CorporateProfile;
use AppBundle\Entity\NextOfKin;
use AppBundle\Entity\Profile;
use AppBundle\Entity\User;
use AppBundle\Form\CorporateReviewForm;
use AppBundle\Form\NewAdministratorForm;
use AppBundle\Form\ProfileReviewForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WhiteOctober;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use SendGrid;
/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */

class MemberController extends Controller
{
    /**
     * @Route("/",name="admin-dashboard")
     */
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Basic Profiles
        $nrCorporate = $em->getRepository("AppBundle:CorporateProfile")
            ->findNrUnpaidProfiles();
        $nrIndividual = $em->getRepository("AppBundle:Profile")
            ->findNrUnpaidProfiles();
       // var_dump($nrIndividual);exit;
        //Pending Profiles
        $nrPendingIndividual = $em->getRepository("AppBundle:Profile")
            ->findNrUnderReview();
        $nrPendingCorporate = $em->getRepository("AppBundle:CorporateProfile")
            ->findNrUnderReview();

        //Membership Approved
        $nrMembershipApproved = $em->getRepository("AppBundle:Profile")
            ->findNrApproved();
        $nrMembershipApprovedCorporates = $em->getRepository("AppBundle:CorporateProfile")
            ->findNrApproved();

        //Committee Approved
        $nrCommitteeApproved = $em->getRepository("AppBundle:Profile")
            ->findNrCommitteeApprovedProfiles();
        $nrCommitteeApprovedCorporates = $em->getRepository("AppBundle:CorporateProfile")
            ->findNrCommitteeApprovedProfiles();

        //Board Approved
        $nrBoardApproved = $em->getRepository("AppBundle:Profile")
            ->findNrBoardApprovedProfiles();
        $nrBoardApprovedCorporates = $em->getRepository("AppBundle:CorporateProfile")
            ->findNrBoardApprovedProfiles();

        return $this->render('admin/dashboard.htm.twig',[
            'nrCorporate'=> $nrCorporate,
            'nrIndividual'=>$nrIndividual,
            'nrPendingIndividual'=> $nrPendingIndividual,
            'nrPendingCorporate' => $nrPendingCorporate,
            'nrMembershipApproved' => $nrMembershipApproved,
            'nrMembershipApprovedCorporates'=> $nrMembershipApprovedCorporates,
            'nrCommitteeApproved' => $nrCommitteeApproved,
            'nrCommitteeApprovedCorporates'=> $nrCommitteeApprovedCorporates,
            'nrBoardApproved'=>$nrBoardApproved,
            'nrBoardApprovedCorporates' => $nrBoardApprovedCorporates
        ]);
    }

    /**
     * @Route("/onboard/corporate/step1",name="new-users")
     */
    public function onBoardAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Onboard")
            ->findBy([

            ],
                [
                    'createdAt'=>'Asc'
                ]);

        return $this->render('admin/step-1-users.htm.twig',[
            'users' => $users
        ]);
    }
    /**
     * @Route("/onboard/individual/step1",name="new-individual-users")
     */
    public function onBoardIndividualAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Individual")
            ->findBy([

            ],
                [
                    'createdAt'=>'Asc'
                ]);

        return $this->render('admin/step-1-individual.htm.twig',[
            'users' => $users
        ]);
    }

    /**
     * @Route("/profile/individual",name="open-profiles")
     */
    public function profileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findBy([
                'profileStatus'=>'Pending'
            ],
                [
                    'createdAt'=>'Desc'
                ]);

        return $this->render('admin/open-profiles.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/profile/corporate",name="open-corporate-profiles")
     */
    public function corporateProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:CorporateProfile")
            ->findBy([
                'profileStatus'=>'Pending'
            ],
                [
                    'createdAt'=>'Desc'
                ]);

        return $this->render('admin/open-corporate-profiles.htm.twig',[
            'users'=>$users
        ]);
    }

    /**
     * @Route("/approved/profiles/individual",name="membership-approved-profiles")
     */
    public function membershipApprovedProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllMembershipApprovedProfilesOrderByDate();

        return $this->render('admin/step-2-individual.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/approved/membership/corporates",name="membership-approved-corporates")
     */
    public function membershipApprovedCorporatesAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:CorporateProfile")
            ->findAllMembershipApprovedProfilesOrderByDate();

        return $this->render('admin/step-2-corporate.htm.twig',[
            'users'=>$users
        ]);
    }

    /**
     * @Route("/approved/board/individual",name="board-approved-users")
     */
    public function approvedProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllBoardApprovedProfilesOrderByDate();

        return $this->render('admin/boardApproved-users.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/approved/board/corporates",name="board-approved-corporates")
     */
    public function approvedCorporateAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:CorporateProfile")
            ->findAllBoardApprovedProfilesOrderByDate();

        return $this->render('admin/boardApproved-corporates.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/approved/committee/individual",name="committee-approved-users")
     */
    public function approvedCommitteeProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllCommitteeApprovedProfilesOrderByDate();

        return $this->render('admin/committeeApproved-users.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/approved/committee/corporates",name="committee-approved-corporates")
     */
    public function approvedCommitteeCorporateAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:CorporateProfile")
            ->findAllCommitteeApprovedProfilesOrderByDate();

        return $this->render('admin/committeeApproved-corporates.htm.twig',[
            'users'=>$users
        ]);
    }


    /**
     * @Route("/members",name="members")
     */
    public function membersAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllApprovedProfilesOrderByDate();

        return $this->render('admin/approved-users.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/profiles/pending",name="pending-accounts")
     */
    public function pendingProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")
            ->findAllPendingUsers();

        return $this->render('admin/pending-accounts.htm.twig',[
            'users'=>$users
        ]);
    }

    /**
     * @Route("/profiles/rejected",name="rejected-users")
     */
    public function rejectedProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllRejectedProfilesOrderByDate();

        return $this->render('admin/rejected-users.htm.twig',[
            'users'=>$users
        ]);
    }

    /**
     * @Route("/users/profile/{id}/review",name="review-profile")
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

            $this->sendEmail($profile->getApplicantName(),$accountStatus,$profile->getEmailAddress(),$twigTemplate,null);

            //return $this->redirectToRoute('open-profiles');
        }
        return $this->render('admin/profile/review.htm.twig',[
            'profile'=>$profile,
            //'boardReviewForm' => $form->createView()
            'profileReviewForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/corporate/profile/{id}/review",name="review-corporate-profile")
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

            /*return $this->redirectToRoute('open-corporate-profiles');*/
        }
        return $this->render('admin/profile/corporate-review.htm.twig',[
            'profile'=>$profile,
            'profileReviewForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/users/profile/{id}/pdf",name="pdf-profile")
     */
    public function pdfProfileAction(Request $request, Profile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();


        $html = $this->renderView('admin/profile/profilePDF.htm.twig',[
            'profile'=>$profile,

        ]);

        $this->returnPDFResponseFromHTML($html);
    }
    public function returnPDFResponseFromHTML($html){
        //set_time_limit(30); uncomment this line according to your needs

        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetTitle(('Profile Review'));
        $pdf->SetSubject('Profile Review');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'profile';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly
    }
    /**
     * @Route("/account/{id}/new",name="create-account")
     */
    public function createAccountAction(Request $request,Profile $profile){
        $admin = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $accountToken = base64_encode($profile->getIdNumber());

        $user = new User();
        $user->setIsActive(true);
        $user->setEmail($profile->getEmailAddress());
        $user->setFirstName($profile->getFirstName());
        $user->setLastName($profile->getLastName());
        $user->setIsPasswordCreated(false);
        $user->setMyProfile($profile);
        $user->setRoles(["ROLE_USER"]);
        $user->setPlainPassword($profile->getIdNumber());
        $user->setProfileLinkedAt(new \DateTime());
        $user->setAccountCreatedBy($admin);
        $user->setPasswordResetToken($accountToken);

        $profile->setAccountCreated("Created");

        $em->persist($profile);
        $em->persist($user);

        $em->flush();

        $this->sendEmail($profile->getFirstName(),"Your MCSK Portal Account",$profile->getEmailAddress(),"accountCreated.htm.twig",$profile->getId());

        return new Response(null, 204);
    }

    /**
     * @Route("/user/account/{id}/reset",name="request-password-reset")
     */
    public function requestPasswordResetAction(Request $request, User $user){

        $em = $this->getDoctrine()->getManager();

        //$resetToken = base64_encode(random_bytes(10));
        $resetToken = $user->getid();
        
        $user->setPlainPassword($resetToken."12");
        $user->setPasswordResetToken($resetToken);
        $user->setIsResetTokenValid(true);

        $em->persist($user);
        $em->flush();

        $this->sendEmail($user->getFirstName(),"Password Reset",$user->getEmail(),"passwordReset.htm.twig",$resetToken);

        return new Response(null,204);
    }
    /**
     * @Route("/user/account/{id}/deactivate",name="deactivate-account")
     */
    public function deactivateAccountAction(Request $request, User $user){

        $em = $this->getDoctrine()->getManager();

        $resetToken = base64_encode(random_bytes(10));

        $user->setPlainPassword($resetToken."12");
        $user->setIsActive(false);

        $em->persist($user);
        $em->flush();

        return new Response(null,204);
    }
    /**
     * @Route("/user/account/{id}/activate",name="activate-account")
     */
    public function activateAccountAction(Request $request, User $user){

        $em = $this->getDoctrine()->getManager();

       //$resetToken = base64_encode(random_bytes(10));
        $resetToken = $user->getId();
        
        $user->setPlainPassword($resetToken."12");
        $user->setPasswordResetToken($resetToken);
        $user->setIsResetTokenValid(true);
        $user->setIsActive(true);

        $em->persist($user);
        $em->flush();

        $this->sendEmail($user->getFirstName(),"Password Reset",$user->getEmail(),"passwordReset.htm.twig",$resetToken);

        return new Response(null,204);
    }


    protected function sendEmail($firstName,$subject,$emailAddress,$twigTemplate,$code){
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
        $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');

        $body=$this->renderView(
                    'Emails/'.$twigTemplate,
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "mcsk@mcsk.or.ke");
$subject = $subject;
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
    }
    /**
     * @Route("/next-of-kin/list/{id}",name="next-of-kin")
     */
    public function listKinAction(Request $request,Profile $profile){

        $em = $this->getDoctrine()->getManager();
        $user=$profile->getWhoseProfile();

        $nextOfKin = $em->getRepository('AppBundle:NextOfKin')
            ->findMyKin($user);

        return $this->render('admin/nextofkin/list.htm.twig', [
            'kinsList' => $nextOfKin,
            'user' =>$user
        ]);
    }
    /**
     * @Route("/next-of-kin/view/{id}",name="admin-view-kin-details")
     */
    public function viewNextOfKinAction(Request $request,NextOfKin $nextOfKin){
        $user = $nextOfKin->getWhoseKin();
        $profile = $user->getMyProfile();
        return $this->render('admin/nextofkin/details.htm.twig', [
            'nextOfKin' => $nextOfKin,
            'profile' =>$profile
        ]);

    }

    /**
     * @Route("/request/{id}/documents",name="request-documents")
     */
    public function requestDocumentsAction(Request $request,Profile $profile){
        $this->sendEmail($profile->getFirstName(),"Request for Documents",$profile->getEmailAddress(),'documents.htm.twig',$profile->getId());
        return new Response(null,200);
    }

    /**
     * @Route("/users/member-number/update",name="update-member-number")
     */
    public function updateMemberNumberAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $memberId = $request->request->get('pk');
        $memberNumber = $request->request->get('value');

        $member = $em->getRepository("AppBundle:Profile")
            ->findOneBy([
                'id'=>$memberId
            ]);

        if ($member){
            $member->setMemberNumber($memberNumber);
            $em->persist($member);
            $em->flush();
            return new Response(null,200);
        }else{
            return new Response(null,500);
        }


    }
    /**
     * @Route("/board/profile/{id}/review",name="board-review-profile")
     */
    public function boardProfileReviewAction(Request $request, Profile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProfileReviewForm::class);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){

            $comment = $request->request->get('comment');
            $type = $request->request->get('type');
            $approval = $request->request->get('approval');

            if ($approval =="Approved" && $type=="Com"){

                $nrApprovals = $profile->getNrCommitteeApprovals();
                if ($nrApprovals == 0 || $nrApprovals == ""){
                    $nrApprovals =1;
                    $profile->setNrCommitteeApprovals($nrApprovals);
                    $profile->setCommitteeApprover1($user);
                    $profile->setCommitteeApproval1At(new \DateTime());
                    $profile->setCommitteeApprovalStatus1("Approved");
                    $profile->setIsCommitteeApproved(true);
                    
                }/*elseif ($nrApprovals == 1){
                    $nrApprovals =2;
                    $profile->setNrCommitteeApprovals($nrApprovals);
                    $profile->setCommitteeApprover2($user);
                    $profile->setCommitteeApproval2At(new \DateTime());
                    $profile->setCommitteeApprovalStatus2("Approved");
                    $profile->setIsCommitteeApproved(true); 
                }elseif ($nrApprovals == 2){
                    $nrApprovals =3;
                    $profile->setNrCommitteeApprovals($nrApprovals);
                    $profile->setCommitteeApprover3($user);
                    $profile->setCommitteeApproval2At(new \DateTime());
                    $profile->setCommitteeApprovalStatus3("Approved");
                    $profile->setIsCommitteeApproved(true);
                }*/

                $twigTemplate = "boardApproved.htm.twig";
                $accountStatus = "MCSK Membership Approved";
            }elseif ($approval =="Approved" && $type=="Bod"){
                $nrApprovals = $profile->getNrBoardApprovals();
               /*  $number = $profile->findMaxMemberNo();
                if($number>0)
                {
                $memberNumber=$number+1;
                }else
                {
                    $memberNumber=NULL; 
                } */
                 
                if ($nrApprovals == 0 || $nrApprovals == ""){
                    $nrApprovals =1;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover1($user);
                    $profile->setApproval1At(new \DateTime());
                    $profile->setBoardApprovalStatus1("Approved");
                    $profile->setIsBoardApproved(true);
                    //$profile->setMemberNumber($memberNumber);
                }/*elseif ($nrApprovals == 1){
                    $nrApprovals =2;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover2($user);
                    $profile->setApproval2At(new \DateTime());
                    $profile->setBoardApprovalStatus2("Approved");
                }elseif ($nrApprovals == 2){
                    $nrApprovals =3;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover3($user);
                    $profile->setApproval3At(new \DateTime());
                    $profile->setBoardApprovalStatus3("Approved");
                    $profile->setIsBoardApproved(true);
                }*/

                $twigTemplate = "boardApproved.htm.twig";
                $accountStatus = "MCSK Membership Approved";
            }else{
                if ($type == "Com"){
                    $profile->setIsCommitteeApproved(false);
                    $profile->setIsCommitteeRejected(true);
                    $profile->setCommitteeRejectionAt(new \DateTime());
                    $profile->setCommitteeRejectionBy($user);
                    $profile->setCommitteeRejectionReason($comment);
                }

                if ($type == "Bod"){
                    $profile->setIsBoardApproved(false);
                    $profile->setIsBoardRejected(true);
                    $profile->setBoardRejectionAt(new \DateTime());
                    $profile->setBoardRejectionBy($user);
                    $profile->setBoardRejectionReason($comment);
                }

                $twigTemplate = "rejected.htm.twig";
                $accountStatus = "MCSK Portal Profile Status";
            }

            $profile->setStatusDescription($comment);
            $profile->setProcessedBy($user);
            $profile->setProcessedAt(new \DateTime());

            $em->persist($profile);
            $em->flush();

            //If All Board Members have approved, notify the user
            if ($profile->getNrCommitteeApprovals()==1 && $profile->getNrBoardApprovals()==1) {
                $users_data =$em->getRepository("AppBundle:User")
                    ->findLastMembershipOrderByDate();

                $last_member_number = null;
                foreach ($users_data as $user_data){
                    $last_member_number = $user_data->getMemberNumber();
                }
                $profile->setMemberNumber($last_member_number+1);
                $approved_user = $em->getRepository("AppBundle:User")
                    ->findOneBy([
                        'profile'=>$profile->getId()
                    ]);
                $approved_user->setMemberNumber($last_member_number+1);
                $em->persist($profile);
                $em->persist($approved_user);
                $em->flush();
                $this->sendSms("Profile Status: Approved by the MCSK Board

                Congratulations ".$profile->getApplicantName()."!
                Your profile has been successfully reviewed and approved by the MCSK Board of Directors.
                You are now a member of MCSK.
                Your Membership Number is ".$profile->getMemberNumber().
               " Thank you!
                
                MCSK Team
                ",$profile->getMobileNumber());
                $this->signDocDeed($request->request->get('doc_name'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->signDocMech($request->request->get('doc_name2'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->sendEmail($profile->getApplicantName(), $accountStatus, $profile->getEmailAddress(), $twigTemplate, $profile->getMemberNumber());
            }
           // return $this->redirectToRoute('membership-approved-profiles');
        }
        return $this->render('admin/profile/boardReview.htm.twig',[
            'profile'=>$profile,
            'boardReviewForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/board/corporate/{id}/review",name="board-review-corporate")
     */
    public function boardCorporateReviewAction(Request $request, CorporateProfile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CorporateReviewForm::class);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){

            $comment = $request->request->get('comment');
            $type = $request->request->get('type');
            $approval = $request->request->get('approval');

            if ($approval =="Approved" && $type=="Com"){

                $nrApprovals = $profile->getNrCommitteeApprovals();

                if ($nrApprovals == 0 || $nrApprovals == ""){
                    $nrApprovals =1;
                    $profile->setNrCommitteeApprovals($nrApprovals);
                    $profile->setCommitteeApprover1($user);
                    $profile->setCommitteeApproval1At(new \DateTime());
                    $profile->setCommitteeApprovalStatus1("Approved");
                    $profile->setIsCommitteeApproved(true);
                }/*elseif ($nrApprovals == 1){
                    $nrApprovals =2;
                    $profile->setNrCommitteeApprovals($nrApprovals);
                    $profile->setCommitteeApprover2($user);
                    $profile->setCommitteeApproval2At(new \DateTime());
                    $profile->setCommitteeApprovalStatus2("Approved");
                    $profile->setIsCommitteeApproved(true);
                }elseif ($nrApprovals == 2){
                    $nrApprovals =3;
                    $profile->setNrCommitteeApprovals($nrApprovals);
                    $profile->setCommitteeApprover3($user);
                    $profile->setCommitteeApproval2At(new \DateTime());
                    $profile->setCommitteeApprovalStatus3("Approved");
                    $profile->setIsCommitteeApproved(true);
                }*/

                $twigTemplate = "boardApproved.htm.twig";
                $accountStatus = "MCSK Membership Approved";
            }elseif ($approval =="Approved" && $type=="Bod"){
                $nrApprovals = $profile->getNrBoardApprovals();

                if ($nrApprovals == 0 || $nrApprovals == ""){
                    $nrApprovals =1;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover1($user);
                    $profile->setApproval1At(new \DateTime());
                    $profile->setBoardApprovalStatus1("Approved");
                    $profile->setIsBoardApproved(true);
                }/*elseif ($nrApprovals == 1){
                    $nrApprovals =2;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover2($user);
                    $profile->setApproval2At(new \DateTime());
                    $profile->setBoardApprovalStatus2("Approved");
                }elseif ($nrApprovals == 2){
                    $nrApprovals =3;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover3($user);
                    $profile->setApproval3At(new \DateTime());
                    $profile->setBoardApprovalStatus3("Approved");
                    $profile->setIsBoardApproved(true);
                }*/

                $twigTemplate = "boardApproved.htm.twig";
                $accountStatus = "MCSK Membership Approved";
            }else{
                if ($type == "Com"){
                    $profile->setIsCommitteeApproved(false);
                    $profile->setIsCommitteeRejected(true);
                    $profile->setCommitteeRejectionAt(new \DateTime());
                    $profile->setCommitteeRejectionBy($user);
                    $profile->setCommitteeRejectionReason($comment);
                }

                if ($type == "Bod"){
                    $profile->setIsBoardApproved(false);
                    $profile->setIsBoardRejected(true);
                    $profile->setBoardRejectionAt(new \DateTime());
                    $profile->setBoardRejectionBy($user);
                    $profile->setBoardRejectionReason($comment);
                }

                $twigTemplate = "rejected.htm.twig";
                $accountStatus = "MCSK Portal Profile Status";
            }

            $profile->setStatusDescription($comment);
            $profile->setProcessedBy($user);
            $profile->setProcessedAt(new \DateTime());

            $em->persist($profile);
            $em->flush();

           /* //If All Board Members have approved, notify the user
            if ($profile->getNrCommitteeApprovals()==3) {
                $this->sendEmail($profile->getCompanyName(), $accountStatus, $profile->getEmailAddress(), $twigTemplate, null);
            }*/
            //If All Board Members have approved, notify the user
            if ($profile->getNrCommitteeApprovals()==1 && $profile->getNrBoardApprovals()==1) {
                $users_data =$em->getRepository("AppBundle:User")
                    ->findLastMembershipOrderByDate();

                $last_member_number = null;
                foreach ($users_data as $user_data){
                    $last_member_number = $user_data->getMemberNumber();
                }
                $profile->setMemberNumber($last_member_number+1);
                $approved_user = $em->getRepository("AppBundle:User")
                    ->findOneBy([
                        'corporateProfile'=>$profile->getId()
                    ]);
                $approved_user->setMemberNumber($last_member_number+1);
                $em->persist($profile);
                $em->persist($approved_user);
                $em->flush();
                $this->sendSms("Profile Status: Approved by the MCSK Board

                Congratulations ".$profile->getCompanyName()."!
                Your profile has been successfully reviewed and approved by the MCSK Board of Directors
                You are now a member of MCSK.
                Your Membership Number is ".$profile->getMemberNumber().
                " Thank you!
                
                MCSK Team
                ",$profile->getMobileNumber());
                $this->signDocDeed($request->request->get('doc_name'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->signDocMech($request->request->get('doc_name2'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->sendEmail($profile->getCompanyName(), $accountStatus, $profile->getEmailAddress(), $twigTemplate, $profile->getMemberNumber());
            }
            // return $this->redirectToRoute('membership-approved-profiles');
        }


        return $this->render('admin/profile/corporateBoardReview.htm.twig',[
            'profile'=>$profile,
            'boardReviewForm' => $form->createView()
        ]);
    }

    public function signDocMech($docname,$signature,$boardmembername){

        $pdf = new FPDI();

        $pageCount = $pdf->setSourceFile($this->get('kernel')->getRootDir().'/../web/assets/documents/'.$docname);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplIdx = $pdf->importPage($pageNo);

            // add a page
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx, -10, 20, 210);;

            if($pageNo==2){
                $pdf->SetFont("Arial","",8);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetXY(120, 243);

                $pdf->Image($this->get('kernel')->getRootDir().'/../web/assets/signatures/'.$signature,130,248,25,20);

                $pdf->Write(0,$boardmembername);
            }

        }

        //unlink("../web/assets/documents/".$docname);

        $pdf->Output("../web/assets/documents/".$docname,"F");

    }

    public function signDocDeed($docname,$signature,$boardmembername){

        $pdf = new FPDI();
        $pdf->AddPage();

        $pdf->setSourceFile($this->get('kernel')->getRootDir() .'/../web/assets/documents/'.$docname);

        $tppl = $pdf->importPage(1);

        $pdf->useTemplate($tppl, -10, 20, 210);

        $pdf->SetFont("Arial","",8);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(65, 250);

       // $pdf->Image($this->get('kernel')->getRootDir() .'/../web/assets/signatures/'.$signature,80,255,20,10);

        $pdf->Write(0,$boardmembername);

        //unlink("../web/assets/documents/".$docname);

        $pdf->Output("../web/assets/documents/".$docname,"F");

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
