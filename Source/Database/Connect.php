<?php

namespace Source\Database;

use PDO;
use PDOException;

class Connect
{
    private const HOST = "localhost"; // Postgres "localhost\\SQLEXPRESS";
    private const DBNAME = "jcl_tecno"; // Postgres "fsphp";
    private const DBUSER = "postgres"; // Postgres "project";
    private const DBPASS = "gaproject"; // Postgres "Jrdbsql";
    private const OPTION = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    protected static $conn;

    /**
     * @return PDO
     */
    public static function getConn(): ?PDO
    {
        if(empty(self::$conn)) {
            try {
                self::$conn = new PDO(
                    "pgsql:host=" . self::HOST . ";dbname=" . self::DBNAME, self::DBUSER, self::DBPASS, self::OPTION
                    //"sqlsrv:Database=".self::DBNAME.";server=".self::HOST, self::DBUSER, self::DBPASS
                );
                return self::$conn;
            } catch (PDOException $exception) {
                die("<h3>Erro ao conectar no banco de dados!</h3><br>");
            }
        }
        return self::$conn;
    }
}