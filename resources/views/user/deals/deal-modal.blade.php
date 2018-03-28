<!-- Modal -->

<div id="deal-modal" name="deal-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Add Deal
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deal Title</label>
                            <input class="form-control" placeholder="please enter deal title" name="deal_name" type="text">
                        </div>
                        <div class="col-md-7">
                            <label>value</label>
                            <input class="form-control" name="value" placeholder="value" type="number">
                        </div>
                        <div class="col-md-5">
                            <label>currency</label>
                            <input class="form-control" name="currency" type="text">
                        </div>
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Progress</option>
                        </select>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white pull-left" data-dismiss="modal">Close</button>
                <a v-else href="#" class="btn btn-primary"
                   @click.prevent="addContact">Save Changes
                </a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
