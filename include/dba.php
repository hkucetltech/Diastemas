<?php
/*******************************************************************************
 *
 * dba.php
 *
 * Supporting PDO DB access for this application.
 * Remove all MySQL / MySQLi connections, especially SQL injections.
 *
 * 20160201 Murphy WONG 		Adding dba.php file
 *
 ******************************************************************************/

class dba {
	protected $conn;
	
	public function __construct($dbhost, $dbname, $dbuser, $dbpass, $dbpref) {
		try {
			$this->conn = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass,
			array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		} catch (Exception $e) {
			echo "Unable to connect Diastemas database";
		}
	}
	
	function __destruct() {
		$this->conn = null;
	}

	public function getSchool($SchoolID, $photo = "N", $order = "N") {
		global $CFG;
		$sql = "SELECT SchoolID, SchoolName, SchoolEmail, SchoolTel, SchoolPhoto, SchoolBackground, " .
			"FacultyName, FacultyURL, FacultyBackground FROM " . $CFG->dbpref . "school ";
		if (($SchoolID != "") || ($photo == "Y")) {
			if ($SchoolID != "") {
				$sql .= "WHERE SchoolID=:SchoolID ";
			}
			if ($photo == "Y") {
				if ($SchoolID != "") {
					$sql .= "AND SchoolPhoto<>'' ";
				} else {
					$sql .= "WHERE SchoolPhoto<>'' ";
				}
			}
		}
		if ($order == "Y") {
			$sql .= "ORDER BY SchoolID ASC";
		} else {
			$sql .= "ORDER BY SchoolName ASC";
		}
		$query = $this->conn->prepare($sql);
		if ($SchoolID != "") {
			$query->execute(array(':SchoolID' => $SchoolID)) or 
				die("ERROR: getSchool: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute() or die("ERROR: getSchool: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getSchoolByName($SchoolName) {
		global $CFG;
		$sql = "SELECT SchoolID, SchoolName, SchoolEmail, SchoolTel, SchoolPhoto, SchoolBackground, " .
			"FacultyName, FacultyURL, FacultyBackground FROM " . $CFG->dbpref . "school ";
			"WHERE SchoolName=:SchoolName";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolName' => $SchoolName)) or 
			die("ERROR: getSchoolByName: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// Must add the following:
	// ALTER TABLE u21_school MODIFY SchoolID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertSchool($SchoolName, $SchoolEmail, $SchoolPhoto, $SchoolBackground) {
		global $CFG;
		if ($SchoolPhoto != "") {
			$sql = "INSERT INTO " . $CFG->dbpref . 
				"school (SchoolName, SchoolEmail, SchoolPhoto, SchoolBackground) " . 
				"VALUES (:SchoolName, :SchoolEmail, :SchoolPhoto, :SchoolBackground)";
		} else {
			$sql = "INSERT INTO " . $CFG->dbpref . 
				"school (SchoolName, SchoolEmail, SchoolBackground) " . 
				"VALUES (:SchoolName, :SchoolEmail, :SchoolBackground)";
		}
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolName', $SchoolName);
		$query->bindParam(':SchoolEmail', $SchoolEmail);
		if ($SchoolPhoto != "") {
			$query->bindParam(':SchoolPhoto', $SchoolPhoto);
		}
		$query->bindParam(':SchoolBackground', $SchoolBackground);
		$result = $query->execute() or die("ERROR: insertSchool: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateSchoolPhoto($SchoolID, $SchoolPhoto) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"school SET SchoolPhoto=:SchoolPhoto WHERE SchoolID=:SchoolID");
		$query->execute(array(':SchoolID' => $SchoolID, ':SchoolPhoto' => $SchoolPhoto)) or 
			die("ERROR: updateSchoolPhoto: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateSchool($SchoolID, $SchoolName, $SchoolEmail, $SchoolTel, 
		$SchoolBackground, $FacultyName, $FacultyURL, $FacultyBackground) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "school SET SchoolName=:SchoolName, SchoolEmail=:SchoolEmail, " . 
			"SchoolTel=:SchoolTel, SchoolBackground=:SchoolBackground, FacultyName=:FacultyName, " . 
			"FacultyURL=:FacultyURL, FacultyBackground=:FacultyBackground " . 
			"WHERE SchoolID=:SchoolID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolID', $SchoolID);
		$query->bindParam(':SchoolName', $SchoolName);
		$query->bindParam(':SchoolEmail', $SchoolEmail);
		$query->bindParam(':SchoolTel', $SchoolTel);
		$query->bindParam(':SchoolBackground', $SchoolBackground);
		$query->bindParam(':FacultyName', $FacultyName);
		$query->bindParam(':FacultyURL', $FacultyURL);
		$query->bindParam(':FacultyBackground', $FacultyBackground);
		$result = $query->execute() or die("ERROR: updateSchool: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}
	
	public function updateSchoolByAdmin($SchoolID, $SchoolName, $SchoolEmail, $SchoolBackground) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "school SET SchoolName=:SchoolName, SchoolEmail=:SchoolEmail, " . 
			"SchoolBackground=:SchoolBackground WHERE SchoolID=:SchoolID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolID', $SchoolID);
		$query->bindParam(':SchoolName', $SchoolName);
		$query->bindParam(':SchoolEmail', $SchoolEmail);
		$query->bindParam(':SchoolBackground', $SchoolBackground);
		$result = $query->execute() or die("ERROR: updateSchoolByAdmin: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteSchool($SchoolID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "school WHERE SchoolID=:SchoolID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolID' => $SchoolID)) or 
			die("ERROR: deleteSchool: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getNews($NewsID, $Limit = "6") {
		global $CFG;
		$sql = "SELECT NewsID, NewsTitle, NewsDate, NewsContent FROM " . $CFG->dbpref . "news";
		if ($NewsID != "") {
			$sql .= " WHERE NewsID=:NewsID";
		} else {
			$sql .= " ORDER BY NewsID DESC";
		}
		if ($Limit != "") {
			$sql .= " LIMIT 0," . $Limit;
		}
		$query = $this->conn->prepare($sql);
		if ($NewsID != "") {
			$query->execute(array(':NewsID' => $NewsID)) or 
				die("ERROR: getNews: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute() or
				die("ERROR: getNews: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	// ALTER TABLE u21_news MODIFY NewsID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertNews($NewsTitle, $NewsDate, $NewsContent) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"news (NewsTitle, NewsDate, NewsContent, CreatTime) " . 
			"VALUES (:NewsTitle, :NewsDate, :NewsContent, NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':NewsTitle', $NewsTitle);
		$query->bindParam(':NewsDate', $NewsDate);
		$query->bindParam(':NewsContent', $NewsContent);
		$result = $query->execute() or die("ERROR: insertNews: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateNews($NewsID, $NewsTitle, $NewsDate, $NewsContent) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "news SET NewsTitle=:NewsTitle, " .
			"NewsDate=:NewsDate, NewsContent=:NewsContent WHERE NewsID=:NewsID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':NewsID', $NewsID);
		$query->bindParam(':NewsTitle', $NewsTitle);
		$query->bindParam(':NewsDate', $NewsDate);
		$query->bindParam(':NewsContent', $NewsContent);
		$result = $query->execute() or die("ERROR: updateNews: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteNews($NewsID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "news WHERE NewsID=:NewsID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':NewsID' => $NewsID)) or 
			die("ERROR: deleteNews: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getEvents($EventsID, $Limit = "3") {
		global $CFG;
		$sql = "SELECT EventsID, EventsDate, EventsHour, EventsMinute, EventsTitle, EventsContent FROM " . 
			$CFG->dbpref . "events";
		if ($EventsID != "") {
			$sql .= " WHERE EventsID=:EventsID";
		} else {
			$sql .= " ORDER BY EventsID DESC";
		}
		if ($Limit != "") {
			$sql .= " LIMIT 0," . $Limit;
		}
		$query = $this->conn->prepare($sql);
		if ($EventsID != "") {
			$query->execute(array(':EventsID' => $EventsID)) or 
				die("ERROR: getEvents: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute() or
				die("ERROR: getEvents: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// ALTER TABLE u21_events MODIFY EventsID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertEvents($EventsTitle, $EventsDate, $EventsHour, $EventsMinute, $EventsContent) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"events (EventsTitle, EventsDate, EventsHour, EventsMinute, EventsContent, CreatTime) " . 
			"VALUES (:EventsTitle, :EventsDate, :EventsHour, :EventsMinute, :EventsContent, NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':EventsTitle', $EventsTitle);
		$query->bindParam(':EventsDate', $EventsDate);
		$query->bindParam(':EventsHour', $EventsHour);
		$query->bindParam(':EventsMinute', $EventsMinute);
		$query->bindParam(':EventsContent', $EventsContent);
		$result = $query->execute() or die("ERROR: insertEvents: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateEvents($EventsID, $EventsTitle, $EventsDate, 
		$EventsHour, $EventsMinute, $EventsContent) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "events SET EventsTitle=:EventsTitle, " .
			"EventsDate=:EventsDate, EventsHour=:EventsHour, EventsMinute=:EventsMinute, " .
			"EventsContent=:EventsContent WHERE EventsID=:EventsID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':EventsID', $EventsID);
		$query->bindParam(':EventsTitle', $EventsTitle);
		$query->bindParam(':EventsDate', $EventsDate);
		$query->bindParam(':EventsHour', $EventsHour);
		$query->bindParam(':EventsMinute', $EventsMinute);
		$query->bindParam(':EventsContent', $EventsContent);
		$result = $query->execute() or die("ERROR: updateEvents: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteEvents($EventsID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "events WHERE EventsID=:EventsID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':EventsID' => $EventsID)) or 
			die("ERROR: deleteEvents: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	public function getNewsAndEvents($Keywords, $Limit = "6") {
		global $CFG;
	    $sql = "SELECT NewsID as ID, NewsTitle as Title, 'news' as TbName FROM " . 
			$CFG->dbpref . "news WHERE LOWER(NewsTitle) LIKE LOWER(:Keywords) ";
		$sql .= "UNION SELECT EventsID as ID,EventsTitle as Title, 'events' as TbName FROM " . 
			$CFG->dbpref . "events WHERE LOWER(EventsTitle) LIKE LOWER(:Keywords)";
		if ($Limit != "") {
			$sql .= " LIMIT 0," . $Limit;
		}
		$query = $this->conn->prepare($sql);
		$query->execute(array(':Keywords' => "%$Keywords%")) or 
			die("ERROR: getNewsAndEvents: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getAdmin($AdminID) {
		global $CFG;
	    $sql = "SELECT AdminName AS UserName, 0 AS SchoolID, AdminPhoto AS UserPhoto, AdminTel AS UserTel, " .
			"AdminBackground AS UserBackground, AdminGender AS UserGender, AdminRemark AS UserRemark, " .
			"WhyInterested, WhatPresenting, " . $CFG->dbpref . "admin.* FROM " .
			$CFG->dbpref . "admin WHERE AdminID=:AdminID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':AdminID' => $AdminID)) or 
			die("ERROR: getAdmin: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getAdminByEmail($AdminEmail) {
		global $CFG;
	    $sql = "SELECT AdminID AS UserID, AES_DECRYPT(UNHEX(AdminPwd),'" . $CFG->crypt_key . 
			"') AS UserPwd, AdminName AS UserName, AdminPhoto AS UserPhoto, 0 AS UserStatus, " .
			"0 AS SchoolID, 0 AS CommunityID, 0 AS ProjectID, LastLoginTime, LoginTimes FROM " . 
			$CFG->dbpref . "admin WHERE AdminEmail=:AdminEmail";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':AdminEmail' => $AdminEmail)) or 
			die("ERROR: getAdminByEmail: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateAdminPassword($AdminID, $AdminPwd) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"admin SET AdminPwd=HEX(AES_ENCRYPT(:AdminPwd, '" . $CFG->crypt_key . 
			"')) WHERE AdminID=:AdminID");
		$query->execute(array(':AdminID' => $AdminID, ':AdminPwd' => $AdminPwd)) or 
			die("ERROR: updateAdminPassword: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateAdminPhoto($AdminID, $AdminPhoto) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"admin SET AdminPhoto=:AdminPhoto WHERE AdminID=:AdminID");
		$query->execute(array(':AdminID' => $AdminID, ':AdminPhoto' => $AdminPhoto)) or 
			die("ERROR: updateAdminPhoto: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateAdminBackground($AdminID, $AdminBackground) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"admin SET AdminBackground=:AdminBackground WHERE AdminID=:AdminID");
		$query->execute(array(':AdminID' => $AdminID, ':AdminBackground' => $AdminBackground)) or 
			die("ERROR: updateAdminBackground: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateAdmin($AdminID, $AdminName, $AdminTel, $AdminGender, $AdminRemark, 
		$WhyInterested, $WhatPresenting) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "admin SET AdminName=:AdminName, AdminTel=:AdminTel, " . 
			"AdminGender=:AdminGender, AdminRemark=:AdminRemark, WhyInterested=:WhyInterested, " . 
			"WhatPresenting=:WhatPresenting, LastUpdateTime=NOW() " . 
			"WHERE AdminID=:AdminID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':AdminID', $AdminID);
		$query->bindParam(':AdminName', $AdminName);
		$query->bindParam(':AdminTel', $AdminTel);
		$query->bindParam(':AdminGender', $AdminGender);
		$query->bindParam(':AdminRemark', $AdminRemark);
		$query->bindParam(':WhyInterested', $WhyInterested);
		$query->bindParam(':WhatPresenting', $WhatPresenting);
		$result = $query->execute() or die("ERROR: updateAdmin: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}
	
	public function getSchoolAdmin($SchoolAdminID) {
		global $CFG;
		$sql = "SELECT SchoolAdminName AS UserName, SchoolID, SchoolAdminPhoto as UserPhoto, SchoolAdminTel AS UserTel, " . 
			"SchoolAdminBackground AS UserBackground, SchoolAdminGender AS UserGender, SchoolAdminRemark AS UserRemark, " .
			"WhyInterested, WhatPresenting, " . $CFG->dbpref . "school_admin.* FROM " .
			$CFG->dbpref . "school_admin WHERE SchoolAdminID=:SchoolAdminID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID)) or 
			die("ERROR: getSchoolAdmin: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getSchoolAdminByEmail($SchoolAdminEmail) {
		global $CFG;
		$sql = "SELECT SchoolAdminID AS UserID, AES_DECRYPT(UNHEX(SchoolAdminPwd),'" . $CFG->crypt_key . 
			"') AS UserPwd, SchoolAdminName AS UserName, SchoolAdminPhoto as UserPhoto, SchoolAdminStatus AS UserStatus, " .
			"SchoolID, 0 AS CommunityID, 0 AS ProjectID, LastLoginTime, LoginTimes FROM " . 
			$CFG->dbpref . "school_admin WHERE SchoolAdminEmail=:SchoolAdminEmail";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolAdminEmail' => $SchoolAdminEmail)) or 
			die("ERROR: getSchoolAdminByEmail: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getSchoolAdminBySchoolID($SchoolID, $ReceiveEmail) {
		global $CFG;
		$sql = "SELECT SchoolAdminID, SchoolAdminName, SchoolAdminEmail, SchoolAdminSort, ReceiveEmail FROM " . 
			$CFG->dbpref . "school_admin WHERE SchoolID=:SchoolID ";
		if ($ReceiveEmail == "Y") {
			$sql .= "AND ReceiveEmail=1 ";
		}
		$sql .= " ORDER BY SchoolAdminSort ASC";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolID' => $SchoolID)) or 
			die("ERROR: getSchoolAdminBySchoolID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// ALTER TABLE u21_school_admin MODIFY SchoolAdminID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertSchoolAdmin($SchoolID, $SchoolAdminName, $SchoolAdminEmail, 
		$SchoolAdminPwd, $SchoolAdminPhoto, $SchoolAdminRemark) {
		global $CFG;
		if ($SchoolAdminPhoto != "") {
			$sql = "INSERT INTO " . $CFG->dbpref . 
				"school_admin (SchoolID, SchoolAdminName, SchoolAdminEmail, SchoolAdminPwd, " . 
				"SchoolAdminPhoto, SchoolAdminRemark, SchoolAdminStatus, RegTime) " . 
				"VALUES (:SchoolID, :SchoolAdminName, :SchoolAdminEmail, HEX(AES_ENCRYPT(:SchoolAdminPwd, '" . 
				$CFG->crypt_key . "')), :SchoolAdminPhoto, :SchoolAdminRemark, 0, NOW()) ";
		} else {
			$sql = "INSERT INTO " . $CFG->dbpref . 
				"school_admin (SchoolID, SchoolAdminName, SchoolAdminEmail, SchoolAdminPwd, " . 
				"SchoolAdminRemark, SchoolAdminStatus, RegTime) " . 
				"VALUES (:SchoolID, :SchoolAdminName, :SchoolAdminEmail, HEX(AES_ENCRYPT(:SchoolAdminPwd, '" . 
				$CFG->crypt_key . "')), :SchoolAdminRemark, 0, NOW()) ";
		}
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolID', $SchoolID);
		$query->bindParam(':SchoolAdminName', $SchoolAdminName);
		$query->bindParam(':SchoolAdminEmail', $SchoolAdminEmail);
		$query->bindParam(':SchoolAdminPwd', $SchoolAdminPwd);
		$query->bindParam(':SchoolAdminRemark', $SchoolAdminRemark);
		if ($SchoolAdminPhoto != "") {
			$query->bindParam(':SchoolAdminPhoto', $SchoolAdminPhoto);
		}
		$result = $query->execute() or die("ERROR: insertSchoolAdmin: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function resetSchoolAdminReceiveEmail($SchoolID) {
		global $CFG;
		$sql = "UPDATE ". $CFG->dbpref . "school_admin SET ReceiveEmail=0 WHERE SchoolID=:SchoolID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolID' => $SchoolID)) or 
			die("ERROR: resetSchoolAdminReceiveEmail: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function setSchoolAdminReceiveEmail($SchoolAdminID) {
		global $CFG;
		$sql = "UPDATE ". $CFG->dbpref . "school_admin SET ReceiveEmail=1 WHERE SchoolAdminID=:SchoolAdminID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID)) or 
			die("ERROR: setSchoolAdminReceiveEmail: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateSchoolAdminPassword($SchoolAdminID, $SchoolAdminPwd) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"school_admin SET SchoolAdminPwd=HEX(AES_ENCRYPT(:SchoolAdminPwd, '" . $CFG->crypt_key . 
			"')), LastUpdateTime=NOW() WHERE SchoolAdminID=:SchoolAdminID");
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID, ':SchoolAdminPwd' => $SchoolAdminPwd)) or 
			die("ERROR: updateSchoolAdminPassword: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateSchoolAdminStatus($SchoolAdminID, $SchoolAdminStatus) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"school_admin SET SchoolAdminStatus=:SchoolAdminStatus, LastUpdateTime=NOW() WHERE SchoolAdminID=:SchoolAdminID");
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID, ':SchoolAdminStatus' => $SchoolAdminStatus)) or 
			die("ERROR: updateSchoolAdminStatus: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	public function updateSchoolAdminPhoto($SchoolAdminID, $SchoolAdminPhoto) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"school_admin SET SchoolAdminPhoto=:SchoolAdminPhoto, LastUpdateTime=NOW() WHERE SchoolAdminID=:SchoolAdminID");
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID, ':SchoolAdminPhoto' => $SchoolAdminPhoto)) or 
			die("ERROR: updateSchoolAdminPhoto: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateSchoolAdminBackground($SchoolAdminID, $SchoolAdminBackground) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"school_admin SET SchoolAdminBackground=:SchoolAdminBackground, LastUpdateTime=NOW() WHERE SchoolAdminID=:SchoolAdminID");
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID, ':SchoolAdminBackground' => $SchoolAdminBackground)) or 
			die("ERROR: updateSchoolAdminBackground: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateSchoolAdminSort($SchoolAdminID, $SchoolAdminSort) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "school_admin SET SchoolAdminSort=:SchoolAdminSort, LastUpdateTime=NOW() " . 
			"WHERE SchoolAdminID=:SchoolAdminID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolAdminID', $SchoolAdminID);
		$query->bindParam(':SchoolAdminSort', $SchoolAdminSort);
		$result = $query->execute() or die("ERROR: updateSchoolAdminSort: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateSchoolAdmin($SchoolAdminID, $SchoolAdminName, $SchoolAdminTel, 
		$SchoolAdminGender, $SchoolAdminRemark, $WhyInterested, $WhatPresenting) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "school_admin SET SchoolAdminName=:SchoolAdminName, SchoolAdminTel=:SchoolAdminTel, " . 
			"SchoolAdminGender=:SchoolAdminGender, SchoolAdminRemark=:SchoolAdminRemark, WhyInterested=:WhyInterested, " . 
			"WhatPresenting=:WhatPresenting, LastUpdateTime=NOW() " . 
			"WHERE SchoolAdminID=:SchoolAdminID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolAdminID', $SchoolAdminID);
		$query->bindParam(':SchoolAdminName', $SchoolAdminName);
		$query->bindParam(':SchoolAdminTel', $SchoolAdminTel);
		$query->bindParam(':SchoolAdminGender', $SchoolAdminGender);
		$query->bindParam(':SchoolAdminRemark', $SchoolAdminRemark);
		$query->bindParam(':WhyInterested', $WhyInterested);
		$query->bindParam(':WhatPresenting', $WhatPresenting);
		$result = $query->execute() or die("ERROR: updateSchoolAdmin: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateSchoolAdminEmailIntro($SchoolAdminID, $SchoolAdminName, 
		$SchoolAdminEmail, $SchoolAdminRemark) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "school_admin SET SchoolAdminName=:SchoolAdminName, " . 
			"SchoolAdminEmail=:SchoolAdminEmail, SchoolAdminRemark=:SchoolAdminRemark, " . 
			"LastUpdateTime=NOW() " . 
			"WHERE SchoolAdminID=:SchoolAdminID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolAdminID', $SchoolAdminID);
		$query->bindParam(':SchoolAdminName', $SchoolAdminName);
		$query->bindParam(':SchoolAdminEmail', $SchoolAdminEmail);
		$query->bindParam(':SchoolAdminRemark', $SchoolAdminRemark);
		$result = $query->execute() or die("ERROR: updateSchoolAdminEmailIntro: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteSchoolAdmin($SchoolAdminID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "school_admin WHERE SchoolAdminID=:SchoolAdminID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID)) or 
			die("ERROR: deleteSchoolAdmin: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getStudentByEmail($StudentEmail) {
		global $CFG;
	    $sql = "SELECT StudentID AS UserID, AES_DECRYPT(UNHEX(StudentPwd),'" . $CFG->crypt_key . 
			"') AS UserPwd, StudentName AS UserName, StudentPhoto as UserPhoto, StudentStatus AS UserStatus, " .
			"SchoolID, CommunityID, ProjectID, LastLoginTime, LoginTimes FROM " . 
			$CFG->dbpref . "student WHERE StudentEmail=:StudentEmail";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':StudentEmail' => $StudentEmail)) or 
			die("ERROR: getStudentByEmail: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getStudent($StudentID) {
		global $CFG;
		$sql = "SELECT StudentName AS UserName, StudentPhoto as UserPhoto, StudentTel AS UserTel, " . 
			"StudentEmail AS UserEmail, SchoolID, ProjectID, CommunityID, " .
			"StudentBackground AS UserBackground, " . 
			"StudentGender AS UserGender, StudentRemark AS UserRemark, " .
			// "WhyInterested, WhatPresenting, " . $CFG->dbpref . "student.* FROM " .
			"WhyInterested, WhatPresenting FROM " .
			$CFG->dbpref . "student WHERE StudentID=:StudentID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':StudentID' => $StudentID)) or 
			die("ERROR: getStudent: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getStudentBySchoolID($StudentEmail, $SchoolID) {
		global $CFG;
		$sql = "SELECT ProjectID, StudentID, StudentName, StudentEmail, StudentPhoto, CommunityID FROM ".
			$CFG->dbpref . "student WHERE SchoolID=:SchoolID ";
		if ($StudentEmail != "") {
			$sql .= "AND StudentEmail=:StudentEmail ";
		}
		$sql .= " ORDER BY StudentName ASC";
		$query = $this->conn->prepare($sql);
		if ($StudentEmail != "") {
			$query->execute(array(':SchoolID' => $SchoolID, ':StudentEmail' => $StudentEmail)) or 
				die("ERROR: getStudentBySchoolID: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute(array(':SchoolID' => $SchoolID)) or 
				die("ERROR: getStudentBySchoolID: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getStudentByProjectCommunitySchool($ProjectID, $CommunityID, $SchoolID) {
		global $CFG;
		$sql = "SELECT StudentID, StudentName, StudentPhoto, SchoolID, CommunityID FROM ".
			$CFG->dbpref . "student WHERE 1=1 ";
		if ($ProjectID != "")	{
			$sql .= "AND ProjectID=:ProjectID ";
		}
		if ($CommunityID != "")	{
			$sql .= "AND CommunityID=:CommunityID ";
		}
		if ($SchoolID != "")	{
			$sql .= "AND SchoolID=:SchoolID ";
		}
		$sql .= "ORDER BY StudentName ASC";
		$query = $this->conn->prepare($sql);
		if (($ProjectID != "") && ($CommunityID != "") && ($SchoolID != "")) {
			$query->execute(array(':ProjectID' => $ProjectID, ':CommunityID' => $CommunityID, ':SchoolID' => $SchoolID)) or 
				die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
		} elseif (($ProjectID == "") && ($CommunityID == "") && ($SchoolID == "")) {
			$query->execute() or
				die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
		} else {
			if ($ProjectID == "") {
				if (($CommunityID != "") && ($SchoolID != "")) {
					$query->execute(array(':CommunityID' => $CommunityID, ':SchoolID' => $SchoolID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				} elseif ($CommunityID != "") {
					$query->execute(array(':CommunityID' => $CommunityID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				} elseif ($SchoolID != "") {
					$query->execute(array(':SchoolID' => $SchoolID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				}
			} elseif ($CommunityID == "") {
				if (($ProjectID != "") && ($SchoolID != "")) {
					$query->execute(array(':ProjectID' => $ProjectID, ':SchoolID' => $SchoolID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				} elseif ($ProjectID != "") {
					$query->execute(array(':ProjectID' => $ProjectID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				} elseif ($SchoolID != "") {
					$query->execute(array(':SchoolID' => $SchoolID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				}
			} elseif ($SchoolID == "") {
				if (($ProjectID != "") && ($CommunityID != "")) {
					$query->execute(array(':ProjectID' => $ProjectID, ':CommunityID' => $CommunityID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				} elseif ($ProjectID != "") {
					$query->execute(array(':ProjectID' => $ProjectID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				} elseif ($CommunityID != "") {
					$query->execute(array(':CommunityID' => $CommunityID)) or 
						die("ERROR: getStudentByProjectCommunitySchool: " . implode(":", $query->errorInfo()));
				}
			}
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function insertStudent($SchoolID, $ProjectID, $StudentName, $StudentEmail, 
		$StudentPwd, $StudentPhoto, $StudentRemark) {
		global $CFG;
		if ($StudentPhoto != "") {
			$sql = "INSERT INTO " . $CFG->dbpref . 
				"student (SchoolID, ProjectID, StudentName, StudentEmail, " .
				"StudentPwd, StudentPhoto, StudentRemark, RegTime) " . 
				"VALUES (:SchoolID, :ProjectID, :StudentName, :StudentEmail, " .
				"HEX(AES_ENCRYPT(:StudentPwd, '" . $CFG->crypt_key . 
				"')), :StudentPhoto, :StudentRemark, NOW()) ";
		} else {
			$sql = "INSERT INTO " . $CFG->dbpref . 
				"student (SchoolID, ProjectID, StudentName, StudentEmail, " .
				"StudentPwd, StudentRemark, RegTime) " . 
				"VALUES (:SchoolID, :ProjectID, :StudentName, :StudentEmail, " .
				"HEX(AES_ENCRYPT(:StudentPwd, '" . $CFG->crypt_key . 
				"')), :StudentRemark, NOW()) ";
		}
		echo "<script language='javascript'>alert('Murphy Debug: " . $sql . "');</script>";
		
		$query = $this->conn->prepare($sql);
		$query->bindParam(':SchoolID', $SchoolID);
		$query->bindParam(':ProjectID', $ProjectID);
		$query->bindParam(':StudentName', $StudentName);
		$query->bindParam(':StudentEmail', $StudentEmail);
		$query->bindParam(':StudentPwd', $StudentPwd);
		$query->bindParam(':StudentRemark', $StudentRemark);
		if ($StudentPhoto != "") {
			$query->bindParam(':StudentPhoto', $StudentPhoto);
		}
		$result = $query->execute() or die("ERROR: insertStudent: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	// ALTER TABLE u21_student MODIFY StudentID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function updateStudentPassword($StudentID, $StudentPwd) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"student SET StudentPwd=HEX(AES_ENCRYPT(:StudentPwd, '" . $CFG->crypt_key . 
			"')), LastUpdateTime=NOW() WHERE StudentID=:StudentID");
		$query->execute(array(':StudentID' => $StudentID, ':StudentPwd' => $StudentPwd)) or 
			die("ERROR: updateStudentPassword: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateStudentStatus($StudentID, $StudentStatus) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"student SET StudentStatus=:StudentStatus, LastUpdateTime=NOW() WHERE StudentID=:StudentID");
		$query->execute(array(':StudentID' => $StudentID, ':StudentStatus' => $StudentStatus)) or 
			die("ERROR: updateStudentStatus: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateStudentPhoto($StudentID, $StudentPhoto) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"student SET StudentPhoto=:StudentPhoto, LastUpdateTime=NOW() WHERE StudentID=:StudentID");
		$query->execute(array(':StudentID' => $StudentID, ':StudentPhoto' => $StudentPhoto)) or 
			die("ERROR: updateStudentPhoto: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateStudentBackground($StudentID, $StudentBackground) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"student SET StudentBackground=:StudentBackground, LastUpdateTime=NOW() WHERE StudentID=:StudentID");
		$query->execute(array(':StudentID' => $StudentID, ':StudentBackground' => $StudentBackground)) or 
			die("ERROR: updateStudentBackground: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateStudentCommunityID($StudentID, $CommunityID) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"student SET CommunityID=:CommunityID, LastUpdateTime=NOW() WHERE StudentID=:StudentID");
		$query->execute(array(':StudentID' => $StudentID, ':CommunityID' => $CommunityID)) or 
			die("ERROR: updateStudentCommunityID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function resetStudentCommunityID($CommunityID) {
		global $CFG;
		$query = $this->conn->prepare("UPDATE ". $CFG->dbpref . 
			"student SET CommunityID=0, LastUpdateTime=NOW() WHERE CommunityID=:CommunityID");
		$query->execute(array(':CommunityID' => $CommunityID)) or 
			die("ERROR: resetStudentCommunityID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function updateStudent($StudentID, $StudentName, $StudentTel, $StudentGender, 
		$StudentRemark, $WhyInterested, $WhatPresenting) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "student SET StudentName=:StudentName, StudentTel=:StudentTel, " . 
			"StudentGender=:StudentGender, StudentRemark=:StudentRemark, WhyInterested=:WhyInterested, " . 
			"WhatPresenting=:WhatPresenting, LastUpdateTime=NOW() " . 
			"WHERE StudentID=:StudentID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':StudentID', $StudentID);
		$query->bindParam(':StudentName', $StudentName);
		$query->bindParam(':StudentTel', $StudentTel);
		$query->bindParam(':StudentGender', $StudentGender);
		$query->bindParam(':StudentRemark', $StudentRemark);
		$query->bindParam(':WhyInterested', $WhyInterested);
		$query->bindParam(':WhatPresenting', $WhatPresenting);
		$result = $query->execute() or die("ERROR: updateStudent: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateStudentEmailRemark($StudentID, $ProjectID, $StudentEmail, $StudentName, 
				$StudentRemark) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "student SET ProjectID=:ProjectID, " .
			"StudentEmail=:StudentEmail, StudentName=:StudentName, " . 
			"StudentRemark=:StudentRemark, LastUpdateTime=NOW() " . 
			"WHERE StudentID=:StudentID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':StudentID', $StudentID);
		$query->bindParam(':ProjectID', $ProjectID);
		$query->bindParam(':StudentEmail', $StudentEmail);
		$query->bindParam(':StudentName', $StudentName);
		$query->bindParam(':StudentRemark', $StudentRemark);
		$result = $query->execute() or die("ERROR: updateStudentEmailRemark: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteStudent($StudentID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "student WHERE StudentID=:StudentID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':StudentID' => $StudentID)) or 
			die("ERROR: deleteStudent: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getProject($ProjectID, $Order = "", $Limit = "6") {
		global $CFG;
		$sql = "SELECT ProjectID, ProjectName, ProjectDetail FROM " . $CFG->dbpref . "project";
		if ($ProjectID != "") {
			$sql .= " WHERE ProjectID=:ProjectID";
		}
		if ($Order == "") {
			$sql .= " ORDER BY ProjectID ASC";
		} else {
			$sql .= " ORDER BY ProjectName ASC";
		}
		if ($Limit != "") {
			$sql .= " LIMIT 0," . $Limit;
		}
		$query = $this->conn->prepare($sql);
		if ($ProjectID != "") {
			$query->execute(array(':ProjectID' => $ProjectID)) or 
				die("ERROR: getProject: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute() or
				die("ERROR: getProject: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getProjectByName($ProjectName) {
		global $CFG;
		$sql = "SELECT ProjectID, ProjectName, ProjectDetail FROM " . $CFG->dbpref . "project " .
			" WHERE ProjectName=:ProjectName";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':ProjectName' => $ProjectName)) or 
			die("ERROR: getProjectByName: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	public function getProjectCount() {
		global $CFG;
		$sql = "SELECT COUNT(ProjectID) AS ProjectNum FROM " . $CFG->dbpref . "project";
		$query = $this->conn->prepare($sql);
		$query->execute() or 
			die("ERROR: getProjectCount: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// ALTER TABLE u21_project MODIFY ProjectID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertProject($ProjectName, $ProjectDetail) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"project (ProjectName, ProjectDetail, CreatTime) " . 
			"VALUES (:ProjectName, :ProjectDetail, NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':ProjectName', $ProjectName);
		$query->bindParam(':ProjectDetail', $ProjectDetail);
		$result = $query->execute() or die("ERROR: insertProject: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateProject($ProjectID, $ProjectName, $ProjectDetail) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "project SET ProjectName=:ProjectName, " . 
			"ProjectDetail=:ProjectDetail WHERE ProjectID=:ProjectID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':ProjectID', $ProjectID);
		$query->bindParam(':ProjectName', $ProjectName);
		$query->bindParam(':ProjectDetail', $ProjectDetail);
		$result = $query->execute() or die("ERROR: updateProject: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteProject($ProjectID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "project WHERE ProjectID=:ProjectID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':ProjectID' => $ProjectID)) or 
			die("ERROR: deleteProject: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	public function deleteProjectFile($UserType, $UserID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "project_file WHERE UserID=:UserID AND UserType=:UserType";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
			die("ERROR: deleteProjectFile: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function deleteProjectLike($UserType, $UserID, $PostID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "project_like WHERE UserType=:UserType AND UserID=:UserID";
		if ($PostID != "") {
			$sql .= " AND PostID=:PostID";
		}
		$query = $this->conn->prepare($sql);
		if ($PostID != "") {
			$query->execute(array(':PostID' => $PostID, ':UserID' => $UserID, ':UserType' => $UserType)) or 
				die("ERROR: deleteProjectLike: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
				die("ERROR: deleteProjectLike: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function deleteProjectPost($UserType, $UserID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "project_post WHERE UserID=:UserID AND UserType=:UserType";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
			die("ERROR: deleteProjectPost: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function deleteProjectRanking($UserType, $UserID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "project_ranking WHERE UserID=:UserID AND UserType=:UserType";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
			die("ERROR: deleteProjectRanking: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	public function getCommunity($CommunityID, $ProjectID, $Limit = "6") {
		global $CFG;
		$sql = "SELECT CommunityID, ProjectID, CommunityNo, CommunityRemark FROM " . $CFG->dbpref . "community";
		if ($CommunityID != "") {
			$sql .= " WHERE CommunityID=:CommunityID";
		} elseif ($ProjectID != "") {
			$sql .= " WHERE ProjectID=:ProjectID";
		}
		$sql .= " ORDER BY CommunityNo ASC";
		if ($Limit != "") {
			$sql .= " LIMIT 0," . $Limit;
		}
		$query = $this->conn->prepare($sql);
		if ($CommunityID != "") {
			$query->execute(array(':CommunityID' => $CommunityID)) or 
				die("ERROR: getCommunity: " . implode(":", $query->errorInfo()));
		} elseif ($ProjectID != "") {
			$query->execute(array(':ProjectID' => $ProjectID)) or 
				die("ERROR: getCommunity: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute() or
				die("ERROR: getCommunity: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityByCommunityNo($CommunityNo, $ProjectID, $CommunityID) {
		global $CFG;
		$sql = "SELECT CommunityID, COUNT(*) AS NameFlag FROM " . $CFG->dbpref . "community " .
			"WHERE CommunityNo=:CommunityNo AND ProjectID=:ProjectID";
		if ($CommunityID != "") {
			$sql .= " AND CommunityID<>:CommunityID";
		}
		$query = $this->conn->prepare($sql);
		if ($CommunityID != "") {
			$query->execute(array(':CommunityNo' => $CommunityNo, ':ProjectID' => $ProjectID, ':CommunityID' => $CommunityID)) or 
				die("ERROR: getCommunityByCommunityNo: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute(array(':CommunityNo' => $CommunityNo, ':ProjectID' => $ProjectID)) or 
				die("ERROR: getCommunityByCommunityNo: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityCount() {
		global $CFG;
		$sql = "SELECT COUNT(CommunityID) AS CommunityNum FROM " . $CFG->dbpref . "community";
		$query = $this->conn->prepare($sql);
		$query->execute() or 
			die("ERROR: getCommunityCount: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// ALTER TABLE u21_community MODIFY CommunityID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertCommunity($ProjectID, $CommunityNo, $CommunityRemark) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . "community (ProjectID, CommunityNo, CommunityRemark, CreatTime) " . 
			"VALUES (:ProjectID, :CommunityNo, :CommunityRemark, NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':ProjectID', $ProjectID);
		$query->bindParam(':CommunityNo', $CommunityNo);
		$query->bindParam(':CommunityRemark', $CommunityRemark);
		$result = $query->execute() or die("ERROR: insertCommunity: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateCommunity($CommunityID, $ProjectID, $CommunityNo, $CommunityRemark) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "community SET ProjectID=:ProjectID, " .
			"CommunityNo=:CommunityNo, CommunityRemark=:CommunityRemark " .
			"WHERE CommunityID=:CommunityID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':CommunityID', $CommunityID);
		$query->bindParam(':ProjectID', $ProjectID);
		$query->bindParam(':CommunityNo', $CommunityNo);
		$query->bindParam(':CommunityRemark', $CommunityRemark);
		$result = $query->execute() or die("ERROR: updateCommunity: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunity($CommunityID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community WHERE CommunityID=:CommunityID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':CommunityID' => $CommunityID)) or 
			die("ERROR: deleteCommunity: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityPost($PostID, $UserType, $UserID, $Limit="5") {
		global $CFG;
		if ($PostID != "") {
			$sql = "SELECT * FROM " . $CFG->dbpref . "community_post WHERE PostID=:PostID";
		} else {
			$sql = "SELECT * FROM " . $CFG->dbpref . "community_post WHERE UserType=:UserType AND UserID=:UserID";
		}
		$sql .= " ORDER BY PostTime DESC";
		if ($Limit != "") {
			$sql .= " LIMIT 0," . $Limit;
		}
		$query = $this->conn->prepare($sql);
		if ($PostID != "") {
			$query->execute(array(':PostID' => $PostID)) or 
				die("ERROR: getCommunityPost: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute(array(':UserType' => $UserType, ':UserID' => $UserID)) or 
				die("ERROR: getCommunityPost: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityPostByCommunity($CommunityID) {
		global $CFG;
		$sql = "SELECT * FROM " . $CFG->dbpref . "community_post WHERE CommunityID=:CommunityID " .
			"AND ParentID=0 AND (UserType=1 OR UserType=2 OR (UserType=3 And UserID in " .
			"(SELECT StudentID FROM " . $CFG->dbpref . "student WHERE CommunityID=:CommunityID))) " .
			" ORDER BY PostTime DESC";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':CommunityID' => $CommunityID)) or 
			die("ERROR: getCommunityPostByCommunity: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityPostReply($PostID, $UserType, $SchoolID, $CommunityID) {
		global $CFG;
		$sql = "SELECT * FROM " . $CFG->dbpref . "community_post WHERE ParentID=:PostID ";
		switch($UserType) {
			case 2:
				$sql .=	" AND (UserType=1 OR UserType=2 OR (UserType=3 AND UserID IN " .
					"(SELECT StudentID FROM " . $CFG->dbpref . "student WHERE SchoolID=:SchoolID)))";
				break;
			case 3:
				$sql .=	" AND (UserType=1 OR (UserType=2 AND UserID IN " .
					"(SELECT UserID FROM " . $CFG->dbpref . "school_admin WHERE SchoolID=:SchoolID)) " .
					"OR (UserType=3 AND UserID IN " .
					"(SELECT StudentID FROM " . $CFG->dbpref . "student WHERE CommunityID=:CommunityID)))";
				break;
		}
		$sql .=	" ORDER BY PostTime DESC";
		$query = $this->conn->prepare($sql);
		switch($UserType) {
			case 1:
				$query->execute(array(':PostID' => $PostID)) or 
					die("ERROR: getCommunityPostReply: " . implode(":", $query->errorInfo()));
				break;
			case 2:
				$query->execute(array(':PostID' => $PostID, ':SchoolID' => $SchoolID)) or 
					die("ERROR: getCommunityPostReply: " . implode(":", $query->errorInfo()));
				break;
			case 3:
				$query->execute(array(':PostID' => $PostID, ':SchoolID' => $SchoolID, ':CommunityID' => $CommunityID)) or 
					die("ERROR: getCommunityPostReply: " . implode(":", $query->errorInfo()));
				break;
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityPostCount($PostID) {
		global $CFG;
		$sql = "SELECT COUNT(PostID) AS commentNum FROM " . $CFG->dbpref . "community_post WHERE ParentID=:PostID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':PostID' => $PostID)) or 
			die("ERROR: getCommunityPostCount: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityPostCountByCommunity($CommunityID, $UserType, $UserID, $ParentID = 0) {
		global $CFG;
		$sql = "SELECT COUNT(*) AS countNum FROM " . $CFG->dbpref . "community_post " . 
			"WHERE CommunityID=:CommunityID AND UserType=:UserType AND UserID=:UserID";
		if ($ParentID == 0) {
			$sql .= " AND ParentID=0";
		} else {
			$sql .= " AND ParentID>0";
		}
		$query = $this->conn->prepare($sql);
		$query->execute(array(':CommunityID' => $CommunityID, ':UserType' => $UserType, ':UserID' => $UserID)) or 
			die("ERROR: getCommunityPostCountByCommunity: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// Must add the following:
	// ALTER TABLE u21_community_post MODIFY PostID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertCommunityPost($PostID, $CommunityID, $UserType, $UserID, $MsgContent, $MsgLink) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"community_post (CommunityID, ParentID, UserType, UserID, MsgContent, MsgLink, PostTime) " . 
			"VALUES (:CommunityID, :PostID, :UserType, :UserID, :MsgContent, :MsgLink, NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':PostID', $PostID);
		$query->bindParam(':CommunityID', $CommunityID);
		$query->bindParam(':UserType', $UserType);
		$query->bindParam(':UserID', $UserID);
		$query->bindParam(':MsgContent', $MsgContent);
		$query->bindParam(':MsgLink', $MsgLink);
		$result = $query->execute() or die("ERROR: insertCommunityPost: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityPost($UserType, $UserID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_post WHERE UserID=:UserID AND UserType=:UserType";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
			die("ERROR: deleteCommunityPost: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityPostByParentID($ParentID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_post WHERE ParentID=:ParentID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':ParentID' => $ParentID)) or 
			die("ERROR: deleteCommunityPostByParentID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityPostByCommunityID($CommunityID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_post WHERE CommunityID=:CommunityID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':CommunityID' => $CommunityID)) or 
			die("ERROR: deleteCommunityPostByCommunityID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityRanking($CommunityID, $UserType, $UserID, $Limit = "10") {
		global $CFG;
		$sql = "SELECT RankingID, UserType, UserID, PostNum, CommentNum, AllNum FROM " . $CFG->dbpref . 
			"community_ranking WHERE CommunityID=:CommunityID";
		if ($UserType != "") {
			$sql .= " AND UserType=:UserType AND UserID=:UserID";
		} else {
			$sql .= " AND AllNum>0";
		}
		$sql .= " ORDER BY AllNum DESC";
		if ($Limit != "") {
			$sql .= " LIMIT 0," . $Limit;
		}
		$query = $this->conn->prepare($sql);
		if ($UserType != "") {
			$query->execute(array(':CommunityID' => $CommunityID, ':UserType' => $UserType, ':UserID' => $UserID)) or 
				die("ERROR: getCommunityRanking: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute(array(':CommunityID' => $CommunityID)) or 
				die("ERROR: getCommunityRanking: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// Must add the following:
	// ALTER TABLE u21_community_ranking MODIFY RankingID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertCommunityRanking($CommunityID, $UserType, $UserID, $PostNum, $CommentNum, $AllNum) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"community_ranking (CommunityID, UserType, UserID, PostNum, CommentNum, AllNum, LastPostID, LastPostTime) " . 
			"VALUES (:CommunityID, :UserType, :UserID, :PostNum, :CommentNum, :AllNum, LAST_INSERT_ID(), NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':CommunityID', $CommunityID);
		$query->bindParam(':UserType', $UserType);
		$query->bindParam(':UserID', $UserID);
		$query->bindParam(':PostNum', $PostNum);
		$query->bindParam(':CommentNum', $CommentNum);
		$query->bindParam(':AllNum', $AllNum);
		$result = $query->execute() or die("ERROR: insertCommunityRanking: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function updateCommunityRanking($CommunityID, $UserType, $UserID, $PostNum, $CommentNum, $AllNum) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "community_ranking SET " . 
			"PostNum=:PostNum, CommentNum=:CommentNum, AllNum=:AllNum " . 
			"WHERE CommunityID=:CommunityID AND UserType=:UserType " . 
			"AND UserID=:UserID";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':CommunityID', $CommunityID);
		$query->bindParam(':UserType', $UserType);
		$query->bindParam(':UserID', $UserID);
		$query->bindParam(':PostNum', $PostNum);
		$query->bindParam(':CommentNum', $CommentNum);
		$query->bindParam(':AllNum', $AllNum);
		$result = $query->execute() or die("ERROR: updateCommunityRanking: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityRanking($UserType, $UserID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_ranking WHERE UserID=:UserID AND UserType=:UserType";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
			die("ERROR: deleteCommunityRanking: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	public function deleteCommunityRankingByCommunityID($CommunityID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_ranking WHERE CommunityID=:CommunityID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':CommunityID' => $CommunityID)) or 
			die("ERROR: deleteCommunityRankingByCommunityID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityFile($PostID) {
		global $CFG;
		$sql = "SELECT * FROM " . $CFG->dbpref . "community_file WHERE PostID=:PostID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':PostID' => $PostID)) or 
			die("ERROR: getCommunityFile: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}
	
	// Must add the following:
	// ALTER TABLE u21_community_file MODIFY FileID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertCommunityFile($UserType, $UserID, $PostID, $FileType, $FileURL) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"community_file (UserType, UserID, PostID, FileType, FileURL, AddTime) " . 
			"VALUES (:UserType, :UserID, :PostID, :FileType, :FileURL, NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':UserType', $UserType);
		$query->bindParam(':UserID', $UserID);
		$query->bindParam(':PostID', $PostID);
		$query->bindParam(':FileType', $FileType);
		$query->bindParam(':FileURL', $FileURL);
		$result = $query->execute() or die("ERROR: insertCommunityFile: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityFile($UserType, $UserID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_file WHERE UserID=:UserID AND UserType=:UserType";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
			die("ERROR: deleteCommunityFile: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityFileByPostID($PostID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_file WHERE PostID=:PostID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':PostID' => $PostID)) or 
			die("ERROR: deleteCommunityFileByPostID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityLike($PostID, $UserID, $UserType) {
		global $CFG;
		$sql = "SELECT LikeID FROM " . $CFG->dbpref . "community_like WHERE PostID=:PostID " . 
			"AND UserID=:UserID AND UserType=:UserType";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':PostID' => $PostID, ':UserID' => $UserID, ':UserType' => $UserType)) or 
			die("ERROR: getCommunityLike: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function getCommunityLikeCount($PostID) {
		global $CFG;
		$sql = "SELECT COUNT(LikeID) AS likeNum FROM " . $CFG->dbpref . "community_like WHERE PostID=:PostID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':PostID' => $PostID)) or 
			die("ERROR: getCommunityLikeCount: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	// Must add the following:
	// ALTER TABLE u21_community_like MODIFY LikeID int(11) AUTO_INCREMENT PRIMARY KEY;
	public function insertCommunityLike($UserType, $UserID, $PostID) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"community_like (UserType, UserID, PostID, LikeTime) " . 
			"VALUES (:UserType, :UserID, :PostID, NOW())";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':UserType', $UserType);
		$query->bindParam(':UserID', $UserID);
		$query->bindParam(':PostID', $PostID);
		$result = $query->execute() or die("ERROR: insertCommunityLike: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityLike($UserType, $UserID, $PostID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_like WHERE UserType=:UserType AND UserID=:UserID";
		if ($PostID != "") {
			$sql .= " AND PostID=:PostID";
		}
		$query = $this->conn->prepare($sql);
		if ($PostID != "") {
			$query->execute(array(':PostID' => $PostID, ':UserID' => $UserID, ':UserType' => $UserType)) or 
				die("ERROR: deleteCommunityLike: " . implode(":", $query->errorInfo()));
		} else {
			$query->execute(array(':UserID' => $UserID, ':UserType' => $UserType)) or 
				die("ERROR: deleteCommunityLike: " . implode(":", $query->errorInfo()));
		}
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function deleteCommunityLikeByPostID($PostID) {
		global $CFG;
		$sql = "DELETE FROM " . $CFG->dbpref . "community_like WHERE PostID=:PostID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':PostID' => $PostID)) or 
			die("ERROR: deleteCommunityLikeByPostID: " . implode(":", $query->errorInfo()));
		$result = $query->fetchAll();
		$query->closeCursor();
		return $result;
	}

	public function setAdminLastLog($AdminID) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "admin SET LastLoginTime=NOW(), LoginTimes=(LoginTimes+1) " . 
			"WHERE AdminID=:AdminID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':AdminID' => $AdminID)) or 
			die("ERROR: setAdminLastLog: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}
	
	public function setSchoolAdminLastLog($SchoolAdminID) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "school_admin SET LastLoginTime=NOW(), LoginTimes=(LoginTimes+1) " . 
			"WHERE SchoolAdminID=:SchoolAdminID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':SchoolAdminID' => $SchoolAdminID)) or 
			die("ERROR: setSchoolAdminLastLog: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function setStudentLastLog($StudentID) {
		global $CFG;
		$sql = "UPDATE " . $CFG->dbpref . "student SET LastLoginTime=NOW(), LoginTimes=(LoginTimes+1) " . 
			"WHERE StudentID=:StudentID";
		$query = $this->conn->prepare($sql);
		$query->execute(array(':StudentID' => $StudentID)) or 
			die("ERROR: setStudentLastLog: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

	public function insertLog($OwnerID, $OwnerType, $UserID, $UserType, 
		$SchoolID, $ProjectID, $CommunityID, $PostID, $Action, $Module, $Info) {
		global $CFG;
		$sql = "INSERT INTO " . $CFG->dbpref . 
			"log (IPAddress, OwnerID, OwnerType, UserID, UserType, " .
			"SchoolID, ProjectID, CommunityID, PostID, Action, Module, Info) " . 
			"VALUES (:IPAddress, :OwnerID, :OwnerType, :UserID, :UserType, " .
			":SchoolID, :ProjectID, :CommunityID, :PostID, :Action, :Module, :Info)";
		$query = $this->conn->prepare($sql);
		$query->bindParam(':IPAddress', $_SERVER['REMOTE_ADDR']);
		$query->bindParam(':OwnerID', $OwnerID);
		$query->bindParam(':OwnerType', $OwnerType);
		$query->bindParam(':UserID', $UserID);
		$query->bindParam(':UserType', $UserType);
		$query->bindParam(':SchoolID', $SchoolID);
		$query->bindParam(':ProjectID', $ProjectID);
		$query->bindParam(':CommunityID', $CommunityID);
		$query->bindParam(':PostID', $PostID);
		$query->bindParam(':Action', $Action);
		$query->bindParam(':Module', $Module);
		$query->bindParam(':Info', $Info);
		$result = $query->execute() or die("ERROR: insertLog: " . implode(":", $query->errorInfo()));
		$query->closeCursor();
		return $result;
	}

 }

?>
