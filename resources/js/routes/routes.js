const Dashboard = () => import('components/pages/Dashboard.vue');
const Messages = () => import('components/pages/Messages.vue');
const Settings = () => import('components/pages/Settings.vue');


export const routes = [
    {
        path: '/',
        component: Dashboard,
        name: 'dasboard',
    },
    {
        path: '/messages',
        component: Messages,
        name: 'messages',
    },
    { 
        path: '/settings',
        component: Dashboard,
        name: 'settings',
    },
 
 
];