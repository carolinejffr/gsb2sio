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
    $reponse = $bdd->prepare('SELECT * FROM gsbv2.FicheFrais');
    $reponse->execute(array());

            while ($donnees = $reponse->fetch())
            {
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
        
        // Lecture de la ligne correspondante à l'ID dans la database.
        $sql = "SELECT * FROM FicheFrais";
        $result = $bdd->query($sql);
        
        $row = $result->fetch();
        
        
        $mois = date('n');
        $nbJustificatifs = 0;
        $montantValide = 0;
        $idEtat = "CL";
    }
    else
    {
        // si méthode POST : update des données
        $mois = date('n');
        $nbJustificatifs = $_POST["nbJustificatifs"];
        $montantValide = $_POST["montantValide"];
        $idEtat = $_POST["idEtat"];
        
        do {
            // On vérifie que tous les champs sont renseignés
            if (empty($mois) || empty($nbJustificatifs) || empty($montantValide) || empty($idEtat))
                {
                    $errorMessage = "Remplissez tous les champs";
                    break;
                }
            // Modification SQL
            
            
            $idVisiteur = $_SESSION['id'];

            date_default_timezone_set('Europe/Paris');
            $aujourdhui = date('Y-m-d H:i:s');
            
            $reponse = $bdd->prepare("INSERT INTO `gsbv2`.`FicheFrais` 
    (`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) 
    VALUES ('$idVisiteur', '$mois', '$nbJustificatifs', '$montantValide', '$aujourdhui', '$idEtat');");
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

<h2>Modification</h2>
	
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
				<input type="number" class="form-control" name="mois" value="<?php echo $mois; ?>" min="1" max="12" step="1" readonly>
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
					<option selected="selected" value="CR">Fiche créée, saisie en cours</option>
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

<?= $this->endSection() ?>