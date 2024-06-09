
<?php
		class Audit {
			private $Utilisateur;
			private $Date;
			private $Operation;
			private $NomTable;
			// Constreucteur de la classe
			public function __construct($Utilisateur,$Date,$Operation,$NomTable){
					
				  $this->Utilisateur=$Utilisateur;$this->Date=$Date;
          $this->Operation= $Operation; $this->NomTable= $NomTable;
				  }
			// Méthodes de lecture (Get) et d'affectation (Set) des membres privés de la classe
			public function SetUtilisateur( $Utilisateur ){ $this->Utilisateur=$Utilisateur; }
			public function GetUtilisateur(  ){ return( $this->Utilisateur ); }
			public function SetDate( $Date ){ $this->Date=$Date; }
			public function GetDate(  ){ return( $this->Date ); }
			public function SetOperation( $Operation ){ $this->Operation=$Operation; }
			public function GetOperation(  ){ return( $this->Operation ); }
			public function SetNomTable( $NomTable){ $this->NomTable=$NomTable; }
			public function GetNomTable(  ){ return( $this->NomTable ); }
					// Méthodes CRUD
			
		
				
			  
			
			public function AddToDB(  ){
				require "connexionBD.php" ;  
				$stm = $conBD->prepare('INSERT INTO audit(Utilisateur,Date,Operation,NomTable) VALUES (:ve,:vn, :vi, :vm)');

                $tab = array( 've'=>$this->Utilisateur,'vn'=>$this->Date,
                'vi'=>$this->Operation,
                'vm'=>$this->NomTable
							);
                $stm->execute( $tab );
				}
			
			public function SelectFromDB(  ){
            require "connexionBD.php" ; 
            $Requette = "SELECT * FROM Utilisateur WHERE IdE = ?";
        		$stm = $conBD->prepare($Requette); 
        		$stm->bindValue ( 1, $this->Identifiant , PDO::PARAM_INT);
        		$stm->execute( );
        		$EtudiantSelection = $stm->fetch();
        		return( $EtudiantSelection );
				}	 


        
?>