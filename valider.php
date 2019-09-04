<?php
$cle=$_GET['cle'];
?>
<!DOCTYPE HTML>
<html>
<meta charset="utf-8"/>
<title>calculatrice</title>
<link rel="stylesheet" href="css/style.css"/> 
<body>
<div class="page">
    <form method="post" action="supprimer.php?cle=<?php echo $cle ?>">
        <label>voulez-vous supprimer</label>
    <button>non </button>
    <button name="oui" value="oui">oui </button>
    </form>
</div>    
</body>
</html>