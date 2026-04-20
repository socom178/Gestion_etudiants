<?php
    include 'config.php';
    if(isset($_POST['btn'])){	
        $db->query('INSERT INTO etudiants(nom,prenom,filiere_id) VALUES("'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$_POST['filiere'].'")');
    }else if(isset($_POST['btn']) && $_POST['btn']=='update'){
		$db->query('UPDATE member SET nom="'.$_POST['nom'].'", prenom="'.$_POST['prenom'].'", filiere_id="'.$_POST['filiere'].'" WHERE id="'.$_POST['id'].'"');
	}

    header ('Location:index.php')

    
?>