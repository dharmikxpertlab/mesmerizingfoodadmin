<?php

include("../include/dbConnection.php");
$result = mysqli_fetch_array(mysqli_query($connection, "select * from `admin` where `adminId`={$_SESSION['admin']}"));
$id = $_SESSION['admin'];
$assignedmenuedit = array();
$assignedmenudelete = array();
$country = isset($_GET['country']) ? $_GET['country'] : "";
$state = isset($_GET['state']) ? $_GET['state'] : "";
$city = isset($_GET['city']) ? $_GET['city'] : "";

if($country!=""){	
	$query = " AND `country` = '". $country ."'";

}elseif($state!=""){
	$query = " AND `state` = '". $state ."'";
}elseif($city!=""){
	$query = " AND `city`= '". $city ."'";
}else{
	$query ="";
}


$role = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `role` WHERE `roleId` = '{$result['roleId']}'"));
$assignedmenuedit = explode(",", $role['menuIdEdit']);
$assignedmenudelete = explode(",", $role['menuIdDelete']);
// "gender","languages",
$aColumns = array("rowNumber","Actions","fullName","email","mobileNumber","dateOfBirth","gender","country","state","city");
	
	$sIndexColumn = "rowNumber"; 
	$sTable = "
		(
			SELECT
				(SELECT @rownum := @rownum + 1 FROM ( SELECT @rownum := 0 ) AS `rowtable`) AS `rowNumber`,
				`user`.*
				FROM
				(
					SELECT
					
						
						`user`.`fullName` as `fullName`,
						`user`.`email` as `email`,
						`user`.`mobileNumber` as `mobileNumber`,
						`user`.`dateOfBirth` as `dateOfBirth`,
						`user`.`country` as `country`,
						`user`.`state` as `state`,
						`user`.`city` as `city`,
						`user`.`gender` as `gender`,
						
						

						
						CONCAT('<div class=\"margin-bottom-5\">
						" . ((in_array(2, $assignedmenuedit) || $result['roleId'] == 0) ? "<a href=\"../adduser-',TO_BASE64(`user`.`userId`),'/\" style=\"width: 30px;height: 30px;margin-right:5px;\" title=\"Edit\" data-toggle=\"tooltip\" data-theme=\"dark\" data-placement=\"right\" class=\"btn btn-icon btn-success\"><i class=\"fas fa-edit\"></i></a>" : "") . "
                        
                        " . ((in_array(2, $assignedmenudelete) || $result['roleId'] == 0) ? "<button onclick=\"remove(',`user`.`userId`,')\" style=\"width: 30px;height: 30px;\" title=\"Delete\" data-toggle=\"tooltip\" data-theme=\"dark\" data-placement=\"right\" class=\"btn btn-icon btn-danger\"><i class=\"fas fa-trash\"></i></button>" : "") . "
						
						
						
						</div>') AS `Actions`
						
						FROM `user`
						WHERE `delete` = '0' ". $query ."
						
				) AS `user`
		) AS `user`";
		
	$sLimit = "";
	if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1')
	{
		$sLimit = "LIMIT " . mysqli_real_escape_string($connection, $_GET['iDisplayStart']) . ", " . mysqli_real_escape_string($connection, $_GET['iDisplayLength']);
	}
	
	if(isset($_GET['iSortCol_0']))
	{
		$sOrder = "ORDER BY  ";
		for($i=0 ; $i<intval($_GET['iSortingCols']) ; $i++)
		{
			if($_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true")
			{
				$sOrder .= $aColumns[ intval($_GET['iSortCol_'.$i]) ] . "
				 	" . mysqli_real_escape_string($connection, $_GET['sSortDir_'.$i]) . ", ";
			}
		}
		
		$sOrder = substr_replace($sOrder, "", -2);
		if($sOrder == "ORDER BY")
		{
			$sOrder = "";
		}
	}
	
	$sWhere = "";
	if($_GET['sSearch'] != "")
	{
		$sWhere = "WHERE (";
		for($i = 0 ; $i < count($aColumns) ; $i++)
		{
			$sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($connection, $_GET['sSearch'])."%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	
	for($i = 0 ; $i < count($aColumns) ; $i++)
	{
		if($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '')
		{
			if($sWhere == "")
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($connection, $_GET['sSearch_'.$i]) . "%' ";
		}
	}
	
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	$rResult = mysqli_query($connection, $sQuery) or die(mysqli_error($connection));
	
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysqli_query($connection, $sQuery) or die(mysqli_error($connection));
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysqli_query($connection, $sQuery) or die(mysqli_error($connection));
	$aResultTotal = mysqli_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	$sr = 1;
	while($aRow = mysqli_fetch_array($rResult))
	{
		$row = array();
		for($i = 0 ; $i < count($aColumns) ; $i++)
		{
			if($aColumns[$i] != ' ')
			{
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode($output);

?>