<?php

require_once 'models/HomeModel.php';

class HomeController {

    public function index() {

        $model = new HomeModel();

        $data = $model->getData();

        // Pass data to view

        require_once 'views/home.php';

    }

}