<?php
session_start();
//Connexion à la base de données
function dbConnect(){
    try{
        $db = new PDO('mysql:host=localhost;dbname=examen;charset=utf8', 'djibril', 'tamou');
        return $db;
    }catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
}

//Récupérer tous les users
function getAllCandidats(){
    $db = dbConnect();

    $req = $db->query('SELECT * FROM candidat ORDER BY id DESC');
    $req->execute();
    return $req;
}


//Récupérer un user
function getCandidat($nom){
    $db = dbConnect();

    $req = $db->prepare('SELECT * FROM candidat WHERE nom = ?');
    $req->execute(array($nom));
    return $req;
}

//Ajouter un user
function addCandidat($nom, $prenom, $datnais, $ville, $sexe, $filiere){
    $db = dbConnect();

    $req = $db->prepare('INSERT INTO candidat(nom,prenom,datnais,ville,sexe,codefil) VALUES(?,?,?,?,?,?)');

    if($req->execute(array($nom, $prenom, $datnais, $ville, $sexe, $filiere)))
        return true;
    else
        return false;
}

//rechercher les candidats d'une filière
function rechercheCandidats($filiere) {
    $db = dbConnect();
    $req = $db->prepare('SELECT *, nom, prenom, sexe FROM candidat WHERE codefil LIKE :filiere');
    $req->execute(array(':filiere' => '%' . $filiere . '%'));
    return $req;
}

// function rechercheCandidats($filiere){
//     $db = dbConnect();

//     $req = $db->prepare('SELECT nom,prenom,sexe FROM candidat WHERE codefil = LIKE "% ? %"');

//     $req->execute(array($filiere));
//     return $req;
// }

//Compter le nombre de candidat
function countCandidats($filiere) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT COUNT(*) AS total_cadits FROM candidat WHERE codefil = ?');
    $stmt->execute(array($filiere));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_cadits'];
}

//Supprimer l'nfos user dans la table password_reset
function delUser($token){
    $db = dbConnect();

    $req = $db->prepare('DELETE FROM password_reset WHERE token_user = ?');

    if($req->execute(array($token)))
        return true;
    else
        return false;
}

//Modifier un info user
function updateUser($password, $token){
    $db = dbConnect();

    $req = $db->prepare('UPDATE users SET password = ? WHERE token = ?');

    if($req->execute(array($password, $token)))
        return true;
    else
        return false;
}

