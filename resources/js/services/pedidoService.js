import {
    http
} from './api'

export async function guardarPedido(datos) {
    const respuesta = await http().post("/pedido", datos);
    return respuesta.data

}
