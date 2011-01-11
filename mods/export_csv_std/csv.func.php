<?php
/**
 *
 * Download CSV Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: csv.func.php
 * @desc: download csv function
 *
 */

function parsing($string, $confs)
{
	extract($confs);
	$string = rtrim(trim($string), ';');
	$strcustom = array();
	if ( ! empty($string))
	{
		if (preg_match('/^'.$string_begin.'+./', $string))
		{
			list($none, $toproc) = explode($string_begin, $string);
			$fields = explode($string_sep, $toproc);
			$order = 0;
			foreach ($fields as $field)
			{
				preg_match('/'.$string_custom_label.'(?<q>.+)'.$string_custom_value.'(?<v>.+)'.'/', $field, $values);
				if ($values['q'] && $values['v'])
					$strcustom[] = ($csv_ordered == true) ? ( strtolower($values['q']) == strtolower($csv_custom[$order]) ? $values['v'] : '' ) : $values['v'];
				$order++;
			}
		}
	}
	$strcustom = implode($csv_sep, $strcustom);
	return $strcustom;
}
