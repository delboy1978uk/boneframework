import $ from 'jquery'

global.$ = $;
global.jQuery = $;

import './styles/app.scss';

require('../node_modules/bootstrap/dist/js/bootstrap.min');

$(document).ready(function(){
    $('.tt').tooltip();
    $('.datepicker').datetimepicker({
        "format": "d/m/Y",
        "timepicker": false
    });
    $('.datetimepicker').datetimepicker({
        "format": "d/m/Y H:i",
    });
});
