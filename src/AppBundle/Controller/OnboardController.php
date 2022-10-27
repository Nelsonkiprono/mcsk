<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CorporateProfile;
use AppBundle\Entity\Individual;
use AppBundle\Entity\Onboard;
use AppBundle\Entity\Profile;
use AppBundle\Entity\User;
use AppBundle\Form\CorporateForm;
use AppBundle\Form\IndividualForm;
use AppBundle\Form\OnboardForm;
use AppBundle\Form\RegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SendGrid;
class OnboardController extends Controller  
{
   

    /**
     * @Route("/",name="onboard")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RegistrationForm::class);
        $form->handleRequest($request);
       // $countryCode='254';
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setIsActive(true);
            $user->setRoles(["ROLE_USER"]);
           // $number=$user->getPhoneNumber();
          // $newNumber = preg_replace('/^0?/',$countryCode, $number);
            if($user->getUserType() == "Composer"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Individual");
                $user->setActualRole("Composer");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(), $user->getEmail());
            }elseif ($user->getUserType() == "Arranger"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Individual");
                $user->setActualRole("Arranger");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(), $user->getEmail());
            }elseif ($user->getUserType() == "Author"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Individual");
                $user->setActualRole("Author");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(), $user->getEmail());
            }elseif ($user->getUserType() == "Composer Author Arranger Publisher"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Individual");
                $user->setActualRole("Composer Author Arranger Publisher");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(), $user->getEmail());
            }
            elseif ($user->getUserType() == "Co Author"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Individual");
                $user->setActualRole("Co Author");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(), $user->getEmail());
            }elseif ($user->getUserType() == "Deceased Composer"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($request->request->get('producerNames'));
                $profile->setProducerRelationship($request->request->get('producerRelationship'));
                $profile->setKinFirstName($user->getFirstName());
                $profile->setKinMiddleName($user->getMiddleName());
                $profile->setKinLastName($user->getMiddleName());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Deceased Producer");
                $user->setActualRole("Deceased Composer");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(),$user->getEmail());
            }elseif ($user->getUserType() == "Deceased Arranger"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($request->request->get('producerNames'));
                $profile->setProducerRelationship($request->request->get('producerRelationship'));
                $profile->setKinFirstName($user->getFirstName());
                $profile->setKinMiddleName($user->getMiddleName());
                $profile->setKinLastName($user->getMiddleName());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Deceased Producer");
                $user->setActualRole("Deceased Arranger");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(),$user->getEmail());
            }elseif ($user->getUserType() == "Deceased Author"){
                $profile = new Profile();
                $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $profile->setProducerName($request->request->get('producerNames'));
                $profile->setProducerRelationship($request->request->get('producerRelationship'));
                $profile->setKinFirstName($user->getFirstName());
                $profile->setKinMiddleName($user->getMiddleName());
                $profile->setKinLastName($user->getMiddleName());
                $profile->setPrefferedRegion($user->getRegion());
                $profile->setCreatedAt(new \DateTime());
                $profile->setEmailAddress($user->getEmail());
                $profile->setMobileNumber($user->getPhoneNumber());
                $user->setUserType("Deceased Producer");
                $user->setActualRole("Deceased Author");
                $user->setProfile($profile);
                $em->persist($profile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($user->getfirstName(),$user->getEmail());
            }elseif ($user->getUserType() == "Sub Publisher"){
                $corporateProfile = new CorporateProfile();
                $corporateProfile->setEmailAddress($user->getEmail());
                $corporateProfile->setCreatedAt(new \DateTime());
                $corporateProfile->setCompanyType("Sole Proprietorship");
                //$corporateProfile->setPhysicalAddress("N/A");
                $corporateProfile->setPrefferedRegion($user->getRegion());
                $corporateProfile->setFirstDirectorNames($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $corporateProfile->setMobileNumber($user->getPhoneNumber());
                $corporateProfile->setCompanyName($request->request->get('companyName'));
                $user->setUserType("Sole Proprietorship");
                $user->setActualRole("Sub Publisher");
                $user->setCorporateProfile($corporateProfile);
                $em->persist($corporateProfile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($corporateProfile->getfirstDirectorNames(),$corporateProfile->getEmailAddress());
            }elseif ($user->getUserType() == "Publisher"){
                $corporateProfile = new CorporateProfile();
                $corporateProfile->setEmailAddress($user->getEmail());
                $corporateProfile->setCreatedAt(new \DateTime());
                $corporateProfile->setCompanyType("Sole Proprietorship");
                //$corporateProfile->setPhysicalAddress("N/A");
                $corporateProfile->setPrefferedRegion($user->getRegion());
                $corporateProfile->setFirstDirectorNames($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $corporateProfile->setMobileNumber($user->getPhoneNumber());
                $corporateProfile->setCompanyName($request->request->get('companyName'));
                $user->setUserType("Sole Proprietorship");
                $user->setActualRole("Publisher");
                $user->setCorporateProfile($corporateProfile);
                $em->persist($corporateProfile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($corporateProfile->getfirstDirectorNames(),$corporateProfile->getEmailAddress());
            }else {
                $corporateProfile = new CorporateProfile();
                $corporateProfile->setEmailAddress($user->getEmail());
                $corporateProfile->setCreatedAt(new \DateTime());
                $corporateProfile->setCompanyType("Limited Company");
                //$corporateProfile->setPhysicalAddress("N/A");
                $corporateProfile->setPrefferedRegion($user->getRegion());
                $corporateProfile->setFirstDirectorNames($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
                $corporateProfile->setMobileNumber($user->getPhoneNumber());
                $corporateProfile->setCompanyName($request->request->get('companyName'));
                $user->setUserType("Limited Company");
                $user->setActualRole("Limited Company Publisher");
                $user->setCorporateProfile($corporateProfile);
                $em->persist($corporateProfile);
                $em->persist($user);
                $em->flush();
                $this->sendWelcomeEmail($corporateProfile->getfirstDirectorNames(),$corporateProfile->getEmailAddress());
            }

            return $this->redirectToRoute('onboarded');
        }
        return $this->render('onboard/register.htm.twig', ['onboardForm' => $form->createView()]);
    }

    /**
     * @Route("/start/individual",name="onboard-individual")
     */
    public function individualAction(Request $request)
    {
        $individual = new Individual();
        $individual->setCreatedAt(new \DateTimeImmutable());
        $form = $this->createForm(IndividualForm::class, $individual);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $onboard = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($onboard);
            $em->flush();
            $this->sendIndividualWelcomeEmail($onboard->getfirstName(), $onboard->getEmail(), $onboard->getId());
            return $this->redirectToRoute('onboarded');
        } else {
            $errors = $form->getErrors();
        }
        return $this->render('onboard/onboard.htm.twig', ['onboardForm' => $form->createView()]);
    }

    /**
     * @Route("/start/corporate",name="onboard-corporate")
     */
    public function corporateAction(Request $request)
    {
        $onboard = new Onboard();
        $onboard->setCreatedAt(new \DateTimeImmutable());
        $form = $this->createForm(CorporateForm::class, $onboard);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $onboard = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($onboard);
            $em->flush();
            $this->sendWelcomeEmail($onboard->getfirstDirectorNames(), $onboard->getEmail(), $onboard->getId());
            return $this->redirectToRoute('onboarded');
        } else {
            $errors = $form->getErrors();
        }
        return $this->render('onboard/corporate.htm.twig', ['onboardForm' => $form->createView()]);
    }

    /**
     * @Route("/onboarded",name="onboarded")
     */
    public function onboardedAction()
    {
        return $this->render('onboard/onboarded.htm.twig');
    }

    /**
     * @Route("/transaction/update/{transactionId}",name="update-mpesa")
     */
    public function mpesaPaymentSuccessAction(Request $request, $transactionId)  
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:Profile")->findOneBy(['referenceId' => $transactionId]);
        if ($user) {
            $data = json_decode(file_get_contents('php://input'), true);
            $resultCode = $data['Body']['stkCallback']['ResultCode'];
            $resultDesc = $data['Body']['stkCallback']['ResultDesc'];
            $user->setMpesaDescription($resultDesc);
            $transactionArray = array();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $user->setMpesaProcessed(true);
                $user->setMpesaAmount($amount);
                $user->setMpesaVerificationCode($mpesaCode);
                $user->setMpesaStatus('Success');
                $user->setMpesaNumber($phoneNumber);
                $user->setIsPaid(true);
                $user->setMpesaPaymentDate(new \DateTime());
                $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);

            } elseif ($resultCode == 1032) {
                $user->setMpesaStatus("Cancelled");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            } else {
                $user->setMpesaStatus("Failed");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            }
            $em->persist($user);
            $em->flush();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $this->sendSms("
                Payment Successful!

                Hello ".$user->getFirstName()."
                Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                
                A member of our team will be in touch to update you during the review process.
                
                Thank you!

                MCSK Team"
                    ,$phoneNumber);
                $this->sendPaymentEmail($user->getFirstName(), $user->getEmailAddress(), $transactionArray);
            }
        } else {
            $user = $em->getRepository("AppBundle:CorporateProfile")->findOneBy(['referenceId' => $transactionId]);
            $data = json_decode(file_get_contents('php://input'), true);
            $resultCode = $data['Body']['stkCallback']['ResultCode'];
            $resultDesc = $data['Body']['stkCallback']['ResultDesc'];
            $user->setMpesaDescription($resultDesc);
            $transactionArray = array();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $user->setMpesaProcessed(true);
                $user->setMpesaAmount($amount);
                $user->setMpesaVerificationCode($mpesaCode);
                $user->setMpesaStatus('Success');
                $user->setMpesaNumber($phoneNumber);
                $user->setIsPaid(true);
                $user->setMpesaPaymentDate(new \DateTime());
                $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);

            } elseif ($resultCode == 1032) {
                $user->setMpesaStatus("Cancelled");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            } else {
                $user->setMpesaStatus("Failed");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            }
            $em->persist($user);
            $em->flush();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $this->sendSms("
                Payment Successful!

                Hello ".$user->getFirstName()."
                Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                
                A member of our team will be in touch to update you during the review process.
                
                Thank you!

                MCSK Team"
                    ,$phoneNumber);
                $this->sendPaymentEmail($user->getFirstName(), $user->getEmailAddress(), $transactionArray);
            }
        }
        return new Response(null, 200);
    }
   /**
     * @Route("/payment/received/{transactionId}",name="update-mpesa")
     */
    public function paymentSuccessAction(Request $request, $transactionId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:Profile")->findOneBy(['referenceId' => $transactionId]);
        if ($user) {
            $data = json_decode(file_get_contents('php://input'), true);
            $resultCode = $data['Body']['stkCallback']['ResultCode'];
            $resultDesc = $data['Body']['stkCallback']['ResultDesc'];
            $user->setMpesaDescription($resultDesc);
            $transactionArray = array();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $user->setMpesaProcessed(true);
                $user->setMpesaAmount($amount);
                $user->setMpesaVerificationCode($mpesaCode);
                $user->setMpesaStatus('Success');
                $user->setMpesaNumber($phoneNumber);
                $user->setIsPaid(true);
                $user->setMpesaPaymentDate(new \DateTime());
                $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);

            } elseif ($resultCode == 1032) {
                $user->setMpesaStatus("Cancelled");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            } else {
                $user->setMpesaStatus("Failed");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            }
            $em->persist($user);
            $em->flush();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $this->sendSms("
                Payment Successful!

                Hello ".$user->getFirstName()."
                Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                
                A member of our team will be in touch to update you during the review process.
                
                Thank you!

                MCSK Team"
                    ,$phoneNumber);
                $this->sendPaymentEmail($user->getUser()->getFirstName(), $user->getEmailAddress(), $transactionArray);
            }
        } else {
            $user = $em->getRepository("AppBundle:CorporateProfile")->findOneBy(['referenceId' => $transactionId]);
            $data = json_decode(file_get_contents('php://input'), true);
            $resultCode = $data['Body']['stkCallback']['ResultCode'];
            $resultDesc = $data['Body']['stkCallback']['ResultDesc'];
            $user->setMpesaDescription($resultDesc);
            $transactionArray = array();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $user->setMpesaProcessed(true);
                $user->setMpesaAmount($amount);
                $user->setMpesaVerificationCode($mpesaCode);
                $user->setMpesaStatus('Success');
                $user->setMpesaNumber($phoneNumber);
                $user->setIsPaid(true);
                $user->setMpesaPaymentDate(new \DateTime());
                $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);

            } elseif ($resultCode == 1032) {
                $user->setMpesaStatus("Cancelled");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            } else {
                $user->setMpesaStatus("Failed");
                $user->setIsPaid(false);
                $user->setMpesaProcessed(true);
            }
            $em->persist($user);
            $em->flush();
            if ($resultCode == 0) {
                $item = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
                $amount = $item[0]['Value'];
                $mpesaCode = $item[1]['Value'];
                $transDate = $item[3]['Value'];
                $phoneNumber = $item[4]['Value'];
                $this->sendSms("
                Payment Successful!

                Hello ".$user->getFirstName()."
                Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                
                A member of our team will be in touch to update you during the review process.
                
                Thank you!

                MCSK Team"
                    ,$phoneNumber);
                $this->sendPaymentEmail($user->getUser()->getFirstName(), $user->getEmailAddress(), $transactionArray);
            }
        }
        return new Response(null, 200);
    }
    public function sendWelcomeEmail($firstName, $emailAddress)
    {
        $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
        /**$message = \Swift_Message::newInstance()
            ->setSubject('MCSK Online Portal Registration')
            ->setFrom('portal@mcsk.or.ke', 'MCSK Online Portal Team')
            ->setTo($emailAddress)
            ->setBody(
                $this->renderView(
                    'Emails/corporate.htm.twig',
                    array(
                        'name' => $firstName,
                        )
                ),
                'text/html');
        $this->get('mailer')->send($message);
        **/
        $body=$this->renderView(
                    'Emails/corporate.htm.twig',
                    array(
                        'name' => $firstName,
                        )
                );

$from = new SendGrid\Email(null, "membership@mcsk.or.ke");
$subject = "MCSK Online Portal Registration";
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
//echo $response->statusCode();
//echo $response->headers();
//echo $response->body();

    }

    public function sendIndividualWelcomeEmail($firstName, $emailAddress, $code)
    {
      $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
    /**
        $message = \Swift_Message::newInstance()
            ->setSubject('MCSK Online Portal Registration')
            ->setFrom('portal@mcsk.or.ke', 'MCSK Online Portal Team')
            ->setTo($emailAddress)
            ->setBody(
                $this->renderView(
                'Emails/onboard.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                ),
                'text/html');
        $this->get('mailer')->send($message); **/
        $body=$this->renderView(
                'Emails/onboard.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "membership@mcsk.or.ke");
$subject = "MCSK Online Portal Registration";
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
    }
    public function sendPaymentEmail($firstName, $emailAddress, $code)
    {
       /** $message = \Swift_Message::newInstance()
            ->setSubject('MCSK Online Portal Profile')
            ->setFrom('portal@mcsk.or.ke', 'MCSK Online Portal Team')
            ->setTo($emailAddress)
            ->setBody(
                $this->renderView(
            'Emails/paid.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                ),
                'text/html');
        $this->get('mailer')->send($message);**/
        $body=$this->renderView(
            'Emails/paid.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "membership@mcsk.or.ke");
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
