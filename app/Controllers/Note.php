<?php

namespace App\Controllers;

use App\Models\NoteModel;

class Note extends BaseController
{
    public function index(): string
    {

        $model = new NoteModel;

        $data = $model->findAll();

        return view('Note/index', 
        [
            "fichefrais" => $data
        ]);
    }
}
