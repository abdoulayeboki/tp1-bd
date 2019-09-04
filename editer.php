<?php
require_once 'charger.php';
$obligatoir="obligatoir!";
$valide="non valide";
$matricule=$_GET['cle'];
$entreprise=new Entreprise();
$donne=$entreprise->afficherUn($matricule);

if(isset($_POST['prenom']) &&
    isset($_POST['nom']) && isset($_POST['salaire']) &&
    isset($_POST['tel']) && isset($_POST['email']) ){
        $donne['prenom']=trim($_POST['prenom']);
        $donne['nom']=trim($_POST['nom']);
        $donne['salaire'] =trim($_POST['salaire']);
        $donne['tel']=trim($_POST['tel']);
        $donne['date']=trim($_POST['date']);
        $donne['email']=trim($_POST['email']);
        $enregistrement=true;
}
?>
 <!DOCTYPE html>
<html>
<head>
        <title>les employers</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style1.css"/>
                 <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
        
    </head>
    <body>
     <header>Bienvenue à Sonatel Academy première école de codage gratuite</header>
     <div class="page">
       <div class="form">
        <form method="post" action="editer.php?cle=<?php echo $matricule ?>">
         <div class="t1">              
        <table >
          <caption> Veuillez modifier l'employer  </caption>
            <tr>
                <td>Matricule</td>
                <td><input class="edit" type="text" name="matricule" readonly="true" value="<?php 
               echo $matricule;
                ?>"/></td>
            </tr>
            <tr>
                <td>Nom</td>
                <td><input class="edit" type="text" name="nom" value="<?php echo $donne['nom'] ?>"/>
                <span class="erreur"><?php 
                if( empty($donne['nom'])){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                  else if(!preg_match("#^[a-zA-zéàâèûôîç]{2,25}$#",$donne['nom'])){
                       echo $valide;
                       $enregistrement=false;
                   }
              ?></span>
            </td>
            </tr>
            <tr>
                <td>Prenom</td>
                <td><input class="edit" type="text" name="prenom"  value="<?php  echo $donne['prenom'] ?>" /> 
                <span class="erreur"><?php 
                if( empty($donne['prenom'])){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                  else if(!preg_match("#^[a-zA-Zéàâèûôîç ]{2,25}$#",$donne['prenom'])){
                    echo $valide;
                       $enregistrement=false;
                   }
              ?></span></td>
            
            </tr>   
            <tr>
                <td>Salaire</td>
                <td><input class="edit" type="text" name="salaire"  value="<?php  echo $donne['salaire']?>" />
                <span class="erreur"><?php
                 if( empty($donne['salaire'])){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                  else if(!preg_match("#^[0-9 ]{5,7}$#",$donne['salaire'])){
                    echo $valide;
                       $enregistrement=false;
                   }
                   else if($donne['salaire']<25000 || $donne['salaire']>2000000){
                    echo "25000 <salaire< 2 000 000";
                    $enregistrement=false;
                }
              ?></span>
            </td>
            </tr>
            <tr>
                <td>Telephon</td>
                <td><input class="edit" type="text" name="tel" placeholder="779530809"  value="<?php  echo $donne['tel'] ?>" />
                <span class="erreur"><?php
                if( empty($donne['tel'])){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                  else if(!preg_match("#^[7]{1}[7860]{1}[-: ]?[0-9]{3}[-: ]?[0-9]{2}[-: ]?[0-9]{2}$#",$donne['tel'])){
                    echo $valide;
                       $enregistrement=false;
                   }
              ?></span>
              </td>
            </tr>
            <tr>
                <td>Date de naissance</td>
                <td><input class="edit" type="text" name="date"  value="<?php  echo $donne['date'] ?>" />
                <span class="erreur"><?php 
                if( empty($donne['date'])){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                  else if(!preg_match("#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#",$donne['date'])) {
                    echo $valide;
                       $enregistrement=false;
                   }?> </span>
              </td>
            </tr> 
            <tr>
                <td>Email</td>
                <td><input class="edit" type="text" name="email"  value="<?php  echo $donne['email']  ?>" />
                <span class="erreur"><?php 
                 
                if( empty($donne['email'])){
                   echo  $obligatoir;
                   $enregistrement=false;
                 }
                  
                 else if(!preg_match("#^[a-z0-9-_.]+@[a-z0-9-_.]{2,}\.[a-z]{2,4}$#",$donne['email'])){
                    echo $valide;
                    $enregistrement=false;
                  }  ?></span> 
              </td>

            </tr>
            <tr>
                <td><button type="submit"  name="submit">Editer</button></td>
            </tr>
            <tr>
                
            </tr>
        </table></div>
</form></div>
 <?php 
     if($enregistrement){
         $entreprise->editer(new Employers($matricule,$donne['nom'],$donne['prenom'],$donne['salaire'],$donne['tel'],$donne['date'],$donne['email']));
         header("location:index.php");
         
    }
   
     ?>
  <div class="t2">
        <table>
        <thead>
                <th>matricule</th>
                <th>prenom</th>
                <th>nom</th>
                <th>salaire</th>
                <th>telephon</th>
                <th>Date de naissance</th>
                <th>Email</th>
                <th>action</th>
       
            </thead>
            <tbody>
                <?php
                $employers=$entreprise->afficherTous();
                foreach( $employers as $ligne){ ?>

                 <tr>
                 <td><?php echo $ligne['matricule'] ?></td>
                  <td><?php echo $ligne['prenom'] ?></td>
                  <td><?php echo $ligne['nom'] ?></td>
                    <td><?php echo $ligne['salaire'] ?></td>
                  <td><?php echo $ligne['tel'] ?></td>
                  <td><?php echo $ligne['date'] ?></td>
                  <td><?php echo $ligne['email'] ?></td>
                  <td><a href="editer.php?cle='<?php echo   $ligne['matricule'] ?>'"><i class="fas fa-pencil-alt"></i></a>
                  <a href="valider.php?cle=<?php echo  $ligne['matricule'] ?>"><i class="fas fa-trash"></i></a></td> 
                 </tr>
                 
                 </tr>
                 <?php   } ?>
            </tbody>
        </table></div>
    
     </div>
     <footer>Copyright Abdoulaye sarr septembre 2019</footer>
</body>
</html> 