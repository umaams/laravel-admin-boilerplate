global.$ = window.jQuery = window.$ = global.jQuery = require('jquery');
require('./bootstrap');

require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-responsive-bs4');
require('datatables.net-fixedcolumns-bs4');
require('datatables.net-fixedheader');

$.extend(true, $.fn.dataTable.defaults, {
    "language": {
        "url": "langs/" + document.documentElement.lang + ".json"
    }
});
