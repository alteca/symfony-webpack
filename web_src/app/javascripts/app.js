import 'bootstrap-sass';
import 'datatables.net';
import 'datatables.net-bs';

import '../stylesheets/app.scss';

function initBootstrapComponents() {
    // tooltips
    $('[data-toggle="tooltip"]').tooltip();
}

(function($) {
    $('#welcome').html("Hello word! app js works!");
    initBootstrapComponents();

    // set jquery dependencies
    window.$ = window.JQuery = $;
})(jQuery);

