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
 * HLStats Page Footer
 * This file will be inserted at the end of every page generated by HLStats.
 * This file can contain PHP code.
 */
?>
<br>
<center>
<?php echo $g_options["font_small"]; ?>
	<?php echo l('Generated in real-time by'); ?> <a href="http://www.hlstats-community.org">HLStats</a> <?php echo VERSION; ?> &nbsp;&nbsp;&nbsp; [<a href="<?php echo $g_options["scripturl"]; ?>?mode=admin">Admin</a>]
<?php
	if(isset($_COOKIE["authusername"]) && $_COOKIE['authusername'] != "") {
		echo '&nbsp;[<a href="hlstats.php?logout=1">',l('Logout'),'</a>]';
	}
?>
<?php echo $g_options["fontend_small"]; ?><br><br>
</center>
</body>
</html>
