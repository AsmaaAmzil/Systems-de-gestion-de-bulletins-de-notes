
<?php  
require "Etudiant.php" ;
require "Utilisateur.php";
require "connexionBD.php" ; 

$conBD=ConnexionBD::getInstance();
$stmt = $conBD->prepare("SELECT COUNT(*) FROM etudiant");
$stmt->execute();

$nb = $stmt->fetchColumn();

?>
<?php    

        if($_SERVER["REQUEST_METHOD"]=="POST") {
            if( isset($_POST['Valider']) ) {   
                $e = new Etudiant($nb+1, $_POST["LeNom"], $_POST[ "NoteMaths"], $_POST["NoteInfo"],1);
                $e->AddToDB( );
                $u=new Utilisateur($nb+1, $_POST["LeNom"],($nb+1).($nb+1).($nb+1).($nb+1).($nb+1),$_POST["LeNom"]."@gmail.com","Etudiant");
                $u->AddToDB( );
                unset( $e );
                header("Location:ListeCRUD.php");
            }  
            if( isset($_POST['Annuler']) )  header("Location:ListeCRUD.php");     
        }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='css/style2.css'>
    <title>Page 2 </title>
</head>
<body> 
      
    <form action = "" method = "POST" class="contenu">
        Nom <input type="text" name="LeNom" class="maths"> <br>
        Maths <input type="text" name="NoteMaths" class="maths"><br>
        Informatique <input type="text" name="NoteInfo" class="info"><br>
        <input type="submit" name="Valider" value="Valider"><br>
        <input type="submit" name="Annuler" value="Annuler"><br>
    </form>
</body>
</html>