<?php
require_once(__DIR__ . '/../core/ControllerViews.php');

class TransferenciaController extends ControllerViews
{
    private $conexionDestino;
    private $subcategorias;
    public function __construct(PDO $conexion)
    {
        // Conexión a la base de datos de destino
        $this->conexionDestino = $conexion;
    }

    public function transferirDatos()
    {
        $jsonFiles = [
            // Agrega más archivos y tablas según sea necesario
            __DIR__ . '/../database/backupDatos/categorias.json' => 'categorias',
            __DIR__ . '/../database/backupDatos/tipo_movimiento.json' => 'tipomivimiento',
            __DIR__ . '/../database/backupDatos/cuentas.json' => 'cuentas',
            __DIR__ . '/../database/backupDatos/subcategorias.json' => 'subcategorias',
            __DIR__ . '/../database/backupDatos/movimientos.json' => 'movimientos',
            __DIR__ . '/../database/backupDatos/presupuestos.json' => 'presupuestos',


        ];

        foreach ($jsonFiles as $jsonFile => $tabla) {
            $json = file_get_contents($jsonFile); // Cargar datos desde el archivo JSON
            $datos = json_decode($json, true); // Decodificar el JSON a un array asociativo

            foreach ($datos as $fila) {
                $this->insertarDatos($tabla, $fila);
            }
        }
        $this->render(['home'], [], 'plantilla');
    }

    private function insertarDatos($tabla, $fila)
    {
        // Ajusta las columnas según la tabla
        if ($tabla === 'categorias') {
            try {
                $this->conexionDestino->prepare("INSERT INTO categorias (nomCategoria,tipoCategoria) VALUES (:columna1, :columna2)")
                    ->execute([
                        ':columna1' => $fila['nom_categorias'],
                        ':columna2' => $fila['tipo_movimiento_ID_tipo_movimiento'] == 1 ? 'Gasto' : 'Ingreso'
                    ]);
            } catch (PDOException $e) {
                // Ignorar el error de entrada duplicada y continuar
                // Puedes registrar el error si lo deseas
                // error_log($e->getMessage());
            }
        } elseif ($tabla === 'tipomovimiento') {
            try {
                $this->conexionDestino->prepare("INSERT INTO tipomovimiento (nomTipoMovimiento) VALUES (:columna1)")
                    ->execute([
                        ':columna1' => $fila['nom_tipo_movimiento']
                    ]);
            } catch (PDOException $e) {
                // Ignorar el error de entrada duplicada y continuar
                // Puedes registrar el error si lo deseas
                echo $e->getMessage();
                error_log($e->getMessage());
            }
        } elseif ($tabla === 'cuentas') {
            try {
                $this->conexionDestino->prepare("INSERT INTO cuentas (idCuenta, nomCuenta, saldoCuenta,usuarios_dniUsuario) VALUES (:columna1, :columna2, :columna3,:columna4)")
                    ->execute([
                        ':columna1' => $fila['nom_cuentas'],
                        ':columna2' => $fila['nom_cuentas'],
                        ':columna3' => $fila['saldo_cuentas'],
                        ':columna4' => '20819449x'
                    ]);
            } catch (PDOException $e) {
                // Ignorar el error de entrada duplicada y continuar
                // Puedes registrar el error si lo deseas
                // error_log($e->getMessage());
            }
        } elseif ($tabla === 'subcategorias') {
            try {
                $this->conexionDestino->prepare("INSERT INTO subcategorias (nomSubcategoria,categorias_nomCategoria) VALUES (:columna1, :columna2)")
                    ->execute([
                        ':columna1' => $fila['nom_subcategorias'],
                        ':columna2' => $fila['categorias_nom_categorias'],
                        $this->subcategorias[$fila['nom_subcategorias']] = $fila['categorias_nom_categorias']
                    ]);
            } catch (PDOException $e) {
                // Ignorar el error de entrada duplicada y continuar
                // Puedes registrar el error si lo deseas
                // echo $e->getMessage();
                // error_log($e->getMessage());
            }
        } elseif ($tabla === 'movimientos') {
            try {
                $this->conexionDestino->prepare("INSERT INTO movimientos (importeMovimiento,fechaMovimiento,comentarioMovimiento,tipoMovimiento_nomTipoMovimiento,subcategorias_nomSubcategoria,subcategorias_categorias_nomCategoria,
                usuarios_dniUsuario,cuentas_idCuenta,cuentas_usuarios_dniUsuario) VALUES (:columna1, :columna2, :columna3, :columna4, :columna5, :columna6,:columna7,:columna8,:columna9)")
                    ->execute([
                        ':columna1' => $fila['importe_movimiento'],
                        ':columna2' => $fila['fecha_movimiento'],
                        ':columna3' => $fila['movimiento_coment'],
                        ':columna4' => $fila['tipo_movimiento_ID_tipo_movimiento'] == 1 ? 'Gasto' : 'Ingreso',
                        ':columna5' => $fila['subcategorias_nom_subcategorias'],
                        ':columna6' => $this->subcategorias[$fila['subcategorias_nom_subcategorias']],
                        ':columna7' => '20819449x',
                        ':columna8' => $fila['cuentas_nom_cuentas'],
                        ':columna9' => '20819449x'
                    ]);
            } catch (PDOException $e) {
                // Ignorar el error de entrada duplicada y continuar
                // Puedes registrar el error si lo deseas
                echo $e->getMessage();
                error_log($e->getMessage());
            }
        } elseif ($tabla === 'cuentas') {
            try {
                $this->conexionDestino->prepare("INSERT INTO cuentas (idCuenta, nomCuenta, saldoCuenta,usuarios_dniUsuario) VALUES (:columna1, :columna2, :columna3,:columna4)")
                    ->execute([
                        ':columna1' => $fila['nom_cuentas'],
                        ':columna2' => $fila['nom_cuentas'],
                        ':columna3' => $fila['saldo_cuentas'],
                        ':columna4' => '20819449x'
                    ]);
            } catch (PDOException $e) {
                // Ignorar el error de entrada duplicada y continuar
                // Puedes registrar el error si lo deseas
                // error_log($e->getMessage());
            }
        } else {
            // ... código existente ...
        }
    }
}
