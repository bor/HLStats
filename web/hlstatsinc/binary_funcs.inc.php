<?php
/**
 * binary functions file
 * needed for working with the rcon
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


/**
 * get 8 int
 * @param string $data
 * @param int $datastart
 */
function GetInt8($data, &$datastart) {
	$temp = '';
	if(isset($data{$datastart})) {
		$temp = ord($data{$datastart});
		$datastart += 1;
	}
	return $temp;
}

/**
 * check if we have a boolean
 * @param string $data
 * @param int $datastart
 */
function GetBoolean($data, &$datastart) {
	$temp = '';
	$temp = GetInt8($data, $datastart);

	if($temp >= 1)
		return true;
	else
		return false;
}

/**
 * get 16 int
 * @param string $data
 * @param int $datastart
 */
function GetInt16($data, &$datastart) {
	$temp = '';
	// @todo: possible bug ?
	//$temp = GetInt8($data, $datastart) + (GetInt8($data, $datastart) * 256);
	$temp = GetInt8($data, $datastart) + (GetInt8($data, $datastart)<<8);

	return $temp;
}

/**
 * get 32 int
 * @param string $data
 * @param int $datastart
 */
function GetInt32($data, &$datastart) {
	$temp = '';
	$temp = GetInt8($data, $datastart) + (GetInt8($data, $datastart)<<8) + (GetInt8($data, $datastart)<<16) + (GetInt8($data, $datastart)<<24);

	return $temp;
}

/**
 * Null-Terminated String
 * http://developer.valvesoftware.com/wiki/String
 * @param string $data
 * @param int $datastart
 */
function GetString($data, &$datastart) 	{
	$temp = '';
	$counter = 0;
	if(isset($data[$datastart])) {
		while (ord($data[$datastart+$counter++])) {
			$temp .= $data[$datastart+$counter-1];
		}
		$datastart += strlen($temp) + 1;
	}

	return $temp;
}

/**
 * get 32 float
 * @param string $data
 * @param int $datastart
 */
function GetFloat32($data, &$datastart) {
	$decnumber = GetInt32($data, $datastart);
	$binnumber = base_convert($decnumber, 10, 2);
	while (strlen($binnumber) < 32)
		$binnumber = '0'.$binnumber;

	$exp = abs(base_convert(substr($binnumber, 1, 8), 2, 10)) - 127;

	if (substr($binnumber, 0, 1) == 1)
		$exp = 0 - $exp;
	$mantissa = 1;
	$mantadd = 0.5;

	for ($counter = 9; $counter < 32; $counter++)
	{
		if(substr($binnumber, $counter, 1) == 1)
			$mantissa += $mantadd;
		$mantadd = $mantadd / 2;
	}

	$temp = round(pow(2, $exp) * $mantissa);
	return $temp;
}
?>
