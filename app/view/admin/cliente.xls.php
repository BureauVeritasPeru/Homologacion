<table>
  <tr>
    <th>RUC</th>
    <th>Raz&oacute;n Social</th>
    <th>Direcci&oacute;n</th>
    <th>Departamento</th>
    <th>Provincia</th>
    <th>Distrito</th>
    <th>Tel&eacute;fono</th>
    <th>Email</th>
    <th>Fax</th>
    <th>Sectorista</th>
    <th>Observaci&oacute;n</th>
    <th>Fecha Registro</th>
  </tr>
  <?php 
  $list=CrmCliente::getList_Paging();
  foreach ($list as $oItem){
    ?>
    <tr>
      <td><?php echo htmlentities($oItem->ruc, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->businessName, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->address, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->department, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->province, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->district, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->phone, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->email, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->fax, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->sectorist, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->observation, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->registerDate, ENT_QUOTES,"UTF-8"); ?> </td>
    </tr>
    <?php } ?>
  </table>

