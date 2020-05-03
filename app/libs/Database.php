<?php
  // clase para conectarse a la base de datos y ejecutar consultas PDO

  class Database{
    private $host = DB_HOST;
    private $usuario = DB_USUARIO;
    private $password = DB_PASSWORD;
    private $nombre_base = DB_NBD;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
      //configurar conexion
      $dsn = 'mysql:host='. $this->host .';dbname='. $this->nombre_base;
      $opciones = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE =>  PDO::FETCH_OBJ
      );

      try{
        $this->dbh = new PDO($dsn, $this->usuario, $this ->password, $opciones);
        $this->dbh->exec('set names utf8');
      }catch(PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
      }
    }

    //Preparamos la Consulta
    public function query($sql){
      $this->stmt = $this->dbh->prepare($sql);
    }

  //Ejecutamos la Consulta
    public function execute(){
      return $this->stmt->execute();
    }
  //obterner los registros
    public function registros(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
  }
?>