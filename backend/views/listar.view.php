<div id="usuario"></div>

<script>
    async function listarUsuarios() {
        try {
            // Hacer la solicitud a la API
            let response = await fetch('http://appcontabilidad/listar');
            let responseData = await response.json();

            // Obtener el contenedor donde se mostrarán los usuarios
            const usuario = document.getElementById('usuario');

            // Recorrer la lista de usuarios y generar el HTML
            responseData.result.forEach(element => {
                // Insertar los datos dentro del contenedor
                usuario.insertAdjacentHTML('beforeend',
                `${element.email}
                <hr>`);
            });
        } catch (error) {
            console.error('Error al listar usuarios:', error); // Manejo de errores
        }
    }

    // Llamar a la función para listar los usuarios
    listarUsuarios();
</script>
