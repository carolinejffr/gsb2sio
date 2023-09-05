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
            "fichefrais" => $data
        ]);
    }
}
