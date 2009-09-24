<?php
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
 * + 2007 - 2009
 * +
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// Check PHP configuration
if (version_compare(phpversion(), "5.0.0", "<")) {
	die("HLStats requires PHP version 5.0.0 or newer (you are running PHP version " . phpversion() . ").");
}

date_default_timezone_set('Europe/Berlin');

// if you have problems with your installation
// activate this paramter by setting it to true
define('SHOW_DEBUG',true);

// do not display errors in live version
if(SHOW_DEBUG === true) {
	error_reporting(8191);
	ini_set('display_errors',true);
}
else {
	error_reporting(8191);
	ini_set('display_errors',false);
}

// load config
require('hlstatsinc/hlstats.conf.php');

/**
 * load required stuff
 * general classes like tablle class
 */
require(INCLUDE_PATH . "/functions.inc.php");
require(INCLUDE_PATH . "/classes.inc.php");

/**
 * lang change via cookies
 */
$cl = LANGUAGE;
if(isset($_POST['submit-change-lang'])) {
	$check = validateInput($_POST['hls_lang_selection'],'nospace');
	if($check === true && !isset($_POST['hls_lang_selection'][2])) {
		// ok we can assume that we have a valid post value
		// we have a lang change
		// set the cookie and reload the page
		setcookie("hls_language",$_POST['hls_lang_selection'],time()+600,dirname($_SERVER["SCRIPT_NAME"]).'/','',false,true);
		header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	}
}
elseif(isset($_COOKIE['hls_language']) && !empty($_COOKIE['hls_language'])) {
	$check = validateInput($_COOKIE['hls_language'],'nospace');
	if($check === true && !isset($_COOKIE['hls_language'][2])) {
		// ok we can assume that we have a valid cookie
		$cl = $_COOKIE['hls_language'];
	}
}
if($cl !== 'en') { // use standard language
	$langFile = getcwd().'/lang/'.$cl.'.ini.php';
	if(!file_exists($langFile)) {
		die('Language file coul not be loaded. Please check your LANGUAGE setting in configuration file.');
	}
	$lData = parse_custom_lang_file($langFile);
	if(empty($lData)) {
		die('Language file could not be parsed. Please check your LANGUAGE setting in configuration file.');
	}
}

/*
 if(isset($_POST['change_lang']) && isset($_POST['lang_custom'])) {
	if($_POST['change_lang'] == 1 && isset($_COOKIE['lang'])) {
		if($_COOKIE['lang'] !== $_POST['lang_custom']) {
			if(file_exists(getcwd().'/lang/'.$_POST['lang_custom'].'.ini.php') OR $_POST['lang_custom'] == "en") {
				setcookie("lang", $_POST['lang_custom']);
				$_COOKIE['lang'] = $_POST['lang_custom'];
			}
		}
	}
	elseif($_POST['change_lang'] == 1) {
		if(file_exists(getcwd().'/lang/'.$_POST['lang_custom'].'.ini.php') OR $_POST['lang_custom'] == "en") {
			setcookie("lang", $_POST['lang_custom']);
			$_COOKIE['lang'] = $_POST['lang_custom'];
		}
	}
}

if(isset($_COOKIE['lang'])) { //check if language-cookie is set and valid
	if($_COOKIE['lang'] !== 'en') {
		$langFile = getcwd().'/lang/'.$_COOKIE['lang'].'.ini.php';
		if(!file_exists($langFile)) {
			setcookie("lang", '', mktime(12,0,0,1, 1, 1990));
			unset($_COOKIE['lang']);
			unset($langFile);
		}
		else {
			$lData = parse_custom_lang_file($langFile);
			$current_lang = $_COOKIE['lang'];
		}
	}
	else {
		$current_lang = "en";
	}
}

if(!isset($_COOKIE['lang']) && LANGUAGE !== 'en') { // use standard language if cookie is not set or invalid
	$langFile = getcwd().'/lang/'.LANGUAGE.'.ini.php';
	if(!file_exists($langFile)) {
		die('Language file coul not be loaded. Please check your LANGUAGE setting in configuration file.');
	}
	$lData = parse_custom_lang_file($langFile);
	if(empty($lData)) {
		die('Language file could not be parsed. Please check your LANGUAGE setting in configuration file.');
	}
	$current_lang = LANGUAGE;
}
elseif(!isset($current_lang)) {
	$current_lang = "en";
}
*/

// set utf-8 header
// we have to save all the stuff with utf-8 to make it work !!
header("Content-type: text/html; charset=UTF-8");

////
//// Initialisation
////

define("VERSION", "development version");

$db_con = mysql_connect(DB_ADDR,DB_USER,DB_PASS);
$db_sel = mysql_select_db(DB_NAME,$db_con);
mysql_query("SET NAMES utf8");
mysql_query("SET collation_connection = 'utf8_unicode_ci'");

/**
 * load the options
 */
$g_options = array();
$g_options = getOptions();

if(empty($g_options)) {
	error('Failed to load options.');
}

// set scripturl if not set in options
if(empty($g_options['scripturl'])) {
	$g_options["scripturl"] = 'hlstats.php';
}


////
//// Main
////
$modes = array(
	"players",
	"clans",
	"weapons",
	"maps",
	"actions",
	"claninfo",
	"playerinfo",
	"weaponinfo",
	"mapinfo",
	"actioninfo",
	"playerhistory",
	"search",
	"admin",
	"help",
	"livestats",
	"playerchathistory"
);

$mode = '';
if(!empty($_GET["mode"])) {
	if(in_array($_GET["mode"], $modes) && validateInput($_GET['mode'],'nospace') === true ) {
		$mode = $_GET['mode'];
	}
}

// process the logout
if(!empty($_GET['logout'])) {
	if(validateInput($_GET['logout'],'digit') === true && $_GET['logout'] == "1") {
		// destroy session and cookie

		setcookie("authusername", '', mktime(12,0,0,1, 1, 1990));
		setcookie("authpassword", '', mktime(12,0,0,1, 1, 1990));
		setcookie("authsavepass", '', mktime(12,0,0,1, 1, 1990));
		setcookie("authsessionStart", '', mktime(12,0,0,1, 1, 1990));

		$_COOKIE = array();
		$_SESSION = array();
	}
}

$game = '';
if(isset($_GET['game'])) {
	$check = validateInput($_GET['game'],'nospace');
	if($check === true) {
		$game = $_GET['game'];

		$query = mysql_query("SELECT name FROM ".DB_PREFIX."_Games WHERE code='".mysql_escape_string($game)."' AND `hidden` = '0'");
		if(mysql_num_rows($query) < 1) {
			error("No such game '$game'.");
		}
		else {
			$result = mysql_fetch_assoc($query);
			$gamename = $result['name'];
			if(empty($mode)) $mode = 'game';
		}
	}
}
else {
	// decide if we show the games or the game file
	$queryAllGames = mysql_query("SELECT code,name FROM ".DB_PREFIX."_Games WHERE hidden='0' ORDER BY name ASC");
	$num_games = mysql_num_rows($queryAllGames);

	if ($num_games == 1) {
		//$query = mysql_query("SELECT code,name FROM ".DB_PREFIX."_Games WHERE hidden='0'");
		//$result = mysql_fetch_assoc($query);
		if(!empty($num_games)) {
			$game = $num_games['code'];
			$gamename = $num_games['name'];
			if(empty($mode)) $mode = 'game';
		}
		else {
			error("No such game.");
		}
	}
	else {
		if(empty($mode)) $mode = 'games';
	}
}

include(INCLUDE_PATH . "/".$mode.".inc.php");

include(INCLUDE_PATH . "/footer.inc.php");
mysql_close($db_con);
?>
