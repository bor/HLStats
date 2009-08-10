<?php
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

/*
 * HLStats Page Header
 * This file will be inserted at the top of every page generated by HLStats.
 * This file can contain PHP code.
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>HLStats
	  <?php
		foreach ($title as $t) {
			echo " - $t";
		}
	?></title>
	<style type="text/css">
		.fontNormal {
			font-family: Verdana, Arial, sans-serif;
			font-size: 11px;
		}

		.fontSmall {
			font-family: Verdana, Arial, sans-serif;
			font-size: 9px;
		}

		.fontTitle {
			font-family: Arial, sans-serif;
			font-size: 18px;
		}

		.weapon {
			text-decoration: none;
		}

		input, textarea, select {
			font-family: Verdana, Arial, sans-serif;
			font-size: 11px;
		}

		input.textbox, input.checkbox {
			border-width: 1px;
		}

		input.submit {
			height: 22px;
		}

		input.smallsubmit {
			font-size: 9px;
			height: 20px;
		}

		tt {
			font-family: Courier New, Courier, fixed;
			font-size: 12px;
		}

		body {
			margin-top: <?php echo $g_options["body_topmargin"]; ?>px;
			margin-right: <?php echo $g_options["body_leftmargin"]; ?>px;
			margin-bottom: <?php echo $g_options["body_topmargin"]; ?>px;
			margin-left: <?php echo $g_options["body_leftmargin"]; ?>px;
		}
		a:hover {
			color:<?php echo $g_options["body_hlink"]; ?>;
		}
	</style>

	<!--[if lte IE 6]>
	<style>
        img {
            behavior: url(<?php echo INCLUDE_PATH; ?>/iepngfix.htc);
        }
	</style>
	<![endif]-->

</head>
<body bgcolor="<?php echo $g_options["body_bgcolor"]; ?>"
	background="<?php echo $g_options["body_background"]; ?>"
	text="<?php echo $g_options["body_text"]; ?>"
	link="<?php echo $g_options["body_link"]; ?>"
	vlink="<?php echo $g_options["body_vlink"]; ?>"
	alink="<?php echo $g_options["body_alink"]; ?>">
<table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
	<td width="100%">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr valign="bottom">
			<td width=77 style="background-image:url(<?php echo $g_options["imgdir"]; ?>/title-background.gif);"><a href="<?php echo $g_options["scripturl"]; ?>"><img src="<?php echo $g_options["imgdir"]; ?>/title.gif" width="185" height="40" alt="HLStats" border="0"></a></td>
			<td width="100%" align="right" style="background-image:url(<?php echo $g_options["imgdir"]; ?>/title-background.gif);"><a href="<?php echo $g_options["scripturl"]; ?>"><img src="<?php echo $g_options["imgdir"]; ?>/title-contents.gif" alt="Contents" border="0" hspace="2"></a><a href="<?php echo $g_options["scripturl"] . "?mode=search"; ?>"><img src="<?php echo $g_options["imgdir"]; ?>/title-search.gif" alt="Search" border="0" hspace="2"></a><a href="<?php echo $g_options["scripturl"] . "?mode=help"; ?>"><img src="<?php echo $g_options["imgdir"]; ?>/title-help.gif" alt="Help" border="0" hspace="2"></a><img src="<?php echo $g_options["imgdir"]; ?>/spacer.gif" width="6" height="1" border="0" alt="spacer.gif"></td>
		</tr>
		</table>
	</td>
</tr>
<tr valign="top">
	<td width="100%"><img src="<?php echo $g_options["imgdir"]; ?>/spacer.gif" width="1" height="1" border="0" alt="spacer.gif"></td>
</tr>
<tr valign="top">
	<td width="100%">
		<table width="100%" border="0" cellspacing="0" cellpadding="4" bgcolor="<?php echo $g_options["location_bgcolor"]; ?>">
		<tr valign="middle">
			<td width="100%"><?php echo $g_options["font_normal"]; ?><font color="<?php echo $g_options["location_text"]; ?>">&nbsp;&nbsp;&nbsp;
			<?php if ($g_options["sitename"] && $g_options["siteurl"]) {
		          echo "<a href=\"" . $g_options["siteurl"] . "\" style=\"color: " . $g_options["location_link"] . "\">" . $g_options["sitename"] . "</a>: ";
	           }

	echo "<a href=\"" . $g_options["scripturl"] . "\" style=\"color: " . $g_options["location_link"] . "\">HLStats</a>";

	$i=0;
	foreach ($location as $l=>$url) {
		$url = ereg_replace("%s", $g_options["scripturl"], $url);
		echo ": ";

		if ($url) {
			echo "<a href=\"$url\" style=\"color: " . $g_options["location_link"] . "\">$l</a>";
		}
		else {
			echo "<b>$l</b>";
		}

		$i++;
	}

	echo "</font>";
	echo $g_options["fontend_normal"];
?></td>
		</tr>
		</table>
	</td>
</tr>
</table><br>
<table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
	<td width="100%"><?php
		echo $g_options["font_title"];

		end($title);
		echo current($title);

		echo $g_options["fontend_title"];
	?></td>
</tr>
</table><p>
