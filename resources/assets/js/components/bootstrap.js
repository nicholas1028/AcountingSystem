
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Components
 |--------------------------------------------------------------------------
 |
 | Here we will load the Spark components which makes up the core client
 | application. This is also a convenient spot for you to load all of
 | your components that you write while building your applications.
 */

import VeeValidate from 'vee-validate';

Vue.use(VeeValidate, {
    fieldsBagName: 'errorbucket'
});

require('./../spark-components/bootstrap');

require('./home');
require('./../components/contacts/contact-api.js');
require('./../components/invoices/invoice-api.js');
require('./../components/invoices/invoice-create-api.js');

require('./../components/deals/deal-api.js');