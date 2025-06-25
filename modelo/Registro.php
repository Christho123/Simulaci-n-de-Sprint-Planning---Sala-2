<?php
require_once __DIR__ . '/../config/ConexionDB.php';

class Registro {
    private $conn;

    public function __construct() {
        $this->conn = ConexionDB::conectar();
    }

    public function insertarRegistro($datos) {
        $sql = "INSERT INTO registro (
                    id_registro, nombre, apellido, tipo_documento, cod_documento,
                    correo, telefono, genero, especialidad, nombre_doctor, hora_cita
                ) VALUES (
                    SEQ_REGISTRO.NEXTVAL, :nombre, :apellido, :tipo_documento, :cod_documento,
                    :correo, :telefono, :genero, :especialidad, :nombre_doctor, TO_DATE(:hora_cita, 'YYYY-MM-DD HH24:MI')
                )";

        $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ':nombre',         $datos['nombre']);
        oci_bind_by_name($stmt, ':apellido',       $datos['apellido']);
        oci_bind_by_name($stmt, ':tipo_documento', $datos['tipo_documento']);
        oci_bind_by_name($stmt, ':cod_documento',  $datos['cod_documento']);
        oci_bind_by_name($stmt, ':correo',         $datos['correo']);
        oci_bind_by_name($stmt, ':telefono',       $datos['telefono']);
        oci_bind_by_name($stmt, ':genero',         $datos['genero']);
        oci_bind_by_name($stmt, ':especialidad',   $datos['especialidad']);
        oci_bind_by_name($stmt, ':nombre_doctor',  $datos['nombre_doctor']);
        oci_bind_by_name($stmt, ':hora_cita',      $datos['hora_cita']);

        $resultado = oci_execute($stmt);

        if (!$resultado) {
            $e = oci_error($stmt);
            return ['success' => false, 'error' => $e['message']];
        }

        oci_free_statement($stmt);
        return ['success' => true];
    }
}
?>
