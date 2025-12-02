<?php

require_once 'models/HomeModel.php';

class HomeController {
    private $model;

    public function __construct() {
        $this->model = new HomeModel();
    }


    public function index(): void {
        require_once 'views/home.php';
    }

 
    public function cupones(): void {
        $cupones = $this->model->getCuponesDisponibles();
        $categorias = $this->model->getCategorias();
        
        require_once 'views/cupones_publicos.php';
    }

   
    public function buscar(): void {
        $busqueda = isset($_GET['q']) ? trim(string: $_GET['q']) : '';
        
        if (!empty($busqueda)) {
            $cupones = $this->model->buscarCupones(termino: $busqueda);
        } else {
            $cupones = $this->model->getCuponesDisponibles();
        }
        
        $categorias = $this->model->getCategorias();
        
        require_once 'views/cupones_publicos.php';
    }

        public function categoria(): void {
        $categoriaActual = isset($_GET['cat']) ? trim(string: $_GET['cat']) : '';
        
        if (!empty($categoriaActual)) {
            $cupones = $this->model->getCuponesPorCategoria(categoria: $categoriaActual);
        } else {
            $cupones = $this->model->getCuponesDisponibles();
        }
        
        $categorias = $this->model->getCategorias();
        
        require_once 'views/cupones_publicos.php';
    }

    public function verCupon(): void {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header(header: 'Location: ?url=home/cupones');
            exit;
        }
        
        $cupon = $this->model->getCuponById(id: $id);
        
        if (!$cupon) {
            $_SESSION['error'] = 'Cupón no encontrado';
            header(header: 'Location: ?url=home/cupones');
            exit;
        }
        
        require_once 'views/detalle_cupon.php';
    }
}