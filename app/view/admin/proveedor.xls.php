<table>
  <tr>
    <th width="120">Numero de Documento</th>
    <th width="120">Razon Social</th>
    <th width="120">Dirección</th>
    <th width="60">Estado</th>
  </tr>
  <?php 
  $list=CrmProveedor::getList_Paging();
  foreach ($list as $oItem){
    ?>
    <tr>
      <td><?php echo $oItem->documentNumber; ?></td>
      <td><?php echo $oItem->businessName; ?></td>
      <td><?php echo htmlentities($oItem->address, ENT_QUOTES, "UTF-8"); ?></td>
      <td align="center"><?php echo CrmProveedor::getState($oItem->state);?></td>
    </tr>
    <?php } ?>
  </table>

