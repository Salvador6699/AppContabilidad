<?php
class Orm
{
    protected $id; // Nombre de la columna que será la clave primaria
    protected $table; // Nombre de la tabla
    protected $db; // Conexión a la base de datos (PDO)

    // Constructor de la clase ORM
    public function __construct($id, $table, PDO $conexion)
    {
        $this->id = $id;
        $this->table = $table;
        $this->db = $conexion; // Se inyecta la conexión a la base de datos
    }

    // Método para obtener todos los registros con opciones de limit y ordenamiento
    public function getAll($limit = null, $order = null, $des_asc = 'ASC')
    {
        $sql = "SELECT * FROM $this->table"; // Consulta base

        // Si se especifica un campo para ordenar, se agrega a la consulta
        if ($order) {
            // Se valida que el valor de des_asc sea válido ('ASC' o 'DESC')
            $des_asc = strtoupper($des_asc) === 'DESC' ? 'DESC' : 'ASC';
            $sql .= " ORDER BY $order $des_asc";
        }

        // Si se especifica un límite, se agrega a la consulta
        if ($limit) {
            $sql .= " LIMIT :limit";
        }

        try {
            // Preparar la consulta
            $stm = $this->db->prepare($sql);

            // Enlazar el valor de limit si es necesario
            if ($limit) {
                $stm->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            }

            // Ejecutar la consulta
            $stm->execute();

            // Devolver todos los resultados como un array asociativo
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar el error o registrarlo
            return [];
        }
    }

    // Método para obtener un registro por su ID
    public function getById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->id = :id"; // Consulta base

        try {
            // Preparar la consulta
            $stm = $this->db->prepare($sql);

            // Enlazar el valor del ID
            $stm->bindValue(':id', $id, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stm->execute();

            // Devolver el resultado como un array asociativo
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar el error o registrarlo
            return [];
        }
    }

    // Método para obtener registros filtrando por una columna específica
    public function getByWhere($where, $filter)
    {
        $sql = "SELECT * FROM $this->table WHERE $where LIKE :filter"; // Consulta base con LIKE

        try {
            // Preparar la consulta
            $stm = $this->db->prepare($sql);

            // Enlazar el valor del filtro con comodines para LIKE
            $stm->bindValue(':filter', "%$filter%", PDO::PARAM_STR);

            // Ejecutar la consulta
            $stm->execute();

            // Devolver todos los resultados como un array asociativo
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar el error o registrarlo
            return [];
        }
    }

    // Método para eliminar un registro por su ID
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE $this->id = :id"; // Consulta de borrado

        try {
            // Preparar la consulta
            $stm = $this->db->prepare($sql);

            // Enlazar el valor del ID
            $stm->bindValue(':id', $id, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stm->execute();
        } catch (PDOException $e) {
            // Manejar el error o registrarlo
        }
    }

    // Método para actualizar un registro por su ID con datos nuevos
    public function update($id, $data)
    {
        $setClause = []; // Array para almacenar las columnas y valores a actualizar

        // Construir la parte de la consulta que establece las columnas a actualizar
        foreach ($data as $key => $value) {
            $setClause[] = "$key = :$key";
        }

        // Concatenar la parte de actualización
        $sql = "UPDATE $this->table SET " . implode(', ', $setClause) . " WHERE $this->id = :id";

        try {
            // Preparar la consulta
            $stm = $this->db->prepare($sql);

            // Enlazar cada valor de los datos proporcionados
            foreach ($data as $key => $value) {
                $stm->bindValue(":{$key}", $value);
            }

            // Enlazar el valor del ID
            $stm->bindValue(':id', $id, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stm->execute();
        } catch (PDOException $e) {
            // Manejar el error o registrarlo
        }
    }

    // Método para insertar un nuevo registro en la tabla
    public function insert($data)
    {
        // Construir la parte de las columnas para el INSERT
        $columns = implode(", ", array_keys($data));

        // Construir la parte de los valores como placeholders
        $placeholders = ":" . implode(", :", array_keys($data));

        // Consulta de inserción
        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";

        try {
            // Preparar la consulta
            $stm = $this->db->prepare($sql);

            // Enlazar cada valor de los datos proporcionados
            foreach ($data as $key => $value) {
                $stm->bindValue(":{$key}", $value);
            }

            // Ejecutar la consulta
            $stm->execute();
        } catch (PDOException $e) {
            // Manejar el error o registrarlo
        }
    }
  // Método para obtener datos agrupados por subcategoría y mes, incluyendo media y total
public function obtenerDatosPorSubcategoriaYMes($anio, $subcategoria)
{
    $sql = "SELECT 
                subcategorias_nom_subcategorias,
                MONTH(fecha_movimiento) AS mes, 
                YEAR(fecha_movimiento) AS anio, 
                SUM(importe_movimiento) AS total,
                AVG(SUM(importe_movimiento)) OVER () AS media_total,
                SUM(SUM(importe_movimiento)) OVER () AS total_general
            FROM $this->table
            WHERE YEAR(fecha_movimiento) = :anio 
                AND subcategorias_nom_subcategorias = :subcategoria
            GROUP BY subcategorias_nom_subcategorias, YEAR(fecha_movimiento), MONTH(fecha_movimiento)
            ORDER BY subcategorias_nom_subcategorias ASC, YEAR(fecha_movimiento), MONTH(fecha_movimiento)";

    try {
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stm->bindParam(':subcategoria', $subcategoria, PDO::PARAM_STR);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejar el error o registrarlo
        return false;
    }
}
}
