<?php
$langID		=1;
$lMenuUser 	 =CmsSectionLang::getWebList(1, $langID); //parentSectionID=4 Secciones Principales
?>
<!-- lista de la seccion pagina principal -->

<?php
if(isset($oCliente) || isset($oProveedor)){
	$count = 0;
	foreach($lMenuUser as $oRegistro){
		$count++;
		$menu_activo=isset($oSectionLang) && $oRegistro->sectionID==$oSectionLang->sectionID ? 'active' : null;
		$oLink=new eLink();
		$oLink->url =SEO::get_URLSection($oRegistro);
		?>
		<li class="nav-item <?php echo $menu_activo; ?>"><a class="nav-link" href="<?php echo $oLink->url; ?>"><?php echo $oRegistro->title; ?></a></li>
		<?php  
	} 
} ?>


