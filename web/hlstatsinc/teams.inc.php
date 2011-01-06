<?php
/**
 * teams overview file
 * display an overview about each team the game has.
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

$rcol = "row-dark";
$teams['data'] = array();
$teams['pages'] = array();

$sort = 'teamcount';
if (isset($_GET["sort"])) {
	$check = validateInput($_GET['sort'],'nospace');
	if($check === true) {
		$sort = $_GET['sort'];
	}
}

$newSort = "ASC";
$sortorder = 'DESC';
if (isset($_GET["sortorder"])) {
	$check = validateInput($_GET['sortorder'],'nospace');
	if($check === true) {
		$sortorder = $_GET['sortorder'];
	}

	if($_GET["sortorder"] == "ASC") {
		$newSort = "DESC";
	}
}

$queryStr = "SELECT IFNULL(".DB_PREFIX."_Teams.name, ".DB_PREFIX."_Events_ChangeTeam.team) AS name,
			COUNT(".DB_PREFIX."_Events_ChangeTeam.id) AS teamcount,
			".DB_PREFIX."_Teams.teamId
		FROM ".DB_PREFIX."_Events_ChangeTeam
		LEFT JOIN ".DB_PREFIX."_Teams ON
			".DB_PREFIX."_Events_ChangeTeam.team=".DB_PREFIX."_Teams.code
		LEFT JOIN ".DB_PREFIX."_Servers ON
			".DB_PREFIX."_Servers.serverId=".DB_PREFIX."_Events_ChangeTeam.serverId
		WHERE ".DB_PREFIX."_Teams.game='".mysql_escape_string($game)."'
			AND ".DB_PREFIX."_Servers.game='".mysql_escape_string($game)."'
			AND (hidden <>'1' OR hidden IS NULL)
		GROUP BY ".DB_PREFIX."_Events_ChangeTeam.team
		ORDER BY ".$sort." ".$sortorder;

$query = mysql_query($queryStr);
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$teams['data'][] = $result;
	}
}

pageHeader(
	array($gamename, l("Team Statistics")),
	array($gamename => "index.php?game=$game", l("Team Statistics")=>"")
);
?>

<div id="sidebar">
	<h1><?php echo l('Options'); ?></h1>
	<div class="left-box">
		<ul class="sidemenu">
			<li>
				<a href="<?php echo "index.php?game=$game"; ?>"><?php echo l('Back to game overview'); ?></a>
			</li>
		</ul>
	</div>
	<h1><?php echo l('Game'); ?></h1>
	<div class="left-box">
		<img src="hlstatsimg/game-<?php echo $game; ?>-big.png" alt="<?php echo $game; ?>" title="<?php echo $game; ?>" width="100px" height="100px" />
	</div>
</div>
<div id="main">
	<h1><?php echo l("Team Statistics"); ?></h1>
	<table cellpadding="0" cellspacing="0" border="1" width="100%">
		<tr>
			<th class="<?php echo $rcol; ?>">
				<a href="index.php?<?php echo makeQueryString(array('sort'=>'name','sortorder'=>$newSort)); ?>">
					<?php echo l('Team'); ?>
				</a>
				<?php if($sort == "name") { ?>
				<img src="hlstatsimg/<?php echo $sortorder; ?>.gif" alt="Sorting" width="7" height="7" />
				<?php } ?>
			</th>
			<th class="<?php echo $rcol; ?>">
				<a href="index.php?<?php echo makeQueryString(array('sort'=>'teamcount','sortorder'=>$newSort)); ?>">
					<?php echo l('Selected'); ?>
				</a>
				<?php if($sort == "teamcount") { ?>
				<img src="hlstatsimg/<?php echo $sortorder; ?>.gif" alt="Sorting" width="7" height="7" />
				<?php } ?>
			</th>
		</tr>
		<?php
		if(!empty($teams['data'])) {
			foreach($teams['data'] as $k=>$entry) {
				toggleRowClass($rcol);

				echo '<tr>',"\n";

				echo '<td class="',$rcol,'">';
				echo $entry['name'];
				echo '</td>',"\n";

				echo '<td class="',$rcol,'">';
				echo $entry['teamcount'];
				echo '</td>',"\n";

				echo '</tr>';
			}
		}
		else {
			echo '<tr><td colspan="3">',l('No data recorded'),'</td></tr>';
		}
		?>
	</table>
</div>
