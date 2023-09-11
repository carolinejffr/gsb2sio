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
        $model = new HomeModel;
        
        return view('Nouveau/nouveau');
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
        return view('Supprimer/supprimer');
    }
}
