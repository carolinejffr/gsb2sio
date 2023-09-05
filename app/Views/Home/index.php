<?= $this->extend("layouts/default") ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("header") ?>

	<a class='btn btn-success btn-sm' href='selection.php'>Changer de mois</a>
	<a class='btn btn-danger btn-sm' href='deconnexion.php'>Se déconnecter</a>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

	<p>Bonjour ! Le site est en construction.</p>

	<a class="btn btn-primary" href="create.php" role="button">Nouveau</a>
	<table class="table">
		<thead class="text-bg-dark p-3">
			<tr>
				<th>Visiteur</th>
				<th>Mois</th>
				<th>Nombre justificatifs</th>
				<th>Montant validé</th>
				<th>Date modification</th>
				<th>État</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($fichefrais as $ligne): ?>
				<tr class="text-bg-dark p-3">
					<td><?= $ligne["idVisiteur"] ?></td>
					<td><?= $ligne["mois"] ?></td>
					<td><?= $ligne["nbJustificatifs"] ?></td>
					<td><?= $ligne["montantValide"] ?></td>
					<td><?= $ligne["dateModif"] ?></td>
					<td><?= $ligne["idEtat"] ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<?= $this->endSection() ?>