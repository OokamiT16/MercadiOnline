<?php
require 'conexion.php';
session_start();

// Usa el nombre correcto de tu variable de conexión
$productos = [];
$result = $conn->query("SELECT * FROM producto");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <title>Mercadito Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barra superior -->
    <div class="barra-superior">
        <div class="logo-mock">
            <img src="img/Logo-02.png" alt="logo" style="height:38px;">
        </div>
        <button class="cerrar-dia">Cerrar día</button>
        <div class="usuario-top">
            <div class="circle"></div>
            <span><?= htmlspecialchars($_SESSION['nombre']) ?></span>
        </div>
    </div>
    <div class="principal">
        <!-- Catálogo de productos -->
        <div class="catalogo">
            <div class="busqueda-mock">
                <input type="text" placeholder="Búsqueda...">
                <button class="btn-buscar"><span>&#128269;</span></button>
            </div>
            <div class="productos-grid">
                <?php foreach ($productos as $p): ?>
                <div class="producto-card">
                    <div class="img-circulo">
                        <?php if (!empty($p["img"])): ?>
                            <img src="data:image/png;base64,<?= base64_encode($p["img"]) ?>" alt="Producto">
                        <?php else: ?>
                            <div class="circulo-placeholder"></div>
                        <?php endif; ?>
                    </div>
                    <div class="titulo"><?= htmlspecialchars($p["titulo"]) ?></div>
                    <div class="titulo">$<?= htmlspecialchars($p["precio"]) ?> pesos</div>
                    <div class="botones">
                        <button class="ver" onclick="verProducto(<?= $p["clave"] ?>, '<?= htmlspecialchars($p["titulo"]) ?>')">Ver</button>
                        <button class="agregar" onclick="agregarProducto(<?= $p["clave"] ?>, '<?= htmlspecialchars($p["titulo"]) ?>', <?= $p["precio"] ?>)">Agregar</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Carrito -->
        <div class="carrito-box">
            <div class="carrito-inner">
                <div class="carrito-header">
                    <span>Fecha: <?= date('d/m/Y') ?></span>
                    <span>Vendedor: <?= htmlspecialchars($_SESSION['nombre']) ?></span>
                </div>
                <div class="carrito-lista" id="lista-carrito">
                    <!-- Aquí van los productos agregados por JS -->
                </div>
                <div class="carrito-total">
                    <b>Total</b>
                    <span id="total">$0.00</span>
                </div>
                <div class="carrito-botones">
                    <button class="cancelar">Cancelar</button>
                    <button class="pagar">Pagar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Pie de página -->
    <footer>
        Proyecto Integral Web 2025
    </footer>
     <!-- lista de scripts -->
    <script src="js/agregar_productos.js"></script>

    <!-- lista de formas de pago -->
      <div id="modal-pago" class="modal-pago" style="display:none;">
          <div class="modal-contenido">
              <h3>Selecciona el tipo de pago</h3>
              <button class="btn-pago-tipo" onclick="finalizarVenta('Efectivo')">Efectivo</button>
              <button class="btn-pago-tipo" onclick="finalizarVenta('Tarjeta')">Tarjeta</button>
              <button class="btn-pago-tipo" onclick="finalizarVenta('Transferencia')">T.E.</button>
              <button onclick="cerrarModalPago()" style="margin-top: 10px;">Cancelar</button>
          </div>
      </div>
        <!-- ventana de gracias por el pago -->
       <!-- Modal de éxito de venta -->
        <div id="modal-exito" class="modal-pago" style="display:none;">
            <div class="modal-contenido" style="max-width:340px;">
                <h2 style="color:#4C3C8B; font-size: 2.3em; margin-bottom: 10px;">¡Venta Realizada!</h2>
                <div id="numero-venta" style="color:#4C3C8B; font-size: 1.3em; margin-bottom: 26px;">
                    Venta No. <span id="venta-numero">##</span>
                </div>
                <button class="btn-pago-tipo" onclick="cerrarModalExito()" style="background: #f1873e; color:white; font-size:1.3em;">Continuar</button>
            </div>
        </div>

        <!-- Ventana de confirmación para cancelar carrito -->
          <div id="modal-cancelar" class="modal-pago" style="display:none;">
              <div class="modal-contenido" style="max-width:340px;">
                  <h2 style="color:#4C3C8B; font-size: 2.1em; margin-bottom: 10px;">¿Estás seguro?</h2>
                  <div style="color:#4C3C8B; font-size: 1.15em; margin-bottom: 20px;">
                      Ésta acción no se puede revertir
                  </div>
                  <div style="display:flex; gap:16px; justify-content:center;">
                      <button class="btn-pago-tipo" onclick="cerrarModalCancelar()" style="background: #f1873e; color:white; min-width:115px;">Regresar</button>
                      <button class="btn-pago-tipo" onclick="confirmarCancelarCarrito()" style="background: #f1873e; color:white; min-width:115px;">Sí, cancelar</button>
                  </div>
              </div>
          </div>
          <!-- Ventana de detalle de producto -->
            <div id="modal-producto" class="modal-pago" style="display:none;">
                <div class="modal-contenido" id="detalle-producto" style="max-width:340px; position:relative;">
                    <button onclick="cerrarModalProducto()" style="
                        position: absolute; top: -38px; right: -28px; 
                        background: #f1873e; color: #fff; 
                        border-radius: 50%; width: 58px; height: 58px; 
                        font-size: 2.6em; font-weight: bold; border: none; cursor:pointer;">
                        &times;
                    </button>
                    <div id="producto-detalle-contenido">
                        <!-- Aquí se insertan los detalles por JS -->
                    </div>
                </div>
            </div>


</body>
</html>
