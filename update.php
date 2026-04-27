<?php 
    include 'config.php';
    if(isset($_GET['task']) && $_GET['task']=='modif'){
        $tab=explode(';',$_GET['data']);
        $id=$tab[0];$nom=$tab[1];$prenom=$tab[2];$filiere=$tab[3];
    }
    header("Location: index.php?id=$id;nom=$nom;prenom=$prenom;filiere_id=$filiere");
    exit();
?>