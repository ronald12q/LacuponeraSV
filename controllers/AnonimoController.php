<!-- el anonimo tiene la misma pantalla que un usuario registrado pero solo puede visualizar 
 no hacer ninguna accion --!>

<?php

require_once 'models/HomeModel.php';

class AnonimoController {
    private $model;

    public function __construct() {
        $this->model = new HomeModel();
    }


    public function index(): void {
        $cupones = $this->model->getCuponesDisponibles();
        $categorias = $this->model->getCategorias();
        
        require_once 'views/cupones_publicos.php';
    }


    public function buscar(): void {
        $busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';
        
        if (!empty($busqueda)) {
            $cupones = $this->model->buscarCupones($busqueda);
        } else {
            $cupones = $this->model->getCuponesDisponibles();
        }
        
        $categorias = $this->model->getCategorias();
        
        require_once 'views/cupones_publicos.php';
    }


    public function categoria(): void {
        $categoriaActual = isset($_GET['cat']) ? trim($_GET['cat']) : '';
        
        if (!empty($categoriaActual)) {
            $cupones = $this->model->getCuponesPorCategoria($categoriaActual);
        } else {
            $cupones = $this->model->getCuponesDisponibles();
        }
        
        $categorias = $this->model->getCategorias();
        
        require_once 'views/cupones_publicos.php';
    }


    public function verCupon(): void {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header('Location: ?url=anonimo');
            exit;
        }
        
        $cupon = $this->model->getCuponById($id);
        
        if (!$cupon) {
            $_SESSION['error'] = 'Cupón no encontrado';
            header('Location: ?url=anonimo');
            exit;
        }
        
        require_once 'views/detalle_cupon.php';
    }
}
