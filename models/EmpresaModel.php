<?php

require_once 'core/Database.php';

class EmpresaModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getEstadisticasEmpresa($id_usuario) {
        $stats = [];
        
     
        $stmt = $this->db->prepare("SELECT id_empresa FROM empresas WHERE id_usuario = :id_usuario");
        $stmt->execute(['id_usuario' => $id_usuario]);
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$empresa) {
            return [
                'cupones_ofertados' => 0,
                'cupones_vendidos' => 0,
                'total_ventas' => 0,
                'solicitudes_pendientes' => 0
            ];
        }
        
        $id_empresa = $empresa['id_empresa'];
        
  
        $stmt = $this->db->prepare("SELECT COALESCE(SUM(cantidad_cupones), 0) as total FROM cupones WHERE id_empresa = :id_empresa");
        $stmt->execute(['id_empresa' => $id_empresa]);
        $stats['cupones_ofertados'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(co.cantidad), 0) as total 
            FROM compras co
            INNER JOIN cupones cu ON co.id_oferta = cu.id_oferta
            WHERE cu.id_empresa = :id_empresa
        ");
        $stmt->execute(['id_empresa' => $id_empresa]);
        $stats['cupones_vendidos'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(co.total_pagado), 0) as total 
            FROM compras co
            INNER JOIN cupones cu ON co.id_oferta = cu.id_oferta
            WHERE cu.id_empresa = :id_empresa
        ");
        $stmt->execute(['id_empresa' => $id_empresa]);
        $stats['total_ventas'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
    
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total 
            FROM cupones 
            WHERE id_empresa = :id_empresa AND estado_oferta = 'pendiente'
        ");
        $stmt->execute(['id_empresa' => $id_empresa]);
        $stats['solicitudes_pendientes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        return $stats;
    }

    
    public function crearCupon($id_usuario, $data) {
        try {
         
            $stmt = $this->db->prepare("SELECT id_empresa FROM empresas WHERE id_usuario = :id_usuario");
            $stmt->execute(['id_usuario' => $id_usuario]);
            $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$empresa) {
                return false;
            }
            
            $query = "INSERT INTO cupones (
                id_empresa, 
                titulo, 
                descripcion, 
                precio_regular, 
                precio_oferta, 
                fecha_inicio, 
                fecha_fin, 
                fecha_limite_canje, 
                cantidad_cupones, 
                estado_oferta, 
                Categoria
            ) VALUES (
                :id_empresa, 
                :titulo, 
                :descripcion, 
                :precio_regular, 
                :precio_oferta, 
                :fecha_inicio, 
                :fecha_fin, 
                :fecha_limite_canje, 
                :cantidad_cupones, 
                :estado_oferta, 
                :categoria
            )";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                'id_empresa' => $empresa['id_empresa'],
                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion'],
                'precio_regular' => $data['precio_regular'],
                'precio_oferta' => $data['precio_oferta'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_fin' => $data['fecha_fin'],
                'fecha_limite_canje' => $data['fecha_limite_canje'],
                'cantidad_cupones' => $data['cantidad'],
                'estado_oferta' => $data['estado_oferta'],
                'categoria' => $data['categoria']
            ]);
        } catch (PDOException $e) {
            error_log("Error al crear cupón: " . $e->getMessage());
            return false;
        }
    }
}
