<?php
//Home Values
$sectionID=1;
$langID=$PAGE->langID;

$parentContentID=0; //root
$lHome=CmsContentLang::getWebList($parentContentID, $sectionID, $langID);
?>

<?php 
if (WebLogin::isLoggedCliente()){ 
	include("../app/view/website/home/cliente.php"); 
}else if(WebLogin::isLoggedProveedor()){
	include("../app/view/website/home/principal.php"); 
}else if(WebLogin::isLoggedAdmin()){
	include("../app/view/website/home/cliente.php"); 
}else{ 
	include("../app/view/website/home/home.php");
} 
?>
