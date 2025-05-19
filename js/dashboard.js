let carrito = [];

function agregarProducto(id, titulo, precio) {
  carrito.push({ id, titulo, precio });
  renderCarrito();
}

function eliminarProducto(index) {
  carrito.splice(index, 1);
  renderCarrito();
}

function renderCarrito() {
  const lista = document.getElementById("lista-carrito");
  lista.innerHTML = "";
  let total = 0;

  carrito.forEach((item, index) => {
    total += item.precio;
    const li = document.createElement("li");
    li.innerHTML = `
      <span class="eliminar" onclick="eliminarProducto(${index})">❌</span>
      ${item.titulo} <span>$${item.precio.toFixed(2)}</span>
    `;
    lista.appendChild(li);
  });

  document.getElementById("total").textContent = total.toFixed(2);
}

// Datos simulados de productos
const productosDB = {
  1: { clave: 'P001', descripcion: 'Manzanas rojas', precio: 10.50 },
  2: { clave: 'P002', descripcion: 'Pan artesanal', precio: 3.00 },
  3: { clave: 'P003', descripcion: 'Leche entera', precio: 8.25 },
  4: { clave: 'P004', descripcion: 'Queso Oaxaca', precio: 12.80 },
  5: { clave: 'P005', descripcion: 'Huevos orgánicos', precio: 5.60 }
};

function verProducto(id, titulo) {
  const prod = productosDB[id];
  document.getElementById("modal-titulo").textContent = titulo;
  document.getElementById("modal-clave").textContent = prod.clave;
  document.getElementById("modal-descripcion").textContent = prod.descripcion;
  document.getElementById("modal-precio").textContent = prod.precio.toFixed(2);

  document.getElementById("modal").classList.remove("oculto");
}

function cerrarModal() {
  document.getElementById("modal").classList.add("oculto");
}
