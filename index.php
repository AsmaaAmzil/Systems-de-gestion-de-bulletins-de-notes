
<?php
//verification d'Id et Mot de passe
function Authentification() {
    if($_SERVER["REQUEST_METHOD"]=="POST") {

        require "connexionBD.php" ; 
        // Selection de la liste des utilisatuers de la base de données
       
		$conBD=ConnexionBD::getInstance();
        $stm = $conBD->query("SELECT * from Utilisateur");
        // Parcours des enregistrement de la table etudiant 
        while (  $EnregistrementUtilisateur = $stm->fetch()  ) {
            if($_POST['ID']==$EnregistrementUtilisateur['Login'] and $_POST["password"]==$EnregistrementUtilisateur['MotPasse'] ){
                
                if($EnregistrementUtilisateur['Categorie']==='Administrateur'||$EnregistrementUtilisateur['Categorie']==='Professeur'){ header("location:ListeCRUD.php");
                }else{
                    header("location:ListeCRUDEtudiant.php");
                    //stocker le code de l'utilisateur
                    session_start();
                    $_SESSION['Code']=$EnregistrementUtilisateur['Code'];

                }
                
            }
            else{ echo "Identifiant ou Mot de passe Incorrect ...  !!";   }  
          
    }
}}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    <title>Page Authentification </title>
</head>
<body>
    <form action = "" method = "POST" class="contenu">
        Identifiant <input type="text" name="ID" class="Identifiant"><br>
        Mot de passe <input type="password" name="password" class="mdp"><br>
        <input type="submit" name="val" value="valider">
        <input type="button" name="An" value="Annuler">
        <p><?php Authentification();?></p>
    </form>
</body>
</html>
