import Main from '@/views/Main.vue';
import Cookies from 'js-cookie';
//import Store from './../store/index'
// import jwtToken from './../libs/helpers/jwt'
// 不作为Main组件的子页面展示的页面单独写，如下
export const loginRouter = {
    path: '/login',
    name: 'login',
    meta: {
        title: 'Login - 登录'
    },
    component: () => import('@/views/login.vue')
};
export const testRouter = {
    path: '/test',
    name: 'test',
    meta: {
        title: 'test'
    },
    component: () => import('@/test.vue')
};
export const page404 = {
    path: '/*',
    name: 'error-404',
    meta: {
        title: '404-页面不存在'
    },
    component: () => import('@/views/error-page/404.vue')
};
export const page403 = {
    path: '/403',
    meta: {
        title: '403-权限不足'
    },
    name: 'error-403',
    component: () => import('@//views/error-page/403.vue')
};
export const page500 = {
    path: '/500',
    meta: {
        title: '500-服务端错误'
    },
    name: 'error-500',
    component: () => import('@/views/error-page/500.vue')
};
export const locking = {
    path: '/locking',
    name: 'locking',
    component: () => import('@/views/main-components/lockscreen/components/locking-page.vue')
};
// 作为Main组件的子页面展示但是不在左侧菜单显示的路由写在otherRouter里
export const otherRouter = {
    path: '/',
    name: 'otherRouter',
    redirect: '/home',
    component: Main,
    children: [
        {
            path: 'home',
            title: '首页',
            name: 'home_index',
            component: () => import('@/views/home/home.vue'),
            meta: {requireAuth: true}
        },
        {
            path: 'ownspace',
            title: '个人中心',
            name: 'ownspace_index',
            component: () => import('@/views/ownspace/ownspace.vue'),
            meta: {requireAuth: true}
        },
        {
            path: 'message',
            title: '消息中心',
            name: 'message_index',
            component: () => import('@/views/message/message.vue')
        },
        {
            path: 'shopinfo',
            title: '商铺详情',
            name: 'shopinfo',
            component: () => import('@/views/shop-management/shop-info.vue')
        },// 用于展示商铺详情页
        {
            path: 'productinfo',
            title: '产品详情',
            name: 'productinfo',
            component: () => import('@/views/product-management/product-info.vue')
        },// 用于展示产品详情页
        {
            path: 'transactioninfo',
            title: '交易详情',
            name: 'transactioninfo',
            component: () => import('@/views/transaction-management/transaction-info.vue')
        },// 用于展示交易详情页
    ]
};
// 作为Main组件的子页面展示并且在左侧菜单显示的路由写在appRouter里
export const appRouter = [
    {
        path: '/system-management',
        icon: 'gear-a',
        name: 'system-management',
        title: '系统管理',
        access: 1,
        component: Main,
        children: [
            {
                path: 'employee-management',
                title: '员工管理',
                icon: 'person-add',
                name: 'employee-management',
                component: () => import('@/views/system-management/employee-management.vue')
            },
            {
                path: 'role-management',
                title: '角色管理',
                icon: 'ios-body',
                name: 'role-management',
                component: () => import('@/views/system-management/role-management.vue')
            },
            {
                path: 'permission-management',
                title: '权限管理',
                icon: 'key',
                name: 'permission-management',
                component: () => import('@/views/system-management/permission-management.vue')
            },
        ]
    },
    {
        path: '/pay',
        icon: 'social-yen',
        name: 'pay',
        title: '支付管理',
        access: 1,
        component: Main,
        children: [
            {
                path: 'index',
                title: '支付管理',
                name: 'pay_index',
                component: () => import('@/views/pay-management/pay.vue')
            }
        ]
    },
    {
        path: '/user',
        icon: 'person',
        name: 'user',
        title: '用户管理',
        access: 1,
        component: Main,
        children: [
            {
                path: 'index',
                title: '用户管理',
                name: 'user_index',
                component: () => import('@/views/user/user.vue')
            }
        ]
    },
    {
        path: '/approval',
        icon: 'edit',
        name: 'approval',
        title: '审批',
        access: 1,
        component: Main,
        children: [
            {
                path: '/shop-approval',
                title: '商铺审批',
                name: 'shop-approval',
                access: 1,
                component: () => import('@/views/approval/shop-approval.vue')
            },
            {
                path: '/product-approval',
                title: '产品审批',
                name: 'product-approval',
                access: 1,
                component: () => import('@/views/approval/product-approval.vue')
            }
        ]
    },
    {
        path: '/shop-management',
        icon: 'home',
        name: 'shop-management',
        title: '商铺管理',
        access: 1,
        component: Main,
        children: [
            {
                path: 'index',
                title: '商铺管理',
                name: 'shop-management_index',
                component: () => import('@/views/shop-management/shop-management.vue')
            }
        ]
    },
    {
        path: '/product-management',
        icon: 'ios-cart',
        name: 'product-management',
        title: '产品管理',
        access: 1,
        component: Main,
        children: [
            {
                path: 'index',
                title: '产品管理',
                name: 'product-management_index',
                component: () => import('@/views/product-management/product-management.vue')
            }
        ]
    },
    {
        path: '/transaction-management',
        icon: 'social-usd',
        name: 'transaction-management',
        title: '交易管理',
        access: 1,
        component: Main,
        children: [
            {
                path: 'index',
                title: '交易管理',
                name: 'transaction-management_index',
                access: 1,
                component: () => import('@/views/transaction-management/transaction-management.vue')
            }
        ]
    },
    {
        path: '/data-graph',
        icon: 'image',
        name: 'data-graph',
        title: '数据图',
        access: 1,
        component: Main,
        children: [
            {
                path: 'index',
                title: '数据图',
                name: 'data-graph_index',
                access: 1,
                component: () => import('@/views/data-graph/data-graph.vue')
            }
        ]
    },
    {
        path: '/log',
        icon: 'document-text',
        name: 'log',
        title: '系统日志',
        access: 1,
        component: Main,
        children: [
            {
                path: 'index',
                title: '系统日志',
                name: 'log_index',
                access: 1,
                component: () => import('@/views/system-log/log.vue')
            }
        ]
    }
];
// 所有上面定义的路由都要写在下面的routers里
export const routers = [
    loginRouter,
    testRouter,
    otherRouter,
    locking,
    ...appRouter,
    page500,
    page403,
    page404
];
