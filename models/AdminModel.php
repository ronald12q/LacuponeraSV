<?php

require_once 'core/Database.php';

class AdminModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

   
    public function getEstadisticasGenerales(): array {
        $stats = [];
        
        // Total empresas registradas
        $stmt = $this->db->query(query: "SELECT COUNT(*) as total FROM empresas WHERE aprobada = 1");
        $stats['empresas_registradas'] = $stmt->fetch(mode: PDO::FETCH_ASSOC)['total'];
        
        // Total usuarios registrados
        $stmt = $this->db->query(query: "SELECT COUNT(*) as total FROM usuarios WHERE estado = 'activo'");
        $stats['usuarios_registrados'] = $stmt->fetch(mode: PDO::FETCH_ASSOC)['total'];
        
        // Total ventas
        $stmt = $this->db->query(query: "SELECT COALESCE(SUM(total_pagado), 0) as total FROM compras");
        $stats['ventas_totales'] = $stmt->fetch(mode: PDO::FETCH_ASSOC)['total'];
        
        // Total cupones vendidos
        $stmt = $this->db->query(query: "SELECT COALESCE(SUM(cantidad), 0) as total FROM compras");
        $stats['cupones_vendidos'] = $stmt->fetch(mode: PDO::FETCH_ASSOC)['total'];
        
        return $stats;
    }


    public function getSolicitudesEmpresas(): array {
        $query = "SELECT e.id_empresa, e.nombre_empresa, e.fecha_registro, u.email 
                  FROM empresas e
                  INNER JOIN usuarios u ON e.id_usuario = u.id_usuario
                  WHERE e.aprobada = 0
                  ORDER BY e.fecha_registro DESC";
        
        $stmt = $this->db->query(query: $query);
        return $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
    }

        public function aprobarEmpresa($id_empresa): bool {
        $query = "UPDATE empresas SET aprobada = 1 WHERE id_empresa = :id_empresa";
        $stmt = $this->db->prepare(query: $query);
        return $stmt->execute(params: ['id_empresa' => $id_empresa]);
    }


    public function rechazarEmpresa($id_empresa): bool {
        
        $query = "DELETE FROM empresas WHERE id_empresa = :id_empresa";
        $stmt = $this->db->prepare(query: $query);
        return $stmt->execute(params: ['id_empresa' => $id_empresa]);
    }

        public function getReporteEmpresas(): array {
       
        $comision_plataforma = 10; 
        $query = "SELECT 
                    e.id_empresa,
                    e.nombre_empresa,
                    COALESCE(SUM(co.total_pagado), 0) as total_ventas,
                    COALESCE(SUM(co.cantidad), 0) as cupones_vendidos,
                    COUNT(DISTINCT cu.id_oferta) as cupones_disponibles,
                    COALESCE(SUM(co.total_pagado * :comision / 100), 0) as total_ganancias
                  FROM empresas e
                  LEFT JOIN cupones cu ON e.id_empresa = cu.id_empresa AND cu.estado_oferta = 'Disponible' AND cu.cantidad_cupones > 0
                  LEFT JOIN compras co ON cu.id_oferta = co.id_oferta
                  WHERE e.aprobada = 1
                  GROUP BY e.id_empresa, e.nombre_empresa
                  ORDER BY total_ventas DESC";
        
        $stmt = $this->db->prepare(query: $query);
        $stmt->execute(params: ['comision' => $comision_plataforma]);
        return $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
    }
}
