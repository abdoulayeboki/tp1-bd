<?php
$obligatoir="obligatoire!";
require_once 'charger.php';
$entreprise=new Entreprise();

if(
   isset($_POST['matricule']) &&
    isset($_POST['prenom']) &&
    isset($_POST['nom']) 
    && isset($_POST['salaire']) &&
   isset($_POST['tel']) && isset($_POST['email']) )
 {
        $matricule=trim($_POST['matricule']);
        $prenom=trim($_POST['prenom']);
        $nom=trim($_POST['nom']);
        $salaire=trim($_POST['salaire']);
        $tel=trim($_POST['tel']);
        $date=trim($_POST['date']);
        $email=trim($_POST['email']);
        $submit=$_POST['submit'];
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
       <div class="form t1" >
        <form method="post" action="index.php">               
        <table >
        <caption>  Veuillez ajouter l'employer  </caption>
            <tr>
                <td>Matricule</td>
                <td><input type="text" name="matricule" readonly="true" value="<?php $nbr=$entreprise->nombreEmployer()+1;
                printf("EM-%05d",$nbr)?>"/></td>
            </tr>
            <tr>
                <td>Nom</td>
                <td><input type="text" name="nom" value="<?php if(isset($nom)) echo $nom; ?>"/>
                <span class="erreur"><?php  if(!isset($prenom)){}
                 else   if( empty($nom)){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                   else if(!preg_match("#^[a-zA-zéàâèûôîç]{2,25}$#",$nom)){
                       echo "non valide";
                       $enregistrement=false;
                   }
              ?></span>
            </td>
            </tr>
            <tr>
                <td>Prenom</td>
                <td><input type="text" name="prenom" value="<?php if(isset($prenom)) echo $prenom; ?>"/> 
                <span class="erreur"><?php if(!isset($prenom)){}
                  else if( empty($prenom)){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                   else if(!preg_match("#^[a-zA-Zéàâèûôîç ]{2,25}$#",$prenom)){
                       echo "non valide";
                       $enregistrement=false;
                   }
              ?></span></td>
            
            </tr>   
            <tr>
                <td>Salaire</td>
                <td><input type="text" name="salaire" value="<?php if(isset($salaire)) echo $salaire; ?>">
                <span class="erreur"><?php if(!isset($salaire)){}
                  else if( empty($salaire)){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                   else if(!preg_match("#^[0-9. ]{5,7}$#",$salaire)){
                       echo "non valide";
                       $enregistrement=false;
                   }
                   else if($salaire<25000 || $salaire>2000000){
                    echo "25 000 < salaire < 2 000 000";
                    $enregistrement=false;
                }
              ?></span>
            </td>
            </tr>
            <tr>
                <td>Telephon</td>
                <td><input type="text" name="tel" placeholder="779530809" value="<?php if(isset($tel)) echo $tel; ?>" >
                <span class="erreur"><?php if(!isset($tel)){}
                  else if( empty($tel)){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                   else if(!preg_match("#^[7]{1}[7860]{1}[-: ]?[0-9]{3}[-: ]?[0-9]{2}[-: ]?[0-9]{2}$#",$tel)){
                       echo "non valide";
                       $enregistrement=false;
                   }
              ?></span>
              </td>
            </tr>
            <tr>
                <td>Date de naissance</td>
                <td><input type="text" name="date" value="<?php if(isset($date)) echo $date; ?>"/>
                <span class="erreur"><?php if(!isset($date)){}
                  else if( empty($date)){
                    echo  $obligatoir;
                    $enregistrement=false;
                  }
                   else if(!preg_match("#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#",$date)) {
                       echo 'date non valide';
                       $enregistrement=false;
                   }?> </span>
              </td>
            </tr> 
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php if(isset($email)) echo $email; ?>">
                <span class="erreur"><?php if(!isset($email)){}
                 
                 else if( empty($email)){
                   echo  $obligatoir;
                   $enregistrement=false;
                 }
                  
                  else if(!preg_match("#^[a-z0-9-_.]+@[a-z0-9-_.]{2,}\.[a-z]{2,4}$#",$email)){
                    echo "email incorrecte";
                    $enregistrement=false;
                  }  ?></span> 
              </td>

            </tr>
            <tr><td></td>
                <td><button type="submit"  name="submit" >Ajouter</button></td> 
            </tr>

        </table><br>
        </form></div>
        <?php 

         // ajout sur l base
         if($enregistrement){
       $entreprise->ajouter(new Employers($matricule,$nom,$prenom,$salaire,$tel,$date,$email));
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
                $donne=$entreprise->afficherTous();
                foreach( $donne as $ligne){ ?>

                 <tr>
                 <td><?php echo $ligne['matricule'] ?></td>
                  <td><?php echo $ligne['prenom'] ?></td>
                  <td><?php echo $ligne['nom'] ?></td>
                    <td><?php echo $ligne['salaire'] ?></td>
                  <td><?php echo $ligne['tel'] ?></td>
                  <td><?php echo $ligne['date'] ?></td>
                  <td><?php echo $ligne['email'] ?></td>
                  <td><a href="editer.php?cle='<?php echo   $ligne['matricule'] ?>'"> <i class="fas fa-pencil-alt"></i></a>
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