require('./bootstrap');

import SwaggerUI from 'swagger-ui'

SwaggerUI({
    url: "swagger/index.yml",
    dom_id: '#swagger',
});