<style type="text/css">
table{
  border-collapse: collapse;
}
td,tr{
  border: 1px solid #fff;
}
</style>
<table>
  <tr>
    <th width="60">homologacionID</th>
    <th width="60">period</th>
    <th width="60">clienteID</th>
    <th width="60">proveedorID</th>
    <th width="60">ruc</th>
    <th width="60">telefono</th>
    <th width="60">correo</th>
    <th width="60">registerDate</th>
    <th width="120">userID</th>
    <th width="120">programDate</th>
    <th width="60">state</th>
  </tr>
  <?php 
  $list=CrmHomologacion::getList_Paging(); foreach ($list as $oItem) {  $oRequerimiento = CrmRequerimiento::GetItem($oItem->requerimientoID); if(isset($oItem->userID)){$oUser = AdmUser::getItem($oItem->userID);
    $oProveedor = CrmProveedor::GetItem($oRequerimiento->proveedorID); $oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);  
  }  ?>
  <tr> 
    <td><?php echo $oItem->homologacionID; ?></td>
    <td><?php echo $oRequerimiento->period; ?></td>
    <td><?php echo htmlentities($oCliente->businessName, ENT_QUOTES, "UTF-8"); ?></td>
    <td><?php echo htmlentities($oProveedor->businessName, ENT_QUOTES, "UTF-8"); ?></td>
    <td><?php echo htmlentities($oProveedor->documentNumber, ENT_QUOTES, "UTF-8"); ?></td>
    <td><?php echo htmlentities($oProveedor->phone, ENT_QUOTES, "UTF-8"); ?></td>
    <td><?php echo htmlentities($oProveedor->email, ENT_QUOTES, "UTF-8"); ?></td>
    <td><?php echo $oItem->registerDate; ?></td>
    <td><?php if(isset($oItem->userID)){echo htmlentities($oUser->firstName.' '.$oUser->lastName, ENT_QUOTES, "UTF-8");} ?></td>
    <td><?php echo htmlentities($oItem->programDate.' '.$oItem->hourDate.' - '.$oItem->hourEndDate, ENT_QUOTES, "UTF-8"); ?></td>
    <td align="center"><?php echo CrmHomologacion::getState($oItem->state);?></td>
  </tr>
  <?php } ?>
</table>
