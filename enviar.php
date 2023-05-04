<?php
$nombre_archivo = $_FILES['imagen']['name'];
$tipo_archivo = $_FILES['imagen']['type'];
$tamano_archivo = $_FILES['imagen']['size'];
$titulo = $_POST['titulo'];
$sector = $_POST['sector'];
$descripcion = $_POST['descripcion'];
$enlaces = $_POST['enlaces'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$puesto = $_POST['puesto'];
$requisitos = $_POST['requisitos'];
$funciones = $_POST['funciones'];

// Validación de tamaño de archivo
if ($tamano_archivo > 100000) {
	echo "Error: la imagen es demasiado grande.";
	exit();
}

// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "feria";

$con = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);
if (mysqli_connect_errno()) {
	echo "Error al conectar a la base de datos: " . mysqli_connect_error();
	exit();
}

// Preparación de la consulta SQL
$sql = "INSERT INTO empleos (imagen, titulo, sector, descripcion, enlaces, nombre, correo, telefono, puesto, requisitos, funciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "sssssssssss", $nombre_archivo, $titulo, $sector, $descripcion, $enlaces, $nombre, $correo, $telefono, $puesto, $requisitos, $funciones);

// Ejecución de la consulta SQL
if (mysqli_stmt_execute($stmt)) {
	echo "Datos insertados correctamente.";
} else {
	echo "Error al insertar los datos: " . mysqli_error($con);
}

// Cierre de la conexión y liberación de memoria
mysqli_stmt_close($stmt);
mysqli_close($con);
?>