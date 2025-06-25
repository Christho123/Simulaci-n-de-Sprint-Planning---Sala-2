<?php
class ConexionDB {
    private static $host = "localhost";
    private static $puerto = "1521";
    private static $sid = "XE";
    private static $usuario = "SimulacionDB";
    private static $clave = "Simulacion";

    public static function conectar() {
        $cadenaConexion = "(DESCRIPTION =
            (ADDRESS = (PROTOCOL = TCP)(HOST = " . self::$host . ")(PORT = " . self::$puerto . "))
            (CONNECT_DATA =
              (SERVER = DEDICATED)
              (SID = " . self::$sid . ")
            )
        )";

        $conn = oci_connect(self::$usuario, self::$clave, $cadenaConexion, 'AL32UTF8');

        if (!$conn) {
            $e = oci_error();
            echo "Error de conexión: " . $e['message'];
            return null;
        }

        return $conn;
    }
}

// Prueba de conexión
$conn = ConexionDB::conectar();

if ($conn) {
    echo "✅ Conexión exitosa a Oracle";
    oci_close($conn);
} else {
    echo "❌ Error al conectar con Oracle";
}
?>
