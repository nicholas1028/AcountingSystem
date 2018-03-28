@extends('spark::layouts.app')

@section('scripts')

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700italic,700,800,800italic'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/invoice/normalize.css">
    <link rel="stylesheet" href="/css/invoice/foundation.min.css">
    <link rel="stylesheet" href="/css/invoice/style.css">

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

    <style>
        .Image-input {
            display: flex;
            width: 422px;
        }

        .Image-input__image-wrapper {
            flex-basis: 80%;
            height: 114px;
            flex: 2.5;
            border-radius: 1px;
            margin-right: 10px;
            overflow-y: hidden;
            border-radius: 1px;
            background: #fff;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .Image-input__image-wrapper > .icon {
            color: #ccc;
            font-size: 50px;
            cursor: default;
        }

        .Image-input__image {
            max-width: 100%;
            border-radius: 1px;

        }

        .Image-input__input-wrapper {
            overflow: hidden;
            position: relative;
            background: #eee;
            border-radius: 1px;
            float: left;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            color: rgba(0, 0, 0, 0.2);
            transition: 0.4s background;
        }

        .Image-input__input-wrapper:hover {
            background: #e0e0e0;
        }

        .Image-input__input {
            cursor: inherit;
            display: block;
            font-size: 999px;
            min-height: 100%;
            opacity: 0;
            position: absolute;
            right: 0;
            text-align: right;
            top: 0;
            cursor: pointer;
        }
    </style>

@endsection

@section('content')

    <invoice-create-api :user="user" inline-template>

        <div class="box">

            <div class="row">
                &nbsp;
            </div>

            <div class="header row">

                <div class="col-lg-5 col-md-8 col-sm-12">

                    <div class="Image-input">
                        <div class="Image-input__image-wrapper">
                            <i v-show="! new_contact.image" class="icon fa fa-picture-o"></i>

                            <img v-show="new_contact.image" class="profile-photo-preview" :src="new_contact.image" height="114" width="422">

                        </div>
                        <input @change="previewThumbnail" class="Image-input__input" name="thumbnail" type="file" style="width: 422px;height: 114px;left: 5%;bottom: 5%;">
                    </div>

                </div>

                <div class="col-lg-2 col-md-12 col-sm-12 col-lg-offset-1">
                    <div class="header-contact">
                        <img class="icon-mail" src="/img/invoice/mail.png">
                        <p>info@companyname.com<br>
                            careers@companyname.com<br>
                            jobs@companyname.com</p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-12 col-sm-12">
                    <div class="header-contact">
                        <img class="icon-telephone" src="/img/invoice/phone.png">
                        <p>+44(0) 131 1234 1234<br>
                            Monday to Friday<br>
                            9am to 5pm lines are open</p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-12 col-sm-12">
                    <div class="header-contact" style="border-right:none;">
                        <img class="icon-web" src="/img/invoice/world.png">
                        <p>www.companywebsite.com</p>
                    </div>
                </div>

            </div><!--header-->


            <div class="header-bottom row">

                <div>
                    <span>Username:</span>
                    <a href="#" id="username" data-type="text" data-placement="right" data-title="Enter username">@{{ superuser }}</a>

                    <span>Status:</span>
                    <a href="#" id="status"></a>

                </div>
                <div class="col-lg-6 col-md-6 header-bottom-left">

                    <h3><img class="icon-invoice" src="/img/invoice/invoice.png"></i>INVOICE TO</h3>
                    <h2>STEVEN COLE</h2>

                    <p style="margin-bottom:10px;line-height:22px;">256 highlang garden, london<br>
                        SW1234, United Kingdom</p>

                    <p style="margin-bottom:10px;"><img class="icon-mail" src="/img/invoice/mail.png"></i>
                        steven.cole@mywebsite.com</p>
                    <p><img class="icon-mobile" src="/img/invoice/mobile.png"></i>012312 23232</p>

                </div>

                <div class="col-lg-6 col-md-6 invoice-header">

                    <h2>INVOICE</h2>

                    <div class="table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <td>
                                    <div class="circle"><img class="icon-dollar" src="/img/invoice/dollar.png"></div>
                                </td>
                                <td>
                                    <div class="circle"><img class="icon-calendar" src="/img/invoice/calendar.png"></div>
                                </td>
                                <td>
                                    <div class="circle" style="padding-top:20px;"><img class="icon-barcode"
                                                                                       src="/img/invoice/barcode.png"></div>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Total Due:<br>
                                    <strong>$2624.28</strong>
                                </td>
                                <td>
                                    Invoice Date:<br>
                                    <strong>22 March 2012</strong>
                                </td>
                                <td>
                                    Invoice #:<br>
                                    <strong>2144877</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div><!--header-bottom-->


            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-body table-responsive">
                        <table class="products-table">
                        <thead>
                        <tr>
                            <th>Item Description</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5>Web Design</h5>
                                <p>An affordable website solution that provides everything a company needs<br>
                                    for a professional online presence.</p>
                            </td>
                            <td>$599.00</td>
                            <td>2</td>
                            <td>$1198.00</td>
                        </tr>
                        <tr>
                            <td>
                                <h5>E-Book Design</h5>
                                <p>E-Book design which includes interface designing, charcter design, <br>
                                    deployment and upload on the server.</p>
                            </td>
                            <td>$390.00</td>
                            <td>1</td>
                            <td>$390.00</td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Hosting Plan</h5>
                                <p>One years hosting plan which includes 2 free email
                                    ddresses, Free live support.</p>
                            </td>
                            <td>$114.00</td>
                            <td>1</td>
                            <td>$114.00</td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Brochure Design</h5>
                                <p>Brochure design in Green and red color for international Film festival<br>
                                    New york November 2012.</p>
                            </td>
                            <td>$200.00</td>
                            <td>3</td>
                            <td>$600.00</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="large-5 medium-5 small-12 columns bottom-left show-for-medium-up ">
                    <table>
                        <thead>
                        <tr>
                            <th><strong>Payment Method:</strong> Cheque, Paypal, BACS, Western Union.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><p><strong>payments@websitename.com</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img class="icon-cc" src="/img/invoice/cc.png">
                                <p><strong>Card Payment</strong></p>
                                <p>We Accept:</p>
                                <p>Visa, Master card, American Express</p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>
                                    <strong>Active Interactive</strong><br>
                                    256 highland garden,<br>
                                    london SW1235,<br>
                                    United Kingdom
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="large-4 medium-6 small-12 large-offset-3 columns totals">
                    <table>
                        <tbody>
                        <tr>
                            <td>SUB TOTAL:</td>
                            <td>$2302.00</td>
                        </tr>
                        <tr>
                            <td>Tax: VAT 20%</td>
                            <td>$460.40</td>
                        </tr>
                        <tr class="discount">
                            <td><span>DISCOUNT 5%:</span></td>
                            <td><span>-$138.12</span></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Total Due:</td>
                            <td>$4278.00</td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="signature">
                        <img class="icon-signature" src="/img/invoice/sign.png">
                        <p>Terry Brown</p>
                        <p><strong>Accounts Manager</strong></p>
                    </div>
                </div>
            </div>

            <!--This section enables for smaller screens and phones-->
            <div class="large-5 medium-5 small-12 columns bottom-left show-for-small-only">
                <table>
                    <thead>
                    <tr>
                        <th><strong>Payment Method:</strong> Cheque, Paypal, BACS, Western Union.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><p><strong>payments@websitename.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img class="icon-cc" src="/img/invoice/cc.png">
                            <p><strong>Card Payment</strong></p>
                            <p>We Accept:</p>
                            <p>Visa, Master card, American Express</p>
                        </td>
                    </tr>
                    <tr>
                        <td><p>
                                <strong>Active Interactive</strong><br>
                                256 highland garden,<br>
                                london SW1235,<br>
                                United Kingdom
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row terms">
                <div class="large-12 columns">
                    <p><strong>Terms:</strong> Payment should be made within 30 days by cheque, western union money
                        transfer or phone us.</p>
                </div>
            </div>

            <div class="footer row">
                <div class="large-5 medium-3 columns">
                    <img src="/img/invoice/footer-logo.png">
                </div>
                <div class="large-2 medium-3 large-offset-1 columns">
                    <p>+44(0) 131 1234 1234<br>
                        Monday to Friday<br>
                        9am to 5pm lines are open</p>
                </div>

                <div class="large-2 medium-3 columns">
                    <p>+44(0) 123 1231 1234</p>
                </div>

                <div class="large-2 medium-3 columns">
                    <p style="border:none;">www.companywebsite.com</p>
                </div>
            </div>

        </div><!--screen-->

    </invoice-create-api>

@endsection

@section('before_footer')

@endsection

@section('after_footer')

    <script>
        $(document).ready(function() {
            //toggle `popup` / `inline` mode
            $.fn.editable.defaults.mode = 'inline';

            //make username editable
            $('#username').editable();

            //make status editable
            $('#status').editable({
                type: 'select',
                title: 'Select status',
                placement: 'right',
                value: 2,
                source: [
                    {value: 1, text: 'status 1'},
                    {value: 2, text: 'status 2'},
                    {value: 3, text: 'status 3'}
                ]
                /*
                //uncomment these lines to send data on server
                ,pk: 1
                ,url: '/post'
                */
            });

            $('#username').on('save', function(e, params) {
                //alert('Saved value: ' + params.newValue);
                Bus.$emit('deleteContact', open_id);
            });
        });
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

@endsection