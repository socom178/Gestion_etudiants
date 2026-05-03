<?php
    include 'config.php';
    
    if(isset($_POST['btn']) && $_POST['btn']=='Enregistrer'){
        $db->query('insert into etudiants(nom,prenom,filiere_id) values("'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$_POST['filiere'].'")');
    }else if(isset($_POST['btn']) && $_POST['btn']=='Modifier'){
        $db->query('UPDATE etudiants SET nom="'.$_POST['nom'].'", prenom="'.$_POST['prenom'].'", filiere_id="'.$_POST['filiere'].'" WHERE id="'.$_POST['id'].'"');
    }else if(isset($_POST['btn']) && $_POST['btn']=='Annuler'){
        $id=''; $nom=''; $prenom=''; $filiere='';
    }
    header("Location: index.php");
    exit();
?>