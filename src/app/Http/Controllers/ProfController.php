<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfController extends Controller
{
    public function prof()
    {
        return view('pg09_prof');
    }

    public function profUpd()
    {
        return view('pg10_prof_edit');
    }
}
