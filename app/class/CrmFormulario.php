<?php
require_once("base/Database.php");

class CrmFormulario extends Database
{

    public static function  getItem($formID){
        $query = "
        SELECT *
        FROM crm_formulario
        WHERE formID='$formID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function getItemHomo($homologacionID){
        $query = "
        SELECT f.* 
        FROM 
        crm_formulario f 
        INNER JOIN crm_form_propuesta fp ON (f.formID = fp.typeForm)
        INNER JOIN crm_requerimiento r ON (r.propxformID = fp.propxformID)
        INNER JOIN     crm_homologacion h ON (h.requerimientoID = r.requerimientoID)
        WHERE h.homologacionID='$homologacionID'";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_formulario
        ORDER BY formID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_formulario 
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_formulario
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_formulario
        WHERE state='1'
        ORDER BY formID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oFormulario){
            //Search the max 
        $sql = "SELECT IFNULL(MAX(formID), 0) FROM crm_formulario";
        $result = parent::GetResult($sql);
        $oFormulario->formID =parent::fetchScalar($result)+1;
        //Insert data into the table
        $query = "INSERT INTO crm_formulario(formID,title,description,registerDate,state)
        VALUES ('$oFormulario->formID','$oFormulario->title','$oFormulario->description',NOW(),'$oFormulario->state')";

        // ADJUNTOS
        $oAdjunto = new eCrmAdjunto();
        $a1=0;$a2=0;
        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Situación Financiera y Obligacion Legal','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Balance General y Estado de Pérdidas y Ganancias de los últimos dos periodos o declarados a SUNAT o auditados.','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Lista de obligación bancarias. Cronogramas pagados de Obligaciones Bancarias','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'PDT: Pago del IGV e Impuesto a la Renta (obligaciones tributarias) de los últimos seis meses','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'PDT: Planilla Electrónica: ESSALUD, SNP (obligaciones tributarias) de los últimos seis meses','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Pagos de AFP de los últimos seis meses','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Pagos de planilla del personal','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Declaración jurada de pago de autoevalúo / Contrato de alquiler de locales (de ser aplicable)','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Comprobantes de compra de maquinaria, tarjetas de propiedad de vehículos, Leasing Financieros pagados por compra de vehículos (de ser aplicable)','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Recibos de pago de sistemas y aplicaciones de comunicación','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Facturas de compra de equipos de cómputo y Contratos de alquiler de equipos de cómputo (de ser aplicable)','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Comprobantes de pago de las Licencias de los software y aplicaciones','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Gestión de Personal','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Manual de Organización y Funciones','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Perfiles de educación, formación, habilidades y experiencia','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento de selección y reclutamiento del personal','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa de Capacitación','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Gestión Seguridad y Salud Ocupacional','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Política de Seguridad y Salud Ocupacional','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Reglamento Interno de Trabajo','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Actas de reunión del comité de SST de los últimos 6 meses','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa Anual de Inspecciones en SSOMA','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa de auditoria en SSOMA ','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa Anual de Seguridad y Salud Ocupacional ','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Matriz de requisitos legales en SSOMA','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Matriz de identificación de peligros, evaluación y determinación de riesgos','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Mapa de Riesgos de sus instalaciones','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimientos de trabajo seguro para los riesgos críticos: altura, caliente, excavaciones, espacios confinados, Explosivos, Voladura y Desate de Rocas , etc','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimientos de Comunicación Interna y Externa','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento para la investigación y registro de accidentes / incidentes','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Plan de respuesta ante emergencias','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa de Simulacros','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa anual de capacitación en SSOMA','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento para el uso de EPP','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa de salud ocupacional','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Estadísticas de indicadores de Frecuencia, gravedad e incidentalidad','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Registros de Permiso Escrito de Trabajo de Alto Riesgo (PETAR)','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento para gestionar la seguridad basada en el comportamiento','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Gestión Ambiental','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Política Ambiental aprobada','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa Ambiental','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Indicadores de gestión ambiental','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Matriz de identificación de peligros, evaluación y determinación de riesgos ambientales','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa anual de capacitación en temas ambientales','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Plan de respuesta ante emergencias ambientales','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Plan de simulacros (para escenarios de emergencia ambiental)','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento para la investigación y registro de accidentes / incidentes ambientales','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Matriz de requisitos legales en materia ambiental','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Registro de inspecciones ambientales','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento de manejo de residuos','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Gestión de Calidad','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Certificado de Sistema de Gestión de Calidad certificado','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Manual de Gestión de Calidad','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Política de Calidad','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Objetivos de Calidad','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Indicadores de objetivos de calidad','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento escrito de control de documentos y registros','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Reportes de revisión por la dirección','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento de productos y/o servicios no conformes','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento de acciones correctivas y preventivas','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento de auditorias internas','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Especificaciones de los servicios ofrecidos','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimientos escritos de trabajo de acuerdo al servicio realizado','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Documento de conformidad del servicio/Evaluación de servicio/Encuestas de satisfacción al cliente u otros','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Contratos y/o ordenes de compra o servicios de sus clientes','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Calibracion de equipos y herramientas','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa de calibración de los instrumentos de medición','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Certificados de calibración de los equipos de medición','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Fichas técnicas y certificados de las herramientas','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Compras , recepcion y almacenamiento','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento sistemático para seleccionar a sus proveedores (de productos y/o servicios)','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento sistemático para la compra de materiales','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Procedimiento sistemático de inspección de los materiales e insumos comprados','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Certificados de calidad por lote de materia prima y/o insumos adquiridos','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Fichas técnicas y facturas de los EPPs que se utilizan','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Hojas de Seguridad -MSDS de los productos almacenados','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Mantenimiento','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Programa de mantenimiento preventivo de las máquinas y equipos','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Indicadores de mantenimiento','',$oAdjunto);
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Especificaciones técnicas del fabricante de las máquinas y equipos','',$oAdjunto);

        CrmAdjunto::AddNew2(0,$oFormulario->formID,'Manuales','',$oAdjunto);
        $a1 = $oAdjunto->adjID;
        CrmAdjunto::AddNew2($a1,$oFormulario->formID,'Manuales Técnicos de los servicios realizados','',$oAdjunto);


        //----------------------------------------------


        $oCheckList = new eCrmChecklist();
        $r1 = 0;$r2=0;$r3=0;$r4=0;
        // INFRAESTRUCTURA
        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Infraestructura',0,0,0,0,0,0,0,'',$oCheckList);

        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Instalaciones de la Empresa',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Oficinas:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: SI/NO ',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Vigencia del Arriendo / Alq.',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Ubicación Geográfica ( Dirección , Ciudad )',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Comentarios',1,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Almacén:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: SI/NO ',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Vigencia del Arriendo / Alq.',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Ubicación Geográfica ( Dirección , Ciudad )',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Comentarios',1,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'talleres:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: SI/NO ',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Vigencia del Arriendo / Alq.',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Ubicación Geográfica ( Dirección , Ciudad )',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Comentarios',1,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Laboratorio:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: SI/NO ',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Vigencia del Arriendo / Alq.',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Ubicación Geográfica ( Dirección , Ciudad )',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Comentarios',1,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Otros (Especificar):',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: SI/NO ',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Propio: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Área (m2)',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Arrendado: Vigencia del Arriendo / Alq.',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Ubicación Geográfica ( Dirección , Ciudad )',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Comentarios',1,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Número de Colaboradores',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Administrativos:',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Operativos:',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Turnos de trabajo y Horarios',1,1,1,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Gestión de la producción:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Capacidad de Contratación (Indicar la capacidad de contratación de la línea del servicio que desea homologar. (Ej: Horas/Hombre, Toneladas; Unidades, etc.))',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Línea de Producto',1,1,1,1,1,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Capacidad instalada',1,1,1,1,1,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Producción actual',1,1,1,1,1,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'% (Producción actual / Capacidad instalada)',1,1,1,1,1,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Máquinas y Equipos:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Descripción',1,1,1,1,1,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Marca',1,1,1,1,1,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Capacidad',1,1,1,1,1,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Año de Fabricación',1,1,1,1,1,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Alquiler o propiedad formal (SI/NO)',1,1,1,1,1,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Hardware, Software y Equipamiento especializado',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Cuenta con equipos de computo y software especializado para el desarrollo de sus actividades',7,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los software  utilizados tienen la licencia correspondiente',7,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Realiza copias de seguridad (backup) de su información',7,0,0,0,0,0,0,'',$oCheckList);

        //----------------------------------------------

        // SITUACION FINANCIERA Y OBLIGACION LEGAL
        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Situación Financiera y Obligacion Legal',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Estados Financieros:',0,0,0,0,0,1,1,'Balance General y Estado de Pérdidas y Ganancias de los últimos dos periodos, declarados a SUNAT o auditados.',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Nº de días',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Periodo',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Activo Corriente',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Activo No Corriente',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Total Activo',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Pasivo Corriente',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Pasivo no Corriente',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Total Pasivo',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Patrimonio',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Cuadre',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Ventas',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Costo de Ventas',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Utilidad',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Utilidad Neta del Ejercicio',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Cuentas por cobrar',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Cuentas por pagar',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Capital Social',3,3,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Existencias',3,3,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Ratios de Liquidez',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Razon de liquidez Gral (1)',6,6,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Prueba Acida (2)',6,6,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Activo No Cte. / Pasivo No Cte',6,6,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Ratios de Gestion (días)',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Rotacion de Stocks (3)',6,6,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Rotacion de Cuentas x Cobrar (4)',6,6,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Rotacion de Cuentas x Pagar (5)',6,6,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Ratios de Solvencia',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Razón de endeudamiento (6)',6,6,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Ratios de Rentabilidad',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Rentabilidad sobre patrimonio (7)',6,6,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Explicación de Ratios',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'(1) Indica el grado de cobertura que tienen los activos de mayor liquidez sobre las obligaciones de menor vencimiento o mayor exigibilidad. Cuanto más elevado sea el coeficiente alcanzado, mayor será la capacidad de la empresa para satisfacer las deudas que vencen a corto plazo.',0,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'(2) Representa una medida más directa de la solvencia financiera de corto plazo de la empresa, al tomar en consideración los niveles de liquidez de los componentes del activo circulante. Cuanto más elevado sea el coeficiente mayor será el grado de liquidez de la empresa.',0,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'(3) Indica el número de días que, en promedio, los productos terminados permanecen dentro de los inventarios que mantiene la empresa.',0,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'(4) Determina el número de días que en promedio transcurre entre el momento en que se realiza la venta y el momento en que se hace efectiva la cobranza.',0,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'(5) Determina el número de días que en promedio transcurre entre el momento que se realiza la compra y el momento en que se hace efectivo el pago.',0,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'(6) Indicador o media del riesgo financiero. Depende de la política financiera que aplica la empresa. Cuanto mayor sea el indicador, mayor será el riesgo de la empresa.',0,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'(7) Mide la rentabilidad de los accionistas, considerando el apalancamiento financiero.',0,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa presentó los dos últimos estados financieros anuales',2,0,0,0,0,1,0.25,'Verificar los estados financieros',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Obligaciones y Protestos',0,0,0,0,0,1,0.5,'Estado de los préstamos, leasing u otras obligaciones bancarias',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Lista de Obligaciones Bancarias a Corto y Largo Plazo ( Sobregiros, Pagarés, Letras) al dia',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Tipo de Obligacion (Vigente)',1,1,1,1,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Monto en US$ (1)',1,1,1,1,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se encuentra al día en los pagos (2)',1,1,1,1,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'De acuerdo al reporte del INFOCORP al:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa registra obligaciones vencidas y no pagadas',2,0,0,0,0,1,0.25,'Verificar reporte de infocorp.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tiene procesos Administrativos o Judiciales pendientes (Especificar)',2,0,0,0,0,1,0.25,'Verificar reporte de infocorp.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La calificación de la SBS  considera a la empresa como normal',7,0,0,0,0,1,0.5,'Calificación de la SBS según reporte de infocorp',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Bancos con los que trabaja su empresa',0,0,0,0,0,1,0.25,'Estados de cuenta corriente',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Nombre del Banco ',1,1,1,1,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Sectorista',1,1,1,1,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Nro. De Cuenta (Indicar S/.o US$)',1,1,1,1,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Cumplimiento de sus obligaciones en los últimos seis meses :',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'SUNAT',7,0,0,0,0,1,0.5,'Solicitar constancia de presentación y los pagos de SUNAT (PDT 621)',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'ESSALUD',7,0,0,0,0,1,0.5,'Solicitar constancia de presentación y los pagos de PLAME',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'AFP´s y/o ONP',7,0,0,0,0,1,0.5,'Pagos de AFPs y Solicitar constancia de presentación y los pagos de PLAME',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Planilla de personal',7,0,0,0,0,1,0.5,'Pagos de planilla mensuales',$oCheckList);

        // ------------------------------------------------------------------------------------------------------------

        // GESTIÓN DE PERSONAL                          

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Gestión de Personal',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa tiene un Manual de Organización y Funciones',7,0,0,0,0,1,1,'Manual de Organización y Funciones',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa ha definido las competencias  (educación, formación, habilidades y experiencia - de acuerdo a lo requerido por el puesto), para las diferentes funciones de la organización?. (Por ejm. Perfiles)',7,0,0,0,0,1,0.5,'Perfiles definidos por puestos de trabajo',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'El personal cumple con los perfiles establecidos para el puesto de trabajo',7,0,0,0,0,1,0.5,'Registros de legajo del personal que evidencie el perfil',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa mantiene archivos del personal, en el cual se evidencie la educación, formación y experiencia',7,0,0,0,0,1,0.5,'Registros de legajo del personal que evidencie el perfil',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Han implementado un procedimiento sistemático de reclutamiento de personal  para evaluar el cumplimiento del perfil requerido',7,0,0,0,0,1,0.5,'Procedimiento de selección y reclutamiento del personal, y verificar su implementación',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen un programa de capacitación y este se cumple',7,0,0,0,0,1,1,'Programa de capacitación y registros de las capacitaciones',$oCheckList);

        // ------------------------------------------------------------------------------------------------------------

         // GESTIÓN SEGURIDAD Y SALUD OCUPACIONAL                                                     

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Gestión Seguridad y Salud Ocupacional',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Cumplimiento de normas legales aplicables: Ley 29783, D.S. 024-2016-EM y otros aplicables',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen una política de SSOMA de la Compañía, firmada por la gerencia general',7,0,0,0,0,1,0.25,'Solicitar la Política SSOMA.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La política de SSOMA se encuentra ubicada en lugares visibles, en la zona de trabajo',7,0,0,0,0,1,0.15,'Verificar la Política SSOMA se encuentra ubicada en lugares visibles, en la zona de trabajo.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los documentos del sistema de SSOMA se encuentran controlados (revisión, aprobación, Revisión) y existe un procedimiento escrito de control de documentos y registros',7,0,0,0,0,1,0.2,'Solicitar el Procedimiento de control de documentos y registros del Sistema de SSOMA.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen lista maestra de documentos del sistema de SSOMA',7,0,0,0,0,1,0.15,'Solicitar las listas maestras de documentos, registros y documentos externos, del Sistema SSOMA.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa cuenta con un Reglamento Interno de Seguridad y Salud Ocupacional aprobado por el CSSO',7,0,0,0,0,1,0.15,'Solicitar evidencia de aprobación de RISSO',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa ha entregado el Reglamento Interno de Seguridad y Salud Ocupacional al personal? Registros de entrega.',7,0,0,0,0,1,0.2,'Solicitar el Reglamento Interno de Seguridad y Salud Ocupacional (empresas de 20 a más trabajadores) y registros de entrega de reglamento (cargos), también revisar  la evidencia de que haya sido comunicada a los trabajadores y esté aprobado por el Comité de SSO y/o supervisor SSO.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal conoce la existencia de Reglamento Interno de Seguridad y Salud Ocupacional y que información de importancia contiene',7,0,0,0,0,1,0.25,'Entrevistar a personal (muestra) sobre la existencia del Interno de Seguridad y Salud Ocupacional y su importancia.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Comité de Seguridad y Salud Ocupacional (CSSO)',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa cuenta con un comité paritario de Seguridad y Salud Ocupacional (En el caso de ser 20 a más trabajadores)',7,0,0,0,0,1,0.25,'Solicitar registros del proceso de elección del Comité del SSO, que sea paritario, acta de instalación del Comité de SSO, actas de reunión y que cumpla con sus funciones',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'En el caso de no tener más de 20 trabajadores:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Se ha elegido entre los trabajadores de sus áreas a un supervisor de SSO, titulado',7,0,0,0,0,1,0.25,'Solicitar acta de elección del Supervisor de SSO por los trabajadores (empresas de < 20 trabajadores). Descripción de Cargo en MOF, registro de las competencias del responsable de Seguridad y Salud Ocupacional, evidencia de titulo.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) El supervisor recibe capacitación en el Sistema de Gestión de Seguridad y Salud Ocupacional',7,0,0,0,0,1,0.25,'Solicitar registros de capacitación al supervisor de SSO, en temas referidos a Sistema de gestión de Seguridad y Salud Ocupacional. ',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Para las empresas a las cuales es aplicable tener un Comité de SSO, tienen un procedimiento de Constitución y Funcionamiento del Comité',7,0,0,0,0,1,0.25,'Solicitar Procedimiento de Constitución y Funcionamiento del Comité. ',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Tienen libro de actas del CSSO',7,0,0,0,0,1,0.25,'Solicitar Libros de actas del Comité de SSO.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Tienen actas de Reunión Mensual del Comité de SSO',7,0,0,0,0,1,0.25,'Solicitar las actas de las últimas reuniones ordinarias del comité de seguridad.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'El personal  tiene conocimiento de la existencia del comité de SSO? Y porque es importante?',7,0,0,0,0,1,0.25,'Entrevistar a personal (muestra) sobre la existencia del Comité de SSO y su importancia.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Inspecciones, Auditorias y Controles',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un Programa de Inspecciones en SSOMA y se evidencia cumplimiento del mismo',7,0,0,0,0,1,0.5,'Solicitar el Programa y registros de inspecciones.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El comité de SSO participa del programa de inspecciones',7,0,0,0,0,1,0.25,'Verificar en los informes de inspecciones, la participación del comité de SSO. ',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La alta dirección de la empresa participa del programa de inspecciones',7,0,0,0,0,1,0.25,'Verificar en los informes de inspecciones, la participación de la Alta dirección.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un Programa de auditoria en SSO y se evidencia cumplimiento del mismo',7,0,0,0,0,1,0.5,'Solicitar el Programa de Auditorías Interna al Sistema de Gestión de Seguridad y registros de cumplimiento en el último año.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Se realizan inspecciones mensuales a: ',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Las áreas de trabajo',7,0,0,0,0,1,0.25,'Solicitar registros de inspecciones.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Instalaciones eléctricas',7,0,0,0,0,1,0.25,'Solicitar registros de inspecciones.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Cables de izaje',7,0,0,0,0,1,0.25,'Solicitar registros de inspecciones.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Sistema contra incendio',7,0,0,0,0,1,0.25,'Solicitar registros de inspecciones.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) Zonas críticas',7,0,0,0,0,1,0.25,'Solicitar registros de inspecciones.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se realiza un seguimiento a las oportunidades de mejora encontrada en las inspecciones',7,0,0,0,0,1,0.25,'Solicitar consolidado de seguimiento de las inspecciones.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Programa Anual de SSOMA',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa cuenta con un Programa Anual de Seguridad y Salud Ocupacional aprobado por el CSSO',7,0,0,0,0,1,0.75,'Solicitar el Programa anual de SSO. Se debe evidenciar que  esté aprobado por el comité y/o supervisor SSO, y Gerencia General',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'El Programa Anual de Seguridad y Salud Ocupacional incluye:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Objetivos y metas cuantificables en SSO que permita monitorear su cumplimiento mensualmente',7,0,0,0,0,1,0.75,'Solicitar los objetivos y metas de SSO y verificar su cumplimiento mensualmente.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Cronograma de ejecución y presupuesto aprobado - Seguimiento',7,0,0,0,0,1,0.75,'Solicitar el presupuesto de SSO aprobado y verificar su seguimiento.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Análisis Crítico y Mejora continua de la Gestión de SSOMA',7,0,0,0,0,1,0.75,'Solicitar reportes, informes de seguimiento de la Gestión de SSOMA.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Responsable del Sistema de Gestión de Seguridad y Salud Ocupacional',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'En el legajo del responsable del Sistema de Gestión de Seguridad y Salud Ocupacional se evidencia la educación, formación y experiencia en la gestión de operaciones mineras y seguridad y salud ocupacional',7,0,0,0,0,1,0.75,'Solicitar perfil de responsable del sistema de gestión de seguridad, legajo, y verificar las competencias del responsable de Seguridad y Salud Ocupacional. ',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Las funciones del responsable del Sistema de Gestión de Seguridad y Salud Ocupacional se encuentran documentadas',7,0,0,0,0,1,0.75,'Solicitar funciones del responsable del sistema de gestión de seguridad.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Matriz Legal',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa tiene una matriz de requisitos legales en SSOMA',7,0,0,0,0,1,0.75,'Solicitar Matriz de requisitos legales vigentes.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa tiene disponibles las leyes aplicables en SSOMA',7,0,0,0,0,1,0.75,'Verificar que se cuente con los accesos y disponibilidad de las leyes para el personal',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Identificación de Peligros, Evaluación y Medidas de Control de los Riesgos',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa ha realizado la identificación de peligros y evaluación de riesgos de acuerdo a las actividades que realiza',7,0,0,0,0,1,0.75,'Solicitar Matriz IPER aprobada y difundida a los trabajadores.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa actualiza la planilla de IPERC por lo menos una vez al año y/o cuando ocurren accidentes y/o incidentes de alto potencial y/o cuando ocurre cambios en las condiciones de trabajo y se encuentra aprobada por el supervisor',7,0,0,0,0,1,0.75,'Programa de Revisión de Identificación de Peligros, Evaluación  y Control de Riesgos',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Para la ejecución de una actividad rutinaria o no rutinaria se tienen los PETS desarrollados',7,0,0,0,0,1,0.75,'Solicitar los procedimientos de trabajo seguro para las actividades rutinarias o no rutinarias a realizar, de una actividad',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Para las actividades no rutinarias, que no tuvieran un PET, se ha implementado  ATS',7,0,0,0,0,1,0.75,'Solicitar los ATS.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Para controlar, corregir y eliminar los riesgos, se sigue la secuencia establecida en el D.S 024-2016-EM',7,0,0,0,0,1,0.75,'Verificar el cumplimiento de la secuencia establecida de determinación de controles en el D.S 024-2016-EM, de jerarquía de controles',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa elabora anualmente y actualiza el mapa de riesgos',7,0,0,0,0,1,0.5,'Verificar mapa de riesgo de la zona de trabajo, identificación de extintores, mangueras, instrucciones, fechada y aprobada.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo conoce los riesgos a los cuales están expuestos en su actividad',7,0,0,0,0,1,0.25,'Solicitar registros de capacitación en base a los riesgos en sus actividades y entrevistar al personal',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los controles operacionales de los riesgos críticos, han sido implementados',7,0,0,0,0,1,0.75,'Planes de acción y su implementación, Registros de implementación',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal ha recibido capacitación en la matriz IPERC',7,0,0,0,0,1,0.5,'Solicitar registro de capacitación en matriz IPERC a los trabajadores.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Procedimientos',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Han definido procedimientos de trabajo seguro para los riesgos críticos',7,0,0,0,0,1,0.75,'Solicitar los procedimientos de trabajo seguro para las actividades a realizar',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo tiene conocimiento de los Procedimientos de Trabajo Seguro',7,0,0,0,0,1,0.75,'Registro de capacitación en procedimientos de trabajo seguro para las actividades a realizar. ',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Gestión de incidentes y accidentes',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un procedimiento para la notificación e investigación de incidentes, incidentes peligrosos, accidentes de trabajo y enfermedades ocupacionales',7,0,0,0,0,1,0.75,'Solicitar el Procedimiento',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se evidencia que la empresa registra e investiga los incidentes, incidentes peligrosos, accidentes de trabajo y enfermedades ocupacionales',7,0,0,0,0,1,0.75,'Verificar los registros de  investigación, análisis de causas y medidas correctivas. De haber registrado accidentes mortales, revisarlos.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa realiza un seguimiento y verificación de las acciones correctivas / preventivas que se adoptan',7,0,0,0,0,1,0.5,'Reportes, informes y registros de acciones correctivas / preventivas y su cumplimiento que se hayan adoptado.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo conoce los pasos a dar para reportar un accidente / incidente',7,0,0,0,0,1,0.5,'Entrevistar a personal para verificar si el personal conoce los pasos para el reporte de accidente / incidente.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo conoce la práctica de lecciones aprendidas',7,0,0,0,0,1,0.1,'Entrevistar a personal para verificar si el personal conoce la práctica de lecciones aprendidas. ',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Preparación y Respuesta ante Emergencias',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa cuenta con un plan de respuesta ante emergencias',7,0,0,0,0,1,0.75,'Solicitar el Plan de respuesta ante emergencia, este debe estar aprobada por el comité de SSO y el Gerente General. Debe contener procedimientos y acciones básicas de respuesta que se toman para afrontar de manera oportuna , adecuada y efectiva en el caso de un accidente y/o estado de emergencia. Debe incluir flujograma de comunicación, centros médicos, teléfonos de emergencias, contactos, comité de crisis, conformación de brigadas.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se brinda capacitación a las brigadas de emergencia de acuerdo a los estándares, PETS y prácticas reconocidas nacional o internacionalmente',7,0,0,0,0,1,0.75,'Programa de capacitación y entrenamiento y Registro de capacitación / entrenamiento del personal brigadistas de acuerdo a los planes de  respuesta ante emergencias.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa tiene un plan de simulacros y se controla su cumplimiento',7,0,0,0,0,1,0.75,'Programa y Registro de simulacros de emergencia',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los brigadista han aprobado los exámenes médicos especializados y los exámenes sobre técnicas y procedimientos de atención a emergencias.',7,0,0,0,0,1,0.75,'Registros de evaluaciones y capacitaciones',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo tiene conocimiento del plan de emergencias',7,0,0,0,0,1,0.75,'Entrevistar personal operativo / Registro de capacitación.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Capacitación',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa cuenta con un programa anual de capacitación en SSOMA',7,0,0,0,0,1,0.75,'Solicitar el Programa anual de capacitación en SSOMA, y esté aprobado por el Comité de SSO y/o supervisor SSO.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Realizan un seguimiento del cumplimiento del Plan de Capacitación',7,0,0,0,0,1,0.75,'Verificar el cumplimiento de Plan de Capacitación.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los trabajadores nuevos reciben: - Inducción y orientación básica no menor de 8 horas. - Capacitación específica teórico-práctica en el área de trabajo de 8 horas  durante 4 días, en actividades mineras y conexas de alto riesgo - Capacitación específica teórico-práctica en el área de trabajo de 8 horas diarias durante 2 días en actividades de menor riesgo.',7,0,0,0,0,1,0.5,'Solicitar lista de asistencia, actas, presentaciones, registros de inducciones.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los trabajadores que realizan trabajos de alto riesgo (caliente, espacios confinados, en altura, alta tensión, excavaciones,  trabajos en pique y chimenea, y otros de acuerdo a IPERC) reciben capacitación en los procedimientos escritos de trabajo seguro (PETS), evaluándose su entendimiento',7,0,0,0,0,1,0.75,'Solicitar lista de asistencia, actas, presentaciones, registros de capacitaciones. ',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'La capacitación básica en SSO adicionalmente al Anexo 6  del DS 024-2016 EM, también considera:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) El uso de la información de la hoja de datos de seguridad de materiales (HDSM - MSDS)',7,0,0,0,0,1,0.5,'Verificar el Programa anual de capacitación en SSOMA y registro de la capacitación',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) El uso correcto del sistema de izaje',7,0,0,0,0,1,0.5,'Verificar el Programa anual de capacitación en SSOMA y registro de la capacitación',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) El control y manipuleo de materiales y sustancias peligrosas',7,0,0,0,0,1,0.5,'Verificar el Programa anual de capacitación en SSOMA y registro de la capacitación',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Entrenamiento anual para brindar atención en primeros auxilios? Verificar registro de la asistencia, calificación y certificación interna de las materias que fueron objeto del entrenamiento',7,0,0,0,0,1,0.5,'Verificar el Programa anual de capacitación en SSOMA / Verificar registro de la asistencia, calificación y certificación interna de las materias que fueron objeto del entrenamiento',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Control de EPP',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un procedimiento para el uso de EPP',7,0,0,0,0,1,0.25,'Procedimiento para el uso de EPP.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se ha entregado los EPP a todos los trabajadores que lo requieren y se guarda registro de dicha actividad',7,0,0,0,0,1,0.75,'Registros de  entrega, verificación y recambio de los Equipos de Protección Personal (EPP)',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se tienen las fichas técnicas de los EPP utilizados',7,0,0,0,0,1,0.25,'Fichas técnicas de los EPP utilizados',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Gestión de Salud Ocupacional',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un programa de salud ocupacional',7,0,0,0,0,1,0.75,'Programa de salud ocupacional por un Médico de Salud Ocupacional, Registros de las competencias del Médico de Salud Ocupacional',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Cuentan con registros de:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Enfermedades ocupacionales ocurridas por exposición ocupacional',7,0,0,0,0,1,0.75,'Registro de Enfermedades ocupacionales ocurridas por exposición ocupacional',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Descansos médicos',7,0,0,0,0,1,0.1,'Registro de Descansos médicos',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Ausentismo por enfermedades',7,0,0,0,0,1,0.1,'Registro de Ausentismo por enfermedades',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Planes de acción',7,0,0,0,0,1,0.75,'Planes de acción de Salud Ocupacional.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) Evaluación estadística de resultados',7,0,0,0,0,1,0.75,'Estadística de resultados de Salud Ocupacional.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se realiza una evaluación médica al personal con relación a su exposición a factores de riesgo de origen ocupacional, incluyendo el conocimiento de los niveles de exposición y emisión de las fuentes de riesgo',7,0,0,0,0,1,0.75,'Exámenes médicos efectuados , evidenciar certificados de aptitud médica en relación a su exposición a factores de riesgo de origen ocupacional, incluyendo el conocimiento de los niveles de exposición y emisión de las fuentes de riesgo.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los trabajadores reciben capacitación en temas referidos a salud ocupacional',7,0,0,0,0,1,0.75,'Registros de capacitación en temas referidos a salud ocupacional.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se realizan los exámenes de Ingreso, exámenes anuales ocupacionales y de retiro',7,0,0,0,0,1,0.75,'Cuadro o consolidado de exámenes médicos efectuados (antes, durante y al término de la relación laboral), evidenciar certificados de aptitud médica de todos los trabajadores por puesto de trabajo. Protocolo medico por puesto de trabajo.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo conoce los riesgos a la salud ocupacional a los cuales están expuestos',7,0,0,0,0,1,0.25,'Entrevista al personal operativo ',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa realiza una evaluación de los agentes físicos, químicos, biológicos de acuerdo a sus actividades',7,0,0,0,0,1,0.75,'Informe de Monitoreos de agentes físicos, químicos, biológicos y registros de su realización.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa ha realizado la evaluación de riesgos  ergonómicos y psicosociales',7,0,0,0,0,1,0.75,'Informe de Monitoreos de agentes de factores de riesgo disergonómicos , psicosociales y registros de su realización.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo conoce cuales son los agentes físicos, químicos o biológicos que le pueden afectar, debido a su actividad',7,0,0,0,0,1,0.1,'Entrevistar a personal operativo.',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Comunicación y Motivación',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Cuentan con mecanismos de comunicación entre los trabajadores y supervisores para inquietudes en SSO',7,0,0,0,0,1,0.5,'Procedimiento de comunicación y participación en SSO.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen reconocimiento al personal, por buena performance en SSOMA? Si es así, el personal operativo conoce esto?',7,0,0,0,0,1,0.1,'Premios, incentivos de reconocimiento al personal por buena performance en SSOMA.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Colocan avisos visibles y legibles sobre las normas generales de seguridad y salud ocupacional en los lugares de trabajo',7,0,0,0,0,1,0.25,'Verificar señalética en lugares de trabajo.',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Realizan campañas de difusión y sensibilización en SSOMA',7,0,0,0,0,1,0.5,'Solicitar informes de campañas y sensibilización en SSOMA. ',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Estadísticas',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen seguimiento de indicadores de Frecuencia, Severidad y Accidentabilidad',7,0,0,0,0,1,0.75,'Indicadores de Frecuencia, severidad e incidentalidad',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un sistema de registro de información de SSOMA',7,0,0,0,0,1,0.5,'Sistema de registro de información de SSOMA',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un sistema de seguimiento de acciones de Inspecciones, incidentes, OPTs, otros',7,0,0,0,0,1,0.5,'Registro de seguimiento de acciones de Inspecciones, incidentes, OPTs, otros',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Riesgos Críticos',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Para las actividades de alto riesgo, se requiere previamente la generación de un Permiso Escrito de Trabajo de Alto Riesgo (PETAR), autorizado y firmado para cada turno, por el ingeniero supervisor o responsable del área de trabajo',7,0,0,0,0,1,0.25,'Registros de Permiso Escrito de Trabajo de Alto Riesgo (PETAR).',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Trabajo en Caliente: Para realizar trabajos en caliente, se cumple con lo establecido en el D.S 024-2016-EM:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Inspección previa del área de trabajo',7,0,0,0,0,1,0.2,'Permiso de trabajo en caliente.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Disponibilidad de equipos para combatir incendios',7,0,0,0,0,1,0.2,'Check list de extintores.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Equipos de protección personal adecuado',7,0,0,0,0,1,0.2,'Check List de EPPs.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Equipos de trabajo y ventilación adecuada',7,0,0,0,0,1,0.2,'Check list de equipos de trabajo.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) Capacitación',7,0,0,0,0,1,0.2,'Registros de capacitación / Charla de inicio de labores. ',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'f) Colocación visible de permisos de trabajo',7,0,0,0,0,1,0.1,'Verificar la colocación visible de permiso de trabajo.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Espacios Confinados: Para realizar trabajos en espacios confinados, se cumple con lo establecido en el D.S 024-2016-EM:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Equipos de protección personal adecuados',7,0,0,0,0,1,0.2,'Check List de EPPs.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Confirmar la disponibilidad de equipo de monitoreo de gases para la verificación de la seguridad del área de trabajo',7,0,0,0,0,1,0.2,'Check List de   equipo de monitoreo de gases para la verificación de la seguridad del área de trabajo',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Equipo de trabajo y ventilación adecuados',7,0,0,0,0,1,0.2,'Check list de equipos de trabajo / verificar la ventilación adecuados',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Equipos de comunicación',7,0,0,0,0,1,0.1,'Check list de equipos de comunicación.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) Capacitación',7,0,0,0,0,1,0.2,'Registros de capacitación / Charla de inicio de labores.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'f) Colocación visible de permisos de trabajo',7,0,0,0,0,1,0.1,'Verificar la colocación visible de permiso de trabajo.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Excavaciones mayores o iguales a 1.50 m, se cumple con lo establecido en el D.S 024-2016-EM:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Para realizar trabajos en excavación, Se evalúan características del terreno tales como: compactación, granulometría, tipo de suelo, humedad, vibraciones, profundidad',7,0,0,0,0,1,0.25,'Informes de ensayos de terreno.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Trabajo en Altura a partir de 1.80m, se cumple con lo establecido en el D.S 024-2016-EM:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Para realizar trabajos en altura o en distinto niveles a partir de 1.80 metros Se usa: anclaje, línea de vida y arnés',7,0,0,0,0,1,0.2,'Permiso de trabajo en altura / Check list de Arnés / Verificar en campo.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los trabajadores que realizan trabajo en altura tienen certificados anuales de suficiencia médica',7,0,0,0,0,1,0.25,'Certificado de capacitación en altura / certificados médicos.Nota: Los certificados médicos deben descartar: todas las enfermedades neurológicas y/o metabólicas que produzcan alteración de la conciencia súbita, déficit estructural o funcional de miembros superiores e inferiores, obesidad, trastornos del equilibrio, alcoholismo y enfermedades psiquiátricas.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Andamios',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Tienen un procedimiento escrito para el uso de andamios',7,0,0,0,0,1,0.2,'Procedimiento escrito de uso de andamio.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se realiza una inspección formal de andamios, con criterios de aceptación definidos (normados)',7,0,0,0,0,1,0.1,'Certificados de andamios normados. ',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,1,'En lo referente al uso de andamios, la empresa cumple con:',0,0,0,0,0,0,0,'',$oCheckList);
        $r4 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r4,$oFormulario->formID,2,'a) El montaje y desmontaje del andamio es realizado únicamente por personal calificado',7,0,0,0,0,1,0.1,'Verificar constancias de personal calificado.',$oCheckList);
        CrmChecklist::AddNew2($r4,$oFormulario->formID,2,'b) Loa andamios cuentan con dos barandillas (superior e intermedia) y rodapié',7,0,0,0,0,1,0.1,'Verificar andamios.',$oCheckList);
        CrmChecklist::AddNew2($r4,$oFormulario->formID,2,'c) El número de amarres del andamio se basa en un criterio técnico',7,0,0,0,0,1,0.1,'Verificar andamios.',$oCheckList);
        CrmChecklist::AddNew2($r4,$oFormulario->formID,2,'d) Se ha capacitado al personal en el uso seguro de andamios',7,0,0,0,0,1,0.1,'Registro de capacitación en uso seguro de andamios.',$oCheckList);
        CrmChecklist::AddNew2($r4,$oFormulario->formID,2,'e) El montaje del andamio tiene una lista de chequeo',7,0,0,0,0,1,0.1,'Check list de Chequeo de andamios.',$oCheckList);
        CrmChecklist::AddNew2($r4,$oFormulario->formID,2,'f) Han definido la carga máxima que el andamio puede soportar',7,0,0,0,0,1,0.1,'Certificados de andamios normados.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Sostenimiento de Rocas',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se ha definido la realización de una inspección previa antes de ingresar a un área donde existe el riesgo latente de desprendimiento de rocas',7,0,0,0,0,1,0.1,'Registro de inspección previa antes de ingresar a un área donde existe el riesgo latente de desprendimiento de rocas.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se ha definido que se debe desatar todas las rocas sueltas o peligrosas antes, durante y después de la perforación. Asimismo, antes y después de la voladura',7,0,0,0,0,1,0.05,'Solicitar  informes',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se ha definido la obligación de conservar el orden y la limpieza en el área de trabajo para realizar las tareas con seguridad y tener las salidas de escape despejadas',7,0,0,0,0,1,0.05,'Check list de orden y limpieza del lugar de trabajo.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Sustancias Químicas Peligrosas',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa cuenta con un procedimiento para la identificación de las sustancias / materiales peligrosos',7,0,0,0,0,1,0.2,'Solicitar el Procedimiento de manejo de sustancias / materiales peligrosos',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Cuentan con las hojas de seguridad o MSDS de las sustancias / materiales peligrosos',7,0,0,0,0,1,0.05,'Registros de hojas MSDS y que contenga los 16 puntos de la norma.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los trabajadores son capacitados en las hojas MSDS',7,0,0,0,0,1,0.05,'Registros de capacitación en hojas MSDS',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Tienen una lista maestra de productos peligrosos utilizados en la operación',7,0,0,0,0,1,0.05,'Solicitar el  listado maestra de sustancias y/o productos químicos, utilizados en la operación.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Trabajos eléctricos',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa cuenta con un procedimiento de bloqueo y señalización para desactivar fuentes de energía',7,0,0,0,0,1,0.2,'Procedimiento de bloqueo y señalización.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'El personal que trabaja con energía eléctrica ha recibido capacitación en bloqueo y señalización',7,0,0,0,0,1,0.1,'Registro de capacitación en Procedimiento de bloqueo y señalización.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se ha establecido que solo el trabajador que colocó la tarjeta de bloqueo sea el único autorizado para retirar la misma',7,0,0,0,0,1,0.05,'Verificar cumplimiento en registros / instructivos / Procedimientos.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se ha establecido como información obligatoria, antes de realizar un trabajo eléctrico, los planos o diagramas con la información actualizada que ayude a identificar y operar el sistema eléctrico',7,0,0,0,0,1,0.05,'Verificar cumplimiento en registros / instructivos / Procedimientos.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Gases Comprimidos',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Si la empresa trabaja con gases a presión, los balones tienen un manómetro, válvula de seguridad e inspección periódica',7,0,0,0,0,1,0.1,'Check List de balones de gases / Verificar en campo',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Carga Suspendida (Izaje)',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La construcción, operación y mantenimiento de los equipos y accesorios de izaje cumple con las normas técnicas establecidas por los fabricantes',7,0,0,0,0,1,0.2,'Solicitar certificados.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se evidencia la calificación, certificación y autorización de los operadores y riggers',7,0,0,0,0,1,0.2,'Solicitar certificados de capacitación de los operadores y riggers.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se realizan inspecciones periódicas a los equipos y aparejos de izaje por personal competente',7,0,0,0,0,1,0.05,'Informes de inspecciones periódicas a los aparejos de izaje por personal competente.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se inspeccionan cables de izaje bajo un estándar',7,0,0,0,0,1,0.05,'Registros de inspección de cables de izaje.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Vehículos y equipos móviles',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los operadores de equipos móviles cuentan con alguna certificación y autorización por parte de la empresa',7,0,0,0,0,1,0.3,'Certificados de MTC / Certificados de capacitación.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los conductores que salen del área de operaciones con equipos móviles de transporte de personal y carga, cuentan con exámenes médicos, psicotécnicos, de manejo y reglas de tránsito y seguridad vial',7,0,0,0,0,1,0.05,'Exámenes médicos, psicotécnicos, de manejo y reglas de tránsito y seguridad vial de los  conductores que salen del área de operaciones con equipos móviles de transporte de personal y carga.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los equipos de  perforación, carguío, transporte y equipo auxiliar, cuentan con un programa de mantenimiento preventivo y de inspecciones',7,0,0,0,0,1,0.05,'Programa de mantenimiento preventivo y de inspecciones.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se realiza inspecciones pre-uso de los equipos móviles',7,0,0,0,0,1,0.05,'Registros de inspección de equipos, máquinas y vehículos. ',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Señalización, código de colores',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa cuenta con un procedimiento para señalizar las áreas de trabajo de acuerdo al Código de Señales y Colores ',7,0,0,0,0,1,0.1,'Procedimiento para señalizar las áreas de trabajo de acuerdo a un Código de Señales y Colores (de acuerdo al Anexo Nº 11 del D.AS 024-2016-EM)',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Bloqueo de energía',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Tienen un procedimiento escrito de bloqueo de energía',7,0,0,0,0,1,0.05,'Procedimiento escrito de bloqueo de energía.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se han identificado las fuentes de energía que pueden causar accidentes graves',7,0,0,0,0,1,0.05,'Solicitar informe de evaluación.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se realiza una observación planeada de tarea (OPT) mensualmente, para asegurar el correcto uso de los candados',7,0,0,0,0,1,0.05,'Registro de inspección planeada.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los candados y accesorios de bloqueo se encuentran numerados',7,0,0,0,0,1,0.05,'Solicitar control de stock de candados y accesorios de bloqueo. ',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Herramientas Manuales',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se tiene un procedimiento implementado que permita gestionar el control de herramientas, considerando su diseño, estandarización, fabricación, adquisición, préstamo, almacenamiento e inspección',7,0,0,0,0,1,0.2,'Procedimiento de herramientas manuales.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Presupuestan anualmente la compra y/o renovación de herramientas',7,0,0,0,0,1,0.1,'Presupuesto de herramientas manuales.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Realizan una inspección periódica de herramientas, verificando el estado de conservación de las mismas y la no existencia de herramientas fabricadas artesanalmente',7,0,0,0,0,1,0.05,'Presentar Programa y registros de Inspecciones de  herramientas (de acuerdo al código de colores).',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Las herramientas se encuentran codificadas',7,0,0,0,0,1,0.05,'Inspecciones de  herramientas (de acuerdo al código de colores).',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Protección de máquinas',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Cuando la operación de una máquina puede lesionar a algún trabajador, se implementan guardas, señales y otros elementos de control que fuesen necesarios',7,0,0,0,0,1,0.05,'Programa de Inspecciones de Seguridad y Salud Ocupacional: Equipos, máquinas, vehículos, etc. Verificar implementación.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se realiza una inspección periódica de las guardas y otros elementos de control aplicados, tales como enclavadores, sensores u otros',7,0,0,0,0,1,0.15,'Registros de haber realizado inspecciones de Seguridad y Salud Ocupacional: Equipos, máquinas, vehículos, etc./  Verificar implementación.',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Explosivos',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se tiene procedimientos escritos para controlar y minimizar los riesgos relacionados con el almacenamiento, transporte, manipulación y uso de explosivos, así como los agentes y accesorios de voladura',7,0,0,0,0,1,0.25,'Procedimiento de almacenamiento, transporte, manipulación y uso de explosivos, así como los agentes y accesorios de voladura.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa asegura la capacitación, habilitación y autorización de los empleados que manipulan o están expuestos a los explosivos',7,0,0,0,0,1,0.05,'Registros de capacitación en Procedimiento de almacenamiento, transporte, manipulación y uso de explosivos, así como los agentes y accesorios de voladura.',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'El entrenamiento para la manipulación, transporte y almacenaje de explosivos se realiza con una frecuencia no mayor a 12 meses',7,0,0,0,0,1,0.05,'Registros de capacitación (no mayor a 12 meses)',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Dependiendo de la actividad realizada, la empresa cuenta con las autorizaciones requeridas por SUCAMEC',7,0,0,0,0,1,0.05,'Autorización de la SUCAMEC, (en caso aplique).',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'En el caso de empresas que realizan actividades de voladura, han definido en cada etapa los controles a tener en cuanta para minimizar el riesgo de accidentes (en polvorín, en perforado y cargado, en el tipo de disparo utilizado)',7,0,0,0,0,1,0.05,'Verificar controles operacionales en la actividad de voladura, (en caso aplique) / procedimientos, manuales',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Seguridad Basada en el Comportamiento',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un procedimiento para gestionar la seguridad basada en el comportamiento',7,0,0,0,0,1,0.25,'Procedimiento de gestión de seguridad basada en el comportamiento, Programas de seguridad basada en el comportamiento',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Han implementado herramientas de seguridad basada en el comportamiento',7,0,0,0,0,1,0.1,'Auditorias de comportamiento, talleres y otros',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se evidencia que la línea de mando participa activamente en los programas de seguridad (capacitación, inspección, otros)',7,0,0,0,0,1,0.25,'Informes de seguimientos / registros de capacitaciones/ Inspecciones / informe de caminatas en la que participe la línea de mando',$oCheckList);

        // ------------------------------------------------------------------------------------------------------------

        // GESTIÓN AMBIENTAL                          

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Gestión Ambiental',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Política Ambiental firmada por su Gerencia General',7,0,0,0,0,1,0.25,'Solicitar Política Ambiental',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'El personal operativo conoce los riesgos e impactos ambientales correspondiente a sus actividades',7,0,0,0,0,1,0.35,'Registros de capacitación en temas de los riesgos e impactos ambientales / Entrevistar al personal operativo',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Cuentan con un Programa Ambiental implementado',7,0,0,0,0,1,0.25,'Solicitar el Programa Ambiental y registros de su implementación',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Cuentan con indicadores de gestión ambiental y evidencian la mejora continua en el Sistema',7,0,0,0,0,1,0.25,'Solicitar indicadores de gestión ambiental',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Identificación de Peligros, evaluación y control de riesgos',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa ha realizado la identificación de peligros y evaluación de riesgos ambientales de acuerdo a las actividades que realiza',7,0,0,0,0,1,0.25,'Solicitar matrices de identificación y evaluación de aspectos ambientales de acuerdo a sus actividades',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa actualiza la planilla de IPERC por lo menos una vez al año y/o cuando ocurren accidentes y/o incidentes ambientales de alto potencial y/o cuando ocurre cambios en las condiciones de trabajo y se encuentra aprobada por el supervisor',7,0,0,0,0,1,0.5,'Verificar actualización de matriz ambiental, control de cambios, matrices anteriores',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Para la ejecución de una actividad rutinaria o no rutinaria se tienen los PETS desarrollados con la consideración de controles ambientales',7,0,0,0,0,1,0.25,'Solicitar los PETS y verificar que consideren controles ambientales',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal ha recibido capacitación en la matriz IPERC Ambientales',7,0,0,0,0,1,0.15,'Registros de capacitación en matriz ambiental',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Capacitación',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa cuenta con un programa anual de capacitación en temas ambientales y acorde al D.S. 040-2014-EM',7,0,0,0,0,1,0.25,'Solicitar Programa Anual de Capacitación ambiental',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa realiza seguimiento del cumplimiento del Plan de Capacitación de temas ambientales',7,0,0,0,0,1,0.15,'Solicitar registros y controles de seguimiento del cumplimiento del plan de capacitación',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'En el caso de trabajadores nuevos, reciben una inducción y orientación básica en temas ambientales acorde al D.S. 040-2014-EM',7,0,0,0,0,1,0.15,'Solicitar registros de inducción',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Los trabajadores que realizan trabajos relacionados con el transporte de: sustancias químicas, residuos sólidos, relaves y desmontes, entre otros, reciben capacitación específica (en temas ambientales relacionados a tareas específicas), evaluándose su entendimiento',7,0,0,0,0,1,0.15,'Registros de capacitación',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa evalúa la eficacia de las capacitaciones en materia ambiental brindada',7,0,0,0,0,1,0.15,'Solicitar registros de evaluación de la eficacia de las capacitaciones brindadas',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Preparación y Respuesta ante Emergencias',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa cuenta con un plan de respuesta ante emergencias ambientales',7,0,0,0,0,1,0.25,'Solicitar plan de respuesta ante emergencias ambientales',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se brinda capacitación a las brigadas de emergencia ambiental de acuerdo a los estándares, PETS y prácticas reconocidas nacional o internacionalmente',7,0,0,0,0,1,0.25,'Registros de capacitación a las brigadas de emergencia de acuerdo a su responsabilidad',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa tiene un plan de simulacros (para escenarios de emergencia ambiental) y se controla su cumplimiento',7,0,0,0,0,1,0.25,'Solicitar plan / programa de simulacros ambientales y su cumplimiento',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal brigadista ambiental en campo, tiene conocimiento de los temas en los cuales se capacitó al personal brigadista ambiental de la empresa',7,0,0,0,0,1,0.25,'Entrevistar al personal brigadista en campo',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo tiene conocimiento del plan de emergencias ambiental',7,0,0,0,0,1,0.25,'Entrevistar al personal operativo',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se difundió los planes de emergencia ambiental y el personal conoce como responder en caso de la ocurrencia de estas emergencias',7,0,0,0,0,1,0.25,'Solicitar registros de capacitación al personal en los planes de emergencia ambiental y entrevista',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Gestión de incidentes y accidentes',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen un procedimiento para la investigación y registro de accidentes / incidentes ambientales',7,0,0,0,0,1,0.25,'Solicitar procedimiento para la investigación y registro de accidentes / incidentes ambientales',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Se evidencia que la empresa registra e investiga accidentes e incidentes ambientales',7,0,0,0,0,1,0.25,'Solicitar registros / informes de accidentes e incidentes ambientales',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa realiza un seguimiento y verificación de las acciones correctivas / preventivas que se adoptan',7,0,0,0,0,1,0.25,'Solicitar registros / informes de accidentes e incidentes ambientales, con análisis de causas, determinación de acciones correctivas',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal operativo conoce los pasos a dar para reportar un accidente / incidente ambiental',7,0,0,0,0,1,0.25,'Entrevistar al personal y verificar que conozca paso a paso el proceso de reporte de accidente e incidente ambiental',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Matriz Legal',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa tiene una matriz de requisitos legales en materia ambiental y en coherencia con el servicio que prestan',7,0,0,0,0,1,0.25,'Solicitar matriz de requisitos legales, revisar que se hayan identificado por norma / ley / reglamento u otros todos los requisitos (artículos) aplicables',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Inspecciones Ambientales',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Cuentan con un registro de inspecciones ambientales programadas',7,0,0,0,0,1,0.15,'Solicitar programa de inspecciones ambientales y registros de las inspecciones',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Cuentan con un registro de inspecciones ambientales no programadas',7,0,0,0,0,1,0.1,'Solicitar registros / informes de las inspecciones ambientales no programadas (inopinadas)',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Riesgos críticos ambientales',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Residuos Sólidos:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa se encarga de la gestión de los residuos sólidos generados por sus actividades',7,0,0,0,0,1,0.25,'Verificar si la empresa se encarga de la gestión de los residuos sólidos, si realiza inventarios y controles, acumulación temporal en lugares adecuados',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Cuentan con un inventario y control de los residuos sólidos generados por sus actividades',7,0,0,0,0,1,0.25,'Solicitar inventario y control de los residuos generados por la empresa',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Este inventario contempla la cantidad (en TM) de residuos sólidos generados y dispuestos, por tipo',7,0,0,0,0,1,0.25,'Verificar que el inventario contemple cantidad (en TM) generados',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Cuentan con lugar adecuado para la acumulación temporal de residuos sólidos, por tipo',7,0,0,0,0,1,0.25,'Verificar lugar, contenedores adecuados para la acumulación de residuos por tipo',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'El lugar de acumulación temporal se encuentra demarcado, señalizado, rotulado en forma clara, impermeabilizado y es accesible para el personal y el vehículo de recolección de residuos',7,0,0,0,0,1,0.05,'Verificar señalizaciones, rotulaciones, accesibilidad del lugar de disposición temporal de la empresa. En caso la empresa recolecte los residuos con un vehículos, éste se encuentra en óptimas condiciones y señalizado',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Cuentan con registros de inspecciones realizadas a los lugares de acumulación temporal de residuos',7,0,0,0,0,1,0.05,'Solicitar registros de inspecciones realizados a los lugares de acumulación temporal de residuos',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se identifican los riesgos ambientales y controles asociados a la gestión de residuos sólidos en el IPERC Continuo',7,0,0,0,0,1,0.15,'Solicitar registros de IPERC Continuo en la que se identifiquen riesgos ambientales y se determinen controles',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'El personal fue entrenado en la gestión de residuos sólidos',7,0,0,0,0,1,0.15,'Solicitar registros de capacitación al personal en gestión de residuos sólidos',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Aguas y efluentes líquidos:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa se encarga de la gestión de aguas y efluentes líquidos generados por sus actividades',7,0,0,0,0,1,0.15,'Verificar que la empresa realice la gestión de aguas y efluentes líquidos generados por sus actividades. Si es responsabilidad del cliente, verificarlo con documentación contractual o declarada por el cliente',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa gestiona adecuadamente el consumo de agua y cuentan con programas de reducción de consumo',7,0,0,0,0,1,0.1,'Solicitar registros de control de consumo de agua y programa de reducción de consumo',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa ha identificado los puntos de vertimiento de efluentes líquidos generados por sus actividades',7,0,0,0,0,1,0.1,'Solicitar procedimientos o documentación en la que se haya identificado los puntos de vertimiento de efluentes líquidos generados por sus actividades',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa comunicó en forma oficial al Área de Asuntos Ambientales de la unidad sobre la generación de estos efluentes vertidos',7,0,0,0,0,1,0.1,'Solicitar registros de comunicación al área de asuntos ambientales de la unidad sobre la generación de efluentes vertidos',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa tiene conocimiento de cómo tratar estos efluentes generados',7,0,0,0,0,1,0.1,'Solicitar registros de capacitación y entrevistas al personal de cómo tratar estos efluentes generados',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa monitorea y analiza la calidad de los efluentes vertidos',7,0,0,0,0,1,0.1,'Solicitar informes / reportes de monitoreos de la calidad de los efluentes vertidos',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa cuenta con sistemas separadores de grasas',7,0,0,0,0,1,0.1,'Verificar registros de inspecciones / mantenimientos de los sistemas de separadores de grasas',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa realiza la limpieza y mantenimiento continuo a las trampas de grasa',7,0,0,0,0,1,0.1,'Solicitar registros / informes / facturas de limpieza y mantenimiento periódico a las trampas de grasas',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los sistemas de contención (propios o asignados) están limpios y se realiza mantenimiento continuo',7,0,0,0,0,1,0.1,'Solicitar registros / informes / facturas de limpieza y mantenimiento periódico a los sistemas de contención',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los Check List de los equipos móviles contemplan y registran como desvíos los derrames de aceites, grasas y combustibles',7,0,0,0,0,1,0.2,'Solicitar check list de los equipos móviles que contemplen verificación de derrames de aceites, grasas y combustibles',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se identifican los riesgos ambientales y controles asociados a la gestión de aguas y efluentes líquidos en el IPERC Continuo',7,0,0,0,0,1,0.15,'Solicitar registros de IPERC Continuo en la que se identifiquen riesgos ambientales y se determinen controles asociados a la gestión de aguas y efluentes líquidos ',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'El personal fue entrenado en la gestión de aguas y efluentes líquidos',7,0,0,0,0,1,0.1,'Solicitar registros de capacitación en la gestión de aguas y efluentes líquidos',$oCheckList);

        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Emisiones atmosféricas:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa se encarga de la gestión de las emisiones atmosféricas generadas por sus actividades',7,0,0,0,0,1,0.15,'Verificar que la empresa realice la gestión de las emisiones atmosféricas generados por sus actividades. Si es responsabilidad del cliente, verificarlo con documentación contractual o declarada por el cliente',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa ha identificado los puntos generación de emisiones fijas, móviles y fugitivas (gases de combustión, polvo, material particulado, etc.)',7,0,0,0,0,1,0.15,'Solicitar matriz ambiental o procedimientos en la que se identifiquen los puntos que generen emisiones atmosféricas',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'La empresa aplica controles para mitigar las emisiones atmosféricas generadas por sus actividades',7,0,0,0,0,1,0.15,'Verificar determinación de controles en la matriz ambiental y registros de controles para la mitigación de las emisiones atmosféricas generadas por sus actividades',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Los Check List de los equipos móviles contemplan y registran como desvíos la generación de humo negro',7,0,0,0,0,1,0.15,'Solicitar registros de check list de los equipos móviles que contemple la generación de emisiones atmosféricas y en caso se detecte verifica que se registren y tomen acciones',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'Se identifican los riesgos ambientales y controles asociados a la gestión de emisiones atmosféricas en el IPERC Continuo',7,0,0,0,0,1,0.1,'Solicitar registros de IPERC Continuo en la que se identifiquen riesgos ambientales y se determinen controles asociados a la gestión de emisiones atmosféricas',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'El personal fue entrenado en la gestión de emisiones atmosféricas',7,0,0,0,0,1,0.25,'Solicitar registros de capacitación en la gestión de emisiones atmosféricas',$oCheckList);

        // ------------------------------------------------------------------------------------------------------------


        // GESTIÓN DE CALIDAD

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Gestión de Calidad',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa tiene un Sistema de Gestión de la Calidad certificado',7,0,0,0,0,0,0,'Solicitar certificado de Sistema de Gestión de Calidad certificado',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Si la empresa tiene un Sistema de Gestión de la Calidad certificado, indicar el alcance, vigencia y entidad certificadora:',0,0,0,0,0,1,0.2,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Alcance del certificado:',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Número de Certificado:',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Empresa Certificadora:',1,0,0,0,0,0,0,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Fecha de Vigencia:',5,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tiene la empresa un Manual de Gestión de Calidad, implementado de acuerdo a la norma ISO 9001 u otra norma internacional de calidad',7,0,0,0,0,1,0.5,'Solicitar Manual de Gestión de Calidad',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Si la empresa ha implementado otra norma de gestión de calidad, indicarla:',1,0,0,0,0,0,0,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa tiene una política de calidad enunciada, aprobada por la gerencia general',7,0,0,0,0,1,0.5,'Solicitar política de calidad',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Ha definido objetivos de calidad pertinentes, alineados con las necesidades de la empresa',7,0,0,0,0,1,0.3,'Solicitar objetivos de calidad medibles',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa ha definido e implementado indicadores de gestión  medibles, para la organización; permitiendo monitorear el cumplimiento de los objetivos planteado',7,0,0,0,0,1,0.25,'Indicadores de gestión de calidad',$oCheckList);


        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen un procedimiento escrito e implementado para controlar  la revisión, aprobación, control de cambios e identificación de sus documentos y registros',7,0,0,0,0,1,0.5,'Procedimiento de control de documentos y registros',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa ha designado un representante de la dirección para  asegurar que se haya establecido y se mantenga el Sistema de Gestión de Calidad',7,0,0,0,0,1,0.25,'Reporte de nombramiento de representante de la dirección, revisión de cumplimiento de funciones',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Se realizan periódicamente, revisiones del sistema de gestión, por parte de la gerencia, generando los registros correspondientes',7,0,0,0,0,1,0.5,'Reportes de revisión por la dirección',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Cuando algún material o propiedad del cliente se encuentra temporalmente en las instalaciones de la empresa, este material esta plenamente identificado y se toman las precauciones requeridas para evitar su deterioro',7,0,0,0,0,1,0.25,'Verificar controles de preservación en buen estado de los materiales de propiedad del cliente',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa tiene un procedimiento escrito e implementado, para controlar los servicios no conformes',7,0,0,0,0,1,0.5,'Procedimiento de productos y/o servicios no conformes',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa tiene un procedimiento escrito e implementado para  la generación de acciones correctivas y acciones preventivas, que incluya análisis de causas e implementación de acciones de mejora',7,0,0,0,0,1,0.5,'Procedimiento de acciones correctivas y preventivas',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa tiene un procedimiento escrito e implementado para la realización de auditorias internas, el mismo que incluye registros de auditorias internas y resultados',7,0,0,0,0,1,0.5,'Procedimiento de auditorias internas',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Se han definido las especificaciones de los servicios ofertados',7,0,0,0,0,1,0.25,'Documento de especificaciones de los servicios realizados',$oCheckList);


        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen especificaciones escritas del servicios, identificadas como vigentes y disponibles en los lugares pertinentes',7,0,0,0,0,1,0.25,'Verificar que las especificaciones se encuentren vigentes y disponibles en los lugares de trabajo',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Se encuentra el personal debidamente entrenado y certificado en el trabajo que realizan',7,0,0,0,0,1,0.25,'Registros de capacitación al personal en los servicios que realizan',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Existen procedimientos escritos de trabajo, manuales, instructivos, etc. alineado a una política de Calidad, con registros y trazabilidad',7,0,0,0,0,1,0.25,'Procedimientos escritos de trabajo de acuerdo al servicio realizado',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Utilizan check-list para verificar sus operaciones',7,0,0,0,0,1,0.5,'Registros de check list de verificación de los trabajos',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa tiene un sistema propio de planeamiento y programación de sus obras / servicios (Detallar)',7,0,0,0,0,1,0.25,'Verificar los controles de planeamientos y programación de los servicios',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'En caso sea positiva la respuesta a la pregunta anterior, ¿Utilizan algún software o medio informático para la actividad de planeamiento y programación de sus obras/ servicios?',7,0,0,0,0,1,0.25,'Verificar software utilizado',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa  brinda sus servicios de acuerdo  a una norma nacional o internacional',7,1,0,0,0,1,0.25,'Especificar las normas utilizadas, se cuenta con las normas',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen implantado un procedimiento sistemático para realizar el control de calidad durante el proceso de ejecución del servicio?. Incluyendo, si corresponde, planes de muestreo, criterios de inspección, etc.',7,0,0,0,0,1,0.25,'Registros de control de calidad durante el servicio, check list de inspección, pruebas, protocolos de prueba',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Cuenta con documentos que permitan realizar una trazabilidad / seguimiento / rastreo del servicio brindado',7,0,0,0,0,1,0.25,'Verificar la trazabilidad del producto y servicio, registros de los servicios realizados',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen implantado un procedimiento sistemático para realizar el control de calidad del servicio brindado, una vez finalizado?. Incluyendo, si corresponde, protocolos de pruebas, inspección visual, etc',7,0,0,0,0,1,0.25,'Registros de pruebas y protocolos finales, pruebas en marcha',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'La empresa tiene:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'a) Relación y registros documentados de trabajos y servicios satisfactorios prestados anteriores',7,0,0,0,0,1,0.15,'Relación de servicios realizados',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'b) Registros de la conformidad de clientes',7,0,0,0,0,1,0.1,'Reportes / certificados / constancias de conformidades de los clientes',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'c) Evidencia de experiencia en el rubro',7,0,0,0,0,1,0.05,'Orden de servicio, contratos que evidencie la experiencia ',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'La empresa cumple con:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'a) Realizar las reparaciones de acuerdo a los procedimientos del fabricante, con partes originales y/o homologadas ',7,0,0,0,0,1,0.1,'En caso la empresa realice servicios a sus clientes de mantenimiento, si cuentan con los procedimientos del fabricante',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'b) Tienen registros que evidencien el cumplimiento de las especificaciones técnicas exigidas',7,0,0,0,0,1,0.1,'Solicitar inspecciones, protocolos y pruebas de cumplimiento de las especificaciones técnicas',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Al concluir el trabajo, se entrega al cliente un informe técnico detallado de los trabajos efectuados? (materiales utilizados, protocolos de prueba realizados, tareas adicionales no planificadas, etc.)',7,0,0,0,0,1,0.25,'Solicitar informes de los servicios realizados',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Procesos Subcontratados:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'En los casos en que la organización opte por contratar externamente cualquier proceso que pueda afectar la conformidad del servicio. ¿Se realiza un control de los procesos subcontratados?',7,0,0,0,0,1,0.25,'Solicitar informes, reportes, inspecciones de los trabajos subcontratados',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Gestión Comercial:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa evalúa la satisfacción de sus clientes, guardando registros de dicha actividad',7,0,0,0,0,1,0.15,'Documento de conformidad del servicio/Evaluación de servicio/Encuestas de satisfacción al cliente u otros',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'En caso evalúe la satisfacción del cliente, ¿toma acciones basadas en el resultado de la evaluación realizada?',7,0,0,0,0,1,0.2,'Reportes / informes de evaluación de los resultados de la medición de la satisfacción de sus clientes',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Tienen implantado un procedimiento sistemático para la atención de quejas u observaciones de los clientes',7,0,0,0,0,1,0.3,'Procedimientos y/o registros de quejas u observaciones de los clientes',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa  registra las quejas / observaciones de los clientes  y genera una estadística de las mismas',7,0,0,0,0,1,0.2,'Registro de quejas y estadísticas de las mismas',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Es posible conocer el plazo de entrega y verificar el cumplimiento del mismo, luego de concluido la venta',7,0,0,0,0,1,0.2,'Verificar documento de determinación de los plazos de entrega como contratos, ordenes de servicios',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'La empresa brinda algún tipo de soporte técnico a sus clientes',7,0,0,0,0,1,0.2,'Registros de soporte técnico brindado a sus clientes',$oCheckList);

        // ------------------------------------------------------------------------------------------------------------

        // CALIBRACION DE EQUIPOS Y HERRAMIENTAS

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Calibración de equipos y herramientas',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen definido e implantado un programa de calibración de los instrumentos de medición',7,0,0,0,0,1,1.2,'Solicitar programas de calibración',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Los equipos de medición se encuentran identificados con etiquetas que indiquen cuando fueron calibrados y cuando es su próxima calibración',7,0,0,0,0,1,0.25,'Verificar identificación de calibración en los equipos',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La calibración de los instrumentos de medición se realiza con patrones trazables',7,0,0,0,0,1,0.25,'Verificar identificación de los patrones utilizados en la calibración de sus equipos, y los certificados de calibración de patrones',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Trabaja con herramientas certificadas',7,0,0,0,0,1,0.25,'Solicitar certificados de las herramientas',$oCheckList);

        // ------------------------------------------------------------------------------------------------------------

        // COMPRAS, RECEPCION Y ALMACENAMIENTO

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Compras, Recepcion y Almacenamiento',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'¿La empresa ha implementado un procedimiento sistemático para seleccionar a sus proveedores (de productos y/o servicios), incluyendo criterios de calidad?. Ejm. Referencias comerciales, visita a sus instalaciones, evaluación de gestión, sistemas de calidad certificados, etc.',7,0,0,0,0,1,0.5,'Verificar registros de selección de proveedores',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Se tiene un procedimiento sistemático para la compra de materiales',7,0,0,0,0,1,0.25,'Verificar registros de proceso de compras',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen implantado un procedimiento sistemático de inspección de los materiales e insumos comprados',7,0,0,0,0,1,0.25,'Verificar registros de inspecciones',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Solicitan certificados de calidad por lote de materia prima y/o insumos adquiridos',7,0,0,0,0,1,0.25,'Solicitar certificados de calidad o fichas técnicas de los materiales',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'En el almacén de materias primas e insumos:',0,0,0,0,0,0,0,'Verificar condiciones de almacenaje, verificar área de productos no conformes y hojas de seguridad',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'a) Los productos tienen identificación',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'b) Se mantiene un control de stock, FEFO; FIFO, artículos con caducidad',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'c) Se encuentra organizado y su capacidad es la adecuada, para la cantidad de productos almacenados',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'d) Tiene definida un área de productos no conformes',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'e) Tienen hojas de seguridad de los productos almacenados, cuando estos representan algún tipo de riesgo para la salud o el medioambiente',7,0,0,0,0,1,0.25,'',$oCheckList);


        // ------------------------------------------------------------------------------------------------------------

        // MANTENIMIENTO

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Mantenimiento',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Tienen implantado un programa de mantenimiento preventivo',7,0,0,0,0,1,1,'Solicitar programas de mantenimiento correctivo, preventivo y/o predictivo',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'La empresa cuenta con un programa de mantenimiento (predictivo/correctivo) de sus equipos móviles y estacionarios, y evidencia su cumplimento',7,0,0,0,0,1,0.5,'Solicitar registros de mantenimientos predictivos y correctivos de sus equipos móviles y estacionarios',$oCheckList);
        CrmChecklist::AddNew2($r1,$oFormulario->formID,2,'Se realiza un registro del mantenimiento correctivo de la maquinaria / equipo',7,0,0,0,0,1,0.5,'Verificar registros',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'La empresa cuenta con:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'a) Haber definido indicadores de mantenimiento',7,0,0,0,0,1,0.5,'Solicitar indicadores de mantenimiento',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'b) Analiza el desempeño de indicadores de mantenimiento',7,0,0,0,0,1,0.5,'Reporte de análisis de resultados de indicadores, mediciones realizadas',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'c) Toma acciones correctivas o preventivas en base al análisis de indicadores de mantenimiento',7,0,0,0,0,1,0.5,'Reportes de análisis de mejora en base a resultados de los indicadores',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'La empresa cumple con:',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'a) Realizar las reparaciones de acuerdo a los procedimientos del fabricante, con partes originales y/o homologadas',7,0,0,0,0,1,0.75,'Procedimientos del fabricante',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'b) Tener registros que evidencien el cumplimiento de las especificaciones técnicas exigidas',7,0,0,0,0,1,0.75,'Registros de mantenimientos, check liste de mantenimiento de cumplimiento de las especificaciones técnicas',$oCheckList);


        // ------------------------------------------------------------------------------------------------------------

        // MANUALES

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Manuales',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'La empresa cuenta con:',0,0,0,0,0,0,0,'Manuales Técnicos y disponibles',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'a) Tiene Manuales Técnicos adecuados y actualizados para ejecutar los servicios que ofrecen',7,0,0,0,0,1,1,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'b) Los manuales técnicos están disponibles, en buenas condiciones y rotulados correctamente',7,0,0,0,0,1,0.75,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'c) Aplican los criterios establecidos en los manuales',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'En caso la empresa trabaje con manuales electrónicos, estos son accesibles al personal que realiza las reparaciones',7,0,0,0,0,1,0.125,'Registro e instructivo de acceso:
            Verificar Accesos del personal al manual Técnico Electrónico',$oCheckList);


        // ------------------------------------------------------------------------------------------------------------

        // INSPECCIONES DE CAMPO

        CrmChecklist::AddNew2(0,$oFormulario->formID,1,'Inspección de Campo',0,0,0,0,0,0,0,'',$oCheckList);
        $r1 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Generales',0,0,0,0,0,0,0,'Realizar visita de campo a los lugares de trabajo, talleres, almacenes y demás, y verificar que se cumpla con cada pregunta de acuerdo al tipo de equipo, herramientas con la que se trabaje.1) En caso de inquietudes revisar el manual / instructivo / ficha técnica del equipo y herramienta y corroborar que cumpla con las preguntas del cliente.2) En caso no se utilicen algunos de los equipos, mencionarlo en comentario como NO APLICABLE y se le otorgada el puntaje completo.',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Reunión de seguridad de 5 minutos',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'IPERC o ATS o  para la actividad realizada',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'PETS para la actividad a desarrollar',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Si realiza trabajo de alto riesgo, cuenta con el PETAR firmado por el Supervisor y Jefe de Área',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'El personal sabe como reportar un accidente  o emergencia',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,2,'Correcta segregación de Residuos Sólidos',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Los equipos eléctricos para soldadura tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Mangueras sin empates, línea a tierra',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Codificación',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Extintor de PQS presurizado',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Las botellas de los equipos eléctricos para soldadura tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Carro porta equipo con cadenas para sujetar los balones de gases comprimidos  y llantas en buenas condiciones.',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Retroceso de llama en botella y caña',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Manguera sin empates y con abrazaderas',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Extintor de PQS ',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) Manómetros con cubierta de vidrio',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'f) Inspección mensual',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Los taladros eléctricos y esmeriles tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Guarda',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Enchufes con línea de tierra',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Cables sin empates',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Codificación',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Los Tecles portátiles tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Identificación de tonelaje',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Gancho con seguro',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Cadena de izaje sin signos de oxidación',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Certificación de mantenimiento',7,0,0,0,0,1,0.125,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Herramientas Manuales',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Combas',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Codificación ( no hechizas )',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) De fábrica ',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Mangos en buen estado (no rajados)',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Mangos con seguro',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Tijeras',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Codificación ( no hechizas )',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) De fábrica ',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Los martillos y llaves tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Codificación ( no hechizas )',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) De fábrica ',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Mangos en buen estado (no rajados)',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Mangos con seguro',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Los Cinceles y Puntas tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Codificación ( no hechizas )',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) De fábrica ',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Sin deformación en el extremo del cincel y punta',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'La Llave Francesa y Gatas Hidráulicas tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Codificación ( no hechizas )',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) De fábrica ',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Capacidad de acuerdo al trabajo a realizar (para gatas hidráulicas)',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Las Sierras de Arco tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Codificación ( no hechizas )',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) De fábrica ',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Las extensiones eléctricas tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Cable 3 x  14 AWG. 4',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Enchufe y tomacorriente de 2 P+T',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Las barretas tienen:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Codificación ( no hechizas )',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) De fábrica ',7,0,0,0,0,1,0.125,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Andamios',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Los Andamios cumplen con:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Tener plataformas metálicas, antideslizantes y contar con pasadores',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Tener plataforma de trabajo con barandas a 0.50m y 1.00m y también con rodapiés',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) La base del andamio deberá ser  un elemento regulable, para solucionar los desniveles del piso',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Contar con certificaciones de fabricación y montaje, según normativa europea HD 1000',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) El personal de armado deberá estar capacitado por el proveedor del andamio',7,0,0,0,0,1,0.125,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Escaleras móviles',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Las escaleras móviles:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Son de fibra de vidrio, patas con piso anti deslizante',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Los tipos de escaleras son: Simples, Extensible y tijera',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Están codificadas',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Tienen definida una zona de almacenaje',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) Tienen inspecciones de pre uso',7,0,0,0,0,1,0.1,'',$oCheckList);

        CrmChecklist::AddNew2($r1,$oFormulario->formID,1,'Estándar de EPPs',0,0,0,0,0,0,0,'',$oCheckList);
        $r2 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Respirador de media cara:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) De Silicona, doble vía',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Cumple estándar NIOSH 42 CFR, cumplimiento de normas ANSI  Z88.2 1992  (Comfo II)',7,0,0,0,0,1,0.125,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Cartuchos para gases ácidos vapores orgánicos cumple estándar NIOSH 42 CFR',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Cartuchos tipo P- 100 low Profile contra polvos, neblinas con contenido de asbesto y humos para soldadura',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e) Máscara de soldar donde exista un mínimo de 19.5% de oxígeno, cumple estándar NIOSH 42 CFR',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Casco tipo Jockey:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Cumplimiento de normas ANSI  Z.89.1.1997 Clase E',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Con suspensión tipo Ratcher de 4 puntos y ranuras laterales',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Capacidad dieléctrica hasta 20,000 V',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Lentes con protección lateral:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Cumplimiento de normas ANSI  Z 87.2003',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Luna antiempañante 100% de policarbonato para protección contra proyecciones de impacto, protección UV 400',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Brazos regulables y lunas intercambiables claras',7,0,0,0,0,1,0.1,'',$oCheckList);   
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Guantes:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Soldador Cuero: amarillo Ribeteado sin refuerzo',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Guantes de PVC recubierto con nitrilo, color azul de 10.1/2" de largo con forro interior de algodón; resistente a la abrasión y productos químicos',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Guantes de caucho natural de color azul de 9" de largo, con forro interior de algodón, resistente a la abrasión',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Guantes de Badana sin costura para trabajos de manipuleo de herramientas y otros materiales',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'e)  Guantes de Soldador de  13.78"  de largo, resistente al calor',7,0,0,0,0,1,0.1,'',$oCheckList);        
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Zapatos:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Zapatos punta de acero: Botín de cuero, con puntera de acero, con forro de badana, falsa suela y plantilla de cuero talonera reforzada, pasador de nylon, planta dieléctrica de jebe antideslizante',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Zapatos para Electricistas: con puntera reforzada, forro de badana natural, falsa suela y plantilla de cuero, talonera reforzada, pasador de nylon, planta dieléctrica de jebe antideslizante',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Arneses:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Arnés con Línea de Anclaje / Línea de Vida: Cumplimiento de normas ANSI  Z 359.1 - A. 10.14, tipo paracaídas',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Línea de anclaje con absolvedor de impacto',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Conector de anclaje',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Equipos de protección de soldador:',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) Careta de soldador',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Guantes de soldador de 13.78" resistente al calor',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Mandil  de cuero cromo',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Escarpines de cuero cromo',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r2,$oFormulario->formID,1,'Máscara de protección respiratoria (Canister):',0,0,0,0,0,0,0,'',$oCheckList);
        $r3 = $oCheckList->checkID;
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'a) De cara completa, de dos vías',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'b) Policarbonato antiempañamiento',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'c) Cumplimiento de las normas ANSI Z87.1 y OSHA',7,0,0,0,0,1,0.1,'',$oCheckList);
        CrmChecklist::AddNew2($r3,$oFormulario->formID,2,'d) Cartuchos para gases, polvos y vapores orgánicos, cumple con estándar NIOSH 42 CFR',7,0,0,0,0,1,0.1,'',$oCheckList);


        // ------------------------------------------------------------------------------------------------------------



        return parent::Execute($query);
    }

    public static function  Update($oFormulario){
        $query = "
        UPDATE crm_formulario
        SET title             =   '$oFormulario->title',
        description    =   '$oFormulario->description',
        state           =   '$oFormulario->state'
        WHERE formID ='$oFormulario->formID'";

        return parent::Execute($query);
    }

    public static function  Delete($oFormulario){
        $query = "
        DELETE FROM crm_formulario
        WHERE formID='$oFormulario->formID'";

        return parent::Execute($query);
    }
    
    public static function getState($state){
        switch($state){
            case 1:
            return "Activo"; break;
            case 2:
            return "Bloqueado"; break;
            case 0:
            return "Inactivo"; break;
        }
    }


}

?>



