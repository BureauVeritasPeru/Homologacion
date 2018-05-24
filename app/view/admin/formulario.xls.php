<table>
  <tr>
    <th>Titulo</th>
    <th>Descripcion</th>
    <th>Estado</th>
    <th>Fecha Registro</th>
  </tr>
  <?php 
  $list=CrmFormulario::getList_Paging();
  foreach ($list as $oItem){
    ?>
    <tr>
      <td><?php echo htmlentities($oItem->title, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->description, ENT_QUOTES,"UTF-8"); ?> </td>
      <td><?php echo htmlentities($oItem->state, ENT_QUOTES,"UTF-8"); ?> </td
        <td><?php echo htmlentities($oItem->registerDate, ENT_QUOTES,"UTF-8"); ?> </td>
      </tr>
      <?php } ?>
    </table>

