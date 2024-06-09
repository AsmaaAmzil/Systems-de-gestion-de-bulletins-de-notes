<?php
    // Fonction de calcul de la mention 
    function CalculMention($m){
        if($m>=10 and $m<12)return "Passable";
        elseif($m>=12 and $m<14)return "A Bien";
        elseif($m>=14 and $m<=16)return " Bien";
        elseif($m>16 and $m<20)return "Trés Bien";
        else return "Non admit";
    }
?>

