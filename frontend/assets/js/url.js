const UrlComplet=window.location.href;
// Función para obtener la base URL sin la última parte
function getBaseUrlWithoutLastSegment(url) {


// Dividir la URL en segmentos
const segments = url.split('/');

// Quitar el último segmento
segments.pop();

// Unir los segmentos restantes para formar la nueva URL base
const baseUrlWithoutLastSegment = segments.join('/') + '/'; // Agrega una barra final si es necesario

return baseUrlWithoutLastSegment;
}
// Obtener la nueva URL base
const BASE_URL = getBaseUrlWithoutLastSegment(UrlComplet);
const urlJson=BASE_URL+'/backend/cache/';
