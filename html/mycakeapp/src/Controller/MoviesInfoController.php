<?php

namespace App\Controller;

use App\Controller\AppController;

// 今のところappcontrollerを継承
class MoviesInfoController extends AppController
{


    public function index()

    {
        $this->layout = 'main';
        // echo "<html><body><h1>Hello!</h1>";
        // echo "<p>This is sample page.</p></body></html>";
    }
}
