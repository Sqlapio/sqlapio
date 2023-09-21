import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
            'resources/scss/app.scss', 
            // importando las js
            'resources/js/app.js',
            'resources/js/graphicCountAll.js',
            'resources/js/mychartGrafica.js',
            'resources/js/mychartGraficaFac.js',
            'resources/js/centers.js',
            'resources/js/dairy.js',
            'public/assets/js/bootstrap-datepicker',
            'public/jquery-ui-1.13.2/external/jquery/jquery.js',
            'public/jquery-validation-1.19.5/dist/jquery.validate.min.js',
        ],
            refresh: true,          
        }),
    ],
});
