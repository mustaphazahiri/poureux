<div class="divconnexion container rounded">
    <div class="row">
        <div class="col-2 mx-5 my-5">
        </div>
        <div class="col-4 mx-5 my-5">
            <form method="POST" action="validation_login" class="my-4">
                <h2 class="text-white my-4 mx-1 text-center">CONNEXION</h2>
                <div class="form-group mx-1">
                    <label for="login" class="text-white">Mail</label>
                    <input type="mail" class="form-control" id="login" name="login" placeholder="Votre mail">
                </div>
                <div class="form-group mt-4 mx-1">
                    <label for="password" class="text-white">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group mt-3 mx-1">
                    <label class="form-check-label text-white"><input type="checkbox"> Rester connecté</label>
                    <div class="d-grid gap-2 my-2">
                        <button class="btn text-white cestparti" type="submit">C'est parti</button>
                    </div>
                    <a href="#" class="text-white">Mot de passe oublié?</a>
                </div>
            </form>
        </div>

        <div class="col-3 ms-5 my-5">
            <img src="./public/Assets/images/login-logo.svg" width="260" height="560" alt="">

        </div>
    </div>
</div>