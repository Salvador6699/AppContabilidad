async function allCategorias() {
    try {
        let response = await fetch(urlJson + 'categorias.json');
        let responseData = await response.json(); // Mover aquí para evitar duplicación
        let cuentas = document.getElementById('categorias');
        responseData.result.forEach((element) => {
            
            // Insertar los datos dentro del contenedor
            cuentas.insertAdjacentHTML(
                "beforeend",
                `<div class="card">
                    <h3>${element.nomCategoria}</h3><h5>(${element.tipoCategoria})</h5>
                </div>`
            );
        });
    }
    catch (error) {
        console.error("No hay json:", error); // Manejo de errores
        let json = await fetch(BASE_URL + 'json_categorias');
    } 
}