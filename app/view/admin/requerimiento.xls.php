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
    <th>ID</th>
    <th>Periodo</th>
    <th>Fecha Registro</th>
    <th>Cliente</th>
    <th>Proveedor</th>
    <th>PER</th>
    <th>Direccion</th>
    <th>Monto Abonado / Monto Solicitado</th>
    <th>Estado</th>
  </tr>
  <?php 
  $list=CrmRequerimiento::getList_Paging(); 
  foreach ($list as $oItem) {  $oProveedor = CrmProveedor::GetItem($oItem->proveedorID); $oPropxform = CrmPropxForm::getItem($oItem->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);   ?>
    <tr> 
      <td><?php echo $oItem->requerimientoID; ?></td>
      <td><?php echo $oItem->period; ?></td>
      <td><?php echo $oItem->registerDate; ?></td>
      <td><?php echo htmlentities($oCliente->businessName, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlentities($oProveedor->businessName, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlentities($oPropuesta->proposalNumber, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlentities($oProveedor->address, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlentities($oItem->amount.'  /  '.$oPropxform->amount, ENT_QUOTES, "UTF-8"); ?></td>
      <td align="center"><?php echo CrmRequerimiento::getState($oItem->state);?></td>
    </tr>
    <?php } ?>
  </table>
