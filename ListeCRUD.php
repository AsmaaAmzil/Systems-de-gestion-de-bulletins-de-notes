
<?php  
    // Inclure le fichier contenant le programme de connexion à la base de données
    require "connexionBD.php" ; 
    
?>

<?php     
    // Traitements à faire qu'on clique sur le bouton "Nouveau" ou le bouton "Quitter"
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["New"]))  header("Location:Nouveau.php");  
        elseif(isset($_POST['Quit'])) {  die( "Fin du programme ....... Au revoir");     }
        elseif(isset($_POST['liste'])){header("Location:EtudiantSupprime.php"); }
    }
?>

<?php    
    // Inclure le fichier contenant le programme de calcul de la mention
    require "Mention.php" ; 
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
        <input type="submit" name="liste" value="Etudiant Supprimé">
        <input type="submit" name="New" value="Nouveau">
        <input type="submit" name="Quit" value="Quitter">
        <table>
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
            if($EnregistrementEtudiant['Valide']==1){
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
                            <a href="Modifier.php?identifiant='.$id.'"> <img src="image/user_edit.png"> </a>
                            <a href="Supprimer.php?identifiant='.$id.'"> <img src="image/user_delete.png"> </a>
                      </td>';
            echo "</tr>"; 
            }
            
            }
    ?>   
        </table>
    </form>
</body>
</html>