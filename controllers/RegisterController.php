<?php

require_once 'models/UserModel.php';

class RegisterController {

    // una funcion default 
    public function index(): never {
        header(header: 'Location: ?url=home');
        exit;
    }

    // Formulario de registro para Admin (3 campos) solo estos campos creo que son los necesarios 
    //para un administrador
    public function admin(): void {
        $role = 'admin';
        require_once 'views/register.php';
    }

    // Formulario de registro para Empresas usuario (7 campos)
    public function empresas(): void {
        $role = 'empresas';
        require_once 'views/register.php';
    }

    // Formulario de registro para Clientes (7 campos)
    public function cliente(): void {
        $role = 'cliente';
        require_once 'views/register.php';
    }

    // Procesar el registro
    public function store(): never {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(header: 'Location: ?url=home');
            exit;
        }

        $role = $_POST['role'] ?? '';
        $userModel = new UserModel();
        
        // parametros que no eston vacios 
        $email = $_POST['email'] ?? '';
        $usuario = $_POST['usuario'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Validar campos básicos
        if (empty($email) || empty($usuario) || empty($password)) {
            $_SESSION['error'] = 'Todos los campos son obligatorios';
            header(header: 'Location: ?url=register/' . $role);
            exit;
        }
        
        if ($userModel->emailExists(email: $email)) {
            $_SESSION['error'] = 'El email ya está registrado';
            header(header: 'Location: ?url=register/' . $role);
            exit;
        }
        
        if ($userModel->usernameExists(username: $usuario)) {
            $_SESSION['error'] = 'El usuario ya existe';
            header(header: 'Location: ?url=register/' . $role);
            exit;
        }

        $success = false;

        if ($role === 'admin') {
            // Registro de admin
            $data = [
                'usuario' => $usuario,
                'email' => $email,
                'password' => $_POST['password'] ?? ''
            ];
            $success = $userModel->registerAdmin(data: $data);
            
        } elseif ($role === 'empresas') {
            // Registro de empresa
            $data = [
                'nombre_empresa' => $_POST['nombre_empresa'] ?? '',
                'email' => $email,
                'password' => $_POST['password'] ?? '',
                'usuario' => $usuario,
                'telefono' => $_POST['telefono'] ?? '',
                'nit' => $_POST['nit'] ?? '',
                'direccion' => $_POST['direccion'] ?? ''
            ];
            $success = $userModel->registerEmpresa(data: $data);
            
        } elseif ($role === 'cliente') {
            // Registro de cliente
           
            $fechaNacimiento = $_POST['fecha_nacimiento'] ?? '';
            if (strpos(haystack: $fechaNacimiento, needle: '/') !== false) {
                $partes = explode(separator: '/', string: $fechaNacimiento);
                if (count(value: $partes) === 3) {
                    $fechaNacimiento = $partes[2] . '-' . $partes[1] . '-' . $partes[0];
                }
            }
            
            $data = [
                'usuario' => $usuario,
                'email' => $email,
                'password' => $_POST['password'] ?? '',
                'nombre_completo' => $_POST['nombre_completo'] ?? '',
                'apellidos' => $_POST['apellidos'] ?? '',
                'dui' => $_POST['dui'] ?? '',
                'fecha_nacimiento' => $fechaNacimiento
            ];
            $success = $userModel->registerCliente(data: $data);
        }

        if ($success) {
            $_SESSION['success'] = 'Registro exitoso. Ahora puedes iniciar sesion.';
            header(header: 'Location: ?url=login/' . $role);
        } else {
            $_SESSION['error'] = 'Error al registrar. Intenta nuevamente o espere.';
            header(header: 'Location: ?url=register/' . $role);
        }
        exit;
    }
}
