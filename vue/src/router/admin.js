const admin = [{
    path: '/admin',
    component: () => import('../layouts/admin.vue'),
    children: [
        //User
        {
            path: 'users',
            name: 'admin-users',
            component: () => import('../pages/admin/users/index.vue')
        },
            {
            path: 'users/create',
            name: 'admin-users-create',
            component: () => import('../pages/admin/users/create.vue')
            },
            {
            path: 'users/:id/edit',
            name: 'admin-users-edit',
            component: () => import('../pages/admin/users/edit.vue')
            },


        //product
        {
            path: 'products',
            name: 'admin-products',
            component: () => import('../pages/admin/products/index.vue')
        },
        {
            path: 'products/create',
            name: 'admin-products-create',
            component: () => import('../pages/admin/products/create.vue')
        },
        {
            path: 'products/:id/edit',
            name: 'admin-products-edit',
            component: () => import('../pages/admin/products/edit.vue')
        },
        //category
        {
            path: 'categories',
            name: 'admin-categories',
            component: () => import('../pages/admin/categories/index.vue')
        },
            {
            path: 'categories/create',
            name: 'admin-categories-create',
            component: () => import('../pages/admin/categories/create.vue')
            },
            {
            path: 'categories/:id/edit',
            name: 'admin-categories-edit',
            component: () => import('../pages/admin/categories/edit.vue')
            },
        //role
        {
            path: 'roles',
            name: 'admin-roles',
            component: () => import('../pages/admin/roles/index.vue')
        },
        //settings
        {
            path: 'settings',
            name: 'admin-settings',
            component: () => import('../pages/admin/settings/index.vue')
        },

    ],
},
    {
        path: '/admin/login',
        name: 'admin-login',
        component: () => import('../pages/admin/auth/login.vue')
    },
    {
        path:'/admin/forgot-password',
        name:'admin-forgot-password',
        component:()=>import('../pages/admin/auth/forgotPassword.vue')
    },
]
export default admin;