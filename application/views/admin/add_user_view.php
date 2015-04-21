<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>admin/datatables/dataTables.bootstrap.css">
<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>admin/style.css">
<script src="<?php echo HTTP_JS_PATH; ?>admin/jquery.dataTables.js"></script>    
<script src="<?php echo HTTP_JS_PATH; ?>admin/dataTables.bootstrap.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>admin/table-managed-tables.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>admin/jquery.validate.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>admin/pages/addUser.js"></script>
<div id="main-content" style="margin-left: 225px;">
    <div id="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">User Management&nbsp;</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li><i class="fa fa-home"></i>&nbsp;
                        <a href="/admin">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                        <a href="/admin/home">User Management</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li class="active">Add User</li>
                </ol>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="portlet portlet-tertiary">
                <div class="portlet-header" style="padding: 7px 10px;">
                    <div class="caption" style="margin: 0;line-height: 26px;">
                        Add User
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form" class="form-horizontal" id="addUserForm" method="post">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">First Name</label>
                                <div class="col-md-4">
                                    <input type="text" id="userFirstName" name="userFirstName" placeholder="Enter First Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name</label>
                                <div class="col-md-4">
                                    <input type="text" id="userLastName" name="userLastName" placeholder="Enter Last Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Suffix</label>
                                <div class="col-md-4">
                                    <input type="text" id="userSuffix" name="userSuffix" placeholder="Enter Last Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email Address</label>
                                <div class="col-md-4">
                                    <input type="email" id="userEmail" name="userEmail" placeholder="Email Address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password</label>
                                <div class="col-md-4">
                                    <input type="password" id="userPassword" name="userPassword" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Set User Role</label>
                                <div class="col-md-4">
                                    <input type="checkbox" name="userType" id="userType"> <span>Administrator(Full Account Access)</span><br>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="#" id="addNewUser" class="btn btn-primary">Save</a>
                                &nbsp;
                                <a href="/admin/home" class="btn btn-danger">List</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">tableManaged.init();</script>