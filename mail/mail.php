<?php

// variables

$destinataire = "pacome.bonnement@gmail.com";
$sujet = "QUI PISSE CONTRE LE VENT SE RINCE LES DENTS";
 

$message ="<html><body>";
$message .="<h1>QUI PISSE CONTRE LE VENT SE RINCE LES DENTS</h1>";
$message .="<p>Un client a payé</p>";
$message .="</body></html>";

$headers = "From: \"fichescapeps@gmail.com\"\r\n";
$headers .= "Reply-to: \"Dimitri\"\r\n";
$headers .= "Content-Type: text/html; charset=\"utf-8\";\r\n";

if(mail($destinataire, $sujet, $message, $headers)){
    echo "Le mail a bien été envoyé";  

}else{
    echo "Une erreur est survenue";
}
