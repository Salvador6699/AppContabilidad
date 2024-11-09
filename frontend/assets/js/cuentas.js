async function allCuentas() {
    try {
        let response = await fetch(urlJson + 'cuentas.json');
        let responseData = await response.json(); // Mover aquí para evitar duplicación
        let cuentas = document.getElementById('cuentas');
        responseData.result.forEach((element) => {
            let color = element.saldo < 0 ? 'var(--color-alerta)' : ''; // Definir color aquí
            // Insertar los datos dentro del contenedor
            cuentas.insertAdjacentHTML(
                "beforeend",
                `<div class="card" onclick="toggleCard(this);" ondblclick="irAPagina()">
                    <div class="card-inner">
                        <div class="card-front" style="background: ${color};">
                            <h3>${element.cuenta}</h3>
                            <span>${element.saldo} €</span>
                        </div>
                        <div class="card-back">
                            <p>${element.importe} €<br>
                            ${element.categoria}:<br>
                            ${element.concepto} (${element.fecha})</p>
                        </div>
                    </div>
                </div>`
            );
        });
    }
    catch (error) {
        console.error("No hay json:", error); // Manejo de errores
        let json = await fetch(BASE_URL + 'json_cuentas');
    } 
}

// Nueva función para manejar la animación de las tarjetas
function toggleCard(card) {
    // Cerrar cualquier tarjeta que esté abierta
    const openCards = document.querySelectorAll('.card.animate');
    openCards.forEach(openCard => {
        if (openCard !== card) {
            openCard.classList.remove('animate');
        }
    });
    // Alternar la clase de la tarjeta actual
    card.classList.toggle('animate');
}
// Nueva función para redirigir a una página
function irAPagina() {
    window.location.href = '/cuentas'; // Reemplaza con la URL deseada
}