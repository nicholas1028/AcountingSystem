const contactApiUrl = "http://localhost/api/deals"; //don't add '/' in the end

Vue.component('deal-api', {
    props: ['user'],

    data() {
        return {

            //example data
            new_contact: {

                id: '',
                team_id: '',
                open_id: '',

                name: '',
                email: '',
                emails: [{
                    id: ''
                }],

                image: '',
                phone: '',
                contact1: '',
                contact2: '',

                currency_id: '', //USD
                payment_terms: 15, //Due in 15 Days

                bill_address1: '',
                bill_address2: '',
                bill_city: '',
                bill_state: '',
                bill_postal_code: '',
                bill_country_id: '',

                copy_billing_addr: false,
                ship_phone: '',
                ship_contact: '',
                ship_address1: '',
                ship_address2: '',
                ship_city: '',
                ship_state: '',
                ship_postal_code: '',
                ship_country_id: '',
                instructions: '',

                account_no: '',
                id_no: '',
                vat_no: '',
                gst_code: '',

                fax_no: '',
                mobile_no: '',
                toll_free_no: '',
                website: ''

            },

        }
    },

    methods: {
        adddeals: function() {

            this.new_contact.id      = '';
            this.new_contact.open_id = '';

            $('#deal-modal').modal('show');

        },


    },
    mounted() {
        //
        //console.log('loaded');
    },

    created () {


    }

});
