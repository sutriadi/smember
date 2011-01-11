<?php
/*
 *
 * SMember Plugin
 * Copyright (c) 1431 H / 2010 M
 * by Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: ./php/function.php
 * @desc: smember plugin functions
 *
 */

	if ( ! defined('SENAYAN_BASE_DIR')) { exit(); }
	if (!$can_read)
		die('<div class="errorBox">You dont have enough privileges to view this section</div>');

	function fnColumnToField( $i )
	{
		switch ($i)
		{
			case 0: return "member_id";
			case 1: return "member_id";
			case 2: return "member_name";
			case 3: return "member_type_name";
			case 4: return "inst_name";
			case 5: return "member_email";
		}
	}
