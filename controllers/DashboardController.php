
<!-- tenemos 3 pantallas una general donde vemos datos de manera general, la 
 otra es donde aprobamos o rechazamos una solicitud de una empresa para ingresar 
 la ultima para ver datos de empresas de forma detallada--!>

<?php

require_once 'models/AdminModel.php';
require_once 'models/EmpresaModel.php';

class DashboardController {

    public function admin(): void {
        
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header(header: 'Location: ?url=home');
            exit;
        }

        

        $adminModel = new AdminModel();
        $estadisticas = $adminModel->getEstadisticasGenerales();
        
        require_once 'views/admin_dashboard.php';
    }


    public function empresas(): void {
        // Verificar que el usuario esté logueado y sea empresa 
        // si intentamos acceder directo hacia el dashboard nos envia 
        // hacia home como se pide 
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 2) {
            header('Location: ?url=home');
            exit;
        }

        // Obtener estadísticas de la empresa
        $empresaModel = new EmpresaModel();
        $estadisticas = $empresaModel->getEstadisticasEmpresa($_SESSION['user_id']);

        // Cargar la vista del dashboard empresas
        require_once 'views/Empresas_dashboard.php';
    }

 
    public function cliente(): never {
        // Redirigir al nuevo ClienteController
        header('Location: ?url=cliente');
        exit;
    }

 
    public function solicitudesEmpresas(): void {
       
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header('Location: ?url=home');
            exit;
        }

        
        $adminModel = new AdminModel();
        $solicitudes = $adminModel->getSolicitudesEmpresas();

        require_once 'views/solicitudes_empresas.php';
    }


    public function reporteEmpresas(): void {
       
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header(header: 'Location: ?url=home');
            exit;
        }

   
        $adminModel = new AdminModel();
        $empresas = $adminModel->getReporteEmpresas();

        require_once 'views/reporte_empresas.php';
    }

    public function aprobarEmpresa(): never {
        
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header(header: 'Location: ?url=home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_empresa'])) {
            $adminModel = new AdminModel();
            $adminModel->aprobarEmpresa(id_empresa: $_POST['id_empresa']);
        }

        header(header: 'Location: ?url=dashboard/solicitudesEmpresas');
        exit;
    }

  
    public function rechazarEmpresa(): never {
       
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header(header: 'Location: ?url=home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_empresa'])) {
            $adminModel = new AdminModel();
            $adminModel->rechazarEmpresa(id_empresa: $_POST['id_empresa']);
        }

        header(header: 'Location: ?url=dashboard/solicitudesEmpresas');
        exit;
    }


    public function ofertarCupon(): void {
        
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 2) {
            header(header: 'Location: ?url=home');
            exit;
        }


        require_once 'views/ofertar_cupon.php';
    }


    public function guardarCupon(): never {
   
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 2) {
            header(header: 'Location: ?url=home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(header: 'Location: ?url=dashboard/empresas');
            exit;
        }

        $data = [
            'titulo' => $_POST['titulo'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'precio_regular' => $_POST['precio_regular'] ?? 0,
            'precio_oferta' => $_POST['precio_oferta'] ?? 0,
            'fecha_inicio' => $_POST['fecha_inicio'] ?? '',
            'fecha_fin' => $_POST['fecha_fin'] ?? '',
            'fecha_limite_canje' => $_POST['fecha_limite_canje'] ?? '',
            'cantidad' => $_POST['cantidad'] ?? 0,
            'estado_oferta' => $_POST['estado_oferta'] ?? 'Disponible',
            'categoria' => $_POST['categoria'] ?? ''
        ];

        $empresaModel = new EmpresaModel();
        if ($empresaModel->crearCupon(id_usuario: $_SESSION['user_id'], data: $data)) {
            $_SESSION['success'] = 'Cupón publicado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al publicar el cupón';
        }

        header(header: 'Location: ?url=dashboard/empresas');
        exit;
    }
}
