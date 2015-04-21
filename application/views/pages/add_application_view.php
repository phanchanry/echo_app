<script src="<?php echo HTTP_JS_PATH; ?>pages/application.js"></script>
<div class="container content">
    <div class="breadcrumbs margin-bottom-30">
        <div class="container">
            <h1 class="pull-left">Add Application</h1>
        </div>
    </div>   
    <div class="tag-box tag-box-v3 margin-bottom-40" >  
        <form class="margin-bottom-40" role="form" id="addApplicationForm" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Application Name <span class="color-red">*</span></label>
                <input type="text" class="form-control" name="applicationName" placeholder="Application Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Application Version <span class="color-red">*</span></label>
                <input type="text" class="form-control" name="applicationVersion" placeholder="Application Version">
            </div>
            <a href="#" class="btn-u btn-u-blue" id="addApplication">Submit</a>
        </form>
     </div>   
</div>
