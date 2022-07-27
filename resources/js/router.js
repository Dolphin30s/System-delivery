import isCustomer from "./middleware/isCustomer";

require('./middleware/auth');

import VueRouter from "vue-router"
import Vue from 'vue'
import isAdmin from "./middleware/isAdmin";

const routes = [
    {
        path: '/',
        redirect: '/home'
    },
    {
        path: '',
        component: () => import('@/layouts/main/Main'),
        children: [
            {
                path: '/admin',
                name: 'admin',
                component: () => import('./pages/main'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Dashboard', url: '/'}
                    ],
                    pageTitle: 'Dashboard',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/category/list',
                name: 'categories',
                component: () => import('./pages/category/list'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Product'},
                        {title: 'Categories', active: true}
                    ],
                    pageTitle: 'Category List',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/category/edit',
                name: 'edit-category',
                component: () => import('./pages/category/new'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Product'},
                        {title: 'Edit Category', active: true}
                    ],
                    pageTitle: 'Edit Category',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/category/add',
                name: 'add-category',
                component: () => import('./pages/category/new'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Product'},
                        {title: 'Add Category', active: true}
                    ],
                    pageTitle: 'Add Category',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/user/list',
                name: 'user-list',
                component: () => import('./pages/users/list'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Management'},
                        {title: 'Users', active: true}
                    ],
                    pageTitle: 'User List',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/user/detail',
                name: 'user-detail',
                component: () => import('./pages/users/detail'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Management'},
                        {title: 'Users'},
                        {title: 'Detail', active: true}
                    ],
                    pageTitle: 'User Detail',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/restaurant/list',
                name: 'restaurants',
                component: () => import('./pages/restaurant/list'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Management'},
                        {title: 'shop', active: true}
                    ],
                    pageTitle: 'Shop',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/restaurant/add',
                name: 'add-restaurant',
                component: () => import('./pages/restaurant/new'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Management'},
                        {title: 'Add Shop', active: true}
                    ],
                    pageTitle: 'Add Shop',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/restaurant/edit',
                name: 'edit-restaurant',
                component: () => import('./pages/restaurant/new'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Management'},
                        {title: 'Edit Restaurant', active: true}
                    ],
                    pageTitle: 'Edit Restaurant',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/product/list',
                name: 'products',
                component: () => import('./pages/product/list'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Product'},
                        {title: 'Product List', active: true}
                    ],
                    pageTitle: 'Product List',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/product/add',
                name: 'add-product',
                component: () => import('./pages/product/product'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Product'},
                        {title: 'Add Product', active: true}
                    ],
                    pageTitle: 'Add Product',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/admin/product/edit',
                name: 'edit-product',
                component: () => import('./pages/product/product'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Product'},
                        {title: 'Edit Product', active: true}
                    ],
                    pageTitle: 'Edit Product',
                    middleware: [ isAdmin ]
                },
            },
            {
                path: '/product/detail',
                name: 'product-detail',
                component: () => import('./pages/product/detail'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Product'},
                        {title: 'Detail', active: true}
                    ],
                    pageTitle: 'Product Detail'
                },
            },
            {
                path: '/orders',
                name: 'orders',
                component: () => import('./pages/order/list'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Order'},
                        {title: 'Order List', active: true}
                    ],
                    pageTitle: 'Order List'
                },
            },
            {
                path: '/orders/detail',
                name: 'order-detail',
                component: () => import('./pages/order/detail'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        {title: 'Home', url: '/'},
                        {title: 'Order'},
                        {title: 'Order Detail', active: true}
                    ],
                    pageTitle: 'Order Detail'
                },
            }
        ]
    },
    {
        path: '',
        component: () => import('@/layouts/main/Main'),
        children: [
            {
                path: '/home',
                name: 'shop',
                component: () => import('./pages/shop/index'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        { title: 'Home', url: '/home' },
                        { title: 'Shop', active: true }
                    ],
                    pageTitle: 'Shop',
                    middleware: [ isCustomer ]
                },
            },
            {
                path: '/home/detail',
                name: 'shop-detail',
                component: () => import('./pages/shop/detail'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        { title: 'Home', url: '/home' },
                        { title: 'Shop'},
                        { title: 'Detail', active: true }
                    ],
                    pageTitle: 'Detail',
                    middleware: [ isCustomer ]
                },
            },
            {
                path: '/home/cart',
                name: 'checkout',
                component: () => import('./pages/cart/checkout'),
                meta: {
                    auth: true,
                    breadcrumb: [
                        { title: 'Home', url: '/home' },
                        { title: 'Shop'},
                        { title: 'Checkout', active: true }
                    ],
                    pageTitle: 'Checkout',
                    middleware: [ isCustomer ]
                },
            },
            {
                path: '/home/profile',
                name: 'profile-edit',
                component: () => import('./pages/users/edit'),
                meta: {
                    auth: true,
                    pageTitle: 'Profile Edit'
                },
            }
        ]
    },
    {
        path: '',
        component: () => import('@/layouts/full-page/FullPage'),
        children: [
            {
                path: '/register',
                name: 'register',
                component: () => import('@/pages/auth/register'),
                meta: {
                    auth: false
                },
            }, {
                path: '/login',
                name: 'login',
                component: () => import('@/pages/auth/login'),
                meta: {
                    auth: false
                },
            }, {
                path: '/not-authorized',
                name: 'not-authorized',
                component: () => import('@/pages/NotAuthorized.vue'),
                meta: {
                    auth: undefined
                },
            },
            {
                path: '/error-403',
                name: 'error-403',
                component: () => import('@/pages/Error403.vue'),
                meta: {
                    auth: undefined
                },
            },
            {
                path: '/error-404',
                name: 'error-404',
                component: () => import('@/pages/Error404.vue'),
                meta: {
                    auth: undefined
                },
            },
            {
                path: '/error-500',
                name: 'error-500',
                component: () => import('@/pages/Error500.vue'),
                meta: {
                    auth: undefined
                },
            }
        ]
    },
    //Redirect to 404 page, if no match found
    // {
    //     path: '*',
    //     redirect: '/error-404'
    // }
]

const router = new VueRouter({
    base: '/',
    history: true,
    mode: 'history',
    scrollBehavior() {
        return {x: 0, y: 0}
    },
    routes: routes
});

function middlewarePipeline (context, middleware, index) {
    const nextMiddleware = middleware[index];

    if(!nextMiddleware){
        return context.next
    }

    return () => {
        const nextPipeline = middlewarePipeline(
            context, middleware, index + 1
        );

        nextMiddleware({ ...context, next_middleware: nextPipeline })

    }
}

router.beforeEach((to, from, next) => {
    //console.log('from - to :', from, to);
    const user = Vue.auth.user();
    if(!user && Vue.auth.token()){
        return Vue.auth.fetch().then(()=>{
            if (!to.meta.middleware) {
                return next()
            }
            const middleware = to.meta.middleware;

            const context = {
                to,
                from,
                next
            };
            return middleware[0]({
                ...context,
                next_middleware: middlewarePipeline(context, middleware, 1)
            })
        });
    }
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware;

    const context = {
        to,
        from,
        next
    };
    return middleware[0]({
        ...context,
        next_middleware: middlewarePipeline(context, middleware, 1)
    })
});

export default router
