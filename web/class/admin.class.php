<?php
/**
 * admin user auth class file.
 * @package HLStats
 * @author Johannes 'Banana' Keßler
 */


/**
 * Original development:
 * +
 * + HLStats - Real-time player and clan rankings and statistics for Half-Life
 * + http://sourceforge.net/projects/hlstats/
 * +
 * + Copyright (C) 2001  Simon Garner
 * +
 *
 * Additional development:
 * +
 * + UA HLStats Team
 * + http://www.unitedadmins.com
 * + 2004 - 2007
 * +
 *
 *
 * Current development:
 * +
 * + Johannes 'Banana' Keßler
 * + http://hlstats.sourceforge.net
 * + 2007 - 2011
 * +
 *
 * This program is free software is licensed under the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * 
 * You should have received a copy of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 * along with this program; if not, visit http://hlstats-community.org/License.html
 *
 */

/**
 * the main admin class
 * @author banana
 * @package HLStats
 *
 */
class Admin {

	/**
	 * if we are logged in or not
	 * @var $_authStatus boolean
	 */
	private $_authStatus = false;

	/**
	 * the data of the current authenticated user
	 * @var $_userData array
	 */
	private $_userData = false;

	/**
	 * load stuff and check if we are logged in
	 */
	public function __construct() {
		$this->_checkAuth();
	}

	/**
	 * true if we have a valid auth
	 * @return boolean
	 */
	public function getAuthStatus() {
		return $this->_authStatus;
	}

	/**
	 * return the current username
	 * @return string
	 */
	public function getUsername() {
		return $this->_userData['username'];
	}

	/**
	 * check if we valid data and if so login
	 * @param string $username
	 * @param string $pass
	 * @return boolean $ret
	 */
	public function doLogin($username,$pass) {
		$ret = false;

		if(!empty($username) && !empty($pass)) {
			$query = mysql_query("SELECT `username`,`password`
									FROM `".DB_PREFIX."_Users`
									WHERE `username` = '".mysql_real_escape_string($username)."'");
			if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
			if(mysql_num_rows($query) > 0) {
				// we have such user, now check pass
				$result = mysql_fetch_assoc($query);
				$lPass = md5($pass);
				if($result['password'] === $lPass) {
					// valid username and password
					// create auth code
					$authCode = sha1($_SERVER["REMOTE_ADDR"].$_SERVER['HTTP_USER_AGENT'].$lPass);
					$query = mysql_query("UPDATE `".DB_PREFIX."_Users`
											SET `authCode` = '".mysql_real_escape_string($authCode)."'
											WHERE `username` = '".mysql_real_escape_string($username)."'");
					if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
					if($query !== false) {
						$_SESSION['hlstatsAuth']['authCode'] = $authCode;
						$ret = true;

						$this->_userData['username'] = $username;
					}
				}
			}
		}

		return $ret;
	}

	/**
	 * logout the current user and destroy the session
	 * @return void
	 */
	public function doLogout() {
		if(isset($_SESSION['hlstatsAuth']['authCode'])) {
			$authCode = $_SESSION['hlstatsAuth']['authCode'];
			if(validateInput($authCode,'nospace') === true) {
				$query = mysql_query("UPDATE `".DB_PREFIX."_Users`
										SET `authCode` = ''
										WHERE `authCode` = '".mysql_real_escape_string($authCode)."'");
				if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
			}
		}

		session_destroy();
		$_SESSION = array();
	}

	/**
	 * update the current user login data
	 * @param string $username The new username
	 * @param string $pw The new password
	 * @return boolean $ret
	 */
	public function updateLogin($username,$pw) {
		$ret = false;
		
		if(!empty($username)) {
			$queryStr = "UPDATE `".DB_PREFIX."_Users`
							SET `username` = '".mysql_real_escape_string($username)."'";
			if(!empty($pw)) {
				$pw = md5($pw);
				$queryStr .= ", `password` = '".mysql_real_escape_string($pw)."'";
			}

			$queryStr .= " WHERE `username` = '".mysql_real_escape_string($this->_userData['username'])."'";

			$query = mysql_query($queryStr);
			if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
			if($query !== false) {
				$ret = true;
			}
		}

		return $ret;
	}

	/**
	 * check if the user is logged in
	 */
	private function _checkAuth() {
		if(isset($_SESSION['hlstatsAuth']['authCode'])) {
			$check = validateInput($_SESSION['hlstatsAuth']['authCode'],'nospace');
			if($check === true) {
				// check if we have such code into the db
				$userData = $this->_getSessionDataFromDB($_SESSION['hlstatsAuth']['authCode']);
				if($userData !== false) {
					// we have a valid user with valid authCode
					// re create the authcode with current data
					$authCode = sha1($_SERVER["REMOTE_ADDR"].$_SERVER['HTTP_USER_AGENT'].$userData['password']);
					if($authCode === $_SESSION['hlstatsAuth']['authCode']) {
						$this->_authStatus = true;
					}
				}
				else {
					$this->_logoutCleanUp($_SESSION['hlstatsAuth']['authCode']);
				}
			}
		}
	}

	/**
	 * load the session info from the db with the given auth code
	 */
	private function _getSessionDataFromDB($authCode) {
		$ret = false;

		$query = mysql_query("SELECT `username`,`password`
								FROM `".DB_PREFIX."_Users`
								WHERE `authCode` = '".mysql_real_escape_string($authCode)."'");
		if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
		if(mysql_num_rows($query) > 0) {
			$ret = mysql_fetch_assoc($query);
		}

		mysql_free_result($query);

		$this->_userData['username'] = $ret['username'];

		return $ret;
	}

	/**
	 * clean up at logout
	 */
	private function _logoutCleanUp() {
		unset($_SESSION['hlstatsAuth']);
	}
}
?>
