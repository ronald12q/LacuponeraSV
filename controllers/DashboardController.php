
<!-- tenemos 3 pantallas una general donde vemos datos de manera general, la 
 otra es donde aprobamos o rechazamos una solicitud de una empresa para ingresar 
 la ultima para ver datos de empresas de forma detallada--!>

<?php

require_once 'models/AdminModel.php';

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

        // Cargar la vista del dashboard empresas
        require_once 'views/Empresas_dashboard.php';
    }

 
    public function cliente(): void {
        
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 3) {
            header(header: 'Location: ?url=home');
            exit;
        }

        
        echo "pagina  Cliente - Próximamente";
    }

 
    public function solicitudesEmpresas(): void {
       
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header('Location: ?url=home');
            exit;
        }

        
        $adminModel = new AdminModel();
        $solicitudes = $adminModel->getSolicitudesEmpresas();

        // Cargar la vista de solicitudes de empresas
        require_once 'views/solicitudes_empresas.php';
    }


    public function reporteEmpresas(): void {
       
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header('Location: ?url=home');
            exit;
        }

   
        $adminModel = new AdminModel();
        $empresas = $adminModel->getReporteEmpresas();

        // Cargar la vista de reporte de empresas
        require_once 'views/reporte_empresas.php';
    }

    // Aprobar empresa
    public function aprobarEmpresa(): never {
        // Verificar que el usuario esté logueado y sea admin
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header('Location: ?url=home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_empresa'])) {
            $adminModel = new AdminModel();
            $adminModel->aprobarEmpresa($_POST['id_empresa']);
        }

        header('Location: ?url=dashboard/solicitudesEmpresas');
        exit;
    }

    // Rechazar empresa
    public function rechazarEmpresa(): never {
        // Verificar que el usuario esté logueado y sea admin
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header('Location: ?url=home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_empresa'])) {
            $adminModel = new AdminModel();
            $adminModel->rechazarEmpresa($_POST['id_empresa']);
        }

        header('Location: ?url=dashboard/solicitudesEmpresas');
        exit;
    }
}
