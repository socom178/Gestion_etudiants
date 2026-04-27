<?php
    include 'config.php';
    if(isset($_GET['task']) && $_GET['task']=='supp'){
        $db->query('DELETE FROM etudiants WHERE id="'.$_GET['id'].'"');
    }
    header("Location: index.php");
    exit();
?>