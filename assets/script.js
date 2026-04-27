
document.getElementById('form').addEventListener('submit', function(event) {
    // 1. Récupération des champs
    const nom = document.getElementById('nom');
    const prenom = document.getElementById('prenom');
    const errorDiv = document.getElementById('error-message');
    
    let messages = [];

    // 2. Vérification du nom (supprime les espaces vides avec trim())
    if (nom.value.trim() === "") {
        messages.push("Le nom est obligatoire.");
        nom.style.borderColor = "red";
    } else {
        nom.style.borderColor = "";
    }

    // 3. Vérification du prénom
    if (prenom.value.trim() === "") {
        messages.push("Le prénom est obligatoire.");
        prenom.style.borderColor = "red";
    } else {
        prenom.style.borderColor = "";
    }

    // 4. Si on a des erreurs, on bloque l'envoi
    if (messages.length > 0) {
        event.preventDefault(); // Empêche l'envoi du formulaire
        
        // Affichage des messages
        errorDiv.innerText = messages.join(" ");
        errorDiv.style.display = "block";
    }
});
