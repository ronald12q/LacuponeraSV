<?php

require_once 'models/HomeModel.php';

class HomeController {

    public function index(): void {

        $model = new HomeModel();

        $data = $model->getData();

        

        require_once 'views/home.php';

    }

}