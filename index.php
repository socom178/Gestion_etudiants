<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion_etudiant</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <section>

    </section>
    <section>
        <?php
            include 'config.php';
            $id=''; $nom=''; $prenom=''; $filiere='';
            if(isset($_GET['task']) && $_GET['task']=='modif'){
                $tab=explode(';',$_GET['data']);
                $id=$tab[0];$nom=$tab[1];$prenom=$tab[2];$filiere=$tab[3];
            }
        ?>
        <h2>ENREGISTREMENT ETUDIANT</h2>
        <div id="error-message"></div>
        <form method="POST" id="form" action="traitement.php">
            <input type="hidden" name="id" id="" value="<?=$id?>" />
            <input type="text" name="nom" id="nom" value="<?=$nom?>" placeholder="Entrez le nom..." />
            <input type="tel" name="prenom"  id="prenom" value="<?=$prenom?>" placeholder="Entrez le prenom..." /><br />
            <select name="filiere" id="text">
                <?php
                    $rq1=$db->query('SELECT * FROM filieres');
                    echo '<option value="" selected disabled>-- filiere --</option>';
                    while($fil = $rq1->fetch()){
                        echo '<option value="'.$fil['fil_id'].'">'.$fil['filiere_nom'].'</option>';
                    }
                ?>
            </select>
            <br />
            <?php
                if(isset($_GET['task']) && $_GET['task']=='modif'){
                    $btn='<input type="submit" name="btn" value="Modifier" id="text" />';
                }else{
                    $btn='<input type="submit" name="btn" value="Enregistrer" id="text" />';
                }
                echo $btn;
            ?>
        </form>
        <h2>LISTE DES ETUDIANTS</h2>
        <table  border="0" cellspacing="1" cellpadding="8" width="700" bgcolor="#e0e0e0">
            <?php
                
                $query="SELECT * FROM etudiants INNER JOIN filieres ON etudiants.filiere_id = filieres.fil_id ";
                $st=$db->prepare($query);
                $st->execute();
                if($st->rowcount()!=0){
                    $bg='#DDDDDD';
                    echo '<tr><th bgcolor="'.$bg.'">Nom etudiant</th><th bgcolor="'.$bg.'">Prenom etudiant</th><th bgcolor="'.$bg.'">Filiere etudiant</th><th bgcolor="'.$bg.'" colspan="2" >Actions</th>';
                    $bg='#FFFFFF';
                    
                    while($dt=$st->fetch()){
                        $data = $dt['id'].';'.$dt['nom'].';'.$dt['prenom'].';'.$dt['filiere_id'].';'.$dt['filiere_nom'];
                        echo '<tr>';
                        echo '<td bgcolor="'.$bg.'">'.$dt['nom'].'</td><td bgcolor="'.$bg.'">'.$dt['prenom'].'</td><td bgcolor="'.$bg.'">'.$dt['filiere_nom'].'</td>';
			            echo '<td><a href="index.php?task=modif&data='.$data.'" style="color:blue;">modifier</a></td>';
                        echo '<td><a href="delete.php?task=supp&id='.$dt['id'].'" style="color:red;"">supprimer</a></td>';                        
			            echo '</tr>';
                        $bg=($bg!='#FFFFFF')? '#FFFFFF' : '#EFEFEF';
                    }
                }else{
                    echo '<p class="donnee" style="padding:8px; width:35%; text-align:center; margin-left:32.5%; margin-top:10vh; color:#0e02be; font-family:Montserrat; border-radius: 10px; background-color: #f1f1f1;">aucune donnée disponible !</p>';
                }
            ?>
        </table>  
    </section>
    <script src="./assets/script.js"></script>
</body>
</html>