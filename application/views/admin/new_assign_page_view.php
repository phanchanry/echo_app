<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>admin/datatables/dataTables.bootstrap.css">
<script src="<?php echo HTTP_JS_PATH; ?>admin/jquery.dataTables.js"></script>    
<script src="<?php echo HTTP_JS_PATH; ?>admin/dataTables.bootstrap.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>admin/table-managed-tables.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>admin/pages/petition_sheet.js"></script>
<div id="main-content" style="margin-left: 225px;">
    <div id="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">Petition Sheet Management&nbsp;</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="/admin/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active"><a href="/admin/petition_sheet_manage">Petition Sheet Management</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Assign Page</li>
                </ol>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="portlet portlet-default">
                <div class="portlet-header" style="padding: 7px 10px;">
                    <div class="caption" style="margin: 0;line-height: 26px;">
                       Assign Page
                    </div>
                    <div class="tools">
                        <a href="#" class="btn btn-primary" id="assignPageSumbmit">Assign</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form role="form" class="form-inline" id="assignPageForm" method="post">
                        <div class="form-group mrm">
                            <input id="fromPage_0" name="fromPage_0" type="number" placeholder="Enter From page" class="form-control">
                        </div>
                        <label> To </label>
                        <div class="form-group mlm">
                            <input id="toPage_0" name="toPage_0" type="number" placeholder="Enter To page" class="form-control">
                        </div>
                        <div class="form-group mlm">
                        <select class="form-control" id="userId" name="userId">
                        <?php foreach ($userInfos as $key=>$value) {
                            $fullName = $value->pv_first_name.' &nbsp'.$value->pv_last_name.' &nbsp'.$value->pv_suffix;
                        ?>
                            <option value="<?php echo $value->user_id; ?>"><?php echo $fullName; ?></option>
                            <?php }?>
                        </select>
                        </div>
<!--                         <hr> -->
<!--                         <a href="#" id="btn btn-quaternary" class="btn btn-quaternary">More</a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">tableManaged.init();</script>