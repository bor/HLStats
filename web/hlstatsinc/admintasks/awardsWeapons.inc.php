<?php
/**
 * manage the weapon awards
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


$gc = false;
$check = false;
$return = false;

// get the game, without it we can not do anyting
if(isset($_GET['gc'])) {
	$gc = trim($_GET['gc']);
	$check = validateInput($gc,'nospace');
	if($check === true) {
		// load the game info
		$query = mysql_query("SELECT name
							FROM `".DB_PREFIX."_Games`
							WHERE code = '".mysql_real_escape_string($gc)."'");
		if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
		if(mysql_num_rows($query) > 0) {
			$result = mysql_fetch_assoc($query);
			$gName = $result['name'];
		}
		mysql_free_result($query);
	}
}

// do we have a valid gc code?
if(empty($gc) || empty($check)) {
	exit('No game code given');
}

if(isset($_POST['sub']['saveAwards'])) {

	// del
	if(!empty($_POST['del'])) {
		foreach($_POST['del'] as $k=>$v) {
			$query = mysql_query("DELETE FROM `".DB_PREFIX."_Awards`
									WHERE `awardId` = '".mysql_real_escape_string($k)."'");
			if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
			unset($_POST['code'][$k]);
		}
	}

	// update
	if(!empty($_POST['code'])) {
		foreach($_POST['code'] as $k=>$v) {
			$c = trim($v);
			if(!empty($c)) {
				$name = trim($_POST['name'][$k]);
				$verb = trim($_POST['verb'][$k]);

				$query = mysql_query("UPDATE `".DB_PREFIX."_Awards`
										SET `code` = '".mysql_real_escape_string($c)."',
											`name` = '".mysql_real_escape_string($name)."',
											`verb` = '".mysql_real_escape_string($verb)."'
										WHERE `awardId` = '".mysql_real_escape_string($k)."'");
				if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
				if($query === false) {
					$return['status'] = "1";
					$return['msg'] = l('Data could not be saved');
				}
			}
		}
	}

	// add
	if(isset($_POST['newcode'])) {
		$newOne = trim($_POST['newcode']);
		if(!empty($newOne)) {
			$name = trim($_POST['newname']);
			$verb = trim($_POST['newverb']);

			$query = mysql_query("INSERT INTO `".DB_PREFIX."_Awards`
									SET `code` = '".mysql_real_escape_string($newOne)."',
										`name` = '".mysql_real_escape_string($name)."',
										`verb` = '".mysql_real_escape_string($verb)."',
										`game` = '".mysql_real_escape_string($gc)."',
										`awardType` = 'W'");
			if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
			if($query === false) {
				$return['status'] = "1";
				$return['msg'] = l('Data could not be saved');
			}
		}
	}

	if($return === false) {
		header('Location: index.php?mode=admin&task=awardsWeapons&gc='.$gc.'#awards');
	}
}

// get the awards
$awards = false;
$query = mysql_query("SELECT awardId, code,name,verb
						FROM `".DB_PREFIX."_Awards`
						WHERE game='".mysql_real_escape_string($gc)."'
					AND awardType='W'
					ORDER BY code ASC");
if(SHOW_DEBUG && mysql_error()) var_dump(mysql_error());
if(mysql_num_rows($query) > 0) {
	while($result = mysql_fetch_assoc($query)) {
		$awards[] = $result;
	}
}

$rcol = "row-dark";

pageHeader(array(l("Admin"),l('Weapon Awards')), array(l("Admin")=>"index.php?mode=admin",l('Weapon Awards')=>''));

?>
<div id="sidebar">
	<h1><?php echo l('Options'); ?></h1>
	<div class="left-box">
		<ul class="sidemenu">
			<li>
				<a href="index.php?mode=admin&task=gameoverview&code=<?php echo $gc; ?>"><?php echo l('Back to game overview'); ?></a>
			</li>
			<li>
				<a href="index.php?mode=admin"><?php echo l('Back to admin overview'); ?></a>
			</li>
		</ul>
	</div>
</div>
<div id="main">
	<h1><?php echo l('Weapon Awards for'); ?>: <?php echo $gName; ?></h1>
	<?php
		if(!empty($return)) {
			if($return['status'] === "1") {
				echo '<div class="error">',$return['msg'],'</div>';
			}
			elseif($return['status'] === "2") {
				echo '<div class="success">',$return['msg'],'</div>';
			}
		}
	?>
	<a name="awards"></a>
	<form method="post" action="">
		<table cellpadding="2" cellspacing="0" border="0" width="100%">
			<tr>
				<th><?php echo l('Weapon'); ?></th>
				<th><?php echo l('Award Name'); ?></th>
				<th><?php echo l('Verb Plural'); ?></th>
				<th><?php echo l('Delete'); ?></th>
			</tr>
		<?php if(!empty($awards)) {
			foreach($awards as $a) {
		?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?>">
					<input type="text" name="code[<?php echo $a['awardId']; ?>]" value="<?php echo $a['code']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?>">
					<input type="text" name="name[<?php echo $a['awardId']; ?>]" value="<?php echo $a['name']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?>">
					<input type="text" name="verb[<?php echo $a['awardId']; ?>]" value="<?php echo $a['verb']; ?>" />
				</td>
				<td class="<?php echo $rcol; ?>">
					<input type="checkbox" name="del[<?php echo $a['awardId']; ?>]" value="1" />
				</td>
			</tr>
		<?php
			}
		}
		?>
			<tr>
				<td class="<?php echo toggleRowClass($rcol); ?>">
					<?php echo l('new'); ?> <input type="text" name="newcode" value="" />
				</td>
				<td class="<?php echo $rcol; ?>">
					<input type="text" name="newname" value="" />
				</td>
				<td colspan="2" class="<?php echo $rcol; ?>">
					<input type="text" name="newverb" value="" />
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
					<button type="submit" name="sub[saveAwards]" title="<?php echo l('Save'); ?>">
						<?php echo l('Save'); ?>
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
