<?php
require_once("../app/class/util/phpmailer/class.phpmailer.php");

class EmailAdmin{
    public static $ErrorMessage;

    public static function getTemplate($template, $replacement){
        $content = file_get_contents("../app/view/mail/template/".$template);

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

    public static function Send_Cliente($name_to, $mail_to,$user,$pass){
        global $WEBSITE;
        $oEmail = CrmEmail::getItem(1);

        $asunto= $oEmail->subject;

        $mensaje= '<br><p style="font-size:14px;">Estimado Cliente: '.$name_to.','."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Por medio del presente, le damos la bienvenida a nuestro <strong>Sistema de Gestión de Proveedores</strong>, el cual le permite monitorear el progreso de su servicio de homologación. Para acceder al sistema deberá ingresar al siguiente enlace: <a href="http://app.bureauveritas.com.pe/scs/homologacion/" target="_blank">http://app.bureauveritas.com.pe/scs/homologacion/</a> y digitar el usuario  y contraseña.</p>'."";
        
        $mensaje.= '<p style="font-size:14px;text-align:justify">Usuario : '.$user."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Password : '.$pass."</p>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">'.$oEmail->message."</p><br>";

        $mensaje.= '<p style="font-size:14px;text-align:justify">Atentamente <br>Bureau Veritas - División de Homologaciones</p><br><br>';     

        $body =self::setBody($asunto, $mensaje);

        return  self::Send($WEBSITE["ADMIN_MAIL"], $WEBSITE["ADMIN_NAME"] , $mail_to, $asunto, $body,$oEmail->desde);
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
        /****************/  
        
        $mail->SetFrom($from, $fromName);
        $mail->AddAddress($to);   // name is optional
        $mail->Subject = $subject;
        $mail->AltBody = "Para ver este mensaje, por favor utilizar una aplicacion de correo compatible con HTML"; // optional, comment out and test
        //die($body);
        $mail->MsgHTML($body);


        return $mail->Send();
    }
}?>