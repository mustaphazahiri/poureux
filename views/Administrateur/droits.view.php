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
                <td class="text-center"><?= $utilisateur['id_role'] ?></td>
                <td class="text-center"><?= (int)$utilisateur['is_valid'] === 0 ? "Non" : "Oui" ?></td>
            </tr>
        <?php endforeach; ?>
    </thead>
</table>