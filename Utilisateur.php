
<?php
				 

		class Utilisateur {
			private $Code;
			private $Login;
			private $MotPasse;
			private $Email;
      private $Categorie;

			// Constreucteur de la classe
			public function __construct($Code, $Login="" , $MotPasse="" ,$Email="", $Categorie=""){
				  $this->Code=$Code;$this->Login=$Login; $this->MotPasse= $MotPasse; $this->Email= $Email;$this->Categorie=$Categorie;
				  }
			// Méthodes de lecture (Get) et d'affectation (Set) des membres privés de la classe
			public function SetCode( $Code ){ $this->Code=$Code; }
			public function GetCode(  ){ return( $this->Code ); }
			public function SetLogin( $Login){$this->Login=$Login;  }
			public function GetLogin(  ){ return( $this->Login); }
			public function SetMotPasse( $MotPasse ){ $this->MotPasse= $MotPasse; }
			public function GetMotPasse(  ){ return( $this->MotPasse); }
      public function SetEmail( $Email ){ $this->Email= $Email; }
			public function GetEmail(  ){ return( $this->Email ); }
      public function SetCategorie( $Categorie){ $this->Categorie=$Categorie; }
			public function GetCategorie(  ){ return( $this->Categorie ); }
					// Méthodes CRUD
			// Supression de l'étudiant courant (this) de la base de données
			public function DeleteFromDB(  ){
			
				$conBD=ConnexionBD:: getInstance();
				
				$Requete = 'update Utilisateur set Valide=0 where Code = "'.$this->Code.'" ';
        $res = $conBD->exec( $Requete );
			  }
			// Ajout de l'étudiant courant (this) à la base de données
			public function AddToDB( ){
				$conBD=ConnexionBD:: getInstance();
				$stm = $conBD->prepare('INSERT INTO Utilisateur (Code,Login, MotPasse, Email,Categorie,Valide) VALUES (:ve,:vn, :vi, :vm,:vc,1)');

                $tab = array( 've'=>$this->Code,
								'vn'=>$this->Login, 'vi'=>$this->MotPasse, 'vm'=>$this->Email,'vc'=>$this->Categorie );
                $stm->execute( $tab );
				}
			// Mise à jour de l'étudiant courant (this) dans la base de données
			public function UpdateInDB(  ){ 
				
				$conBD=ConnexionBD::getInstance(); 
				$Requette = "UPDATE Utilisateur SET Login= :vn, MotPasse= :vi, Email=:vm ,Categorie=:vc WHERE Code=:cd ";
                $stm = $conBD->prepare($Requette);
                $tab =  array  ( 'vn'=>$this->Login, 'vi'=>$this->MotPasse,'vm'=>$this->Email, 'cd'=>$this->Categorie  );
                $stm->execute( $tab );

			 	}
			 // Mise à jour de l'étudiant courant (this) dans la base de données
			public function SelectFromDB(  ){
				$conBD=ConnexionBD::getInstance();
				$Requette = "SELECT * FROM Utilisateur WHERE Code = ?";
        		$stm = $conBD->prepare($Requette); 
        		$stm->bindValue ( 1, $this->Code , PDO::PARAM_INT);
        		$stm->execute( );
        		$UtilisateurSelection = $stm->fetch();
        		return( $UtilisateurSelection );
				}		
		} 
?>