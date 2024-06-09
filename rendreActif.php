<?php  require "Etudiant.php" ;
      require "connexionBD.php" ; 
?>

<?php     
        if(isset($_GET['identifiant']) ){
          $conBD=ConnexionBD::getInstance();
          $stm = $conBD->query("SELECT * from etudiant");
          while (  $EnregistrementEtudiant = $stm->fetch()  ) {
              
              if($EnregistrementEtudiant['IdE']==$_GET['identifiant']  ){
                $name = $EnregistrementEtudiant['Nom'];
                $math = $EnregistrementEtudiant['Maths'];     
                $inf  = $EnregistrementEtudiant['Info'];
                
                $e = new Etudiant($_GET['identifiant'],$name, $inf,$math,1);
                $e->UpdateInDB( );
                unset( $e );}  
              }      
            } 
        header("Location:EtudiantSupprime.php");     
?>