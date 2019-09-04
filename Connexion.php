<?php
class Connexion{
   
    private static   $instance=false;
    protected $connexion;
    
    private function __construct() {
       try {
           $this->connexion = new PDO("mysql:host=localhost;dbname=employers",'sarr','talesboki');
       } catch (Exception $e) {
           die ('Erreur'.$e->getMessage());
       }
       }
       
    public static function getInstance() {
        if(self::$instance==false)  {
                self::$instance=new self();
        }
        return self::$instance;
    }
    
    public function getConnexion()
    {
        return $this->connexion;
    }
}