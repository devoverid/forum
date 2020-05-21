<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = $this->getOwners();
        return view('pages.owner', compact('owners'));
    }

    public function getOwners()
    {
        $owners = json_decode( file_get_contents(app_path("owners.json")), true );
        return $owners;
    }
}
