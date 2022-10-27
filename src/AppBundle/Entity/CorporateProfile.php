<?php
/*********************************************************************************
 * Karbon Framework is a PHP5 Framework developed by Maxx Ng'ang'a
 * (C) 2016 Crysoft Dynamics Ltd
 * Karbon V 1.0
 * Maxx
 * 5/1/2017
 ********************************************************************************/

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CorporateRepository")
 * @ORM\Table(name="corporate")
 */
class CorporateProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $prefferedRegion;
    /**
     * @ORM\Column(type="string")
     */
    private $progress = "Initial";
    /**
     * @ORM\Column(type="string")
     */
    private $companyType;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $territorialAssignment;
    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfDirectors=1;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $companyName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $tradingName;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $firstDirectorNames;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $firstDirectorPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $firstDirectorIdNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondDirectorNames;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondDirectorPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondDirectorIdNumber;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $memberNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $itaxPin;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $regNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $physicalAddress;
    /**
     * @ORM\Column(type="string")
     */
    private $city;
    /**
     * @ORM\Column(type="string")
     */
    private $county;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $postalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $postalCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $telephone;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank(message="Your Phone Number has to be provided")
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $mobileNumber;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $emailAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $emailAddress2;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $website;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinFirstName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinMiddleName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinLastName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinRelationship;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinIdNumber;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $kinDateOfBirth;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinGender;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinPhysicalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinCity;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinCounty;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinPostalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinPostalCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $kinTelephoneNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $kinMobileNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinEmailAddress;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isKinMinor=false;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $kinGuardian;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $registrationDate;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $status;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank(message="Your Phone Number has to be provided")
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $paymentMpesaNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $royaltiesMpesaNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $accountName;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $accountNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $bank;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $bankBranch;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $bankCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sortCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $swiftCode;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isCollectingSocietiesMember=false;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $collectingSocieties;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $collectingSocietiesNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $transactionId;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isPaid=false;
    /**
     * @ORM\Column(type="boolean")
     */
    private $mpesaProcessed=false;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaConfirmationCode;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $mpesaPaymentDate;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaStatus;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaDescription;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaAmount;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $mpesaVerificationCode;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isUrlvalid;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $profileStatus;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $statusDescription;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isMembershipApproved;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $membershipApprovedBy;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $membershipApprovedAt;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isBoardApproved;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isBoardRejected;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $boardRejectionAt;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $boardRejectionBy;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $boardRejectionReason;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nrBoardApprovals;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $boardApprover1;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $boardApprover2;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $boardApprover3;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $boardApprovalStatus1;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $boardApprovalStatus2;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $boardApprovalStatus3;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $approval1At;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $approval2At;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $approval3At;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $createdAt;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isCommitteeApproved;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isCommitteeRejected;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $committeeRejectionAt;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $committeeRejectionBy;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $committeeRejectionReason;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nrCommitteeApprovals;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $committeeApprover1;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $committeeApprover2;
    /**
    * @ORM\Column(type="string",nullable=true)
     */
    private $guarantor;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $committeeApprover3;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $committeeApprovalStatus1;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $committeeApprovalStatus2;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $committeeApprovalStatus3;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $committeeApproval1At;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $committeeApproval2At;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $committeeApproval3At;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $processedBy;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $processedAt;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $accountCreated;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Documents",mappedBy="whichCorporateProfile",fetch="EXTRA_LAZY")
     */
    private $corporateProfileDocuments;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Music",mappedBy="whichCorporateProfile",fetch="EXTRA_LAZY")
     */
    private $corporateMusicSamples;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $termsOfService;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $idemnifyFirstName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $idemnifyLastName;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $idemnifyAt;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $referenceId;

    function __construct()
    {
        $this->profileDocuments = new ArrayCollection();
        $this->corporateProfileDocuments = new ArrayCollection();
        $this->corporateMusicSamples = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @param mixed $referenceId
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param mixed $progress
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;
    }

    /**
     * @return mixed
     */
    public function getNumberOfDirectors()
    {
        return $this->numberOfDirectors;
    }

    /**
     * @param mixed $numberOfDirectors
     */
    public function setNumberOfDirectors($numberOfDirectors)
    {
        $this->numberOfDirectors = $numberOfDirectors;
    }

    /**
     * @return mixed
     */
    public function getCorporateMusicSamples()
    {
        return $this->corporateMusicSamples;
    }

    /**
     * @return mixed
     */
    public function getTermsOfService()
    {
        return $this->termsOfService;
    }

    /**
     * @param mixed $termsOfService
     */
    public function setTermsOfService($termsOfService)
    {
        $this->termsOfService = $termsOfService;
    }

    /**
     * @return mixed
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * @param mixed $companyType
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;
    }
    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getTradingName()
    {
        return $this->tradingName;
    }

    /**
     * @param mixed $tradingName
     */
    public function setTradingName($tradingName)
    {
        $this->tradingName = $tradingName;
    }

    /**
     * @return mixed
     */
    public function getFirstDirectorNames()
    {
        return $this->firstDirectorNames;
    }

    /**
     * @param mixed $firstDirectorNames
     */
    public function setFirstDirectorNames($firstDirectorNames)
    {
        $this->firstDirectorNames = $firstDirectorNames;
    }

    /**
     * @return mixed
     */
    public function getFirstDirectorPosition()
    {
        return $this->firstDirectorPosition;
    }

    /**
     * @param mixed $firstDirectorPosition
     */
    public function setFirstDirectorPosition($firstDirectorPosition)
    {
        $this->firstDirectorPosition = $firstDirectorPosition;
    }

    /**
     * @return mixed
     */
    public function getFirstDirectorIdNumber()
    {
        return $this->firstDirectorIdNumber;
    }

    /**
     * @param mixed $firstDirectorIdNumber
     */
    public function setFirstDirectorIdNumber($firstDirectorIdNumber)
    {
        $this->firstDirectorIdNumber = $firstDirectorIdNumber;
    }

    /**
     * @return mixed
     */
    public function getSecondDirectorNames()
    {
        return $this->secondDirectorNames;
    }

    /**
     * @param mixed $secondDirectorNames
     */
    public function setSecondDirectorNames($secondDirectorNames)
    {
        $this->secondDirectorNames = $secondDirectorNames;
    }

    /**
     * @return mixed
     */
    public function getSecondDirectorPosition()
    {
        return $this->secondDirectorPosition;
    }

    /**
     * @param mixed $secondDirectorPosition
     */
    public function setSecondDirectorPosition($secondDirectorPosition)
    {
        $this->secondDirectorPosition = $secondDirectorPosition;
    }

    /**
     * @return mixed
     */
    public function getSecondDirectorIdNumber()
    {
        return $this->secondDirectorIdNumber;
    }

    /**
     * @param mixed $secondDirectorIdNumber
     */
    public function setSecondDirectorIdNumber($secondDirectorIdNumber)
    {
        $this->secondDirectorIdNumber = $secondDirectorIdNumber;
    }

    /**
     * @return mixed
     */
    public function getMemberNumber()
    {
        return $this->memberNumber;
    }

    /**
     * @param mixed $memberNumber
     */
    public function setMemberNumber($memberNumber)
    {
        $this->memberNumber = $memberNumber;
    }



    /**
     * @return mixed
     */
    public function getItaxPin()
    {
        return $this->itaxPin;
    }

    /**
     * @param mixed $itaxPin
     */
    public function setItaxPin($itaxPin)
    {
        $this->itaxPin = $itaxPin;
    }

    /**
     * @return mixed
     */
    public function getRegNumber()
    {
        return $this->regNumber;
    }

    /**
     * @param mixed $regNumber
     */
    public function setRegNumber($regNumber)
    {
        $this->regNumber = $regNumber;
    }

    /**
     * @return mixed
     */
    public function getPhysicalAddress()
    {
        return $this->physicalAddress;
    }

    /**
     * @param mixed $physicalAddress
     */
    public function setPhysicalAddress($physicalAddress)
    {
        $this->physicalAddress = $physicalAddress;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param mixed $county
     */
    public function setCounty($county)
    {
        $this->county = $county;
    }

    /**
     * @return mixed
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * @param mixed $postalAddress
     */
    public function setPostalAddress($postalAddress)
    {
        $this->postalAddress = $postalAddress;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }
    /**
     * @return mixed
     */
    public function getPrefferedRegion()
    {
        return $this->prefferedRegion;
    }

    /**
     * @param mixed $prefferedRegion
     */
    public function setPrefferedRegion($prefferedRegion)
    {
        $this->prefferedRegion = $prefferedRegion;
    }
    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $firstCharacter = $telephone[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $telephone = "254".substr($telephone,1);
        }

        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @param mixed $mobileNumber
     */
    public function setMobileNumber($mobileNumber)
    {
        $firstCharacter = $mobileNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $mobileNumber = "254".substr($mobileNumber,1);
        }

        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress2()
    {
        return $this->emailAddress2;
    }

    /**
     * @param mixed $emailAddress2
     */
    public function setEmailAddress2($emailAddress2)
    {
        $this->emailAddress2 = $emailAddress2;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getKinFirstName()
    {
        return $this->kinFirstName;
    }

    /**
     * @param mixed $kinFirstName
     */
    public function setKinFirstName($kinFirstName)
    {
        $this->kinFirstName = $kinFirstName;
    }

    /**
     * @return mixed
     */
    public function getKinMiddleName()
    {
        return $this->kinMiddleName;
    }

    /**
     * @param mixed $kinMiddleName
     */
    public function setKinMiddleName($kinMiddleName)
    {
        $this->kinMiddleName = $kinMiddleName;
    }

    /**
     * @return mixed
     */
    public function getKinLastName()
    {
        return $this->kinLastName;
    }

    /**
     * @param mixed $kinLastName
     */
    public function setKinLastName($kinLastName)
    {
        $this->kinLastName = $kinLastName;
    }

    /**
     * @return mixed
     */
    public function getKinRelationship()
    {
        return $this->kinRelationship;
    }

    /**
     * @param mixed $kinRelationship
     */
    public function setKinRelationship($kinRelationship)
    {
        $this->kinRelationship = $kinRelationship;
    }

    /**
     * @return mixed
     */
    public function getKinIdNumber()
    {
        return $this->kinIdNumber;
    }

    /**
     * @param mixed $kinIdNumber
     */
    public function setKinIdNumber($kinIdNumber)
    {
        $this->kinIdNumber = $kinIdNumber;
    }

    /**
     * @return mixed
     */
    public function getKinDateOfBirth()
    {
        return $this->kinDateOfBirth;
    }

    /**
     * @param mixed $kinDateOfBirth
     */
    public function setKinDateOfBirth($kinDateOfBirth)
    {
        $this->kinDateOfBirth = $kinDateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getKinGender()
    {
        return $this->kinGender;
    }

    /**
     * @param mixed $kinGender
     */
    public function setKinGender($kinGender)
    {
        $this->kinGender = $kinGender;
    }

    /**
     * @return mixed
     */
    public function getKinPhysicalAddress()
    {
        return $this->kinPhysicalAddress;
    }

    /**
     * @param mixed $kinPhysicalAddress
     */
    public function setKinPhysicalAddress($kinPhysicalAddress)
    {
        $this->kinPhysicalAddress = $kinPhysicalAddress;
    }

    /**
     * @return mixed
     */
    public function getKinCity()
    {
        return $this->kinCity;
    }

    /**
     * @param mixed $kinCity
     */
    public function setKinCity($kinCity)
    {
        $this->kinCity = $kinCity;
    }

    /**
     * @return mixed
     */
    public function getKinCounty()
    {
        return $this->kinCounty;
    }

    /**
     * @param mixed $kinCounty
     */
    public function setKinCounty($kinCounty)
    {
        $this->kinCounty = $kinCounty;
    }

    /**
     * @return mixed
     */
    public function getKinPostalAddress()
    {
        return $this->kinPostalAddress;
    }

    /**
     * @param mixed $kinPostalAddress
     */
    public function setKinPostalAddress($kinPostalAddress)
    {
        $this->kinPostalAddress = $kinPostalAddress;
    }

    /**
     * @return mixed
     */
    public function getKinPostalCode()
    {
        return $this->kinPostalCode;
    }

    /**
     * @param mixed $kinPostalCode
     */
    public function setKinPostalCode($kinPostalCode)
    {
        $this->kinPostalCode = $kinPostalCode;
    }

    /**
     * @return mixed
     */
    public function getKinTelephoneNumber()
    {
        return $this->kinTelephoneNumber;
    }

    /**
     * @param mixed $kinTelephoneNumber
     */
    public function setKinTelephoneNumber($kinTelephoneNumber)
    {
        $firstCharacter = $kinTelephoneNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $kinTelephoneNumber = "254".substr($kinTelephoneNumber,1);
        }
        $this->kinTelephoneNumber = $kinTelephoneNumber;
    }

    /**
     * @return mixed
     */
    public function getKinMobileNumber()
    {
        return $this->kinMobileNumber;
    }

    /**
     * @param mixed $kinMobileNumber
     */
    public function setKinMobileNumber($kinMobileNumber)
    {
        $firstCharacter = $kinMobileNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $kinMobileNumber = "254".substr($kinMobileNumber,1);
        }
        $this->kinMobileNumber = $kinMobileNumber;
    }

    /**
     * @return mixed
     */
    public function getKinEmailAddress()
    {
        return $this->kinEmailAddress;
    }

    /**
     * @param mixed $kinEmailAddress
     */
    public function setKinEmailAddress($kinEmailAddress)
    {
        $this->kinEmailAddress = $kinEmailAddress;
    }

    /**
     * @return mixed
     */
    public function getIsKinMinor()
    {
        return $this->isKinMinor;
    }

    /**
     * @param mixed $isKinMinor
     */
    public function setIsKinMinor($isKinMinor)
    {
        $this->isKinMinor = $isKinMinor;
    }

    /**
     * @return mixed
     */
    public function getKinGuardian()
    {
        return $this->kinGuardian;
    }

    /**
     * @param mixed $kinGuardian
     */
    public function setKinGuardian($kinGuardian)
    {
        $this->kinGuardian = $kinGuardian;
    }

    /**
     * @return mixed
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * @param mixed $registrationDate
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPaymentMpesaNumber()
    {
        return $this->paymentMpesaNumber;
    }

    /**
     * @param mixed $paymentMpesaNumber
     */
    public function setPaymentMpesaNumber($paymentMpesaNumber)
    {
        $firstCharacter = $paymentMpesaNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $paymentMpesaNumber = "254".substr($paymentMpesaNumber,1);
        }

        $this->paymentMpesaNumber = $paymentMpesaNumber;
    }

    /**
     * @return mixed
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param mixed $accountName
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param mixed $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @param mixed $bank
     */
    public function setBank($bank)
    {
        $this->bank = $bank;
    }

    /**
     * @return mixed
     */
    public function getBankBranch()
    {
        return $this->bankBranch;
    }

    /**
     * @param mixed $bankBranch
     */
    public function setBankBranch($bankBranch)
    {
        $this->bankBranch = $bankBranch;
    }

    /**
     * @return mixed
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @param mixed $bankCode
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
    }

    /**
     * @return mixed
     */
    public function getSortCode()
    {
        return $this->sortCode;
    }

    /**
     * @param mixed $sortCode
     */
    public function setSortCode($sortCode)
    {
        $this->sortCode = $sortCode;
    }

    /**
     * @return mixed
     */
    public function getSwiftCode()
    {
        return $this->swiftCode;
    }

    /**
     * @param mixed $swiftCode
     */
    public function setSwiftCode($swiftCode)
    {
        $this->swiftCode = $swiftCode;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param mixed $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return mixed
     */
    public function getIsPaid()
    {
        return $this->isPaid;
    }

    /**
     * @param mixed $isPaid
     */
    public function setIsPaid($isPaid)
    {
        $this->isPaid = $isPaid;
    }

    /**
     * @return mixed
     */
    public function getMpesaProcessed()
    {
        return $this->mpesaProcessed;
    }

    /**
     * @param mixed $mpesaProcessed
     */
    public function setMpesaProcessed($mpesaProcessed)
    {
        $this->mpesaProcessed = $mpesaProcessed;
    }

    /**
     * @return mixed
     */
    public function getMpesaConfirmationCode()
    {
        return $this->mpesaConfirmationCode;
    }

    /**
     * @param mixed $mpesaConfirmationCode
     */
    public function setMpesaConfirmationCode($mpesaConfirmationCode)
    {
        $this->mpesaConfirmationCode = $mpesaConfirmationCode;
    }

    /**
     * @return mixed
     */
    public function getMpesaPaymentDate()
    {
        return $this->mpesaPaymentDate;
    }

    /**
     * @param mixed $mpesaPaymentDate
     */
    public function setMpesaPaymentDate($mpesaPaymentDate)
    {
        $this->mpesaPaymentDate = $mpesaPaymentDate;
    }

    /**
     * @return mixed
     */
    public function getMpesaStatus()
    {
        return $this->mpesaStatus;
    }

    /**
     * @param mixed $mpesaStatus
     */
    public function setMpesaStatus($mpesaStatus)
    {
        $this->mpesaStatus = $mpesaStatus;
    }

    /**
     * @return mixed
     */
    public function getMpesaDescription()
    {
        return $this->mpesaDescription;
    }

    /**
     * @param mixed $mpesaDescription
     */
    public function setMpesaDescription($mpesaDescription)
    {
        $this->mpesaDescription = $mpesaDescription;
    }

    /**
     * @return mixed
     */
    public function getMpesaNumber()
    {
        return $this->mpesaNumber;
    }

    /**
     * @param mixed $mpesaNumber
     */
    public function setMpesaNumber($mpesaNumber)
    {
        $this->mpesaNumber = $mpesaNumber;
    }

    /**
     * @return mixed
     */
    public function getMpesaAmount()
    {
        return $this->mpesaAmount;
    }

    /**
     * @param mixed $mpesaAmount
     */
    public function setMpesaAmount($mpesaAmount)
    {
        $this->mpesaAmount = $mpesaAmount;
    }

    /**
     * @return mixed
     */
    public function getMpesaVerificationCode()
    {
        return $this->mpesaVerificationCode;
    }

    /**
     * @param mixed $mpesaVerificationCode
     */
    public function setMpesaVerificationCode($mpesaVerificationCode)
    {
        $this->mpesaVerificationCode = $mpesaVerificationCode;
    }

    /**
     * @return mixed
     */
    public function getIsUrlvalid()
    {
        return $this->isUrlvalid;
    }

    /**
     * @param mixed $isUrlvalid
     */
    public function setIsUrlvalid($isUrlvalid)
    {
        $this->isUrlvalid = $isUrlvalid;
    }

    /**
     * @return mixed
     */
    public function getProfileStatus()
    {
        return $this->profileStatus;
    }

    /**
     * @param mixed $profileStatus
     */
    public function setProfileStatus($profileStatus)
    {
        $this->profileStatus = $profileStatus;
    }

    /**
     * @return mixed
     */
    public function getStatusDescription()
    {
        return $this->statusDescription;
    }

    /**
     * @param mixed $statusDescription
     */
    public function setStatusDescription($statusDescription)
    {
        $this->statusDescription = $statusDescription;
    }

    /**
     * @return mixed
     */
    public function getIsMembershipApproved()
    {
        return $this->isMembershipApproved;
    }

    /**
     * @param mixed $isMembershipApproved
     */
    public function setIsMembershipApproved($isMembershipApproved)
    {
        $this->isMembershipApproved = $isMembershipApproved;
    }

    /**
     * @return mixed
     */
    public function getMembershipApprovedBy()
    {
        return $this->membershipApprovedBy;
    }

    /**
     * @param mixed $membershipApprovedBy
     */
    public function setMembershipApprovedBy($membershipApprovedBy)
    {
        $this->membershipApprovedBy = $membershipApprovedBy;
    }

    /**
     * @return mixed
     */
    public function getMembershipApprovedAt()
    {
        return $this->membershipApprovedAt;
    }

    /**
     * @param mixed $membershipApprovedAt
     */
    public function setMembershipApprovedAt($membershipApprovedAt)
    {
        $this->membershipApprovedAt = $membershipApprovedAt;
    }

    /**
     * @return mixed
     */
    public function getIsBoardApproved()
    {
        return $this->isBoardApproved;
    }

    /**
     * @param mixed $isBoardApproved
     */
    public function setIsBoardApproved($isBoardApproved)
    {
        $this->isBoardApproved = $isBoardApproved;
    }

    /**
     * @return mixed
     */
    public function getIsBoardRejected()
    {
        return $this->isBoardRejected;
    }

    /**
     * @param mixed $isBoardRejected
     */
    public function setIsBoardRejected($isBoardRejected)
    {
        $this->isBoardRejected = $isBoardRejected;
    }

    /**
     * @return mixed
     */
    public function getBoardRejectionAt()
    {
        return $this->boardRejectionAt;
    }

    /**
     * @param mixed $boardRejectionAt
     */
    public function setBoardRejectionAt($boardRejectionAt)
    {
        $this->boardRejectionAt = $boardRejectionAt;
    }

    /**
     * @return mixed
     */
    public function getBoardRejectionBy()
    {
        return $this->boardRejectionBy;
    }

    /**
     * @param mixed $boardRejectionBy
     */
    public function setBoardRejectionBy($boardRejectionBy)
    {
        $this->boardRejectionBy = $boardRejectionBy;
    }

    /**
     * @return mixed
     */
    public function getBoardRejectionReason()
    {
        return $this->boardRejectionReason;
    }

    /**
     * @param mixed $boardRejectionReason
     */
    public function setBoardRejectionReason($boardRejectionReason)
    {
        $this->boardRejectionReason = $boardRejectionReason;
    }

    /**
     * @return mixed
     */
    public function getNrBoardApprovals()
    {
        return $this->nrBoardApprovals;
    }

    /**
     * @param mixed $nrBoardApprovals
     */
    public function setNrBoardApprovals($nrBoardApprovals)
    {
        $this->nrBoardApprovals = $nrBoardApprovals;
    }

    /**
     * @return mixed
     */
    public function getBoardApprover1()
    {
        return $this->boardApprover1;
    }

    /**
     * @param mixed $boardApprover1
     */
    public function setBoardApprover1($boardApprover1)
    {
        $this->boardApprover1 = $boardApprover1;
    }

    /**
     * @return mixed
     */
    public function getBoardApprover2()
    {
        return $this->boardApprover2;
    }

    /**
     * @param mixed $boardApprover2
     */
    public function setBoardApprover2($boardApprover2)
    {
        $this->boardApprover2 = $boardApprover2;
    }

    /**
     * @return mixed
     */
    public function getBoardApprover3()
    {
        return $this->boardApprover3;
    }

    /**
     * @param mixed $boardApprover3
     */
    public function setBoardApprover3($boardApprover3)
    {
        $this->boardApprover3 = $boardApprover3;
    }

    /**
     * @return mixed
     */
    public function getBoardApprovalStatus1()
    {
        return $this->boardApprovalStatus1;
    }

    /**
     * @param mixed $boardApprovalStatus1
     */
    public function setBoardApprovalStatus1($boardApprovalStatus1)
    {
        $this->boardApprovalStatus1 = $boardApprovalStatus1;
    }

    /**
     * @return mixed
     */
    public function getBoardApprovalStatus2()
    {
        return $this->boardApprovalStatus2;
    }

    /**
     * @param mixed $boardApprovalStatus2
     */
    public function setBoardApprovalStatus2($boardApprovalStatus2)
    {
        $this->boardApprovalStatus2 = $boardApprovalStatus2;
    }

    /**
     * @return mixed
     */
    public function getBoardApprovalStatus3()
    {
        return $this->boardApprovalStatus3;
    }

    /**
     * @param mixed $boardApprovalStatus3
     */
    public function setBoardApprovalStatus3($boardApprovalStatus3)
    {
        $this->boardApprovalStatus3 = $boardApprovalStatus3;
    }

    /**
     * @return mixed
     */
    public function getApproval1At()
    {
        return $this->approval1At;
    }

    /**
     * @param mixed $approval1At
     */
    public function setApproval1At($approval1At)
    {
        $this->approval1At = $approval1At;
    }

    /**
     * @return mixed
     */
    public function getApproval2At()
    {
        return $this->approval2At;
    }

    /**
     * @param mixed $approval2At
     */
    public function setApproval2At($approval2At)
    {
        $this->approval2At = $approval2At;
    }

    /**
     * @return mixed
     */
    public function getApproval3At()
    {
        return $this->approval3At;
    }

    /**
     * @param mixed $approval3At
     */
    public function setApproval3At($approval3At)
    {
        $this->approval3At = $approval3At;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getProcessedBy()
    {
        return $this->processedBy;
    }

    /**
     * @param mixed $processedBy
     */
    public function setProcessedBy($processedBy)
    {
        $this->processedBy = $processedBy;
    }

    /**
     * @return mixed
     */
    public function getProcessedAt()
    {
        return $this->processedAt;
    }

    /**
     * @param mixed $processedAt
     */
    public function setProcessedAt($processedAt)
    {
        $this->processedAt = $processedAt;
    }

    /**
     * @return mixed
     */
    public function getAccountCreated()
    {
        return $this->accountCreated;
    }

    /**
     * @param mixed $accountCreated
     */
    public function setAccountCreated($accountCreated)
    {
        $this->accountCreated = $accountCreated;
    }


    /**
     * @return mixed
     */
    public function getCorporateProfileDocuments()
    {
        return $this->corporateProfileDocuments;
    }

    /**
     * @param mixed $profileDocuments
     */
    public function setCorporateProfileDocuments($corporateProfileDocuments)
    {
        $this->corporateProfileDocuments = $corporateProfileDocuments;
    }

    /**
     * @return mixed
     */
    public function getIsCollectingSocietiesMember()
    {
        return $this->isCollectingSocietiesMember;
    }

    /**
     * @param mixed $isCollectingSocietiesMember
     */
    public function setIsCollectingSocietiesMember($isCollectingSocietiesMember)
    {
        $this->isCollectingSocietiesMember = $isCollectingSocietiesMember;
    }

    /**
     * @return mixed
     */
    public function getCollectingSocieties()
    {
        return $this->collectingSocieties;
    }

    /**
     * @param mixed $collectingSocieties
     */
    public function setCollectingSocieties($collectingSocieties)
    {
        $this->collectingSocieties = $collectingSocieties;
    }

    /**
     * @return mixed
     */
    public function getIdemnifyFirstName()
    {
        return $this->idemnifyFirstName;
    }

    /**
     * @param mixed $idemnifyFirstName
     */
    public function setIdemnifyFirstName($idemnifyFirstName)
    {
        $this->idemnifyFirstName = $idemnifyFirstName;
    }

    /**
     * @return mixed
     */
    public function getIdemnifyLastName()
    {
        return $this->idemnifyLastName;
    }

    /**
     * @param mixed $idemnifyLastName
     */
    public function setIdemnifyLastName($idemnifyLastName)
    {
        $this->idemnifyLastName = $idemnifyLastName;
    }

    /**
     * @return mixed
     */
    public function getIdemnifyAt()
    {
        return $this->idemnifyAt;
    }

    /**
     * @param mixed $idemnifyAt
     */
    public function setIdemnifyAt($idemnifyAt)
    {
        $this->idemnifyAt = $idemnifyAt;
    }

    /**
     * @return mixed
     */
    public function getTerritorialAssignment()
    {
        return $this->territorialAssignment;
    }

    /**
     * @param mixed $territorialAssignment
     */
    public function setTerritorialAssignment($territorialAssignment)
    {
        $this->territorialAssignment = $territorialAssignment;
    }

    /**
     * @return mixed
     */
    public function getCollectingSocietiesNumber()
    {
        return $this->collectingSocietiesNumber;
    }

    /**
     * @param mixed $collectingSocietiesNumber
     */
    public function setCollectingSocietiesNumber($collectingSocietiesNumber)
    {
        $this->collectingSocietiesNumber = $collectingSocietiesNumber;
    }

    /**
     * @return mixed
     */
    public function getIsCommitteeApproved()
    {
        return $this->isCommitteeApproved;
    }

    /**
     * @param mixed $isCommitteeApproved
     */
    public function setIsCommitteeApproved($isCommitteeApproved)
    {
        $this->isCommitteeApproved = $isCommitteeApproved;
    }

    /**
     * @return mixed
     */
    public function getIsCommitteeRejected()
    {
        return $this->isCommitteeRejected;
    }

    /**
     * @param mixed $isCommitteeRejected
     */
    public function setIsCommitteeRejected($isCommitteeRejected)
    {
        $this->isCommitteeRejected = $isCommitteeRejected;
    }

    /**
     * @return mixed
     */
    public function getCommitteeRejectionAt()
    {
        return $this->committeeRejectionAt;
    }

    /**
     * @param mixed $committeeRejectionAt
     */
    public function setCommitteeRejectionAt($committeeRejectionAt)
    {
        $this->committeeRejectionAt = $committeeRejectionAt;
    }

    /**
     * @return mixed
     */
    public function getCommitteeRejectionBy()
    {
        return $this->committeeRejectionBy;
    }

    /**
     * @param mixed $committeeRejectionBy
     */
    public function setCommitteeRejectionBy($committeeRejectionBy)
    {
        $this->committeeRejectionBy = $committeeRejectionBy;
    }

    /**
     * @return mixed
     */
    public function getCommitteeRejectionReason()
    {
        return $this->committeeRejectionReason;
    }

    /**
     * @param mixed $committeeRejectionReason
     */
    public function setCommitteeRejectionReason($committeeRejectionReason)
    {
        $this->committeeRejectionReason = $committeeRejectionReason;
    }

    /**
     * @return mixed
     */
    public function getNrCommitteeApprovals()
    {
        return $this->nrCommitteeApprovals;
    }

    /**
     * @param mixed $nrCommitteeApprovals
     */
    public function setNrCommitteeApprovals($nrCommitteeApprovals)
    {
        $this->nrCommitteeApprovals = $nrCommitteeApprovals;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApprover1()
    {
        return $this->committeeApprover1;
    }

    /**
     * @param mixed $committeeApprover1
     */
    public function setCommitteeApprover1($committeeApprover1)
    {
        $this->committeeApprover1 = $committeeApprover1;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApprover2()
    {
        return $this->committeeApprover2;
    }

    /**
     * @param mixed $committeeApprover2
     */
    public function setCommitteeApprover2($committeeApprover2)
    {
        $this->committeeApprover2 = $committeeApprover2;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApprover3()
    {
        return $this->committeeApprover3;
    }

    /**
     * @param mixed $committeeApprover3
     */
    public function setCommitteeApprover3($committeeApprover3)
    {
        $this->committeeApprover3 = $committeeApprover3;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApprovalStatus1()
    {
        return $this->committeeApprovalStatus1;
    }

    /**
     * @param mixed $committeeApprovalStatus1
     */
    public function setCommitteeApprovalStatus1($committeeApprovalStatus1)
    {
        $this->committeeApprovalStatus1 = $committeeApprovalStatus1;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApprovalStatus2()
    {
        return $this->committeeApprovalStatus2;
    }

    /**
     * @param mixed $committeeApprovalStatus2
     */
    public function setCommitteeApprovalStatus2($committeeApprovalStatus2)
    {
        $this->committeeApprovalStatus2 = $committeeApprovalStatus2;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApprovalStatus3()
    {
        return $this->committeeApprovalStatus3;
    }

    /**
     * @param mixed $committeeApprovalStatus3
     */
    public function setCommitteeApprovalStatus3($committeeApprovalStatus3)
    {
        $this->committeeApprovalStatus3 = $committeeApprovalStatus3;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApproval1At()
    {
        return $this->committeeApproval1At;
    }

    /**
     * @param mixed $committeeApproval1At
     */
    public function setCommitteeApproval1At($committeeApproval1At)
    {
        $this->committeeApproval1At = $committeeApproval1At;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApproval2At()
    {
        return $this->committeeApproval2At;
    }

    /**
     * @param mixed $committeeApproval2At
     */
    public function setCommitteeApproval2At($committeeApproval2At)
    {
        $this->committeeApproval2At = $committeeApproval2At;
    }

    /**
     * @return mixed
     */
    public function getCommitteeApproval3At()
    {
        return $this->committeeApproval3At;
    }

    /**
     * @param mixed $committeeApproval3At
     */
    public function setCommitteeApproval3At($committeeApproval3At)
    {
        $this->committeeApproval3At = $committeeApproval3At;
    }

    /**
     * @return mixed
     */
    public function getGuarantor()
    {
        return $this->guarantor;
    }

    /**
     * @param mixed $guarantor
     */
    public function setGuarantor($guarantor)
    {
        $this->guarantor = $guarantor;
    }

    /**
     * @return mixed
     */
    public function getRoyaltiesMpesaNumber()
    {
        return $this->royaltiesMpesaNumber;
    }

    /**
     * @param mixed $royaltiesMpesaNumber
     */
    public function setRoyaltiesMpesaNumber($royaltiesMpesaNumber)
    {
        $firstCharacter = $royaltiesMpesaNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $royaltiesMpesaNumber = "254".substr($royaltiesMpesaNumber,1);
        }

        $this->royaltiesMpesaNumber = $royaltiesMpesaNumber;
    }

}