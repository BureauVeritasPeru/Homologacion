<?php
$sectionID=3;
$langID=$PAGE->langID;
$parentContentID=0; //root
$lPie=CmsContentLang::getWebList($parentContentID, $sectionID, $langID);

?>
<?php if (WebLogin::isLoggedCliente() || WebLogin::isLoggedProveedor() || WebLogin::isLoggedAdmin()){ ?>
    <footer>
        <hr>
        <div class="container">
            <div class="row pie">
                <div class="col-md-8">
                    <span class="copyright">©2018 Homologación de Proveedores - Bureau Veritas Perú</span>
                </div>

                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li>Developed : Bureau Veritas - IT Perú
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <?php } ?>