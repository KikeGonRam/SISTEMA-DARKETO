import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// resources/js/app.js
import 'admin-lte/dist/js/adminlte.min.js';
import 'admin-lte'; // Asegúrate de que esta línea esté presente para cargar AdminLTE

// resources/js/app.js
import 'admin-lte'; // Esto importa AdminLTE
import './bootstrap'; // O cualquier otro archivo que necesites

// Otros scripts que necesites
// resources/js/app.js

document.addEventListener("DOMContentLoaded", function () {
    console.log("Panel de administración cargado correctamente.");
});



// resources/js/app.js

document.addEventListener('DOMContentLoaded', () => {
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', (event) => {
            if (!confirm('¿Estás seguro de que deseas eliminar este horario?')) {
                event.preventDefault();
            }
        });
    });
});
