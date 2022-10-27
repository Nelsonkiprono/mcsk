<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\CorporateProfile;
use AppBundle\Entity\Profile;
use AppBundle\Form\CorporateReviewForm;
use AppBundle\Form\ProfileReviewForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use SendGrid;

/**
 * @Route("/board")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class BoardController extends Controller
{

    /**
     * @Route("/profile/{id}/review",name="board-review-profile")
     */
    public function boardProfileReviewAction(Request $request, Profile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $thSis->getDoctrine()->getManager();

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
                }/**elseif ($nrApprovals == 1){
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

            //If All Board Members have approved, notify the user
            if ($profile->getNrCommitteeApprovals()==1 && $profile->getNrBoardApprovals()==1) {
                /*$profile->setMemberNumber();*/
                $this->sendSms("Profile Status: Approved by the MCSK Board

                Congratulations ".$profile->getApplicantName()."!
                Your profile has been successfully reviewed and approved by the MCSK Board of Directors
                An account will be created for you on the MCSK online Portal and we will send you an email with login instructions.
                
                Thank you!
                
                MCSK Team
                ",$profile->getMobileNumber());
                $this->signDocDeed($request->request->get('doc_name'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->signDocMech($request->request->get('doc_name2'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->sendEmail($profile->getFirstName(), $accountStatus, $profile->getEmailAddress(), $twigTemplate, null);
            }
            return $this->redirectToRoute('membership-approved-profiles');
        }
        return $this->render('admin/profile/boardReview.htm.twig',[
            'profile'=>$profile,
            'boardReviewForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/corporate/{id}/review",name="board-review-profile")
     */
    public function reviewCorporateAction(Request $request, CorporateProfile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CorporateReviewForm::class);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){

            $comment = $request->request->get('comment');
            $approval = $request->request->get('approval');

            if ($approval =="Approved"){

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
                $profile->setIsBoardApproved(false);
                $profile->setIsBoardRejected(true);
                $profile->setBoardRejectionAt(new \DateTime());
                $profile->setBoardRejectionBy($user);
                $profile->setBoardRejectionReason($comment);

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
                $this->sendSms("Profile Status: Approved by the MCSK Board

                Congratulations ".$profile->getApplicantName()."!
                Your profile has been successfully reviewed and approved by the MCSK Board of Directors
                An account will be created for you on the MCSK online Portal and we will send you an email with login instructions.
                
                Thank you!
                
                MCSK Team
                ",$profile->getMobileNumber());
                $this->signDocDeed($request->request->get('doc_name'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->signDocMech($request->request->get('doc_name2'),$user->getSignatureFile(),$user->getFirstName()." ".$user->getLastName());
                $this->sendEmail($profile->getCompanyName(), $accountStatus, $profile->getEmailAddress(), $twigTemplate, null);
            }
            return $this->redirectToRoute('membership-approved-profiles');
        }
        return $this->render('admin/profile/corporateBoardReview.htm.twig',[
            'profile'=>$profile,
            'boardReviewForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/users/applications/actors",name="membership-approved-actor-profiles")
     */
    public function membershipApprovedProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllMembershipApprovedActorProfilesOrderByDate();

        return $this->render('admin/membership-approved.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/users/applications/music",name="membership-approved-music-profiles")
     */
    public function membershipApprovedMusicianProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllMembershipApprovedMusicianProfilesOrderByDate();

        return $this->render('admin/membership-approved.htm.twig',[
            'users'=>$users
        ]);
    }
    protected function sendEmail($firstName,$subject,$emailAddress,$twigTemplate,$code){
        /**$message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('portal@mcsk.or.ke','MCSK Online Portal Team')
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

$from = new SendGrid\Email(null, "portal@mcsk.or.ke");
//$subject = $subject;
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);

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

        $pdf->setSourceFile($this->get('kernel')->getRootDir().'/../web/assets/documents/'.$docname);

        $tppl = $pdf->importPage(1);

        $pdf->useTemplate($tppl, -10, 20, 210);

        $pdf->SetFont("Arial","",8);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(65, 250);

        $pdf->Image($this->get('kernel')->getRootDir().'/../web/assets/signatures/'.$signature,80,255,20,10);

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
