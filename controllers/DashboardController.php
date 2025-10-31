<?php

class DashboardController {


    public function admin(): void {
        
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 1) {
            header(header: 'Location: ?url=home');
            exit;
        }

        
        require_once 'views/admin_dashboard.php';
    }


    public function empresas(): void {
        
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 2) {
            header(header: 'Location: ?url=home');
            exit;
        }

        //
        echo "Dashboard Empresas - Próximamente";
    }

 
    public function cliente(): void {
        
        if (!isset($_SESSION['user_id']) || $_SESSION['id_rol'] != 3) {
            header(header: 'Location: ?url=home');
            exit;
        }

        
        echo "pagina  Cliente - Próximamente";
    }
}
