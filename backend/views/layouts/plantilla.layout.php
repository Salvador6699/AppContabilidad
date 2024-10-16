<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContaHogar</title>

    <?php
    // Generar una versión única basada en el tiempo para romper el caché
    $version = time();
    ?>

    <!-- Agregar la versión a la hoja de estilos -->
    <link rel="stylesheet" href="/frontend/assets/css/styles.css?v=<?php echo $version; ?>">

    <!-- Agregar la versión al archivo JS -->
    <script src="/frontend/assets/js/url.js?v=<?php echo $version; ?>"></script>
</head>


<body>
    <!-- Cabecera fija -->
    <header class="header">
        <div class="logo">
            <img src="/frontend/plantilla/favicon.ico" alt="logo ContaHogar">
            <h1></h1>
        </div>
        <button id="menu-button" class="accordion-button"></button>
    </header>

    <!-- Menú desplegable (acordeón) -->
    <nav id="accordion-menu" class="accordion-menu">
        <ul>
            <li>
                Sección 1
                <button class="submenu-toggle"></button>
                <ul class="submenu">
                    <li>Subsección 1</li>
                    <li>Subsección 2</li>
                    <li>Subsección 3</li>
                </ul>
            </li>
            <li>
                Sección 2
                <button class="submenu-toggle"></button>
                <ul class="submenu">
                    <li>Subsección 1</li>
                    <li>Subsección 2</li>
                    <li>Subsección 3</li>
                </ul>
            </li>
            <!-- Añadir más secciones y subsecciones aquí -->
        </ul>
    </nav>

    <!-- Contenido dinámico -->
    <main id="content">
        <?php
        echo $content;
        ?>
    </main>
    <!-- Botón flotante y sus opciones -->
    <div class="floating-button-container">
        <button class="floating-button" id="add-button">+</button>
        <button class="floating-action hidden" id="gasto-button">G</button>
        <button class="floating-action hidden" id="ingreso-button">I</button>
        <button class="floating-action hidden" id="transferencia-button">T</button>
    </div>

    <script src="/frontend/assets/js/scripts.js">
    </script>
</body>

</html>