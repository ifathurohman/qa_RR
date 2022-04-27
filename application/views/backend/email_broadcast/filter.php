<form id="form-filter" autocomplete="off" method="post">
    <div class="row">
        <div class="form-group col-sm-3">
            <label class="control-label">Tanggal Dari</label>
            <div class="input-group">
                <span class="input-group-addon">
                      <i class="ti-calendar" aria-hidden="true"></i>
                    </span>
                <input type="text" name="fStartDate" class="form-control date" value="<?= date("01-m-Y"); ?>">
            </div>
        </div>
        <div class="form-group col-sm-3">
            <label class="control-label">Tanggal Sampai</label>
            <div class="input-group">
                <span class="input-group-addon">
                      <i class="ti-calendar" aria-hidden="true"></i>
                    </span>
                <input type="text" name="fEndDate" class="form-control date" value="<?= date("d-m-Y"); ?>">
            </div>
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