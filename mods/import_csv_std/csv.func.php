<?php
/**
 *
 * Join CSV Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: csv.func.php
 * @desc: join csv function
 *
 */

function delbadstring($string)
{
	$badstring = array('`', '~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '{', '}', '[', ']', '|', '\\', ':', ';', '"', '\'', '<', '>', ',', '?', '/');
	$onlyconsonants = str_replace($badstring, '', $string);
	return $string;
}

if ( ! function_exists('str_getcsv'))
{
	/* by daniel.oconnor@gmail.com from php.net */
    function str_getcsv($input, $delimiter = ",", $enclosure = '"', $escape = "\\")
	{
        $fiveMBs = 5 * 1024 * 1024;
        $fp = fopen("php://temp/maxmemory:$fiveMBs", 'r+');
        fputs($fp, $input);
        rewind($fp);

        $data = fgetcsv($fp, 1000, $delimiter, $enclosure); //  $escape only got added in 5.3.0

        fclose($fp);
        return $data;
    }
}

if ( ! function_exists('array_replace'))
{
	/* by dyer85@gmail.com from php.net */
	/* with enhancement by tufan.oezduman@googlemail.com from php.net */
	function array_replace( array &$array, array &$array1 )
	{
		$args = func_get_args();
		$count = func_num_args()-1;

		for ($i = 0; $i < $count; ++$i) {
			if (is_array($args[$i])) {
				foreach ($args[$i] as $key => $val) {
					if ($filterEmpty && empty($val)) continue;
						$array[$key] = $val;
				}
			}
			else
			{
				trigger_error(
					__FUNCTION__ . '(): Argument #' . ($i+1) . ' is not an array',
					E_USER_WARNING
				);
				return NULL;
			}
		}
		return $array;
	}
}
