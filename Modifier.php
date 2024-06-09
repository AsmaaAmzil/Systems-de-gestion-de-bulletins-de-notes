<?php  
require "Etudiant.php";

require "connexionBD.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Valider'])) {
    if (isset($_GET['identifiant'])) {
        $e = new Etudiant($_GET['identifiant'], $_POST["Nom"], $_POST["Info"], $_POST["Maths"]);
        $e->UpdateInDB();
        // Uncomment the following lines if you want to log the update operation
        // $a = new Audit($_SESSION['Utilisateur'], date("Y-m-d"), "UPDATE etudiant SET Nom=" . $_POST["Nom"] . ", Info=" . $_POST["Info"] . ", Maths=" . $_POST["Maths"] . ", Valide=1 WHERE IdE=" . $_GET['identifiant'], 'etudiant');
        // $a->UpdateInDB();
        unset($e);
        header("Location: ListeCRUD.php");
        exit; // Ensure to exit after redirecting
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Annuler'])) {
    header("Location: ListeCRUD.php");
    exit; // Ensure to exit after redirecting
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='css/style2.css'>
    <title>Page 2</title>
</head>
<body>
    
    <?php 
    // Retrieve information from the database for the selected student
    if (isset($_GET['identifiant'])) {
        $e = new Etudiant($_GET['identifiant']);
        $EnregistrementEtudiant = $e->SelectFromDB();
        unset($e);
        $Identifiant = $EnregistrementEtudiant['IdE'];
        $name = $EnregistrementEtudiant['Nom'];
        $math = $EnregistrementEtudiant['Maths'];
        $inf = $EnregistrementEtudiant['Info'];
    } else {
        // If no identifiant is set, initialize variables to prevent errors
        $Identifiant = $name = $math = $inf = "";
    }
    ?>
    <form action="" method="POST" class="contenu">
        Nom <input type="text" name="Nom" class="maths" value="<?php echo $name; ?>" required> <br>
        Maths <input type="text" name="Maths" class="maths" value="<?php echo $math; ?>" required><br>
        Informatique <input type="text" name="Info" class="info" value="<?php echo $inf; ?>" required><br>
        <input type="submit" name="Valider" value="Valider"><br>
        <input type="submit" name="Annuler" value="Annuler"><br>
    </form>
</body>
</html>
