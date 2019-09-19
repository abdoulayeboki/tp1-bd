<?php
require_once 'charger.php';
$cle=$_GET['cle'];
$oui=isset($_POST['oui'])?$_POST['oui']:null;


if($oui=='oui')
{
    $employers=new Entreprise();
    $employers->supprimer($cle);
   }
   
    header("location:index.php");
    ?>