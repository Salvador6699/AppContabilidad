async function todosUsuarios() {
    try {
        // Hacer la solicitud a la API para listar todos los usuarios
        let response = await fetch(urlJson+'usuarios.json');
        let responseData = await response.json();
        mostrarUsuarios(responseData.result,'all');
    } catch (error) {
        console.error("No hay json:", error); // Manejo de errores
        let json=await fetch(BASE_URL+'listar');
        let response = await fetch(urlJson+'usuarios.json');
        let responseData = await response.json();
        mostrarUsuarios(responseData.result,'all');
        
    }
}

async function buscarUsuario() {
    const buscador = document.getElementById("buscador").value; // Obtener el valor del buscador
    const filtro = document.getElementById("filtrobuscador").value; // Obtener el filtro seleccionado
    try {
        // Hacer la solicitud a la API para buscar un usuario específico
        let response = await fetch(
            `${BASE_URL}buscarUsuario?buscador=${buscador}&filtro=${filtro}`
        );
        let responseData = await response.json();
        mostrarUsuarios(responseData.result,buscador);
    } catch (error) {
        console.error("Error al buscar usuario:", error); // Manejo de errores
    }
}

function mostrarUsuarios(usuarios,buscador) {
    // Obtener el contenedor donde se mostrarán los usuarios
    const usuarioContainer = document.getElementById("usuarios");
    usuarioContainer.innerHTML = ""; // Limpiar el contenedor antes de mostrar nuevos usuarios
    // Añadir la clase 'cards' al contenedor
    usuarioContainer.classList.add('cards');
    // Verifica si hay usuarios para mostrar
    if (usuarios.length === 0) {
        usuarioContainer.insertAdjacentHTML(
            "beforeend",
            "<h3>No se encontraron usuarios por:</h3><h4> "+buscador+"</h4>"
        );
        return; // Salir de la función si no hay usuarios
    }

    // Recorrer la lista de usuarios y generar el HTML
    if(buscador==='all'){
        usuarioContainer.innerHTML="<h3>Todos los usuarios.</h3>";
    }else{
        usuarioContainer.innerHTML="<h3>Usuarios por:</h3><h4> "+buscador+"</h4>"
    }
    
    usuarios.forEach((element) => {
        // Insertar los datos dentro del contenedor
        usuarioContainer.insertAdjacentHTML(
            "beforeend",
            `<div class="card">
                <h2>Usuario</h2>
                <p>Nombre: ${element.nombre}</p>
                <p>Email: ${element.email}</p>
            </div>`
        );
    });
}
