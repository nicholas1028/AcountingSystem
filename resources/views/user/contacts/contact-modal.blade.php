<!-- Modal -->

<div id="contact-modal" name="contact-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom m-b-0">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#Contact" data-toggle="tab">Contact</a></li>
                                <li><a href="#Billing" data-toggle="tab">Billing</a></li>
                                <li><a href="#Shipping" data-toggle="tab">Shipping</a></li>
                                <li><a href="#More" data-toggle="tab">More</a></li>

                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="Contact">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" id="name"
                                                       placeholder="Organization Name" v-model="new_contact.name"
                                                       v-validate="'required'" data-vv-scope="contact_form">

                                                <i v-show="errors.has('name', 'contact_form')" class="fa fa-warning"></i>
                                                <span v-show="errors.has('name', 'contact_form')"
                                                      class="help is-danger">@{{ errors.first('name', 'contact_form') }}</span>

                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 p-r-10">

                                            <div class="form-group">
                                                <input type="text" name="email" class="form-control text-lowercase" id="email"
                                                       placeholder="Email" v-model="new_contact.email"
                                                       v-validate="'email'" data-vv-scope="contact_form">
                                                <i v-show="errors.has('email', 'contact_form')" class="fa fa-warning"></i>
                                                <span v-show="errors.has('email', 'contact_form')"
                                                      class="help is-danger">@{{ errors.first('email','contact_form') }}</span>
                                            </div>

                                        </div>
                                        <div class="col-md-2 p-l-0">

                                            <button class="btn btn-icon waves-effect waves-light btn-default" @click="addEmails()">
                                                <i class="fa fa-plus-circle"></i> More</button>
                                        </div>
                                    </div>
                                    <div class="row" v-for="(row_to, index) in new_contact.emails">
                                        <div class="col-md-10">

                                            <div class="form-group">

                                                <input type="text" class="form-control text-lowercase" id="emails[]"
                                                       v-model="row_to.id"
                                                       name="emails[]" placeholder="Email"
                                                       v-validate="'email'" data-vv-scope="contact_form">

                                                <i v-show="errors.has('emails[]', 'contact_form')"
                                                   class="fa fa-warning text-danger"></i>
                                                <span v-show="errors.has('emails[]', 'contact_form')"
                                                      class="help text-danger">The email field must be a valid email.</span>
                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <!--
                                            <button class="btn btn-xs btn-danger delete m-t-5" type="button" @click=
                                            "removeEmailLine(index, 1)"><i class="fa fa-remove"></i>
                                            </button>
                                            -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="phone" class="form-control" id="phone"
                                                       placeholder="Phone" value="" v-model="new_contact.phone"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="contact1" class="form-control text-capitalize" id="contact1"
                                                       placeholder="Primary Contact" value="" v-model="new_contact.contact1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <input type="text" name="contact2" class="form-control text-capitalize" id="contact2"
                                                       placeholder="Secondary Contact" value="" v-model="new_contact.contact2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="Billing">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Currency</label>
                                                <select class="form-control selectpicker show-tick" data-live-search="true"
                                                        name="currency_id" id="currency_id"
                                                        v-model="new_contact.currency_id">
                                                    @foreach (\Countries::all() as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}
                                                            / {{ $country->currency_code }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Payment Terms</label>
                                                <select class="form-control selectpicker show-tick" data-live-search="true"
                                                        name="payment_terms" id="payment_terms"
                                                        v-model="new_contact.payment_terms">

                                                    <option value="1">1</option>
                                                    <option value="7">7</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="15">30</option>
                                                    <option value="15">45</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>Billing Address</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control text-capitalize" readonly v-model="new_contact.name">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="bill_address1 text-capitalize" class="form-control"
                                                       id="bill_address1"
                                                       placeholder="Address Line 1" value="" v-model="new_contact.bill_address1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input type="text" name="bill_address2 text-capitalize" class="form-control"
                                                       id="bill_address2"
                                                       placeholder="Address Line 2" value="" v-model="new_contact.bill_address2">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="bill_city text-capitalize" class="form-control" id="bill_city"
                                                       placeholder="City" value="" v-model="new_contact.bill_city">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="bill_state text-capitalize" class="form-control"
                                                       id="bill_state"
                                                       placeholder="State" value="" v-model="new_contact.bill_state">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="bill_postal_code" class="form-control"
                                                       id="bill_postal_code"
                                                       placeholder="Zip Code" value="" v-model="new_contact.bill_postal_code">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control selectpicker show-tick" data-live-search="true"
                                                        name="bill_country_id" id="bill_country_id"
                                                        v-model="new_contact.bill_country_id">
                                                    @foreach (\Countries::all() as $country)
                                                        <option value="{{ $country->iso_3166_2 }}">{{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="Shipping">

                                    <h4>Shipping Address</h4>

                                    <div class="checkbox">
                                        <input id="copy_billing_addr" type="checkbox" v-model="new_contact.copy_billing_addr">
                                        <label for="copy_billing_addr"> Same as billing address </label>
                                    </div>

                                    <div v-show="!new_contact.copy_billing_addr">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-capitalize" id="ship_contact"
                                                           name="ship_contact"
                                                           placeholder="Ship to Contact Name" v-model="new_contact.ship_contact">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="ship_phone"
                                                           name="ship_phone"
                                                           placeholder="Phone" v-model="new_contact.ship_phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-capitalize" id="ship_address1"
                                                           name="ship_address1"
                                                           placeholder="Address Line 1" v-model="new_contact.ship_address1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-capitalize" id="ship_address2"
                                                           name="ship_address2"
                                                           placeholder="Address Line 2" v-model="new_contact.ship_address2">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-capitalize" id="ship_city" name="ship_city"
                                                           placeholder="City" v-model="new_contact.ship_city">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-capitalize" id="ship_state"
                                                           name="ship_state"
                                                           placeholder="State" v-model="new_contact.ship_state">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="ship_postal_code"
                                                           name="ship_postal_code"
                                                           placeholder="Zip Code" v-model="new_contact.ship_postal_code">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker show-tick" data-live-search="true"
                                                            name="ship_country_id" id="ship_country_id"
                                                            v-model="new_contact.ship_country_id">
                                                        @foreach (\Countries::all() as $country)
                                                            <option value="{{ $country->iso_3166_2 }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="instructions"
                                                       name="instructions" value=""
                                                       placeholder="Instructions" v-model="new_contact.instructions">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="More">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="account_no"
                                                       name="account_no" value=""
                                                       placeholder="Account No." v-model="new_contact.account_no">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="id_no" name="id_no" value=""
                                                       placeholder="ID No." v-model="new_contact.id_no">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="vat_no" name="vat_no"
                                                       value=""
                                                       placeholder="Vat No." v-model="new_contact.vat_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="fax_no" name="fax_no"
                                                       value=""
                                                       placeholder="Fax No." v-model="new_contact.fax_no">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                                       value=""
                                                       placeholder="Mobile No." v-model="new_contact.mobile_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="toll_free_no"
                                                       name="toll_free_no" value=""
                                                       placeholder="Toll Free No." v-model="new_contact.toll_free_no">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control text-lowercase" id="website" name="website"
                                                       placeholder="Website" v-model="new_contact.website"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="gst_code"
                                                       name="gst_code" value=""
                                                       placeholder="GST Code / GSTN No" v-model="new_contact.gst_code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            &nbsp;
                                        </div>
                                    </div>

                                    <div class="row">&nbsp;</div>
                                    <div class="row">

                                        <div class="col-md-4 col-md-offset-4">
                                            <div class="form-group">

                                                <div class="Image-input">
                                                    <div class="Image-input__image-wrapper">
                                                        <i v-show="! new_contact.image" class="icon fa fa-picture-o"></i>

                                                        <img v-show="new_contact.image" class="profile-photo-preview" :src="new_contact.image" height="150" width="150">

                                                    </div>
                                                    <input @change="previewThumbnail" class="Image-input__input" name="thumbnail" type="file" style="width: 150px;height: 150px;left: 5%;bottom: 5%;">
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white pull-left" data-dismiss="modal">Close</button>

                <a v-if="new_contact.id" href="#" class="btn btn-primary"
                   @click.prevent="updateContact">Update Changes
                </a>
                <a v-else href="#" class="btn btn-primary"
                   @click.prevent="addContact">Save Changes
                </a>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
