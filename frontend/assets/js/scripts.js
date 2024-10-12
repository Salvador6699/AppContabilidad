// Selección de elementos
const accordionButton = document.querySelector('.accordion-button');
const accordionMenu = document.querySelector('.accordion-menu');
const floatingButton = document.querySelector('.floating-button');
const floatingActions = document.querySelectorAll('.floating-action');
const header = document.querySelector('header');
const accordionButtons = document.querySelectorAll('.submenu-toggle');

//BOTON FLOTANTE===========================================================================================
// Función para manejar el botón flotante
floatingButton.addEventListener('click', () => {
  floatingButton.classList.toggle('open');
  floatingActions.forEach(action => {
    action.classList.toggle('show');
  });
});

// Código para cerrar el botón flotante al hacer scroll
window.addEventListener('scroll', () => {
  if (floatingButton.classList.contains('open')) {
    floatingButton.classList.remove('open');
    floatingActions.forEach(action => {
      action.classList.remove('show'); // Oculta los botones flotantes
    });
  }
  //ACORDEON====================================================================================================
});
// Función para manejar el acordeón
accordionButton.addEventListener('click', () => {
  accordionMenu.classList.toggle('open');
  accordionButton.classList.toggle('open'); // Añadir la clase 'open' al botón del acordeón
  header.classList.toggle('open-menu');//modificamos el estilo de la cabezera
  if (floatingButton.classList.contains('open')) {
    floatingButton.classList.remove('open');
    floatingActions.forEach(action => {
      action.classList.remove('show'); // Oculta los botones flotantes
    });
  }
});

// Función para manejar las subsecciones del acordeón
accordionButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    const submenu = event.target.nextElementSibling; // Obtén el submenu asociado
    submenu.classList.toggle('open'); // Alterna la clase 'open' para mostrar/ocultar
    button.classList.toggle('open'); // Alterna el estado del botón de submenú

    // Añadir la animación de aparición
    if (submenu.classList.contains('open')) {
      submenu.style.display = 'block'; // Mostrar submenu
      submenu.style.opacity = 0; // Inicialmente oculto
      submenu.style.transform = 'translateY(-10px)'; // Mover hacia arriba
      setTimeout(() => {
        submenu.style.opacity = 1; // Hacer visible
        submenu.style.transform = 'translateY(0)'; // Mover a su posición original
      }, 50); // Retardo para permitir la transición
    } else {
      submenu.style.opacity = 0; // Hacer invisible
      submenu.style.transform = 'translateY(-10px)'; // Mover hacia arriba
      setTimeout(() => {
        submenu.style.display = 'none'; // Ocultar submenu
      }, 300); // Esperar a que termine la transición antes de ocultar
    }
  });
});
