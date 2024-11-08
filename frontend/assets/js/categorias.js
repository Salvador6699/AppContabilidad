async function allCategorias() {
    try {
        let response = await fetch(urlJson + 'categorias.json');
        let responseData = await response.json();
        let categorias = document.getElementById('categorias');
        responseData.result.forEach((element) => {
            let subcategorias= element.subcategorias.map(categoria => categoria.subcategoria).join('<br>-'); 
            let categoria=element.nombre;
            categorias.insertAdjacentHTML(
                "beforeend",
                `
                    ${categoria == 'Ingresos' ? '' : `
                        <div class="card">
                        <h3>${categoria}</h3>
                        <hr>
                        <h4>-${subcategorias}</h4>
                        </div>`}
                `
            );
        });
    } catch (error) {
        console.error("No hay json:", error);
    } 
}

function mensaje(tipo) {
    window.location.href = `/about/${tipo}`;
}
