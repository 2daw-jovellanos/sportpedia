<?php
require_once "OrmException.php";

/**
 * Clase para conectar a la BD y realizar operaciones simples.
 * Para ser usada por los mapeadores.
 * 
 * Uso:
 * <ul>
 *   <li>Inicializa: <code> Bd::init(host, user, pass, dbname) </code></li>
 *   <li>Obtén la instancia: <code> $bd = Bd::getInstance()</code></li>
 *   <li>Usa 
 *     <ul>
 *       <li>-<code>query</code> y <code>queryOne</code> para una select</li>
 *       <li>-<code>execute</code> con sentencias que no devuelven datos</li>
 *     </ul>
 *   </li>
 * </ul>
 * 
 * La conexión se cierra en el destructor.
 * Esta clase es un <strong>singleton</strong>. Hay una sola instancia, y tiene una sola conexión.
 */
class Bd
{

    /** La conexión al SGBD */
    private $conn;
    /** el último id en un insert con AUTO_INCREMENT */
    private $insertId = 0;
    /** La propia instancia de esta clase. Patrón singleton */
    private static $instance = null;

    /** Dato de configuración. El host de mysql. Se inicializa con self::init() */
    public static $host = 'localhost';
    /** Dato de configuración. El usuario de mysql. Se inicializa con self::init() */
    public static $user;
    /** Dato de configuración. La contraseña de mysql. Se inicializa con self::init() */
    public static $pass;
    /** Dato de configuración. El nombre de la bd de mysql. Se inicializa con self::init() */
    public static $dbname = '';
    /** Dato de configuración. El puerto de mysql. Se inicializa con self::init() */
    public static $port = 3306;

    /**
     * Inicializa los parámetros de conexión, Usar en primer lugar.
     *
     * @param string $host El host donde se encuentra mysql
     * @param string $user Usuario con permisos de acceso
     * @param string $pass Contraseña
     * @param string $dbname Nombre de la BD a conectar
     * @param integer $port El puerto (por defecto el 3306)
     */
    public static function init($host, $user, $pass, $dbname, $port = 3306)
    {
        self::$host = $host;
        self::$user = $user;
        self::$pass = $pass;
        self::$dbname = $dbname;
        self::$port = $port;
    }


    /**
     * Obtiene la instancia
     *
     * @return Bd Devuelve una instancia única de esta clase.
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Bd();
        }
        return self::$instance;
    }

    /**
     * Construye la instancia.
     * Obtiene conexión a la BD y fija codificación UTF8
     * 
     * Es privado para que no pueda utilizarse externamente (patrón singleton).
     * @throws OrmException Lanza excepción ante fallo en conexión.
     */
    private function __construct()
    {
        $this->conn = new mysqli(self::$host, self::$user, self::$pass, self::$dbname, self::$port);
        if ($this->conn->connect_error) {
            throw new OrmException('No se pudo conectar a la BD: ' . $this->conn->connect_error);
        }
        $this->conn->query("SET NAMES 'utf8'");
    }

    /**
     * Obtener la conexión
     *
     * @return mysqli Una conexión con mysqli
     */
    public function getConnection()
    {
        return $this->conn;
    }

    /**
     * Método auxiliar para preparar una sentencia. 
     * NO USAR DIRECTAMENTE
     *
     * @param string $sql
     * @param array $params
     * @return mysqli_stmt Sentencia preparada de mysqli
     * @throws OrmException Lanza excepción ante fallo en sql, parámetros o envío.
     * @link https://www.php.net/manual/es/class.mysqli-stmt.php
     */
    private function executePrepared($sql, $params)
    {
        $this->insertId = 0;
        $stmt = false;
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new OrmException('Error en preparación sql. Revise SQL y parámetros.');
        }
        $types = ""; // los tipos se infieren del array de parámetros. Solo string, integer y double
        foreach ($params as $param) {
            switch (gettype($param)) {
                case 'double':
                    $types .= 'd';
                    break;
                case 'integer':
                    $types .= 'i';
                    break;
                case 'string':
                    $types .= 's';
                    break;
                default:
                    throw new OrmException("Error en bind. No se admite el tipo del parámetro $param");
            }
        }
        if (strlen($types) && !$stmt->bind_param($types, ...$params)) {
            throw new OrmException('Error en bind. Revise SQL y parámetros: ' . $stmt->error);
        };
        if (!$stmt->execute()) {
            throw new OrmException('Error en ejecucición sql. Revise SQL y parámetros: ' . $stmt->error);
        }
        return $stmt;
    }

    /**
     * Envía una query tipo SELECT para su ejecución.
     * Devuelve un array, de arrays asociativos, o un array de objetos de una clase.
     *
     * @param string $sql La select con placeholders
     * @param array $params Array de parámetros, para sustitutuir los placeholders con ellos
     * @param string $classname Opcional. Si se pasa, se devuelve un array de objeto de esa clase. 
     *            Si no, un array de arrays asociativos que representan filas.
     * @return array Un array de objetos o de arrays asociativos.
     */
    public function query(string $sql, array $params = [], string $classname = '')
    {
        $stmt = $this->executePrepared($sql, $params);
        $resultset = $stmt->get_result();
        $resultado = [];
        $row = true;
        do {
            if ($classname) {
                $row = $resultset->fetch_object($classname);
            } else {
                $row = $resultset->fetch_assoc();
            }
            if ($row) {
                if (isset($row->id)) {
                    $resultado[$row->id] = $row;
                } else {
                    array_push($resultado, $row);
                }
                
            }
        } while ($row);
        $stmt->close();
        return $resultado;
    }

    /**
     * Envía una query tipo SELECT para su ejecución, de la que esperamos una sola fila de resultado como máximo.
     *
     * @param string $sql La select con placeholders
     * @param array $params Array de parámetros para sustituir a los placelholders
     * @param string $classname Si se pasa, el resultado es un objeto de esta clase.
     * @return mixed Si se pasa un nombre de clase, se devuelve el resultado en un objeto de esa clase, si no,
     *     se devuelve la fila como un array asociativo.
     */
    public function queryOne(string $sql, array $params = [], string $classname = '')
    {
        $r = $this->query($sql . " LIMIT 1", $params, $classname);
        if (count($r)) {
            return $r[0];
        } else {
            return false;
        }
    }

    /**
     * Ejecuta una sentencia que no devuelve datos (es decir, no una SELECT)
     *
     * @param string $sql La sentencia, con placeholders
     * @param array $params Los parámetros, para sustituir a los placeholders
     * @return int El número de filas afectadas por la sentencia
     */
    public function execute(string $sql, array $params = [])
    {
        $stmt = $this->executePrepared($sql, $params);
        $affected_rows = $stmt->affected_rows;
        $this->insertId = $stmt->insert_id;
        $stmt->close();
        return $affected_rows;
    }

    /**
     * Si la ultima sentencia fue un insert con PK con auto_increment
     * devuelve el id que asignó el SGBD.
     *
     * @return mixed el último id asignado en un insert con auto_increment
     */
    public function getInsertId()
    {
        return $this->insertId;
    }


    /**
     * El destructor cierra la conexión.
     */
    public function __destruct()
    {
        $this->conn->close();
    }
}
