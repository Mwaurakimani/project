import './bootstrap';
import '../css/app.css';
import '../scss/index.scss';

import jQuery from 'jquery';
window.$ = jQuery;

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createPinia } from "pinia/dist/pinia";


//global components
import SideBar from "./AppComponents/LayoutComponents/SideBar.vue";
import pageHeader from "./AppComponents/LayoutComponents/PageHeader.vue";
import Layout from "./Layouts/Layout.vue";
import Modal from "./AppComponents/Modal.vue";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const Store = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .mixin({
                components:{
                    SideBar,
                    pageHeader,
                    Layout,
                    Modal
                }
            })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Store)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });


