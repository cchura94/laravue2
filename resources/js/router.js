import Vue from "vue";
import Router from 'vue-router';
//Importando los componentes tipo vistas
import Inicio from './views/Inicio.vue'
import Contacto from './views/Contacto.vue'
import Nosotros from './views/Nosotros.vue'
import Publicacion from './views/Publicacion.vue'
import Error404 from './views/error/404.vue'
//Administrador
import Admin from './views/admin/Admin.vue'
import Cliente from './components/admin/cliente/Cliente.vue'
import Producto from './components/admin/producto/Producto.vue'


Vue.use(Router)

export default new Router({
    routes: [{
            path: '/',
            name: 'Inicio',
            component: Inicio
        },
        {
            path: '/contacto',
            name: 'Contacto',
            component: Contacto
        },
        {
            path: '/nosotros',
            name: 'Acerca',
            component: Nosotros
        },
        {
            path: '/publicacion',
            name: 'Publicacion',
            component: Publicacion
        },
        {
            path: '/admin',
            name: 'Admin',
            component: Admin,
            children: [{
                    path: 'cliente',
                    name: 'Cliente',
                    component: Cliente
                },
                {
                    path: 'producto',
                    name: 'Producto',
                    component: Producto
                }
            ]
        },
        {
            path: '*',
            component: Error404
        }
    ],
    //mode: 'history' //quitar el # de las rutas

})
