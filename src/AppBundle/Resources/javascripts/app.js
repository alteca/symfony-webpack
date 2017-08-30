import 'bootstrap-sass';
import 'datatables.net';
import 'datatables.net-bs';
import 'datatables.net-responsive';

import '../stylesheets/app.scss';

function initBootstrapComponents() {
    // tooltips
    $('[data-toggle="tooltip"]').tooltip();
    // dropdown
    $('.dropdown-toggle').dropdown();
}

(function($) {
    $(document).ready(function() {
        $('#welcome').html("Hello word! app js works!");
        initBootstrapComponents();
    });

    // set jquery dependencies
    window.$ = window.JQuery = $;
})(jQuery);

