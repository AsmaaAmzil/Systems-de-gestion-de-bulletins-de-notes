
<?php

		class Etudiant {
			private $Identifiant;
			private $Nom;
			private $Info;
			private $Maths;
			// Constreucteur de la classe
			public function __construct($Id, $name="" , $inf=0, $math=0,$Valide=1){
					
				  $this->Identifiant=$Id;$this->Nom=$name; $this->Info= (float) $inf; $this->Maths= (float ) $math;
					$this->Valide=$Valide;
				  }
			// Méthodes de lecture (Get) et d'affectation (Set) des membres privés de la classe
			public function SetNom( $name ){ $this->Nom=$name; }
			public function GetNom(  ){ return( $this->Nom ); }
			public function SetInfo( $inf ){ $this->Info=$inf; }
			public function GetInfo(  ){ return( $this->Info ); }
			public function SetMaths( $math ){ $this->Maths=$math; }
			public function GetMaths(  ){ return( $this->Maths ); }
			public function SetValide( $Valide){ $this->Valide=$Valide; }
			public function GetValide(  ){ return( $this->Valide ); }
					// Méthodes CRUD
			// Supression de l'étudiant courant (this) de la base de données
			public function DeleteFromDB(  ){
				 
				$conBD=ConnexionBD::getInstance();
				$Requete = 'update etudiant set Valide=0 where IdE ="'.$this->Identifiant.'" ';
        $res = $conBD->exec( $Requete );
			  }
			// Ajout de l'étudiant courant (this) à la base de données
			public function AddToDB(  ){
				
				$conBD=ConnexionBD::getInstance();
				$stm = $conBD->prepare('INSERT INTO etudiant (IdE,Nom, Info, Maths,Valide) VALUES (:ve,:vn, :vi, :vm,1)');

                $tab = array( 've'=>$this->Identifiant,'vn'=>$this->Nom, 'vi'=>$this->Info, 'vm'=>$this->Maths
							);
                $stm->execute( $tab );
				}
			// Mise à jour de l'étudiant courant (this) dans la base de données
			public function UpdateInDB(  ){ 
				
				$conBD=ConnexionBD::getInstance();
				$Requette = "UPDATE etudiant SET Nom= :vn, Info= :vi, Maths=:vm ,Valide=:vd WHERE IdE=:id ";
                $stm = $conBD->prepare($Requette);
                $tab =  array  ( 'vn'=>$this->Nom, 'vi'=>$this->Info,'vm'=>$this->Maths, 'id'=>$this->Identifiant,'vd'=>$this->Valide );
                $stm->execute( $tab );


			 	}
			 // Mise à jour de l'étudiant courant (this) dans la base de données
			public function SelectFromDB(  ){
				 
				$conBD=ConnexionBD::getInstance();
				$Requette = "SELECT * FROM etudiant WHERE IdE = ?";
        		$stm = $conBD->prepare($Requette); 
        		$stm->bindValue ( 1, $this->Identifi ant , PDO::PARAM_INT);
        		$stm->execute( );
        		$EtudiantSelection = $stm->fetch();
        		return( $EtudiantSelection );
				}		
		} 
?>