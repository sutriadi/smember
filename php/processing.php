<?php
/*
 *
 * SMember Plugin
 * Copyright (c) 1431 H / 2010 M
 * by Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: ./php/processing.php
 * @desc: processing members data
 *
 */

/*
if (!defined('SENAYAN_BASE_DIR')) {
	require '../../../../../sysconfig.inc.php';
	require SENAYAN_BASE_DIR.'admin/default/session.inc.php';
}
require SENAYAN_BASE_DIR.'admin/default/session_check.inc.php';

$can_read = utility::havePrivilege('plugins', 'r');
$can_read = utility::havePrivilege('plugins', 'w');

if (!$can_read) {
      die('<div class="errorBox">You dont have enough privileges to view this section</div>');
}

include('../../conf.php');
include('../../func.php');

checkip($conf);
checken();

include('./function.php');
*/

	/* Paging */
/*
	$sLimit = "";
	if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_POST['iDisplayStart'] )
			. ", "
			. mysql_real_escape_string( $_POST['iDisplayLength'] );
	}
*/
	
	/* Ordering */
/*
	if ( isset( $_POST['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i = 0 ; $i < mysql_real_escape_string( $_POST['iSortingCols'] ) ; $i++ )
		{
			$sOrder .= fnColumnToField(mysql_real_escape_string( $_POST['iSortCol_'.$i] ))." "
				. mysql_real_escape_string( $_POST['sSortDir_'.$i] )
				. ", ";
		}
		$sOrder = substr_replace( $sOrder, "", -2 );
	}
*/
	
	/* Filtering */
/*
	$sWhere = "";
	if ( $_POST['sSearch'] != "" )
	{
		$sWhere = "WHERE member_id LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%' OR ".
		                "member_name LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%' OR ".
		                "member_type_name LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%' OR ".
		                "inst_name LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%' OR ".
		                "member_email LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%'";
	}
	
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS member_id, member_name, member_type_name, inst_name, member_email "
		."FROM member "
		."LEFT JOIN mst_member_type ON mst_member_type.member_type_id = member.member_type_id "
		."$sWhere "
		."$sOrder "
		."$sLimit ";
	//~ $rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResult = $dbs->query($sQuery);
	
	$sQuery = "SELECT FOUND_ROWS()";
	//~ $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResultFilterTotal = $dbs->query($sQuery);
	//~ $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$aResultFilterTotal = $rResultFilterTotal->fetch_row();
	$iFilteredTotal = $aResultFilterTotal[0];
	
	$sQuery = "SELECT COUNT(member_id) FROM member";
	//~ $rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResultTotal = $dbs->query($sQuery);
	//~ $aResultTotal = mysql_fetch_array($rResultTotal);
	$aResultTotal = $rResultTotal->fetch_row();
	$iTotal = $aResultTotal[0];
	
	$sOutput = '{'
		. '"sEcho": '.intval($_POST['sEcho']).', '
		. '"iTotalRecords": '.$iTotal.', '
		. '"iTotalDisplayRecords": '.$iFilteredTotal.', '
		. '"aaData": [ ';
	while ( $aRow = $rResult->fetch_assoc() )
	{
		$sOutput .= "["
			. '"<input type=\"checkbox\" id=\"'.$aRow['member_id'].'\" name=\"members[]\" value=\"'.$aRow['member_id'].'\" /> ",'
			. '"'.str_replace('"', '/"', $aRow['member_id']).'",'
			. '"'.str_replace('"', '/"', $aRow['member_name']).'",'
			. '"'.str_replace('"', '/"', $aRow['member_type_name']).'",'
			. '"'.str_replace('"', '/"', $aRow['inst_name']).'",'
			. '"'.str_replace('"', '/"', $aRow['member_email']).'"'
		. "],";
	}
	$sOutput = substr_replace( $sOutput, "", -1 );
	$sOutput .= '] }';
	
	header('Content-type: text/plain');
	echo $sOutput;
*/


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'member_id', 'member_name', 'member_type_name', 'inst_name', 'member_email' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "member_id";
	
	/* DB table to use */
	$sTable = "member";
	
	/* Database connection information */
	$gaSql['user']       = "altroot";
	$gaSql['password']   = "sqladmin";
	$gaSql['db']         = "slims";
	$gaSql['server']     = "localhost";
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_POST['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_POST['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_POST['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_POST['iSortingCols'] ) ; $i++ )
		{
			if ( $_POST[ 'bSortable_'.intval($_POST['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_POST['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_POST['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_POST['sSearch']) != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_POST['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_POST['bSearchable_'.$i]) && $_POST['bSearchable_'.$i] == "true" && $_POST['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_POST['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "" .
		" SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)).
		" FROM $sTable " .
		" LEFT JOIN mst_member_type ON mst_member_type.member_type_id = member.member_type_id " .
		" $sWhere " .
		" $sOrder " .
		" $sLimit " .
	"";
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$sEcho = isset($_POST['sEcho']) ? $_POST['sEcho'] : '';
	$sOutput = '{';
	$sOutput .= '"sEcho": '.$sEcho.', ';
	$sOutput .= '"iTotalRecords": '.$iTotal.', ';
	$sOutput .= '"iTotalDisplayRecords": '.$iFilteredTotal.', ';
	$sOutput .= '"aaData": [ ';
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$sOutput .= "[";
		$sOutput .= '"<input type=\"checkbox\" id=\"' . $aRow['member_id'] . '\" name=\"members[]\" value=\"' . $aRow['member_id'] .  '\" />", ';
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sOutput .= '"'.str_replace('"', '\"', $aRow[ $aColumns[$i] ]).'",';
		}
		
		/*
		 * Optional Configuration:
		 * If you need to add any extra columns (add/edit/delete etc) to the table, that aren't in the
		 * database - you can do it here
		 */
		
		
		$sOutput = substr_replace( $sOutput, "", -1 );
		$sOutput .= "],";
	}
	$sOutput = substr_replace( $sOutput, "", -1 );
	$sOutput .= '] }';
	
	echo $sOutput;
