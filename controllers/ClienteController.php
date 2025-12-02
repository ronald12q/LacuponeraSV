<?php

require_once 'models/HomeModel.php';
require_once 'models/ClienteModel.php';

class ClienteController {
    private $homeModel;
    private $clienteModel;

    public function __construct() {
        $this->homeModel = new HomeModel();
        $this->clienteModel = new ClienteModel();
    }


    private function verificarCliente(): bool {
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 3) {
            header(header: 'Location: ?url=login/cliente');
            exit;
        }
        return true;
    }

    
    public function index(): void {
        $this->verificarCliente();
        
        $cupones = $this->homeModel->getCuponesDisponibles();
        $categorias = $this->homeModel->getCategorias();
        
        require_once 'views/cliente_dashboard.php';
    }

   
    public function buscar(): void {
        $this->verificarCliente();
        
        $busqueda = isset($_GET['q']) ? trim(string: $_GET['q']) : '';
        
        if (!empty($busqueda)) {
            $cupones = $this->homeModel->buscarCupones(termino: $busqueda);
        } else {
            $cupones = $this->homeModel->getCuponesDisponibles();
        }
        
        $categorias = $this->homeModel->getCategorias();
        
        require_once 'views/cliente_dashboard.php';
    }


    public function categoria(): void {
        $this->verificarCliente();
        
        $categoriaActual = isset($_GET['cat']) ? trim(string: $_GET['cat']) : '';
        
        if (!empty($categoriaActual)) {
            $cupones = $this->homeModel->getCuponesPorCategoria(categoria: $categoriaActual);
        } else {
            $cupones = $this->homeModel->getCuponesDisponibles();
        }
        
        $categorias = $this->homeModel->getCategorias();
        
        require_once 'views/cliente_dashboard.php';
    }

   
    public function verCupon(): void {
        $this->verificarCliente();
        
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header(header: 'Location: ?url=cliente');
            exit;
        }
        
        $cupon = $this->homeModel->getCuponById(id: $id);
        
        if (!$cupon) {
            $_SESSION['error'] = 'Cupón no encontrado';
            header(header: 'Location: ?url=cliente');
            exit;
        }
        
        $esCliente = true;
        require_once 'views/detalle_cupon.php';
    }

    public function comprar(): void {
        $this->verificarCliente();
        
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header(header: 'Location: ?url=cliente');
            exit;
        }
        
        $cupon = $this->homeModel->getCuponById(id: $id);
        
        if (!$cupon || $cupon['cantidad_cupones'] <= 0) {
            $_SESSION['error'] = 'Cupón no disponible';
            header(header: 'Location: ?url=cliente');
            exit;
        }
        
        require_once 'views/comprar_cupon.php';
    }

 
    public function procesarCompra(): never {
        $this->verificarCliente();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(header: 'Location: ?url=cliente');
            exit;
        }

        $id_oferta = isset($_POST['id_oferta']) ? (int)$_POST['id_oferta'] : 0;
        $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

        if ($id_oferta <= 0 || $cantidad <= 0) {
            $_SESSION['error'] = 'Datos inválidos';
            header(header: 'Location: ?url=cliente');
            exit;
        }

        
        $cupon = $this->homeModel->getCuponById(id: $id_oferta);
        
        if (!$cupon || $cupon['cantidad_cupones'] < $cantidad) {
            $_SESSION['error'] = 'No hay suficientes cupones disponibles';
            header(header: 'Location: ?url=cliente/comprar&id=' . $id_oferta);
            exit;
        }

     
        $resultado = $this->clienteModel->comprarCupon(
            id_usuario: $_SESSION['user_id'],
            id_oferta: $id_oferta,
            cantidad: $cantidad,
            precio_oferta: $cupon['precio_oferta']
        );

        if ($resultado) {
            $_SESSION['success'] = '¡Compra realizada exitosamente!';
            header(header: 'Location: ?url=cliente');
        } else {
            $_SESSION['error'] = 'Error al procesar la compra. Intenta nuevamente.';
            header(header: 'Location: ?url=cliente/comprar&id=' . $id_oferta);
        }
        exit;
    }
}
