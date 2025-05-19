
let carrito = [];

function agregarProducto(clave, titulo, precio) {
    // Verifica si ya está en el carrito
    let existente = carrito.find(item => item.clave === clave);
    if (existente) {
        existente.cantidad += 1;
    } else {
        carrito.push({ clave, titulo, precio, cantidad: 1 });
    }
    mostrarCarrito();
}

function eliminarProducto(clave) {
    carrito = carrito.filter(item => item.clave !== clave);
    mostrarCarrito();
}

function mostrarCarrito() {
    const lista = document.getElementById("lista-carrito");
    const total = document.getElementById("total");
    lista.innerHTML = ""; // Limpia el carrito

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

// Opcional: función para limpiar carrito (al cancelar o pagar)
function limpiarCarrito() {
    carrito = [];
    mostrarCarrito();
}

// Si tienes botones cancelar y pagar:

document.querySelector('.pagar').onclick = function() {
    
    limpiarCarrito();
};


//aqui va script para lista de formas de pago

// Mostrar lista al dar click en "Pagar"
document.querySelector('.pagar').onclick = function() {
    document.getElementById('modal-pago').style.display = 'flex';
}

// Cerrar el menu de tipo de pago
function cerrarModalPago() {
    document.getElementById('modal-pago').style.display = 'none';
}

// Cuando se selecciona el tipo de pago
function finalizarVenta(tipoPago) {
    let suma = carrito.reduce((acc, item) => acc + (item.precio * item.cantidad), 0);
    if (suma === 0) {
        alert("¡El carrito está vacío!");
        cerrarModalPago();
        return;
    }
    
    limpiarCarrito();
    cerrarModalPago();
}

//gracias por el pago
let contadorVentas = 1; // Si lo quieres simular, o puedes generar un random, o desde BD

function finalizarVenta(tipoPago) {
    let suma = carrito.reduce((acc, item) => acc + (item.precio * item.cantidad), 0);
    if (suma === 0) {
        alert("¡El carrito está vacío!");
        cerrarModalPago();
        return;
    }

    // Limpia y cierra el modal de tipo de pago
    limpiarCarrito();
    cerrarModalPago();

    // Muestra el modal de éxito
    document.getElementById('venta-numero').textContent = contadorVentas++;
    document.getElementById('modal-exito').style.display = 'flex';
}

function cerrarModalExito() {
    document.getElementById('modal-exito').style.display = 'none';
}

// Mostrar modal al hacer click en "Cancelar"
document.querySelector('.cancelar').onclick = function() {
    document.getElementById('modal-cancelar').style.display = 'flex';
}

// Cerrar el modal de cancelar
function cerrarModalCancelar() {
    document.getElementById('modal-cancelar').style.display = 'none';
}

// Confirmar cancelación: limpia el carrito y cierra modal
function confirmarCancelarCarrito() {
    limpiarCarrito();
    cerrarModalCancelar();
}
