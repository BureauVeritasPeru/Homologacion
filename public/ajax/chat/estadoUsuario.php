<?php
session_start();
require_once("../../../config/main.php");
require_once("../../../app/include/admin/header_ajax.php");
$oAdmin = AdmUser::getItem(1);
if($oAdmin->online == 1){
	echo "true";
}else{
	echo "false";
}
?>