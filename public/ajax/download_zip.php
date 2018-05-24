<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegHomologacion = new eCrmHomologacion();
$oRegHomologacion->homologacionID = OWASP::RequestString('homologacionID');


if($oRegHomologacion->homologacionID!=NULL){
	RegisterForm($oRegHomologacion);
}

function RegisterForm($oRegHomologacion){

	$olistAdjunto = CrmAdjHomo::getListxHomologacion($oRegHomologacion->homologacionID);
	$files = array();
	foreach ($olistAdjunto as $value) {
		$files[] = 'http://10.29.28.7/homologacion/cms/adjunto/documento/'.$value->fileAdj;
	}

# create new zip object
	$zip = new ZipArchive();

# create a temp file & open it
	$tmp_file = tempnam('.', '');
	$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
	foreach ($files as $file) {
    # download file
		$download_file = file_get_contents($file);

    #add it to the zip
		$zip->addFromString(basename($file), $download_file);
	}

# close zip
	$zip->close();

# send the file to the browser as a download
	header('Content-disposition: attachment; filename="FileZip_'.$oRegHomologacion->homologacionID.'_'.date('Ymd').'.zip"');
	header('Content-type: application/zip');
	readfile($tmp_file);
	unlink($tmp_file);


}


?>