<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
    <!-- Le titre de la page est modifiable -->
	<title><?= $this->renderSection("titre") ?></title>
</head>
<header>
	<img src="../logo_GSB_64.png" alt="logo">
    <h1>GSB Application Note de Frais</h1>
</header>
<body>

    <!-- Le contenu de la page est modifiable -->
    <?= $this->renderSection("contenu") ?>

</body>
<footer>
        <h5>GSB - Galaxy Swiss Bourdin. Tous droits réservés. EST. 2023</h5>
    </footer>
</html>