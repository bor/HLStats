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

	if ($auth->userdata["acclevel"] < 100) die ("Access denied!");

	$edlist = new EditList("serverId", DB_PREFIX."_Servers", "server");
	$edlist->columns[] = new EditListColumn("game", "Game", 0, true, "hidden", $gamecode);
	$edlist->columns[] = new EditListColumn("address", "IP Address", 15, true, "ipaddress", "", 15);
	$edlist->columns[] = new EditListColumn("port", "Port", 5, true, "text", "27015", 5);
	$edlist->columns[] = new EditListColumn("name", "Server Name", 22, true, "text", "", 64);
	$edlist->columns[] = new EditListColumn("rcon_password", "Rcon Password", 10, false, "text", "", 48);
	$edlist->columns[] = new EditListColumn("defaultMap", "Default Server Map", 22, false, "text", "", 48);

	$advanced = false;
	if(!empty($_GET['advanced'])) {
		if ($_GET['advanced'] == "1") {
			$edlist->columns[] = new EditListColumn("publicaddress", "Public Address", 20, false, "text", "", 64);
			$edlist->columns[] = new EditListColumn("statusurl", "Status URL", 20, false, "text", "", 255);
			$advanced = true;
		}
	}


	if (isset($_POST['submitServer'])) {
		if ($edlist->update())
			message("success", l("Operation successful"));
		else
			message("warning", $edlist->error());
	}

?>
<p><?php echo l('Enter the addresses of all servers that you want to accept data from'); ?></p>
<p><?php echo l('HLStats can use Rcon to give feedback to users when they'); ?> <a href="index.php?mode=help#set"><?php echo l('update their profile'); ?></a> <?php echo l('if you enable Rcon support in hlstats.conf and specify an Rcon Password for each server'); ?>.</p>
<p><?php echo l('The Default map is used to sepecify the map if HLStats is unable to determine the map'); ?>.</p>

<?php
	if ($advanced === true) {
?>
&gt;&gt; <?php echo l('Go to'); ?> <a href="index.php?mode=admin&admingame=<?php echo $gamecode; ?>&task=servers&advanced=0#servers"><?php echo l('Basic View'); ?></a><p>

<?php echo l('The "Public Address" should be the address you want shown to users. If left blank, it will be generated from the IP Address and Port. If you are using any kind of log relaying utility (i.e. hlstats.pl will not be receiving data directly from the game servers), you will want to set the IP Address and Port to the address of the log relay program, and set the Public Address to the real address of the game server. You will need a separate log relay for each game server. You can specify a hostname (or anything at all) in the Public Address'); ?>.<p>
<?php
	}
	else{
?>
&gt;&gt; <?php echo l('Go to'); ?> <a href="index.php?mode=admin&admingame=<?php echo $gamecode; ?>&task=servers&advanced=1&servers#servers"><?php echo l('Advanced View'); ?></a><p>
<?php
	}

	$result = mysql_query("
		SELECT
			serverId,
			address,
			port,
			name,
			publicaddress,
			statusurl,
			rcon_password,
			defaultMap
		FROM
			".DB_PREFIX."_Servers
		WHERE
			game='".mysql_escape_string($gamecode)."'
		ORDER BY
			address ASC,
			port ASC
	");

	$edlist->draw($result);
?>

<input type="hidden" name="advanced" value="<?php echo $_GET['advanced']; ?>">
<table width="75%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center"><input type="submit" name="submitServer" value=" <?php echo l('Apply'); ?> " class="submit"></td>
</tr>
</table>
