<?php
require_once 'charger.php';
class Entreprise{ 
    public function ajouter(Employers $em){  
        $bdd=Connexion::getInstance()->getConnexion();
        $req="insert into employer (matricule,nom,prenom,salaire,tel,date,email) 
values(:matricule,:nom,:prenom,:salaire,:tel,:date,:email)";
        $reponse=$bdd->prepare($req);
        $reponse->execute(array(
            'matricule'=>"$em->matricule",
            'nom'=>"$em->nom",
            'prenom'=>"$em->prenom",
            'salaire'=>"$em->salaire",
            'tel'=>"$em->tel",
            'date'=>"$em->date",
            'email'=>"$em->email"
        ));
    }
    public function afficherTous(){
        $bdd=Connexion::getInstance()->getConnexion();
        $req="select * from employer";
        $reponse=$bdd->query($req);
        $donne=$reponse->fetchall();
        return  $donne;
    }
   
    public function afficherUn($m){
        $bdd=Connexion::getInstance()->getConnexion();
        $req="select * from employer where matricule=$m";
        $reponse=$bdd->query($req);
        $donne=$reponse->fetch();
        return  $donne;
    }
    public function editer(Employers $em){
        $bdd=Connexion::getInstance()->getConnexion();
        $req="update  employer  
           set nom=:nom , prenom=:prenom ,salaire=:salaire,tel=:tel,date=:date, email=:email
           where matricule=$em->matricule";
        $reponse=$bdd->prepare($req);
        $reponse->execute(array(
            'nom'=>$em->nom,
            'prenom'=>$em->prenom,
            'salaire'=>$em->salaire,
            'tel'=>$em->tel,
            'date'=>$em->date,
            'email'=>$em->email
        ));
       
    }
    public function supprimer($m){
        $bdd=Connexion::getInstance()->getConnexion();
        $req="DELETE from employer where matricule='$m'";
        $reponse=$bdd->query($req);
        $donne=$reponse->fetch();
        return  $donne;
    }
    public function nombreEmployer(){
        $bdd=Connexion::getInstance()->getConnexion();
        $req="select COUNT(matricule) as nbr from employer";
        $reponse=$bdd->query($req);
        $donne=$reponse->fetch();
        return  $donne['nbr'];
    }
    
}
