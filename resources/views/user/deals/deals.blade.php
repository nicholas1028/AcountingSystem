@extends('spark::layouts.app')

@section('scripts')



@endsection

@section('content')
    <deal-api :user="user" inline-template>
        <div class="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-b-15">

                        <button type="button" @click="adddeals()"
                                class="btn btn-default">
                            <i class="md md-add"></i> Add Deal
                        </button>

                    </div>
                    <h4 class="page-title">Deals</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <div class="box">
                        <div class="box-body table-responsive">

                            <table id="datatable-contact"
                                   class="table table-bordered table-striped dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>First Contact</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>First Contact</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>


                        </div>

                    </div>

                </div> <!-- end col -->

            </div>

            <!-- Modal -->
            @include('user.deals.deal-modal')

        </div>

    </deal-api>
@endsection

@section('before_footer')

@endsection

@section('after_footer')

    <!-- DataTables -->

    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css"/>

    <script type="text/javascript" src="/DataTables/datatables.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    <script>

        $(document).ready(function () {

            var contactTable = $('#datatable-contact').DataTable({
                order: [[0, 'desc'], [2, 'desc']],

                dom: 'lfrtBip', //Blrtip
                //searching: true,
                //select: true,
                colReorder: true,
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'colvis'
                ],

                processing: true,
                serverSide: true,
                //"bDestroy": true
                ajax: {
                    'url': 'http://localhost/api/deals',
                    'type': 'GET',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },

                columns: [

                    {data: 'open_id', name: 'open_id'},
                    {data: 'image', name: 'image'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'contact1', name: 'contact1'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });


        });

    </script>
    <script>

        function editContact(open_id) {

            Bus.$emit('editContact', open_id);

        }

        function deleteContact(open_id) {

            Bus.$emit('deleteContact', open_id);

        }

    </script>

@endsection
