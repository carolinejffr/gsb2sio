<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
    <?php session_start(); 

    // On vérifie que l'utilisateur est connecté.
    if (!isset( $_SESSION['login']) || !isset( $_SESSION['mdp']))
    {
        header("location:index.php?error=3");
        exit;
    }

    try
    {
        // Connexion à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=gsbv2;charset=utf8', 'root', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $reponse = $bdd->prepare('SELECT * FROM gsbv2.FicheFrais WHERE idFrais = ?');
    $reponse->execute(array($_GET['idFrais']));

            while ($donnees = $reponse->fetch())
            {
                    $idFrais = $donnees['idFrais'];
                    $idVisiteur = $donnees['idVisiteur'];
                    $mois = $donnees['mois'];
                    $nbJustificatifs = $donnees['nbJustificatifs'];
                    $montantValide = $donnees['montantValide'];
                    $dateModif = $donnees['dateModif'];
                    $idEtat = $donnees['idEtat'];	
            }
            
            $reponse->closeCursor();

    $errorMessage = "";
    $successMessage = "";

    if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
    {

        
        if ( !isset($_GET["idFrais"]) )
        {
            header("location:note");
            exit;
        }
        
            $idFrais = $_GET["idFrais"];
        
        // Lecture de la ligne correspondate à l'ID dans la database.
        $sql = "SELECT * FROM FicheFrais WHERE idFrais = $idFrais";
        $result = $bdd->query($sql);
        
        $row = $result->fetch();
        
        if (!$row)
        {
            header("location:note");
            exit;
        }
        
        
        $mois = $row["mois"];
        $nbJustificatifs = $row["nbJustificatifs"];
        $montantValide = $row["montantValide"];
        $idEtat = $row["idEtat"];
    }
    else
    {
        // si méthode POST : update des données
        $mois = $_POST["mois"];
        $nbJustificatifs = $_POST["nbJustificatifs"];
        $montantValide = $_POST["montantValide"];
        $idEtat = $_POST["idEtat"];
        
        do {
            if (empty($mois) || empty($nbJustificatifs) || empty($montantValide) || empty($idEtat))
                {
                    $errorMessage = "Remplissez tous les champs";
                    break;
                }
            // Modification SQL
            
            date_default_timezone_set('Europe/Paris');
            $aujourdhui = date('Y-m-d H:i:s');
            
            $reponse = $bdd->prepare("UPDATE FicheFrais ".
            "SET mois = '$mois', nbJustificatifs = '$nbJustificatifs', montantValide = '$montantValide', dateModif = '$aujourdhui', idEtat = '$idEtat' " .
            "WHERE idFrais = '$idFrais'");
            $reponse->execute(array());
            
            
            $successMessage = "Note de frais correctement éditée";
                
            header("location:note");
            exit;
            $reponse->closeCursor();
        } while (false);
    }
    ?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<h2>Edition</h2>
	
	<?php
	if (!empty($errorMessage))
	{
		echo "
		<div class='alert alert-warning alert-dismissible fade show' role='alert'>
			<strong>$errorMessage</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>	
		";
	}
	?>
	
	<form method="post">
		<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Mois (1 = janvier, etc.)</label>
			<div class="col-sm-6">
				<input type="number" class="form-control" name="mois" value="<?php echo $mois; ?>" min="1" max="12" step="1">
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Nombre Justificatifs</label>
			<div class="col-sm-6">
				<input type="number" class="form-control" name="nbJustificatifs" value="<?php echo $nbJustificatifs; ?>">
			</div>
		</div>
		
		
		<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Montant Valide</label>
			<div class="col-sm-6">
				<input type="number" class="form-control" name="montantValide" value="<?php echo $montantValide; ?>" min="0.01" step="0.01">
			</div>
		</div>
		
				<div class="row mb-3">
			<label class="col-sm-3 col-form-label">ID Etat</label>
			<div class="col-sm-6">
				<select id="idEtat" class="form-control" name="idEtat" value="<?php echo $idEtat; ?>">
					<option value="CL">Saisie clôturée</option>
					<option value="CR">Fiche créée, saisie en cours</option>
					<option value="RB">Remboursée</option>
					<option value="VA">Validée et mise en paiement</option>
				</select>
			</div>
		</div>
		
	<?php
	if (!empty($successMessage))
	{
		echo "
		<div class='alert alert-success alert-dismissible fade show' role='alert'>
			<strong>$successMessage</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>	
		";
	}
	?>
		
		<div class="row mb-3">
			<div class="offset-sm-3 col-sm-3 d-grid">
				<button type="submit" class="btn btn-primary">Valider</button>
			</div>
			<div class="col-sm-3 d-grid">
				<a class="btn btn-outline-primary" href="note" role="button">Annuler</a>
			</div>
		</div>
	</form>
	</body>
<?= $this->endSection() ?>