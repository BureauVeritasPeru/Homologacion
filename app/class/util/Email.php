<?php
require_once("../../app/class/util/phpmailer/class.phpmailer.php");

class Email{
    public static $ErrorMessage;

    public static function getTemplate($template, $replacement){
        $content = file_get_contents("../../app/view/mail/template/".$template);

        while(list($key, $val) = each($replacement)){
            //echo "<li>$key - $val</li>";
            $content=str_replace($key, $val, $content);
        }
        return $content;
    }

    public static function setBody($asunto, $mensaje){
        global $WEBSITE;
        $body = self::getTemplate("default.html", array(
            "@@ASUNTO@@"=>$asunto,
            "@@MENSAJE@@"=>$mensaje,
            "@@URL_HTTP@@"=>SEO::Get_HTTPSite()));

        return $body;
    }

    public static function Send_Proveedor_Requerimiento($name_to, $mail_to,$nro_requerimiento,$ruc){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(2);

        $oRequerimiento = CrmRequerimiento::getItem($nro_requerimiento); 
        $oProveedor = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor: '.$name_to.','."</p>";
        $mensaje.= '<br><p style="font-size:14px;">Un gusto saludarlo.</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify;">Mediante la presente queremos comunicarle que nuestro cliente <strong>'.$oCliente->businessName.'</strong> nos ha encargado realizar la Homologación de sus principales proveedores conforme a sus políticas corporativas, siendo un requerimiento obligatorio de su sistema de gestión de calidad.</p>';
        $mensaje.= '<p style="font-size:14px;text-align:justify;">BUREAU VERITAS es líder mundial en Servicios de Evaluación de Conformidad y Certificación, y cuenta con más de 180 años de experiencia y expertise. A través de nuestra red global, aseguramos a nuestros clientes la generación de valor de sus activos y productos, infraestructura y procesos mediante la reducción de riesgos relacionados a la calidad, medio ambiente, seguridad, salud ocupacional y requerimientos de responsabilidad social.</p>';
        $mensaje.= '<p style="font-size:14px;text-align:justify;"> La Homologación de proveedores, es un proceso beneficioso para su empresa, debido a que la homologación se sitúa dentro de un sistema de mejora continua, como herramienta que permitirá evaluar la situación actual de su empresa. Además, de aprobar el proceso, se le otorgaría un certificado de homologación y el uso del logo corporativo de "EMPRESA HOMOLOGADA" por parte de nosotros, una empresa con respaldo internacional, por el periodo de vigencia de su homologación.</p>'; 
        $mensaje.= '<p style="font-size:14px;text-align:justify;">Para mayor información darle <a href="http://app.bureauveritas.com.pe/scs/homologacion/userfiles/form/'.$oCliente->ruc.'/'.$oCliente->ruc.'.rar">clic aqui</a>.</p>';


        $mensaje.= '<p style="font-size:14px;text-align:justify">En caso de participar, tomar en cuenta la siguiente información para la inscripción del proceso de homologación. (Información Requerida para la inscripción del proceso)</p>';
        
        $mensaje.= '<p style="font-size:14px;text-align:justify;text-decoration:underline;">Información Requerida</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify">RUC : '.$ruc."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Nro Requerimiento : '.$nro_requerimiento."</p><br>";

        $mensaje.= '<p style="font-size:14px !important;text-align:justify">'.$oEmail->message.'</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';        

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $mail_to, $asunto, $body,$oEmail->desde);
    }


    public static function Send_Aprobacion_Requerimiento($nro_requerimiento){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(3);

        $oRequerimiento = CrmRequerimiento::getItem($nro_requerimiento); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor '.$oProveedor->businessName.','."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Por medio del presente, le damos la bienvenida a nuestro <strong>Sistema de Gestión de Proveedores</strong>, el cual le permite registrar su servicio de homologación. Para acceder al sistema deberá ingresar al siguiente enlace: <a href="http://app.bureauveritas.com.pe/scs/homologacion/" target="_blank">http://app.bureauveritas.com.pe/scs/homologacion/</a> y digitar el usuario  y contraseña.</p>';
        
        $mensaje.= '<p style="font-size:14px;text-align:justify">USUARIO : '.$oProveedor->user."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">CONTRASEÑA : '.$oProveedor->pass."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }


    public static function Send_Finalizacion_Proveedor($homologacionID){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(4);
        $oHomologacion  = CrmHomologacion::getItem($homologacionID);
        $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor '.$oProveedor->businessName.','."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Muchas gracias por haber finalizado el registro de la auditoria. En el proceso de los dias se estaran comunicando con usted para la programacion de la auditoria.</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_programacion_proveedor($homologacionID){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(5);
        $oHomologacion  = CrmHomologacion::getItem($homologacionID);
        $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);
        $oAdmUser       = AdmUser::getItem($oHomologacion->userID); 

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor '.$oProveedor->businessName.','."</p>";
        $mensaje.= '<p style="font-size:14px;">Su fecha de visita técnica ha sido comunicada.</p><br>';

        $mensaje.= '<p style="font-size:14px;">Fecha:'.$oHomologacion->programDate.'</p>'; 
        $mensaje.= '<p style="font-size:14px;">Hora:'.$oHomologacion->hourDate.'-'.$oHomologacion->hourEndDate.'</p>'; 
        $mensaje.= '<p style="font-size:14px;">Auditor:'.$oAdmUser->firstName.' '.$oAdmUser->lastName.'</p>'; 

        $mensaje.= '<p style="font-size:14px;">Asimismo deberán completar y enviar los siguientes datos para confirmar su visita:</p><br>'; 

        $mensaje.= '<table><tr style="border:1px solid #000;border-collapse: collapse;"><td>Razón Social:</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr><tr style="border:1px solid #000;border-collapse: collapse;"><td>Persona(s) a cargo para la visita técnica:</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr><tr style="border:1px solid #000;border-collapse: collapse;"><td>Teléfono fijo y anexo:</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr><tr style="border:1px solid #000;border-collapse: collapse;"><td>Celular:</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr><tr style="border:1px solid #000;border-collapse: collapse;"><td>Mail:</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Dirección de evaluación y referencias:</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>';  
        $mensaje.= '<p style="font-size:14px;">(*Si es difícil de ubicar; adjuntar croquis y/o indicarnos referencias)</p><br>'; 
        $mensaje.= '<p style="font-size:14px;">EVALUACIÓN: Se debe contar con toda la documentación para sustentarla de forma física y/o digital. Es decir, cada respuesta afirmativa brindada en el formulario manual, debe tener la evidencia que la respalde.</p><br>'; 
        $mensaje.= '<p style="font-size:14px;">Es preciso reconocer que para lograr un servicio de homologación de calidad y con atención oportuna se requiere tener a bien el cumplimiento de los siguientes pasos necesarios para realizar el servicio: </p><br>'; 
        $mensaje.= '<ul><li style="font-size:14px;"> EL PROVEEDOR, debe asignar un representante(s), quien durante el servicio de homologación atienda el proceso para mostrar la evidencia requerida y acompañe al auditor durante su permanencia. </li><li style="font-size:14px;"> EL PROVEEDOR, debe disponer durante la visita técnica un área de oficina para el homologador  y facilidades de conexión a internet a efectos de acceder a la plataforma de homologación. </li><li style="font-size:14px;"> ORGANIZAR y CLASIFICAR todos los documentos, ordenados por capítulos (Según las categorías del formulario) para optimizar el tiempo.</li><li style="font-size:14px;"> EL AUDITOR no puede adelantar juicios, opinión, calificación ni puntajes durante la visita, éstos serán evidenciados cuando se les envíe el respectivo informe de evaluación.</li><li style="font-size:14px;"> EL PROVEEDOR debe brindar alojamiento, alimentación y asumir los gastos de traslado del auditor, cuando la homologación se ejecute fuera de Lima. En caso de aplicar coordinaciones logísticas deberá comunicarse al siguiente correo: tania.davila@pe.bureauveritas.com</li><li style="font-size:14px;"> BUREAU VERITAS se reserva el derecho de aceptar las condiciones de alojamiento, alimentación y traslado a efectos de asegurar las medidas de seguridad y  salud ocupacional necesarias para el auditor.</li><li style="font-size:14px;"> EL PROVEEDOR deberá confirmar su fecha de visita en un plazo máximo de 3 días. Caso contrario, su vista se anulará. </li></ul><br>'; 
        $mensaje.= '<p style="font-size:14px;">De cancelar o postergar la evaluación el proveedor pierde el 100% del abono.</p><br>'; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_programacion_auditor($homologacionID,$userID){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(6);
        $oAdmUser       = AdmUser::getItem($userID);
        $oHomologacion  = CrmHomologacion::getItem($homologacionID);
        $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Auditor '.$oAdmUser->firstName.' '.$oAdmUser->lastName.','."</p>";
        $mensaje.= '<p style="font-size:14px;">Se te ha programado la siguiente visita:</p><br>';

        $mensaje.= '<p style="font-size:14px;">Fecha:'.$oHomologacion->programDate.'</p>'; 
        $mensaje.= '<p style="font-size:14px;">Hora:'.$oHomologacion->hourDate.'-'.$oHomologacion->hourEndDate.'</p>'; 
        $mensaje.= '<p style="font-size:14px;">Empresa:'.$oProveedor->businessName.'</p><br>'; 

        $mensaje.= '<p style="font-size:14px;">En el transcurso de los días, se te estará haciendo llegar la agenda actualizada de la semana.</p><br>'; 
        $mensaje.= '<p style="font-size:14px;">Se Adjunta Archivo Infocorp <a target="_blank" href="/scs/homologacion/userfiles/'.$oHomologacion->document.'">Aqui</a></p><br>'; 
        $mensaje.= '<p style="font-size:14px;">Agradeceré confirmar recepción de correo. </p><br>'; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_Aprobacion_Homologacion($homologacionID){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(7);
        $oHomologacion  = CrmHomologacion::getItem($homologacionID);
        $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor '.$oProveedor->businessName.','."</p><br>";
        $mensaje.= '<p style="font-size:14px;">Se adjunta resultados del proceso de homologación.</p><br>';

        $mensaje.= '<p style="font-size:14px;">Por encontrarse con nota aprobatoria se hace envío de Logo de empresa homologada y el manual para el uso del mismo,  considerar que éste debe utilizarse únicamente por el periodo de vigencia del certificado obtenido.</p><br>'; 
        $mensaje.= '<p style="font-size:14px;">Así también de acuerdo a nuestra gestión de mejora continua agradeceríamos pueda completar la encuesta que se adjunta y enviárnosla a la brevedad.</p><br>'; 
        $mensaje.= '<p style="font-size:14px;">El certificado será enviado en el transcurso de la semana. De encontrarse en Lima, favor enviarnos su dirección para realizar el envío del mismo. Caso contrario, podrá recoger su certificado en nuestras oficinas de San Isidro en el horario de 10:00 am - 05:00 pm.</p><br>'; 
        $mensaje.= '<p style="font-size:14px;">Documentos:</p><ul><li><a href="http://app.bureauveritas.com.pe/scs/homologacion/userfiles/logo-homologacion.pdf">Logo de la Empresa</a></li><li><a href="http://app.bureauveritas.com.pe/scs/homologacion/userfiles/manual-uso-logo.pdf">Manual del Logo</a></li><li><a href="#">Encuesta</a></li><li><a href="http://app.bureauveritas.com.pe/scs/homologacion/ajax/informe_general.php?homologacionID='.$homologacionID.'" target="_blank">Informe</a></li></ul>'; 

        $mensaje.= '<p style="font-size:14px;">Agradeceré confirmar recepción de correo. </p><br>'; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_Desaprobacion_Homologacion($homologacionID){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(8);
        $oHomologacion  = CrmHomologacion::getItem($homologacionID);
        $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor '.$oProveedor->businessName.','."</p><br>";
        $mensaje.= '<p style="font-size:14px;">Se adjunta informe  de evaluación del proceso de Homologación <a href="http://app.bureauveritas.com.pe/scs/homologacion/ajax/informe_general?homologacionID='.$homologacionID.'" target="_blank">Aqui</a>.</p><br>';

        $mensaje.= '<p style="font-size:14px;">Asimismo se les informa que para aprobar el proceso de HOMOLOGACIÓN para su cliente se tiene que obtener un promedio superior al obtenido. En el caso de ustedes no superan el promedio por lo que no han logrado aprobar satisfactoriamente este proceso. </p><br>'; 
        $mensaje.= '<p style="font-size:14px;">En caso de considerarlo puede aplicar al servicio de Re-calificación (Levantamiento de No Conformidades), por derecho a una nueva revisión documentara y  visita técnica a sus oficinas. Para ello considerar lo siguiente:</p><br>'; 
        $mensaje.= '<ul><li>Se realiza bajo los mismos criterios y requisitos del Formulario de Evaluación inicial.</li><li>Deberá solicitar el servicio de RECALIFICACIÓN como máximo dentro del plazo establecido por Bureau Veritas. Posterior a ello, aplica el pago como servicio normal.</li><li>Sólo aplica una vez por cada servicio de homologación</li></ul>'; 

        $mensaje.= '<p style="font-size:14px;">Agradeceré confirmar recepción de correo. </p><br>'; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_Voucher_Requerimiento($requerimientoID,$monto){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(9);
        $oRequerimiento = CrmRequerimiento::getItem($requerimientoID); 
        $oAdmUser = AdmUser::getItem(8); // Francisco Da Souza
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado '.$oAdmUser->firstName.' '.$oAdmUser->lastName.','."</p><br>";
        $mensaje.= '<p style="font-size:14px;">Se adjunta voucher del proceso de Homologación para aprobación de su parte. <br>';

        $mensaje.= '<ul><li>Nro de Requerimiento : "'.$requerimientoID.'". </li><li>Proveedor : "'.$oProveedor->businessName.'".</li><li>Cliente : "'.$oCliente->businessName.'".</li><li>Monto Abonado: " s/. '.$monto.'".</li></ul>';

        $mensaje.= '<p style="font-size:14px;">Agradeceré confirmar recepción de correo. </p><br>'; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oAdmUser->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_Facturacion_Requerimiento($requerimientoID){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(10);
        $oRequerimiento = CrmRequerimiento::getItem($requerimientoID); 
        $oAdmUser = AdmUser::getItem(9); // Francisco Da Souza
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimada '.$oAdmUser->firstName.' '.$oAdmUser->lastName.','."</p><br>";
        $mensaje.= '<p style="font-size:14px;">Se aprueba el proceso de Homologación para facturación de su parte. <br>';

        $mensaje.= '<ul><li>Nro de Requerimiento : "'.$requerimientoID.'". </li><li>Proveedor : "'.$oProveedor->businessName.'".</li><li>Cliente : "'.$oCliente->businessName.'".</li></ul>';

        $mensaje.= '<p style="font-size:14px;">Agradeceré confirmar recepción de correo. </p><br>'; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oAdmUser->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_Finalizacion_Auditor($homologacionID){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(11);
        $oHomologacion  = CrmHomologacion::getItem($homologacionID);
        $oAdmUser       = AdmUser::getItem($oHomologacion->userID);
        $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Auditor '.$oAdmUser->firstName.' '.$oAdmUser->lastName.','."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Muchas gracias por haber finalizado la respectiva auditoria asignada.</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oAdmUser->email, $asunto, $body,$oEmail->desde);
    }


    public static function Send_Requerimiento_Recordatorio($nro_requerimiento,$day=null){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(12);

        $oRequerimiento = CrmRequerimiento::getItem($nro_requerimiento); 
        $oProveedor = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente = CrmCliente::getItem($oPropuesta->clienteID);
        if($day != null){
            $asunto= $oEmail->subject.': dia '.$day;
        }else{
            $asunto= $oEmail->subject.': Recordatorio';
        }
        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor: '.$oProveedor->businessName.','."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Por encargo de nuestro cliente, <strong>'.$oCliente->businessName.'</strong>, nos es grato dirigirnos nuevamente a usted a fin de saludarlo y a la vez comunicarle que estamos dando inicio al <strong>Proceso de Homologación de Proveedores</strong>.</p>';
        
        $mensaje.= '<p style="font-size:14px;text-align:justify">Este proceso tiene como objetivo evaluar y calificar las actividades, capacidades y recursos de su empresa de acuerdo a los criterios establecidos por el cliente  <strong>'.$oCliente->businessName.'</strong>, a fin de determinar su idoneidad para abastecer bienes y servicios de Calidad. En tal sentido, y de acuerdo a la Política de Contrataciones de <strong>'.$oCliente->businessName.'</strong>, todos los proveedores de bienes y servicios interesados en continuar trabajando con el cliente, deberán pasar por el proceso de Homologación.</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify;text-decoration:underline;">Información Requerida</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify">RUC : '.$oProveedor->documentNumber."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Nro Requerimiento : '.$nro_requerimiento."</p><br>";

        $mensaje.= '<p style="font-size:14px !important;text-align:justify">'.$oEmail->message.'</p>';

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';        

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }

    public static function Send_Aprobacion_Requerimiento_Recordatorio($nro_requerimiento,$day=null){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(13);

        $oRequerimiento = CrmRequerimiento::getItem($nro_requerimiento); 
        $oProveedor     = CrmProveedor::getItem($oRequerimiento->proveedorID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oCliente       = CrmCliente::getItem($oPropuesta->clienteID);
        
        if($day != null){
            $asunto= $oEmail->subject.': dia '.$day;
        }else{
            $asunto= $oEmail->subject.': Recordatorio';
        };

        $mensaje= '<br><p style="font-size:14px;">Estimado Proveedor '.$oProveedor->businessName.','."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Por medio del presente, le damos la bienvenida a nuestro <strong>Sistema de Gestión de Proveedores</strong>, el cual le permite registrar su servicio de homologación. Para acceder al sistema deberá ingresar al siguiente enlace: <a href="http://app.bureauveritas.com.pe/scs/homologacion/" target="_blank">http://app.bureauveritas.com.pe/scs/homologacion/</a> y digitar el usuario  y contraseña.</p>';
        
        $mensaje.= '<p style="font-size:14px;text-align:justify">USUARIO : '.$oProveedor->user."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">CONTRASEÑA : '.$oProveedor->pass."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>"; 

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';                   

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $oProveedor->email, $asunto, $body,$oEmail->desde);
    }



    public static function Send($from, $fromName, $to, $subject, $body, $cc=NULL){
        $mail = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->CharSet = 'UTF-8';
        /****************/
        $mail->SMTPDebug  = 0;
        //Ahora definimos gmail como servidor que aloja nuestro SMTP
        $mail->Host       = 'smtp.gmail.com';
        //El puerto será el 587 ya que usamos encriptación TLS
        $mail->Port       = 587;
        //Definmos la seguridad como TLS
        $mail->SMTPSecure = 'tls';
        //Tenemos que usar gmail autenticados, así que esto a TRUE
        $mail->SMTPAuth   = true;
        //Definimos la cuenta que vamos a usar. Dirección completa de la misma
        $mail->Username   = "homologacion.bureauveritas@gmail.com";
        //Introducimos nuestra contraseña de gmail
        $mail->Password   = "bureauveritas";

        $reply = explode(',',$cc);

        foreach($reply as $key) {    
            $mail->AddCC($key);
        }
        /****************/  

        $mail->SetFrom($from, $fromName);

        $reply2 = explode(',',$to);
        $count=0;
        foreach($reply2 as $key2) { 
            $count++;
            if($count == 1){   
                $mail->AddAddress($key2);
            }else{
                $mail->AddCC($key2);
            }
        }
        // name is optional
        $mail->Subject = $subject;
        $mail->AltBody = "Para ver este mensaje, por favor utilizar una aplicacion de correo compatible con HTML"; // optional, comment out and test
        //die($body);
        $mail->MsgHTML($body);


        return $mail->Send();
    }
}?>