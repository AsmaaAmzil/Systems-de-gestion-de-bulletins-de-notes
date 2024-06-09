<?php
  // class Etudiant{
  //   private $nom;
  //   private $moyenne;
  //   function Affectation($n,$m){
  //     $this->nom=$n;
  //     $this->moyenne=$m;
  //   }
  //   function __tostring(){
  //     echo "Etudiant".$this->nom."<br>";
  //     echo "a une moyenne de ".$this->moyenne;
  //   }
    
  // }
  // // $etd=new Etudiant();
  // //   $etd->Affectation("Hamid",12);
  // //   echo  $etd;
  // class Livre{
  //   private $titre;
  //   private $prix;
  //   function AfficheLivre(){
  //     echo " titre:".$this->titre."prix:".$this->prix."<br>";
  //   }
  //   function __clone(){$this->prix=100;}
   
  // }
  // $original=new Livre();
  // $copie=clone($original);
  // $original->AfficheLivre();
  // $copie->AfficheLivre();
  // if($copie===$original){
  //   echo "the same reference";
  // }else{
  //   echo "difrent reference";
  // }
 class Logement{
  protected function quisuisje(){return ("Je suis un log");}
 }
 class Appartement extends Logement{
  protected function quisuisje(){return("je suis un appartement");}
  public function identparent(){return(parent::quisuisje());}
  public function identself(){return(self::quisuisje());}

 }
 $appart=new Appartement();
 echo $appart->identparent();
 echo $appart->identself();