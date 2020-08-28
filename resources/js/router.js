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
import Login from './views/Login.vue'

import Pedido from './components/admin/pedido/Pedido.vue'

function authGuard(to, from, next) {
    try {
        const token = JSON.parse(atob(localStorage.getItem("token")))
        if (token && token.access_token) {
            next()
        } else {
            next({
                name: "Login"
            })
        }

    } catch (error) {
        console.log(error)
        localStorage.removeItem("token");
        next({
            name: "Login"
        })
    }
}


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
            component: Publicacion,
        },
        {
            path: '/ingresar',
            name: 'Login',
            component: Login
        },
        {
            path: '/admin',
            name: 'Admin',
            component: Admin,
            beforeEnter: authGuard,
            meta: {
                requireAuth: true
            },
            children: [{
                    path: 'cliente',
                    name: 'Cliente',
                    component: Cliente,
                    beforeEnter: authGuard,
                    meta: {
                        requireAuth: true
                    },
                },
                {
                    path: 'producto',
                    name: 'Producto',
                    component: Producto,
                    beforeEnter: authGuard,
                    meta: {
                        requireAuth: true
                    },
                },
                {
                    path: 'pedido/:id',
                    name: 'Pedido',
                    component: Pedido,
                    beforeEnter: authGuard,
                    meta: {
                        requireAuth: true
                    },
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
