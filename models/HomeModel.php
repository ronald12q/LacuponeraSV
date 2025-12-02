<?php

require_once 'core/Database.php';

class HomeModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getCuponesDisponibles(): array {
        try {
            $query = "SELECT 
                        c.id_oferta,
                        c.titulo,
                        c.descripcion,
                        c.precio_regular,
                        c.precio_oferta,
                        c.fecha_inicio,
                        c.fecha_fin,
                        c.fecha_limite_canje,
                        c.cantidad_cupones,
                        c.estado_oferta,
                        c.Categoria,
                        e.nombre_empresa
                      FROM cupones c
                      INNER JOIN empresas e ON c.id_empresa = e.id_empresa
                      WHERE e.aprobada = 1 
                        AND c.estado_oferta = 'Disponible'
                        AND c.cantidad_cupones > 0
                        AND c.fecha_fin >= CURDATE()
                      ORDER BY c.fecha_inicio DESC";
            
            $stmt = $this->db->query(query: $query);
            return $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log(message: "Error al obtener cupones: " . $e->getMessage());
            return [];
        }
    }

    
    public function buscarCupones(string $termino): array {
        try {
            $query = "SELECT 
                        c.id_oferta,
                        c.titulo,
                        c.descripcion,
                        c.precio_regular,
                        c.precio_oferta,
                        c.fecha_inicio,
                        c.fecha_fin,
                        c.fecha_limite_canje,
                        c.cantidad_cupones,
                        c.estado_oferta,
                        c.Categoria,
                        e.nombre_empresa
                      FROM cupones c
                      INNER JOIN empresas e ON c.id_empresa = e.id_empresa
                      WHERE e.aprobada = 1 
                        AND c.estado_oferta = 'Disponible'
                        AND c.cantidad_cupones > 0
                        AND c.fecha_fin >= CURDATE()
                        AND (c.titulo LIKE :termino 
                             OR c.descripcion LIKE :termino 
                             OR c.Categoria LIKE :termino
                             OR e.nombre_empresa LIKE :termino)
                      ORDER BY c.fecha_inicio DESC";
            
            $stmt = $this->db->prepare(query: $query);
            $terminoBusqueda = '%' . $termino . '%';
            $stmt->bindParam(param: ':termino', var: $terminoBusqueda);
            $stmt->execute();
            return $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log(message: "Error al buscar cupones: " . $e->getMessage());
            return [];
        }
    }

    public function getCuponById(int $id): ?array {
        try {
            $query = "SELECT 
                        c.*,
                        e.nombre_empresa,
                        e.direccion,
                        e.telefono
                      FROM cupones c
                      INNER JOIN empresas e ON c.id_empresa = e.id_empresa
                      WHERE c.id_oferta = :id 
                        AND e.aprobada = 1";
            
            $stmt = $this->db->prepare(query: $query);
            $stmt->bindParam(param: ':id', var: $id, type: PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(mode: PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log("Error al obtener cupón: " . $e->getMessage());
            return null;
        }
    }

  
    public function getCuponesPorCategoria(string $categoria): array {
        try {
            $query = "SELECT 
                        c.id_oferta,
                        c.titulo,
                        c.descripcion,
                        c.precio_regular,
                        c.precio_oferta,
                        c.fecha_inicio,
                        c.fecha_fin,
                        c.fecha_limite_canje,
                        c.cantidad_cupones,
                        c.estado_oferta,
                        c.Categoria,
                        e.nombre_empresa
                      FROM cupones c
                      INNER JOIN empresas e ON c.id_empresa = e.id_empresa
                      WHERE e.aprobada = 1 
                        AND c.estado_oferta = 'Disponible'
                        AND c.cantidad_cupones > 0
                        AND c.fecha_fin >= CURDATE()
                        AND c.Categoria = :categoria
                      ORDER BY c.fecha_inicio DESC";
            
            $stmt = $this->db->prepare(query: $query);
            $stmt->bindParam(param: ':categoria', var: $categoria);
            $stmt->execute();
            return $stmt->fetchAll(mode: PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log(message: "Error al obtener cupones por categoría: " . $e->getMessage());
            return [];
        }
    }

  
    public function getCategorias(): array {
        try {
            $query = "SELECT DISTINCT c.Categoria 
                      FROM cupones c
                      INNER JOIN empresas e ON c.id_empresa = e.id_empresa
                      WHERE e.aprobada = 1 
                        AND c.estado_oferta = 'Disponible'
                        AND c.cantidad_cupones > 0
                        AND c.fecha_fin >= CURDATE()
                        AND c.Categoria IS NOT NULL
                        AND c.Categoria != ''
                      ORDER BY c.Categoria";
            
            $stmt = $this->db->query(query: $query);
            return $stmt->fetchAll(mode: PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            error_log(message: "Error al obtener categorías: " . $e->getMessage());
            return [];
        }
    }
}