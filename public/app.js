import './bootstrap';
import './sweetalert2';
import { confirmarEliminacion, mostrarMensajeExito, mostrarMensajeError } from './sweetalert2-custom';

// Hacer las funciones disponibles globalmente si las necesitas en el HTML
window.confirmarEliminacion = confirmarEliminacion;
window.mostrarMensajeExito = mostrarMensajeExito;
window.mostrarMensajeError = mostrarMensajeError;