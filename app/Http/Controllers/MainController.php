<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller {

    public function index() {

        return view("index");
    }

    public function search() {

        return view("search-tool");
    }

}
