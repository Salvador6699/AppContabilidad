<?php
http_response_code(404); // Establece el código de respuesta HTTP a 404
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página No Encontrada</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    color: #333;
}

.container {
    text-align: center;
    padding: 50px;
}

.logo {
    width: 400px; /* Ajusta el tamaño de la imagen según sea necesario */
    margin-bottom: 20px;
    @media (max-width: 600px) {
        width: 150px;
       margin-top: 40px; 
    }
}

h1 {
    font-size: 2.5em;
    margin: 20px 0;
}

p {
    font-size: 1.2em;
}

.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 1em;
    color: white;
    background-color: #007BFF; /* Color de fondo del botón */
    text-decoration: none;
    border-radius: 5px;
}

.btn:hover {
    background-color: #0056b3; /* Color del botón al pasar el ratón */
}

    </style>
</head>
<body>
    <div class="container">
        <img src="/frontend/assets/img//404.png" alt="Logo" class="logo">
        <h1>404 - Página No Encontrada</h1>
        <p>Lo sentimos, la página que estás buscando no existe.</p>
        <a href="/" class="btn">Volver a Inicio</a>
    </div>
</body>
</html>
