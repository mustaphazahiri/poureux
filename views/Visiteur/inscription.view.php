<div class="divconnexion container rounded">
    <div class="row">
        <div class="col-2 mx-5 my-5">

        </div>
        <div class="col-6 mx-5 my-5">
            <form class="my-4" method="POST" action="validation_inscription">
                <h2 class="text-white my-4 mb-5 text-center">INSCRIPTION</h2>
                <div class="form-group mx-1">
                    <select class="form-select my-4" name="id_role" aria-label="Default select example">
                        <option selected>Choisissez votre rôle</option>
                        <option name="id_role" value="1">Cuisinier</option>
                        <option name="id_role" value="2">Livreur</option>
                    </select>
                    <div class="row my-3">
                        <div class="col">
                            <label for="inputName" class="text-white">Nom</label>
                            <input type="text" class="form-control" placeholder="Nom" aria-label="name" name="nom_user">
                        </div>
                        <div class="col">
                            <label for="inputPassword" class="text-white">Prénom</label>
                            <input type="text" class="form-control" placeholder="Prenom" name="prenom_user">
                        </div>
                    </div>
                    <label for="inputAdresse" class="text-white">Adresse</label>
                    <input type="text" class="form-control mb-3" id="inputAdresse" placeholder="Votre adresse Postale" name="adresse">
                    <label for="cp" class="text-white">Code Postal</label>
                    <input type="text" class="form-control mb-3" id="cp" placeholder="Votre Code Postal" name="cp">
                    <div style="display: none; color: #f55;" id="error-message"></div>
                    <div class="form-group">
                        <label for="ville" class="text-white">Ville</label>
                        <!-- <input type="text" class="form-control mb-3" id="" placeholder="Nom de Votre Ville" name="ville"> -->

                        <select class="form-select mb-3" name="ville" id="ville">

                        </select>
                    </div>

                    <label for="inputTel" class="text-white">Téléphone</label>
                    <input type="text" class="form-control" id="inputTel" placeholder="Votre téléphone" name="telephone">
                    <label for="inputEmail" class="text-white mt-3">Mail</label>
                    <input type="text" class="form-control" id="inputVille" placeholder="Votre Adresse mail" name="login">
                </div>
                <div class="form-group mt-4 mx-1">
                    <label for="inputPassword" class="text-white">Mot de passe</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                </div>
                <label for="facebook" class="text-white mt-4">Avez-vous un compte facebook ?</label>
                <div class="form-check mt-2">

                    <input class="form-check-input" type="radio" name="facebook" value="1" checked>
                    <label class="form-check-label text-white" for="exampleRadios1">
                        Oui
                    </label>
                </div>
                <div class="form-check">

                    <input class="form-check-input" type="radio" name="facebook" value="0">
                    <label class="form-check-label" for="exampleRadios2">
                        Non
                    </label>
                </div>

                <div class="form-group mt-4 mx-1">
                    <div class="d-grid gap-2 my-3">
                        <button class="btn text-white cestparti" type="submit">C'est parti</button>
                    </div>
                </div>
                <label for="rgpd" class="text-white mt-4">En cliquant sur le bouton "c'est parti" je donne mon consentement pour collecter données personnelles, selon les mentions légales consultables <a href="mentions">ici</a> </label>
                <label for="facebook" class="text-white mt-4">En cliquant sur le bouton "c'est parti" je m'engage à respecter la charte du collectif, consultable <a href="lecollectif#charte__collectif">ici</a> </label>

        </div>
        </form>
    </div>
    <div class="col-3 mx-5 my-5">
        <!-- <img src="./public/Assets/images/login-logo.svg" width="260" height="560" alt=""> -->

    </div>
</div>
</div>