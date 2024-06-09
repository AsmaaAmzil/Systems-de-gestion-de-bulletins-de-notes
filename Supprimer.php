


<?php   
require "Etudiant.php";
require "ConnexionBD.php" ;  
        if(isset($_GET['identifiant']) ){
                $e = new Etudiant( $_GET['identifiant'] );
                $e->DeleteFromDB( );
                unset( $e );       
            } 
        header("Location:ListeCRUD.php");     
?>
