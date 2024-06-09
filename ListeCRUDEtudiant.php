<?php  
    // Inclure le fichier contenant le programme de connexion à la base de données
    require "connexionBD.php" ; 
?>

<?php     
    // Traitements à faire quand on clique sur le bouton "Quitter"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['Quit'])) {  
            die("Fin du programme ....... Au revoir");     
        }
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
    <form action="" method="post" class="contenu">
        <input type="submit" name="Quit" value="Quitter">
        <table>
            <tr class="table_title">
                <td>Id</td>
                <td>Nom</td>
                <td>Maths</td>
                <td>Informatique</td>
                <td>Moyenne</td>
                <td>Mention</td>
            </tr>
<?php
session_start();
$Code = $_SESSION['Code'];

try {
    // Sélection de la liste des étudiants de la base de données
    $conBD = ConnexionBD::getInstance();

    $rd = "SELECT * FROM etudiant WHERE IdE = ? AND Valide = 1";
    $stm = $conBD->prepare($rd); 
    $stm->bindValue(1, $Code, PDO::PARAM_INT);
    $stm->execute();

    // Vérifier si la requête a réussi
    if ($stm->rowCount() > 0) {
        $EnregistrementEtudiant = $stm->fetch();
        // Calcul de la moyenne et de la mention
        $NoteMath = floatval($EnregistrementEtudiant['Maths']);
        $NoteInfo = floatval($EnregistrementEtudiant['Info']);
        $Moyenne = ($NoteMath + $NoteInfo) / 2;
        $Mention = CalculMention($Moyenne);

        // Affichage des informations de l'étudiant
        echo "<tr>";
        echo "<td>" . $EnregistrementEtudiant['IdE'] . "</td>";
        echo "<td>" . $EnregistrementEtudiant['Nom'] . "</td>";
        echo "<td>" . $EnregistrementEtudiant['Maths'] . "</td>";
        echo "<td>" . $EnregistrementEtudiant['Info'] . "</td>";
        echo "<td>" . $Moyenne . "</td>";
        echo "<td>" . $Mention . "</td>";
        echo  '<td>
        <a href="testfpdf.php?identifiant='.$Code.'"> <img src="image/user_edit.png"> </a>
       
  </td>';
        echo "</tr>";
        
    } else {
        // Aucun étudiant trouvé
        echo "<tr><td colspan='6'>Aucun étudiant trouvé.</td></tr>";
    }
} catch (PDOException $e) {
    // Gestion des erreurs PDO
    echo "Erreur PDO : " . $e->getMessage();
}
?>  
        </table>
    </form>
</body>
</html>
