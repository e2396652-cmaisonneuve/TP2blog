<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Comment;
use App\Models\User;
use App\Providers\View;

class HomeController
{

    public function index()
    {
        return View::render('home');
    }
}
