<table>
  <tr>
    <th>Descripcion</th>
    <th>FechaRegistro</th>
    <th>Estado</th>
  </tr>
  <?php 
  $list=CrmServicio::getList_Paging();
  foreach ($list as $oItem){
    ?>
    <tr>
      <td><?php echo htmlentities($oItem->description, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo $oItem->registerDate; ?></td>
      <td><?php echo CrmServicio::getState($oItem->state);?></td>
    </tr>
    <?php } ?>
  </table>
