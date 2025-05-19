<?php require 'session.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel - Mercado Online</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header">
    <div class="logo">mercado <span>online</span></div>
    <div class="usuario">👤 Usuario</div>
  </div>

  <div class="container">
    <!-- Catálogo -->
    <div class="catalogo">
      <input type="text" id="busqueda" placeholder="Búsqueda..." />
      <div class="productos">
        <!-- Productos simulados -->
        <?php
        $productos = [
          ["id" => 1, "titulo" => "Manzanas", "precio" => 10.50],
          ["id" => 2, "titulo" => "Pan", "precio" => 3.00],
          ["id" => 3, "titulo" => "Leche", "precio" => 8.25],
          ["id" => 4, "titulo" => "Queso", "precio" => 12.80],
          ["id" => 5, "titulo" => "Huevos", "precio" => 5.60]
        ];
        foreach ($productos as $p) {
          echo '
          <div class="producto">
            <div class="imagen"></div>
            <div class="titulo">'.$p["titulo"].'</div>
            <div class="acciones">
            <button class="ver" onclick="verProducto(<?= $p['id'] ?>, '<?= $p['titulo'] ?>')">Ver</button>
            <button class="agregar" onclick="agregarProducto('.$p["id"].', \''.$p["titulo"].'\', '.$p["precio"].')">Agregar</button>
            </div>
          </div>';
        }
        ?>
      </div>
    </div>

    <!-- Carrito -->
    <div class="carrito">
      <div class="fecha">Fecha: <?= date("d/m/Y") ?> <br> Vendedor</div>
      <ul id="lista-carrito"></ul>
      <div class="total">Total: $<span id="total">0.00</span></div>
      <div class="acciones-carrito">
        <button class="cancelar">Cancelar</button>
        <button class="pagar">Pagar</button>
      </div>
    </div>
  </div>

  <script src="js/dashboard.js"></script>
</body>
</html>
<!-- Modal de Información del Producto -->
<div id="modal" class="modal oculto">
  <div class="modal-content">
    <span class="cerrar" onclick="cerrarModal()">✖</span>
    <div class="modal-imagen"></div>
    <h2 id="modal-titulo">Título</h2>
    <p><strong>Clave:</strong> <span id="modal-clave"></span></p>
    <p><strong>Descripción:</strong> <span id="modal-descripcion"></span></p>
    <p><strong>Precio:</strong> $<span id="modal-precio"></span></p>
  </div>
</div>
