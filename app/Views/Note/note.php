<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
<?php 


// On vérifie que l'utilisateur est connecté.
if (esc($login) == NULL)
{
	header("location:index.php?error=3");
	exit;
}
?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

	<a class='btn btn-success btn-sm' href='selection'>Changer de mois</a>
	<a class='btn btn-danger btn-sm' href='deconnexion'>Se déconnecter</a>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<p> Vous êtes connecté en tant que 
	<?php 
		echo esc($prenom); 
	?> 
	<?php 
		echo esc($nom);
	?>.
	</p>
	<a class="btn btn-primary" href="nouveau" role="button">Nouveau</a>
	<table class="table">
		<thead class="text-bg-dark p-3">
			<tr>
				<!--<th>ID</th> -->
				<th>Visiteur</th>
				<th>Mois</th>
				<th>Nombre justificatifs</th>
				<th>Montant validé</th>
				<th>Date modification</th>
				<th>État</th>
				<th>Édition</th>
			</tr>
		</thead>	
			<tbody>
			<?php
			$donnees = esc($donnees);
			$reponse = esc($reponse);
		while ($donnees = $reponse->fetch())
		{
			echo "
				<tr class='text-bg-dark p-3'>
					<!-- <td>$donnees[idFrais]</td> -->
					<td>$donnees[idVisiteur]</td>
					<td>$donnees[mois]</td>
					<td>$donnees[nbJustificatifs]</td>
					<td>$donnees[montantValide]</td>
					<td>$donnees[dateModif]</td>
					<td>$donnees[idEtat]</td>
					<td>";

					if ($donnees['idVisiteur'] == $_SESSION['id'])
					{
						echo "
						<a class='btn btn-primary btn-sm' href='edition?idFrais=$donnees[idFrais]'>Modifier</a>
						<a class='btn btn-danger btn-sm' href='supprimer?idFrais=$donnees[idFrais]'>Supprimer</a>
						";
					}
					echo 
					"</td>
				</tr>";
		}
	?>

			</tbody>
		</table>

<?= $this->endSection() ?>