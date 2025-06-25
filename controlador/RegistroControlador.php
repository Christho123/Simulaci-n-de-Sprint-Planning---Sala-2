<?php
require_once __DIR__ . '/../modelo/Registro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registro = new Registro();

    $datos = [
        'nombre'         => $_POST['nombre'] ?? '',
        'apellido'       => $_POST['apellido'] ?? '',
        'tipo_documento' => $_POST['tipo_documento'] ?? '',
        'cod_documento'  => $_POST['cod_documento'] ?? '',
        'correo'         => $_POST['correo'] ?? '',
        'telefono'       => $_POST['telefono'] ?? '',
        'genero'         => $_POST['genero'] ?? '',
        'especialidad'   => $_POST['especialidad'] ?? '',
        'nombre_doctor'  => $_POST['nombre_doctor'] ?? '',
        'hora_cita'      => $_POST['hora_cita'] ?? '' // Formato: YYYY-MM-DD HH:MI
    ];

    $resultado = $registro->insertarRegistro($datos);
    echo json_encode($resultado);
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>
