<?php
require_once("base/Database.php");

class WebLogin extends Database
{
	private static $oCliente;
	private static $oProveedor;
	private static $oAdmin;

	public static function LogonCliente($email, $password, $rememberMe=false)
	{
		self::$oCliente=CrmCliente::getItem_Login($email, $password);
		if(self::$oCliente!=NULL){
			self::RegClienteSession($rememberMe);
			return true;
		}
		else 
			return false;
	}

	public static function LogonProveedor($email, $password, $rememberMe=false)
	{
		self::$oProveedor=CrmProveedor::getItem_Login($email, $password);
		if(self::$oProveedor!=NULL){
			self::RegProveedorSession($rememberMe);
			return true;
		}
		else 
			return false;
	}

	public static function LogonAdmin($email, $password, $rememberMe=false)
	{
		self::$oAdmin=AdmUser::getItem_Login($email, $password);
		if(self::$oAdmin!=NULL){
			self::RegAdminSession($rememberMe);
			return true;
		}
		else 
			return false;
	}

	public static function getClienteSession()
	{
		self::$oCliente=self::isLoggedCliente() ? unserialize($_SESSION['CLIENTE_INFO']) : NULL;
		return self::$oCliente;
	}

	public static function getProveedorSession()
	{
		self::$oProveedor=self::isLoggedProveedor() ? unserialize($_SESSION['PROVEEDOR_INFO']) : NULL;
		return self::$oProveedor;
	}

	public static function getAdminSession()
	{
		self::$oAdmin=self::isLoggedAdmin() ? unserialize($_SESSION['ADMIN_WEB']) : NULL;
		return self::$oAdmin;
	}


	public static function setClienteSession($oCliente)
	{
		self::$oCliente=$oCliente;
		return self::RegClienteSession();
	}

	public static function setProveedorSession($oProveedor)
	{
		self::$oProveedor=$oProveedor;
		return self::RegProveedorSession();
	}

	public static function setAdminSession($oAdmin)
	{
		self::$oAdmin=$oAdmin;
		return self::RegAdminSession();
	}

	public static function RegClienteSession($rememberMe=false)
	{
		$_SESSION['CLIENTE_INFO']=serialize(self::$oCliente);
		if($rememberMe){
			$expire=time()+(3600*24*365);
			setcookie('CLIENTE_INFO', serialize($_SESSION['CLIENTE_INFO']), $expire, '/');
		}
	}

	public static function RegProveedorSession($rememberMe=false)
	{
		$_SESSION['PROVEEDOR_INFO']=serialize(self::$oProveedor);
		if($rememberMe){
			$expire=time()+(3600*24*365);
			setcookie('PROVEEDOR_INFO', serialize($_SESSION['PROVEEDOR_INFO']), $expire, '/');
		}
	}

	public static function RegAdminSession($rememberMe=false)
	{
		$_SESSION['ADMIN_WEB']=serialize(self::$oAdmin);
		if($rememberMe){
			$expire=time()+(3600*24*365);
			setcookie('ADMIN_WEB', serialize($_SESSION['ADMIN_WEB']), $expire, '/');
		}
	}
	
	//BORRA TODAS LAS SESIONES
	public static function UnregisterUser()
	{
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}		
		$_SESSION['CLIENTE_INFO']=NULL;
		$_SESSION['PROVEEDOR_INFO']=NULL;
		$_SESSION['ADMIN_WEB']=NULL;
	}

	public static function isLoggedCliente()
	{
		if(isset($_COOKIE['CLIENTE_INFO'])) $_SESSION['CLIENTE_INFO']=$_COOKIE['CLIENTE_INFO'];
		
		return isset($_SESSION['CLIENTE_INFO']);
	}

	public static function isLoggedProveedor()
	{
		if(isset($_COOKIE['PROVEEDOR_INFO'])) $_SESSION['PROVEEDOR_INFO']=$_COOKIE['PROVEEDOR_INFO'];
		
		return isset($_SESSION['PROVEEDOR_INFO']);
	}

	public static function isLoggedAdmin()
	{
		if(isset($_COOKIE['ADMIN_WEB'])) $_SESSION['ADMIN_WEB']=$_COOKIE['ADMIN_WEB'];
		
		return isset($_SESSION['ADMIN_WEB']);
	}
}

?>