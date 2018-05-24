<style>
table {
    border-collapse: collapse;
}
tr{
    text-align: center;
    font-size: 14px;
}
.bord{
    border : 1px solid #000;

}
.light_green{
    background-color: #00d9e2;
    border : 3px solid #000;
}


.soft{
    border-left : 1px solid #000;
    border-right : 1px solid #000;
    border-top : 1px solid #000;
}
.pendiente{
    background-color: #c6e0b4;
    border-left : 1px solid #000;
    border-right : 1px solid #000;
    border-top : 1px solid #000;
}

.pendientedash{
    background-color: #c6e0b4;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-top:3px dashed #000;

}
.softdash{
    border-top:3px dashed #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
}
.softfinal{
    border-top:1px solid #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}
.softfinaldash{
    border-top:1px dashed #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}

.pendientefinal{
    background-color: #c6e0b4;
    border-top:1px solid #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}
.pendientefinaldash{
    background-color: #c6e0b4;
    border-top:1px dashed #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}

</style>

<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

// file name for download

$fileName = "reporte_general_" . date('Ymd') . ".xls";

function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$valor =OWASP::RequestString('homologacionID');


// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>

    <?php  
    $a = explode(',',$valor);  
    $count=0;
    foreach ($a as $ID){ 
        if($ID != ''){ 
            $oHomologacion = CrmHomologacion::getItem($ID); 
            $oForm = CrmHomologacion::getItemFormulario($ID); 
            $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);
            foreach ($oListCheck as $oCheck1) {
                $count++;
                if($count == 1 ){ $var = $oCheck1->title; }else{$var .= ','.$oCheck1->title;}
                
            }
        }
    }
    $count2 = 0;$valor2='';
    $valor1 = explode(',',$var);
    foreach ($valor1 as $index) {
        $count2++;
        if($count2 == 1 ){
            $valor2 = $index;
        }else{
            if(strpos($valor2,$index) === false){
                $valor2 .= ','.$index;
            }
        }

    }
    $conteoCat = explode(',',$valor2);
    ?>
    <tr>
        <th class="light_green" rowspan="2">Nro Homologacion</th>
        <th class="light_green" rowspan="2">Proveedor</th>
        <th class="light_green" colspan="<?php echo count($conteoCat); ?>" >Categoria</th>
        <th class="light_green" rowspan="2">Nivel</th>
        <th class="light_green" rowspan="2">TOTAL</th>
    </tr>
    <tr><?php foreach ($conteoCat as $value) { echo '<th class="light_green">'.htmlentities(mb_strtoupper($value,'UTF-8'), ENT_QUOTES, "UTF-8").'</th>'; } ?></tr>
    <?php  $a = explode(',',$valor);  foreach ($a as $ID){ if($ID != ''){ $oHomologacion = CrmHomologacion::getItem($ID); $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); $oProveedor = CrmProveedor::getItem($oRequerimiento->proveedorID); $oListHomologacion = CrmGeneralHomo::getListxHomologacion($ID); $oForm = CrmHomologacion::getItemFormulario($ID); $oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);$oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID);$oCliente = CrmCliente::getItem($oPropuesta->clienteID);
        $count=0;
        foreach ($oListCheck as $oCheck1) {
            $count++;
            if($count == 1 ){ $var = $oCheck1->title; }
            $var .= ','.$oCheck1->title;
        }

        ?>
        <tr>
            <td class="bord">&nbsp;<?php echo $ID; ?> </td>
            <td class="bord"><?php echo $oProveedor->businessName; ?> </td>

            <?php 
            foreach ($conteoCat as $value) { 
                $var = '';
                foreach($oListHomologacion as $oItem){
                    $oCheck = CrmChecklist::getItem($oItem->checkID);
                    if($value == $oCheck->title){
                        $var='1';
                        if($oItem->scoreRes != 0){ 
                            echo '<td class="bord">'.(($oItem->scoreRes / $oItem->scoreAcu) * 100 ).'%</td>'; 
                        }else{
                            echo '<td class="bord">0%</td>'; 
                        }
                    }
                }
                if($var != '1'){echo '<td class="bord"> - </td>';}
            } ?>       
            <?php $lNivelCliente = CrmNivelCliente::getListByCliente($oCliente->clienteID); ?>
            <?php foreach ($lNivelCliente as $value) { if($value->minimo <= $oHomologacion->puntajeFinal  && $value->maximo >= $oHomologacion->puntajeFinal){  ?>
            <?php if($value->state != 1){ ?>
            <td class="bord" style="background-color:red;color:#fff;"><?php echo  $oHomologacion->nivel; ?></td>
            <?php }else{ ?>
            <td class="bord" style="background-color:green;color:#fff;"><?php echo  $oHomologacion->nivel; ?></td>
            <?php } ?>
            <?php }} ?>
            <td class="bord"><?php  echo $oHomologacion->puntajeFinal; ?>%</td>
        </tr>
        <?php }} ?>
    </table>
    <?php exit();?>