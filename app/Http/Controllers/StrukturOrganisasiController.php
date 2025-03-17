<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    //

   
    public function index()
    {
        // $companies = $this->apiController->getCompanies();
        // dd($companies);

        return view('menu.struktur-organisasi');

    }
}
