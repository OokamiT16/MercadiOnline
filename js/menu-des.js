// Mostrar/ocultar el menú al hacer click en el usuario
document.getElementById('boton-usuario').onclick = function(event) {
    event.stopPropagation();
    let menu = document.getElementById('menu-usuario');
    if(menu.style.display === "none" || menu.style.display === "") {
        // Posicionar el menú bajo el botón usuario
        const rect = this.getBoundingClientRect();
        menu.style.top = (rect.bottom + window.scrollY + 5) + "px";
        menu.style.left = (rect.left + window.scrollX) + "px";
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
};
// Cerrar el menú si se hace click fuera
document.addEventListener('click', function() {
    document.getElementById('menu-usuario').style.display = "none";
});
document.getElementById('menu-usuario').onclick = function(event) {
    event.stopPropagation();
};

// Función Perfil: muestra modal con los datos del usuario activo
function verPerfil() {
    // Supón que tienes los datos en sesión (puedes agregar más según la sesión)
    const nombre = "<?= htmlspecialchars($_SESSION['nombre']) ?>";
    const usuario = "<?= htmlspecialchars($_SESSION['usuario']) ?>";
    // Si tienes más datos en $_SESSION, agrégalos aquí

    // Muestra en un modal (puedes hacer un modal especial o reusar el de producto)
    let html = `
        <h2>Mi Perfil</h2>
        <p><b>Nombre:</b> ${nombre}</p>
        <p><b>Usuario:</b> ${usuario}</p>
    `;
    mostrarModalGenerico(html);
}

// Función Resumen: muestra modal con cantidad de ventas del usuario activo
function verResumen() {
    // Puedes hacer un fetch/AJAX a un PHP que te regrese las ventas de este usuario
    fetch('resumen_usuario.php')
        .then(resp => resp.json())
        .then(data => {
            let html = `
                <h2>Resumen de Ventas</h2>
                <p><b>Ventas realizadas:</b> ${data.cantidad}</p>
                <p><b>Total vendido:</b> $${data.total}</p>
            `;
            mostrarModalGenerico(html);
        });
}

// Función para cerrar sesión
function cerrarSesion() {
    window.location.href = "logout.php";
}

// Utilidad para mostrar un modal genérico (puedes crear uno en tu HTML)
function mostrarModalGenerico(html) {
    let modal = document.getElementById('modal-generico');
    let cont = document.getElementById('contenido-modal-generico');
    cont.innerHTML = html;
    modal.style.display = "flex";
}
function cerrarModalGenerico() {
    document.getElementById('modal-generico').style.display = "none";
}
