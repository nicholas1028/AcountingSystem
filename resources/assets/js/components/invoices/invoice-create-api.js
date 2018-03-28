const contactApiUrl = "http://localhost/api/contacts"; //don't add '/' in the end
const invoiceApiUrl = "http://localhost/api/invoices"; //don't add '/' in the end
const invoiceCreateApiUrl = "http://localhost/api/invoices/create"; //don't add '/' in the end

Vue.component('invoice-create-api', {
    props: ['user'],

    data() {
        return {

            //contact related
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

            superuser: 'test'

        }
    },

    methods: {

        previewThumbnail: function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                var vm = this;

                reader.onload = function(e) {
                    vm.new_contact.image = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

    },
    mounted() {
        //
        //console.log('loaded');
    },

    created () {

        Bus.$on('editContact', (open_id) => {

            this.editContact(open_id);

    });

        Bus.$on('deleteContact', (open_id) => {

            this.deleteContact(open_id);

    });

    }

});
