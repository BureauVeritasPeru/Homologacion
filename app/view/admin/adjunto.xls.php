<table>
  <tr>
    <th>Tipo</th>
    <th>Descripcion</th>
    <th>Codigo</th>
    <th>FechaRegistro</th>
    <th>Estado</th>
  </tr>
  <?php 
  $list=CrmAdjunto::getList_Paging();
  foreach ($list as $oItem){
    $var= CmsParameterLang::getItem($oItem->typeFile, 1);
    ?>
    <tr>
      <td><?php echo $var; ?></td>
      <td><?php echo htmlentities($oItem->descriptionFile, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo $oItem->codeFile; ?></td>
      <td><?php echo $oItem->registerDate; ?></td>
      <td><?php echo CrmAdjunto::getState($oItem->state);?></td>
    </tr>
    <?php } ?>
  </table>
