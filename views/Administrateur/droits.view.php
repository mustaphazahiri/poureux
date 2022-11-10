<h1 class="text-center bg-warning text-white">Page de gestion des droits des utilisateurs</h1>
<table class="table table-bordered border-primary">
    <thead>
        <tr class="text-center">
            <th>Nom</th>
            <th>Prénom</th>
            <th>Rôle</th>
            <th>Compte validé</th>

        </tr class="text-center">
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <tr>
                <td class="text-center"><?= $utilisateur['nom_user'] ?></td>
                <td class="text-center"><?= $utilisateur['prenom_user'] ?></td>
                <td class="text-center">
                    <?php if ($utilisateur['id_role'] === "admin") : ?>
                        <?= $utilisateur['id_role'] ?>
                    <?php else : ?>
                        <form method="POST" action="<?= URL ?>administration/validation_modificationRole">
                            <input type="hidden" name="login" value="<?= $utilisateur['login'] ?>" />
                            <? var_dump($POST) ?>
                            <select class="form-select" name="id_role" onchange="confirm('confirmez vous la modification ?') ? submit() : document.location.reload()">
                                <option value="1" <?= $utilisateur['id_role'] === "cuisinier" ? "selected" : "" ?>>Cuisinier</option>
                                <option value="2" <?= $utilisateur['id_role'] === "livreur" ? "selected" : "" ?>>Livreur</option>

                            </select>
                        </form>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <form method="POST" action="<?= URL ?>administration/validation_compte">
                        <input type="hidden" name="email" value="<?= $utilisateur['login'] ?>" />
                        <select class="form-select" name="is_valid" onchange="confirm('confirmez vous la modification ?') ? submit() : document.location.reload()">
                            <option value="1" <?= $utilisateur['is_valid'] == "1" ? "selected" : "" ?>>Oui</option>
                            <option value="0" <?= $utilisateur['is_valid'] == "0" ? "selected" : "" ?>>Non</option>
                        </select>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </thead>
</table>