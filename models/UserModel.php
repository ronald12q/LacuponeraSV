<?php

require_once 'core/Database.php';
// en esta parte manejamos las insercciones con la bd

class UserModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }


    public function createUser($username, $email, $password, $id_rol): bool|string {
        try {
            $hashedPassword = password_hash(password: $password, algo: PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO usuarios (username, email, password, id_rol, estado) 
                    VALUES (:username, :email, :password, :id_rol, 'activo')";
            
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam(param: ':username', var: $username);
            $stmt->bindParam(param: ':email', var: $email);
            $stmt->bindParam(param: ':password', var: $hashedPassword);
            $stmt->bindParam(param: ':id_rol', var: $id_rol);
            
            $stmt->execute();
            return $this->conn->lastInsertId();
            
        } catch (PDOException $e) {
            error_log(message: "Error al crear usuario: " . $e->getMessage());
            return false;
        }
    }

    // Registrar cliente
    public function registerCliente($data): bool {
        try {
            $this->conn->beginTransaction();

            // 1. Crear usuario (rol cliente = 3)
            $id_usuario = $this->createUser(username: $data['usuario'], email: $data['email'], password: $data['password'], id_rol: 3);
            
            if (!$id_usuario) {
                $this->conn->rollBack();
                return false;
            }

            // 2. Crear registro en clientes_Usuarios
            $sql = "INSERT INTO clientes_Usuarios (id_usuario, nombre_completo, apellidos, DUI, fecha_nacimiento) 
                    VALUES (:id_usuario, :nombre_completo, :apellidos, :dui, :fecha_nacimiento)";
            
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam(param: ':id_usuario', var: $id_usuario);
            $stmt->bindParam(param: ':nombre_completo', var: $data['nombre_completo']);
            $stmt->bindParam(param: ':apellidos', var: $data['apellidos']);
            $stmt->bindParam(param: ':dui', var: $data['dui']);
            $stmt->bindParam(param: ':fecha_nacimiento', var: $data['fecha_nacimiento']);
            
            $stmt->execute();

            $this->conn->commit();
            return true;
            
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log(message: "Error al registrar cliente: " . $e->getMessage());
            return false;
        }
    }

    // Registrar empresa
    public function registerEmpresa($data): bool {
        try {
            $this->conn->beginTransaction();

            // 1. Crear usuario (rol empresa = 2)
            $id_usuario = $this->createUser(username: $data['usuario'], email: $data['email'], password: $data['password'], id_rol: 2);
            
            if (!$id_usuario) {
                $this->conn->rollBack();
                return false;
            }

            // 2. Crear registro en empresas
            $sql = "INSERT INTO empresas (id_usuario, nombre_empresa, NIT_empresa, direccion, telefono, aprobada) 
                    VALUES (:id_usuario, :nombre_empresa, :nit, :direccion, :telefono, FALSE)";
            
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam(param: ':id_usuario', var: $id_usuario);
            $stmt->bindParam(param: ':nombre_empresa', var: $data['nombre_empresa']);
            $stmt->bindParam(param: ':nit', var: $data['nit']);
            $stmt->bindParam(param: ':direccion', var: $data['direccion']);
            $stmt->bindParam(param: ':telefono', var: $data['telefono']);
            
            $stmt->execute();

            $this->conn->commit();
            return true;
            
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log(message: "Error al registrar empresa: " . $e->getMessage());
            return false;
        }
    }

    // Registrar admin
    public function registerAdmin($data): bool {
        try {
            // Crear usuario (rol admin = 1)
            $id_usuario = $this->createUser(username: $data['usuario'], email: $data['email'], password: $data['password'], id_rol: 1);
            return $id_usuario !== false;
            
        } catch (PDOException $e) {
            error_log(message: "Error al registrar administrador: " . $e->getMessage());
            return false;
        }
    }

    // Login - buscar usuario por email
    public function login($email, $password): mixed {
        try {
            $sql = "SELECT u.*, r.nombre_rol 
                    FROM usuarios u 
                    INNER JOIN roles r ON u.id_rol = r.id_rol 
                    WHERE u.email = :email AND u.estado = 'activo'";
            
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam(param: ':email', var: $email);
            $stmt->execute();
            
            $user = $stmt->fetch();
            
            if ($user && password_verify(password: $password, hash: $user['password'])) {
              
                unset($user['password']);
                return $user;
            }
            
            return false;
            
        } catch (PDOException $e) {
            error_log(message: "Error en el inicio de sesión: " . $e->getMessage());
            return false;
        }
    }

    // Verificar si email ya existe
    public function emailExists($email): bool {
        try {
            $sql = "SELECT id_usuario FROM usuarios WHERE email = :email";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam(param: ':email', var: $email);
            $stmt->execute();
            
            return $stmt->fetch() !== false;
            
        } catch (PDOException $e) {
            error_log(message: "Error al verificar email: " . $e->getMessage());
            return false;
        }
    }


    public function usernameExists($username): bool {
        try {
            $sql = "SELECT id_usuario FROM usuarios WHERE username = :username";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam(param: ':username', var: $username);
            $stmt->execute();
            
            return $stmt->fetch() !== false;
            
        } catch (PDOException $e) {
            error_log(message: "Error al verificar nombre de usuario: " . $e->getMessage());
            return false;
        }
    }
    public function updatePassword($email, $newPassword): bool {
        try {
            $hashedPassword = password_hash(password: $newPassword, algo: PASSWORD_DEFAULT);
            
            $sql = "UPDATE usuarios SET password = :password WHERE email = :email";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam(param: ':password', var: $hashedPassword);
            $stmt->bindParam(param: ':email', var: $email);
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log(message: "Error al actualizar contraseña: " . $e->getMessage());
            return false;
        }
    }
}
