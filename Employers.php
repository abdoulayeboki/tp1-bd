<?php

class Employers{
   public $matricule;
    public $nom;
    public $prenom;
     public $salaire;
     public $tel;
     public $date;
    public $email;
    public function __construct($matricule,$nom,$prenom,$salaire,$tel,$date,$email){
       $this->matricule=$matricule;
        $this->nom=$nom;
        $this->prenom=$prenom;
         $this->salaire=$salaire;
         $this->tel=$tel;
         $this->date=$date;
         $this->email=$email;
    }
    
    
    
}