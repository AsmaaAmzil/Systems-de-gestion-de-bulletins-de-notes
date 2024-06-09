
<?php  
    // Inclure le fichier contenant le programme de connexion à la base de données
    require "connexionBD.php" ; 
     // Inclure le fichier contenant le programme de calcul de la mention
     require "Mention.php" ; 
    
?>

<?php    
   
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST["return"]))  header("Location:ListeCRUD.php");  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style3.css">
    <title>Page 3</title>
</head>
<body>
    <form action = "" method="post" class="contenu">
        
        <table>
          <input type="submit" name="return" value="retourner">
            <tr class = "table_title">
                <td>Id</td>
                <td>Nom</td>
                <td>Maths</td>
                <td>Informatique</td>
                <td>Moyenne</td>
                <td>Mention</td>
            </tr>
    <?php
        // Selection de la liste des étudiants de la base de données
        $conBD=ConnexionBD::getInstance();
        $stm = $conBD->query("SELECT * from etudiant");
        // Parcours des enregistrement de la table etudiant 
        while (  $EnregistrementEtudiant = $stm->fetch()  ) {
            // Lecture et affectation des différents champs de la table etudiant dans des variable
            if($EnregistrementEtudiant['Valide']==0){
                $id              = $EnregistrementEtudiant['IdE'];       $name = $EnregistrementEtudiant['Nom'];
            $math            = $EnregistrementEtudiant['Maths'];     $inf  = $EnregistrementEtudiant['Info'];
            // Calcul de la moyenne et de la mention
            $NoteMath  = floatval( $math );
            $NoteInfo = floatval( $inf );
            $Moyenne =  ( $NoteMath +  $NoteInfo ) / 2  ;
            $Mention = CalculMention($Moyenne);
            // Affiche de l'enregistrement dans la liste des étudiants avec les boutons (CRUD)
            echo "<tr>";
                echo "<td>".$id."</td>";
                echo "<td>".$name."</td>";
                echo "<td>".$NoteMath."</td>";
                echo "<td>".$NoteInfo."</td>";
                echo "<td>".$Moyenne."</td>";
                echo "<td>".$Mention."</td>";
                echo '<td>
                            <a href="rendreActif.php?identifiant='.$id.'"> <img src="image/user_edit.png"> </a>
                      </td>';
            echo "</tr>"; 
            }
            
            }
    ?>   
        </table>
    </form>
</body>
</html>