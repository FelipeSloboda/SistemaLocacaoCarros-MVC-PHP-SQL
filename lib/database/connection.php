<?php 
    abstract class Connection{
        private static $conn;
        public static function getStringConn(){
            if(self::$conn == null){
                self::$conn = new PDO("mysql:host=localhost; dbname=locacao","root","");
            }
            return self::$conn;
        }

    }
?>