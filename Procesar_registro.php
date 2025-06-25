<?php
require_once 'ConexionDB.php'; // Incluye la clase de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_registro    = $_POST['id_registro'];
    $nombre         = $_POST['nombre'];
    $apellido       = $_POST['apellido'];
    $tipo_documento = $_POST['tipo_documento'];
    $cod_documento  = $_POST['cod_documento'];
    $correo         = $_POST['correo'];
    $telefono       = $_POST['telefono'];
    $genero         = $_POST['genero'];
    $especialidad   = $_POST['especialidad'];
    $nombre_doctor  = $_POST['nombre_doctor'];
    $hora_cita      = $_POST['hora_cita']; // formato: "YYYY-MM-DDTHH:MM"
    
    // Conexión a la base de datos
    $conn = ConexionDB::conectar();

    if ($conn) {
        // Convertir la fecha y hora a formato Oracle
        $hora_cita_oracle = "TO_DATE('" . date("d-m-Y H:i:s", strtotime($hora_cita)) . "', 'DD-MM-YYYY HH24:MI:SS')";

        // Preparar la consulta
        $sql = "INSERT INTO registro (
                    id_registro, nombre, apellido, tipo_documento,
                    cod_documento, correo, telefono, genero,
                    especialidad, nombre_doctor, hora_cita
                ) VALUES (
                    :id_registro, :nombre, :apellido, :tipo_documento,
                    :cod_documento, :correo, :telefono, :genero,
                    :especialidad, :nombre_doctor, $hora_cita_oracle
                )";

        $stmt = oci_parse($conn, $sql);

        // Asociar variables
        oci_bind_by_name($stmt, ":id_registro", $id_registro);
        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":apellido", $apellido);
        oci_bind_by_name($stmt, ":tipo_documento", $tipo_documento);
        oci_bind_by_name($stmt, ":cod_documento", $cod_documento);
        oci_bind_by_name($stmt, ":correo", $correo);
        oci_bind_by_name($stmt, ":telefono", $telefono);
        oci_bind_by_name($stmt, ":genero", $genero);
        oci_bind_by_name($stmt, ":especialidad", $especialidad);
        oci_bind_by_name($stmt, ":nombre_doctor", $nombre_doctor);

        // Ejecutar
        $resultado = oci_execute($stmt);

        if ($resultado) {
            echo "<h3>✅ Registro guardado exitosamente.</h3>";
        } else {
            $error = oci_error($stmt);
            echo "<h3>❌ Error al guardar: " . $error['message'] . "</h3>";
        }

        // Cerrar conexión
        oci_free_statement($stmt);
        oci_close($conn);
    } else {
        echo "<h3>❌ No se pudo conectar a la base de datos.</h3>";
    }
}
?>
