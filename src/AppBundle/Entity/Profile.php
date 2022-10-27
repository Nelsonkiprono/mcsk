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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfileRepository")
 * @ORM\Table(name="profile")
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $progress="Initial";
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $applicantName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $pseudonym;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $placeOfBirth;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $nationality;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $countryOfResidence;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $maritalStatus;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $producerName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $producerRelationship;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $memberNumber;
    /**
     * @ORM\Column(type="date",nullable=true)
     * @Assert\NotBlank()
     */
    private $dateOfBirth;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $idNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $itaxPin;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $gender;
    /**
     *  @ORM\Column(type="string",nullable=true)
     */
    private $guarantor;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $territorialAssignment;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $status;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $physicalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $city;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $county;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $postalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $postalCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank(message="Your Phone Number has to be provided")
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $mobileNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $telephoneNumber;
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
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $royaltiesMpesaNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $prefferedRegion;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank(message="Your Phone Number has to be provided")
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $paymentMpesaNumber;
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
     * @ORM\Column(type="text",nullable=true)
     */
    private $bankAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $bankCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $swiftCode;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isCollectingSocietiesMember=false;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isApplyingForMinor=false;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $minorFname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $minorSname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $minorLname;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $minorAge;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $isGroup;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank()
     */
    private $firstGroupMemberPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstGroupMemberFname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstGroupMemberSname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstGroupMemberLname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstGroupMemberId;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstGroupMemberPhone;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstGroupMemberEmail;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondGroupMemberPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondGroupMemberFname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondGroupMemberSname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondGroupMemberLname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondGroupMemberId;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondGroupMemberPhone;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondGroupMemberEmail;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $thirdGroupMemberPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $thirdGroupMemberFname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $thirdGroupMemberSname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $thirdGroupMemberLname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $thirdGroupMemberId;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $thirdGroupMemberPhone;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $thirdGroupMemberEmail;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fourthGroupMemberPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fourthGroupMemberFname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fourthGroupMemberSname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fourthGroupMemberLname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fourthGroupMemberId;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fourthGroupMemberPhone;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fourthGroupMemberEmail;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fifthGroupMemberPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fifthGroupMemberFname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fifthGroupMemberSname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fifthGroupMemberLname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fifthGroupMemberId;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fifthGroupMemberPhone;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $fifthGroupMemberEmail;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sixthGroupMemberPosition;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sixthGroupMemberFname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sixthGroupMemberSname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sixthGroupMemberLname;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sixthGroupMemberId;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sixthGroupMemberPhone;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $sixthGroupMemberEmail;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $collectingSocieties;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $collectingSocietiesNumber;
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
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinFirstName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinMiddleName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinLastName;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinRelationship;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinIdNumber;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $otherKinDateOfBirth;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinGender;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinPhysicalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinCity;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinCounty;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinPostalAddress;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinPostalCode;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $otherKinTelephoneNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     * @Assert\Length(min = 10,max = 12,minMessage = "Your phone number must be at least {{ limit }} digits long",maxMessage = "Your phone number cannot be longer than {{ limit }} digits")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Numbers only")
     */
    private $otherKinMobileNumber;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinEmailAddress;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isOtherKinMinor=false;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $otherKinGuardian;
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
     * @ORM\Column(type="string",nullable=true)
     */
    private $transactionId;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isPaid;
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
    private $isCommitteeApproved;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isBoardRejected;
    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isCommitteeRejected;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $boardRejectionAt;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $committeeRejectionAt;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $boardRejectionBy;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $committeeRejectionBy;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $boardRejectionReason;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $committeeRejectionReason;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nrBoardApprovals;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nrCommitteeApprovals;
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $committeeApprover1;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $committeeApprover2;
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
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $createdAt;
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Documents",mappedBy="whichProfile",fetch="EXTRA_LAZY")
     */
    private $profileDocuments;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Music",mappedBy="whichProfile",fetch="EXTRA_LAZY")
     */
    private $profileSamples;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $referenceId;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User",mappedBy="profile")
     */
    private $user;

    function __construct()
    {
        $this->profileDocuments = new ArrayCollection();
        $this->profileSamples = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getProducerRelationship()
    {
        return $this->producerRelationship;
    }

    /**
     * @param mixed $producerRelationship
     */
    public function setProducerRelationship($producerRelationship)
    {
        $this->producerRelationship = $producerRelationship;
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
    public function getApplicantName()
    {
        return $this->applicantName;
    }

    /**
     * @param mixed $applicantName
     */
    public function setApplicantName($applicantName)
    {
        $this->applicantName = $applicantName;
    }

    /**
     * @return mixed
     */
    public function getProducerName()
    {
        return $this->producerName;
    }

    /**
     * @param mixed $producerName
     */
    public function setProducerName($producerName)
    {
        $this->producerName = $producerName;
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
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * @param mixed $idNumber
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;
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
    public function getPlaceOfBirth()
    {
        return $this->placeOfBirth;
    }

    /**
     * @param mixed $placeOfBirth
     */
    public function setPlaceOfBirth($placeOfBirth)
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
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
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
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
    public function getPseudonym()
    {
        return $this->pseudonym;
    }

    /**
     * @param mixed $pseudonym
     */
    public function setPseudonym($pseudonym)
    {
        $this->pseudonym = $pseudonym;
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
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    /**
     * @param mixed $telephoneNumber
     */
    public function setTelephoneNumber($telephoneNumber)
    {
    	$firstCharacter = $telephoneNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $telephoneNumber = "254".substr($telephoneNumber,1);
        }
        
        $this->telephoneNumber = $telephoneNumber;
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
    public function getBankAddress()
    {
        return $this->bankAddress;
    }

    /**
     * @param mixed $bankAddress
     */
    public function setBankAddress($bankAddress)
    {
        $this->bankAddress = $bankAddress;
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
    public function getIsGroup()
    {
        return $this->isGroup;
    }

    /**
     * @param mixed $isGroup
     */
    public function setIsGroup($isGroup)
    {
        $this->isGroup = $isGroup;
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
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param mixed $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
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
     * @param mixed $countryOfResidence
     */
    public function setCountryOfResidence($countryOfResidence)
    {
        $this->countryOfResidence = $countryOfResidence;
    }

    /**
     * @return mixed
     */
    public function getCountryOfResidence()
    {
        return $this->countryOfResidence;
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
    public function getOtherKinFirstName()
    {
        return $this->otherKinFirstName;
    }

    /**
     * @param mixed $otherKinFirstName
     */
    public function setOtherKinFirstName($otherKinFirstName)
    {
        $this->otherKinFirstName = $otherKinFirstName;
    }

    /**
     * @return mixed
     */
    public function getOtherKinMiddleName()
    {
        return $this->otherKinMiddleName;
    }

    /**
     * @param mixed $otherKinMiddleName
     */
    public function setOtherKinMiddleName($otherKinMiddleName)
    {
        $this->otherKinMiddleName = $otherKinMiddleName;
    }

    /**
     * @return mixed
     */
    public function getOtherKinLastName()
    {
        return $this->otherKinLastName;
    }

    /**
     * @param mixed $otherKinLastName
     */
    public function setOtherKinLastName($otherKinLastName)
    {
        $this->otherKinLastName = $otherKinLastName;
    }

    /**
     * @return mixed
     */
    public function getOtherKinRelationship()
    {
        return $this->otherKinRelationship;
    }

    /**
     * @param mixed $otherKinRelationship
     */
    public function setOtherKinRelationship($otherKinRelationship)
    {
        $this->otherKinRelationship = $otherKinRelationship;
    }

    /**
     * @return mixed
     */
    public function getOtherKinIdNumber()
    {
        return $this->otherKinIdNumber;
    }

    /**
     * @param mixed $otherKinIdNumber
     */
    public function setOtherKinIdNumber($otherKinIdNumber)
    {
        $this->otherKinIdNumber = $otherKinIdNumber;
    }

    /**
     * @return mixed
     */
    public function getOtherKinDateOfBirth()
    {
        return $this->otherKinDateOfBirth;
    }

    /**
     * @param mixed $otherKinDateOfBirth
     */
    public function setOtherKinDateOfBirth($otherKinDateOfBirth)
    {
        $this->otherKinDateOfBirth = $otherKinDateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getOtherKinGender()
    {
        return $this->otherKinGender;
    }

    /**
     * @param mixed $otherKinGender
     */
    public function setOtherKinGender($otherKinGender)
    {
        $this->otherKinGender = $otherKinGender;
    }

    /**
     * @return mixed
     */
    public function getOtherKinPhysicalAddress()
    {
        return $this->otherKinPhysicalAddress;
    }

    /**
     * @param mixed $otherKinPhysicalAddress
     */
    public function setOtherKinPhysicalAddress($otherKinPhysicalAddress)
    {
        $this->otherKinPhysicalAddress = $otherKinPhysicalAddress;
    }

    /**
     * @return mixed
     */
    public function getOtherKinCity()
    {
        return $this->otherKinCity;
    }

    /**
     * @param mixed $otherKinCity
     */
    public function setOtherKinCity($otherKinCity)
    {
        $this->otherKinCity = $otherKinCity;
    }

    /**
     * @return mixed
     */
    public function getOtherKinCounty()
    {
        return $this->otherKinCounty;
    }

    /**
     * @param mixed $otherKinCounty
     */
    public function setOtherKinCounty($otherKinCounty)
    {
        $this->otherKinCounty = $otherKinCounty;
    }

    /**
     * @return mixed
     */
    public function getOtherKinPostalAddress()
    {
        return $this->otherKinPostalAddress;
    }

    /**
     * @param mixed $otherKinPostalAddress
     */
    public function setOtherKinPostalAddress($otherKinPostalAddress)
    {
        $this->otherKinPostalAddress = $otherKinPostalAddress;
    }

    /**
     * @return mixed
     */
    public function getOtherKinPostalCode()
    {
        return $this->otherKinPostalCode;
    }

    /**
     * @param mixed $otherKinPostalCode
     */
    public function setOtherKinPostalCode($otherKinPostalCode)
    {
        $this->otherKinPostalCode = $otherKinPostalCode;
    }

    /**
     * @return mixed
     */
    public function getOtherKinTelephoneNumber()
    {
        return $this->otherKinTelephoneNumber;
    }

    /**
     * @param mixed $otherKinTelephoneNumber
     */
    public function setOtherKinTelephoneNumber($otherKinTelephoneNumber)
    {
        $firstCharacter = $otherKinTelephoneNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $otherKinTelephoneNumber = "254".substr($otherKinTelephoneNumber,1);
        }

        $this->otherKinTelephoneNumber = $otherKinTelephoneNumber;
    }

    /**
     * @return mixed
     */
    public function getOtherKinMobileNumber()
    {
        return $this->otherKinMobileNumber;
    }

    /**
     * @param mixed $otherKinMobileNumber
     */
    public function setOtherKinMobileNumber($otherKinMobileNumber)
    {
        $firstCharacter = $otherKinMobileNumber[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $otherKinMobileNumber = "254".substr($otherKinMobileNumber,1);
        }

        $this->otherKinMobileNumber = $otherKinMobileNumber;
    }

    /**
     * @return mixed
     */
    public function getOtherKinEmailAddress()
    {
        return $this->otherKinEmailAddress;
    }

    /**
     * @param mixed $otherKinEmailAddress
     */
    public function setOtherKinEmailAddress($otherKinEmailAddress)
    {
        $this->otherKinEmailAddress = $otherKinEmailAddress;
    }

    /**
     * @return mixed
     */
    public function getIsOtherKinMinor()
    {
        return $this->isOtherKinMinor;
    }

    /**
     * @param mixed $isotherKinMinor
     */
    public function setIsOtherKinMinor($isOtherKinMinor)
    {
        $this->isOtherKinMinor = $isOtherKinMinor;
    }

    /**
     * @return mixed
     */
    public function getOtherKinGuardian()
    {
        return $this->otherKinGuardian;
    }

    /**
     * @param mixed $otherKinGuardian
     */
    public function setOtherKinGuardian($otherKinGuardian)
    {
        $this->otherKinGuardian = $otherKinGuardian;
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
    public function getProfileDocuments()
    {
        return $this->profileDocuments;
    }

    /**
     * @param mixed $profileDocuments
     */
    public function setProfileDocuments($profileDocuments)
    {
        $this->profileDocuments = $profileDocuments;
    }

    /**
     * @return mixed
     */
    public function getProfileSamples()
    {
        return $this->profileSamples;
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
    public function getFirstGroupMemberPosition()
    {
        return $this->firstGroupMemberPosition;
    }

    /**
     * @param mixed $firstGroupMemberPosition
     */
    public function setFirstGroupMemberPosition($firstGroupMemberPosition)
    {
        $this->firstGroupMemberPosition = $firstGroupMemberPosition;
    }

    /**
     * @return mixed
     */
    public function getFirstGroupMemberFname()
    {
        return $this->firstGroupMemberFname;
    }

    /**
     * @param mixed $firstGroupMemberFname
     */
    public function setFirstGroupMemberFname($firstGroupMemberFname)
    {
        $this->firstGroupMemberFname = $firstGroupMemberFname;
    }

    /**
     * @return mixed
     */
    public function getFirstGroupMemberSname()
    {
        return $this->firstGroupMemberSname;
    }

    /**
     * @param mixed $firstGroupMemberSname
     */
    public function setFirstGroupMemberSname($firstGroupMemberSname)
    {
        $this->firstGroupMemberSname = $firstGroupMemberSname;
    }

    /**
     * @return mixed
     */
    public function getFirstGroupMemberLname()
    {
        return $this->firstGroupMemberLname;
    }

    /**
     * @param mixed $firstGroupMemberLname
     */
    public function setFirstGroupMemberLname($firstGroupMemberLname)
    {
        $this->firstGroupMemberLname = $firstGroupMemberLname;
    }

    /**
     * @return mixed
     */
    public function getFirstGroupMemberId()
    {
        return $this->firstGroupMemberId;
    }

    /**
     * @param mixed $firstGroupMemberId
     */
    public function setFirstGroupMemberId($firstGroupMemberId)
    {
        $this->firstGroupMemberId = $firstGroupMemberId;
    }

    /**
     * @return mixed
     */
    public function getFirstGroupMemberPhone()
    {
        return $this->firstGroupMemberPhone;
    }

    /**
     * @param mixed $firstGroupMemberPhone
     */
    public function setFirstGroupMemberPhone($firstGroupMemberPhone)
    {
        $firstCharacter = $firstGroupMemberPhone[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $firstGroupMemberPhone = "254".substr($firstGroupMemberPhone,1);
        }

        $this->firstGroupMemberPhone = $firstGroupMemberPhone;
    }

    /**
     * @return mixed
     */
    public function getFirstGroupMemberEmail()
    {
        return $this->firstGroupMemberEmail;
    }

    /**
     * @param mixed $firstGroupMemberEmail
     */
    public function setFirstGroupMemberEmail($firstGroupMemberEmail)
    {
        $this->firstGroupMemberEmail = $firstGroupMemberEmail;
    }

    /**
     * @return mixed
     */
    public function getSecondGroupMemberPosition()
    {
        return $this->secondGroupMemberPosition;
    }

    /**
     * @param mixed $secondGroupMemberPosition
     */
    public function setSecondGroupMemberPosition($secondGroupMemberPosition)
    {
        $this->secondGroupMemberPosition = $secondGroupMemberPosition;
    }

    /**
     * @return mixed
     */
    public function getSecondGroupMemberFname()
    {
        return $this->secondGroupMemberFname;
    }

    /**
     * @param mixed $secondGroupMemberFname
     */
    public function setSecondGroupMemberFname($secondGroupMemberFname)
    {
        $this->secondGroupMemberFname = $secondGroupMemberFname;
    }

    /**
     * @return mixed
     */
    public function getSecondGroupMemberSname()
    {
        return $this->secondGroupMemberSname;
    }

    /**
     * @param mixed $secondGroupMemberSname
     */
    public function setSecondGroupMemberSname($secondGroupMemberSname)
    {
        $this->secondGroupMemberSname = $secondGroupMemberSname;
    }

    /**
     * @return mixed
     */
    public function getSecondGroupMemberLname()
    {
        return $this->secondGroupMemberLname;
    }

    /**
     * @param mixed $secondGroupMemberLname
     */
    public function setSecondGroupMemberLname($secondGroupMemberLname)
    {
        $this->secondGroupMemberLname = $secondGroupMemberLname;
    }

    /**
     * @return mixed
     */
    public function getSecondGroupMemberId()
    {
        return $this->secondGroupMemberId;
    }

    /**
     * @param mixed $secondGroupMemberId
     */
    public function setSecondGroupMemberId($secondGroupMemberId)
    {
        $this->secondGroupMemberId = $secondGroupMemberId;
    }

    /**
     * @return mixed
     */
    public function getSecondGroupMemberPhone()
    {
        return $this->secondGroupMemberPhone;
    }

    /**
     * @param mixed $secondGroupMemberPhone
     */
    public function setSecondGroupMemberPhone($secondGroupMemberPhone)
    {
        $firstCharacter = $secondGroupMemberPhone[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $secondGroupMemberPhone = "254".substr($secondGroupMemberPhone,1);
        }

        $this->secondGroupMemberPhone = $secondGroupMemberPhone;
    }

    /**
     * @return mixed
     */
    public function getSecondGroupMemberEmail()
    {
        return $this->secondGroupMemberEmail;
    }

    /**
     * @param mixed $secondGroupMemberEmail
     */
    public function setSecondGroupMemberEmail($secondGroupMemberEmail)
    {
        $this->secondGroupMemberEmail = $secondGroupMemberEmail;
    }

    /**
     * @return mixed
     */
    public function getThirdGroupMemberPosition()
    {
        return $this->thirdGroupMemberPosition;
    }

    /**
     * @param mixed $thirdGroupMemberPosition
     */
    public function setThirdGroupMemberPosition($thirdGroupMemberPosition)
    {
        $this->thirdGroupMemberPosition = $thirdGroupMemberPosition;
    }

    /**
     * @return mixed
     */
    public function getThirdGroupMemberFname()
    {
        return $this->thirdGroupMemberFname;
    }

    /**
     * @param mixed $thirdGroupMemberFname
     */
    public function setThirdGroupMemberFname($thirdGroupMemberFname)
    {
        $this->thirdGroupMemberFname = $thirdGroupMemberFname;
    }

    /**
     * @return mixed
     */
    public function getThirdGroupMemberSname()
    {
        return $this->thirdGroupMemberSname;
    }

    /**
     * @param mixed $thirdGroupMemberSname
     */
    public function setThirdGroupMemberSname($thirdGroupMemberSname)
    {
        $this->thirdGroupMemberSname = $thirdGroupMemberSname;
    }

    /**
     * @return mixed
     */
    public function getThirdGroupMemberLname()
    {
        return $this->thirdGroupMemberLname;
    }

    /**
     * @param mixed $thirdGroupMemberLname
     */
    public function setThirdGroupMemberLname($thirdGroupMemberLname)
    {
        $this->thirdGroupMemberLname = $thirdGroupMemberLname;
    }

    /**
     * @return mixed
     */
    public function getThirdGroupMemberId()
    {
        return $this->thirdGroupMemberId;
    }

    /**
     * @param mixed $thirdGroupMemberId
     */
    public function setThirdGroupMemberId($thirdGroupMemberId)
    {
        $this->thirdGroupMemberId = $thirdGroupMemberId;
    }

    /**
     * @return mixed
     */
    public function getThirdGroupMemberPhone()
    {
        return $this->thirdGroupMemberPhone;
    }

    /**
     * @param mixed $thirdGroupMemberPhone
     */
    public function setThirdGroupMemberPhone($thirdGroupMemberPhone)
    {
        $firstCharacter = $thirdGroupMemberPhone[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $thirdGroupMemberPhone = "254".substr($thirdGroupMemberPhone,1);
        }

        $this->thirdGroupMemberPhone = $thirdGroupMemberPhone;
    }

    /**
     * @return mixed
     */
    public function getThirdGroupMemberEmail()
    {
        return $this->thirdGroupMemberEmail;
    }

    /**
     * @param mixed $thirdGroupMemberEmail
     */
    public function setThirdGroupMemberEmail($thirdGroupMemberEmail)
    {
        $this->thirdGroupMemberEmail = $thirdGroupMemberEmail;
    }

    /**
     * @return mixed
     */
    public function getFourthGroupMemberPosition()
    {
        return $this->fourthGroupMemberPosition;
    }

    /**
     * @param mixed $fourthGroupMemberPosition
     */
    public function setFourthGroupMemberPosition($fourthGroupMemberPosition)
    {
        $this->fourthGroupMemberPosition = $fourthGroupMemberPosition;
    }

    /**
     * @return mixed
     */
    public function getFourthGroupMemberFname()
    {
        return $this->fourthGroupMemberFname;
    }

    /**
     * @param mixed $fourthGroupMemberFname
     */
    public function setFourthGroupMemberFname($fourthGroupMemberFname)
    {
        $this->fourthGroupMemberFname = $fourthGroupMemberFname;
    }

    /**
     * @return mixed
     */
    public function getFourthGroupMemberSname()
    {
        return $this->fourthGroupMemberSname;
    }

    /**
     * @param mixed $fourthGroupMemberSname
     */
    public function setFourthGroupMemberSname($fourthGroupMemberSname)
    {
        $this->fourthGroupMemberSname = $fourthGroupMemberSname;
    }

    /**
     * @return mixed
     */
    public function getFourthGroupMemberLname()
    {
        return $this->fourthGroupMemberLname;
    }

    /**
     * @param mixed $fourthGroupMemberLname
     */
    public function setFourthGroupMemberLname($fourthGroupMemberLname)
    {
        $this->fourthGroupMemberLname = $fourthGroupMemberLname;
    }

    /**
     * @return mixed
     */
    public function getFourthGroupMemberId()
    {
        return $this->fourthGroupMemberId;
    }

    /**
     * @param mixed $fourthGroupMemberId
     */
    public function setFourthGroupMemberId($fourthGroupMemberId)
    {
        $this->fourthGroupMemberId = $fourthGroupMemberId;
    }

    /**
     * @return mixed
     */
    public function getFourthGroupMemberPhone()
    {
        return $this->fourthGroupMemberPhone;
    }

    /**
     * @param mixed $fourthGroupMemberPhone
     */
    public function setFourthGroupMemberPhone($fourthGroupMemberPhone)
    {
        $firstCharacter = $fourthGroupMemberPhone[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $fourthGroupMemberPhone = "254".substr($fourthGroupMemberPhone,1);
        }

        $this->fourthGroupMemberPhone = $fourthGroupMemberPhone;
    }

    /**
     * @return mixed
     */
    public function getFourthGroupMemberEmail()
    {
        return $this->fourthGroupMemberEmail;
    }

    /**
     * @param mixed $fourthGroupMemberEmail
     */
    public function setFourthGroupMemberEmail($fourthGroupMemberEmail)
    {
        $this->fourthGroupMemberEmail = $fourthGroupMemberEmail;
    }

    /**
     * @return mixed
     */
    public function getFifthGroupMemberPosition()
    {
        return $this->fifthGroupMemberPosition;
    }

    /**
     * @param mixed $fifthGroupMemberPosition
     */
    public function setFifthGroupMemberPosition($fifthGroupMemberPosition)
    {
        $this->fifthGroupMemberPosition = $fifthGroupMemberPosition;
    }

    /**
     * @return mixed
     */
    public function getFifthGroupMemberFname()
    {
        return $this->fifthGroupMemberFname;
    }

    /**
     * @param mixed $fifthGroupMemberFname
     */
    public function setFifthGroupMemberFname($fifthGroupMemberFname)
    {
        $this->fifthGroupMemberFname = $fifthGroupMemberFname;
    }

    /**
     * @return mixed
     */
    public function getFifthGroupMemberSname()
    {
        return $this->fifthGroupMemberSname;
    }

    /**
     * @param mixed $fifthGroupMemberSname
     */
    public function setFifthGroupMemberSname($fifthGroupMemberSname)
    {
        $this->fifthGroupMemberSname = $fifthGroupMemberSname;
    }

    /**
     * @return mixed
     */
    public function getFifthGroupMemberLname()
    {
        return $this->fifthGroupMemberLname;
    }

    /**
     * @param mixed $fifthGroupMemberLname
     */
    public function setFifthGroupMemberLname($fifthGroupMemberLname)
    {
        $this->fifthGroupMemberLname = $fifthGroupMemberLname;
    }

    /**
     * @return mixed
     */
    public function getFifthGroupMemberId()
    {
        return $this->fifthGroupMemberId;
    }

    /**
     * @param mixed $fifthGroupMemberId
     */
    public function setFifthGroupMemberId($fifthGroupMemberId)
    {
        $this->fifthGroupMemberId = $fifthGroupMemberId;
    }

    /**
     * @return mixed
     */
    public function getFifthGroupMemberPhone()
    {
        return $this->fifthGroupMemberPhone;
    }

    /**
     * @param mixed $fifthGroupMemberPhone
     */
    public function setFifthGroupMemberPhone($fifthGroupMemberPhone)
    {
        $firstCharacter = $fifthGroupMemberPhone[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $fifthGroupMemberPhone = "254".substr($fifthGroupMemberPhone,1);
        }

        $this->fifthGroupMemberPhone = $fifthGroupMemberPhone;
    }

    /**
     * @return mixed
     */
    public function getFifthGroupMemberEmail()
    {
        return $this->fifthGroupMemberEmail;
    }

    /**
     * @param mixed $fifthGroupMemberEmail
     */
    public function setFifthGroupMemberEmail($fifthGroupMemberEmail)
    {
        $this->fifthGroupMemberEmail = $fifthGroupMemberEmail;
    }

    /**
     * @return mixed
     */
    public function getSixthGroupMemberPosition()
    {
        return $this->sixthGroupMemberPosition;
    }

    /**
     * @param mixed $sixthGroupMemberPosition
     */
    public function setSixthGroupMemberPosition($sixthGroupMemberPosition)
    {
        $this->sixthGroupMemberPosition = $sixthGroupMemberPosition;
    }

    /**
     * @return mixed
     */
    public function getSixthGroupMemberFname()
    {
        return $this->sixthGroupMemberFname;
    }

    /**
     * @param mixed $sixthGroupMemberFname
     */
    public function setSixthGroupMemberFname($sixthGroupMemberFname)
    {
        $this->sixthGroupMemberFname = $sixthGroupMemberFname;
    }

    /**
     * @return mixed
     */
    public function getSixthGroupMemberSname()
    {
        return $this->sixthGroupMemberSname;
    }

    /**
     * @param mixed $sixthGroupMemberSname
     */
    public function setSixthGroupMemberSname($sixthGroupMemberSname)
    {
        $this->sixthGroupMemberSname = $sixthGroupMemberSname;
    }

    /**
     * @return mixed
     */
    public function getSixthGroupMemberLname()
    {
        return $this->sixthGroupMemberLname;
    }

    /**
     * @param mixed $sixthGroupMemberLname
     */
    public function setSixthGroupMemberLname($sixthGroupMemberLname)
    {
        $this->sixthGroupMemberLname = $sixthGroupMemberLname;
    }

    /**
     * @return mixed
     */
    public function getSixthGroupMemberId()
    {
        return $this->sixthGroupMemberId;
    }

    /**
     * @param mixed $sixthGroupMemberId
     */
    public function setSixthGroupMemberId($sixthGroupMemberId)
    {
        $this->sixthGroupMemberId = $sixthGroupMemberId;
    }

    /**
     * @return mixed
     */
    public function getSixthGroupMemberPhone()
    {
        return $this->sixthGroupMemberPhone;
    }

    /**
     * @param mixed $sixthGroupMemberPhone
     */
    public function setSixthGroupMemberPhone($sixthGroupMemberPhone)
    {
        $firstCharacter = $sixthGroupMemberPhone[0];

        if ($firstCharacter == "0" or $firstCharacter == 0){
            $sixthGroupMemberPhone = "254".substr($sixthGroupMemberPhone,1);
        }

        $this->sixthGroupMemberPhone = $sixthGroupMemberPhone;
    }

    /**
     * @return mixed
     */
    public function getSixthGroupMemberEmail()
    {
        return $this->sixthGroupMemberEmail;
    }

    /**
     * @param mixed $sixthGroupMemberEmail
     */
    public function setSixthGroupMemberEmail($sixthGroupMemberEmail)
    {
        $this->sixthGroupMemberEmail = $sixthGroupMemberEmail;
    }




    /**
     * Set termsOfService
     *
     * @param string $termsOfService
     *
     * @return Profile
     */
    public function setTermsOfService($termsOfService)
    {
        $this->termsOfService = $termsOfService;

        return $this;
    }

    /**
     * Get termsOfService
     *
     * @return string
     */
    public function getTermsOfService()
    {
        return $this->termsOfService;
    }

    /**
     * Add profileDocument
     *
     * @param \AppBundle\Entity\Documents $profileDocument
     *
     * @return Profile
     */
    public function addProfileDocument(\AppBundle\Entity\Documents $profileDocument)
    {
        $this->profileDocuments[] = $profileDocument;

        return $this;
    }

    /**
     * Remove profileDocument
     *
     * @param \AppBundle\Entity\Documents $profileDocument
     */
    public function removeProfileDocument(\AppBundle\Entity\Documents $profileDocument)
    {
        $this->profileDocuments->removeElement($profileDocument);
    }

    /**
     * Add profileSample
     *
     * @param \AppBundle\Entity\Music $profileSample
     *
     * @return Profile
     */
    public function addProfileSample(\AppBundle\Entity\Music $profileSample)
    {
        $this->profileSamples[] = $profileSample;

        return $this;
    }

    /**
     * Remove profileSample
     *
     * @param \AppBundle\Entity\Music $profileSample
     */
    public function removeProfileSample(\AppBundle\Entity\Music $profileSample)
    {
        $this->profileSamples->removeElement($profileSample);
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Profile
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
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

    /**
     * @return bool
     */
    public function isApplyingForMinor()
    {
        return $this->isApplyingForMinor;
    }

    /**
     * @param bool $isApplyingForMinor
     */
    public function setIsApplyingForMinor($isApplyingForMinor)
    {
        $this->isApplyingForMinor = $isApplyingForMinor;
    }

    /**
     * @return mixed
     */
    public function getMinorFname()
    {
        return $this->minorFname;
    }

    /**
     * @param mixed $minorFname
     */
    public function setMinorFname($minorFname)
    {
        $this->minorFname = $minorFname;
    }

    /**
     * @return mixed
     */
    public function getMinorSname()
    {
        return $this->minorSname;
    }

    /**
     * @param mixed $minorSname
     */
    public function setMinorSname($minorSname)
    {
        $this->minorSname = $minorSname;
    }

    /**
     * @return mixed
     */
    public function getMinorLname()
    {
        return $this->minorLname;
    }

    /**
     * @param mixed $minorLname
     */
    public function setMinorLname($minorLname)
    {
        $this->minorLname = $minorLname;
    }

    /**
     * @return mixed
     */
    public function getMinorAge()
    {
        return $this->minorAge;
    }

    /**
     * @param mixed $minorAge
     */
    public function setMinorAge($minorAge)
    {
        $this->minorAge = $minorAge;
    }

}



