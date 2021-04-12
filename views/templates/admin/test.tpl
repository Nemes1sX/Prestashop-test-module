<form action="{$link->getAdminLink('AdminUzduotisAdmin')|escape:'htmlall':'utf-8'}" method="post" class="form-horizontal">
    <div class="panel edit_page_section">
        <div class="form-wrapper">
            <div class="form-group">
                <label class="control-label col-lg-3">First Name</label>
                <div class="col-lg-6">
                    <input type="text" name="first_name" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">Last Name</label>
                <div class="col-lg-6">
                    <input type="text" name="last_name" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">Email</label>
                <div class="col-lg-6">
                    <input type="text" name="email" value="">
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a href="{'#'|escape:'htmlall':'utf-8'}" class="btn btn-default" id="cms_form_cancel_btn" onclick="window.history.back();">
                <i class="process-icon-cancel"></i> Cancel
            </a>
            <button type="submit" value="1" id="cms_form_submit_btn" name="saveData" class="btn btn-default pull-right">
                <i class="process-icon-save"></i> Save
            </button>
        </div>
    </div>
</form>