<style type="text/css">

body {
    padding-top: 4rem;
    background-color: #d0d0b6;
}
.starter-template {
    padding: 3rem 1.5rem;
    text-align: center;
}
.btn-outline-success {
    color: #dc3545;
    background-color: transparent;
    background-image: none;
    border-color: #dc3545;
}
.btn-outline-success:hover {
    color: #fff;
    background-color: #d1d0b5;
    border-color: #d1d0b5;
}
footer{
    bottom: 0;
    position: fixed;
    width: 100%;
    color:#ffecc8;
    background-color: #343a40;
}
hr{
    border-color: #ffecc8;
}
</style>

<?php
$file_view ='../app/view/website/' . $PAGE->getFormView() ;
if( file_exists( $file_view ) )
    include $file_view ;
else
    $PAGE->addError("No se puede cargar el archivo => ".$file_view) ;
?>

