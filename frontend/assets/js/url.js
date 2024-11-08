const UrlComplet=window.location.href;
// Función para obtener la base URL sin la última parte
function getBaseUrlWithoutLastSegment(url) {
    // Dividir la URL en segmentos
    const segments = url.split('/');

    // Verificar si hay más de 3 segmentos (dominio + 2)
    if (segments.length > 3) {
        // Quitar todos los segmentos después del dominio
        return segments.slice(0, 3).join('/') + '/'; // Agrega una barra final
    }

    // Si hay 3 o menos segmentos, devolver la URL tal cual
    return url + '/'; // Agrega una barra final
}
// Obtener la nueva URL base
const BASE_URL = getBaseUrlWithoutLastSegment(UrlComplet);
const urlJson=BASE_URL+'/backend/cache/';
