<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion_etudiant</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
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
                    $selected = empty($filiere) ? 'selected' : '';
                    echo '<option value="" '.$selected.' disabled>-- filiere --</option>';
                    while($fil = $rq1->fetch()){
                        $selected = ($fil['fil_id'] == $filiere) ? 'selected' : '';
                        echo '<option value="'.$fil['fil_id'].'" '.$selected.'>'.$fil['filiere_nom'].'</option>';
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
            <input type="submit"name="btn" value="Annuler" id="text" />
        </form>
        <h2>LISTE DES ETUDIANTS</h2>
        <form method="GET" action="" id="formTri">
            <select name="tri" onchange="document.getElementById('formTri').submit();">
                <option value="">Trier par...</option>
                <option value="nom_asc" <?= $_GET['tri'] == 'nom_asc' ? 'selected' : '' ?>>Nom</option>
                <option value="fili" <?= $_GET['tri'] == 'fili' ? 'selected' : '' ?>>Filiere</option>
            </select>
        </form>
        <table  border="0" cellspacing="1" cellpadding="8" width="700" bgcolor="#e0e0e0">
            <?php
                $ordre = "etudiants.nom"; 
                if(isset($_GET['tri'])) {
                    if($_GET['tri'] == 'fili') {
                        $ordre = "filieres.filiere_nom";
                    } elseif($_GET['tri'] == 'nom') {
                        $ordre = "etudiants.nom";
                    }
                }
                $query="SELECT * FROM etudiants INNER JOIN filieres ON etudiants.filiere_id = filieres.fil_id ORDER BY $ordre ASC";
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
			            echo '<td><a href="index.php?task=modif&data='.$data.'" style="color:blue;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg></a></td>';
                        echo '<td>
                            <a href="delete.php?task=supp&id='.$dt['id'].'" 
                            style="color:red;" 
                            class="btn-suppr" 
                            data-id="'.$dt['id'].'" 
                            data-nom="'.$dt['nom'].'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </a>
                        </td>';                        
			            echo '</tr>';
                        $bg=($bg!='#FFFFFF')? '#FFFFFF' : '#EFEFEF';
                    }
                }else{
                    echo '<p class="donnee" style="padding:8px; width:35%; text-align:center; margin-left:32.5%; margin-top:10vh; color:#0e02be; font-family:Montserrat; border-radius: 10px; background-color: #f1f1f1;">aucune donnée disponible !</p>';
                }
            ?>
        </table>  
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/script.js"></script>
</body>
</html>