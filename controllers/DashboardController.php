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
        // Verificar que el usuario esté logueado y sea empresa 
        // si intentamos acceder directo hacia el dashboard nos envia 
        // hacia home 
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
}
