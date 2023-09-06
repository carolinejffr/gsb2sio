<?php

namespace App\Controllers;

class Selection extends BaseController
{
    public function index(): string
    {

        return view('Selection/index');
    }
}
