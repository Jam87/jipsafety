<?php 
include_once 'conn.php';
include_once 'funciones.php';

$mysqli = $mysqli;

$mysqli->set_charset("utf8");

function view_proveedores($mysqli)
{
	$sql = "CALL sp_purchase_proveedor()";
		
	$html = "";
	$cantidad = 0;
	
	if ($result = $mysqli->query($sql, MYSQLI_STORE_RESULT))
	{
		
		while ($fila = $result->fetch_assoc())
		{
            $html .= '<tr onClick="selectProveedor(this);">';
            $html .= '<td class="codigo">' . $fila["CODIGO"] . '</td>';
            $html .= '<td class="name">' . $fila["NOMBRE"] . '</td>';
            $html .= '<td class="contacto">' . $fila["CONTACTO"] . '</td>';
            $html .= '<td class="pais">' . $fila["PAIS"] . '</td>';
            $html .= '<td class="pago">' . $fila["FORMA_PAGO"] . '</td>';
            $html .= "</tr>";

            $cantidad += 1;

		}
		
		// Liberar MySQL
		clearStoredResults($mysqli);

		$state = "success";
	}
	else
	{
		$state = "alert";
	}
	
	$retorna["state"] = $state;
	$retorna["estructura"] = $html;
	//$retorna["mensaje"] = $query;
	
	return $retorna;	
}

function view_productos_compras($mysqli)
{
	$sql = "CALL sp_purchase_producto()";
		
	$html = "";
	$cantidad = 0;
	
	if ($result = $mysqli->query($sql, MYSQLI_STORE_RESULT))
	{
		
		while ($fila = $result->fetch_assoc())
		{
            $html .= '<tr onClick="selectProducto(this);">';
            $html .= '<td class="codigo">' . $fila["CODIGO"] . '</td>';
            $html .= '<td class="familia">' . $fila["FAMILIA"] . '</td>';
            $html .= '<td class="producto">' . $fila["PRODUCTO"] . '</td>';
            $html .= '<td class="um">' . $fila["UM"] . '</td>';
            $html .= '<td class="altura">' . $fila["ALTURA"] . '</td>';
			$html .= '<td class="largo">' . $fila["LARGO"] . '</td>';
			$html .= '<td class="grosor">' . $fila["GROSOR"] . '</td>';
            $html .= "</tr>";

            $cantidad += 1;

		}
		
		// Liberar MySQL
		clearStoredResults($mysqli);

		$state = "success";
	}
	else
	{
		$state = "alert";
	}
	
	$retorna["state"] = $state;
	$retorna["estructura"] = $html;
	//$retorna["mensaje"] = $query;
	
	return $retorna;	
}

/* ========================================================================================================== */
/* = GESTIÓN DE COMPRAS ===================================================================================== */
/* ========================================================================================================== */
function compra_new($mysqli)
{
	$codigo = generar_codigo($mysqli, "SELECT IFNULL(MAX(pc.cod_compra),0) + 1 AS CODIGO FROM purchase_compras pc;");
	$var_proveedor = $_POST["proveedor"];
	$var_documento = $_POST["documento"];
	$Fecha = $_POST["Fecha"];
	$Moneda = $_POST["Moneda"];
	$var_total = str_replace(",", "", $_POST["total"]);
	$state = "";
	$mensaje = "";
	
	/* INGRESAR DATOS EN LA BASE DE DATOS */
	$sql = " CALL sp_purchase_compras
			(
				" . $codigo . ",
				" . $var_proveedor . ",
				'" . $var_documento . "',
				'" . $Fecha . "',
				" . $Moneda . ",
				1 /*var_cod_sesion*/,
				'INSERTAR' /*var_tipo*/
			); ";
	
	$array  = json_decode($_POST['detalle'], true);
    foreach($array as $value)
    {
		//$mensaje .= $value["precio"];
        $sql .= "CALL sp_purchase_compras_productos
                (
                    " . $codigo . ",
                    '" . $value["codigo"] . "',
                    " . $value["cantidad"] . ",
                    NULL /*var_cod_color_dn*/,
                    NULL /*var_descripcion_dn*/,
                    NULL /*var_arancel_dn*/,
					NULL /*var_peso_neto_dn*/,
                    " . $value["precio"] . ",
					NULL /*var_impuesto_dn*/,
                    " . ($value["cantidad"] * $value["precio"]) . "
                );";
    }
	
	if ($mysqli->multi_query($sql))
	{
		clearStoredResults($mysqli);

		$state = "success";
		$msg = "La transacción finalizo correctamente.";
	}
	else
	{
		$state = "alert";
		$msg = "Falló la multiconsulta: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	$retorna["state"] = $state;
	$retorna["mensaje"] = $mensaje;
	//$retorna["mensaje"] = $sql;
	
	return $retorna;	
}

/* ========================================================================================================== */
/* = VALIDACIONES DE CAMPOS ================================================================================= */
/* ========================================================================================================== */
function MyIsNull($value)
{
	if($value !== '')
	{
		return "'$value'";
	} 
	else
	{
		return "NULL";
	}
}

function MyBolean($value)
{
	if($value == 'on')
	{
		return 1;
	} 
	else
	{
		return 0;
	}
}

function generar_codigo($mysqli, $sql)
{	
	
	if ($result = $mysqli->query($sql, MYSQLI_STORE_RESULT))
	{
		$fila = $result->fetch_assoc();
			
		$retorna = $fila["CODIGO"];
			
		// Liberar MySQL
		clearStoredResults($mysqli);
	}
	else
	{
		$retorna = "";
	}
	
	
	return $retorna;	
}


if ( isset($_POST["type"]) )
{
	
	/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	switch ($_POST["type"])
	{
		case "view_proveedores":
			$datos = view_proveedores($mysqli);
			
			break;
			
		case "view_productos_compras":
			$datos = view_productos_compras($mysqli);
			
			break;
			
		case "compra_new":
			$datos = compra_new($mysqli);
			
			break;
			
		default:
			$datos = null;
			
	}
	/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		
}
else
{
	$datos = null;
}

echo json_encode($datos);

?>