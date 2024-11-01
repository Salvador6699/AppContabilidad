async function allCuentas() {
    try {
        let response = await fetch(urlJson + 'cuentas.json');
    }
    catch (error) {
        console.error("No hay json:", error); // Manejo de errores
        let json = await fetch(BASE_URL + 'getCuentas');

    } 
    let response = await fetch(urlJson + 'cuentas.json');
    let responseData = await response.json();
    let cuentas = document.getElementById('cuentas');
    cuentas.innerHTML = "<h3>Todas las cuentas.</h3>";
    responseData.result.forEach((element) => {
        // Insertar los datos dentro del contenedor
        cuentas.insertAdjacentHTML(
            "beforeend",
            `<div class="card">
                <h2>Cuentas</h2>
                <p>Nombre: ${element.cuenta}</p>
                <p>Saldo: ${element.saldo}</p>
            </div>`
        );
    });
}
