import {
    http,
    httpFile
} from './api'

export async function listarProductos() {
    const respuesta = await http().get("/producto");
    return respuesta.data

    /*return http().get("/producto").then((respuesta) => {
        return respuesta.data
    })*/
}

export function guardarProducto(datos) {
    return "Guardando";
}

export function modificarProducto(datos) {
    return "Modificando";
}

export function eliminarProducto(datos) {
    return "Elimindo...";
}
