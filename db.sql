-- MySQL dump 10.13  Distrib 5.6.51, for Linux (x86_64)
--
-- Host: localhost    Database: member_registration_db
-- ------------------------------------------------------
-- Server version	5.6.51-google-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `member_registration_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `member_registration_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `member_registration_db`;

--
-- Table structure for table `corporate`
--

DROP TABLE IF EXISTS `corporate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `corporate` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `membership_approved_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_rejection_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approver1_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approver2_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approver3_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processed_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preffered_region` text COLLATE utf8_unicode_ci,
  `trading_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_director_names` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_director_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_director_id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_director_names` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_director_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_director_id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itax_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `physical_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mpesa_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `royalties_mpesa_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `swift_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_collecting_societies_member` tinyint(1) DEFAULT NULL,
  `collecting_societies` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `mpesa_processed` tinyint(1) DEFAULT NULL,
  `mpesa_confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_payment_date` datetime DEFAULT NULL,
  `mpesa_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_verification_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_urlvalid` tinyint(1) DEFAULT NULL,
  `profile_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_membership_approved` tinyint(1) DEFAULT NULL,
  `membership_approved_at` datetime DEFAULT NULL,
  `is_board_approved` tinyint(1) DEFAULT NULL,
  `is_board_rejected` tinyint(1) DEFAULT NULL,
  `board_rejection_at` datetime DEFAULT NULL,
  `board_rejection_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nr_board_approvals` int(11) DEFAULT NULL,
  `board_approval_status1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approval_status2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approval_status3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approval1at` datetime DEFAULT NULL,
  `approval2at` datetime DEFAULT NULL,
  `approval3at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `account_created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms_of_service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_relationship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_date_of_birth` date DEFAULT NULL,
  `kin_gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_physical_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_telephone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_email_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_kin_minor` tinyint(1) DEFAULT NULL,
  `kin_guardian` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `progress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idemnify_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idemnify_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idemnify_at` datetime DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `number_of_directors` int(11) NOT NULL DEFAULT '1',
  `territorial_assignment` text COLLATE utf8_unicode_ci,
  `collecting_societies_number` text COLLATE utf8_unicode_ci,
  `committee_rejection_by_id` text COLLATE utf8_unicode_ci,
  `committee_approver1_id` text COLLATE utf8_unicode_ci,
  `committee_approver2_id` text COLLATE utf8_unicode_ci,
  `committee_approver3_id` text COLLATE utf8_unicode_ci,
  `is_committee_approved` tinyint(1) DEFAULT NULL,
  `is_committee_rejected` tinyint(1) DEFAULT NULL,
  `committee_rejection_at` datetime DEFAULT NULL,
  `committee_rejection_reason` text COLLATE utf8_unicode_ci,
  `nr_committee_approvals` int(11) DEFAULT NULL,
  `committee_approval_status1` text COLLATE utf8_unicode_ci,
  `committee_approval_status2` text COLLATE utf8_unicode_ci,
  `committee_approval_status3` text COLLATE utf8_unicode_ci,
  `committee_approval1at` datetime DEFAULT NULL,
  `committee_approval2at` datetime DEFAULT NULL,
  `committee_approval3at` datetime DEFAULT NULL,
  `nr_committee_approvals_id` int(11) DEFAULT NULL,
  `guarantor` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_1F33D7A27B58FAA1` (`membership_approved_by_id`),
  KEY `IDX_1F33D7A240C317A` (`board_rejection_by_id`),
  KEY `IDX_1F33D7A25B1D78E1` (`board_approver1_id`),
  KEY `IDX_1F33D7A249A8D70F` (`board_approver2_id`),
  KEY `IDX_1F33D7A2F114B06A` (`board_approver3_id`),
  KEY `IDX_1F33D7A22FFD4FD3` (`processed_by_id`),
  CONSTRAINT `FK_1F33D7A22FFD4FD3` FOREIGN KEY (`processed_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_1F33D7A240C317A` FOREIGN KEY (`board_rejection_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_1F33D7A249A8D70F` FOREIGN KEY (`board_approver2_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_1F33D7A25B1D78E1` FOREIGN KEY (`board_approver1_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_1F33D7A27B58FAA1` FOREIGN KEY (`membership_approved_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_1F33D7A2F114B06A` FOREIGN KEY (`board_approver3_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corporate`
--

LOCK TABLES `corporate` WRITE;
/*!40000 ALTER TABLE `corporate` DISABLE KEYS */;
/*!40000 ALTER TABLE `corporate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_file`
--

DROP TABLE IF EXISTS `document_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_file` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `document_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_file_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_file`
--

LOCK TABLES `document_file` WRITE;
/*!40000 ALTER TABLE `document_file` DISABLE KEYS */;
INSERT INTO `document_file` VALUES ('1c1e3339-0004-11ec-a244-42010a01b005','611cce7b4f287.pdf',NULL,'2021-08-18 11:10:19','2021-08-18 11:10:19'),('23c50c68-d915-11eb-9233-42010a01b004','60db7cae3eff5.pdf',NULL,'2021-06-29 20:03:58','2021-06-29 20:03:58'),('3da61bf3-0bd5-11ec-a244-42010a01b005','6130a1cf2da13.pdf',NULL,'2021-09-02 12:05:03','2021-09-02 12:05:03'),('45fe6213-0be6-11ec-a244-42010a01b005','6130be629a2a7.pdf',NULL,'2021-09-02 14:06:58','2021-09-02 14:06:58'),('636416a2-1148-11ec-a244-42010a01b005','6139c67a6cb5b.pdf',NULL,'2021-09-09 10:31:54','2021-09-09 10:31:54'),('78d1e85c-0bcf-11ec-a244-42010a01b005','6130982174f6d.pdf',NULL,'2021-09-02 11:23:45','2021-09-02 11:23:45'),('7d181daa-da91-11ec-b5f7-42010a01b009','628b79f685a92.pdf',NULL,'2022-05-23 14:11:34','2022-05-23 14:11:34'),('bf5f9767-0bc3-11ec-a244-42010a01b005','61308475d8a74.pdf',NULL,'2021-09-02 09:59:49','2021-09-02 09:59:49'),('c372a58a-0bd1-11ec-a244-42010a01b005','61309bf9a56a6.pdf',NULL,'2021-09-02 11:40:09','2021-09-02 11:40:09'),('d1eb055b-0be7-11ec-a244-42010a01b005','6130c0fad75f9.pdf',NULL,'2021-09-02 14:18:02','2021-09-02 14:18:02'),('e3d54af6-da55-11ec-b5f7-42010a01b009','628b15f91b1c2.pdf',NULL,'2022-05-23 07:04:57','2022-05-23 07:04:57'),('f9672e49-cdbe-11eb-9233-42010a01b004','60c877a7a3467.pdf',NULL,'2021-06-15 11:49:27','2021-06-15 11:49:27'),('fb3a65d5-f9c4-11eb-a244-42010a01b005','61125396d5204.pdf',NULL,'2021-08-10 12:23:18','2021-08-10 12:23:18');
/*!40000 ALTER TABLE `document_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `which_profile_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_file_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `which_corporate_profile_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A2B072883849067E` (`which_profile_id`),
  KEY `IDX_A2B07288458F08FC` (`which_corporate_profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES ('057ca8dd-f9bb-11eb-a244-42010a01b005','5f4eb8ac-f9b9-11eb-a244-42010a01b005','611242e11cbd9.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-08-10 11:12:01','2021-08-10 11:12:01',NULL),('0ff734b5-da91-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009','628b793f70551.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2022-05-23 14:08:31','2022-05-23 14:08:31',NULL),('11029504-0be7-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005','6130bfb739b0e.pdf',NULL,'NATIONAL-ID-COPY','2021-09-02 14:12:39','2021-09-02 14:12:39',NULL),('130199a3-cdab-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004','60c85644a8529.PDF',NULL,'NATIONAL-ID-COPY-BACK','2021-06-15 07:27:00','2021-06-15 07:27:00',NULL),('165bce82-f9bb-11eb-a244-42010a01b005','5f4eb8ac-f9b9-11eb-a244-42010a01b005','611242fd6776f.pdf',NULL,'PASSPORT-PHOTO','2021-08-10 11:12:29','2021-08-10 11:12:29',NULL),('1a4dcf6e-f9c3-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005','611250700408a.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-08-10 10:09:51','2021-08-10 10:09:52',NULL),('1bd32dc1-0bcf-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005','61309785701cb.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-09-02 11:21:09','2021-09-02 11:21:09',NULL),('1ce220b5-cdab-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004','60c856553f8f4.pdf',NULL,'KRA-CERTIFICATE','2021-06-15 07:27:17','2021-06-15 07:27:17',NULL),('1edd4e1a-0be7-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005','6130bfce7545a.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-09-02 14:13:02','2021-09-02 14:13:02',NULL),('276d78ba-f9bb-11eb-a244-42010a01b005','5f4eb8ac-f9b9-11eb-a244-42010a01b005','6112431a0ecef.pdf',NULL,'NATIONAL-ID-COPY','2021-08-10 09:12:58','2021-08-10 09:12:58',NULL),('33800cd8-0bcf-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005','613097ad2be8f.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-09-02 11:21:49','2021-09-02 11:21:49',NULL),('3716df06-f9bb-11eb-a244-42010a01b005','5f4eb8ac-f9b9-11eb-a244-42010a01b005','6112433452356.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-08-10 11:13:24','2021-08-10 11:13:24',NULL),('3bea8e68-0be7-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005','6130bfff35dc8.pdf',NULL,'KRA-CERTIFICATE','2021-09-02 14:13:51','2021-09-02 14:13:51',NULL),('45b7106c-f9bb-11eb-a244-42010a01b005','5f4eb8ac-f9b9-11eb-a244-42010a01b005','6112434cd58f2.pdf',NULL,'KRA-CERTIFICATE','2021-08-10 11:13:48','2021-08-10 11:13:48',NULL),('469b6dd3-f9c3-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005','611250ba544d3.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-08-10 10:11:06','2021-08-10 10:11:06',NULL),('46e9a6b1-0bcf-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005','613097cdb6c00.pdf',NULL,'PASSPORT-PHOTO','2021-09-02 11:22:21','2021-09-02 11:22:21',NULL),('4c5418b6-cdab-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004','60c856a4d1fbe.PDF',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-06-15 07:28:36','2021-06-15 07:28:36',NULL),('4ebc38b7-0bd4-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005','6130a03e56fce.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-09-02 11:58:22','2021-09-02 11:58:22',NULL),('515b1ab1-0bcf-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005','613097df41bbe.pdf',NULL,'NATIONAL-ID-COPY','2021-09-02 11:22:39','2021-09-02 11:22:39',NULL),('51cd1afc-0be7-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005','6130c023e4f45.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-09-02 14:14:27','2021-09-02 14:14:27',NULL),('5669f0f2-f9c3-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005','611250d4d313f.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-08-10 12:11:32','2021-08-10 12:11:32',NULL),('56721348-f9bb-11eb-a244-42010a01b005','5f4eb8ac-f9b9-11eb-a244-42010a01b005','61124368e66e2.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-08-10 09:14:16','2021-08-10 09:14:16',NULL),('58cc8241-0bcf-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005','613097ebb8ae3.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-09-02 11:22:51','2021-09-02 11:22:51',NULL),('5ea8850f-0bcf-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005','613097f58f46b.pdf',NULL,'KRA-CERTIFICATE','2021-09-02 11:23:01','2021-09-02 11:23:01',NULL),('63e3c972-0bcf-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005','613097fe58e77.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-09-02 11:23:10','2021-09-02 11:23:10',NULL),('6a9c1e01-0bd4-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005','6130a06d1dd07.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-09-02 11:59:09','2021-09-02 11:59:09',NULL),('6ab20e53-0003-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005','611ccd51a0570.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-08-18 11:05:21','2021-08-18 11:05:21',NULL),('7b788a50-0003-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005','611ccd6dc40b3.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-08-18 11:05:49','2021-08-18 11:05:49',NULL),('800875d2-0bce-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005','6130968014666.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-09-02 11:16:48','2021-09-02 11:16:48',NULL),('81c95d64-0bd4-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005','6130a0940179a.pdf',NULL,'PASSPORT-PHOTO','2021-09-02 11:59:47','2021-09-02 11:59:48',NULL),('89ea7257-0003-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005','611ccd86092b7.pdf',NULL,'PASSPORT-PHOTO','2021-08-18 11:06:14','2021-08-18 11:06:14',NULL),('8a2b5868-0bc2-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005','6130826f1f24b.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-09-02 09:51:11','2021-09-02 09:51:11',NULL),('8cb8fe01-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009','628b1566eb449.pdf',NULL,'DEED-OF-ASSIGNMENT','2022-05-23 07:02:30','2022-05-23 07:02:30',NULL),('8ead2c90-0bce-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005','613096989f043.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-09-02 11:17:12','2021-09-02 11:17:12',NULL),('9148d900-f9c3-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005','611251379a9a0.pdf',NULL,'PASSPORT-PHOTO','2021-08-10 12:13:11','2021-08-10 12:13:11',NULL),('951d85f9-0003-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005','611ccd98c9fd7.PDF',NULL,'NATIONAL-ID-COPY-BACK','2021-08-18 11:06:32','2021-08-18 11:06:32',NULL),('9552487a-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009','628b15755f467.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2022-05-23 07:02:45','2022-05-23 07:02:45',NULL),('96d494ce-0bce-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005','613096a650e9f.pdf',NULL,'PASSPORT-PHOTO','2021-09-02 11:17:26','2021-09-02 11:17:26',NULL),('9c37ebce-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009','628b1580eabc5.pdf',NULL,'PASSPORT-PHOTO','2022-05-23 07:02:56','2022-05-23 07:02:56',NULL),('9c9cc755-0bd4-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005','6130a0c102efc.pdf',NULL,'NATIONAL-ID-COPY','2021-09-02 12:00:32','2021-09-02 12:00:33',NULL),('9e13717b-e9da-11ec-b5f7-42010a01b009','99eefb8e-dd3e-11ec-b5f7-42010a01b009','62a51f1a8ec4b.pdf',NULL,'DEED-OF-ASSIGNMENT','2022-06-12 01:02:50','2022-06-12 01:02:50',NULL),('9e5577d5-0bce-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005','613096b2e0a04.pdf',NULL,'NATIONAL-ID-COPY','2021-09-02 11:17:38','2021-09-02 11:17:38',NULL),('a0a8f798-d914-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004','60db7bd2475ba.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-06-29 20:00:18','2021-06-29 20:00:18',NULL),('a20f87b3-0bc2-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005','6130829733b57.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-09-02 09:51:51','2021-09-02 09:51:51',NULL),('a26f2220-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009','628b158b5f212.pdf',NULL,'NATIONAL-ID-COPY','2022-05-23 07:03:07','2022-05-23 07:03:07',NULL),('a687424c-0bce-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005','613096c0a31db.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-09-02 11:17:52','2021-09-02 11:17:52',NULL),('a6aec174-e9da-11ec-b5f7-42010a01b009','99eefb8e-dd3e-11ec-b5f7-42010a01b009','62a51f2905eca.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2022-06-12 01:03:05','2022-06-12 01:03:05',NULL),('a98e49b4-1147-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004','6139c542a1ca6.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-09-09 10:26:42','2021-09-09 10:26:42',NULL),('a9d16b6c-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009','628b1597bdf5c.pdf',NULL,'NATIONAL-ID-COPY-BACK','2022-05-23 07:03:19','2022-05-23 07:03:19',NULL),('aa492edf-0003-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005','611ccdbc545f3.pdf',NULL,'NATIONAL-ID-COPY','2021-08-18 11:07:08','2021-08-18 11:07:08',NULL),('aaaae53e-0bc2-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005','613082a59f30e.pdf',NULL,'PASSPORT-PHOTO','2021-09-02 09:52:05','2021-09-02 09:52:05',NULL),('ad19086e-f9c3-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005','6112516648472.pdf',NULL,'NATIONAL-ID-COPY','2021-08-10 12:13:58','2021-08-10 12:13:58',NULL),('ae225f04-dce9-11ec-b5f7-42010a01b009','f3cbaf17-dce6-11ec-b5f7-42010a01b009','628f68ead2138.pdf',NULL,'DEED-OF-ASSIGNMENT','2022-05-26 13:47:54','2022-05-26 13:47:54',NULL),('ae3ff5c5-e9da-11ec-b5f7-42010a01b009','99eefb8e-dd3e-11ec-b5f7-42010a01b009','62a51f35afc63.pdf',NULL,'PASSPORT-PHOTO','2022-06-12 01:03:17','2022-06-12 01:03:17',NULL),('b04ceed8-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009','628b15a29f923.pdf',NULL,'KRA-CERTIFICATE','2022-05-23 07:03:30','2022-05-23 07:03:30',NULL),('b0c3e406-d914-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004','60db7bed4c299.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-06-29 20:00:45','2021-06-29 20:00:45',NULL),('b2e251f3-0bc2-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005','613082b36aa6b.pdf',NULL,'NATIONAL-ID-COPY','2021-09-02 09:52:19','2021-09-02 09:52:19',NULL),('b45d5ca7-0003-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005','611ccdcd3e4c6.pdf',NULL,'KRA-CERTIFICATE','2021-08-18 11:07:25','2021-08-18 11:07:25',NULL),('b6762b79-dce9-11ec-b5f7-42010a01b009','f3cbaf17-dce6-11ec-b5f7-42010a01b009','628f68f8cb154.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2022-05-26 13:48:08','2022-05-26 13:48:08',NULL),('b68e9aeb-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009','628b15ad24c56.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2022-05-23 07:03:41','2022-05-23 07:03:41',NULL),('b6d4b620-e9da-11ec-b5f7-42010a01b009','99eefb8e-dd3e-11ec-b5f7-42010a01b009','62a51f441c812.pdf',NULL,'NATIONAL-ID-COPY','2022-06-12 01:03:32','2022-06-12 01:03:32',NULL),('b9519dbd-0bc2-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005','613082be38c14.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-09-02 09:52:30','2021-09-02 09:52:30',NULL),('ba284a7d-1147-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004','6139c55e7e9ce.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-09-09 10:27:10','2021-09-09 10:27:10',NULL),('ba4f0802-f9c3-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005','6112517c70649.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-08-10 10:14:20','2021-08-10 10:14:20',NULL),('bb350c38-d914-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004','60db7bfecae3c.pdf',NULL,'PASSPORT-PHOTO','2021-06-29 20:01:02','2021-06-29 20:01:02',NULL),('bb451e35-da90-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009','628b78b158efe.pdf',NULL,'DEED-OF-ASSIGNMENT','2022-05-23 14:06:09','2022-05-23 14:06:09',NULL),('bc5663df-0be5-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005','6130bd7ba6a0e.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-09-02 14:03:07','2021-09-02 14:03:07',NULL),('bd72a313-0003-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005','611ccddc7891b.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-08-18 11:07:40','2021-08-18 11:07:40',NULL),('beb8b2d4-0bc2-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005','613082c7487d4.pdf',NULL,'KRA-CERTIFICATE','2021-09-02 09:52:39','2021-09-02 09:52:39',NULL),('bf777cda-dce9-11ec-b5f7-42010a01b009','f3cbaf17-dce6-11ec-b5f7-42010a01b009','628f6907e578e.pdf',NULL,'PASSPORT-PHOTO','2022-05-26 13:48:23','2022-05-26 13:48:23',NULL),('bf9b8583-e9da-11ec-b5f7-42010a01b009','99eefb8e-dd3e-11ec-b5f7-42010a01b009','62a51f52cd5c9.pdf',NULL,'NATIONAL-ID-COPY-BACK','2022-06-12 01:03:46','2022-06-12 01:03:46',NULL),('c4457875-da90-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009','628b78c071d9a.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2022-05-23 14:06:24','2022-05-23 14:06:24',NULL),('c4b0d8a9-1147-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004','6139c5702e8c7.pdf',NULL,'PASSPORT-PHOTO','2021-09-09 10:27:28','2021-09-09 10:27:28',NULL),('c4b20fdb-0bc2-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005','613082d14e09d.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-09-02 09:52:49','2021-09-02 09:52:49',NULL),('c4d61b1e-d914-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004','60db7c0ef0c7b.pdf',NULL,'NATIONAL-ID-COPY','2021-06-29 20:01:18','2021-06-29 20:01:18',NULL),('c51aa013-f9c3-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005','6112518e8b978.pdf',NULL,'KRA-CERTIFICATE','2021-08-10 12:14:38','2021-08-10 12:14:38',NULL),('c5953059-dce9-11ec-b5f7-42010a01b009','f3cbaf17-dce6-11ec-b5f7-42010a01b009','628f69123102b.pdf',NULL,'NATIONAL-ID-COPY','2022-05-26 13:48:34','2022-05-26 13:48:34',NULL),('c65a7b7a-e9da-11ec-b5f7-42010a01b009','99eefb8e-dd3e-11ec-b5f7-42010a01b009','62a51f5e26c53.pdf',NULL,'KRA-CERTIFICATE','2022-06-12 01:03:58','2022-06-12 01:03:58',NULL),('c79b81cb-0be5-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005','6130bd8e9022d.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-09-02 14:03:26','2021-09-02 14:03:26',NULL),('cb4381ce-dce9-11ec-b5f7-42010a01b009','f3cbaf17-dce6-11ec-b5f7-42010a01b009','628f691bb2a0d.pdf',NULL,'NATIONAL-ID-COPY-BACK','2022-05-26 13:48:43','2022-05-26 13:48:43',NULL),('cbb4863f-da90-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009','628b78cce511a.pdf',NULL,'NATIONAL-ID-COPY','2022-05-23 14:06:36','2022-05-23 14:06:36',NULL),('cc996fd3-e9da-11ec-b5f7-42010a01b009','99eefb8e-dd3e-11ec-b5f7-42010a01b009','62a51f689bd11.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2022-06-12 01:04:08','2022-06-12 01:04:08',NULL),('ccdcb401-0be6-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005','6130bf44dc77f.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-09-02 14:10:44','2021-09-02 14:10:44',NULL),('cd0ae5d5-0bd4-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005','6130a11240ad6.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-09-02 12:01:54','2021-09-02 12:01:54',NULL),('ce60352e-d914-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004','60db7c1ef1e74.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-06-29 20:01:34','2021-06-29 20:01:34',NULL),('d0233ee7-0be5-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005','6130bd9cdc2e1.pdf',NULL,'PASSPORT-PHOTO','2021-09-02 14:03:40','2021-09-02 14:03:40',NULL),('d103ee7a-1147-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004','6139c584d3ea3.pdf',NULL,'NATIONAL-ID-COPY','2021-09-09 10:27:48','2021-09-09 10:27:48',NULL),('d17d01a6-da90-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009','628b78d69c734.pdf',NULL,'PASSPORT-PHOTO','2022-05-23 14:06:46','2022-05-23 14:06:46',NULL),('d1cdcc59-dce9-11ec-b5f7-42010a01b009','f3cbaf17-dce6-11ec-b5f7-42010a01b009','628f6926abf2d.pdf',NULL,'KRA-CERTIFICATE','2022-05-26 13:48:54','2022-05-26 13:48:54',NULL),('d1e81579-cda9-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004','60c85429ed707.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-06-15 07:18:01','2021-06-15 07:18:01',NULL),('d885840b-d914-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004','60db7c300309c.pdf',NULL,'KRA-CERTIFICATE','2021-06-29 20:01:51','2021-06-29 20:01:52',NULL),('d8d0fa46-0be5-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005','6130bdab70d2d.pdf',NULL,'NATIONAL-ID-COPY','2021-09-02 14:03:55','2021-09-02 14:03:55',NULL),('d985a80b-da90-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009','628b78e41d00a.pdf',NULL,'NATIONAL-ID-COPY-BACK','2022-05-23 14:07:00','2022-05-23 14:07:00',NULL),('d9f20f62-0bd4-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005','6130a127dec4c.pdf',NULL,'KRA-CERTIFICATE','2021-09-02 12:02:15','2021-09-02 12:02:15',NULL),('db9dd5e8-1147-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004','6139c5969f9e8.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-09-09 10:28:06','2021-09-09 10:28:06',NULL),('dbbe7a09-0bce-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005','61309719e7c83.pdf',NULL,'KRA-CERTIFICATE','2021-09-02 11:19:21','2021-09-02 11:19:21',NULL),('dbc0af66-cdaa-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004','60c855e7f1817.pdf',NULL,'PASSPORT-PHOTO','2021-06-15 07:25:27','2021-06-15 07:25:27',NULL),('dc94188d-dce9-11ec-b5f7-42010a01b009','f3cbaf17-dce6-11ec-b5f7-42010a01b009','628f6938becb1.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2022-05-26 13:49:12','2022-05-26 13:49:12',NULL),('dfa43340-cda9-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004','60c8544104117.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-06-15 07:18:24','2021-06-15 07:18:25',NULL),('e1257e0f-0bce-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005','613097230329b.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-09-02 11:19:30','2021-09-02 11:19:31',NULL),('e189cb69-d914-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004','60db7c3f222ea.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-06-29 20:02:07','2021-06-29 20:02:07',NULL),('e21e1269-0be5-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005','6130bdbb104f1.pdf',NULL,'NATIONAL-ID-COPY-BACK','2021-09-02 14:04:11','2021-09-02 14:04:11',NULL),('e755f88d-0be6-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005','6130bf714dbc6.pdf',NULL,'MECHANICAL-RIGHTS-FORM','2021-09-02 14:11:29','2021-09-02 14:11:29',NULL),('e9a2c20e-1147-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004','6139c5ae2a7cb.pdf',NULL,'KRA-CERTIFICATE','2021-09-09 10:28:30','2021-09-09 10:28:30',NULL),('ea26a969-0be5-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005','6130bdc885152.pdf',NULL,'KRA-CERTIFICATE','2021-09-02 14:04:24','2021-09-02 14:04:24',NULL),('eed46373-0bd4-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005','6130a14ae7e96.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-09-02 12:02:50','2021-09-02 12:02:50',NULL),('f238f639-0be5-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005','6130bdd6151cd.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-09-02 14:04:38','2021-09-02 14:04:38',NULL),('f3028562-1147-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004','6139c5bddbf99.pdf',NULL,'NEXT-OF-KIN-CERTIFICATE','2021-09-09 10:28:45','2021-09-09 10:28:45',NULL),('f51e7aff-da90-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009','628b79126657f.pdf',NULL,'KRA-CERTIFICATE','2022-05-23 14:07:46','2022-05-23 14:07:46',NULL),('f5a3ec8d-f9ba-11eb-a244-42010a01b005','5f4eb8ac-f9b9-11eb-a244-42010a01b005','611242c6818e1.pdf',NULL,'DEED-OF-ASSIGNMENT','2021-08-10 09:11:34','2021-08-10 09:11:34',NULL),('f6146401-cdaa-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004','60c8561426c40.PDF',NULL,'NATIONAL-ID-COPY','2021-06-15 07:26:12','2021-06-15 07:26:12',NULL),('ff9a54c0-0be6-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005','6130bf9a07c85.pdf',NULL,'PASSPORT-PHOTO','2021-09-02 14:12:10','2021-09-02 14:12:10',NULL);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `individual`
--

DROP TABLE IF EXISTS `individual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `individual` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms_of_service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `individual`
--

LOCK TABLES `individual` WRITE;
/*!40000 ALTER TABLE `individual` DISABLE KEYS */;
/*!40000 ALTER TABLE `individual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mpesa_transactions`
--

DROP TABLE IF EXISTS `mpesa_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mpesa_transactions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `merchantRequestID` text,
  `checkoutRequestID` text,
  `resultCode` text,
  `resultDesc` text,
  `amount` text,
  `mpesaReceiptNumber` text,
  `transactionDate` text,
  `phoneNumber` text,
  `profid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mpesa_transactions`
--

LOCK TABLES `mpesa_transactions` WRITE;
/*!40000 ALTER TABLE `mpesa_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `mpesa_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `music` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `music_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recording_file_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `which_profile_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `which_corporate_profile_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `album_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_of_production` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_artist` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `letter_of_administration_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `death_certificate_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `artist_contract_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recording_studio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sample_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_of_recording` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `declaration_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recording_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year_production` int(11) NOT NULL,
  `music_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `background_vocals` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `track_programming` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_instrumentalists` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_file_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CD52224A1C9D420E` (`recording_file_id`),
  KEY `IDX_CD52224A3849067E` (`which_profile_id`),
  KEY `IDX_CD52224A458F08FC` (`which_corporate_profile_id`),
  KEY `IDX_CD52224ADA109BE1` (`letter_of_administration_id`),
  KEY `IDX_CD52224AFCC5731F` (`death_certificate_id`),
  KEY `IDX_CD52224AC4C56BA` (`artist_contract_id`),
  KEY `IDX_CD52224A37A4DFB0` (`document_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `music`
--

LOCK TABLES `music` WRITE;
/*!40000 ALTER TABLE `music` DISABLE KEYS */;
INSERT INTO `music` VALUES ('1c1d8514-0004-11ec-a244-42010a01b005',NULL,'1c1ec543-0004-11ec-a244-42010a01b005','5b6f970d-0002-11ec-a244-42010a01b005',NULL,'Mungu','KE','MP3','Dennis Maina','2021-08-18 11:10:19','2021-08-18 11:10:19',NULL,NULL,NULL,'MCSK','Own','KE','Sound','Mungu pekee',2018,NULL,NULL,NULL,NULL,NULL,'1c1e3339-0004-11ec-a244-42010a01b005'),('23c3e278-d915-11eb-9233-42010a01b004',NULL,'23c60191-d915-11eb-9233-42010a01b004','a3f40a92-d90c-11eb-9233-42010a01b004',NULL,'tosheka na kwako','KE','MP3','dj shiti','2021-06-29 20:03:58','2021-06-29 20:03:58',NULL,NULL,NULL,'river road','Own','KE','Sound','narudi mashambani',2018,NULL,NULL,NULL,NULL,NULL,'23c50c68-d915-11eb-9233-42010a01b004'),('3da57c6a-0bd5-11ec-a244-42010a01b005',NULL,'3da6ab7a-0bd5-11ec-a244-42010a01b005','370523e5-0bd2-11ec-a244-42010a01b005',NULL,'YESU','KE','MP3','DORCAS AMULI','2021-09-02 12:05:03','2021-09-02 12:05:03',NULL,NULL,NULL,'DORO STUDIOS','Own','KE','Sound','BWANA YESU',2018,NULL,NULL,NULL,NULL,NULL,'3da61bf3-0bd5-11ec-a244-42010a01b005'),('45fd77e1-0be6-11ec-a244-42010a01b005',NULL,'45ff133b-0be6-11ec-a244-42010a01b005','c50ea18b-0be4-11ec-a244-42010a01b005',NULL,'Ngori','KE','MP3','Arap King','2021-09-02 14:06:58','2021-09-02 14:06:58',NULL,NULL,NULL,'moss Production','Own','KE','Sound','Nomaree',2018,NULL,NULL,NULL,NULL,NULL,'45fe6213-0be6-11ec-a244-42010a01b005'),('63636d85-1148-11ec-a244-42010a01b005',NULL,'63649e1a-1148-11ec-a244-42010a01b005','615b4c18-c790-11eb-9233-42010a01b004',NULL,'try your luck','KE','MP3','Sarkodie','2021-09-09 10:31:54','2021-09-09 10:31:54',NULL,NULL,NULL,'Osun state','Own','KE','Sound','Lets get it',2018,NULL,NULL,NULL,NULL,NULL,'636416a2-1148-11ec-a244-42010a01b005'),('78d136ea-0bcf-11ec-a244-42010a01b005',NULL,'78d27449-0bcf-11ec-a244-42010a01b005','bb5d4f9d-0bcc-11ec-a244-42010a01b005',NULL,'IKO VIPI TENA KWANI','KE','MP3','TUFF','2021-09-02 11:23:45','2021-09-02 11:23:45',NULL,NULL,NULL,'AUDIO KUSINI','Own','KE','Sound','HII TU KAMA ILE INGINE',2018,NULL,NULL,NULL,NULL,NULL,'78d1e85c-0bcf-11ec-a244-42010a01b005'),('7d1707cc-da91-11ec-b5f7-42010a01b009',NULL,'7d19224e-da91-11ec-b5f7-42010a01b009','dcbfce58-da8e-11ec-b5f7-42010a01b009',NULL,'God is above all','KE','MP3','aaaa','2022-05-23 14:11:34','2022-05-23 14:11:34',NULL,NULL,NULL,'nairobi','Own','KE','Sound','song a',2018,NULL,NULL,NULL,NULL,NULL,'7d181daa-da91-11ec-b5f7-42010a01b009'),('bf5ee03e-0bc3-11ec-a244-42010a01b005',NULL,'bf602ddc-0bc3-11ec-a244-42010a01b005','8777330f-0bc1-11ec-a244-42010a01b005',NULL,'hdsbd','KE','MP3','sbdgbndgb','2021-09-02 09:59:49','2021-09-02 09:59:49',NULL,NULL,NULL,'sbbdb','Own','KE','Sound','fsvsfv',2018,NULL,NULL,NULL,NULL,NULL,'bf5f9767-0bc3-11ec-a244-42010a01b005'),('c37218b0-0bd1-11ec-a244-42010a01b005',NULL,'c37318e0-0bd1-11ec-a244-42010a01b005','aac05dfb-0bca-11ec-a244-42010a01b005',NULL,'Noma','KE','MP3','Moses Maiyo','2021-09-02 11:40:09','2021-09-02 11:40:09',NULL,NULL,NULL,'Mosee Studios','Own','KE','Sound','Nomaree',2018,NULL,NULL,NULL,NULL,NULL,'c372a58a-0bd1-11ec-a244-42010a01b005'),('d1ea35fc-0be7-11ec-a244-42010a01b005',NULL,'d1ebe4bd-0be7-11ec-a244-42010a01b005','e59c405b-0be4-11ec-a244-42010a01b005',NULL,'KUNA NURU','KE','MP3','MARTHA','2021-09-02 14:18:02','2021-09-02 14:18:02',NULL,NULL,NULL,'KABACU','Own','KE','Sound','NEEMA',2018,NULL,NULL,NULL,NULL,NULL,'d1eb055b-0be7-11ec-a244-42010a01b005'),('e3d0a936-da55-11ec-b5f7-42010a01b009',NULL,'e3d963c0-da55-11ec-b5f7-42010a01b009','bc0f3697-da4d-11ec-b5f7-42010a01b009',NULL,'aaaaa','KE','MP3','ccccc','2022-05-23 07:04:57','2022-05-23 07:04:57',NULL,NULL,NULL,'nairobi','Own','KE','Sound','aaa',2018,NULL,NULL,NULL,NULL,NULL,'e3d54af6-da55-11ec-b5f7-42010a01b009'),('f9662e5c-cdbe-11eb-9233-42010a01b004',NULL,'f967f065-cdbe-11eb-9233-42010a01b004','aec0bd62-c8f1-11eb-9233-42010a01b004',NULL,'YOU ARE GREAT','KE','MP3','JACKIE','2021-06-15 11:49:27','2021-06-15 11:49:27',NULL,NULL,NULL,'MUSIC STUDIO','Own','KE','Sound','GALACTIC',2018,NULL,NULL,NULL,NULL,NULL,'f9672e49-cdbe-11eb-9233-42010a01b004'),('fb348973-f9c4-11eb-a244-42010a01b005',NULL,'fb3edd1a-f9c4-11eb-a244-42010a01b005','bdd9396c-f9c1-11eb-a244-42010a01b005',NULL,'HELLO','KE','MP3','ANNNE','2021-08-10 12:23:18','2021-08-10 12:23:18',NULL,NULL,NULL,'anee','Own','KE','Sound','anette',2018,NULL,NULL,NULL,NULL,NULL,'fb3a65d5-f9c4-11eb-a244-42010a01b005');
/*!40000 ALTER TABLE `music` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `next_of_kin`
--

DROP TABLE IF EXISTS `next_of_kin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `next_of_kin` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `whose_kin_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_kin_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `percent` int(11) NOT NULL,
  `physical_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CE1E3CF9D1AC38B2` (`whose_kin_id`),
  KEY `IDX_CE1E3CF96D00B073` (`profile_kin_id`),
  CONSTRAINT `FK_CE1E3CF96D00B073` FOREIGN KEY (`profile_kin_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `FK_CE1E3CF9D1AC38B2` FOREIGN KEY (`whose_kin_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `next_of_kin`
--

LOCK TABLES `next_of_kin` WRITE;
/*!40000 ALTER TABLE `next_of_kin` DISABLE KEYS */;
/*!40000 ALTER TABLE `next_of_kin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `onboard`
--

DROP TABLE IF EXISTS `onboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `onboard` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_director_names` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_director_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_director_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_director_names` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_director_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_director_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms_of_service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `onboard`
--

LOCK TABLES `onboard` WRITE;
/*!40000 ALTER TABLE `onboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `onboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pseudonym` text COLLATE utf8_unicode_ci,
  `membership_approved_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_rejection_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approver1_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approver2_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approver3_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processed_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_number` int(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itax_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preffered_region` text COLLATE utf8_unicode_ci,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital_status` text COLLATE utf8_unicode_ci,
  `place_of_birth` text COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `physical_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` text COLLATE utf8_unicode_ci,
  `country_of_residence` text COLLATE utf8_unicode_ci,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `territorial_assignment` text COLLATE utf8_unicode_ci,
  `payment_mpesa_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `royalties_mpesa_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_address` text COLLATE utf8_unicode_ci,
  `bank_branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `swift_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_collecting_societies_member` tinyint(1) NOT NULL,
  `collecting_societies` longtext COLLATE utf8_unicode_ci,
  `collecting_societies_number` text COLLATE utf8_unicode_ci,
  `kin_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_relationship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_date_of_birth` date DEFAULT NULL,
  `kin_gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_physical_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_telephone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_email_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_kin_minor` tinyint(1) NOT NULL,
  `kin_guardian` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms_of_service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `mpesa_processed` tinyint(1) NOT NULL,
  `mpesa_confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_payment_date` datetime DEFAULT NULL,
  `mpesa_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_verification_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_urlvalid` tinyint(1) DEFAULT NULL,
  `profile_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_membership_approved` tinyint(1) DEFAULT NULL,
  `membership_approved_at` datetime DEFAULT NULL,
  `is_board_approved` tinyint(1) DEFAULT NULL,
  `is_board_rejected` tinyint(1) DEFAULT NULL,
  `board_rejection_at` datetime DEFAULT NULL,
  `board_rejection_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nr_board_approvals` int(11) DEFAULT NULL,
  `board_approval_status1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approval_status2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `board_approval_status3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approval1at` datetime DEFAULT NULL,
  `approval2at` datetime DEFAULT NULL,
  `approval3at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `account_created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_relationship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_date_of_birth` date DEFAULT NULL,
  `other_kin_gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_physical_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_telephone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_kin_email_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_other_kin_minor` tinyint(1) NOT NULL,
  `other_kin_guardian` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `progress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idemnify_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idemnify_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idemnify_at` datetime DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `producer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `producer_relationship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_group` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_group_member_position` text COLLATE utf8_unicode_ci,
  `first_group_member_fname` text COLLATE utf8_unicode_ci,
  `first_group_member_sname` text COLLATE utf8_unicode_ci,
  `first_group_member_lname` text COLLATE utf8_unicode_ci,
  `first_group_member_id` text COLLATE utf8_unicode_ci,
  `first_group_member_phone` text COLLATE utf8_unicode_ci,
  `first_group_member_email` text COLLATE utf8_unicode_ci,
  `second_group_member_position` text COLLATE utf8_unicode_ci,
  `second_group_member_fname` text COLLATE utf8_unicode_ci,
  `second_group_member_sname` text COLLATE utf8_unicode_ci,
  `second_group_member_lname` text COLLATE utf8_unicode_ci,
  `second_group_member_id` text COLLATE utf8_unicode_ci,
  `second_group_member_phone` text COLLATE utf8_unicode_ci,
  `second_group_member_email` text COLLATE utf8_unicode_ci,
  `third_group_member_position` text COLLATE utf8_unicode_ci,
  `third_group_member_fname` text COLLATE utf8_unicode_ci,
  `third_group_member_sname` text COLLATE utf8_unicode_ci,
  `third_group_member_lname` text COLLATE utf8_unicode_ci,
  `third_group_member_id` text COLLATE utf8_unicode_ci,
  `third_group_member_phone` text COLLATE utf8_unicode_ci,
  `third_group_member_email` text COLLATE utf8_unicode_ci,
  `fourth_group_member_position` text COLLATE utf8_unicode_ci,
  `fourth_group_member_fname` text COLLATE utf8_unicode_ci,
  `fourth_group_member_sname` text COLLATE utf8_unicode_ci,
  `fourth_group_member_lname` text COLLATE utf8_unicode_ci,
  `fourth_group_member_id` text COLLATE utf8_unicode_ci,
  `fourth_group_member_phone` text COLLATE utf8_unicode_ci,
  `fourth_group_member_email` text COLLATE utf8_unicode_ci,
  `fifth_group_member_position` text COLLATE utf8_unicode_ci,
  `fifth_group_member_fname` text COLLATE utf8_unicode_ci,
  `fifth_group_member_sname` text COLLATE utf8_unicode_ci,
  `fifth_group_member_lname` text COLLATE utf8_unicode_ci,
  `fifth_group_member_id` text COLLATE utf8_unicode_ci,
  `fifth_group_member_phone` text COLLATE utf8_unicode_ci,
  `fifth_group_member_email` text COLLATE utf8_unicode_ci,
  `sixth_group_member_position` text COLLATE utf8_unicode_ci,
  `sixth_group_member_fname` text COLLATE utf8_unicode_ci,
  `sixth_group_member_sname` text COLLATE utf8_unicode_ci,
  `sixth_group_member_lname` text COLLATE utf8_unicode_ci,
  `sixth_group_member_id` text COLLATE utf8_unicode_ci,
  `sixth_group_member_phone` text COLLATE utf8_unicode_ci,
  `sixth_group_member_email` text COLLATE utf8_unicode_ci,
  `committee_rejection_by_id` text COLLATE utf8_unicode_ci,
  `committee_approver1_id` text COLLATE utf8_unicode_ci,
  `committee_approver2_id` text COLLATE utf8_unicode_ci,
  `committee_approver3_id` text COLLATE utf8_unicode_ci,
  `is_committee_approved` tinyint(1) DEFAULT NULL,
  `is_committee_rejected` tinyint(1) DEFAULT NULL,
  `committee_rejection_at` datetime DEFAULT NULL,
  `committee_rejection_reason` text COLLATE utf8_unicode_ci,
  `nr_committee_approvals` int(11) DEFAULT NULL,
  `committee_approval_status1` text COLLATE utf8_unicode_ci,
  `committee_approval_status2` text COLLATE utf8_unicode_ci,
  `committee_approval_status3` text COLLATE utf8_unicode_ci,
  `committee_approval1at` datetime DEFAULT NULL,
  `committee_approval2at` datetime DEFAULT NULL,
  `committee_approval3at` datetime DEFAULT NULL,
  `nr_committee_approvals_id` int(11) DEFAULT NULL,
  `guarantor` text COLLATE utf8_unicode_ci,
  `is_applying_for_minor` tinyint(1) DEFAULT '0',
  `minor_fname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `minor_sname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `minor_lname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `minor_age` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8157AA0F7B58FAA1` (`membership_approved_by_id`),
  KEY `IDX_8157AA0F40C317A` (`board_rejection_by_id`),
  KEY `IDX_8157AA0F5B1D78E1` (`board_approver1_id`),
  KEY `IDX_8157AA0F49A8D70F` (`board_approver2_id`),
  KEY `IDX_8157AA0FF114B06A` (`board_approver3_id`),
  KEY `IDX_8157AA0F2FFD4FD3` (`processed_by_id`),
  CONSTRAINT `FK_8157AA0F2FFD4FD3` FOREIGN KEY (`processed_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_8157AA0F40C317A` FOREIGN KEY (`board_rejection_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_8157AA0F49A8D70F` FOREIGN KEY (`board_approver2_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_8157AA0F5B1D78E1` FOREIGN KEY (`board_approver1_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_8157AA0F7B58FAA1` FOREIGN KEY (`membership_approved_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_8157AA0FF114B06A` FOREIGN KEY (`board_approver3_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES ('21efa90c-a1dc-11eb-b12f-42010a01b002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Simon Ngunjiri Muraya',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254719636010',NULL,'simon.muraya@incentro.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-04-20 13:27:19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'Simon Ngunjiri Muraya',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('27903255-c5a6-11eb-9233-42010a01b004','fredy',NULL,NULL,NULL,NULL,NULL,NULL,'fred M kairu',NULL,'1989-08-21','27359261','AK33535345','Nairobi','Male','Single',NULL,NULL,'10306','nairobi','Nairobi','Kenyan',NULL,'10306','30200','254722537792','254722537792','info@techsavanna.technology','info@techsavanna.technology',NULL,'World Wide','254722537792','2547225377','Fred K','423423535345','Kenya Commercial Bank',NULL,'KICC',NULL,NULL,1,'PRISK,KAMP','2332325,533455','fred','m','kairu','Father','42353535','2021-06-05','Male','10306','nairobi','Nairobi','30200','254722537792','254722537792','krufed@gmail.com',0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-05 02:31:38',NULL,NULL,'30200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Documents',NULL,NULL,NULL,NULL,'fred M kairu',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('370523e5-0bd2-11ec-a244-42010a01b005','DORO','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6','DORCAS OMUTICHIA AMULI',NULL,'2021-09-27','27693478','A001233456B','Nairobi','Female','Single',NULL,NULL,'740','NAIROBI','Nairobi','KENYAN',NULL,'740','00200','254711300236','254711300236','dorcasamuli@yahoo.com','dorcasamuli@yahoo.com',NULL,'Kenya','254711300236','2547113002','DORCAS AMULI','01130090551','Development Bank',NULL,'WESTLANDS',NULL,NULL,1,NULL,'2330','JACKIE','CAROLINE','ODUOR','SISTER','23456788','2021-09-02','Female','456','NAIROBI','Nairobi','00300','254731453578','254731453578','jacky@yahoo.com',0,NULL,NULL,NULL,1,1,NULL,'2021-09-02 13:12:14','Success','The service request is processed successfully.','254711300236','1','PI21DTGXYV',NULL,'Approved','',1,'2021-09-16 12:22:44',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-09-02 11:43:23','2021-09-16 12:22:44',NULL,'456',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','DORCAS','AMULI','2021-09-02 12:11:56',1630577516,'DORCAS OMUTICHIA AMULI',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('53c37131-da4c-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcskk@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 05:56:29',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('5b6f970d-0002-11ec-a244-42010a01b005','Dennis Maina','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'d891679c-ac29-11ea-8355-305a3a75dd5b','Dennis Maina Maina',NULL,'1965-01-18','24193475','A002222222F','Nairobi','Male','Single',NULL,NULL,'14806','Nairobi','Nairobi','Kenyan',NULL,'14806','00800','254705720936','254705720936','dmaina@mcsk.or.ke',NULL,'www.msck.or.ke','World Wide','254705720936','2547057209','Dennis Maina','44555652155665','Equity Bank',NULL,'Westlands',NULL,NULL,0,NULL,NULL,'Maina','Dens','Maina','Workmate','41566666332','2021-08-03','Male','14806','Bungoma','Nairobi','00800','254705720936','254705720936','gdennis254@gmail.com',0,NULL,NULL,NULL,1,0,NULL,'2021-09-02 10:32:00','Success',NULL,NULL,'1',NULL,NULL,'Approved','approved',1,'2021-09-02 10:34:32',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-18 10:57:46','2022-05-23 15:01:33',NULL,'00800',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Complete','Dennis','Maina','2021-08-18 11:19:00',1629278340,'Dennis Maina Maina',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d891679c-ac29-11ea-8355-305a3a75dd5b',NULL,NULL,1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 15:01:33',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('5f4eb8ac-f9b9-11eb-a244-42010a01b005','kanairo wa majengo',NULL,NULL,NULL,NULL,NULL,NULL,'nel cc kip',NULL,'1962-08-14','5566778899','A66554433','Nairobi','Male','Married',NULL,NULL,'Dagoretti kona','Nairobi','Nairobi','kenyan',NULL,'0234','00100','254707918784','334455667788','nelsonkip@techsavanna.technology',NULL,NULL,'World Wide','254722166011','2547221660','Nelson kip','1155815686','Kenya Commercial Bank',NULL,'Moi Avenue',NULL,NULL,0,NULL,NULL,'KIP','kip','jj','bro','78787878','2021-08-28','Male','Kuria','Keumbu','Kisii','08700',NULL,'254733122567',NULL,0,NULL,NULL,NULL,1,1,NULL,'2021-09-08 22:18:56','Success','The service request is processed successfully.','254722166011','1','PI81NU0AG7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 11:00:12',NULL,NULL,'7688',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Recording',NULL,NULL,NULL,NULL,'nel cc kip',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('615b4c18-c790-11eb-9233-42010a01b004','king Khalid','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'33295c0a-9c7e-11ea-8534-d85de29a5f60',NULL,NULL,'33295c0a-9c7e-11ea-8534-d85de29a5f60','Nelson Kiprono Chirchir',2,'1967-09-19','33445566','23345','Nairobi','Male','Single',NULL,NULL,'Nairobi','Nairobi','Kericho','Kenyan',NULL,'234','556677','254722166011','111112222233','nelsohnkiprono@gmail.com',NULL,NULL,'World Wide','254722166011','2547221660','nelson kiprono','1151926587','Kenya Commercial Bank',NULL,'Moi Avenue',NULL,NULL,0,NULL,NULL,'jjjjjj','llllllloooo','pppppp','brother','332211255','1987-09-15','Male','Nairobi','Nairobi','Kericho','00100','111222334456','254707091878',NULL,0,NULL,NULL,NULL,1,1,NULL,'2021-09-09 11:32:51','Success','The service request is processed successfully.','254722166011','1','PI93O8Q9FB',NULL,'Pending','approved',1,'2021-09-09 10:37:51',1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 10:18:49',NULL,NULL,'2021-06-07 13:00:48','2022-05-23 10:21:23',NULL,'334455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','Nelson','Kiprono','2022-05-26 10:12:36',1653552756,'Nelson Kiprono Chirchir',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d891679c-ac29-11ea-8355-305a3a75dd5b',NULL,NULL,1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 10:17:13',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('6ca02109-dce1-11ec-b5f7-42010a01b009','yyy tt kkkk',NULL,NULL,NULL,NULL,NULL,NULL,'rrr kk vv',NULL,'1966-05-10','45678903','09977654428','Nairobi','Male','Single',NULL,NULL,'nairobi','nairobi','Nairobi','kenyan',NULL,NULL,'00200','254722166011','788770008888','mcsktes3t@techsavanna.technology4',NULL,NULL,'World Wide','254722166011','2547221660','iiiiii kkkk ddgg','66578930','Bank of Africa',NULL,'main',NULL,NULL,0,NULL,NULL,'aaa','bbbb','cccc','bro','998889','2022-05-18','Male','rrrrrr','hhhh','Nairobi',NULL,NULL,'254999000776',NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-26 12:48:48',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Documents',NULL,NULL,NULL,NULL,'rrr kk vv',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('7314e360-da4a-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcskx@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 05:43:03',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('7be4cee0-a27e-11eb-b12f-42010a01b002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'JACKLINE ACHIENG ODUOL',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722851747',NULL,'jachieng@mcsk.or.ke',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-04-21 08:49:29',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'JACKLINE ACHIENG ODUOL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('84f59ceb-da4d-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcskg@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 06:05:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('86d05dc2-da59-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bbb ccc ddd',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcsk1@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 07:30:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'bbb ccc ddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('8777330f-0bc1-11ec-a244-42010a01b005','TEST',NULL,NULL,NULL,NULL,NULL,NULL,'Brian Lidonde Napali',NULL,'1995-09-14','TEST','AOOOO','Nairobi','Male','Single',NULL,NULL,'nAIROBI','Nairobi','Nairobi',NULL,NULL,NULL,'00200','254727152794',NULL,'napalibr@gmail.com',NULL,NULL,'World Wide','254727152794','2547271527','fsvwvw','wfwvw','Bank of India',NULL,'cdvsdv',NULL,NULL,0,NULL,'scvs','dvsv b','asvsfv','ssbsfb','svsv','vsavsfv','1999-09-09','Female','VSVV','Nairobi','Nairobi','vsvdf',NULL,'254727152794',NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-09-02 09:43:57',NULL,NULL,'afsvs',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Recording',NULL,NULL,NULL,NULL,'Brian Lidonde Napali',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('87cb3d94-0bcf-11ec-a244-42010a01b005','ngwalu',NULL,NULL,NULL,NULL,NULL,NULL,'James Kisero Owuor',NULL,'1953-05-25','14677668','a0004442222z','Nyanza','Male','Single',NULL,NULL,'otonglo','kisumu','Kisumu','kenyan',NULL,'56927','0125','254718794910','254718794910','jkisero.jk@gmail.com','jkisero.jk@gmail.com',NULL,'World Wide','254718794910','2547187949','ebusa','a120356','CFC Stanbic Bank',NULL,'kisumu',NULL,NULL,0,NULL,NULL,'Mbuta','buu','gwa','child','b24568','1962-09-12','Male','nairobi','nairobi','Nairobi','00200','254718794910','25418794910','kiz@gmail.com',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-09-02 11:24:10',NULL,NULL,'56927',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Documents',NULL,NULL,NULL,NULL,'James Kisero Owuor',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'na','n/a','na','0'),('99eefb8e-dd3e-11ec-b5f7-42010a01b009','WQQWWW',NULL,NULL,NULL,NULL,NULL,NULL,'aaa bbb cccc',NULL,'2022-05-31','556778','3445YUU','Nairobi','Male','Single',NULL,NULL,'GGGG','JJJJ','Nairobi','FHHHH',NULL,NULL,'99900','972233445566',NULL,'mcsk6@techsavanna.technology','mcsk6@techsavanna.technology',NULL,'World Wide','254722166011','2547221660','TTTT','99999999','Dubai Bank',NULL,'LLLL',NULL,NULL,0,NULL,NULL,'DDD','HH','HH','EREEERE','66555444','2022-05-10','Male','RRRRRR','RRRRR','Elgeyo Marakwet',NULL,NULL,'254788899003',NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-26 23:55:48',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Documents',NULL,NULL,NULL,NULL,'aaa bbb cccc',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('a3f40a92-d90c-11eb-9233-42010a01b004','kanairo','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'d891679c-ac29-11ea-8355-305a3a75dd5b','nelson kip kip',NULL,'1987-06-22','6777888234','qa22233456','Nairobi','Male','Married',NULL,NULL,'Kilimani','Nairobi','Nairobi','kenyan',NULL,'6754','00100','254722166011',NULL,'nelsohnkiprono@outlook.com',NULL,'www.techsavanna.technology','Kenya','254722166011','2547221660','Nelson Kip KIIP','1150816685','Kenya Commercial Bank',NULL,'Moi avenue',NULL,NULL,0,NULL,NULL,'okongo','kinuthia','mbugua','bro','56565656','1980-06-17','Male','Kaloleni','Nairobi','Nairobi','00100',NULL,'254707091878','okongo@gmail.com',0,NULL,NULL,NULL,1,1,NULL,'2021-08-16 19:37:14','Success','The service request is processed successfully.','254722166011','1','PHG2OV2R8K',NULL,'Approved','approved',1,'2021-09-02 10:35:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-29 19:03:07','2022-05-23 11:53:20',NULL,'0234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','nelson','kip','2021-08-17 11:50:14',1629193814,'nelson kip kip',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d891679c-ac29-11ea-8355-305a3a75dd5b',NULL,NULL,1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 10:34:07',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('aac05dfb-0bca-11ec-a244-42010a01b005','Mose',NULL,NULL,NULL,NULL,NULL,NULL,'Moses Cheruiyot Maiyo',NULL,'1959-09-10','22245028','A00025688z','Nairobi','Male','Single',NULL,NULL,'Kasarani','Nairobi','Nairobi','Kenyan',NULL,'1692','00800','254720760781','254720760781','mosesmaiyo7@gmail.com',NULL,NULL,'World Wide','254720760781','2547207607','Moses Maiyo','00006981','Family Bank',NULL,'Westlands',NULL,NULL,0,NULL,NULL,'Kev','Kim','Moi','Son','1222455p','2002-09-02','Male','Kasarani','Nairobi','Nairobi','00800','254720760781','254720760781',NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-09-02 10:49:21',NULL,NULL,'122',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Recording',NULL,NULL,NULL,NULL,'Moses Cheruiyot Maiyo',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('ad5bc088-c544-11eb-9233-42010a01b004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fred m Techsavanna',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722537792',NULL,'cto@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-04 14:53:52',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'fred m Techsavanna',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('aec0bd62-c8f1-11eb-9233-42010a01b004','jackie','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6','CAROLINE MAGGY ACHIENG',NULL,'1974-06-13','12292929','1292983900','Coast','Female','Single',NULL,NULL,'WESTLANDS','NAIROBI','Mombasa','kenyan',NULL,'14806','00800','254722851747','254732700905','achiengoduol@gmail.com','achieng@mcsk.or.ke','www.mcsk.or.ke','World Wide','254722851747','2547228517','CAROLINE MAGGY ACHIENG','1164190000','NIC Bank',NULL,'WESTLANDS',NULL,NULL,0,NULL,NULL,'MICHELLE','WILLIE','ADHIAMBO','DAUGTHER','1222939','2004-06-15','Female','WESTLANDS','NAIROBI','Nairobi','00800','254732700905','254732700905','achiengoduol@gmail.com',1,'CAROLINE MAGGY ACHIENG',NULL,NULL,1,0,NULL,'2021-09-02 10:31:00','Success',NULL,NULL,'1',NULL,NULL,'Approved','',1,'2021-09-02 10:32:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-09 07:09:50','2021-09-02 10:32:20',NULL,'14806',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Complete','JACKLINE','ODUOL','2021-06-16 09:45:44',1623836744,'CAROLINE MAGGY ACHIENG',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'67474849',0,NULL,NULL,NULL,NULL),('bb5d4f9d-0bcc-11ec-a244-42010a01b005','TUFFEST','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6','TUFF KASPA MILULU',NULL,'1990-09-01','24539615','A005796756S','Nairobi','Male','Single',NULL,NULL,'30565','NAIROBI','Nairobi','KENYAN',NULL,'30565','00200','254720907742',NULL,'toughcasper@gmail.com',NULL,NULL,'World Wide','254720907742','2547209077','TUFF KASPA','1124505777','Diamond Trust Bank',NULL,'JOGOO RD',NULL,NULL,0,NULL,NULL,'MIKEY','DONALD','REGGAE','FRIEND','25552641','1994-09-08','Male','NAIROBI','NAIROBI','Nairobi','30565',NULL,'254722334455',NULL,0,NULL,NULL,NULL,1,0,NULL,'2021-09-02 11:34:00','Success',NULL,NULL,'1',NULL,NULL,'Approved','',1,'2021-09-16 12:22:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-09-02 11:04:08','2021-09-16 12:22:59',NULL,'30565',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Complete','TOUGH','MILULU','2021-09-02 11:29:47',1630574987,'TUFF KASPA MILULU',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('bc0f3697-da4d-11ec-b5f7-42010a01b009','ffgh','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'33295c0a-9c7e-11ea-8534-d85de29a5f60',NULL,NULL,'33295c0a-9c7e-11ea-8534-d85de29a5f60','nelson kk ll',3,'1968-05-14','32485180','6790okl76','Nairobi','Male','Married',NULL,NULL,'nairobi','nairobi','Nairobi','kenyan',NULL,'2700','00100','254722166011',NULL,'mcsktest@techsavanna.technology',NULL,NULL,'World Wide','254722166011','2547221660','nwee njn kkk','11234566','Bank of Africa',NULL,'moi avenue',NULL,NULL,0,NULL,NULL,'aaa','bbbb','ccc','brother','2233445566','1970-05-06','Male','kericho','kericho','Nairobi',NULL,NULL,'25477788990',NULL,0,NULL,NULL,NULL,1,1,NULL,'2022-05-23 08:06:15','Success','The service request is processed successfully.','254722166011','1','QEN9GJIT39',NULL,'Approved','approved',1,'2022-05-23 07:32:47',1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 11:59:09',NULL,NULL,'2022-05-23 06:06:34','2022-05-23 11:59:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','nelson','kip','2022-05-23 07:06:04',1653282364,'nelson kk ll',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d891679c-ac29-11ea-8355-305a3a75dd5b',NULL,NULL,1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 11:57:14',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('bdd9396c-f9c1-11eb-a244-42010a01b005','eeee','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6','MARGARET Maggy ACHIENG',NULL,'2000-02-01','eeee','eeee','Nairobi','Female','Married',NULL,NULL,'eeeeee','eeeee','Mombasa','eeee',NULL,'3333','3333','254722851747','254722851747','achiengoduol@yahoo.com','achiengoduol@gmail.com',NULL,'World Wide','254722851747','2547228517','eeee','eeee','Bank of Africa',NULL,'nairobi',NULL,NULL,0,NULL,NULL,'eeee','eee','eee','eee','eeee','1995-01-04','Female','3333','gggg','Nairobi','eee','254732700905','254732700905','willie@gmail.com',0,NULL,NULL,NULL,1,1,NULL,'2021-08-10 13:24:54','Success','The service request is processed successfully.','254722851747','1','PHA6FQW832',NULL,'Rejected','CONFLICT IN WORK DECLARED',0,'2021-09-02 14:10:25',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-10 10:00:07','2021-09-02 14:10:25',NULL,'eee',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','MARGARET','ACHIENG','2021-09-02 11:53:08',1630576388,'MARGARET Maggy ACHIENG',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('c50ea18b-0be4-11ec-a244-42010a01b005','Arap','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6','Mos Arap Maiyo',NULL,'1959-09-10','2289452','A000098z','Nairobi','Male','Married',NULL,NULL,'Westlands','Nairobi','Nairobi','Kenyan',NULL,'3213','00800','254720760781','254720760781','mmaiyo@mcsk.or.ke',NULL,NULL,'World Wide','254720760781','2547207607','Moses Maiyo','552003968','Citibank NA',NULL,'Westlands',NULL,NULL,0,NULL,NULL,'Kev','Arap','Moi','Son','4595922p','2002-09-04','Male','Westlands','Nairobi','Nairobi','00800',NULL,'254720760781',NULL,0,NULL,NULL,NULL,1,1,NULL,'2021-09-02 15:08:19','Success','The service request is processed successfully.','254720760781','1','PI29DZN96N',NULL,'Approved','approved',1,'2021-09-08 01:29:16',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-09-02 13:56:12','2021-09-08 01:29:16',NULL,'14806',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','Moses','Maiyo','2021-09-02 14:08:00',1630584480,'Mos Arap Maiyo',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('c5ca3f28-dcde-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'AAAA VVV NNN',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254254722166011',NULL,'mcsktest1@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-26 12:29:50',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'AAAA VVV NNN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('ca6e6745-da4b-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcsky@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 05:52:39',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('d130c364-a1f5-11eb-b12f-42010a01b002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'XO XO XO',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254719636010',NULL,'13arturius91@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-04-20 16:31:11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'XO XO XO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('d9c9cb0f-cdac-11eb-9233-42010a01b004','FRIENDLY GHOST',NULL,NULL,NULL,NULL,NULL,NULL,'TOUGH CASPER MILULU',NULL,'1986-03-01','24539615','A005796756S','Nairobi','Male','Single',NULL,NULL,'SOUTH C','NAIROBI','Nairobi','KENYAN',NULL,'365','00100','254722951874','254720907742','tcm86@ymail.com','toughcasper@gmail.com',NULL,'World Wide','254722951874','2547229518','TOUGH CASPER MILULU','0100459010400','Standard Chartered Bank',NULL,'DIGITAL',NULL,NULL,0,NULL,NULL,'JIM','JUNIOR','LIKEMBE','BROTHER','36542588','2021-05-20','Male','SOUTH B','NAIROBI','Nairobi','00100',NULL,'254702374870','jimjunior92@gmail.com',0,NULL,NULL,NULL,1,0,NULL,'2021-09-02 10:31:00','Success',NULL,NULL,'1',NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-15 07:39:43',NULL,NULL,'30565',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','TOUGH','MILULU','2021-09-02 10:57:34',1630573054,'TOUGH CASPER MILULU',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2592133',0,NULL,NULL,NULL,NULL),('dcbfce58-da8e-11ec-b5f7-42010a01b009','rock','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'33295c0a-9c7e-11ea-8534-d85de29a5f60',NULL,NULL,'33295c0a-9c7e-11ea-8534-d85de29a5f60','test mcsk mcsk',4,'1968-05-15','325678345','a4900048','Nairobi','Male','Single',NULL,NULL,'nairobi','nairobi','Nairobi','kenyan',NULL,NULL,'00100','254722772874',NULL,'dochieng@mcsk.or.ke',NULL,NULL,'World Wide','254722772874','2547227728','ochieng','115','Bank of Africa',NULL,'moi avenue',NULL,NULL,0,NULL,NULL,'kin','test','mcsk','brother','6677889900','1984-05-22','Male','nairobi','nairobi','Nairobi',NULL,NULL,'254778899002',NULL,0,NULL,NULL,NULL,1,1,NULL,'2022-05-23 15:17:23','Success','The service request is processed successfully.','254722772874','1','QEN3HAXKU3',NULL,'Approved','',1,'2022-05-23 14:54:57',1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 15:10:13',NULL,NULL,'2022-05-23 13:52:46','2022-05-23 15:10:13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','aaaa','bbbb','2022-05-23 14:17:10',1653308230,'test mcsk mcsk',NULL,'false','Representative',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d891679c-ac29-11ea-8355-305a3a75dd5b',NULL,NULL,1,NULL,NULL,NULL,1,'Approved',NULL,NULL,'2022-05-23 15:07:15',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL),('e156757d-a206-11eb-b12f-42010a01b002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fred njuguna kairu',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722537792',NULL,'krufed@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-04-20 18:33:19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'fred njuguna kairu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('e35ccc1c-0013-11ec-a244-42010a01b005','Blesssed',NULL,NULL,NULL,NULL,NULL,NULL,'Joyce Nyambura Gachanja',NULL,'1990-12-28','30217307','A004092429J','Nairobi','Female','Married',NULL,NULL,'14806 -00800','Nairobi','Nairobi','Kenyan',NULL,'14806','00800','254703191469','254703191469','nyamburajoice@gmail.com','nyamburajoice@gmail.com',NULL,'World Wide','254703191469','2547031914','Joyce Nyambura','0111484449687','Co-operative Bank',NULL,'Westlands',NULL,NULL,0,NULL,NULL,'Geoffrey','Njoroge','Ndirangu','Brother','32217307','2021-08-10','Male','135','Naivasha','Nakuru','0027','254721530629','254721530629',NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-08-18 13:03:16',NULL,NULL,'325',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Documents',NULL,NULL,NULL,NULL,'Joyce Nyambura Gachanja',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('e59c405b-0be4-11ec-a244-42010a01b005','SamanthaSamm','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,NULL,NULL,NULL,'b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6','Martha Njuguini Gitau',NULL,'2021-09-04','24039301','A345678902Z','Nairobi','Female','Single',NULL,NULL,'RUIRU','NAIROBI','Nairobi','kenyan',NULL,'301','00400','254722329042','254722329042','marthagitau17@gmail.com',NULL,NULL,'World Wide','254722329042','2547223290','MARTHA N GITAU','56466578989','Diamond Trust Bank',NULL,'KIMATHI STREET',NULL,NULL,0,NULL,NULL,'SAMUEL','MICHINJI','GICHOHI','SPOUSE','22243446','2021-09-07','Male','RUIRU','NAIROBI','Nairobi','01000','254722329042','254722329042','marthagitau17@gmail.com',0,NULL,NULL,NULL,1,1,NULL,'2021-09-02 15:19:46','Success','The service request is processed successfully.','254722329042','1','PI20E097ZK',NULL,'Rejected','',0,'2021-09-16 12:21:42',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-09-02 13:57:07','2021-09-16 12:21:42',NULL,'343',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Payment','Martha','Gitau','2021-09-02 14:18:48',1630585128,'Martha Njuguini Gitau',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('e5fe1ca4-c82a-11eb-9233-42010a01b004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Mary Kalelo Muteti',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254780184092',NULL,'mary@yahoo.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-08 07:26:53',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'Mary Kalelo Muteti',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('e90bd8fa-da48-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcskt@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 05:32:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('f123a27a-da47-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcsk3@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 05:25:06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('f3cbaf17-dce6-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test1 test2 test3',NULL,'1968-05-22','4455677890','78092156789','Nairobi','Male','Single',NULL,NULL,'nairobi','nairobi','Nairobi',NULL,NULL,NULL,'00100','254733177022','254928888912','mcsk5@techsavanna.technology',NULL,NULL,'World Wide','254722166011','2547221660','nelson kiprono','099115089','Bank of Africa',NULL,'main',NULL,NULL,0,NULL,NULL,'aaaa','bbbb','cccc','brother','67892345','1977-05-26','Male','nairobi','nairobi','Nairobi',NULL,NULL,'254733445566',NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-26 13:28:23',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Documents',NULL,NULL,NULL,NULL,'test1 test2 test3',NULL,'false','Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,'Member',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL),('f46389c7-da4c-11ec-b5f7-42010a01b009',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,'Nairobi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'254722166011',NULL,'mcskh@techsavanna.technology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-23 06:00:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'Initial',NULL,NULL,NULL,NULL,'nelsson kip kip',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recording`
--

DROP TABLE IF EXISTS `recording`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recording` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_artist_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isrc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skiza_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recording_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_artist_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured_artist` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_of_recording` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_first_published` datetime DEFAULT NULL,
  `type_of_recording` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `av_work` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_publication` datetime DEFAULT NULL,
  `recording_studio1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recording_studio2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `album_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `album_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_of_publication` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bar_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `catalogue_nr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_first_release` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `track_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `track_nr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `side_nr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recording_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recording_file_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BB532B539721AB5A` (`main_artist_id`),
  KEY `IDX_BB532B53B03A8386` (`created_by_id`),
  KEY `IDX_BB532B53896DBBDE` (`updated_by_id`),
  CONSTRAINT `FK_BB532B53896DBBDE` FOREIGN KEY (`updated_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_BB532B539721AB5A` FOREIGN KEY (`main_artist_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_BB532B53B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recording`
--

LOCK TABLES `recording` WRITE;
/*!40000 ALTER TABLE `recording` DISABLE KEYS */;
/*!40000 ALTER TABLE `recording` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recording_file`
--

DROP TABLE IF EXISTS `recording_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recording_file` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `document_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_file_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recording_file`
--

LOCK TABLES `recording_file` WRITE;
/*!40000 ALTER TABLE `recording_file` DISABLE KEYS */;
INSERT INTO `recording_file` VALUES ('1c1ec543-0004-11ec-a244-42010a01b005','611cce7b5020c.mp3',NULL,'2021-08-18 11:10:19','2021-08-18 11:10:19'),('23c60191-d915-11eb-9233-42010a01b004','60db7cae408aa.pdf',NULL,'2021-06-29 20:03:58','2021-06-29 20:03:58'),('3da6ab7a-0bd5-11ec-a244-42010a01b005','6130a1cf2e832.pdf',NULL,'2021-09-02 12:05:03','2021-09-02 12:05:03'),('45ff133b-0be6-11ec-a244-42010a01b005','6130be629b497.mp3',NULL,'2021-09-02 14:06:58','2021-09-02 14:06:58'),('63649e1a-1148-11ec-a244-42010a01b005','6139c67a6d9ea.mp3',NULL,'2021-09-09 10:31:54','2021-09-09 10:31:54'),('78d27449-0bcf-11ec-a244-42010a01b005','6130982175e61.mp3',NULL,'2021-09-02 11:23:45','2021-09-02 11:23:45'),('7d19224e-da91-11ec-b5f7-42010a01b009','628b79f687496.pdf',NULL,'2022-05-23 14:11:34','2022-05-23 14:11:34'),('bf602ddc-0bc3-11ec-a244-42010a01b005','61308475d99e4.mp3',NULL,'2021-09-02 09:59:49','2021-09-02 09:59:49'),('c37318e0-0bd1-11ec-a244-42010a01b005','61309bf9a62a8.mp3',NULL,'2021-09-02 11:40:09','2021-09-02 11:40:09'),('d1ebe4bd-0be7-11ec-a244-42010a01b005','6130c0fad8c7c.pdf',NULL,'2021-09-02 14:18:02','2021-09-02 14:18:02'),('e3d963c0-da55-11ec-b5f7-42010a01b009','628b15f921b8c.mp3',NULL,'2022-05-23 07:04:57','2022-05-23 07:04:57'),('f967f065-cdbe-11eb-9233-42010a01b004','60c877a7a48ec.mp3',NULL,'2021-06-15 11:49:27','2021-06-15 11:49:27'),('fb3edd1a-f9c4-11eb-a244-42010a01b005','61125396dc752.doc',NULL,'2021-08-10 12:23:18','2021-08-10 12:23:18');
/*!40000 ALTER TABLE `recording_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_created_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved_by_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `is_committee_member` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_committee_chair_member` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` text COLLATE utf8_unicode_ci,
  `member_number` int(20) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_password_created` tinyint(1) DEFAULT NULL,
  `account_created_at` datetime DEFAULT NULL,
  `account_expires_at` datetime DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_reset_token_valid` tinyint(1) DEFAULT NULL,
  `profile_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `corporate_profile_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actual_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_terms_accepted` tinyint(1) NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `producer_relationship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_file` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649CCFA12B8` (`profile_id`),
  UNIQUE KEY `UNIQ_8D93D64994AAAE9` (`corporate_profile_id`),
  KEY `IDX_8D93D6492F1CBF35` (`account_created_by_id`),
  KEY `IDX_8D93D6492D234F6A` (`approved_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('11c15c13-9c7e-11ea-8534-d85de29a5f60','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'mcsk','board','mcskboard@test.com','$2y$13$JRnv6Qt5WLrJnVXwAJfUfOjHFAzTPGTGF8C1JKwhsrRJA3S/AZj3O','[\"ROLE_BOARD\"]','false','false','Nairobi',NULL,'2021-09-09 13:18:13',1,1,NULL,NULL,'1590187585',NULL,NULL,NULL,'Individual','Board','1234',1,'Admin',NULL,'5ee2a9830e1159.50632885.png'),('2247cd69-a1dc-11eb-b12f-42010a01b002',NULL,NULL,'Simon','Muraya','simon.muraya@incentro.com','$2y$13$FMnI7JmbGf03el/Bt0p3j.R3AEXqnjT4qBL9.ec5.XvqsnJ.0XAEO','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-04-20 13:28:18',1,NULL,NULL,NULL,NULL,NULL,'21efa90c-a1dc-11eb-b12f-42010a01b002',NULL,'Individual','Composer','254719636010',1,'Ngunjiri',NULL,NULL),('27e79638-c5a6-11eb-9233-42010a01b004',NULL,NULL,'fred','kairu','info@techsavanna.technology','$2y$13$wCm3nHriqYkU9BzftCCR/ewSSNdNZAEMjn1TK7nXOLm8m8Kolo9O6','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-06-05 04:41:13',1,NULL,NULL,NULL,NULL,NULL,'27903255-c5a6-11eb-9233-42010a01b004',NULL,'Individual','Composer','254722537792',1,'M',NULL,NULL),('33295c0a-9c7e-11ea-8534-d85de29a5f60','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'Jane','Doe','janedoe@test.com','$2y$13$JRnv6Qt5WLrJnVXwAJfUfOjHFAzTPGTGF8C1JKwhsrRJA3S/AZj3O','[\"ROLE_BOARD\"]','false','false','Nairobi',NULL,'2022-05-23 15:08:36',1,1,NULL,NULL,'33295c0a-9c7e-11ea-8534-d85de29a5f60',1,NULL,NULL,'Individual','Board','1234',1,'Admin',NULL,'5ee2a9830e1159.50632885.png'),('375d5f04-0bd2-11ec-a244-42010a01b005',NULL,NULL,'DORCAS','AMULI','dorcasamuli@yahoo.com','$2y$13$Qx3TVOCT.e8TzLSC1vJ5buWGuCF5bbPiTcZvLTkdULNhF2av1BJ/q','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 11:44:10',1,NULL,NULL,NULL,NULL,NULL,'370523e5-0bd2-11ec-a244-42010a01b005',NULL,'Individual','Composer','254711300236',1,'OMUTICHIA',NULL,NULL),('541be9b2-da4c-11ec-b5f7-42010a01b009',NULL,NULL,'nelsson','kip','mcskk@techsavanna.technology','$2y$13$Tm.5Snou8Axy8OskllaVlOi3tPaC8VdrpoF3atNLFTPiD.VuGHdWC','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'53c37131-da4c-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kip',NULL,NULL),('5bc788c0-0002-11ec-a244-42010a01b005',NULL,NULL,'Dennis','Maina','dmaina@mcsk.or.ke','$2y$13$mscXMlXbaCLsAzsRBhWPQOIGwdLpoM5ir4Q2BWGNVl0amEn.2970u','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-08-18 10:58:06',1,NULL,NULL,NULL,NULL,NULL,'5b6f970d-0002-11ec-a244-42010a01b005',NULL,'Individual','Composer','254705720936',1,'Maina',NULL,NULL),('5fa6b81c-f9b9-11eb-a244-42010a01b005',NULL,NULL,'nel','kip','nelsonkip@techsavanna.technology','$2y$13$ky6LrhYSTwayeK6phxfdYOlt4cHfwwEQ/Ht24Rtre6Sl3rS902tfy','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-07 23:27:27',1,NULL,NULL,NULL,NULL,NULL,'5f4eb8ac-f9b9-11eb-a244-42010a01b005',NULL,'Individual','Composer','254707918784',1,'cc',NULL,NULL),('61b485ee-c790-11eb-9233-42010a01b004',NULL,NULL,'Nelson','Chirchir','nelsohnkiprono@gmail.com','$2y$13$prw8zEykyi/CyC8lyHMBSeAyCPWFBPfFzJ4UiBR3VUM8ZEa861/Oa','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',2,'2022-05-26 10:12:10',1,NULL,NULL,NULL,NULL,NULL,'615b4c18-c790-11eb-9233-42010a01b004',NULL,'Individual','Composer','254722166011',1,'Kiprono',NULL,NULL),('6c616a60-a5c7-11ea-b892-d85de29a5f60','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'Simon','Servida','simonservida@test.com','$2y$10$g5ytTcy2Bmv/WH7qxBlXhe9JPf47FdlyxTpLlFwfuKqoOJCVo1dy.','[\"ROLE_BOARD\"]','false','false','Nyanza',NULL,'2020-06-12 00:03:17',1,NULL,NULL,NULL,'1591208651',NULL,NULL,NULL,'Individual','Board','1234',1,'Admin',NULL,'5ee2a9830e1159.50632885.png'),('6cf85331-dce1-11ec-b5f7-42010a01b009',NULL,NULL,'rrr','vv','mcsktes3t@techsavanna.technology4','$2y$13$l89OxZhS9JxKSkrGldxp3ObLXHHBY7RCT0nenOYe1IdlJ1pDcamSC','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2022-05-26 12:49:03',1,NULL,NULL,NULL,NULL,NULL,'6ca02109-dce1-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kk',NULL,NULL),('736d67ce-da4a-11ec-b5f7-42010a01b009',NULL,NULL,'nelsson','kip','mcskx@techsavanna.technology','$2y$13$nREbCeQUvkgRqbEzfyCkDOoxzpR3u/WOCSVS5uG.f.pElkdVwfRLe','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'7314e360-da4a-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kip',NULL,NULL),('7c3cce6e-a27e-11eb-b12f-42010a01b002',NULL,NULL,'JACKLINE','ODUOL','jachieng@mcsk.or.ke','$2y$13$HtinKRoWqrDaQfG39I/EeeyFkMj1iaBP.RJ7SzxpKOOt81Y3nqRsW','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-04-21 08:50:03',1,NULL,NULL,NULL,NULL,NULL,'7be4cee0-a27e-11eb-b12f-42010a01b002',NULL,'Individual','Composer','254722851747',1,'ACHIENG',NULL,NULL),('854e785c-da4d-11ec-b5f7-42010a01b009',NULL,NULL,'nelsson','kip','mcskg@techsavanna.technology','$2y$13$OBR9QqdpOO.h7r2LIQKjc.0hpwzLJMCs1Vww06txZHeYpK9/bowzK','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'84f59ceb-da4d-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kip',NULL,NULL),('872891d7-da59-11ec-b5f7-42010a01b009',NULL,NULL,'bbb','ddd','mcsk1@techsavanna.technology','$2y$13$xZPSqYMAeCdYtsDpALWAcOF3.DCTSa7aArLVgFce9rlIElIwxg9J.','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'86d05dc2-da59-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'ccc',NULL,NULL),('87cf0047-0bc1-11ec-a244-42010a01b005',NULL,NULL,'Brian','Napali','napalibr@gmail.com','$2y$13$jRHlfidlFfLTu5P4JrNtAeD7FhDeIGo4nfctcUvRq.4A8.PGGpdM.','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 13:44:26',1,NULL,NULL,NULL,NULL,NULL,'8777330f-0bc1-11ec-a244-42010a01b005',NULL,'Individual','Composer','254727152794',1,'Lidonde',NULL,NULL),('88234cd0-0bcf-11ec-a244-42010a01b005',NULL,NULL,'James','Owuor','jkisero.jk@gmail.com','$2y$13$QY85cxj9DZaalz8kYNAGtOiXB8TOlyu4ZBr4AL/it6KLJmBjKT7AG','[\"ROLE_USER\"]',NULL,NULL,'Nyanza',NULL,'2021-09-02 14:58:12',1,NULL,NULL,NULL,NULL,NULL,'87cb3d94-0bcf-11ec-a244-42010a01b005',NULL,'Individual','Author','254718794910',1,'Kisero',NULL,NULL),('9a4843f4-dd3e-11ec-b5f7-42010a01b009',NULL,NULL,'aaa','cccc','mcsk6@techsavanna.technology','$2y$13$m0bMEexB4yiR/SNmfngrvOWLMofMZr4NrhZKupfSHtpbfBB2nBSDi','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2022-06-11 19:15:14',1,NULL,NULL,NULL,NULL,NULL,'99eefb8e-dd3e-11ec-b5f7-42010a01b009',NULL,'Individual','Composer Author Arranger Publisher','972233445566',1,'bbb',NULL,NULL),('a44c0afa-d90c-11eb-9233-42010a01b004',NULL,NULL,'nelson','kip','nelsohnkiprono@outlook.com','$2y$13$F.lOVfmJb7HoN8jdGb4FCe/rxj/rp3g9tk4iXIDFtAbJq.SMK2s7e','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-08-17 11:50:03',1,NULL,NULL,NULL,NULL,NULL,'a3f40a92-d90c-11eb-9233-42010a01b004',NULL,'Individual','Author','254722166011',1,'kip',NULL,NULL),('a8242b17-a5db-11ea-b892-d85de29a5f60','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'Maggie','Heller','maggieheller@example.org','$2y$13$JRnv6Qt5WLrJnVXwAJfUfOjHFAzTPGTGF8C1JKwhsrRJA3S/AZj3O','[\"ROLE_COMMITTEE\"]','true','false','Nairobi',NULL,'2020-06-21 23:13:21',1,NULL,NULL,'2020-06-23 10:12:00','a8242b17-a5db-11ea-b892-d85de29a5f60',0,NULL,NULL,'Individual','Committee','1234',1,'Admin',NULL,NULL),('ab188397-0bca-11ec-a244-42010a01b005',NULL,NULL,'Moses','Maiyo','mosesmaiyo7@gmail.com','$2y$13$fsBEn3gFE2enkP/HokQ9he5WEajsImkTjEZgczClqfGe4fnBBLlea','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 14:40:04',1,NULL,NULL,NULL,NULL,NULL,'aac05dfb-0bca-11ec-a244-42010a01b005',NULL,'Individual','Composer','254720760781',1,'Cheruiyot',NULL,NULL),('adb4a97e-c544-11eb-9233-42010a01b004',NULL,NULL,'fred','Techsavanna','cto@techsavanna.technology','$2y$13$V3RyWwiGwdvZk8G6FhUEGOpNK4aA1eZEs7AzaH2wXy0i5yj1AnizK','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'ad5bc088-c544-11eb-9233-42010a01b004',NULL,'Individual','Author','254722537792',1,'m',NULL,NULL),('af1812a1-c8f1-11eb-9233-42010a01b004',NULL,NULL,'CAROLINE','ACHIENG','achiengoduol@gmail.com','$2y$13$JAlOdC5bJ8LfPhicDAiznOQF3mmOhHb51etjS5rgHwX5t.0KDs7A.','[\"ROLE_USER\"]',NULL,NULL,'Coast',NULL,'2021-06-16 08:34:34',1,NULL,NULL,NULL,NULL,NULL,'aec0bd62-c8f1-11eb-9233-42010a01b004',NULL,'Individual','Composer','254732700905',1,'MAGGY',NULL,NULL),('b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6','ecc67711-50f7-11e7-8dca-083e8ec45f2c',NULL,'Tom','Smith','tomsmith@test.com','$2y$13$JRnv6Qt5WLrJnVXwAJfUfOjHFAzTPGTGF8C1JKwhsrRJA3S/AZj3O','[\"ROLE_ADMINISTRATOR\"]',NULL,NULL,NULL,NULL,'2022-06-03 14:29:47',1,1,NULL,NULL,'b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',0,NULL,NULL,'Individual','Admin','1234',1,'Admin',NULL,NULL),('bbb60cf5-0bcc-11ec-a244-42010a01b005',NULL,NULL,'TUFF','MILULU','toughcasper@gmail.com','$2y$13$dk7zvjIVNgxxQf7IrVGQ/.94lxztFhcJwXL7Wbs7Ft.yiy1hZetGu','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 11:04:41',1,NULL,NULL,NULL,NULL,NULL,'bb5d4f9d-0bcc-11ec-a244-42010a01b005',NULL,'Individual','Composer','254788138813',1,'KASPA',NULL,NULL),('bc679b49-da4d-11ec-b5f7-42010a01b009',NULL,NULL,'nelson','ll','mcsktest@techsavanna.technology','$2y$13$v4pnmGRpmeQjIbTAcoTQyuIJT.2mZOR/OAk9UQ3L/QY3Lb14arW4.','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',3,'2022-05-23 07:08:03',1,NULL,NULL,NULL,NULL,NULL,'bc0f3697-da4d-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kk',NULL,NULL),('be30e195-f9c1-11eb-a244-42010a01b005',NULL,NULL,'MARGARET','ACHIENG','achiengoduol@yahoo.com','$2y$13$bdMBE7nNaaUN/Tkx4ohSj.Pfw/vKfZDP1tYePWYsjsG65056zuK0e','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 11:52:57',1,NULL,NULL,NULL,NULL,NULL,'bdd9396c-f9c1-11eb-a244-42010a01b005',NULL,'Individual','Composer','254722851747',1,'Maggy',NULL,NULL),('c5669695-0be4-11ec-a244-42010a01b005',NULL,NULL,'Mos','Maiyo','mmaiyo@mcsk.or.ke','$2y$13$yrWfRyKigjRrY9w27KQhJeKdSrRfMbM970XMQxX0pquZKDA/Xm.S2','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 13:56:27',1,NULL,NULL,NULL,NULL,NULL,'c50ea18b-0be4-11ec-a244-42010a01b005',NULL,'Individual','Composer','254720760781',1,'Arap',NULL,NULL),('c622e08c-dcde-11ec-b5f7-42010a01b009',NULL,NULL,'AAAA','NNN','mcsktest1@techsavanna.technology','$2y$13$BKK9.Gb4oHWwcV2s6zYBy.S1w9HPFtaZlugkpTz.16aflMQjt3SVq','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2022-05-26 12:30:06',1,NULL,NULL,NULL,NULL,NULL,'c5ca3f28-dcde-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'VVV',NULL,NULL),('cac6c25b-da4b-11ec-b5f7-42010a01b009',NULL,NULL,'nelsson','kip','mcsky@techsavanna.technology','$2y$13$DZ1Jjom5.FpL0hCwNqlvYeR.p0nyKR1fo3fJz/DnjCpSpbxTD9902','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'ca6e6745-da4b-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kip',NULL,NULL),('d1887d53-a1f5-11eb-b12f-42010a01b002',NULL,NULL,'XO','XO','13arturius91@gmail.com','$2y$13$rgUTeYOoSKa2F4my/qXPE.iWNdvNkzNzI7zyCEujrQCqBtBrMl4z2','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-04-28 10:02:07',1,NULL,NULL,NULL,'d1887d53-a1f5-11eb-b12f-42010a01b002',0,'d130c364-a1f5-11eb-b12f-42010a01b002',NULL,'Individual','Composer','254719636010',1,'XO',NULL,NULL),('d891679c-ac29-11ea-8355-305a3a75dd5b','b2f62ea6-adc2-11e8-a6bc-ac1f6b45b0c6',NULL,'Mary','Dave','marydave@test.com','$2y$13$JRnv6Qt5WLrJnVXwAJfUfOjHFAzTPGTGF8C1JKwhsrRJA3S/AZj3O','[\"ROLE_COMMITTEE\"]','true','false','Nairobi',NULL,'2022-05-26 13:03:09',1,NULL,NULL,'2024-06-27 11:10:00','1591910631',NULL,NULL,NULL,'Individual','Committee','1234',1,'Admin',NULL,NULL),('da21791c-cdac-11eb-9233-42010a01b004',NULL,NULL,'TOUGH','MILULU','tcm86@ymail.com','$2y$13$Ps5cSfBqZ0AOKktGWIFhJO6yVQMlcCz.D.1c6sDr/92GR0NPudhpG','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 10:20:23',1,NULL,NULL,NULL,NULL,NULL,'d9c9cb0f-cdac-11eb-9233-42010a01b004',NULL,'Individual','Composer','254722951874',1,'CASPER',NULL,NULL),('dd1819c3-da8e-11ec-b5f7-42010a01b009',NULL,NULL,'test','mcsk','dochieng@mcsk.or.ke','$2y$13$W8jV5dWonifjPv2GddvS6uPsITBKW5eiD/K2JgWP7EgUNE9QELBqm','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',4,'2022-05-23 13:57:55',1,NULL,NULL,NULL,NULL,NULL,'dcbfce58-da8e-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'mcsk',NULL,NULL),('e1b788c7-a206-11eb-b12f-42010a01b002',NULL,NULL,'fred','kairu','krufed@gmail.com','$2y$13$G5QPGUr9eftzOQEB205.Vu2HZLHR74dZ3HFZ948.WyjT6SvKuvRM.','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-04-20 18:33:45',1,NULL,NULL,NULL,NULL,NULL,'e156757d-a206-11eb-b12f-42010a01b002',NULL,'Individual','Composer','254722537792',1,'njuguna',NULL,NULL),('e3b45e92-0013-11ec-a244-42010a01b005',NULL,NULL,'Joyce','Gachanja','nyamburajoice@gmail.com','$2y$13$2OWh3Lkk13s3ieai9oOFsesZW8x./2MZhLeNmf8vng5bF2a5E5Wnq','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-08-18 13:04:34',1,NULL,NULL,NULL,NULL,NULL,'e35ccc1c-0013-11ec-a244-42010a01b005',NULL,'Individual','Author','254703191469',1,'Nyambura',NULL,NULL),('e5f42dcf-0be4-11ec-a244-42010a01b005',NULL,NULL,'Martha','Gitau','marthagitau17@gmail.com','$2y$13$POSLkWc7acKi.O22nLN4j.mIdrWprgG2mIWP.COLGFUh5luBTmei6','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-09-02 13:57:54',1,NULL,NULL,NULL,NULL,NULL,'e59c405b-0be4-11ec-a244-42010a01b005',NULL,'Individual','Composer','254722329042',1,'Njuguini',NULL,NULL),('e655c0a0-c82a-11eb-9233-42010a01b004',NULL,NULL,'Mary','Muteti','mary@yahoo.com','$2y$13$/eF78GQh4YR8KxhxKENgqOjknYM18Ki0srgRjl7SESLSe.VX.cBVW','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2021-06-08 07:27:42',1,NULL,NULL,NULL,NULL,NULL,'e5fe1ca4-c82a-11eb-9233-42010a01b004',NULL,'Individual','Composer','254780184092',1,'Kalelo',NULL,NULL),('e964347e-da48-11ec-b5f7-42010a01b009',NULL,NULL,'nelsson','kip','mcskt@techsavanna.technology','$2y$13$9cjkCRtB3XkfTpPEMbXiSOPde.CuMEqwjlL.TnbkkPE/c/DO92yJm','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'e90bd8fa-da48-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kip',NULL,NULL),('f17c7525-da47-11ec-b5f7-42010a01b009',NULL,NULL,'nelsson','kip','mcsk3@techsavanna.technology','$2y$13$LgP.jpIVh3pN5DMfpMmyU.dM6Z0fp3llQF.kdUtCn.Cd5SP7P1wRW','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2022-05-26 10:13:29',1,NULL,NULL,NULL,NULL,NULL,'f123a27a-da47-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kip',NULL,NULL),('f423d601-dce6-11ec-b5f7-42010a01b009',NULL,NULL,'test1','test3','mcsk5@techsavanna.technology','$2y$13$WWswJIhhIINyU8UYDY.Dnu7UiV58gDvyzoRpp9lfYUcwguoAQgku.','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,'2022-05-26 13:35:22',1,NULL,NULL,NULL,NULL,NULL,'f3cbaf17-dce6-11ec-b5f7-42010a01b009',NULL,'Individual','Author','254733177022',1,'test2',NULL,NULL),('f4bbf7dc-da4c-11ec-b5f7-42010a01b009',NULL,NULL,'nelsson','kip','mcskh@techsavanna.technology','$2y$13$439antwC9DzToQIkWgm9ROdtR0wf8xhfXYV0IIxpPNc9nvT/YjllS','[\"ROLE_USER\"]',NULL,NULL,'Nairobi',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'f46389c7-da4c-11ec-b5f7-42010a01b009',NULL,'Individual','Composer','254722166011',1,'kip',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-12 18:47:35
