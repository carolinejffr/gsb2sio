<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
    public function index(): string
    {

        $model = new HomeModel;

        $data = $model->findAll();

        return view('Home/index', 
        [
            // TODO : Utiliser la table visiteur pour se connecter
            "visiteur" => $data
        ]);
    }

    public function selectionMois(): string
    {
        // La page sélection n'a pas besoin de la base de données (selection valeur entre 1 et 12)
        return view('Selection/index');
    }

    public function note(): string
    {

        $model = new HomeModel;

        $data = $model->findAll();

        return view('Note/index', 
        [
            "fichefrais" => $data
        ]);
    }

    public function nouveau(): string
    {
        return view('Nouveau/index');
    }

    public function edition(): string
    {
        return view('Edition/index');
    }

    public function login(): string
    {
        return view('Login/index');
    }

    public function deconnexion(): string
    {
        return view('Deconnexion/index');
    }
    public function supprimer(): string
    {
        return view('Supprimer/index');
    }
}
