<?php

class DB {
    private static $instance = null;
    private $mysqli;

    private function __construct($host, $user, $pass, $db) {
        $this->mysqli = new mysqli($host, $user, $pass, $db);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
        $this->mysqli->set_charset("utf8"); // Установка кодировки
    }

    public static function getInstance() {
        if (self::$instance == null) {
            // Замените на ваши учетные данные для базы данных
            self::$instance = new DB("localhost", "root", "", "mysite"); 
        }
        return self::$instance->mysqli; // Возвращаем объект mysqli
    }

    // Методы prepare, query и т.д. теперь вызываются напрямую на объекте mysqli
    public static function prepare($sql) {
      $mysqli = self::getInstance();
      if ($mysqli) return $mysqli->prepare($sql);
      else return false;
    }


    public static function query($sql) {
        $mysqli = self::getInstance();
        if ($mysqli) {
          $result = $mysqli->query($sql);
          if (!$result) die("<br/><span style='color:red'>Ошибка в SQL запросе:</span> " . $mysqli->error);
          return $result;
        }
        return false;


    }




     public static function fetch_object($result) {
        if ($result) return $result->fetch_object();
        else return false;

     }
     public static function fetch_array($result) {
        if ($result) return $result->fetch_array();
        else return false;

     }

     public static function insert_id() {
        $mysqli = self::getInstance();
        if ($mysqli) return $mysqli->insert_id;
        else return false;

     }



}



/*
class DB {
	
	public $connect;

    protected static $_instance;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    private  function __construct() {
        $this->connect = mysqli_connect("localhost", "root", "") or die("Невозможно установить соединение".mysqli_error($this->connect));
        mysqli_select_db( $this->connect, "mysite") or die ("Невозможно выбрать указанную базу".mysqli_error($this->connect));
        $this->query('SET names "utf8"');
    }

    //private function __clone() { //запрещаем клонирование объекта модификатором private
    //}
	public function __clone() { //запрещаем клонирование объекта модификатором private
    }

   // private function __wakeup() {//запрещаем клонирование объекта модификатором private
    //}
	public function __wakeup() {//запрещаем клонирование объекта модификатором private
    }
	
	
	
	  

    public static function query($sql) {

        $obj=self::$_instance;

        if(isset($obj->connect)){
            //$obj->count_sql++;
            //$start_time_sql = microtime(true);
            $result=mysqli_query($obj->connect,$sql)or die("<br/><span style='color:red'>Ошибка в SQL запросе:</span> ".$obj->connect->error);
           // $time_sql = microtime(true) - $start_time_sql;
      //      echo "<br/><br/><span style='color:blue'> <span style='color:green'># Запрос номер ".$obj->count_sql.": </span>".$sql."</span> <span style='color:green'>(".round($time_sql,4)." msec )</span>";

            return $result;
        }
        return false;
    }

    public function __destruct() {
        mysqli_close($this->connect);
    }

    //возвращает запись в виде объекта
    public static function fetch_object($object)
    {
        return @mysqli_fetch_object($object);
    }

    //возвращает запись в виде массива
    public static function fetch_array($object)
    {
        return @mysqli_fetch_array($object);
    }

    //mysql_insert_id() возвращает ID,
    //сгенерированный колонкой с AUTO_INCREMENT последним запросом INSERT к серверу
    public static function insert_id()
    {
        return @mysqli_insert_id();
    }


}*/
