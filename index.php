<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion_etudiant</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <?php
        $nom='';
        $prenom='';
        $filiere_nom='';
        include 'config.php';

        if(isset($_GET['task']) && $_GET['task']=='modif'){
            $tab=explode(';',$_GET['data']);
            $id=$tab[0];$nom=$tab[1];$prenom=$tab[2];$filiere=$tab[3];
        }else if(isset($_GET['task']) && $_GET['task']=='supp'){
            $db->query('DELETE FROM etudiants WHERE id="'.$_GET['id'].'"');
        }
    ?>
    <form action="traitement.php" method="POST">
        <label for="n">Nom</label><br>
        <input type="text" name="nom" value="<?=$nom?>" id="n" placeholder="Entrez votre nom...">
        <br>
        <label for="p">Prenom</label><br>
        <input type="text" name="prenom" value="<?=$prenom?>" id="p" placeholder="Entrez votre prenom...">
        <br>
        <label for="s">Filiere</label><br>
        <select name="filiere" id="">
            <option value="1">SIL</option>
            <option value="2">SI</option>
        </select>
        <br><br>
        <input type="submit" name="btn" value="Ajout">
        <input type="submit" name="btn" value="update">
        
    </form>
    <table border="1">
        <?php
            include 'config.php';
            $req=$db->query('SELECT * FROM etudiants , filieres WHERE etudiants.filiere_id=filieres.fil_id');
            if($req->rowcount()!=0){
                while($dt=$req->fetch()){
                    $data = $dt['id'].';'.$dt['nom'].';'.$dt['prenom'].';'.$dt['filiere_nom'];
                    echo '<tr>';
                    echo '<td><a href="index.php?task=modif&data='.$data.'" style="color:blue;font-weight:bold;margin:5px">modifier</a></td>';
                    echo '<td><a href="index.php?task=supp&id='.$dt['id'].'" style="color:red;font-weight:bold;margin:5px">supprimer</a></td>';
                    echo '<td>'.$dt['nom'].'</td><td>'.$dt['prenom'].'</td><td>'.$dt['filiere_nom'].'</td>';
                    echo '</tr>';
                }
            }
        ?>
</table>
</body>
</html>