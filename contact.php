
        <h1 class="m-3 text-center">Connexion à la page admin</h1>
        <div class="card container">
            <p id="erreur"></p>
            <div class="p-5" id="formLogin">
                <label for="nom">Nom :</label><br>
                <input type="text" id="nom"><br><br>

                <label for="prenom">Prenom :</label><br>
                <input type="text" id="prenom"><br><br>

                <label for="mail">Email :</label><br>
                <input type="email" id="mail"><br><br>

                <label for="tel">N° Tel :</label><br>
                <input type="tel" id="tel"><br><br>

                <button class="btn btn-primary" onclick="verifierContact()" id="valider">Valider</button>
            </div>
        </div>
