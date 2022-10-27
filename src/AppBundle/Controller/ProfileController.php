<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CorporateProfile;
use AppBundle\Entity\Documents;
use AppBundle\Entity\Individual;
use AppBundle\Entity\Music;
use AppBundle\Entity\NextOfKin;
use AppBundle\Entity\Onboard;
use AppBundle\Entity\Profile;
use AppBundle\Entity\User;
use AppBundle\Form\CorporateProfileForm;
use AppBundle\Form\DocumentsFormType;
use AppBundle\Form\LoginForm;
use AppBundle\Form\MpesaFormType;
use AppBundle\Form\NewRecordingForm;
use AppBundle\Form\ProfileForm;
use Crysoft\MpesaBundle\Helpers\Mpesa;
use Crysoft\MpesaBundle\Helpers\Mpesax;
use Crysoft\MpesaBundle\Helpers\MpesaStatus;
use DoctrineExtensions\Query\Mysql\Date;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Console\Helper\ProgressBar;
use SendGrid;

class ProfileController extends Controller
{
    /**
     * @Route("profile/login",name="prof_login")
     */
    public function loginIndex()
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
            'profile/login.htm.twig',
            array(
                'loginForm' => $form->createView(),
                'error' => $error,
            ));
    }

    /**
     * @Route("profile/reg",name="reg")
     */
    public function regIndex()
    {
        return $this->render('profile/register.htm.twig');
    }
    /**
     * @Route("/profile/first_reg_submit", name="first_reg_submit", methods={"POST"})
     */
    public function first_reg_submit(Request $request)
    {
        $user_type = $request->request->get('acc_type');
        $user_company_name = $request->request->get('company_name');
        $user_fname = $request->request->get('fname');
        $user_sname = $request->request->get('sname');
        $user_lname = $request->request->get('lname');
        $user_phone = $request->request->get('phone');
        $user_email = $request->request->get('email');
        $user_password = $request->request->get('password');
        $user_cpassword = $request->request->get('cpassword');

        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setUserType($user_type);
        $user->setPhoneNumber($user_phone);
        //$user->setProfile($profile);
        //$user->setProducerRelationship($producerRelationship;
        //$user->setCorporateProfile($corporateProfile);
        $user->setRoles(["ROLE_USER"]);
        $user->setFirstName($user_fname);
        $user->setLastName($user_lname);
        $user->setMiddleName($user_sname);
        $user->setEmail($user_email);
        $user->setPlainPassword($user_password);
        $user->setPassword($user_password);
        $user->setIsActive(true);
        //$user->setLastLoginTime($lastLoginTime);
        $user->setAccountCreatedAt(new \DateTime());
        $user->setIsPasswordCreated(1);
        //$user->setPasswordResetToken($passwordResetToken);
        //$user->setIsResetTokenValid($isResetTokenValid);
        //$user->setAccountCreatedBy($accountCreatedBy);
        //$user->setApprovedBy($approvedBy);
        $user->setIsTermsAccepted(1);

        if ($user->getUserType() == "Composer" or $user->getUserType() == "Author" or $user->getUserType() == "Arranger") {
            $profile = new Profile();
            $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
            $profile->setProducerName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
            $profile->setCreatedAt(new \DateTime());
            $profile->setEmailAddress($user->getEmail());
            $profile->setMobileNumber($user->getPhoneNumber());
            $user->setProfile($profile);
            $em->persist($profile);
            $em->persist($user);
            $em->flush();
            $this->sendWelcomeEmail($user->getfirstName(), $user->getEmail());

        } elseif ($user->getUserType() == "Deceased Producer") {
            $profile = new Profile();
            $profile->setApplicantName($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
            $profile->setProducerName($request->request->get('producerNames'));
            $profile->setProducerRelationship($request->request->get('producerRelationship'));
            $profile->setKinFirstName($user->getFirstName());
            $profile->setKinMiddleName($user->getMiddleName());
            $profile->setKinLastName($user->getMiddleName());
            $profile->setCreatedAt(new \DateTime());
            $profile->setEmailAddress($user->getEmail());
            $profile->setMobileNumber($user->getPhoneNumber());
            $user->setProfile($profile);
            $em->persist($profile);
            $em->persist($user);
            $em->flush();

            $this->sendWelcomeEmail($user->getfirstName(),$user->getEmail());
        } else {
            $corporateProfile = new CorporateProfile();
            $corporateProfile->setEmailAddress($user->getEmail());
            $corporateProfile->setCreatedAt(new \DateTime());
            $corporateProfile->setCompanyType($user->getUserType());
            //$corporateProfile->setPhysicalAddress("N/A");
            $corporateProfile->setFirstDirectorNames($user->getFirstName() . ' ' . $user->getMiddleName() . ' ' . $user->getLastName());
            $corporateProfile->setMobileNumber($user->getPhoneNumber());
            $corporateProfile->setCompanyName($user_company_name);
            $user->setCorporateProfile($corporateProfile);
            $em->persist($corporateProfile);
            $em->persist($user);
            $em->flush();

            $this->sendWelcomeEmail($corporateProfile->getfirstDirectorNames(),$corporateProfile->getEmailAddress());
        }
        return $this->redirectToRoute('prof_login');
    }
    /**
     * @Route("profile/account_registration",name="account_registration")
     */
    public function test()
    {
    }
    /**
     * @Route("profile/account_registration_submit",name="account_registration_submit", methods={"POST"})
     */
    public function submitAccReg(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        if($request->request->get('step1') == 1){
            $member_pseudonym = $request->request->get('member_pseudonym');
            $member_dob = $request->request->get('member_dob');
            $member_pob = $request->request->get('member_pob');
            $member_nationality = $request->request->get('member_nationality');
            $member_cor = $request->request->get('member_cor');
            $maritalcbx = $request->request->get('maritalcbx');
            $gendercbx = $request->request->get('gendercbx');
            $member_national_id = $request->request->get('member_national_id');

            $member_address = $request->request->get('member_address');
            $member_postcode = $request->request->get('member_postcode');
            $member_town = $request->request->get('member_town');
            $member_tel = $request->request->get('member_tel');
            $member_mobile = $request->request->get('member_mobile');
            $member_email = $request->request->get('member_email');
            $member_aemail = $request->request->get('member_aemail');
            $member_pr = $request->request->get('member_pr');


            $mscbx = $request->request->get('mscbx');

            $member_territorial_assignment = $request->request->get('member_territorial_assignment');

            $member_bank_name = $request->request->get('member_bank_name');
            $member_bank_address = $request->request->get('member_bank_address');
            $member_bank_accno = $request->request->get('member_bank_accno');
            $member_bank_branch = $request->request->get('member_bank_branch');
            $member_bank_code = $request->request->get('member_bank_code');
            $member_bank_swift_code = $request->request->get('member_bank_swift_code');

            $member_kra_pin = $request->request->get('member_kra_pin');

            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$user->getProfile()->getId()
                ]);


            $profile->setCounty($member_town);
            if($mscbx=="Yes"){
                $member_society_details = $request->request->get('member_society_details');
                $member_society_number  = $request->request->get('member_society_number');
                $profile->setCollectingSocieties($member_society_details);
                $profile->setCollectingSocietiesNumber($member_society_number);
                $profile->setIsCollectingSocietiesMember('1');
            }else{
                $profile->setIsCollectingSocietiesMember('0');
            }

            $profile->setPseudonym($member_pseudonym);
            $profile->setPlaceOfBirth($member_pob);
            $profile->setNationality($member_nationality);
            $profile->setCountryOfResidence($member_cor);
            $profile->setTerritorialAssignment($member_territorial_assignment);
            $profile->setMarialStatus($maritalcbx);
            $profile->setBankCode($member_bank_code);
            $profile->setBankAddress($member_bank_address);
            $profile->setItaxPin($member_kra_pin);
            $profile->setPaymentMpesaNumber($member_mobile);
            $profile->setSwiftCode($member_bank_swift_code);
            $profile->setBankBranch($member_bank_branch);
            $profile->setPostalCode($member_postcode);
            $profile->setProgress('next of kin');
            $profile->setEmailAddress($member_email);
            $profile->setAccountNumber($member_bank_accno);
            $profile->setEmailAddress2($member_aemail);
            $profile->setPhysicalAddress($member_address);
            $profile->setCity($member_town);
            $profile->setDateOfBirth(new \DateTime($member_dob));
            $profile->setBank($member_bank_name);
            $profile->setMobileNumber($member_mobile);
            $profile->setGender($gendercbx);
            $profile->setTelephoneNumber($member_tel);
            $profile->setPostalAddress($member_address);
            $profile->setIdNumber($member_national_id);

            $em->persist($profile);
            $em->flush();

            return new JsonResponse(array('status' => 'success'));
        }elseif ($request->request->get('step2') == 2){
            $member_contact_fname = $request->request->get('member_contact_fname');
            $member_contact_sname = $request->request->get('member_contact_sname');
            $member_contact_lname = $request->request->get('member_contact_lname');
            $member_contact_email = $request->request->get('member_contact_email');
            $member_contact_tel = $request->request->get('member_contact_tel');
            $member_contact_id = $request->request->get('member_contact_id');
            $member_relationship = $request->request->get('member_relationship');
            $kingendercbx = $request->request->get('kingendercbx');
            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$user->getProfile()->getId()
                ]);

           $profile->setKinMiddleName($member_contact_sname);
           $profile->setKinFirstName($member_contact_fname);
           $profile->setKinLastName($member_contact_lname);
           $profile->setKinRelationship($member_relationship);
           $profile->setKinIdNumber($member_contact_id);
           //$profile->setKinDateOfBirth($kinDateOfBirth);
           $profile->setKinGender($kingendercbx);
           //$profile->setKinPhysicalAddress($kinPhysicalAddress);
           //$profile->setKinCity($kinCity);
           //$profile->setKinCounty($kinCounty);
           //$profile->setKinPostalAddress($kinPostalAddress);
           //$profile->setKinPostalCode($kinPostalCode);
           $profile->setKinTelephoneNumber($member_contact_tel);
           $profile->setKinMobileNumber($member_contact_tel);
           $profile->setKinEmailAddress($member_contact_email);
           //$profile->setKinGuardian($kinGuardian);

           $em->persist($profile);
           $em->flush();

           return new JsonResponse(array('status' => 'success'));
        }elseif ($request->request->get('step3') == 3){

            $member_passport_pic =  $request->files->get('member_passport_pic');
            $member_kra_cert =  $request->files->get('member_kra_cert');
            $member_id_front = $request->files->get('member_id_front');
            $member_id_back = $request->files->get('member_id_back');
            $member_kin_id_front = $request->files->get('member_kin_id_front');
            $member_kin_id_back = $request->files->get('member_kin_id_back');

            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$user->getProfile()->getId()
                ]);

            if(!is_null($member_passport_pic)){
                $documents = new Documents();
                $documents->setDocumentFileName(round(microtime(true)));
                $documents->setWhichProfile($profile);
                $documents->setDocumentName('PASSPORT-PHOTO');
                $documents->setDocumentFile($member_passport_pic);
                $em_doc = $this->getDoctrine()->getManager();
                $em_doc->persist($documents);
                $em_doc->flush();

                return new JsonResponse(array('status' => 'success'));
            }


            $profileDocs = $profile->getProfileDocuments();

            if(count($profileDocs)==0){
                /*$documents = new Documents();
                $documents->setDocumentFileName(round(microtime(true)));
                $documents->setWhichProfile($profile);
                $documents->setDocumentName('PASSPORT-PHOTO');
                $documents->setDocumentFile($member_passport_pic);
                $em_doc = $this->getDoctrine()->getManager();
                $em_doc->persist($documents);
                $em_doc->flush();*/

                /*$documents2 = new Documents();
                $documents2->setDocumentFileName(round(microtime(true)));
                $documents2->setWhichProfile($profile);
                $documents2->setDocumentName('NATIONAL-ID-COPY');
                $documents2->setDocumentFile($member_id_front);
                $em_doc2 = $this->getDoctrine()->getManager();
                $em_doc2->persist($documents2);
                $em_doc2->flush();

                $documents3 = new Documents();
                $documents3->setDocumentFileName(round(microtime(true)));
                $documents3->setWhichProfile($profile);
                $documents3->setDocumentName('NATIONAL-ID-COPY-BACK');
                $documents3->setDocumentFile($member_id_back);
                $em_doc3 = $this->getDoctrine()->getManager();
                $em_doc3->persist($documents3);
                $em_doc3->flush();

                $documents4 = new Documents();
                $documents4->setDocumentFileName(round(microtime(true)));
                $documents4->setWhichProfile($profile);
                $documents4->setDocumentName('KRA-CERTIFICATE');
                $documents4->setDocumentFile($member_kra_cert);
                $em_doc4 = $this->getDoctrine()->getManager();
                $em_doc4->persist($documents4);
                $em_doc4->flush();

                $documents5 = new Documents();
                $documents5->setDocumentFileName(round(microtime(true)));
                $documents5->setWhichProfile($profile);
                $documents5->setDocumentName('KIN-ID');
                $documents5->setDocumentFile($member_kin_id_front);
                $em_doc5 = $this->getDoctrine()->getManager();
                $em_doc5->persist($documents5);
                $em_doc5->flush();

                $documents6 = new Documents();
                $documents6->setDocumentFileName(round(microtime(true)));
                $documents6->setWhichProfile($profile);
                $documents6->setDocumentName('KIN-ID-BACK');
                $documents6->setDocumentFile($member_kin_id_back);
                $em_doc6 = $this->getDoctrine()->getManager();
                $em_doc6->persist($documents6);
                $em_doc6->flush();*/


            }



        }


        return new JsonResponse(array('status' => $request->request->get('member_pseudonym')));
    }
    /**
     * @Route("/profile/reg/pay", name="reg_pay", methods={"POST"})
     */
    public function submitPayment(Request $request)
    {


    }

    /**
     * @Route("/profile/reg/pay/{transactionId}pay", name="reg_pay_pay")
     */
    public function checkstatusAction(Request $request)
    {

        //Use the same Mpesa Class as before
        $mpesa = new Mpesa($this->container);

        //Chain the requests. Note this Transaction ID has to be the EXACT same one you used for the Mpesa Transaction request above.
        $response = $mpesa->usingTransactionId($request->request->get('transactionId'))->requestStatus();

        //And just to make your life easier we created another class in the Bundle to run through the response from Mpesa and give you the Status

        //Use the response above and pass it to the Bundle's MpesaStatus Class
        $mpesaStatus = new MpesaStatus($response);

        //Use the Classes Getter methods to get the Bits in the Response. Here is an example of how to do it

        $customerNumber             =       $mpesaStatus->getCustomerNumber();
        $transactionAmount          =       $mpesaStatus->getTransactionAmount();
        $transactionStatus          =       $mpesaStatus->getTransactionStatus();
        $transactionDate            =       $mpesaStatus->getTransactionDate();
        $mPesaTransactionId         =       $mpesaStatus->getMpesaTransactionId();
        $merchantTransactionId      =       $mpesaStatus->getMerchantTransactionId();
        $transactionDescription     =       $mpesaStatus->getTransactionDescription();

        return new Response(
            [
                "transactionId" => $request->request->get('transactionId'),
                "customernumber" => $customerNumber,
                "transactionAmount" =>$transactionAmount,
                "transactionStatus" =>$transactionStatus,
                "transactionDate" =>$transactionDate,
                "mPesaTransactionId" =>$mPesaTransactionId,
                "merchantTransactionId" =>$merchantTransactionId,
                "transactionDescription" =>$transactionDescription,]
        );
    }
    /**
     * @Route("/profile/reg/submit", name="reg_submit", methods={"POST"})
     */
    public function submitReg(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        if($request->request->has('member_pseudonym')){
            $member_sname = $request->request->get('member_sname');
            $member_fname = $request->request->get('member_fname');
            $member_pseudonym = $request->request->get('member_pseudonym');
            $member_dob = $request->request->get('member_dob');
            $member_pob = $request->request->get('member_pob');
            $member_nationality = $request->request->get('member_nationality');
            $member_cor = $request->request->get('member_cor');
            $maritalcbx = $request->request->get('maritalcbx');
            $gendercbx = $request->request->get('gendercbx');
            $member_national_id = $request->request->get('member_national_id');
            $member_address = $request->request->get('member_address');
            $member_postcode = $request->request->get('member_postcode');
            $member_town = $request->request->get('member_town');
            $member_tel = $request->request->get('member_tel');
            $member_mobile = $request->request->get('member_mobile');
            $member_email = $request->request->get('member_email');
            $member_aemail = $request->request->get('member_aemail');
            $member_pr = $request->request->get('member_pr');
            $member_category = $request->request->get('member_category');
            $mscbx = $request->request->get('mscbx');

            $member_territorial_assignment = $request->request->get('member_territorial_assignment');

            $member_bank_name = $request->request->get('member_bank_name');
            $member_bank_address = $request->request->get('member_bank_address');
            $member_bank_accno = $request->request->get('member_bank_accno');
            $member_bank_branch = $request->request->get('member_bank_branch');
            $member_bank_code = $request->request->get('member_bank_code');
            $member_bank_swift_code = $request->request->get('member_bank_swift_code');

            $member_contact_fname = $request->request->get('member_contact_fname');
            $member_contact_sname = $request->request->get('member_contact_sname');
            $member_contact_lname = $request->request->get('member_contact_lname');
            $member_contact_email = $request->request->get('member_contact_email');
            $member_contact_tel = $request->request->get('member_contact_tel');
            $member_contact_id = $request->request->get('member_contact_id');
            $member_relationship = $request->request->get('member_relationship');
            $kingendercbx = $request->request->get('kingendercbx');

            $member_kra_pin = $request->request->get('member_kra_pin');

            $mecbx = $request->request->get('mecbx');
            $mradiocbx = $request->request->get('mradiocbx');

            $member1_music = $request->files->get('member1_music');
            $member2_music = $request->files->get('member2_music');
            $member3_music = $request->files->get('member3_music');

            $member_passport_pic =  $request->files->get('member_passport_pic');
            $member_kra_cert =  $request->files->get('member_kra_cert');
            $member_id_front = $request->files->get('member_id_front');
            $member_id_back = $request->files->get('member_id_back');
            $member_kin_id_front = $request->files->get('member_kin_id_front');
            $member_work_declaration_form = $request->files->get('member_work_declaration_form');

            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$user->getProfile()->getId()
                ]);

            $profile->setPseudonym($member_pseudonym);
            $profile->setPrefferedRegion($member_pr);
            $profile->setPlaceOfBirth($member_pob);
            $profile->setNationality($member_nationality);
            $profile->setCountryOfResidence($member_cor);
            $profile->setTerritorialAssignment($member_territorial_assignment);
            $profile->setMarialStatus($maritalcbx);
            $profile->setCounty($member_town);
            $profile->setKinRelationship($member_relationship);

            if($mscbx=="Yes"){
                $member_society_details = $request->request->get('member_society_details');
                $member_society_number  = $request->request->get('member_society_number');
                $profile->setCollectingSocieties($member_society_details);
                $profile->setCollectingSocietiesNumber($member_society_number);
                $profile->setIsCollectingSocietiesMember('1');
            }else{
                $profile->setIsCollectingSocietiesMember('0');
            }

            $profile->setBankCode($member_bank_code);
            $profile->setItaxPin($member_kra_pin);
            $profile->setKinGender($kingendercbx);
            $profile->setPaymentMpesaNumber($member_mobile);
            $profile->setSwiftCode($member_bank_swift_code);
            $profile->setBankBranch($member_bank_branch);
            $profile->setBankAddress($member_bank_address);
            $profile->setPostalCode($member_postcode);
            $profile->setKinFirstName($member_contact_fname);
            $profile->setKinLastName($member_contact_lname);
            $profile->setKinMiddleName($member_contact_sname);
            $profile->setKinEmailAddress($member_contact_email);
            $profile->setKinIdNumber($member_contact_id);
            $profile->setEmailAddress($member_email);
            $profile->setAccountNumber($member_bank_accno);
            $profile->setApplicantName($member_fname.' '.$member_sname);


            $profile->setEmailAddress2($member_aemail);
            $profile->setPhysicalAddress($member_address);
            $profile->setCity($member_town);
            $profile->setProgress('Payment');
            $profile->setDateOfBirth(new \DateTime($member_dob));
            $profile->setBank($member_bank_name);
            $profile->setMobileNumber($member_mobile);
            $profile->setAccountName($member_fname.$member_sname);
            $profile->setKinTelephoneNumber($member_contact_tel);
            $profile->setGender($gendercbx);
            $profile->setTelephoneNumber($member_tel);
            $profile->setPostalAddress($member_address);
            $profile->setKinMobileNumber($member_contact_tel);
            $profile->setIdNumber($member_national_id);
            $em_prof = $this->getDoctrine()->getManager();
            $em_prof->persist($profile);
            $em_prof->flush();

            $documents4 = new Documents();
           // $documents4->setDocumentFileName(round(microtime(true)));
            $documents4->setWhichProfile($profile);
            $documents4->setDocumentName('PASSPORT-PHOTO');
            $documents4->setDocumentFile($member_passport_pic);
            $em_doc4 = $this->getDoctrine()->getManager();
            $em_doc4->persist($documents4);
            $em_doc4->flush();

            $documents9 = new Documents();
           // $documents9->setDocumentFileName(round(microtime(true)));
            $documents9->setWhichProfile($profile);
            $documents9->setDocumentName('WORK-DECLARATION-FORM');
            $documents9->setDocumentFile($member_work_declaration_form);
            $em_doc9 = $this->getDoctrine()->getManager();
            $em_doc9->persist($documents9);
            $em_doc9->flush();

            $documents5 = new Documents();
            $documents5->setWhichProfile($profile);
            $documents5->setDocumentName('NATIONAL-ID-COPY');
            $documents5->setDocumentFile($member_id_front);
            $em_doc5 = $this->getDoctrine()->getManager();
            $em_doc5->persist($documents5);
            $em_doc5->flush();

            $documents6 = new Documents();
            $documents6->setWhichProfile($profile);
            $documents6->setDocumentName('NATIONAL-ID-COPY-BACK');
            $documents6->setDocumentFile($member_id_back);
            $em_doc6 = $this->getDoctrine()->getManager();
            $em_doc6->persist($documents6);
            $em_doc6->flush();

            $documents7 = new Documents();
            $documents7->setWhichProfile($profile);
            $documents7->setDocumentName('KRA-CERTIFICATE');
            $documents7->setDocumentFile($member_kra_cert);
            $em_doc7 = $this->getDoctrine()->getManager();
            $em_doc7->persist($documents7);
            $em_doc7->flush();

            $documents8 = new Documents();
            $documents8->setWhichProfile($profile);
            $documents8->setDocumentName('NEXT-OF-KIN-CERTIFICATE');
            $documents8->setDocumentFile($member_kin_id_front);
            $em_doc8 = $this->getDoctrine()->getManager();
            $em_doc8->persist($documents8);
            $em_doc8->flush();

            /*$documents9 = new Documents();
            $documents9->setDocumentFileName(round(microtime(true)));
            $documents9->setWhichProfile($profile);
            $documents9->setDocumentName('KIN-ID-BACK');
            $documents9->setDocumentFile($member_kin_id_back9);
            $em_doc9 = $this->getDoctrine()->getManager();
            $em_doc9->persist($documents6);
            $em_doc9->flush();*/


            $next_of_kin = $em->getRepository("AppBundle:NextOfKin")
                ->findOneBy([
                    'profileKin'=>$user->getProfile()->getId()
                ]);

            if ($next_of_kin){

                $next_of_kin->setRelationship($member_relationship);
                $next_of_kin->setFirstName($member_contact_fname);
                $next_of_kin->setLastName($member_contact_lname);
                $next_of_kin->setPercent(100);
                $next_of_kin->setIdNumber($member_contact_id);
                //$next_of_kin->setPhysicalAddress($physicalAddress)
                //$next_of_kin->setPostalAddress($postalAddress)
                //$next_of_kin->setPostalCode($postalCode)
                //$next_of_kin->setCity('Nairobi');
                //$next_of_kin->setCountry('Kenya');
                $next_of_kin->setPhoneNumber($member_contact_tel);
                $next_of_kin->setEmail($member_contact_email);
                $next_of_kin->setWhoseKin($user);
                $next_of_kin->setProfileKin($profile);
                $next_of_kin->setCreatedAt(new \DateTime());
                $next_of_kin->setUpdatedAt(new \DateTime());
                $em_next_of_kin = $this->getDoctrine()->getManager();
                $em_next_of_kin->persist($next_of_kin);
                $em_next_of_kin->flush();
            }else{
                $next_of_kin = new NextOfKin();

                $next_of_kin->setRelationship($member_relationship);
                $next_of_kin->setFirstName($member_contact_fname);
                $next_of_kin->setLastName($member_contact_lname);
                $next_of_kin->setPercent(100);
                $next_of_kin->setIdNumber($member_contact_id);
                //$next_of_kin->setPhysicalAddress($physicalAddress)
                //$next_of_kin->setPostalAddress($postalAddress)
                //$next_of_kin->setPostalCode($postalCode)
                //$next_of_kin->setCity('Nairobi');
                //$next_of_kin->setCountry('Kenya');
                $next_of_kin->setPhoneNumber($member_contact_tel);
                $next_of_kin->setEmail($member_contact_email);
                $next_of_kin->setWhoseKin($user);
                $next_of_kin->setProfileKin($profile);
                $next_of_kin->setCreatedAt(new \DateTime());
                $next_of_kin->setUpdatedAt(new \DateTime());
                $em_next_of_kin = $this->getDoctrine()->getManager();
                $em_next_of_kin->persist($next_of_kin);
                $em_next_of_kin->flush();
            }

        }

        if ($request->request->has('publisher_fname')){
            $publisher_fname = $request->request->get('publisher_fname');
            $publisher_lname = $request->request->get('publisher_lname');
            $publisher_company_name = $request->request->get('publisher_company_name');
            $pgendercbx = $request->request->get('pgendercbx');
            $publisher_national_id = $request->request->get('publisher_national_id');
            $publisher_address = $request->request->get('publisher_address');
            $publisher_postcode = $request->request->get('publisher_postcode');
            $publisher_town = $request->request->get('publisher_town');
            $publisher_tel = $request->request->get('publisher_tel');
            $publisher_fax = $request->request->get('publisher_fax');
            $publisher_mobile = $request->request->get('publisher_mobile');
            $publisher_email = $request->request->get('publisher_email');
            $publisher_aemail = $request->request->get('publisher_aemail');
            $publisher_pr = $request->request->get('publisher_pr');
            $ptobcbx = $request->request->get('ptobcbx');
            $publisher_business_regno = $request->request->get('publisher_business_regno');
            $publisher_business_pinno = $request->request->get('publisher_business_pinno');
            $pscbx = $request->request->get('pscbx');
            $ptobcbx = $request->request->get('ptobcbx');
            $publisher_territorial_assignment = $request->request->get('publisher_err$itorial_assignment');
            $publisher_bank_name = $request->request->get('publisher_bank_name');
            $publisher_bank_address = $request->request->get('publisher_bank_address');
            $publisher_bank_accno = $request->request->get('publisher_bank_accno');
            $publisher_bank_branch = $request->request->get('publisher_bank_branch');
            $publisher_contact_name = $request->request->get('publisher_contact_name');
            $publisher_contact_tel = $request->request->get('publisher_contact_tel');
            $publisher_contact_id = $request->request->get('publisher_contact_id');
            $publisher_relationship = $request->request->get('publisher_relationship');
            $pecbx = $request->request->get('pecbx');
            $publisher_employment_years = $request->request->get('publisher_employment_years');
            $pradiocbx = $request->request->get('pradiocbx');
            $ppubliccbx = $request->request->get('ppubliccbx');

            $corporate_profile = new CorporateProfile();
            //$corporate_profile->setTradingName();
            $corporate_profile->setEmailAddress($publisher_email);
            //$corporate_profile->setTransactionId();
            //$corporate_profile->setApproval1At();
            //$corporate_profile->setAccountCreated();
            //$corporate_profile->setSortCode();
            //$corporate_profile->setPaymentMpesaNumber();
            //$corporate_profile->setMpesaProcessed();
            //$corporate_profile->setMpesaVerificationCode();
            $corporate_profile->setKinLastName($publisher_contact_name);
            if($pscbx=="Yes"){
                $publisher_society_details = $request->request->get('publisher_society_details');
                $publisher_society_number  = $request->request->get('publisher_society_number');
                $corporate_profile->setCollectingSocieties($publisher_society_details);
                $corporate_profile->setIsCollectingSocietiesMember('1');
            }else{
                $corporate_profile->setIsCollectingSocietiesMember('0');
            }

            //$corporate_profile->setBoardApprovalStatus1();
            //$corporate_profile->setIsPaid();
            //$corporate_profile->setSwiftCode();
            $corporate_profile->setKinTelephoneNumber($publisher_contact_tel);
            //$corporate_profile->setSecondDirectorPosition();
            //$corporate_profile->setMpesaPaymentDate();
            $corporate_profile->setBank($publisher_bank_name);
            //$corporate_profile->setKinDateOfBirth();
            $corporate_profile->setBankBranch($publisher_bank_branch);
            //$corporate_profile->setApproval2At();
            //$corporate_profile->setMpesaAmount();
            $corporate_profile->setPostalAddress($publisher_address);
            if($ptobcbx=="Limited"){
                $publisher_business_director_fname = $request->request->get('publisher_business_director_fname');
                $publisher_business_director_lname = $request->request->get('publisher_business_director_lname');
                $publisher_business_director_mobile = $request->request->get('publisher_business_director_mobile');
                $publisher_business_director_email = $request->request->get('publisher_business_director_email');

                $corporate_profile->setFirstDirectorNames($publisher_business_director_fname.' '.$publisher_business_director_lname);
            }
            $corporate_profile->setCompanyName($publisher_company_name);
            $corporate_profile->setCompanyType($ptobcbx);
            //$corporate_profile->setBoardRejectionAt();
            //$corporate_profile->setReferenceId();
            $corporate_profile->setAccountName($publisher_company_name);
            //$corporate_profile->setIdemnifyAt();
            $corporate_profile->setMobileNumber($publisher_mobile);
            //$corporate_profile->setWebsite();
            $corporate_profile->setKinFirstName($publisher_contact_name);
            //$corporate_profile->setProcessedAt();
            //$corporate_profile->setBankCode();
            //$corporate_profile->setKinCounty();
            //$corporate_profile->setRegistrationDate();
            //$corporate_profile->setMembershipApprovedAt();
            //$corporate_profile->setStatusDescription();
            //$corporate_profile->setItaxPin();
            $corporate_profile->setKinMiddleName($publisher_contact_name);
            //$corporate_profile->setNrBoardApprovals();
            //$corporate_profile->setIsBoardRejected();
            //$corporate_profile->setKinGender();
            //$corporate_profile->setProcessedBy();
            $corporate_profile->setPhysicalAddress($publisher_address);
            //$corporate_profile->setBoardApprover1();
            //$corporate_profile->setMpesaConfirmationCode();
            //$corporate_profile->setKinCity();
            //$corporate_profile->setRegNumber();
            //$corporate_profile->setTermsOfService();
            $corporate_profile->setKinMobileNumber($publisher_contact_tel);
            //$corporate_profile->setIsBoardApproved();
            //$corporate_profile->setKinEmailAddress();
            $corporate_profile->setProfileStatus('Pending');
            //$corporate_profile->setSecondDirectorIdNumber();
            //$corporate_profile->setKinPhysicalAddress();

            //$corporate_profile->setCreatedAt();
            //$corporate_profile->setIdemnifyFirstName();
            //$corporate_profile->setIdemnifyLastName();
            $corporate_profile->setCity($publisher_town);
            //$corporate_profile->setIsKinMinor();
            //$corporate_profile->setProgress();
            //$corporate_profile->setBoardRejectionBy();
            //$corporate_profile->setSecondDirectorNames();
            $corporate_profile->setKinIdNumber($publisher_contact_id);
            //$corporate_profile->setBoardRejectionReason();
            $corporate_profile->setCounty($publisher_town);
            //$corporate_profile->setApproval3At();
            $corporate_profile->setKinRelationship($publisher_relationship);
            $corporate_profile->setPostalCode($publisher_postcode);
            //$corporate_profile->setFirstDirectorIdNumber();
            //$corporate_profile->setMpesaStatus();
            //$corporate_profile->setCorporateProfileDocuments();
            //$corporate_profile->setMpesaNumber();
            //$corporate_profile->setMemberNumber();
            //$corporate_profile->setIsMembershipApproved();
            //$corporate_profile->setMembershipApprovedBy();
            $corporate_profile->setAccountNumber($publisher_bank_accno);
            //$corporate_profile->setStatus();
            $corporate_profile->setTelephone($publisher_mobile);
            //$corporate_profile->setBoardApprover3();
            //$corporate_profile->setFirstDirectorPosition();
            //$corporate_profile->setKinPostalCode();
            //$corporate_profile->setBoardApprovalStatus3();
            //$corporate_profile->setIsUrlvalid();
            //$corporate_profile->setNumberOfDirectors();
            //$corporate_profile->setKinGuardian();
            //$corporate_profile->setBoardApprover2();
            //$corporate_profile->setMpesaDescription();
            //$corporate_profile->setKinPostalAddress();
            //$corporate_profile->setBoardApprovalStatus2();
            $corporate_profile->setEmailAddress2($publisher_aemail);
            $em_corp_prof = $this->getDoctrine()->getManager();
            $em_corp_prof->persist($corporate_profile);
            $em_corp_prof->flush();

            $role = array();
            $role = ['ROLE_USER'];
            $user = new User();
            $user->setIsTermsAccepted('1');
            $user->setIsActive('1');
            $user->setFirstName($publisher_fname);
            $user->setEmail($publisher_email);
            $user->setUserType('Corporate');
            $user->setPassword('123');
            $user->setLastName($publisher_lname);
            $user->setCorporateProfile($corporate_profile);
            $user->setPhoneNumber($publisher_mobile);
            $user->setMiddleName($publisher_lname);
            $user->setRoles($role);
            $em_user_pub = $this->getDoctrine()->getManager();
            $em_user_pub->persist($user);
            $em_user_pub->flush();
        }


        $this->addFlash('success', 'Your Registration was successful!');

        return $this->redirectToRoute('account_registration');
    }

    /**
     * @Route("/profile/updated",name="profile_updated")
     */
    public function profileCompleteAction()
    {
        return $this->render('profile/updated.htm.twig');
    }

    /**
     * @Route("/profile/{id}/update")
     */
    public function profileAction(Request $request, Individual $individual)
    {
        $profile = new Profile();
        $profile->setApplicantName($individual->getFirstName().' '.$individual->getLastName());
        $profile->setIdNumber($individual->getIdNumber());
        $profile->setEmailAddress($individual->getEmail());
        $profile->setProfileStatus("Pending");
        $profile->setCreatedAt(new \DateTimeImmutable());

         $form = $this->createForm(ProfileForm::class, $profile);


        $form->handleRequest($request);
        if ($form->isValid()) {
            $profile = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $payment = $request->request->get('payment');
            $em->persist($profile);
            $em->flush();
            if ($payment == 'pay') {
        //        $this->sendWelcomeEmail($onboard->getfirstName(), $onboard->getEmail(), $onboard->getId());
                $this->container->get('session')->set('profile', $profile->getId());
                $this->container->get('session')->set('type','user');

                return $this->redirectToRoute('pay_mpesa');

            } else {
      //          $this->sendUnpaidWelcomeEmail($onboard->getfirstName(), $onboard->getEmail(), $onboard->getId());
                return $this->redirectToRoute('profile_updated', array('profileId' => $profile->getId()));
            }
        } else {
            $errors = $form->getErrors();
        }
            return $this->render(':profile:new.htm.twig', [
                'profileForm' => $form->createView(),
                'profile' => $profile,
                'errors' => $errors
            ]);

    }
    /**
     * @Route("/corporate/{id}/update",name="update-profile")
     */
    public function corporateProfileAction(Request $request, Onboard $onboard)
    {
        $profile = new CorporateProfile();
        $profile->setCompanyType($onboard->getCompanyType());
        $profile->setCompanyName($onboard->getCompanyName());
        $profile->setFirstDirectorNames($onboard->getFirstDirectorNames());
        $profile->setFirstDirectorIdNumber($onboard->getFirstDirectorId());
        $profile->setEmailAddress($onboard->getEmail());
        $profile->setProfileStatus("Pending");
        $profile->setRegistrationDate(new \DateTime());
        $profile->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(CorporateProfileForm::class, $profile);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $profile = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $payment = $request->request->get('payment');
            $em->persist($profile);
            $em->flush();
            if ($payment == 'pay') {
                $this->sendWelcomeEmail($onboard->getFirstDirectorNames(), $onboard->getEmail(), $onboard->getId());
                $this->container->get('session')->set('profile', $profile->getId());
                $this->container->get('session')->set('type','corporate');
                return $this->redirectToRoute('pay_mpesa');

            } else {
                //          $this->sendUnpaidWelcomeEmail($onboard->getfirstName(), $onboard->getEmail(), $onboard->getId());
                return $this->redirectToRoute('profile_updated', array('profileId' => $profile->getId()));
            }
        } else {
            $errors = $form->getErrors();
        }
            return $this->render(':profile:newCorporate.htm.twig', [
                'profileForm' => $form->createView(),
                'profile' => $profile,
                'errors' => $errors
            ]);

        }

    /**
     * @Route("/profile/mpesa/pay",name="pay_mpesa")
     */
    public function mpesaPayAction(Request $request)
    {
        $profile = $this->container->get('session')->get('profile');
        $type = $this->container->get('session')->get('type');
        $em = $this->getDoctrine()->getManager();
        if ($type=="corporate") {
            $userProfile = $em->getRepository("AppBundle:CorporateProfile")->findOneBy(['id' => $profile]);
        }else{
            $userProfile = $em->getRepository("AppBundle:Profile")->findOneBy(['id' => $profile]);
        }
       // var_dump($type);exit;
        $form = $this->createForm(MpesaFormType::class, $userProfile);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           // $this->container->get('session')->set('profile', $userProfile);
            $amount = 10;
            $phoneNumber = $form["mobileNumber"]->getData();
            if ($type=="corporate") {
                $referenceId=$userProfile->getFirstDirectorIdNumber();
            }else{
                $referenceId=$userProfile->getIdNumber();
            }
            //$referenceId = $userProfile->getIdNumber();
            $mpesa = new Mpesa($this->container);
            $transactionId = $mpesa->generateTransactionNumber();
            $this->container->get('session')->set('transactionId',$transactionId);

            $response = $mpesa->request($amount)->from($phoneNumber)->usingReferenceId($referenceId)->usingTransactionId($transactionId)->transact();
            return $this->redirectToRoute('mpesa_paid');


        }
        return $this->render('profile/pay.htm.twig', ['profile' => $userProfile, 'mpesaForm' => $form->createView()]);
    }


    /**
     * @Route("/profile/mpesa/complete-payment",name="mpesa_paid")
     */
    public function paySuccessAction(Request $request)
    {
        return $this->render(':profile:success.htm.twig');
    }

    /**
     * @Route("/profile/mpesa/failed",name="mpesa_failed")
     */
    public function payFailedAction(Request $request)         
    {

    }

    /**
     * @Route("/profile/mpesa/verify",name="verify-payment")
     */
    public function completePaymentAction(Request $request)
    {

        $profile = $this->container->get('session')->get('profile');
        $type = $this->container->get('session')->get('type');
        $em = $this->getDoctrine()->getManager();
        if ($type=="corporate") {
            $user = $em->getRepository("AppBundle:CorporateProfile")->findOneBy(['id' => $profile]);
            $sole =$user->getCompanyType();
        }else{
            $user = $em->getRepository("AppBundle:Profile")->findOneBy(['id' => $profile]);
            $sole="Individual";
        }
        if ($user->getMpesaStatus()=="Success"){
            $success="Success";
        $transactionArray = array("a" => $user->getMpesaConfirmationCode(), "b" => $user->getMpesaPaymentDate(), "c" => $user->getMpesaNumber(), "d" => $user->getMpesaAmount());
                
            if ($type=="corporate") {
                
                $this->sendVerificationEmail($user->getCompanyName(),$user->getEmailAddress(),$transactionArray);
                if ($user->getCompanyType()=="Sole Proprietorship"){
                    $corporateType=false;
                }else{
                    $corporateType=true;
                }
                $this->sendCorporateDocumentsEmail($user->getCompanyName(),$user->getEmailAddress(),$user->getId(),$corporateType);
            }else{
                $this->sendVerificationEmail($user->getApplicantName(),$user->getEmailAddress(),$transactionArray);
                $this->sendDocumentsEmail($user->getApplicantName(),$user->getEmailAddress(),$user->getId());
            }
        }else{
            $success="Failed";
        }

        return $this->render(':profile:verification.htm.twig', [
            'profile' => $user,
            'success' => $success,
            'type'=>$type,
            'sole'=>$sole
        ]);
    }
    /**
     * @Route("/profile/verify/{id}/later",name="verify-payment-later")
     */
    public function verifyPaymentAction(Request $request,Profile $profile)
    {
        $mpesa = new Mpesax($this->container);

        $em = $this->getDoctrine()->getManager();
        $transactionId = $profile->getMpesaVerificationCode();
        $response = $mpesa->usingTransactionId($transactionId)->requestStatus();
        //var_dump($response);exit;
        $mpesaStatus = new MpesaStatus($response);
        $customerNumber = $mpesaStatus->getCustomerNumber();
        $transactionAmount = $mpesaStatus->getTransactionAmount();
        $transactionStatus = $mpesaStatus->getTransactionStatus();
        $transactionDate = $mpesaStatus->getTransactionDate();
        $mPesaTransactionId = $mpesaStatus->getMpesaTransactionId();
        $merchantTransactionId = $mpesaStatus->getMerchantTransactionId();
        $transactionDescription = $mpesaStatus->getTransactionDescription();
        if ($transactionStatus == "Success") {
            $success = "Success";
            $profile->setMpesaConfirmationCode($mPesaTransactionId);
            $profile->setMpesaDescription($transactionDescription);
            $profile->setMpesaPaymentDate(new \DateTime($transactionDate));
            $profile->setMpesaStatus($transactionStatus);
            $profile->setMpesaVerificationCode($transactionId);
            $profile->setIsPaid(true);
            $profile->setMpesaNumber($customerNumber);
            $profile->setMpesaAmount($transactionAmount);
            $em->persist($profile);
            $em->flush();
            $transactionArray = array("a" => $mPesaTransactionId, "b" => $transactionDate, "c" => $customerNumber, "d" => $transactionAmount);
            /* $transactionCode ='<b>Mpesa Confirmation Code:<b>'..'<br/>
             <b>Mpesa Payment Date:<b>'..'<br/>
             <b>Mpesa Number:</b>'..'<br/>
             <b>Amount:</b>'.;*/
            $this->sendPaymentEmail($profile->getFirstName(), $profile->getEmailAddress(), $transactionArray);

        } else {
            $success = "Failed";
            $profile->setMpesaVerificationCode($transactionId);
            $em->persist($profile);
            $em->flush();
        }
        return $this->render(':profile:verificationLater.htm.twig', [
            'profile' => $profile,
            'success' => $success,
            'transactionId'=>$transactionId
        ]);
    }
    /**
     * @Route("/profile/mpesa/{id}/later",name="verify-later")
     */
    public function verifyLater(Request $request, Profile $profile){

        $em = $this->getDoctrine()->getManager();
        $transactionArray = array("a" => $profile->getId(), "b" => $profile->getMpesaVerificationCode());

        $this->sendVerificationEmail($profile->getFirstName(), $profile->getEmailAddress(), $transactionArray);

        return $this->render(':profile:verifyLater.htm.twig',[
            'profile' => $profile
        ]);
    }

    /**
     * @Route("/profile/{id}/edit")
     */
    public function editProfileAction(Request $request, Profile $profile)
    {
        $form = $this->createForm(ProfileForm::class, $profile);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $profile = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();
            return $this->redirectToRoute('profile_updated', array('profileId' => $profile->getId()));
        } else {
            $errors = $form->getErrors();
        }
        return $this->render(':profile:new.htm.twig', ['profileForm' => $form->createView(), 'profile' => $profile, 'errors' => $errors]);
    }

    /**
     * @Route("/profile/{id}/pay",name="member-pay")
     */
    public function makePaymentAction(Request $request, Profile $userProfile)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MpesaFormType::class, $userProfile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get('session')->set('profile', $userProfile);
            $amount = 10;
            $phoneNumber = $form["phoneNumber"]->getData();
            $referenceId = $userProfile->getIdNumber();
            $mpesa = new Mpesax($this->container);
            $transactionId = $mpesa->generateTransactionNumber();
            $response = $mpesa->request($amount)->from($phoneNumber)->usingReferenceId($referenceId)->usingTransactionId($transactionId)->transact();
            $statusCode = $response->getStatusCode();
            $this->container->get('session')->set('transactionId', $transactionId);
            if ($statusCode == 200) {
                return $this->redirectToRoute('mpesa_paid');
            } else {
                return $this->redirectToRoute('mpesa_failed');
            }

        }
        return $this->render('profile/pay.htm.twig', ['profile' => $userProfile, 'mpesaForm' => $form->createView()]);
    }
    public function sendVerificationEmail($firstName, $emailAddress, $code)
    {
       /** $message = \Swift_Message::newInstance()->setSubject('MCSK Online Portal Profile')->setFrom('mcsk@patchcreate.com', 'MCSK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
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

$from = new SendGrid\Email(null, "membership@mcsk.or.ke");
$subject = "MCSK Online Portal Profile";
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
    }
    public function sendDocumentsEmail($firstName, $emailAddress, $code)
    {
         $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
        /**$message = \Swift_Message::newInstance()->setSubject('MCSK Online Portal Profile')->setFrom('mcsk@patchcreate.com', 'MCSK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
            'Emails/documents.htm.twig', array('name' => $firstName, 'code' => $code)), 'text/html');
        $this->get('mailer')->send($message);**/
        $body=$this->renderView(
            'Emails/documents.htm.twig',
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
    public function sendCorporateDocumentsEmail($firstName, $emailAddress, $code,$corporate)
    {   $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
        /**$message = \Swift_Message::newInstance()->setSubject('MCSK Online Portal Profile')->setFrom('mcsk@patchcreate.com', 'MCSK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
            'Emails/corporateDocuments.htm.twig', array('name' => $firstName, 'code' => $code,'corporate'=>$corporate)), 'text/html');
        $this->get('mailer')->send($message);**/
        $body=$this->renderView(
            'Emails/corporateDocuments.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code,
                        'corporate'=>$corporate
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
    public function sendPaymentEmail($firstName, $emailAddress, $code)
    {
        $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
        /**$message = \Swift_Message::newInstance()->setSubject('MCSK Online Portal Profile')->setFrom('mcsk@patchcreate.com', 'MCSK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
                'Emails/paid.htm.twig', array('name' => $firstName, 'code' => $code)), 'text/html');
        $this->get('mailer')->send($message);**/
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

    public function sendWelcomeEmail($firstName, $emailAddress)
    {
   $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
      /*** $message = \Swift_Message::newInstance()->setSubject('MCSK Online Portal Profile')->setFrom('mcsk@patchcreate.com', 'MCSK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
                'Emails/profile.htm.twig', array('name' => $firstName)), 'text/html');
        $this->get('mailer')->send($message); */
        $body=$this->renderView(
                    'Emails/profile.htm.twig',
                    array(
                        'name' => $firstName,
                        )
                );

$from = new SendGrid\Email(null, "portal@mcsk.or.ke");
$subject = "MCSK Online Portal Registration";
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);


    }

    public function sendUnpaidWelcomeEmail($firstName, $emailAddress, $code)
    {
         $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
        /**$message = \Swift_Message::newInstance()->setSubject('MCSK Online Portal Profile')->setFrom('mcsk@patchcreate.com', 'MCSK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
                'Emails/unpaid.htm.twig', array('name' => $firstName, 'code' => $code)), 'text/html');
        $this->get('mailer')->send($message);**/
        $body=$this->renderView(
            'Emails/unpaid.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "portal@mcsk.or.ke");
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
            CURLOPT_POSTFIELDS => array(
                "apiKey" => "bd58e5def8d1ef9df0436e84bc9394d8",
                "shortCode" => "VasPro",
                "message" => $message,
                "recipient" => $phone,
                "callbackURL" => " ",
                "enqueue" => 0
            ),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    /**
     * @Route("/mpesa/updated/{transactionId}",name="mpesa_updated")
     */
    public function mpesaPaymentSuccessAction(Request $request,$transactionId)        
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository("AppBundle:Profile")->findOneBy(['id' => $transactionId]);
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
                $this->sendPaymentEmail($user->getUser()->getFirstName(), $user->getEmailAddress(), $transactionArray);
            }
        }else{

            $user = $em->getRepository("AppBundle:CorporateProfile")->findOneBy(['id' => $transactionId]);
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
                $this->sendPaymentEmail($user->getFirstName(), $user->getEmailAddress(), $transactionArray);
            }
        }
        return $this->render('profile/mpesa.htm.twig');
    }

    /**
     * @Route("/member/mpesa/fail", name="mpesa-success")
     */
    public function mpesaPaymentFailureAction()
    {
        $customerNumber = $_POST['MSISDN'];
        $amount = $_POST['AMOUNT'];
        $mpesaStatus = $_POST['TRX_STATUS'];
        $trasactionDate = $_POST['M­PESA_TRX_DATE'];
        $mPesaTrasactionId = $_POST['M­PESA_TRX_ID'];
        $transactionReferenceId = $_POST['MERCHANT_TRANSACTION_ID'];
        $mpesaDescritpion = $_POST['DESCRIPTION'];
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:Profile")->findOneBy(['idNumber' => $transactionReferenceId]);
        $user->setMpesaConfirmationCode($mPesaTrasactionId);
        $user->setMpesaDescription($mpesaDescritpion);
        $user->setMpesaPaymentDate($trasactionDate);
        $user->setMpesaStatus($mpesaStatus);
        $user->setIsPaid(false);
        $em->persist($user);
        $em->flush();
    }

    /**
     * @Route("/documents/{id}/add",name="add-document")
     */
    public function addDocumentsAction(Request $request, Profile $profile)
    {
        $profileDocs = $profile->getProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            //Create Choices based on Missing documents
            if (!in_array('PASSPORT-PHOTO', $docName)) {
                $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
            }
            if (!in_array('ID-COPY', $docName)) {
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate'] = 'ID-COPY';
            }
            if (!in_array('KRA-PIN', $docName)) {
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
            }
            if (!in_array('NEXT-OF-KIN-ID', $docName)) {
                $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-ID';
            }
        }else {
                $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate'] = 'ID-COPY';
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-ID';

        }
        $em = $this->getDoctrine()->getManager();

        $document = new Documents();
        $document->setWhichProfile($profile);

        $form = $this->createForm(DocumentsFormType::class, $document,['docChoices'=>$docChoices]);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $document = $form->getData();

            $profileId= $request->request->get('_pxc');

            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$profileId
                ]);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute("add-document",array('id' => $profile->getId(),'done'=>'success'));


        }
        return $this->render(':profile/documents:add.htm.twig',
            [
                'form' => $form->createView(),
                'profile' => $profile,
                'success' =>''
            ]
        );

    }
     /**
     * @Route("/documents/{id}/add",name="add-signed-document")
     */
    public function addSignedDocumentsAction(Request $request, Profile $profile)
    {
        $profileDocs = $profile->getProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            //Create Choices based on Missing documents
            if (!in_array('PASSPORT-PHOTO', $docName)) {
                $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
            }
            if (!in_array('ID-COPY', $docName)) {
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate'] = 'ID-COPY';
            }
            if (!in_array('KRA-PIN', $docName)) {
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
            }
            if (!in_array('NEXT-OF-KIN-ID', $docName)) {
                $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-ID';
            }
        }else {
                $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate'] = 'ID-COPY';
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-ID';

        }
        $em = $this->getDoctrine()->getManager();

        $document = new Documents();
        $document->setWhichProfile($profile);

        $form = $this->createForm(SignedDocumentsForm::class, $document,['docChoices'=>$docChoices]);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $document = $form->getData();

            $profileId= $request->request->get('_pxc');

            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$profileId
                ]);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute("add-signed-document",array('id' => $profile->getId(),'done'=>'success'));


        }
        return $this->render(':profile/documents:add-signed.htm.twig',
            [
                'form' => $form->createView(),
                'profile' => $profile,
                'success' =>''
            ]
        );

    }
    /**
     * @Route("/corporate/{id}/add-documents",name="add-corporate-document")
     */
    public function addCorporateDocumentsAction(Request $request, CorporateProfile $profile)
    {
        $profileDocs = $profile->getCorporateProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            //Create Choices based on Missing documents

            if (!in_array('REG-CERT', $docName)) {
                $docChoices['Copy of Certificate of Registration or Incorporation'] = 'REG-CERT';
            }
            if (!in_array('DIR1-PASSPORT-PHOTO', $docName)) {
                $docChoices['Colour Passport-Size Photo Of Director 1'] = 'DIR1-PASSPORT-PHOTO';
            }
            if (!in_array('DIR1-ID-COPY', $docName)) {
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
            }
            if ($profile->getCompanyType()!="Sole Proprietorship"){
                if (!in_array('DIR2-PASSPORT-PHOTO', $docName)) {
                    $docChoices['Colour Passport-Size Photo Of Director 2'] = 'DIR2-PASSPORT-PHOTO';
                }
                if (!in_array('DIR2-ID-COPY', $docName)) {
                    $docChoices['Copy of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY';
                }
                if (!in_array('KRA-PIN', $docName)) {
                    $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                }
            }else{
                if (!in_array('NEXT-OF-KIN-ID', $docName)) {
                    $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'NEXT-OF-KIN-ID';
                }
                if (!in_array('KRA-PIN', $docName)) {
                    $docChoices['Copy of your Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                }
            }

        }else {
                 if ($profile->getCompanyType()!="Sole Proprietorship"){
                     $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                     $docChoices['Copy of Certificate of Registration or Incorporation'] = 'REG-CERT';
                     $docChoices['Colour Passport-Size Photo Of Director 1'] = 'DIR1-PASSPORT-PHOTO';
                     $docChoices['Copy of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';

                    $docChoices['Colour Passport-Size Photo Of Director 2'] = 'DIR2-PASSPORT-PHOTO';
                    $docChoices['Copy of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY';
                    $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';

                }else{
                     $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                     $docChoices['Copy of Certificate of Business Name Registration'] = 'REG-CERT';
                     $docChoices['Colour Passport-Size Photo'] = 'DIR1-PASSPORT-PHOTO';
                     $docChoices['Copy of your Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
                     $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'NEXT-OF-KIN-ID';
                     $docChoices['Copy of your Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';

                 }

        }
        $em = $this->getDoctrine()->getManager();

        $document = new Documents();
        $document->setWhichCorporateProfile($profile);

        $form = $this->createForm(DocumentsFormType::class, $document,['docChoices'=>$docChoices]);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $document = $form->getData();

            $profileId= $request->request->get('_pxc');

            $profile = $em->getRepository("AppBundle:CorporateProfile")
                ->findOneBy([
                    'id'=>$profileId
                ]);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute("add-corporate-document",array('id' => $profile->getId(),'done'=>'success'));


        }
        return $this->render(':profile/documents:add-corporate.htm.twig',
            [
                'form' => $form->createView(),
                'profile' => $profile,
                'success' =>''
            ]
        );

    }


    /**
     * @Route("documents/added",name="document-added")
     */
    public function documentAddedAction(Request $request)
    {
        return $this->render(':profile/documents:added.htm.twig');
    }

    /**
     * @Route("/sample/{id}/add",name="add-sample")
     */
    public function addSampleAction(Request $request, Profile $profile)
    {

        $em = $this->getDoctrine()->getManager();

        $music = new Music();
        $music->setWhichProfile($profile);

        $form = $this->createForm(NewRecordingForm::class, $music);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $document = $form->getData();

            $profileId= $request->request->get('_pxc');

            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$profileId
                ]);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute("add-sample",array('id' => $profile->getId(),'done'=>'success'));


        }
        return $this->render(':profile/music:add-music.htm.twig',
            [
                'form' => $form->createView(),
                'profile' => $profile,
                'success' =>''
            ]
        );

    }
    /**
     * @Route("/corporate/{id}/add-samples",name="add-corporate-sample")
     */
    public function addCorporateSampleAction(Request $request, CorporateProfile $profile)
    {

        $em = $this->getDoctrine()->getManager();

        $music = new Music();
        $music->setWhichCorporateProfile($profile);

        $form = $this->createForm(NewRecordingForm::class, $music);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $document = $form->getData();

            $profileId= $request->request->get('_pxc');

            $profile = $em->getRepository("AppBundle:CorporateProfile")
                ->findOneBy([
                    'id'=>$profileId
                ]);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute("add-corporate-sample",array('id' => $profile->getId(),'done'=>'success'));


        }
        return $this->render(':profile/music:add-corporate-music.htm.twig',
            [
                'form' => $form->createView(),
                'profile' => $profile,
                'success' =>''
            ]
        );
    }

    /**
     * @Route("samples/added",name="sample-added")
     */
    public function sampleAddedAction(Request $request)
    {
        return $this->render(':profile/documents:added.htm.twig');
    }



    public function documentExists($documentName, Profile $profile)
    {
        $em = $this->getDoctrine()->getManager();
        $document = $em->getRepository("AppBundle:Documents")->findOneBy(['documentName' => $documentName, 'whichProfile' => $profile]);
        if ($document) {
            return true;
        } else {
            return false;
        }
    }
}
