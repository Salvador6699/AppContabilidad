function limpiarInput(input) {
    input.value = ''; // Vaciar el campo de texto
}
function verificarEnter(event,accion) {
    if (event.key === 'Enter') { // Verifica si la tecla presionada es Enter
        accion(); // Llama a la función buscarUsuario
    }
}