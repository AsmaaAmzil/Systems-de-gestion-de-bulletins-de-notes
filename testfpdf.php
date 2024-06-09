<?php
require('fpdf/fpdf.php');
require "connexionBD.php" ; 
class PDF extends FPDF
{
// Page header
function Header()
{
    
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Bulltin',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
require "Mention.php" ; 
 $Code=$_GET['identifiant'];
 // Selection de la liste des étudiants de la base de données
 $conBD=ConnexionBD::getInstance();
 $stm = $conBD->query("SELECT * from etudiant");
 // Parcours des enregistrement de la table etudiant 
 while (  $EnregistrementEtudiant = $stm->fetch()  ) {
     // Lecture et affectation des différents champs de la table etudiant dans des variable
     if($EnregistrementEtudiant['IdE']===$Code){
                // Instanciation of inherited class
                $pdf = new PDF();
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Times','',12);
                $Moyenne =  ( $EnregistrementEtudiant['Maths'] +  $EnregistrementEtudiant['Info']) / 2  ;
                $Mention = CalculMention($Moyenne);
                $pdf->Cell(0, 10, 'Nom:'.$EnregistrementEtudiant['Nom'], 0, 1);
                $pdf->Cell(0, 10, 'Maths:'.$EnregistrementEtudiant['Maths'], 0, 1);
                $pdf->Cell(0, 10, 'Info:'.$EnregistrementEtudiant['Info'], 0, 1);
                $pdf->Cell(0, 10, 'Moyenne:'.$Moyenne, 0, 1);
                $pdf->Cell(0, 10, 'Mention:'.$Mention, 0, 1);
                $pdf->Output();
     }}
?>
		