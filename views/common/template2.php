<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description; ?>">
    <title><?= $page_title; ?></title>
    <link rel="shortcut icon" href="<?= URL ?>public/Assets/images/PourEuxNancySVG.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/274ac46116.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" integrity="sha384-X8QTME3FCg1DLb58++lPvsjbQoCT9bp3MsUU3grbIny/3ZwUJkRNO8NPW6zqzuW9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/274ac46116.js" crossorigin="anonymous"></script>
    <link href="<?= URL ?>public/CSS/main.css" rel="stylesheet" />
    <?php if (!empty($page_css)) : ?>
        <?php foreach ($page_css as $fichier_css) : ?>
            <link href="<?= URL ?>public/CSS/<?= $fichier_css ?>" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <?php require_once("views/common/header2.php"); ?>

    <div class="container">
        <?php
        if (!empty($_SESSION['alert'])) {
            foreach ($_SESSION['alert'] as $alert) {
                echo "<div class='alert " . $alert['type'] . "' role='alert'>
                        " . $alert['message'] . "
                    </div>";
            }
            unset($_SESSION['alert']);
        }
        ?>
        <?= $page_content; ?>
    </div>

    <?php require_once("views/common/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./public/JavaScript/app.js"></script>
    <script src="./public/JavaScript/script.js"></script>
    <?php if (!empty($page_javascript)) : ?>
        <?php foreach ($page_javascript as $fichier_javascript) : ?>
            <script src="<?= URL ?>public/JavaScript/<?= $fichier_javascript ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>