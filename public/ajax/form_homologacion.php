<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$cmd =OWASP::RequestString('cmd');

switch ($cmd) {
    case 'insert':
    RegisterInsert();
    break;
    case 'update':
    RegisterUpdate();
    break;
    case 'finish':
    RegisterFinish();
    break;
    case 'proveedor':
    RegisterProveedor();
    break;
    case 'insert_auditor':
    RegisterInsertAuditor();
    break;
    case 'update_auditor':
    RegisterUpdateAuditor();
    break;
    case 'finish_auditor':
    RegisterFinishAuditor();
    break;
    case 'photo_auditor':
    RegisterPhotoAuditor();
    break;
    default:
    RaiseError('No tiene permisos para estos recursos');
    break;
}


function RegisterInsert(){

    $homologacionID = OWASP::RequestString('homologacionID');

    $oForm = CrmHomologacion::getItemFormulario($homologacionID);

    $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);


    foreach ($oListCheck as $oCheck1) {  
        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmChecklist();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->response1 = OWASP::RequestString('input_'.$value1->checkID.'_1');
            $oCheckHomo->response2 = OWASP::RequestString('input_'.$value1->checkID.'_2');
            $oCheckHomo->response3 = OWASP::RequestString('input_'.$value1->checkID.'_3');
            $oCheckHomo->response4 = OWASP::RequestString('input_'.$value1->checkID.'_4');
            $oCheckHomo->response5 = OWASP::RequestString('input_'.$value1->checkID.'_5');
            CrmCheckHomo::AddNew($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) {
                $oCheckHomo = new eCrmChecklist();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->response1 = OWASP::RequestString('input_'.$value2->checkID.'_1');
                $oCheckHomo->response2 = OWASP::RequestString('input_'.$value2->checkID.'_2');
                $oCheckHomo->response3 = OWASP::RequestString('input_'.$value2->checkID.'_3');
                $oCheckHomo->response4 = OWASP::RequestString('input_'.$value2->checkID.'_4');
                $oCheckHomo->response5 = OWASP::RequestString('input_'.$value2->checkID.'_5');
                CrmCheckHomo::AddNew($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmChecklist();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->response1 = OWASP::RequestString('input_'.$value3->checkID.'_1');
                    $oCheckHomo->response2 = OWASP::RequestString('input_'.$value3->checkID.'_2');
                    $oCheckHomo->response3 = OWASP::RequestString('input_'.$value3->checkID.'_3');
                    $oCheckHomo->response4 = OWASP::RequestString('input_'.$value3->checkID.'_4');
                    $oCheckHomo->response5 = OWASP::RequestString('input_'.$value3->checkID.'_5');
                    CrmCheckHomo::AddNew($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmChecklist();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->response1 = OWASP::RequestString('input_'.$value4->checkID.'_1');
                        $oCheckHomo->response2 = OWASP::RequestString('input_'.$value4->checkID.'_2');
                        $oCheckHomo->response3 = OWASP::RequestString('input_'.$value4->checkID.'_3');
                        $oCheckHomo->response4 = OWASP::RequestString('input_'.$value4->checkID.'_4');
                        $oCheckHomo->response5 = OWASP::RequestString('input_'.$value4->checkID.'_5');
                        CrmCheckHomo::AddNew($oCheckHomo);
                    }
                }
            }
        }
    }
    Response('Data correctamente Guardada');

}

function RegisterUpdate(){

    $homologacionID = OWASP::RequestString('homologacionID');

    $oForm = CrmHomologacion::getItemFormulario($homologacionID);

    $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);

    foreach ($oListCheck as $oCheck1) {  
        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->response1 = OWASP::RequestString('input_'.$value1->checkID.'_1');
            $oCheckHomo->response2 = OWASP::RequestString('input_'.$value1->checkID.'_2');
            $oCheckHomo->response3 = OWASP::RequestString('input_'.$value1->checkID.'_3');
            $oCheckHomo->response4 = OWASP::RequestString('input_'.$value1->checkID.'_4');
            $oCheckHomo->response5 = OWASP::RequestString('input_'.$value1->checkID.'_5');
            CrmCheckHomo::Update($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) {
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->response1 = OWASP::RequestString('input_'.$value2->checkID.'_1');
                $oCheckHomo->response2 = OWASP::RequestString('input_'.$value2->checkID.'_2');
                $oCheckHomo->response3 = OWASP::RequestString('input_'.$value2->checkID.'_3');
                $oCheckHomo->response4 = OWASP::RequestString('input_'.$value2->checkID.'_4');
                $oCheckHomo->response5 = OWASP::RequestString('input_'.$value2->checkID.'_5');
                CrmCheckHomo::Update($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->response1 = OWASP::RequestString('input_'.$value3->checkID.'_1');
                    $oCheckHomo->response2 = OWASP::RequestString('input_'.$value3->checkID.'_2');
                    $oCheckHomo->response3 = OWASP::RequestString('input_'.$value3->checkID.'_3');
                    $oCheckHomo->response4 = OWASP::RequestString('input_'.$value3->checkID.'_4');
                    $oCheckHomo->response5 = OWASP::RequestString('input_'.$value3->checkID.'_5');
                    CrmCheckHomo::Update($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->response1 = OWASP::RequestString('input_'.$value4->checkID.'_1');
                        $oCheckHomo->response2 = OWASP::RequestString('input_'.$value4->checkID.'_2');
                        $oCheckHomo->response3 = OWASP::RequestString('input_'.$value4->checkID.'_3');
                        $oCheckHomo->response4 = OWASP::RequestString('input_'.$value4->checkID.'_4');
                        $oCheckHomo->response5 = OWASP::RequestString('input_'.$value4->checkID.'_5');
                        CrmCheckHomo::Update($oCheckHomo);
                        
                    }
                }
            }
        }
    }
    Response('Data correctamente Actualizada');

}

function RegisterFinish(){

    $homologacionID = OWASP::RequestString('homologacionID');

    $oForm = CrmHomologacion::getItemFormulario($homologacionID);

    $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);


    foreach ($oListCheck as $oCheck1) {  
        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->response1 = OWASP::RequestString('input_'.$value1->checkID.'_1');
            $oCheckHomo->response2 = OWASP::RequestString('input_'.$value1->checkID.'_2');
            $oCheckHomo->response3 = OWASP::RequestString('input_'.$value1->checkID.'_3');
            $oCheckHomo->response4 = OWASP::RequestString('input_'.$value1->checkID.'_4');
            $oCheckHomo->response5 = OWASP::RequestString('input_'.$value1->checkID.'_5');
            CrmCheckHomo::Update($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) {
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->response1 = OWASP::RequestString('input_'.$value2->checkID.'_1');
                $oCheckHomo->response2 = OWASP::RequestString('input_'.$value2->checkID.'_2');
                $oCheckHomo->response3 = OWASP::RequestString('input_'.$value2->checkID.'_3');
                $oCheckHomo->response4 = OWASP::RequestString('input_'.$value2->checkID.'_4');
                $oCheckHomo->response5 = OWASP::RequestString('input_'.$value2->checkID.'_5');
                CrmCheckHomo::Update($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->response1 = OWASP::RequestString('input_'.$value3->checkID.'_1');
                    $oCheckHomo->response2 = OWASP::RequestString('input_'.$value3->checkID.'_2');
                    $oCheckHomo->response3 = OWASP::RequestString('input_'.$value3->checkID.'_3');
                    $oCheckHomo->response4 = OWASP::RequestString('input_'.$value3->checkID.'_4');
                    $oCheckHomo->response5 = OWASP::RequestString('input_'.$value3->checkID.'_5');
                    CrmCheckHomo::Update($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->response1 = OWASP::RequestString('input_'.$value4->checkID.'_1');
                        $oCheckHomo->response2 = OWASP::RequestString('input_'.$value4->checkID.'_2');
                        $oCheckHomo->response3 = OWASP::RequestString('input_'.$value4->checkID.'_3');
                        $oCheckHomo->response4 = OWASP::RequestString('input_'.$value4->checkID.'_4');
                        $oCheckHomo->response5 = OWASP::RequestString('input_'.$value4->checkID.'_5');
                        CrmCheckHomo::Update($oCheckHomo);
                    }
                }
            }
        }
    }
    CrmHomologacion::UpdateState($homologacionID,2);  //actualizar estado
    Email::Send_Finalizacion_Proveedor($homologacionID); //Envio de mail
    Response('Data correctamente Guardada');

}

function RegisterProveedor(){


    $oProveedor = new eCrmProveedor();

    $oProveedor->registration = OWASP::RequestString('registration');
    $oProveedor->testConstitution = OWASP::RequestString('testConstitution');
    $oProveedor->firm = OWASP::RequestString('firm');
    $oProveedor->representation = OWASP::RequestString('representation');
    $oProveedor->licence = OWASP::RequestString('licence');
    $oProveedor->certInspeccion =OWASP::RequestString('certInspeccion');
    $oProveedor->registerMine = OWASP::RequestString('registerMine');
    $oProveedor->proveedorID = OWASP::RequestString('proveedorID');
    if($oProveedor->proveedorID != NULL){
        CrmProveedor::Update3($oProveedor);
    }


    Response('Data correctamente Guardada');

}


function RegisterInsertAuditor(){

    $homologacionID = OWASP::RequestString('homologacionID');

    $oForm = CrmHomologacion::getItemFormulario($homologacionID);

    $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);

    foreach ($oListCheck as $oCheck1) {  
        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->response1 = OWASP::RequestString('input_'.$value1->checkID.'_1');
            $oCheckHomo->response2 = OWASP::RequestString('input_'.$value1->checkID.'_2');
            $oCheckHomo->response3 = OWASP::RequestString('input_'.$value1->checkID.'_3');
            $oCheckHomo->response4 = OWASP::RequestString('input_'.$value1->checkID.'_4');
            $oCheckHomo->response5 = OWASP::RequestString('input_'.$value1->checkID.'_5');
            CrmCheckHomo::Update($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) {
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->response1 = OWASP::RequestString('input_'.$value2->checkID.'_1');
                $oCheckHomo->response2 = OWASP::RequestString('input_'.$value2->checkID.'_2');
                $oCheckHomo->response3 = OWASP::RequestString('input_'.$value2->checkID.'_3');
                $oCheckHomo->response4 = OWASP::RequestString('input_'.$value2->checkID.'_4');
                $oCheckHomo->response5 = OWASP::RequestString('input_'.$value2->checkID.'_5');
                CrmCheckHomo::Update($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->response1 = OWASP::RequestString('input_'.$value3->checkID.'_1');
                    $oCheckHomo->response2 = OWASP::RequestString('input_'.$value3->checkID.'_2');
                    $oCheckHomo->response3 = OWASP::RequestString('input_'.$value3->checkID.'_3');
                    $oCheckHomo->response4 = OWASP::RequestString('input_'.$value3->checkID.'_4');
                    $oCheckHomo->response5 = OWASP::RequestString('input_'.$value3->checkID.'_5');
                    CrmCheckHomo::Update($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->response1 = OWASP::RequestString('input_'.$value4->checkID.'_1');
                        $oCheckHomo->response2 = OWASP::RequestString('input_'.$value4->checkID.'_2');
                        $oCheckHomo->response3 = OWASP::RequestString('input_'.$value4->checkID.'_3');
                        $oCheckHomo->response4 = OWASP::RequestString('input_'.$value4->checkID.'_4');
                        $oCheckHomo->response5 = OWASP::RequestString('input_'.$value4->checkID.'_5');
                        CrmCheckHomo::Update($oCheckHomo);
                        
                    }
                }
            }
        }
    }

    foreach ($oListCheck as $oCheck1) {  
        $oGeneralHomo = new eCrmGeneralHomo();
        $oGeneralHomo->homologacionID = $homologacionID;
        $oGeneralHomo->checkID = $oCheck1->checkID;
        $oGeneralHomo->scoreAcu = OWASP::RequestString('pointTotal_'.$oCheck1->checkID);
        $oGeneralHomo->scoreRes = OWASP::RequestString('pointResult_'.$oCheck1->checkID);
        $oGeneralHomo->observation = OWASP::RequestString('observation_'.$oCheck1->checkID);

        CrmGeneralHomo::AddNew($oGeneralHomo);

        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->score = OWASP::RequestString('score_resp'.$value1->checkID);
            CrmCheckHomo::Update2($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) {
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->score = OWASP::RequestString('score_resp'.$value2->checkID);
                CrmCheckHomo::Update2($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->score = OWASP::RequestString('score_resp'.$value3->checkID);
                    CrmCheckHomo::Update2($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->score = OWASP::RequestString('score_resp'.$value4->checkID);
                        CrmCheckHomo::Update2($oCheckHomo);
                    }
                }
            }
        }
    }
    Response('Data correctamente Actualizada');

}

function RegisterUpdateAuditor(){

    $homologacionID = OWASP::RequestString('homologacionID');

    $oForm = CrmHomologacion::getItemFormulario($homologacionID);

    $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);

    foreach ($oListCheck as $oCheck1) {  
        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->response1 = OWASP::RequestString('input_'.$value1->checkID.'_1');
            $oCheckHomo->response2 = OWASP::RequestString('input_'.$value1->checkID.'_2');
            $oCheckHomo->response3 = OWASP::RequestString('input_'.$value1->checkID.'_3');
            $oCheckHomo->response4 = OWASP::RequestString('input_'.$value1->checkID.'_4');
            $oCheckHomo->response5 = OWASP::RequestString('input_'.$value1->checkID.'_5');
            CrmCheckHomo::Update($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) {
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->response1 = OWASP::RequestString('input_'.$value2->checkID.'_1');
                $oCheckHomo->response2 = OWASP::RequestString('input_'.$value2->checkID.'_2');
                $oCheckHomo->response3 = OWASP::RequestString('input_'.$value2->checkID.'_3');
                $oCheckHomo->response4 = OWASP::RequestString('input_'.$value2->checkID.'_4');
                $oCheckHomo->response5 = OWASP::RequestString('input_'.$value2->checkID.'_5');
                CrmCheckHomo::Update($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->response1 = OWASP::RequestString('input_'.$value3->checkID.'_1');
                    $oCheckHomo->response2 = OWASP::RequestString('input_'.$value3->checkID.'_2');
                    $oCheckHomo->response3 = OWASP::RequestString('input_'.$value3->checkID.'_3');
                    $oCheckHomo->response4 = OWASP::RequestString('input_'.$value3->checkID.'_4');
                    $oCheckHomo->response5 = OWASP::RequestString('input_'.$value3->checkID.'_5');
                    CrmCheckHomo::Update($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->response1 = OWASP::RequestString('input_'.$value4->checkID.'_1');
                        $oCheckHomo->response2 = OWASP::RequestString('input_'.$value4->checkID.'_2');
                        $oCheckHomo->response3 = OWASP::RequestString('input_'.$value4->checkID.'_3');
                        $oCheckHomo->response4 = OWASP::RequestString('input_'.$value4->checkID.'_4');
                        $oCheckHomo->response5 = OWASP::RequestString('input_'.$value4->checkID.'_5');
                        CrmCheckHomo::Update($oCheckHomo);
                        
                    }
                }
            }
        }
    }

    foreach ($oListCheck as $oCheck1) {  
        $oGeneralHomo = new eCrmGeneralHomo();
        $oGeneralHomo->homologacionID = $homologacionID;
        $oGeneralHomo->checkID = $oCheck1->checkID;
        $oGeneralHomo->scoreAcu = OWASP::RequestString('pointTotal_'.$oCheck1->checkID);
        $oGeneralHomo->scoreRes = OWASP::RequestString('pointResult_'.$oCheck1->checkID);
        $oGeneralHomo->observation = OWASP::RequestString('observation_'.$oCheck1->checkID);

        CrmGeneralHomo::Update($oGeneralHomo);

        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->score = OWASP::RequestString('score_resp'.$value1->checkID);
            CrmCheckHomo::Update2($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) { 
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->score = OWASP::RequestString('score_resp'.$value2->checkID);
                CrmCheckHomo::Update2($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->score = OWASP::RequestString('score_resp'.$value3->checkID);
                    CrmCheckHomo::Update2($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->score = OWASP::RequestString('score_resp'.$value4->checkID);
                        CrmCheckHomo::Update2($oCheckHomo);
                    }
                }
            }
        }
    }
    Response('Data correctamente Actualizada');

}

function RegisterFinishAuditor(){

    $homologacionID = OWASP::RequestString('homologacionID');

    $oForm = CrmHomologacion::getItemFormulario($homologacionID);

    $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);

    foreach ($oListCheck as $oCheck1) {  
        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->response1 = OWASP::RequestString('input_'.$value1->checkID.'_1');
            $oCheckHomo->response2 = OWASP::RequestString('input_'.$value1->checkID.'_2');
            $oCheckHomo->response3 = OWASP::RequestString('input_'.$value1->checkID.'_3');
            $oCheckHomo->response4 = OWASP::RequestString('input_'.$value1->checkID.'_4');
            $oCheckHomo->response5 = OWASP::RequestString('input_'.$value1->checkID.'_5');
            CrmCheckHomo::Update($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) {
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->response1 = OWASP::RequestString('input_'.$value2->checkID.'_1');
                $oCheckHomo->response2 = OWASP::RequestString('input_'.$value2->checkID.'_2');
                $oCheckHomo->response3 = OWASP::RequestString('input_'.$value2->checkID.'_3');
                $oCheckHomo->response4 = OWASP::RequestString('input_'.$value2->checkID.'_4');
                $oCheckHomo->response5 = OWASP::RequestString('input_'.$value2->checkID.'_5');
                CrmCheckHomo::Update($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->response1 = OWASP::RequestString('input_'.$value3->checkID.'_1');
                    $oCheckHomo->response2 = OWASP::RequestString('input_'.$value3->checkID.'_2');
                    $oCheckHomo->response3 = OWASP::RequestString('input_'.$value3->checkID.'_3');
                    $oCheckHomo->response4 = OWASP::RequestString('input_'.$value3->checkID.'_4');
                    $oCheckHomo->response5 = OWASP::RequestString('input_'.$value3->checkID.'_5');
                    CrmCheckHomo::Update($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->response1 = OWASP::RequestString('input_'.$value4->checkID.'_1');
                        $oCheckHomo->response2 = OWASP::RequestString('input_'.$value4->checkID.'_2');
                        $oCheckHomo->response3 = OWASP::RequestString('input_'.$value4->checkID.'_3');
                        $oCheckHomo->response4 = OWASP::RequestString('input_'.$value4->checkID.'_4');
                        $oCheckHomo->response5 = OWASP::RequestString('input_'.$value4->checkID.'_5');
                        CrmCheckHomo::Update($oCheckHomo);
                        
                    }
                }
            }
        }
    }

    foreach ($oListCheck as $oCheck1) {  
        $oGeneralHomo = new eCrmGeneralHomo();
        $oGeneralHomo->homologacionID = $homologacionID;
        $oGeneralHomo->checkID = $oCheck1->checkID;
        $oGeneralHomo->scoreAcu = OWASP::RequestString('pointTotal_'.$oCheck1->checkID);
        $oGeneralHomo->scoreRes = OWASP::RequestString('pointResult_'.$oCheck1->checkID);
        $oGeneralHomo->observation = OWASP::RequestString('observation_'.$oCheck1->checkID);

        CrmGeneralHomo::Update($oGeneralHomo);

        $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID);
        foreach ($oListPreCheck as $value1){ 
            $oCheckHomo = new eCrmCheckHomo();
            $oCheckHomo->checkID = $value1->checkID;
            $oCheckHomo->homologacionID = $homologacionID;
            $oCheckHomo->score = OWASP::RequestString('score_resp'.$value1->checkID);
            CrmCheckHomo::Update2($oCheckHomo);
            $oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
            foreach ($oListPreCheck2 as $value2) { 
                $oCheckHomo = new eCrmCheckHomo();
                $oCheckHomo->checkID = $value2->checkID;
                $oCheckHomo->homologacionID = $homologacionID;
                $oCheckHomo->score = OWASP::RequestString('score_resp'.$value2->checkID);
                CrmCheckHomo::Update2($oCheckHomo);
                $oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
                foreach ($oListPreCheck3 as $value3) {
                    $oCheckHomo = new eCrmCheckHomo();
                    $oCheckHomo->checkID = $value3->checkID;
                    $oCheckHomo->homologacionID = $homologacionID;
                    $oCheckHomo->score = OWASP::RequestString('score_resp'.$value3->checkID);
                    CrmCheckHomo::Update2($oCheckHomo);
                    $oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
                    foreach ($oListPreCheck4 as $value4) {
                        $oCheckHomo = new eCrmCheckHomo();
                        $oCheckHomo->checkID = $value4->checkID;
                        $oCheckHomo->homologacionID = $homologacionID;
                        $oCheckHomo->score = OWASP::RequestString('score_resp'.$value4->checkID);
                        CrmCheckHomo::Update2($oCheckHomo);
                    }
                }
            }
        }
    }

    $oHomologacion = CrmHomologacion::getItem($homologacionID);
    $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID);
    $oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); 
    $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); 
    $varAcu = 0; $varResul = 0;$nota='Sin Calificación';
    $oList = CrmGeneralHomo::getListxHomologacion($homologacionID);
    foreach ($oList as $value) {
        $varAcu = $varAcu + $value->scoreAcu;
        $varResul = $varResul + $value->scoreRes;
    }
    $porc = number_format((float)($varResul / $varAcu) * 100, 2, '.', '');
    $lNivel = CrmNivelCliente::getListByCliente($oPropuesta->clienteID);
    foreach ($lNivel as $value) {
        if($value->minimo <= $porc  && $value->maximo >= $porc){ $nota = $value->nivel; }
    }

    CrmHomologacion::UpdateResultados($homologacionID,$porc,$nota);
    CrmHomologacion::UpdateState($homologacionID,4);  //actualizar estado
    Email::Send_Finalizacion_Auditor($homologacionID);
    
    Response('Data correctamente Actualizada');

}

function RegisterPhotoAuditor(){

    $homologacionID = OWASP::RequestString('homologacionPhotoID');

    $oPhotoHomo = new eCrmPhotoHomo();

    $oPhotoHomo->homologacionID = $homologacionID;
    $oPhotoHomo->photo1 = OWASP::RequestString('photo1');
    $oPhotoHomo->description1 = OWASP::RequestString('description1');
    $oPhotoHomo->photo2 = OWASP::RequestString('photo2');
    $oPhotoHomo->description2 = OWASP::RequestString('description2');
    $oPhotoHomo->photo3 = OWASP::RequestString('photo3');
    $oPhotoHomo->description3 = OWASP::RequestString('description3');
    $oPhotoHomo->photo4 = OWASP::RequestString('photo4');
    $oPhotoHomo->description4 = OWASP::RequestString('description4');
    $oPhotoHomo->photo5 = OWASP::RequestString('photo5');
    $oPhotoHomo->description5 = OWASP::RequestString('description5');
    $oPhotoHomo->photo6 = OWASP::RequestString('photo6');
    $oPhotoHomo->description6 = OWASP::RequestString('description6');
    $oPhotoHomo->photo7 = OWASP::RequestString('photo7');
    $oPhotoHomo->description7 = OWASP::RequestString('description7');
    $oPhotoHomo->photo8 = OWASP::RequestString('photo8');
    $oPhotoHomo->description8 = OWASP::RequestString('description8');

    CrmPhotoHomo::AddNew($oPhotoHomo);

    Response('Data correctamente Actualizada');

}

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