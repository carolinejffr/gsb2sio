<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('Home/index');
    }

    public function login(): string
    {
        $model = new HomeModel;

        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }

        // On test les identifiants de connexion
        $data['login_valide'] = $model::verifLogin($_POST['login']);
        $data['mdp_valide'] = $model::verifPassword($_POST['mdp']);

        // Vue
        return view('Login/login', $data);
    }

    public function selectionMois(): string
    {
        // La page sélection n'a pas besoin de la base de données (selection valeur entre 1 et 12)
        return view('Selection/selection');
    }

    public function note(): string
    {

        $model = new HomeModel;
        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }
        $login = $_POST['login'];
        $data['login'] = $login;
        $data['mois'] = $_POST['mois'];
        $data['id'] = $model::getIdUtilisateur($login);
        $data['nom'] = $model::getNomUtilisateur($login);
        $data['prenom'] = $model::getPrenomUtilisateur($login);
        $data['reponse'] = $model::getFicheFrais($_POST['mois']);

        return view('Note/note', $data);
    }

    public function nouveau(): string
    {
        
        session_start();
        $model = new HomeModel;
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }

        $login = $_SESSION['login'];
        $data['login'] = $login;

        $data['id'] = $model::getIdUtilisateur($login);
        
        $data['reponse'] = $model::getReponse();
        $data['row'] =  $model::getRow();

        return view('Nouveau/nouveau', $data);
    }

    public function edition(): string
    {
        return view('Edition/edition');
    }

    public function deconnexion(): string
    {
        return view('Deconnexion/deconnexion');
    }
    public function supprimer(): string
    {
        $model = new HomeModel;
        $id = $_GET['idFrais'];
        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }

        $model::supprimerLigne($bdd, $id);
        
        return view('Validation/validation');
    }
    public function nouveauPost(): string
    {
        $model = new HomeModel;
        $id = $_GET['idFrais'];
        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }
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
            
            
            $idVisiteur = esc($id);

            date_default_timezone_set('Europe/Paris');
            $aujourdhui = date('Y-m-d H:i:s');
            
            $reponse = $bdd->prepare("INSERT INTO `gsbv2`.`FicheFrais` 
            (`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) 
            VALUES ('$idVisiteur', '$mois', '$nbJustificatifs', '$montantValide', '$aujourdhui', '$idEtat');");
            $reponse->execute(array());
            
            $successMessage = "Note de frais correctement éditée";
                
            header("location:validation");
            exit;
            $reponse->closeCursor();
        } while (false);
        return view('Validation/validation');
    }
}
