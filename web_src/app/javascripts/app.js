import $ from 'jquery';
import 'bootstrap-sass';

import '../stylesheets/app.scss';

function initBootstrapComponents() {
    // tooltips
    $('[data-toggle="tooltip"]').tooltip();
}

(function() {
    $('#welcome').html("Hello word! app js works!");
    initBootstrapComponents();
})();
