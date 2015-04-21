<script src="<?php echo HTTP_JS_PATH; ?>pages/profile.js"></script>
<div class="container content">
    <div class="breadcrumbs margin-bottom-30">
        <div class="container">
            <h1 class="pull-left">Edit Profile</h1>
        </div>
    </div>   
    <div class="tag-box tag-box-v3 margin-bottom-40" >  
        <div class="margin-bottom-40 form-horizontal">
            <form id="profile_form" method="post">
                <div class="form-group">
                    <label class="control-label col-md-2">First Name<span class="color-red">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo $userDetail[0]->ea_first_name; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Last <span class="color-red">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php echo $userDetail[0]->ea_last_name; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Email Address<span class="color-red">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $userDetail[0]->ea_email; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">New Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="conPassword" placeholder="Confirm Password">
                    </div>
                </div>
                <input type="hidden" name="profileImgPath" />
            </form>
            <div class="form-group profile_image">
                <label class="control-label col-md-2">Profile Image</label>
                <div class="col-md-6">
                    <form id="imageUploadForm" class="attached-form" method="post" enctype="multipart/form-data" style="margin: 0" novalidate="novalidate">
                        <input type="file" class="form-control" name="profileImage" id="fileUpload" style="height: auto;">
                    </form>
                </div>
                <div class="col-md-2" id="img_wrap">
                    <?php if ($userDetail[0]->user_image != "") {?>
                        <img src="<?php echo $userDetail[0]->user_image;?>" />
                    <?php } else  {?>
                    <img src="<?php echo base_url();?>assets/img/user-unknown.jpg" />
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <a href="#" class=" col-md-offset-4 btn-u btn-u-blue" id="save_user">Save</a>
            </div>
        </div>
     </div>   
</div>
