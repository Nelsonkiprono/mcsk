<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Documents;     
use AppBundle\Entity\Music;
use AppBundle\Entity\Profile;
use AppBundle\Form\ApplicantDetailsForm;
use AppBundle\Form\CorporateDetailsForm;
use AppBundle\Form\CorporatePaymentForm;
use AppBundle\Form\DocumentsFormType;
use AppBundle\Form\NewRecordingForm;
use AppBundle\Form\SignedDocumentsForm;
use AppBundle\Form\PaymentForm;
use AppBundle\Form\ProfileForm;
use AppBundle\Form\ProfileKinForm;
use AppBundle\Form\VerificationForm;
use Crysoft\MpesaBundle\Helpers\Mpesa;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SendGrid;
/**

 * @Route("/profile")

 * @Security("is_granted('ROLE_USER')")

 */
class HomeController extends Controller
{
    /**

     * @Route("/update",name="update")

     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user->getUserType()=="Individual" || $user->getUserType()=="Deceased Producer") {
            if ($user->getProfile()->getProgress() == "Initial") {
                return $this->redirectToRoute("initial");
            }if ($user->getProfile()->getProgress() == "NextOfKin") {
                return $this->redirectToRoute("next-of-kin");
            } elseif ($user->getProfile()->getProgress() == "Documents") {
                return $this->redirectToRoute("documents");
            } elseif ($user->getProfile()->getProgress() == "Recordings") {
                return $this->redirectToRoute("recording-sample");
            } elseif ($user->getProfile()->getProgress() == "Confirmation") {
                return $this->redirectToRoute("confirm-profile");
            }elseif ($user->getprofile()->getProgress() == "Payment") {
                return $this->redirectToRoute("payment");
            }
            return $this->render('home/home.htm.twig',[
            'profile'=>$user->getProfile()
        ]);
        }else{
            if ($user->getCorporateProfile()->getProgress()=="Initial"){
                return $this->redirectToRoute('initial-corporate');
            }elseif($user->getCorporateProfile()->getProgress()=="Documents"){
                return $this->redirectToRoute('corporate-documents');
            }elseif($user->getCorporateProfile()->getProgress()=="Recordings"){
                return $this->redirectToRoute('corporate-recording-sample');
            }elseif($user->getCorporateProfile()->getProgress()=="Payment"){
                return $this->redirectToRoute('corporatepayment');
            }
            return $this->render('home/corporateHome.htm.twig',[
                'profile'=>$user->getCorporateProfile()
            ]);

        }
    }
    /**

     * @Route("/update/individual/initial",name="initial")

     */
    public function initialProfileAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em= $this->getDoctrine()->getManager();

        $profile = $user->getProfile();

        $userProfile = $em->getRepository("AppBundle:Profile")   
            ->findOneBy([
                'id'=>$profile->getId()
            ]);
        $form = $this->createForm(ApplicantDetailsForm::class,$userProfile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $prof = $form->getData();
            if ($user->getUserType()=="Deceased Producer"){
                $user->setRegion($prof->getPrefferedRegion());
                $prof->setProgress("Documents");
            }else {
                $user->setRegion($prof->getPrefferedRegion());
                $prof->setProgress("NextOfKin");
            }
            $em->persist($prof);
            $em->persist($user);
            $em->flush();

            /*if ($user->getUserType()=="Deceased Producer"){

                return $this->redirectToRoute('documents');

            }else {

                return $this->redirectToRoute("next-of-kin");

            }*/
            return $this->redirectToRoute("next-of-kin");
        }

        return $this->render(':home:initial.htm.twig',[
            'profileForm'=>$form->createView(),
            'profile'=>$userProfile
        ]);
    }
    /**

     * @Route("/update/individual/kin",name="next-of-kin")

     */
    public function kinProfileAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();

        $form = $this->createForm(ProfileKinForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $profile = $form->getData();

            $em= $this->getDoctrine()->getManager();
            $profile->setProgress("Documents");
            $em->persist($profile);
            $em->flush();
            return $this->redirectToRoute('documents');
        }

        return $this->render(':home:nextOfKin.htm.twig',[
            'profileForm'=>$form->createView()
        ]);
    }
    /**

     * @Route("/update/individual/documents/{id}/delete",name="documents-delete")

     */
    public function documentsActionDelete(Request $request, Documents $documents){
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($documents);
        unlink("../web/assets/documents/".$documents->getDocumentFileName());
        $em->flush();
        return $this->redirect($this->generateUrl('documents'));
    }
    /**

     * @Route("/update/individual/recording/{id}/delete",name="recording-delete")

     */
    public function recordingActionDelete(Request $request, Music $music){
        $em = $this->getDoctrine()->getEntityManager();

        $recording_file = $music->getRecordingFile();
        
        $document_file = $music->getDocumentFile();

        $em->remove($music);
        $em->remove($recording_file);
        $em->remove($document_file);
        unlink("../web/assets/recordings/".$recording_file->getDocumentFileName());
        unlink("../web/assets/recordings/".$document_file->getDocumentFileName());
        $em->flush();
        return $this->redirect($this->generateUrl('recording-sample'));
    }
    /**

     * @Route("/update/corporate/documents/{id}/delete",name="documents-delete-corporate")

     */
    public function documentsActionDeleteCorporate(Request $request, Documents $documents){
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($documents);
        unlink("../web/assets/documents/".$documents->getDocumentFileName());
        $em->flush();
        return $this->redirect($this->generateUrl('corporate-documents'));
    }
     /**

     * @Route("/update/corporate/recording/{id}/delete",name="recording-delete-corporate")

     */
    public function recordingActionDeleteCorporate(Request $request, Music $music){
        $em = $this->getDoctrine()->getEntityManager();

        $recording_file = $music->getRecordingFile();

        $document_file = $music->getDocumentFile();

        $em->remove($music);
        $em->remove($recording_file);
        $em->remove($document_file);
        unlink("../web/assets/recordings/".$recording_file->getDocumentFileName());
        unlink("../web/assets/recordings/".$document_file->getDocumentFileName());
        $em->flush();
        return $this->redirect($this->generateUrl('corporate-recording-sample'));
    }
    /**

     * @Route("/update/individual/documents",name="documents")

     */
    public function documentsAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();
        //$profile = $user->getProfile();
         $profile = $em->getRepository("AppBundle:Profile")
            ->findOneBy([
                'id'=>$user->getProfile()->getId()
            ]);
        //var_dump($profile->getId());exit;
        $profileDocs = $profile->getProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array 
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            if ($user->getUserType()=="Deceased Producer"){
                //Create Choices based on Missing documents
                if (!in_array('ADMINISTRATION-LETTER', $docName)) {
                    $docChoices['Letters of Administration'] = 'ADMINISTRATION-LETTER';
                }
                if (!in_array('DEATH-CERTIFICATE', $docName)) {
                    $docChoices['Death Certificate'] = 'DEATH-CERTIFICATE';
                }
            }
            if ($user->getUserType()=="Publisher"){
            if (!in_array('CR12', $docName)) {
                $docChoices['CR12'] = 'CR12';
            }
            if (!in_array('COVER-LETTER', $docName)) {
                $docChoices['Cover Letter on the Company’s Letter Head'] = 'COVER-LETTER';
            }
            if (!in_array('CERTIFICATE-INCORPORATION-COPY', $docName)) {
                $docChoices['Copy of Certified Certificate of Incorporation or Business Registration Details'] = 'CERTIFICATE-INCORPORATION-COPY';
            }
            if (!in_array('CONTRACTS-COPY', $docName)) {
                $docChoices['Certified Copy(s) of Contracts or Agreements Between The Publisher and The Authors/Composers'] = 'CONTRACTS-COPY';
            }
        }


            if ($profile->getIsGroup()=="true"){
                if (!in_array('GROUP-AGREEMENT', $docName)) {
                    $docChoices['Group Agreement'] = 'GROUP-AGREEMENT';
                }
            }

            //Create Choices based on Missing documents
            if (!in_array('DEED-OF-ASSIGNMENT', $docName)) {
                $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
            }
            if (!in_array('MECHANICAL-RIGHTS-FORM', $docName)) {
                $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
            }
            if (!in_array('PASSPORT-PHOTO', $docName)) {
                $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
            }
            if (!in_array('NATIONAL-ID-COPY', $docName)) {
                $docChoices['Copy of frontside Valid National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY';
            }
             if (!in_array('NATIONAL-ID-COPY-BACK', $docName)) {
                $docChoices['Copy of backside Valid National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY-BACK';
            }
            if (!in_array('KRA-PIN', $docName)) {
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-CERTIFICATE';
            }
            if (!in_array('NEXT-OF-KIN-CERTIFICATE', $docName)) {
                $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-CERTIFICATE';
            }
        }else {
            if ($user->getUserType="Deceased Producer"){
                $docChoices['Letters of Administration'] = 'ADMINISTRATION-LETTER';
                $docChoices['Death Certificate'] = 'DEATH-CERTIFICATE';

            }
            if ($profile->getIsGroup()=="true"){
                $docChoices['Copies of agreements if there is joint copyright ownership'] = 'GROUP-AGREEMENT';
            }
            if ($user->getUserType()=="Publisher"){
            $docChoices['CR12'] = 'CR12';
            $docChoices['Cover Letter on the Company’s Letter Head'] = 'COVER-LETTER';
            $docChoices['Copy of Certified Certificate of Incorporation or Business Registration Details'] = 'CERTIFICATE-INCORPORATION-COPY';
            $docChoices['Certified Copy(s) of Contracts or Agreements Between The Publisher and The Authors/Composers'] = 'CONTRACTS-COPY';
            }
            $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
            $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
            $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
            $docChoices['Copy of frontside of Valid National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY';
            $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY-BACK';
            $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-CERTIFICATE';
            $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-CERTIFICATE';

        }
      

        $document = new Documents();
        $document->setWhichProfile($profile);

        $form = $this->createForm(DocumentsFormType::class, $document,['docChoices'=>$docChoices]);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $document = $form->getData();

            $em->persist($document);
            $em->flush();

            return new Response(null,200);

        }elseif($form->isSubmitted()&&!$form->isValid()){
            return new Response(null,500);
        }
        return $this->render(':home:documents.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }
    /**

     * @Route("/upload/docs/form",name="upload-form")

     */
    public function docUploadFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();
        //var_dump($profile);exit;
        $profileDocs = $profile->getProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            if ($user->getUserType()=="Deceased Producer"){
                //Create Choices based on Missing documents
                if (!in_array('DEED-OF-ASSIGNMENT', $docName)) {
                    $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
                }
                if (!in_array('MECHANICAL-RIGHTS-FORM', $docName)) {
                    $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
                }
                if (!in_array('ADMINISTRATION-LETTER', $docName)) {
                    $docChoices['Letters of Administration'] = 'ADMINISTRATION-LETTER';
                }
                if (!in_array('DEATH-CERTIFICATE', $docName)) {
                    $docChoices['Death Certificate'] = 'DEATH-CERTIFICATE';
                }
                //Create Choices based on Missing documents
                if (!in_array('PASSPORT-PHOTO', $docName)) {
                    $docChoices['Next of Kin/Beneficiary Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
                }
                if (!in_array('NATIONAL-ID-COPY', $docName)) {
                    $docChoices['Copy of frontside of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY';
                }
                 if (!in_array('NATIONAL-ID-COPY-BACK', $docName)) {
                    $docChoices['Copy of backside Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY-BACK';
                }
                if (!in_array('KRA-CERTIFICATE', $docName)) {
                    $docChoices['Copy of Next of Kin/Beneficiary Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-CERTIFICATE';
                }
            }
            elseif ($user->getUserType()=="Publisher"){
                //Create Choices based on Missing documents
                if (!in_array('DEED-OF-ASSIGNMENT', $docName)) {
                    $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
                }
                if (!in_array('MECHANICAL-RIGHTS-FORM', $docName)) {
                    $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
                }
                if (!in_array('CR12', $docName)) {
                    $docChoices['CR12'] = 'CR12';
                }
                if (!in_array('COVER-LETTER', $docName)) {
                    $docChoices['Cover Letter on the Company’s Letter Head'] = 'COVER-LETTER';
                }
                if (!in_array('CERTIFICATE-INCORPORATION-COPY', $docName)) {
                    $docChoices['Copy of Certified Certificate of Incorporation or Business Registration Details'] = 'CERTIFICATE-INCORPORATION-COPY';
                }
                if (!in_array('CONTRACTS-COPY', $docName)) {
                    $docChoices['Certified Copy(s) of Contracts or Agreements Between The Publisher and The Authors/Composers'] = 'CONTRACTS-COPY';
                }
                //Create Choices based on Missing documents
                if (!in_array('PASSPORT-PHOTO', $docName)) {
                    $docChoices['Next of Kin/Beneficiary Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
                }
                if (!in_array('NATIONAL-ID-COPY', $docName)) {
                    $docChoices['Copy of frontside of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY';
                }
                 if (!in_array('NATIONAL-ID-COPY-BACK', $docName)) {
                    $docChoices['Copy of backside Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY-BACK';
                }
                if (!in_array('KRA-CERTIFICATE', $docName)) {
                    $docChoices['Copy of Next of Kin/Beneficiary Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-CERTIFICATE';
                }
            }else {
                if ($profile->getIsGroup()=="true"){
                    if (!in_array('GROUP-AGREEMENT', $docName)) {
                        $docChoices['Group Agreement'] = 'GROUP-AGREEMENT';
                    }
                }
                if (!in_array('DEED-OF-ASSIGNMENT', $docName)) {
                    $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
                }
                if (!in_array('MECHANICAL-RIGHTS-FORM', $docName)) {
                    $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
                }
                //Create Choices based on Missing documents
                if (!in_array('PASSPORT-PHOTO', $docName)) {
                    $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
                }
                if (!in_array('NATIONAL-ID-COPY', $docName)) {
                    $docChoices['Copy of frontside of Valid National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY';
                }
                  if (!in_array('NATIONAL-ID-COPY-BACK', $docName)) {
                    $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY-BACK';
                }
                if (!in_array('KRA-CERTIFICATE', $docName)) {
                    $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-CERTIFICATE';
                }
                if (!in_array('NEXT-OF-KIN-CERTIFICATE', $docName)) {
                    $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-CERTIFICATE';
                }
            }

        }
        else {
            
            if ($user->getUserType=="Deceased Producer"){
                $docChoices['Letters of Administration'] = 'ADMINISTRATION-LETTER';
                $docChoices['Death Certificate'] = 'DEATH-CERTIFICATE';

            }
            
            if ($profile->getIsGroup()=="true"){
                $docChoices['Copies of agreements if there is joint copyright ownership'] = 'GROUP-AGREEMENT';
            }
            $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
            $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
            $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
            $docChoices['Copy of Valid National ID/Passport/Birth Certificate'] = 'NATIONAL-ID-COPY';
            $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-CERTIFICATE';
            $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin/Beneficiary'] = 'NEXT-OF-KIN-CERTIFICATE';
           
        
    }
        $em = $this->getDoctrine()->getManager();

        $document = new Documents();
        $document->setWhichProfile($profile);

        $form = $this->createForm(DocumentsFormType::class, $document,['docChoices'=>$docChoices]);

        return $this->render('home/docUploadForm.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }
    /**

     * @Route("/upload/docs/forms/{profileid}",name="upload-signedform")

     */
    public function signedDocUploadFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //$em = $this->getDoctrine()->getManager();
       //$user = $em->getRepository("AppBundle:Profile")->findOneBy(['referenceId' => $profileid]);

        $profile = $user->getProfile();
        //var_dump($profile);exit;
        $profileDocs = $profile->getProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            if ($user->getUserType()=="Deceased Producer"){
                //Create Choices based on Missing documents
                if (!in_array('DEED-OF-ASSIGNMENT-SIGNED', $docName)) {
                    $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT-SIGNED';
                }
                if (!in_array('MECHANICAL-RIGHTS-FORM-SIGNED', $docName)) {
                    $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM-SIGNED';
                }
                
                //Create Choices based on Missing documents
                
            }else{
                                }
                if (!in_array('DEED-OF-ASSIGNMENT-SIGNED', $docName)) {
                    $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT-SIGNED';
                }
                if (!in_array('MECHANICAL-RIGHTS-FORM-SIGNED', $docName)) {
                    $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM-SIGNED';
                }
                //Create Choices based on Missing documents
                
            

        }else {
            
            $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT-SIGNED';
            $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM-SIGNED';

        }
        $em = $this->getDoctrine()->getManager();

        $document = new Documents();
        $document->setWhichProfile($profile);

        $form = $this->createForm(SignedDocumentsForm::class, $document,['docChoices'=>$docChoices]);

        return $this->render('home/signed-docUploadForm.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }
    /**

     * @Route("/uploaded/docs",name="uploaded-documents")

     */
    public function uploadedDocumentsAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();

        return $this->render('home/docUpload.htm.twig',[
            'profile'=>$profile
        ]);
    }
    /**

     * @Route("/update/corporate/initial",name="initial-corporate")

     */
    public function initialCorporateProfileAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em= $this->getDoctrine()->getManager();

        $profile = $user->getCorporateProfile();

        $users = $records = $em->getRepository("AppBundle:User")->findAll();

        $form = $this->createForm(CorporateDetailsForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $prof = $form->getData();

            $prof->setProgress("Documents");
            $prof->setCompanyType($profile->getCompanyType());
            $user->setRegion($prof->getPrefferedRegion());

            $em->persist($prof);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("corporate-documents");

        }

        return $this->render(':home/corporate:initial.htm.twig',[
            'profileForm'=>$form->createView(),
            'profile'=>$profile
        ]);
    }
    /**

     * @Route("/update/corporate/documents",name="corporate-documents")

     */
    public function corporateDocumentsAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();

        $profileDocs = $profile->getCorporateProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            //Create Choices based on Missing documents
            if (!in_array('DEED-OF-ASSIGNMENT', $docName)) {
                $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
            }
            if (!in_array('MECHANICAL-RIGHTS-FORM', $docName)) {
                $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
            }
            if (!in_array('REG-CERT', $docName)) {
                $docChoices['Copy of Certificate of Registration or Incorporation'] = 'REG-CERT';
            }
            if (!in_array('DIR1-PASSPORT-PHOTO', $docName)) {
                $docChoices['Colour Passport-Size Photo Of Director 1'] = 'DIR1-PASSPORT-PHOTO';
            }
            if (!in_array('CR12', $docName)) {
                $docChoices['CR12'] = 'CR12';
            }
            if (!in_array('COVER-LETTER', $docName)) {
                $docChoices['Cover Letter on the Company’s Letter Head'] = 'COVER-LETTER';
            }
           /*** if (!in_array('CERTIFICATE-INCORPORATION-COPY', $docName)) {
                $docChoices['Copy of Certified Certificate of Incorporation or Business Registration Details'] = 'CERTIFICATE-INCORPORATION-COPY';
            }**/
            if (!in_array('CONTRACTS-COPY', $docName)) {
                $docChoices['Certified Copy(s) of Contracts or Agreements Between The Publisher and The Authors/Composers'] = 'CONTRACTS-COPY';
            }
            if (!in_array('DIR1-ID-COPY', $docName)) {
                $docChoices['Copy of frontside of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
            }
            if (!in_array('DIR1-ID-COPY-BACK', $docName)) {
                $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY-BACK';
            }
            if ($profile->getCompanyType()!="Sole Proprietorship"){
                if ($profile->getNumberOfDirectors()==2){
                    if (!in_array('DIR2-PASSPORT-PHOTO', $docName)) {
                        $docChoices['Colour Passport-Size Photo Of Director 2'] = 'DIR2-PASSPORT-PHOTO';
                    }
                    if (!in_array('DIR2-ID-COPY', $docName)) {
                        $docChoices['Copy of frontside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY';
                    }
                    if (!in_array('DIR2-ID-COPY-BACK', $docName)) {
                        $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY-BACK';
                    }
                    if (!in_array('KRA-PIN', $docName)) {
                        $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                    }
                }else{
                    if (!in_array('KIN-ID', $docName)) {
                        $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'KIN-ID';
                    }
                    if (!in_array('KRA-PIN', $docName)) {
                        $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                    }
                }

            }else{
                if (!in_array('KIN-ID', $docName)) {
                    $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'KIN-ID';
                }
                if (!in_array('KRA-PIN', $docName)) {
                    $docChoices['Copy of your Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                }
            }

        }else {
            if ($profile->getCompanyType()!="Sole Proprietorship"){
                $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
                $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                $docChoices['Copy of Certificate of Registration or Incorporation'] = 'REG-CERT';
                $docChoices['Colour Passport-Size Photo Of Director 1'] = 'DIR1-PASSPORT-PHOTO';
                $docChoices['Copy of frontsde of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
                $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY-BACK';
                if($profile->getNumberOfDirectors()==2){
                    $docChoices['Colour Passport-Size Photo Of Director 2'] = 'DIR2-PASSPORT-PHOTO';
                    $docChoices['Copy of frontside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY';
                    $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY-BACK';

                }else{
                    $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                    $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'KIN-ID';

                }

            }else{
                $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
                $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                $docChoices['Copy of Certificate of Business Name Registration'] = 'REG-CERT';
                if ($user->getUserType=="Publisher"){
                    $docChoices['CR12'] = 'CR12';
                    $docChoices['Cover Letter on the Company’s Letter Head'] = 'COVER-LETTER';
                   // $docChoices['Copy of Certified Certificate of Incorporation or Business Registration Details'] = 'CERTIFICATE-INCORPORATION-COPY';
                    $docChoices['Certified Copy(s) of Contracts or Agreements Between The Publisher and The Authors/Composers'] = 'CONTRACTS-COPY';
                 }
                $docChoices['Colour Passport-Size Photo'] = 'DIR1-PASSPORT-PHOTO';
                $docChoices['Copy of frontside of your Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
                $docChoices['Copy of backside of your Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY-BACK';
                $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'KIN-ID';
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

            $em->persist($document);
            $em->flush();

            return new Response(null,200);

        }elseif($form->isSubmitted()&&!$form->isValid()){
            return new Response(null,500);
        }
        return $this->render('home/corporate/documents.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }

    /**

     * @Route("/upload/corp/form",name="upload-corporate-form")

     */
    public function corpDocUploadFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();


        $profile = $user->getCorporateProfile();

        $profileDocs = $profile->getCorporateProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            //Create Choices based on Missing documents
            if (!in_array('DEED-OF-ASSIGNMENT', $docName)) {
                $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
            }
            if (!in_array('MECHANICAL-RIGHTS-FORM', $docName)) {
                $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
            }
            if (!in_array('REG-CERT', $docName)) {
                $docChoices['Copy of Certificate of Registration or Incorporation'] = 'REG-CERT';
            }
            if (!in_array('CR12', $docName)) {
                $docChoices['CR12'] = 'CR12';
            }
            if (!in_array('COVER-LETTER', $docName)) {
                $docChoices['Cover Letter on the Company’s Letter Head'] = 'COVER-LETTER';
            }
           /*** if (!in_array('CERTIFICATE-INCORPORATION-COPY', $docName)) {
                $docChoices['Copy of Certified Certificate of Incorporation or Business Registration Details'] = 'CERTIFICATE-INCORPORATION-COPY';
            }**/
            if (!in_array('CONTRACTS-COPY', $docName)) {
                $docChoices['Certified Copy(s) of Contracts or Agreements Between The Publisher and The Authors/Composers'] = 'CONTRACTS-COPY';
            }
            if (!in_array('DIR1-PASSPORT-PHOTO', $docName)) {
                $docChoices['Colour Passport-Size Photo Of Director 1'] = 'DIR1-PASSPORT-PHOTO';
            }
            if (!in_array('DIR1-ID-COPY', $docName)) {
                $docChoices['Copy of frontside of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
            }
             if (!in_array('DIR1-ID-COPY-BACK', $docName)) {
                $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY-BACK';
            }
            if ($profile->getCompanyType()!="Sole Proprietorship"&&$profile->getNumberOfDirectors()==2){
                if (!in_array('DIR2-PASSPORT-PHOTO', $docName)) {
                    $docChoices['Colour Passport-Size Photo Of Director 2'] = 'DIR2-PASSPORT-PHOTO';
                }
                if (!in_array('DIR2-ID-COPY', $docName)) {
                    $docChoices['Copy of frontside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY';
                }
                if (!in_array('DIR2-ID-COPY-BACK', $docName)) {
                    $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY-BACK';
                }
                if (!in_array('KRA-PIN', $docName)) {
                    $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                }
            }else{
                if (!in_array('KIN-ID', $docName)) {
                    $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'KIN-ID';
                }
                if (!in_array('KRA-PIN', $docName)) {
                    $docChoices['Copy of your Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                }
            }

        }else {
            if ($profile->getCompanyType()!="Sole Proprietorship"){
                $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
                $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                $docChoices['Copy of Certificate of Registration or Incorporation'] = 'REG-CERT';
                $docChoices['Colour Passport-Size Photo Of Director 1'] = 'DIR1-PASSPORT-PHOTO';
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
                $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY-BACK';
                if ($profile->getNumberOfDirectors()==2) {
                    $docChoices['Colour Passport-Size Photo Of Director 2'] = 'DIR2-PASSPORT-PHOTO';
                    $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY';
                     $docChoices['Copy of backside of Valid National ID/Passport/Birth Certificate Of Director 2'] = 'DIR2-ID-COPY-BACK';
                }else {
                    $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'KIN-ID';

                    $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                }
            }else{
                $docChoices['Copy of Signed Deed of Assignment'] = 'DEED-OF-ASSIGNMENT';
                $docChoices['Copy of Signed Mechanical Rights Agreement'] = 'MECHANICAL-RIGHTS-FORM';
                $docChoices['Copy of Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';
                $docChoices['Copy of Certificate of Business Name Registration'] = 'REG-CERT';
                if ($user->getUserType=="Publisher"){
                    $docChoices['CR12'] = 'CR12';
                    $docChoices['Cover Letter on the Company’s Letter Head'] = 'COVER-LETTER';
                   // $docChoices['Copy of Certified Certificate of Incorporation or Business Registration Details'] = 'CERTIFICATE-INCORPORATION-COPY';
                    $docChoices['Certified Copy(s) of Contracts or Agreements Between The Publisher and The Authors/Composers'] = 'CONTRACTS-COPY';
                 }
                $docChoices['Colour Passport-Size Photo'] = 'DIR1-PASSPORT-PHOTO';
                $docChoices['Copy of frontside of your Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY';
                $docChoices['Copy of backside of your Valid National ID/Passport/Birth Certificate Of Director 1'] = 'DIR1-ID-COPY-BACK';
                $docChoices['Copy of Valid Next of Kin/Beneficiary National ID/Passport/Birth Certificate'] = 'KIN-ID';
                $docChoices['Copy of your Kenya Revenue Authority ITAX Updated Pin Certificate'] = 'KRA-PIN';

            }

        }
        $em = $this->getDoctrine()->getManager();

        $document = new Documents();
        $document->setWhichCorporateProfile($profile);

        $form = $this->createForm(DocumentsFormType::class, $document,['docChoices'=>$docChoices]);

        $form = $this->createForm(DocumentsFormType::class, $document,['docChoices'=>$docChoices]);

        return $this->render('home/corporate/docUploadForm.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }
    /**

     * @Route("/uploaded/corp/docs",name="uploaded-corporate-documents")

     */
    public function corpUploadedDocumentsAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();

        return $this->render('home/corporate/docUpload.htm.twig',[
            'profile'=>$profile
        ]);
    }
    /**

     * @Route("/update/individual/recording",name="recording-sample")

     */
    public function recordingSamplesAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser(); 
        $profile = $user->getProfile();
        $profile->setProgress("Recording");

        $recording = new Music();
        $recording->setCreatedAt(new \DateTime());
        $recording->setUpdatedAt(new \DateTime());
        $recording->setWhichProfile($profile);

        $form = $this->createForm(NewRecordingForm::class,$recording);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $sample = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($sample);
            $em->flush();

            return $this->redirectToRoute('recording-sample');

        }elseif($form->isSubmitted()&&!$form->isValid()){
            return new Response(null,500);
        }

        return $this->render(':home/samples:musicSample.htm.twig',[
            'profile'=>$profile,
            'form'=>$form->createView()
        ]);
    }
    /**

     * @Route("/update/uploaded-recording",name="uploaded-individual-recording")

     */
    public function uploadedRecordingSamplesAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();

        return $this->render(':home/samples:sampleUpload.htm.twig',[
            'profile'=>$profile
        ]);
    }

    /**

     * @Route("/sample-upload-form",name="sample-upload-form")

     */
    public function sampleUploadFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();

        $recording = new Music();
        $recording->setCreatedAt(new \DateTime());
        $recording->setUpdatedAt(new \DateTime());
        $recording->setWhichProfile($profile);

        $form = $this->createForm(NewRecordingForm::class,$recording);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $sample = $form->getData();
           // $file=$form->get('recordingFile')->getData();
            $file=$form["recordingFile"]->getData();
            $musicname=$form["recordingTitle"]->getData();
           
          /***  $curl = curl_init('http://localhost/vetting/postFileInt.php?file=$file');
           curl_setopt($curl, CURLOPT_FAILONERROR, true);
           curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
           */
          $real_path='/var/www/mcsk-member-registration-v0.1';
                
            $em = $this->getDoctrine()->getManager();
            $em->persist($sample);
            $em->flush();
            $cFile= $real_path.'/web/assets/recordings/'. $file;
            //die($file);
            
            if(file_exists($cFile)){
               /***  if (function_exists('curl_file_create')) { // php 5.5+
                    $cFiles = curl_file_create($cFile);
                  } else { // 
                    $cFiles = '@' . realpath($cFile);
                  } */
                  $cFiles='@' . $cFile;
                $post = array('file'=> $cFiles);
                $target_url='http://localhost/vetting/postFileInt.php';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$target_url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                $result=curl_exec ($ch);
                curl_close ($ch);
                $obj = json_decode($result);
                if($obj->success==1){ 
                    return new Response($result['message'],200);
                    $this->sendMusicVerificationSuccessEmail($user->getFirstName(), $user->getEmail(), $musicname);
            } else{
                return new Response($result['message'],500);
                $this->sendMusicVerificationFailedEmail($user->getFirstName(), $user->getEmail(), $musicname);
            } }
            return new Response(null,200);
        }elseif($form->isSubmitted()&&!$form->isValid()){
            return new Response(null,500);
        }
        return $this->render(':home/samples:sampleUploadForm.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }

    /**

     * @Route("/update/corporate/recording",name="corporate-recording-sample")

     */
    public function corporateRecordingSamplesAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $profile = $user->getCorporateProfile();
        $profile->setProgress("Recording");

        $recording = new Music();
        $recording->setCreatedAt(new \DateTime());
        $recording->setUpdatedAt(new \DateTime());
        $recording->setWhichCorporateProfile($profile);

        $form = $this->createForm(NewRecordingForm::class,$recording);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $sample = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($recording);
            $em->persist($sample);
            $em->flush();

            return $this->redirectToRoute('corporate-recording-sample');
        }elseif($form->isSubmitted()&&!$form->isValid()){
            return new Response(null,500);
        }

        return $this->render(':home/corporate/samples:musicSample.htm.twig',[
            'profile'=>$profile,
            'form'=>$form->createView()
        ]);
    }
    /**

     * @Route("/update/uploaded-corporate-recording",name="uploaded-corporate-recording")

     */
    public function uploadedCorporateRecordingSamplesAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();

        return $this->render(':home/corporate/samples:sampleUpload.htm.twig',[
            'profile'=>$profile
        ]);
    }

    /**

     * @Route("/sample-corporate-upload-form",name="sample-corporate-upload-form")

     */
    public function sampleCorporateUploadFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();

        $recording = new Music();
        $recording->setCreatedAt(new \DateTime());
        $recording->setUpdatedAt(new \DateTime());
        $recording->setWhichCorporateProfile($profile);

        $form = $this->createForm(NewRecordingForm::class,$recording);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $sample = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($sample);
            $em->flush();

            return new Response(null,200);
        }elseif($form->isSubmitted()&&!$form->isValid()){
            return new Response(null,500);
        }
        return $this->render(':home/corporate/samples:sampleUploadForm.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }

    /**

     * @Route("/update/individual/confirm",name="confirm-profile")

     */
    public function confirmProfileAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();
        $profile->setProgress("Confirmation");

        $form = $this->createForm(ProfileKinForm::class,$profile);

        return $this->render(':home:confirm.htm.twig',[
            'profileForm'=>$form->createView(),
            'profile'=>$profile
        ]);

    }
    /**

     * @Route("/update/corporate/confirm",name="corporate-confirm-profile")

     */
    public function corporateConfirmProfileAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();
        $profile->setProgress("Confirmation");

        //$form = $this->createForm(ProfileKinForm::class,$profile);

        return $this->render(':home/corporate:sole-confirm.htm.twig',[
          //  'profileForm'=>$form->createView(),
            'profile'=>$profile
        ]);

    }
    /**

     * @Route("/update/payment",name="payment")

     */
    public function paymentAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $profile = $user->getProfile();
        $profile->setProgress("Payment");

        $form = $this->createForm(PaymentForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $amount = 1;
            $phoneNumber = $form["mobileNumber"]->getData();
            $prof = $form->getData();

            $referenceId = time();

            $prof->setProfileStatus("Pending");
            $prof->setIdemnifyAt(new \DateTime());
            $prof->setReferenceId($referenceId);
            $em->persist($prof);
            $em->flush();

        $firstCharacter = $phoneNumber[0];

            if ($firstCharacter == "0" or $firstCharacter == 0){
                $phoneNumber = "254".substr($phoneNumber,1);
            }

             if ($profile->getMpesaStatus()!="Success")
             {
            
            $this->sendStkPush($amount,$phoneNumber,$profile->getId(),"prof");
        }

            return $this->redirectToRoute('payment-confirmed');


        }

        return $this->render('home/payment/payment.htm.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**

     * @Route("/payment/confirm",name="payment-confirmed")

     */
    public function paymentConfirmation(Request $request){  
        $user = $this->get('security.token_storage')->getToken()->getUser();  

        $profile = $user->getProfile();

        $form = $this->createForm(VerificationForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($profile->getMpesaStatus()=="Success"){
                $amount = $profile->getMpesaAmount();
                $mpesaCode = $profile->getMpesaConfirmationCode();
                $transDate = $profile->getMpesaPaymentDate();
                $phoneNumber = $profile->getMpesaNumber();
        /**$this->sendSms("Payment Successful! 
                Hello ".$user->getFirstName()." Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                A member of our team will be in touch to update you during the review process.
                Thank you!
                MCSK Team",$phoneNumber);**/
                $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);
                $this->sendPaymentEmail($user->getFirstName(), $user->getEmail(), $transactionArray);
               return new Response(null,200);
                
            }else{
                return new Response(null,500);
                 
            }
        }
        return $this->render('home/payment/paymentConfirmation.htm.twig',[      
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }

    /**

     * @Route("/payment/form",name="payment-form")

     */
    public function paymentFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();
        $profile->setIdemnifyAt(new \DateTime());

        $form = $this->createForm(PaymentForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $amount = 10;
            $phoneNumber = $form["mobileNumber"]->getData();
            $referenceId = time();

        $firstCharacter = $phoneNumber[0];

            if ($firstCharacter == "0" or $firstCharacter == 0){
                $phoneNumber = "254".substr($phoneNumber,1);
            }

            $this->sendStkPush($amount,$phoneNumber,$profile->getId(),"prof");
            
        }

        return $this->render('home/payment/paymentForm.htm.twig',[
            'form'=>$form->createView(),

        ]);
    }
    /**

     * @Route("/payment/confirm/form",name="payment-confirmation-form")

     */
    public function paymentConfirmationFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();

        $form = $this->createForm(VerificationForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
          if ($profile->getMpesaStatus()=="Success"){   
              $amount = $profile->getMpesaAmount();
              $mpesaCode = $profile->getMpesaConfirmationCode();
              $transDate = $profile->getMpesaPaymentDate();
              $phoneNumber = $profile->getMpesaNumber();
              /**$this->sendSms("Payment Successful! 
                Hello ".$user->getFirstName()." Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                A member of our team will be in touch to update you during the review process.
                Thank you!
                MCSK Team",$phoneNumber);**/
              $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);
              $this->sendPaymentEmail($user->getFirstName(), $user->getEmail(), $transactionArray);
              //$transactionArray
              return new Response(null,200);
          }else{
              return new Response(null,500);
          }

        }

        return $this->render('home/payment/confirmPayment.htm.twig',[
            'form'=>$form->createView(),

        ]);
    }

    /**

     * @Route("/payment/details",name="payment-details")

     */
    public function paymentDetailsAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getProfile();

        return $this->render(':home/payment:paymentDetails.htm.twig',[
            'profile'=>$profile
        ]);
    }
    
    /**

     * @Route("/update/corporate/payment",name="corporatepayment")

     */
    public function corporatePaymentAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $profile = $user->getCorporateProfile();
        $profile->setProgress("Payment");

        $form = $this->createForm(CorporatePaymentForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $amount = 1;
            $phoneNumber = $form["mobileNumber"]->getData();
            $prof = $form->getData();
            $referenceId = time();
            $prof->setProfileStatus("Pending");
            $prof->setReferenceId($referenceId);
            $prof->setIdemnifyAt(new \DateTime());
            $em->persist($prof);
            $em->flush();

        $firstCharacter = $phoneNumber[0];

            if ($firstCharacter == "0" or $firstCharacter == 0){
                $phoneNumber = "254".substr($phoneNumber,1);
            }

            
            if ($profile->getMpesaStatus()!="Success")
             {
            
            $this->sendStkPush($amount,$phoneNumber,$profile->getId(),"corp");
       }

            return $this->redirectToRoute('corporate-payment-confirmed');
        }

        return $this->render('home/corporate/payment/payment.htm.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**

     * @Route("/payment/corporate/confirm",name="corporate-payment-confirmed")

     */
    public function corporatePaymentConfirmation(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();

        $form = $this->createForm(VerificationForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($profile->getMpesaStatus()=="Success"){
                $amount = $profile->getMpesaAmount();
                $mpesaCode = $profile->getMpesaConfirmationCode();
                $transDate = $profile->getMpesaPaymentDate();
                $phoneNumber = $profile->getMpesaNumber();
            /**$this->sendSms("Payment Successful! 
                Hello ".$user->getFirstName()." Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                A member of our team will be in touch to update you during the review process.
                Thank you!
                MCSK Team",$phoneNumber);**/
                $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);
                $this->sendPaymentEmail($user->getFirstName(), $user->getEmail(), $transactionArray);
                return new Response(null,200);
            }else{
                return new Response(null,500);
            }
        }
        return $this->render('home/corporate/payment/paymentConfirmation.htm.twig',[
            'form'=>$form->createView(),
            'profile'=>$profile
        ]);
    }

    /**

     * @Route("/payment/corporate/form",name="corporate-payment-form")

     */
    public function corporatePaymentFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();
        $profile->setIdemnifyAt(new \DateTime());

        $form = $this->createForm(CorporatePaymentForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){
            $amount = 1;
            $phoneNumber = $form["mobileNumber"]->getData();
            $referenceId = time();
            $firstCharacter = $phoneNumber[0];

            if ($firstCharacter == "0" or $firstCharacter == 0){
                $phoneNumber = "254".substr($phoneNumber,1);
            }

            $this->sendStkPush($amount,$phoneNumber,$profile->getId(),"corp");
          
        }

        return $this->render('home/corporate/payment/paymentForm.htm.twig',[
            'form'=>$form->createView(),

        ]);
    }

    /**

     * @Route("/payment/corporate/confirm/form",name="corporate-payment-confirmation-form")

     */
    public function corporatePaymentConfirmationFormAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();

        $form = $this->createForm(VerificationForm::class,$profile);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($profile->getMpesaStatus()=="Success"){
                $amount = $profile->getMpesaAmount();
                $mpesaCode = $profile->getMpesaConfirmationCode();
                $transDate = $profile->getMpesaPaymentDate();
                $phoneNumber = $profile->getMpesaNumber();
            $this->sendSms("Payment Successful! 
                Hello ".$user->getFirstName()." Thank you for paying your Membership Fee and updating your profile on the MCSK Online Portal.
                MCSK has successfully received your M-Pesa payment with the details below and your profile has been submitted for review.
                Mpesa Confirmation Code: ".$mpesaCode."
                Mpesa Payment Date: ".$transDate."
                Mpesa Number: ".$phoneNumber."
                Amount: Ksh ".$amount."
                A member of our team will be in touch to update you during the review process.
                Thank you!
                MCSK Team",$phoneNumber);
                $transactionArray = array("a" => $mpesaCode, "b" => $transDate, "c" => $phoneNumber, "d" => $amount);
                $this->sendPaymentEmail($user->getFirstName(), $user->getEmail(), $transactionArray);
                return new Response(null,200);
            }else{
                return new Response(null,500);
            }

        }

        return $this->render('home/corporate/payment/confirmPayment.htm.twig',[
            'form'=>$form->createView(),

        ]);
    }

    /**

     * @Route("/payment/corporate/details",name="corporate-payment-details")

     */
    public function corporatePaymentDetailsAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $profile = $user->getCorporateProfile();

        return $this->render(':home/corporate/payment:paymentDetails.htm.twig',[
            'profile'=>$profile
        ]);
    }

    public function sendPaymentEmail($firstName, $emailAddress, $code)
    {
       $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
       /*** $message = \Swift_Message::newInstance()
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
        $this->get('mailer')->send($message); */
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
    public function sendMusicVerificationSuccessEmail($firstName, $emailAddress, $code)
    {
       $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
       /*** $message = \Swift_Message::newInstance()
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
        $this->get('mailer')->send($message); */
        $body=$this->renderView(
            'Emails/vetting.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "membership@mcsk.or.ke");
$subject = "MCSK Online Portal Music Sample Verification";
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);


    }
    public function sendMusicVerificationFailedEmail($firstName, $emailAddress, $code)
    {
       $real_path='/var/www/mcsk-member-registration-v0.1';
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php');
      require_once($real_path.'/vendor/sendgrid/sendgrid/lib/SendGrid.php');
      require_once($real_path.'/vendor/sendgrid/php-http-client/lib/SendGrid/Client.php');
       /*** $message = \Swift_Message::newInstance()
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
        $this->get('mailer')->send($message); */
        $body=$this->renderView(
            'Emails/vetting-fail.htm.twig',
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                );

$from = new SendGrid\Email(null, "membership@mcsk.or.ke");
$subject = "MCSK Online Portal Music Sample Verification";
$to = new SendGrid\Email(null, $emailAddress);
$content = new SendGrid\Content("text/html", $body);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);


    }
    
    
    public function sendStkPush($amount,$phoneNumber,$profileid,$type){
        $mpesa= new \Safaricom\Mpesa\Mpesa();

          $stkPushSimulation=$mpesa->STKPushSimulation(
            "174379",
            "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919",
            "CustomerPayBillOnline",
            $amount,
            $phoneNumber,
            "174379",
            $phoneNumber,
            "https://mcsk-mpesa.techsavanna.technology/mpesa.php?profid=".$profileid."&mpesanumber=".$phoneNumber."&type=".$type,
            $phoneNumber,
            "Membership Fee",
            "Membership Fee");
       

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
