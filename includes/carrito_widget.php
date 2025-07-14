<?php
require_once 'services/carrito_service.php';
$carritoService = new CarritoService();
$cantidadTotal = $carritoService->obtenerCantidadTotal();
?>

<!-- Icono del carrito -->
<div id="carrito-widget" style="
    position: fixed;
    right: 20px;
    bottom: 20px;
    top: auto;
    transform: none;
    background: white;
    border: 2px solid #333;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path d="m1 1 4 4 2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
    </svg>
    <span id="carrito-contador" style="
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: <?php echo $cantidadTotal > 0 ? 'flex' : 'none'; ?>;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    "><?php echo $cantidadTotal; ?></span>
</div>

<!-- Modal del carrito -->
<div id="carrito-modal" style="
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
">
    <div style="
        background: white;
        width: 90%;
        max-width: 600px;
        max-height: 80vh;
        border-radius: 10px;
        border: 2px solid black;
        overflow: hidden;
    ">
        <div style="
            padding: 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        ">
            <h2 style="margin: 0;">Carrito de Compras</h2>
            <button id="cerrar-carrito" style="
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
                padding: 5px;
            ">✕</button>
        </div>
        <div id="carrito-contenido" style="
            padding: 20px;
            max-height: 400px;
            overflow-y: auto;
        ">
            <!-- El contenido se carga dinámicamente -->
        </div>
        <div id="carrito-footer" style="
            padding: 20px;
            border-top: 1px solid #ddd;
            background: #f9f9f9;
            display: none;
        ">
            <div style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            ">
                <h3 id="carrito-total" style="margin: 0;">Total: $0</h3>
                <button id="vaciar-carrito" style="
                    background: none;
                    border: 1px solid #ff4444;
                    color: #ff4444;
                    padding: 8px 16px;
                    border-radius: 4px;
                    cursor: pointer;
                ">Vaciar Carrito</button>
            </div>
            <button id="confirmar-compra" style="
                width: 100%;
                padding: 15px;
                background: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
            ">Confirmar Compra</button>
        </div>
    </div>
</div>

<script>
// Sistema de carrito con PHP
class CarritoPHP {
    constructor() {
        this.inicializar();
    }
    
    inicializar() {
        this.configurarEventos();
        this.cargarCarrito();
    }
    
    configurarEventos() {
        // Abrir carrito
        document.getElementById('carrito-widget').addEventListener('click', () => {
            this.abrirCarrito();
        });
        
        // Cerrar carrito
        document.getElementById('cerrar-carrito').addEventListener('click', () => {
            this.cerrarCarrito();
        });
        
        // Cerrar al hacer click fuera
        document.getElementById('carrito-modal').addEventListener('click', (e) => {
            if (e.target.id === 'carrito-modal') {
                this.cerrarCarrito();
            }
        });
        
        // Vaciar carrito
        document.getElementById('vaciar-carrito').addEventListener('click', () => {
            this.vaciarCarrito();
        });
        
        // Confirmar compra
        document.getElementById('confirmar-compra').addEventListener('click', () => {
            this.confirmarCompra();
        });
        
        // Configurar botones de comprar
        this.configurarBotonesComprar();
    }
    
    configurarBotonesComprar() {
        const botonesComprar = document.querySelectorAll('.boton-comprar');
        
        botonesComprar.forEach(boton => {
            boton.addEventListener('click', (e) => {
                e.preventDefault();
                
                const contenedor = boton.closest('.leche') || boton.closest('.info-producto');
                
                if (contenedor) {
                    const nombre = contenedor.querySelector('.nombre-articulo, h2')?.textContent?.trim();
                    const precioTexto = contenedor.querySelector('.precio, .price')?.textContent?.trim();
                    const precio = parseFloat(precioTexto?.replace(/[^0-9.]/g, '')) || 0;
                    const autor = contenedor.querySelector('.Autor-articulo')?.textContent?.replace('Publicado por:', '')?.trim() || 'Autor desconocido';
                    
                    const imagenContainer = boton.closest('.plato, .cuadro');
                    const imagen = imagenContainer?.querySelector('img')?.src || '';
                    
                    if (nombre && precio > 0) {
                        const id = this.generarId(nombre);
                        this.agregarAlCarrito(id, nombre, precio, autor, imagen);
                    }
                }
            });
        });
    }
    
    generarId(nombre) {
        return nombre.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
    }
    
    async agregarAlCarrito(id, nombre, precio, autor, imagen) {
        try {
            const formData = new FormData();
            formData.append('action', 'agregar');
            formData.append('id', id);
            formData.append('nombre', nombre);
            formData.append('precio', precio);
            formData.append('autor', autor);
            formData.append('imagen', imagen);
            
            const response = await fetch('api/carrito_api.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.actualizarContador(data.cantidad_total);
                this.mostrarNotificacion(`${nombre} agregado al carrito!`);
            }
        } catch (error) {
            console.error('Error al agregar al carrito:', error);
        }
    }
    
    async eliminarDelCarrito(id) {
        try {
            const formData = new FormData();
            formData.append('action', 'eliminar');
            formData.append('id', id);
            
            const response = await fetch('api/carrito_api.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.actualizarContador(data.cantidad_total);
                this.actualizarContenidoCarrito();
            }
        } catch (error) {
            console.error('Error al eliminar del carrito:', error);
        }
    }
    
    async actualizarCantidad(id, cantidad) {
        try {
            const formData = new FormData();
            formData.append('action', 'actualizar');
            formData.append('id', id);
            formData.append('cantidad', cantidad);
            
            const response = await fetch('api/carrito_api.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.actualizarContador(data.cantidad_total);
                this.actualizarContenidoCarrito();
            }
        } catch (error) {
            console.error('Error al actualizar cantidad:', error);
        }
    }
    
    async vaciarCarrito() {
        try {
            const formData = new FormData();
            formData.append('action', 'vaciar');
            
            const response = await fetch('api/carrito_api.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.actualizarContador(0);
                this.actualizarContenidoCarrito();
            }
        } catch (error) {
            console.error('Error al vaciar carrito:', error);
        }
    }
    
    async confirmarCompra() {
        try {
            const formData = new FormData();
            formData.append('action', 'confirmar');
            
            const response = await fetch('api/carrito_api.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.mostrarMensajeExito();
                this.actualizarContador(0);
                this.cerrarCarrito();
            }
        } catch (error) {
            console.error('Error al confirmar compra:', error);
        }
    }
    
    async cargarCarrito() {
        try {
            const response = await fetch('api/carrito_api.php?action=obtener');
            const data = await response.json();
            
            if (data.success) {
                this.actualizarContador(data.cantidad_total);
            }
        } catch (error) {
            console.error('Error al cargar carrito:', error);
        }
    }
    
    async abrirCarrito() {
        await this.actualizarContenidoCarrito();
        document.getElementById('carrito-modal').style.display = 'flex';
    }
    
    cerrarCarrito() {
        document.getElementById('carrito-modal').style.display = 'none';
    }
    
    async actualizarContenidoCarrito() {
        try {
            const response = await fetch('api/carrito_api.php?action=obtener');
            const data = await response.json();
            
            const contenido = document.getElementById('carrito-contenido');
            const footer = document.getElementById('carrito-footer');
            
            if (!data.success || data.carrito.length === 0) {
                contenido.innerHTML = `
                    <p style="text-align: center; color: #666; padding: 40px;">
                        Tu carrito está vacío
                    </p>
                `;
                footer.style.display = 'none';
                return;
            }
            
            let html = '';
            data.carrito.forEach(item => {
                html += `
                    <div style="
                        display: flex;
                        align-items: center;
                        padding: 15px 0;
                        border-bottom: 1px solid #eee;
                    ">
                        <img src="${item.imagen}" alt="${item.nombre}" style="
                            width: 80px;
                            height: 80px;
                            object-fit: cover;
                            margin-right: 15px;
                            border: 1px solid #ddd;
                        ">
                        <div style="flex: 1;">
                            <h4 style="margin: 0 0 5px 0;">${item.nombre}</h4>
                            <p style="margin: 0; color: #666; font-size: 14px;">
                                Por: ${item.autor}
                            </p>
                            <p style="margin: 5px 0; font-weight: bold;">
                                $${item.precio}
                            </p>
                        </div>
                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 10px;
                        ">
                            <button onclick="carritoPHP.actualizarCantidad('${item.id}', ${item.cantidad - 1})" style="
                                border: 1px solid #ddd;
                                background: white;
                                width: 30px;
                                height: 30px;
                                border-radius: 4px;
                                cursor: pointer;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">-</button>
                            <span style="
                                min-width: 30px;
                                text-align: center;
                                font-weight: bold;
                            ">${item.cantidad}</span>
                            <button onclick="carritoPHP.actualizarCantidad('${item.id}', ${item.cantidad + 1})" style="
                                border: 1px solid #ddd;
                                background: white;
                                width: 30px;
                                height: 30px;
                                border-radius: 4px;
                                cursor: pointer;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">+</button>
                            <button onclick="carritoPHP.eliminarDelCarrito('${item.id}')" style="
                                border: 1px solid #ff4444;
                                background: white;
                                color: #ff4444;
                                width: 30px;
                                height: 30px;
                                border-radius: 4px;
                                cursor: pointer;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                margin-left: 10px;
                            ">🗑</button>
                        </div>
                    </div>
                `;
            });
            
            contenido.innerHTML = html;
            document.getElementById('carrito-total').textContent = `Total: $${data.total.toFixed(2)}`;
            footer.style.display = 'block';
            
        } catch (error) {
            console.error('Error al actualizar contenido del carrito:', error);
        }
    }
    
    actualizarContador(cantidad) {
        const contador = document.getElementById('carrito-contador');
        if (contador) {
            contador.textContent = cantidad;
            contador.style.display = cantidad > 0 ? 'flex' : 'none';
        }
    }
    
    mostrarMensajeExito() {
        const mensaje = document.createElement('div');
        mensaje.innerHTML = `
            <div style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10001;
            ">
                <div style="
                    background: white;
                    padding: 40px;
                    border-radius: 10px;
                    text-align: center;
                    max-width: 400px;
                    border: 2px solid #4CAF50;
                ">
                    <h2 style="color: #4CAF50; margin-bottom: 20px;">¡Compra Exitosa!</h2>
                    <p>Tu pedido ha sido procesado correctamente.</p>
                    <p>Gracias por tu compra.</p>
                </div>
            </div>
        `;
        document.body.appendChild(mensaje);
        
        setTimeout(() => {
            document.body.removeChild(mensaje);
        }, 2000);
    }
    
    mostrarNotificacion(texto) {
        const notificacion = document.createElement('div');
        notificacion.textContent = texto;
        notificacion.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            z-index: 10001;
            animation: slideIn 0.3s ease-out;
        `;
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
        document.body.appendChild(notificacion);
        
        setTimeout(() => {
            if (document.body.contains(notificacion)) {
                document.body.removeChild(notificacion);
            }
            if (document.head.contains(style)) {
                document.head.removeChild(style);
            }
        }, 3000);
    }
}

// Inicializar el carrito cuando la página esté lista
let carritoPHP;
document.addEventListener('DOMContentLoaded', function() {
    carritoPHP = new CarritoPHP();
});
</script>