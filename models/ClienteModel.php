<?php

require_once 'core/Database.php';

class ClienteModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Obtener id_cliente a partir de id_usuario
    private function getIdCliente(int $id_usuario): ?int {
        try {
            $stmt = $this->db->prepare(query: "SELECT id_cliente FROM clientes_usuarios WHERE id_usuario = :id_usuario");
            $stmt->execute(params: ['id_usuario' => $id_usuario]);
            $result = $stmt->fetch(mode: PDO::FETCH_ASSOC);
            return $result ? (int)$result['id_cliente'] : null;
        } catch (PDOException $e) {
            error_log(message: "Error al obtener id_cliente: " . $e->getMessage());
            return null;
        }
    }

    public function comprarCupon(int $id_usuario, int $id_oferta, int $cantidad, float $precio_oferta): bool {
        try {
            $id_cliente = $this->getIdCliente(id_usuario: $id_usuario);
            
            if (!$id_cliente) {
                return false;
            }

            $this->db->beginTransaction();

            $total = $cantidad * $precio_oferta;

           
            $stmtCompra = $this->db->prepare(query: "
                INSERT INTO compras (id_cliente, id_oferta, cantidad, total_pagado) 
                VALUES (:id_cliente, :id_oferta, :cantidad, :total)
            ");
            $stmtCompra->execute(params: [
                'id_cliente' => $id_cliente,
                'id_oferta' => $id_oferta,
                'cantidad' => $cantidad,
                'total' => $total
            ]);

            $id_compra = $this->db->lastInsertId();

          
            $codigo_cupon = $this->generarCodigoCupon();

           
            $stmtFactura = $this->db->prepare(query: "
                INSERT INTO facturas (id_compra, codigo_unico_cupon) 
                VALUES (:id_compra, :codigo)
            ");
            $stmtFactura->execute(params: [
                'id_compra' => $id_compra,
                'codigo' => $codigo_cupon
            ]);

            
            $stmtUpdate = $this->db->prepare(query: "
                UPDATE cupones 
                SET cantidad_cupones = cantidad_cupones - :cantidad 
                WHERE id_oferta = :id_oferta
            ");
            $stmtUpdate->execute(params: [
                'cantidad' => $cantidad,
                'id_oferta' => $id_oferta
            ]);

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log(message: "Error al comprar cupón: " . $e->getMessage());
            return false;
        }
    }

  
    private function generarCodigoCupon(): string {
        $prefijo = 'CUP';
        $fecha = date(format: 'Ymd');
        $aleatorio = strtoupper(string: substr(string: md5(string: uniqid(prefix: rand(), more_entropy: true)), offset: 0, length: 8));
        return $prefijo . '-' . $fecha . '-' . $aleatorio;
    }
}
