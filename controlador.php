<?php

if (session_status() == PHP_SESSION_NONE)
		 session_start();

	include ("modelo.php");
	include ("vista.php");

	if (isset($_GET["accion"])) {
		$accion = $_GET["accion"];
	} else {
		if (isset($_POST["accion"])) {
			$accion = $_POST["accion"];
		} else {
			$accion = "index";
		}
	}

	if (isset($_GET["id"])) {
		$id = $_GET["id"];
	} else {
		if (isset($_POST["id"])) {
			$id = $_POST["id"];
		} else {
			$id = 1;
		}
	}
	if ($accion == "index") {
		switch ($id) {
			case 1:
				//Mostramos el menu
				vMostrarIndice();
				break;
		}
	}

	if ($accion == "registro") {
		switch ($id) {
			case 1:
				vMostrarRegistro();
				break;

		case 2://register Failed
				vMostrarRegistroFail();
				break;
		}
	}

	if ($accion == "login") {
		switch ($id) {
			case 1:
				vMostrarLogin();
				break;
			case 2://login fail
				vMostrarLoginFail();
				break;
			case 3://logout
				unset($_SESSION['usuario']);
				vMostrarIndice();
		}
	}

	if ($accion == "catalogo") {
		switch ($id) {
			case 1:
				vMostrarCatalogo();
				break;
		}
	}

	if ($accion == "localizacion") {
		switch ($id) {
			case 1:
				vMostrarLocalizacion();
				break;
		}
	}

	if ($accion == "servicios") {
		switch ($id) {
			case 1:
				vMostrarServicios();
				break;
		}
	}

	if ($accion == "usuario") {
		switch ($id) {
			case 1:
				vMostrarUser();
				break;
		}
	}

	if ($accion == "admin") {
		switch ($id) {
			case 1:
				vMostrarAdmin();
				break;
		}
	}

	if ($accion == "producto") {
		if (isset($_GET["producto"])) {
			$producto = $_GET["producto"];
		} else {
			if (isset($_POST["producto"])) {
				$producto = $_POST["producto"];
			} else {
				$producto = 0;
			}
		}
		switch ($id) {
			case 1:
				$resultado=mMostrarProducto($producto);
				$datos=mObtenerComentarios($producto);
				vMostrarProducto($id,$resultado,$datos);
				break;
		}
	}
	if ($accion == "legal") {
		switch ($id) {
			case 1:
				vMostrarLegal();
				break;
		}
	}

	if ($accion == "nuevo") {
		switch ($id) {
			case 1:
				vMostrarNuevo();
				break;
		}
	}

	if ($accion == "modificar") {
		switch ($id) {
			case 1:
				vMostrarModificar();
				break;
		}
	}

	if ($accion == "nuevocomentario"){
		switch ($id) {
			case 1:
				if (session_status() == PHP_SESSION_NONE)
					session_start();
				if(isset($_SESSION["usuario"]))
					$usuario = $_SESSION["usuario"];
				if (isset($_POST["comentario"])&&(!empty($_POST["comentario"]))) {
				   $comentario=$_POST["comentario"];
				}else{
				   die();
				}
				if (isset($_POST["id"])&&(!empty($_POST["id"]))) {
				   $id=$_POST["id"];
				}else{
				   die();
				}
				mNuevoComentario($id, $comentario, $usuario);
				$resultado=mMostrarProducto($producto);
				$datos=mObtenerComentarios($producto);
				vMostrarProducto($id,$resultado,$datos);
				break;

			default:
				break;
		}
	}

	if ($accion == "mlogin") {
		switch ($id) {
			case 1:
				if (isset($_POST["password"])) {
				   $password = $_POST["password"];
				}else{
				   vMostrarLoginFail();

				}
				if (isset($_POST["email"])) {
					 $email = $_POST["email"];
				}else{

				}
				if (mLogin($email, $password)==0)
					vMostrarIndice();
				else {
					vMostrarLoginFail();
				}

				break;

			default:
				# code...
				break;
		}
	}

	if ($accion == "mregistro") {
		switch ($id) {
			case 1:
				if (isset($_POST["user"])) {
				   $usuario = $_POST["user"];
				}else {
				   vMostrarRegistroFail();
				}
				if (isset($_POST["password"])) {
				   $passwordnohash = $_POST["password"];
				   $password=password_hash($passwordnohash,CRYPT_BLOWFISH);
				}else{
				   vMostrarRegistroFail();
				}
				if (isset($_POST["email"])) {
				   if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					 $email = $_POST["email"];
				   }else {
					 vMostrarRegistroFail();
				   }
				}else{
				   vMostrarRegistroFail();
				}
				if (isset($_POST["direccion"])) {
				   $direccion = $_POST["direccion"];
				}else{
				   vMostrarRegistroFail();
				}
				if (isset($_POST["nombre"])) {
				   $nombre = $_POST["nombre"];
				}else{
				   vMostrarRegistroFail();
				}
				if (mRegistro($usuario, $password, $email, $direccion, $nombre) == 0) {
					mLogin($email, $passwordnohash);
					vMostrarIndice();
				}
				else
					vMostrarRegistroFail();
				break;

			default:
				# code...
				break;
		}
	}

	if ($accion == 'pdf') {
		switch ($id) {
			case 1:
				mPdf();
				break;

			default:
				# code...
				break;
		}
	}

?>
