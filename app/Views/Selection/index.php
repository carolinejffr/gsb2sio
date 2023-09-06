<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
    <?php 
    session_start();
    $mois = date('n');
    ?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

    <p>Veuillez choisir le mois à afficher.</p>
    <form action="note" method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Mois (1 = janvier, etc.)</label>
            <div class="col-sm-6">
            <input type="number" class="form-control" name="mois" value="<?php echo $mois; ?>" min="1" max="12" step="1">
        </div>
        <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>

<?= $this->endSection() ?>