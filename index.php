<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion_etudiant</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <form action="traitement.php" method="POST">
        <label for="n">Nom</label><br>
        <input type="text" name="nom" id="n" placeholder="Entrez votre nom...">
        <br>
        <label for="p">Prenom</label><br>
        <input type="text" name="prenom" id="p" placeholder="Entrez votre prenom...">
        <br>
        <label for="s">Filiere</label><br>
        <select name="filiere" id="">
            <option value="SIL">SIL</option>
            <option value="SI">SI</option>
        </select>
        <br><br>
        <input type="submit" name="btn" value="Ajout">
        
    </form>
</body>
</html>