import VueRouter from 'vue-router';
import navBar from './components/navBar.vue';
import login from './components/logIn.vue';
import home from './components/home.vue';
import setting from './components/setting.vue';
import settingSidebar from './components/setting/sidebar.vue';
import element from './components/setting/element.vue';
import product from './components/setting/product.vue';
import group from './components/setting/group.vue';

let routes = [
    {
        path: '/',
        redirect: '/home'
    },
    {
        path: '/login',
        name: 'login',
        component: login
    },
    {
        path: '/home',
        name: 'home',
        components: {
            nav: navBar,
            default: home
          }
    },
    {
        path: '/setting',
        components: {
            nav: navBar,
            default: setting,
          },
        children: [
            {
                path: '/',
                name: 'setting',
                components: {
                    sidebar: settingSidebar,
                    content: element
                }
            },
            {
                path: 'group',
                name: 'group',
                components: {
                    sidebar: settingSidebar,
                    content: group
                }
            },
            {
                path: 'element',
                name: 'element',
                components: {
                    sidebar: settingSidebar,
                    content: element
                }
            },
            {
                path: 'product',
                name: 'product',
                components: {
                    sidebar: settingSidebar,
                    content: product
                }
            }
        ]
        
    },
];
{/* <router-link name="nav"></router-link> */}

export default new VueRouter({
    routes: routes,
    linkActiveClass: 'active'
})