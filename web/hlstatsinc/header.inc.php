<?php
/**
 * HLStats Page Header
 * This file will be inserted at the top of every page generated by HLStats.
 * This file can contain PHP code.
 * @package HLStats
 * @author Johannes 'Banana' Keßler
 * @copyright Johannes 'Banana' Keßler
 */

/**
 *
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

$titlestr = $title;
$tstr = array_pop($titlestr);
if(!isset($_GET['mode'])) {
	$_GET['mode'] = '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>HLStats
		<?php
		foreach ($title as $t) {
			echo " - $t";
		}
		?>
	</title>
	<link rel="stylesheet" href="css/<?php echo $g_options['style']; ?>.css" type="text/css" media="screen" title="Stylesheet" charset="utf-8" />
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
</head>
<body>
<div id="wrap">
	<div id="header">
		<span id="slogan"><?php echo $tstr; ?></span>
		<ul>
			<li <?php if($_GET['mode'] == '' || ($_GET['mode'] != "search" && $_GET['mode'] != "help")) { ?>id="current"<?php } ?>><a href="index.php"><span><?php echo l('Content'); ?></span></a></li>
			<li <?php if(isset($_GET['mode']) && $_GET['mode'] == "search") { ?>id="current"<?php } ?>><a href="index.php?mode=search"><span><?php echo l('Search'); ?></span></a></li>
			<li <?php if(isset($_GET['mode']) && $_GET['mode'] == "help") { ?>id="current"<?php } ?>><a href="index.php?mode=help"><span><?php echo l('Help'); ?></span></a></li>
		</ul>
	</div>
	<div id="header-logo">
		<div id="logo">
			<img src="hlstatsimg/title.png" alt="HLStats" />
		</div>
		<div id="breadcrumb">
			<a href="<?php echo $g_options["siteurl"]; ?>"><?php echo $g_options["sitename"]; ?></a>:
			<a href="index.php">HLStats</a>
			<?php
			foreach ($location as $l=>$url) {
				echo ": ";
				if(!empty($url)) {
					echo "<a href=\"$url\">$l</a>";
				}
				else {
					echo "<b>$l</b>";
				}
			}
			?>
		</div>
	</div>
	<!-- the main content div is in the includes itself -->
	<!-- since there we can decide if we a sidenav or not -->
