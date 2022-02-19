require('./bootstrap');

import SwaggerUI from 'swagger-ui'

SwaggerUI({
    url: "swagger/index.yml",
    dom_id: '#swagger',
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();