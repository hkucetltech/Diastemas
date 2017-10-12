-- MySQL dump 10.13  Distrib 5.7.16, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: diastemas
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Current Database: `diastemas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `diastemas` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `diastemas`;

--
-- Table structure for table `htx_admin`
--

DROP TABLE IF EXISTS `htx_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `AdminPwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AdminName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AdminTel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AdminPhoto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AdminBackground` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AdminGender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=男 2=女',
  `AdminRemark` text COLLATE utf8_unicode_ci NOT NULL,
  `WhyInterested` text COLLATE utf8_unicode_ci,
  `WhatPresenting` text COLLATE utf8_unicode_ci,
  `RegTime` datetime NOT NULL,
  `LastUpdateTime` datetime NOT NULL,
  `LastLoginTime` datetime NOT NULL,
  `LoginTimes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`AdminID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_community`
--

DROP TABLE IF EXISTS `htx_community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_community` (
  `CommunityID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `CommunityNo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CommunityRemark` text COLLATE utf8_unicode_ci,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`CommunityID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_community_file`
--

DROP TABLE IF EXISTS `htx_community_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_community_file` (
  `FileID` int(11) NOT NULL AUTO_INCREMENT,
  `UserType` tinyint(4) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `PostID` int(11) NOT NULL DEFAULT '0',
  `FileType` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '.jpg',
  `FileURL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AddTime` datetime NOT NULL,
  PRIMARY KEY (`FileID`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_community_like`
--

DROP TABLE IF EXISTS `htx_community_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_community_like` (
  `LikeID` int(11) NOT NULL AUTO_INCREMENT,
  `PostID` int(11) NOT NULL DEFAULT '0',
  `UserType` int(11) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `LikeTime` datetime NOT NULL,
  PRIMARY KEY (`LikeID`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_community_post`
--

DROP TABLE IF EXISTS `htx_community_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_community_post` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(1) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `MsgContent` text COLLATE utf8_unicode_ci NOT NULL,
  `MsgLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PostTime` datetime NOT NULL,
  PRIMARY KEY (`PostID`)
) ENGINE=MyISAM AUTO_INCREMENT=314 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_community_ranking`
--

DROP TABLE IF EXISTS `htx_community_ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_community_ranking` (
  `RankingID` int(11) NOT NULL AUTO_INCREMENT,
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(4) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostNum` int(11) NOT NULL DEFAULT '0',
  `CommentNum` int(11) NOT NULL DEFAULT '0',
  `AllNum` int(11) NOT NULL DEFAULT '0',
  `LastPostID` int(11) NOT NULL,
  `LastPostTime` datetime NOT NULL,
  PRIMARY KEY (`RankingID`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_events`
--

DROP TABLE IF EXISTS `htx_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_events` (
  `EventsID` int(11) NOT NULL AUTO_INCREMENT,
  `EventsTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EventsDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `EventsHour` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EventsMinute` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EventsContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`EventsID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_news`
--

DROP TABLE IF EXISTS `htx_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_news` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `NewsTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NewsDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NewsContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`NewsID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_project`
--

DROP TABLE IF EXISTS `htx_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_project` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ProjectDetail` text COLLATE utf8_unicode_ci NOT NULL,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_project_file`
--

DROP TABLE IF EXISTS `htx_project_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_project_file` (
  `FileID` int(11) NOT NULL AUTO_INCREMENT,
  `UserType` tinyint(4) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `PostID` int(11) NOT NULL DEFAULT '0',
  `FileType` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '.jpg',
  `FileURL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `AddTime` datetime NOT NULL,
  PRIMARY KEY (`FileID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_project_like`
--

DROP TABLE IF EXISTS `htx_project_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_project_like` (
  `LikeID` int(11) NOT NULL AUTO_INCREMENT,
  `PostID` int(11) NOT NULL DEFAULT '0',
  `UserType` int(11) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `LikeTime` datetime NOT NULL,
  PRIMARY KEY (`LikeID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_project_post`
--

DROP TABLE IF EXISTS `htx_project_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_project_post` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(1) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `MsgContent` text COLLATE utf8_unicode_ci NOT NULL,
  `MsgLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PostTime` datetime NOT NULL,
  PRIMARY KEY (`PostID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_project_ranking`
--

DROP TABLE IF EXISTS `htx_project_ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_project_ranking` (
  `RankingID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(4) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostNum` int(11) NOT NULL DEFAULT '0',
  `CommentNum` int(11) NOT NULL DEFAULT '0',
  `AllNum` int(11) NOT NULL DEFAULT '0',
  `LastPostID` int(11) NOT NULL,
  `LastPostTime` datetime NOT NULL,
  PRIMARY KEY (`RankingID`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_school`
--

DROP TABLE IF EXISTS `htx_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_school` (
  `SchoolID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolTel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolPhoto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolBackground` text COLLATE utf8_unicode_ci NOT NULL,
  `FacultyName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultyURL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultyBackground` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`SchoolID`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_school_admin`
--

DROP TABLE IF EXISTS `htx_school_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_school_admin` (
  `SchoolAdminID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolID` int(11) NOT NULL DEFAULT '0',
  `SchoolAdminEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminPwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminPhoto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminBackground` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolAdminName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminTel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminGender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=男 2=女',
  `SchoolAdminRemark` text COLLATE utf8_unicode_ci,
  `WhyInterested` text COLLATE utf8_unicode_ci,
  `WhatPresenting` text COLLATE utf8_unicode_ci,
  `SchoolAdminStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未登入 1已用临时link登入 2已修改密码',
  `SchoolAdminSort` int(20) DEFAULT '0',
  `ReceiveEmail` tinyint(1) NOT NULL DEFAULT '0',
  `RegTime` datetime NOT NULL,
  `LastUpdateTime` datetime NOT NULL,
  `LastLoginTime` datetime NOT NULL,
  `LoginTimes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SchoolAdminID`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_student`
--

DROP TABLE IF EXISTS `htx_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_student` (
  `StudentID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolID` int(11) NOT NULL DEFAULT '0',
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `StudentEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StudentPwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `StudentName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `StudentTel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `StudentPhoto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `StudentBackground` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StudentGender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=男 2=女',
  `StudentRemark` text COLLATE utf8_unicode_ci NOT NULL,
  `WhyInterested` text COLLATE utf8_unicode_ci NOT NULL,
  `WhatPresenting` text COLLATE utf8_unicode_ci NOT NULL,
  `StudentStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未登入 1已用临时link登入 2已修改密码',
  `RegTime` datetime NOT NULL,
  `LastUpdateTime` datetime NOT NULL,
  `LastLoginTime` datetime NOT NULL,
  `LoginTimes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`StudentID`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `htx_webset`
--

DROP TABLE IF EXISTS `htx_webset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `htx_webset` (
  `WebID` int(11) NOT NULL AUTO_INCREMENT,
  `IsCom` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`WebID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tmp_u21_community_post`
--

DROP TABLE IF EXISTS `tmp_u21_community_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_u21_community_post` (
  `PostID` int(11) NOT NULL DEFAULT '0',
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(1) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `MsgContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MsgLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PostTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_admin`
--

DROP TABLE IF EXISTS `u21_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_admin` (
  `AdminID` int(11) NOT NULL DEFAULT '0',
  `AdminEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminPwd` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminTel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminPhoto` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminBackground` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `AdminGender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=男 2=女',
  `AdminRemark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `WhyInterested` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `WhatPresenting` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `RegTime` datetime NOT NULL,
  `LastUpdateTime` datetime NOT NULL,
  `LastLoginTime` datetime NOT NULL,
  `LoginTimes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_community`
--

DROP TABLE IF EXISTS `u21_community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_community` (
  `CommunityID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `CommunityNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CommunityRemark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`CommunityID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_community_file`
--

DROP TABLE IF EXISTS `u21_community_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_community_file` (
  `FileID` int(11) NOT NULL AUTO_INCREMENT,
  `UserType` tinyint(4) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `PostID` int(11) NOT NULL DEFAULT '0',
  `FileType` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '.jpg',
  `FileURL` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AddTime` datetime NOT NULL,
  PRIMARY KEY (`FileID`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_community_like`
--

DROP TABLE IF EXISTS `u21_community_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_community_like` (
  `LikeID` int(11) NOT NULL AUTO_INCREMENT,
  `PostID` int(11) NOT NULL DEFAULT '0',
  `UserType` int(11) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `LikeTime` datetime NOT NULL,
  PRIMARY KEY (`LikeID`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_community_post`
--

DROP TABLE IF EXISTS `u21_community_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_community_post` (
  `PostID` int(11) NOT NULL AUTO_INCREMENT,
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(1) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `MsgContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MsgLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PostTime` datetime NOT NULL,
  PRIMARY KEY (`PostID`)
) ENGINE=InnoDB AUTO_INCREMENT=410 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_community_ranking`
--

DROP TABLE IF EXISTS `u21_community_ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_community_ranking` (
  `RankingID` int(11) NOT NULL AUTO_INCREMENT,
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(4) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostNum` int(11) NOT NULL DEFAULT '0',
  `CommentNum` int(11) NOT NULL DEFAULT '0',
  `AllNum` int(11) NOT NULL DEFAULT '0',
  `LastPostID` int(11) NOT NULL,
  `LastPostTime` datetime NOT NULL,
  PRIMARY KEY (`RankingID`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_events`
--

DROP TABLE IF EXISTS `u21_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_events` (
  `EventsID` int(11) NOT NULL AUTO_INCREMENT,
  `EventsTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EventsDate` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EventsHour` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `EventsMinute` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `EventsContent` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`EventsID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_log`
--

DROP TABLE IF EXISTS `u21_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_log` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `LogTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IPAddress` varchar(45) NOT NULL DEFAULT '',
  `OwnerID` int(11) NOT NULL DEFAULT '0',
  `OwnerType` int(11) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `UserType` int(11) NOT NULL DEFAULT '0',
  `SchoolID` int(11) NOT NULL DEFAULT '0',
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `PostID` int(11) NOT NULL DEFAULT '0',
  `Action` varchar(40) NOT NULL DEFAULT '',
  `Module` varchar(100) NOT NULL DEFAULT '',
  `Info` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`LogID`),
  KEY `KeyLogTime` (`LogTime`),
  KEY `KeyLogStudent` (`UserID`,`LogTime`),
  KEY `KeyLogSchool` (`SchoolID`,`LogTime`),
  KEY `KeyLogCommunity` (`CommunityID`,`LogTime`),
  KEY `KeyLogPost` (`PostID`,`LogTime`),
  KEY `KeyLogAction` (`Action`,`LogTime`)
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_news`
--

DROP TABLE IF EXISTS `u21_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_news` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `NewsTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NewsDate` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NewsContent` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`NewsID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_project`
--

DROP TABLE IF EXISTS `u21_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_project` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ProjectDetail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CreatTime` datetime NOT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_project_file`
--

DROP TABLE IF EXISTS `u21_project_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_project_file` (
  `FileID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(4) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `PostID` int(11) NOT NULL DEFAULT '0',
  `FileType` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '.jpg',
  `FileURL` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AddTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_project_like`
--

DROP TABLE IF EXISTS `u21_project_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_project_like` (
  `LikeID` int(11) NOT NULL DEFAULT '0',
  `PostID` int(11) NOT NULL DEFAULT '0',
  `UserType` int(11) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `LikeTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_project_post`
--

DROP TABLE IF EXISTS `u21_project_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_project_post` (
  `PostID` int(11) NOT NULL DEFAULT '0',
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(1) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `MsgContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MsgLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PostTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_project_ranking`
--

DROP TABLE IF EXISTS `u21_project_ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_project_ranking` (
  `RankingID` int(11) NOT NULL DEFAULT '0',
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `UserType` tinyint(4) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostNum` int(11) NOT NULL DEFAULT '0',
  `CommentNum` int(11) NOT NULL DEFAULT '0',
  `AllNum` int(11) NOT NULL DEFAULT '0',
  `LastPostID` int(11) NOT NULL,
  `LastPostTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_school`
--

DROP TABLE IF EXISTS `u21_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_school` (
  `SchoolID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolTel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolPhoto` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolBackground` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `FacultyName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultyURL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FacultyBackground` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`SchoolID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_school_admin`
--

DROP TABLE IF EXISTS `u21_school_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_school_admin` (
  `SchoolAdminID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolID` int(11) NOT NULL DEFAULT '0',
  `SchoolAdminEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminPwd` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminPhoto` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminBackground` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SchoolAdminName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminTel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SchoolAdminGender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=男 2=女',
  `SchoolAdminRemark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `WhyInterested` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `WhatPresenting` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `SchoolAdminStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未登入 1已用临时link登入 2已修改密码',
  `SchoolAdminSort` int(20) DEFAULT '0',
  `ReceiveEmail` tinyint(1) NOT NULL DEFAULT '0',
  `RegTime` datetime NOT NULL,
  `LastUpdateTime` datetime NOT NULL,
  `LastLoginTime` datetime NOT NULL,
  `LoginTimes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SchoolAdminID`),
  KEY `u21_school_admin_index` (`SchoolAdminID`,`SchoolID`,`SchoolAdminEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `u21_student`
--

DROP TABLE IF EXISTS `u21_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `u21_student` (
  `StudentID` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolID` int(11) NOT NULL DEFAULT '0',
  `ProjectID` int(11) NOT NULL DEFAULT '0',
  `CommunityID` int(11) NOT NULL DEFAULT '0',
  `StudentEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `StudentPwd` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `StudentName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `StudentTel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `StudentPhoto` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `StudentBackground` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `StudentGender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=男 2=女',
  `StudentRemark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `WhyInterested` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `WhatPresenting` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `StudentStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未登入 1已用临时link登入 2已修改密码',
  `RegTime` datetime NOT NULL,
  `LastUpdateTime` datetime NOT NULL,
  `LastLoginTime` datetime NOT NULL,
  `LoginTimes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-01 16:42:33
