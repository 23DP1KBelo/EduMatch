import { createApp } from 'vue';
import { createVuetify } from 'vuetify';

import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css';

import App from './App.vue';

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'eduMatchLight',
        themes: {
            eduMatchLight: {
                dark: false,
                colors: {
                    background: '#fbfaf7',
                    surface: '#ffffff',
                    'surface-variant': '#eef1e8',
                    primary: '#214d3b',
                    secondary: '#cc7957',
                    error: '#b7463e',
                    info: '#58758a',
                    success: '#52745b',
                    warning: '#ad7845',
                },
            },
        },
    },
});

createApp(App)
    .use(vuetify)
    .mount('#app');
