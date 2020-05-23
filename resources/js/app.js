global.$ = window.jQuery = window.$ = global.jQuery = require('jquery');
require('./bootstrap');

require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-responsive-bs4');
require('datatables.net-fixedcolumns-bs4');
require('datatables.net-fixedheader');
window.smartmenus = require('smartmenus');
window.select2 = require('select2');
require('smartmenus/dist/addons/bootstrap-4/jquery.smartmenus.bootstrap-4.min.js');

$.extend(true, $.fn.dataTable.defaults, {
    "language": {
        "url": "langs/" + document.documentElement.lang + ".json"
    }
});
