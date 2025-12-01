<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function index()
    {
        return "This response comes from the FirstController.";
    }

    public function home()
    {
        return "This is the home Page.";
    }

    public function support()
    {
        return "This is the support Page.";
    }

    public function about()
    {
        return "This is the about Page.";
    }
}
