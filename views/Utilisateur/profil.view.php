<h1>Bonjour <?php echo $utilisateur['prenom_user'] ?></h1>
<div class="d-flex">
    <h2 class="my-5 me-5">
        <button class="btn Couleur_006F89">

            Ajouter des repas
        </button>
    </h2>


    <h2 class="my-5 ms-5">
        <button class="btn btn-success">

            Voir mes repas
        </button>
    </h2>
</div>
<div id="mail" class="mt-4">

    <!-- bouton pour modifier le mail -->
    <button class="btn Couleur_006F89" id="btnModifMail">

        Mail : <?= $utilisateur['email'] ?>
    </button>
    <button class="btn Couleur_006F89" id="btnModifMail">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="26" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
        </svg>
    </button>
</div>
<!-- bouton pour changer le mot de passe -->
<div id="modificationMail" class="d-none ">
    <form method="POST" action="<?= URL; ?>compte/validation_modificationMail">
        <div class="row">
            <label for="email" class="col-2 col-form-label">Mail :</label>
            <div class="col-8">
                <input type="email" class="form-control" name="email" value="<?= $utilisateur['email'] ?>" />
            </div>
            <div class="col-2">
                <button class="btn Couleur_006F89" id="btnValidModifMail">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="19" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
<!-- bouton pour supprimer le compte de l'utilisateur -->
<div class=" mt-5">
    <a href="<?= URL ?>compte/modificationPassword" class="btn Couleur_FEAC43">Changer le mot de passe</a>
    <button id="btnSupCompte" class="btn Couleur_FEAC43 mx-5">Supprimer mon compte</button>
</div>
<div id="suppressionCompte" class="d-none mt-5">
    <div class="alert Couleur_FEAC43">
        Veuillez confirmer la suppression du compte.
        <br />
        <a href="<?= URL ?>compte/suppressionCompte" class="btn Couleur_A8000C">Je Souhaite supprimer mon compte définitivement !</a>
    </div>
</div>