<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// $fecha = date('Y/m/d H:m:s');
$homologacionID =OWASP::RequestString('homologacionID');


DescargaAnual($homologacionID);

function DescargaAnual($homologacionID){
	$oHomologacion = CrmHomologacion::getItem($homologacionID);
	
	$options = new Options();
	$options->set('isRemoteEnabled', TRUE);
	$options->set('isHtml5ParserEnabled', TRUE);
	$options->set('isJavascriptEnabled', TRUE);
	$dompdf = new Dompdf($options);
	$contxt = stream_context_create([ 
		'ssl' => [ 
			'verify_peer' => FALSE, 
			'verify_peer_name' => FALSE,
			'allow_self_signed'=> TRUE
		] 
	]);

	$dompdf->setHttpContext($contxt);
	
	$dompdf->loadHtmlFile('http://app.bureauveritas.com.pe/scs/homologacion/ajax/prueba.php?homologacionID='.$homologacionID,'UTF-8');
// (Optional) Setup the paper size and orientation
	//
	$dompdf->setPaper('A3','landscape');

// Render the HTML as PDF
	$dompdf->render();
	ob_end_clean();
// Output the generated PDF to Browser
	$dompdf->stream('Informe_General', array("Attachment" => false));
}




//////////////////////////////////////////////////////////////////////////////////////////////
function Response($msg){
	echo json_encode(array('retval'=>'1', 'message'=>$msg));
	exit;
	return;
}

function RaiseError($msg){
	echo json_encode(array('retval'=>'0', 'message'=>$msg));
	exit;
	return;
}
?>