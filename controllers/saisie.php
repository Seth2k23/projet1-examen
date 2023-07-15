<?php
require_once('../models/connexion.php');

if (isset($_POST['enregistrer'])) {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['filiere'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $datnais = htmlspecialchars($_POST['datnais']);
        $ville = htmlspecialchars($_POST['ville']);
        $sexe = htmlspecialchars($_POST['sexe']);
        $filiere = htmlspecialchars($_POST['filiere']);

        if ($datnais && $ville && $sexe) {
            $stmt = addCandidat($nom, $prenom, $datnais, $ville, $sexe, $filiere);
            ($stmt) ? $_SESSION['success'] = 'Enregistrment effectué avec succès' : $_SESSION['error'] = 'Erreur d\'enregistrement';
            //($stmt) ? header('Location: ../?s=' .base64_encode('Enregistrment effectué avec succès')) : header('Location: ../?e=' .base64_encode('Erreur d\'enregistrement'));
        } else {
            $datnais = null;
            $ville = null;
            $sexe = null;

            $stmt = addCandidat($nom, $prenom, $datnais, $ville, $sexe, $filiere);
            ($stmt) ? $_SESSION['success'] = 'Enregistrment effectué avec succès' : $_SESSION['error'] = 'Erreur d\'enregistrement';
            //($stmt) ? header('Location: ../?s=' .base64_encode('Enregistrment effectué avec succès')) : header('Location: ../?e=' .base64_encode('Erreur d\'enregistrement'));
        }
        
    } else {
        $_SESSION['error'] = 'Nom, prénom et filière sont obligatores';
        //header('Location: ../?e=' .base64_encode('Nom, prénom et filière sont obligatores'));
    }
    
    // Fermer l'écriture de la session
    session_write_close();
    header('Location: ../');
    //header('Location: ../?s=' . base64_encode($suc) . '&e=' . base64_encode($err));
    //header('Location: ../?e=' . base64_encode($err));

}