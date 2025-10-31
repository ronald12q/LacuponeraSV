<?php

require_once 'models/UserModel.php';

class LoginController {

    // Mostrar formulario de login según el rol
    public function index(): never {
        // hacemos un excepcion 
        header(header: 'Location: ?url=home');
        exit;
    }

    // ruta para cada rol 
    public function empresas(): void {
        $role = 'empresas';
        require_once 'views/login.php';
    }

    public function admin(): void {
        $role = 'admin';
        require_once 'views/login.php';
    }

    public function cliente(): void {
        $role = 'cliente';
        require_once 'views/login.php';
    }

    
    public function authenticate(): never {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(header: 'Location: ?url=home');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        $userModel = new UserModel();
        $user = $userModel->login(email: $email, password: $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['nombre_rol'];
            $_SESSION['id_rol'] = $user['id_rol'];

            // Redirigir según el rol
            if ($user['id_rol'] == 1) {
                // Admin
                header(header: 'Location: ?url=dashboard/admin');
            } elseif ($user['id_rol'] == 2) {
                // Empresa
                header(header: 'Location: ?url=dashboard/empresas');
            } elseif ($user['id_rol'] == 3) {
                // Cliente
                header(header: 'Location: ?url=dashboard/cliente');
            } else {
                //mandamos a home o raiz de nuevo
                header(header: 'Location: ?url=home');
            }
            exit;
        } else {
            // Login fallido
            $_SESSION['error'] = 'Email o contraseña incorrectos';
            header(header: 'Location: ?url=login/' . $role);
            exit;
        }
    }

    // Cerrar sesión
    public function logout(): never {
        session_destroy();
        header(header: 'Location: ?url=home');
        exit;
    }
}
