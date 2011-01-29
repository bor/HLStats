<?php
/**
 * HLStats Page Footer
 * This file will be inserted at the end of every page generated by HLStats.
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
?>
</div> <!-- end main -->
<br style="clear: both;" />
<div class="footer">
	<p>
		<?php echo l('Generated in real-time by'); ?> <a href="http://www.hlstats-community.org">HLStats</a> <?php echo VERSION; ?> &nbsp;&nbsp;&nbsp; [<a href="index.php?mode=admin">Admin</a>]
		<?php
			if(isset($auth) && !empty($auth)) {
				echo '&nbsp;[<a href="index.php?mode=admin&amp;logout=1">',l('Logout'),'</a>]';
			}
		?>
		<form action="" method="post">
			<select name="hls_lang_selection">
				<option value="en">EN</option>
				<?php
				$available_langs = glob(getcwd()."/lang/*.ini.php");
				foreach($available_langs as $available_lang) {
					$available_lang = str_replace(".ini.php",'',basename($available_lang));
					$selected = '';
					if($cl === $available_lang) $selected="selected='1'";
					echo '<option value="'.$available_lang.'" '.$selected.'>'.strtoupper($available_lang)."</option>";
				}
				?>
			</select>
			<button type="submit" name="submit-change-lang" title="<?php echo l('Change language'); ?>" >
				<?php echo l('Change language'); ?>
			</button>
		</form>
	</p>
</div>
</body>
</html>
