<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>datatables/dataTables.bootstrap.css">
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery.dataTables.js"></script>    
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>dataTables.bootstrap.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>table-managed-tables.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.validate.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>pages/admin.js"></script>
<div id="main-content" style="margin-left: 225px;">
    <div id="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">User Management&nbsp;</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hide"><a href="#">User Mangement</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li class="active">User Management</li>
                </ol>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="portlet portlet-default">
                <div class="portlet-header" style="padding: 7px 10px;">
                    <div class="caption" style="margin: 0;line-height: 26px;">
                        Users
                    </div>
                    <div class="tools">
                        <button type="button" class="btn btn-info" id="addUser">Add User</button>
                        <button type="button" class="btn btn-danger" id="deleteUser">Delete User</button>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table id="example1" cellpadding="0" cellspacing="0" border="0"
                               class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Added Date</th>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($userList as $k => $v) {
                            ?>
                            <tr class="odd gradeA">
                                <td><input type="checkbox" value="<?php echo $v->user_id;?>" id="userId" /></td>
                                <td><?php echo  $k + 1;?></td>
                                <td><?php echo $v->ta_first_name.'  '.$v->ta_last_name;?></td>
                                <td><?php echo $v->ta_email;?></td>
                                <td><?php echo $v->ta_created_time;?></td>
                                <td><button type="button" class="btn btn-tertiary btn-xs" id="editUser" style="margin-right: 5px;"><i class="fa fa-edit"></i> Edit</button></td>
                            </tr>
                           <?php
                           }
                           ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">tableManaged.init();</script>