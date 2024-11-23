<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContaHogar</title>
    <link rel="icon" href="/frontend/assets/img/favicon.ico" type="image/x-icon">

    <?php
    // Generar una versión única basada en el tiempo para romper el caché
    $version = time();
    ?>
<script>let menu=true;</script>
    <!-- Agregar la versión a la hoja de estilos -->
    <link rel="stylesheet" href="/frontend/assets/css/styles.css?v=<?php echo $version; ?>">
    <link rel="stylesheet" href="/frontend/assets/css/error.css?v=<?php echo $version; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Agregar la versión al archivo JS -->
    <script src="/frontend/assets/js/url.js?v=<?php echo $version; ?>"></script>
</head>


<body>
    <!-- Cabecera fija -->
    <header class="header">
        <div class="logo">
            <a href="/"><img src="/frontend/assets/img/favicon.ico"></a>
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
        <button class="floating-button" id="add-button" >
            <img src="https://img.icons8.com/?size=100&id=ps43K8HtbRdK&format=png&color=000000" alt="" style="width: 100%; height: 100%;">
        </button>
        <button class="floating-action hidden" id="gasto-button" style="width: 90%; height: 90%; overflow: hidden; display: flex; align-items: center; justify-content: center;">
            <img src="https://img.icons8.com/?size=100&id=34401&format=png&color=000000" alt="" style="max-width: 100%; max-height: 100%;">
        </button>
        <button class="floating-action hidden" id="ingreso-button" style="width: 90%; height: 90%; overflow: hidden; display: flex; align-items: center; justify-content: center;">
            <img src="https://img.icons8.com/?size=100&id=48556&format=png&color=000000" alt="" style="max-width: 100%; max-height: 100%;">
        </button>
        <button class="floating-action hidden" id="transferencia-button" style="width: 90%; height: 90%; overflow: hidden; display: flex; align-items: center; justify-content: center;">
            <img src="https://img.icons8.com/?size=100&id=Ck6LpiQ3a6uv&format=png&color=000000" alt="" style="max-width: 100%; max-height: 100%;">
        </button>

    </div>

    <script src="/frontend/assets/js/scripts.js">
    </script>
    <script>
        if(menu==false){
            const boton=document.querySelector('.floating-button-container');
            const menu=document.getElementById('menu-button');
            boton.style.display = 'none';
            menu.style.display='none';
        }
    </script>
</body>

</html>