// const base_api_path = "http://localhost/";
const contactApiUrl = "http://localhost/api/contacts"; //don't add '/' in the end

Vue.component('contact-api', {
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
        },

        deleteContact: function (contact_open_id) {

            //console.log(contact_open_id + ' ' + contactApiUrl);

            axios.delete(contactApiUrl + '/' + contact_open_id).then((response) => {

                this.new_contact = response.data;
                $("#datatable-contact").DataTable().ajax.reload();

                }, (errorResponse) =>{

                console.error("Error getting response from the server " + errorResponse);

            });

        },

        editContact: function (contact_open_id) {

            //console.log(contact_open_id + ' ' + contactApiUrl);

            axios.get(contactApiUrl + '/' + contact_open_id).then((response) => {
                this.new_contact = response.data;

                }, (errorResponse) =>{

                console.error("Error getting response from the server " + errorResponse);

            });

            $('#contact-modal').modal('show');

        },


        showContact: function() {

            this.new_contact.id      = '';
            this.new_contact.open_id = '';

            $('#contact-modal').modal('show');

        },

        addContact: function () {

            axios.post(contactApiUrl, this.new_contact).then((response) => {

                this.new_contact = response.data;
                $('#contact-modal').modal('hide');

                $("#datatable-contact").DataTable().ajax.reload();

                sweetAlert({
                    type: 'success',
                    title: 'Contact Created',
                    text: 'I will close in 2 seconds.',
                    timer: 2000

                });

                }, (errorResponse) =>{

                console.error("Error getting response from the server " + errorResponse);

            });

        },

        updateContact() {

            this.$validator.validateAll().then(success => {

                if (!success) {
                    return;
                }
                else {

                    axios.put(contactApiUrl + '/' + this.new_contact.open_id, this.new_contact).then((response) => {

                        if(response.data)
                        {

                            $("#datatable-contact").DataTable().ajax.reload();
                            $('#contact-modal').modal('hide');

                            sweetAlert({
                                type: 'success',
                                title: 'Contact Updated',
                                text: 'I will close in 2 seconds.',
                                timer: 2000
                            });

                        }else {

                            sweetAlert({
                                type: 'error',
                                title: 'Update Failed',
                                text: 'I will close in 2 seconds.',
                                timer: 2000
                            });

                        }


                        }, (errorResponse) => {

                        console.error("Error Posting to the server " + errorResponse);

                    });
                }

            });

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
