async function todosUsuarios() {
    try {
        // Hacer la solicitud a la API para listar todos los usuarios
        let response = await fetch(BASE_URL + 'listar');
        let responseData = await response.json();
        mostrarUsuarios(responseData.result);
    } catch (error) {
        console.error('Error al listar usuarios:', error); // Manejo de errores
    }
}

async function buscarUsuario() {
    const buscador = document.getElementById('buscador').value; // Obtener el valor del buscador
    const filtro = document.getElementById('filtrobuscador').value; // Obtener el filtro seleccionado
    try {
        // Hacer la solicitud a la API para buscar un usuario específico
        let response = await fetch(`${BASE_URL}listar?buscador=${buscador}&filtro=${filtro}`);
        let responseData = await response.json();
        mostrarUsuarios(responseData.result);
    } catch (error) {
        console.error('Error al buscar usuario:', error); // Manejo de errores
    }
}

function mostrarUsuarios(usuarios) {
    // Obtener el contenedor donde se mostrarán los usuarios
    const usuarioContainer = document.getElementById('usuarios');
    usuarioContainer.innerHTML = ''; // Limpiar el contenedor antes de mostrar nuevos usuarios

    // Verifica si hay usuarios para mostrar
    if (usuarios.length === 0) {
        usuarioContainer.insertAdjacentHTML('beforeend', '<p>No se encontraron usuarios.</p>');
        return; // Salir de la función si no hay usuarios
    }

    // Recorrer la lista de usuarios y generar el HTML
    usuarios.forEach(element => {
        // Insertar los datos dentro del contenedor
        usuarioContainer.insertAdjacentHTML('beforeend',
            `<div class="card">
                <h2>Usuario</h2>
                <p>Nombre: ${element.nombre}</p>
                <p>Email: ${element.email}</p>
            </div>`);
    });
}