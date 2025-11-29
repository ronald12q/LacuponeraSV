<?php

require_once 'core/Database.php';

class AdminModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

   
    public function getEstadisticasGenerales() {
        $stats = [];
        
        // Total empresas registradas
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM empresas WHERE aprobada = 1");
        $stats['empresas_registradas'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Total usuarios registrados
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM usuarios WHERE estado = 'activo'");
        $stats['usuarios_registrados'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Total ventas
        $stmt = $this->db->query("SELECT COALESCE(SUM(total_pagado), 0) as total FROM compras");
        $stats['ventas_totales'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Total cupones vendidos
        $stmt = $this->db->query("SELECT COALESCE(SUM(cantidad), 0) as total FROM compras");
        $stats['cupones_vendidos'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        return $stats;
    }


    public function getSolicitudesEmpresas() {
        $query = "SELECT e.id_empresa, e.nombre_empresa, e.fecha_registro, u.email 
                  FROM empresas e
                  INNER JOIN usuarios u ON e.id_usuario = u.id_usuario
                  WHERE e.aprobada = 0
                  ORDER BY e.fecha_registro DESC";
        
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function aprobarEmpresa($id_empresa) {
        $query = "UPDATE empresas SET aprobada = 1 WHERE id_empresa = :id_empresa";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id_empresa' => $id_empresa]);
    }


    public function rechazarEmpresa($id_empresa) {
        
        $query = "DELETE FROM empresas WHERE id_empresa = :id_empresa";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id_empresa' => $id_empresa]);
    }

        public function getReporteEmpresas() {
        $query = "SELECT 
                    e.id_empresa,
                    e.nombre_empresa,
                    COALESCE(SUM(co.total_pagado), 0) as total_ventas,
                    COALESCE(SUM(co.cantidad), 0) as cupones_vendidos,
                    COALESCE(SUM(cu.cantidad_cupones), 0) as cupones_disponibles,
                    COALESCE(SUM(co.total_pagado * ac.porcentaje_comision / 100), 0) as total_ganancias
                  FROM empresas e
                  LEFT JOIN cupones cu ON e.id_empresa = cu.id_empresa
                  LEFT JOIN compras co ON cu.id_oferta = co.id_oferta
                  LEFT JOIN admin_comisiones ac ON e.id_empresa = ac.id_empresa
                  WHERE e.aprobada = 1
                  GROUP BY e.id_empresa, e.nombre_empresa
                  ORDER BY total_ventas DESC";
        
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
