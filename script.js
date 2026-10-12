function verifierConnexion() {
    let login = document.getElementById("identifiant").value;
    let password = document.getElementById("motDePasse").value;
    let coSecu = document.getElementById("coSecu").checked;
    let domaine = document.getElementById("domaine").value;
    let erreur = document.getElementById("erreur");
    erreur.style.color = "red";
    erreur.style.margin = "20px";
    if (login.length < 7) {
        erreur.innerText = "Identifiant Trop Court"
    } else if (password === "") {
        erreur.innerText = "Pas de mot de passe"
    } else if (!coSecu) {
        erreur.innerText = "Sécurisez connexion"
    } else if (domaine != "Tec19") {
        erreur.innerText = "Mauvais domaine"
    } else {
        alert("Connexion réussie !")
        location.href = "admin.html"
    }
}

function verifierContact() {
    let nom = document.getElementById("nom").value;
    let prenom = document.getElementById("prenom").value;
    let mail = document.getElementById("mail").value;
    let tel = document.getElementById("tel").value;
    let erreur = document.getElementById("erreur");
    erreur.style.color = "red";
    erreur.style.margin = "20px";
    let regexMail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (nom.length === "") {
        erreur.innerText = "Indiquez votre nom"
    } else if (prenom.length === "") {
        erreur.innerText = "Indiquez votre prenom"
    } else if (!regexMail.test(mail)) {
        erreur.innerText = "Email invalide"
    } else if (tel.length <9 ) {
        erreur.innerText = "Telephone invalide"
    } else {
        alert("Connexion réussie !")
        location.href = "admin.html"
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const cookieBanner = document.getElementById("cookie-banner");
    const acceptBtn = document.getElementById("accept-cookies");
    const rejectBtn = document.getElementById("reject-cookies");
  
    // 1. Vérifie si l'utilisateur a déjà donné ou refusé son consentement
    if (!localStorage.getItem("cookieConsent")) {
      // Si aucun choix n'est fait, on affiche la bannière
      cookieBanner.classList.remove("hidden");
    } else if (localStorage.getItem("cookieConsent") === "accepted") {
      // Si déjà accepté, on charge les scripts d'analyse (ex: Google Analytics)
      loadAnalytics();
    }
  
    // 2. Action au clic sur "Tout accepter"
    acceptBtn.addEventListener("click", function() {
      localStorage.setItem("cookieConsent", "accepted"); // Sauvegarde le choix
      cookieBanner.classList.add("hidden"); // Cache la bannière
      loadAnalytics(); // Lance les cookies de suivi
      console.log("Les cookies ont été acceptés.");
    });
  
    // 3. Action au clic sur "Tout refuser"
    rejectBtn.addEventListener("click", function() {
      localStorage.setItem("cookieConsent", "rejected"); // Sauvegarde le refus
      cookieBanner.classList.add("hidden"); // Cache la bannière
      console.log("Les cookies ont été refusés.");
    });
  });
  
  // Fonction pour charger les scripts qui nécessitent un consentement (Analytics, etc.)
  function loadAnalytics() {
    console.log("Chargement des scripts Google Analytics / Matomo...");
    // C'est ici que tu inséreras la balise <script> de ton outil d'analyse
    // Par exemple, en créant un élément script dynamiquement et en l'ajoutant au head.
  }