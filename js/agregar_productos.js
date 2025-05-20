let carrito = [];

// Agrega producto al carrito
function agregarProducto(clave, titulo, precio) {
    let existente = carrito.find(item => item.clave === clave);
    if (existente) {
        existente.cantidad += 1;
    } else {
        carrito.push({ clave, titulo, precio, cantidad: 1 });
    }
    mostrarCarrito();
}

// Elimina un producto del carrito
function eliminarProducto(clave) {
    carrito = carrito.filter(item => item.clave !== clave);
    mostrarCarrito();
}

// Muestra el carrito en pantalla
function mostrarCarrito() {
    const lista = document.getElementById("lista-carrito");
    const total = document.getElementById("total");
    lista.innerHTML = "";

    let suma = 0;

    carrito.forEach(item => {
        const div = document.createElement("div");
        div.className = "item-carrito";
        div.innerHTML = `
            <span class="eliminar" onclick="eliminarProducto(${item.clave})">&#10060;</span>
            ${item.titulo} (${item.cantidad})
            <span class="precio">$${(item.precio * item.cantidad).toFixed(2)}</span>
        `;
        lista.appendChild(div);
        suma += item.precio * item.cantidad;
    });

    total.textContent = `$${suma.toFixed(2)}`;
}

// Limpia el carrito
function limpiarCarrito() {
    carrito = [];
    mostrarCarrito();
}

// --------- Modales y venta -----------

// Mostrar modal de tipo de pago al dar click en "Pagar"
document.querySelector('.pagar').onclick = function() {
    document.getElementById('modal-pago').style.display = 'flex';
}

// Cerrar el modal de tipo de pago
function cerrarModalPago() {
    document.getElementById('modal-pago').style.display = 'none';
}

// Confirmar venta y mostrar modal de éxito
let contadorVentas = 1; // Simulación de número de venta

function finalizarVenta(tipoPago) {
    let suma = carrito.reduce((acc, item) => acc + (item.precio * item.cantidad), 0);
    if (suma === 0) {
        alert("¡El carrito está vacío!");
        cerrarModalPago();
        return;
    }

    limpiarCarrito();
    cerrarModalPago();

    // Mostrar modal de éxito de venta
    document.getElementById('venta-numero').textContent = contadorVentas++;
    document.getElementById('modal-exito').style.display = 'flex';
}

// Cerrar el modal de éxito
function cerrarModalExito() {
    document.getElementById('modal-exito').style.display = 'none';
}

// --------- Modal de cancelar carrito ---------

document.querySelector('.cancelar').onclick = function() {
    document.getElementById('modal-cancelar').style.display = 'flex';
}

function cerrarModalCancelar() {
    document.getElementById('modal-cancelar').style.display = 'none';
}

function confirmarCancelarCarrito() {
    limpiarCarrito();
    cerrarModalCancelar();
}

// --------- Modal de VER producto ---------

function verProducto(clave, titulo, descripcion, cantidad, precio, imgBase64) {
    document.getElementById('ver-titulo').textContent = titulo;
    document.getElementById('ver-descripcion').textContent = descripcion;
    document.getElementById('ver-cantidad').textContent = cantidad;
    document.getElementById('ver-precio').textContent = '$' + parseFloat(precio).toFixed(2);

    if(imgBase64) {
        document.getElementById('ver-img').src = "data:image/png;base64," + imgBase64;
        document.getElementById('ver-img').style.display = "block";
    } else {
        document.getElementById('ver-img').style.display = "none";
    }

    document.getElementById('modal-producto').style.display = 'flex';
}

function cerrarModalProducto() {
    document.getElementById('modal-producto').style.display = 'none';
}

// --------- Menú de usuario ---------

document.getElementById('boton-usuario').onclick = function(event) {
    event.stopPropagation();
    let menu = document.getElementById('menu-usuario');
    if(menu.style.display === "none" || menu.style.display === "") {
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
    const nombre = "<?= htmlspecialchars($_SESSION['nombre']) ?>";
    const usuario = "<?= htmlspecialchars($_SESSION['usuario']) ?>";
    let html = `
        <h2>Mi Perfil</h2>
        <p><b>Nombre:</b> ${nombre}</p>
        <p><b>Usuario:</b> ${usuario}</p>
    `;
    mostrarModalGenerico(html);
}

// Función Resumen: muestra modal con cantidad de ventas del usuario activo
function verResumen() {
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
