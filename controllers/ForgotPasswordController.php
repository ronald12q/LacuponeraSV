<?php

class ForgotPasswordController {
    private $userModel;

    public function __construct() {
        require_once 'models/UserModel.php';
        $this->userModel = new UserModel();
    }

    // Mostrar el formulario de recuperación
    public function index(): void {
        require_once 'views/forgot_password.php';
    }

    // Procesar la recuperación de contraseña
    public function reset(): never {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(header: 'Location: ?url=forgotPassword');
            exit();
        }

        $email = trim(string: $_POST['email'] ?? '');
        $newPassword = $_POST['new_password'] ?? '';

        // Validaciones
        if (empty($email) || empty($newPassword)) {
            $_SESSION['error'] = 'Todos los campos son obligatorios';
            header(header: 'Location: ?url=forgotPassword');
            exit();
        }

        if (!filter_var(value: $email, filter: FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Correo electrónico inválido';
            header(header: 'Location: ?url=forgotPassword');
            exit();
        }

        if (strlen(string: $newPassword) < 6) {
            $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
            header(header: 'Location: ?url=forgotPassword');
            exit();
        }

        // Verificar si el email existe
        if (!$this->userModel->emailExists(email: $email)) {
            $_SESSION['error'] = 'El correo electrónico no está registrado';
            header(header: 'Location: ?url=forgotPassword');
            exit();
        }

        // Actualizar la contraseña
        if ($this->userModel->updatePassword(email: $email, newPassword: $newPassword)) {
            $_SESSION['success'] = 'Contraseña actualizada exitosamente. Ya puedes iniciar sesión.';
            header(header: 'Location: ?url=login');
            exit();
        } else {
            $_SESSION['error'] = 'Error al actualizar la contraseña. Intenta nuevamente o espera.';
            header(header: 'Location: ?url=forgotPassword');
            exit();
        }
    }
}
