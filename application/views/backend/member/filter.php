<form id="form-filter" autocomplete="off" method="post">
    <div class="row">                
        <div class="form-group col-sm-3">
            <label class="control-label">Member Type</label>
            <select name="fType" class="form-control">
                <option value="0">Select Type</option>
                <option value="1">Partner</option>
                <option value="2">Client</option>
                <option value="3">Subscriber</option>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <label class="control-label">Status</label>
            <select name="fStatus" class="form-control">
                <option value="none">Select Status</option>
                <option value="1">Active</option>
                <option value="0">Non Active</option>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <label class="control-label">Search</label>
            <div class="input-group">
                <span class="input-group-addon">
                      <i class="ti-search" aria-hidden="true"></i>
                    </span>
                <input type="text" name="Search" class="form-control" placeholder="" id="Search">
            </div>
            <span class="help-block"></span>
        </div>
    </div>
</form>