<?php
$parentMenu=AdmMenu::getItem($MODULE->parentMenuID);
$menu=AdmMenu::getItem($MODULE->menuID);
if($MODULE->moduleName != 'Inicio'){ ?>
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?php echo $MODULE->moduleName;?></h2>
    </div>
</header>
<!-- Breadcrumb-->
<ul class="breadcrumb">
    <div class="container-fluid">
        <li class="breadcrumb-item"><a href="<?php echo $URL_ADMIN?>">Home</a></li>
        <li class="breadcrumb-item active"><?php
        echo $parentMenu->menuName;
        ?></li>
    </div>
</ul>
<?php }else{ ?>
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Homologación - Bureau Veritas</h2>
    </div>
</header>


<?php } ?>