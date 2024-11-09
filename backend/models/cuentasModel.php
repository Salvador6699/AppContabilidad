<?php
require_once(__DIR__ . '/../models/orm.php');
class CuentasModel extends Orm
{
    public function __construct(PDO $conexion)
    {
        parent::__construct("idCuenta", "cuentas", $conexion);
    }
    public function ultimoMovimiento()
    {
        $sql = "SELECT c.*, m.fechaMovimiento,m.importeMovimiento,m.subcategorias_nomSubcategoria,subcategorias_categorias_nomCategoria
FROM cuentas c
LEFT JOIN (
    SELECT *,
           ROW_NUMBER() OVER (PARTITION BY cuentas_idCuenta ORDER BY fechaMovimiento DESC) AS rn
    FROM movimientos
) m ON c.idCuenta = m.cuentas_idCuenta AND m.rn = 1";

        try {
            // Preparar la consulta
            $stm = $this->db->prepare($sql);
            // Ejecutar la consulta
            $stm->execute();
            // Devolver todos los resultados como un array asociativo
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar el error o registrarlo
            return [];
        }
    }
}
