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
}
