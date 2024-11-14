// Función para confirmar eliminación
export function confirmarEliminacion(formId) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "No podrás revertir esta acción",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#4f46e5',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

// Función para mostrar mensajes de éxito
export function mostrarMensajeExito(mensaje) {
    Swal.fire({
        title: "¡Éxito!",
        text: mensaje,
        icon: "success",
        confirmButtonColor: '#4f46e5'
    });
}

// Función para mostrar mensajes de error
export function mostrarMensajeError(mensaje) {
    Swal.fire({
        title: "Error",
        text: mensaje,
        icon: "error",
        confirmButtonColor: '#dc2626'
    });
}

// Función para inicializar los listeners de mensajes de sesión
export function inicializarMensajesSweetAlert() {
    // Verifica si hay mensajes de sesión en los meta tags
    const successMessage = document.querySelector('meta[name="message-success"]')?.content;
    const errorMessage = document.querySelector('meta[name="message-error"]')?.content;

    if (successMessage) {
        mostrarMensajeExito(successMessage);
    }

    if (errorMessage) {
        mostrarMensajeError(errorMessage);
    }
}

// Inicializar cuando el DOM está listo
document.addEventListener('DOMContentLoaded', inicializarMensajesSweetAlert);