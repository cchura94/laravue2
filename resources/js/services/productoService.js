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

/**
 * Función para guardar un Producto
 * @param {*} datos 
 */
export async function guardarProducto(datos) {
    const respuesta = await http().post("/producto", datos);
    return respuesta.data
}

export function modificarProducto(datos) {
    return "Modificando";
}

export function eliminarProducto(datos) {
    return "Elimindo...";
}
