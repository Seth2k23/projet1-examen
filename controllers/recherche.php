<?php
require_once('../models/connexion.php');

if (isset($_POST['ok'])) {
    if (!empty($_POST['filiere'])) {
        $filiere = htmlspecialchars($_POST['filiere']);

        $candidats = rechercheCandidats($filiere);
        /*$stmt = rechercheCandidats($filiere);
        
        $candidats = $stmt->fetch();
        var_dump($candidats);*/
        //($stmt) ? $_SESSION['success'] = 'Enregistrment effectué avec succès' : $_SESSION['error'] = 'Erreur d\'enregistrement';
        //compter le numbre candidats par filere
        $total_cadits = countCandidats($filiere);
       
    } else {
        $_SESSION['error'] = 'Indiquez la filière svp';
    } 
}