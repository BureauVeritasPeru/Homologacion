<?php
$userAdmin=AdmLogin::getUserSession();
?>
<div class="sidebar-header d-flex align-items-center">
	<div class="avatar"><img src="<?php echo $URL_BASE;?>dist/img/user.jpg" alt="User Image" class="img-fluid rounded-circle"></div>
	<div class="title">
		<h1 class="h4"><?php echo strtolower($userAdmin->fullName);?></h1>
		<p>Online</p>
	</div>
</div>
<ul class="list-unstyled">
	<li> <a href="./"><i class="icon-home"></i>Home</a></li>
</ul>
<?php
$lMenu=AdmMenu::getList_ParentMenu(0, $userAdmin->userMenu );
foreach($lMenu as $oMenu){
	$menuID=$oMenu->menuID;
	$menuName=$oMenu->menuName;
	$lSMenu=AdmMenu::getList_ParentMenu($menuID, $userAdmin->userMenu );
	if($lSMenu->getLength()==0) continue;
	?>
	<span class="heading"><?php echo strtoupper($menuName) ?></span>
	<ul class="list-unstyled">
		<?php
		foreach($lSMenu as $oSMenu){
			$submenuID=$oSMenu->menuID;
			$menuName =$oSMenu->menuName;
			$lModulo=AdmModule::getList_UserModule($submenuID, $userAdmin->userModule );
			if($lModulo->getLength()==0) continue;
			?>
			<li class="<?php echo ($MODULE->menuID==$submenuID)?"active":""; ?>">
				<a href="#valor<?php echo $oSMenu->menuID; ?>" aria-expanded="<?php echo ($MODULE->menuID==$submenuID)?"true":"false"; ?>" data-toggle="collapse">
					<i class="fa <?php echo $oSMenu->menuIcon;?>"></i><?php echo $menuName;?>
				</a>
				<ul class="<?php echo ($MODULE->menuID==$submenuID)?"list-unstyled collapse show":"collapse list-unstyled"; ?>" id="valor<?php echo $oSMenu->menuID; ?>">
					<?php
					foreach($lModulo as $oModule){
						$moduleID=$oModule->moduleID;
						$moduleName=$oModule->moduleName;
						$moduleURL =$URL_ADMIN."?moduleID=$moduleID".($oModule->moduleParams!="" ? ("&".$oModule->moduleParams) : "");

						?>
						<li class="<?php echo ($MODULE->moduleID==$oModule->moduleID)?"active":""; ?>"><a href="<?php echo $moduleURL;?>"><i class="fa <?php echo ($oModule->moduleIcon=='')?"fa-list":$oModule->moduleIcon; ?>"></i> <?php echo $moduleName; ?></a></li>
						<?php
					}
					?>
				</ul>
			</li>
			<?php
		}
		?>
	</ul>
	<?php
}
?>