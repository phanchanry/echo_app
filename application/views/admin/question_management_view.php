<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>datatables/dataTables.bootstrap.css">
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery.dataTables.js"></script>    
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>dataTables.bootstrap.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>table-managed-tables.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.validate.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>pages/question.js"></script>
<style>
pre{
    margin: 0px;
    padding: 0px;
    border-width: 0px;
    background-color: transparent;
}
</style>
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
                        <a href="<?php echo base_url()?>admin/question_manage/add_question" class="btn btn-info">Add Question</a>
                        <a href="#" class="btn btn-danger" id="deleteQuestion">Delete Question</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table id="example1" cellpadding="0" cellspacing="0" border="0"
                               class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th width="3%">Order</th>
                                <th width="40%">Question</th>
                                <th width="4%">Right Answer</th>
                                <th width="40%">Tooltip</th>
                                <th width="9%">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($questionList != null) {
                                foreach ($questionList as $k => $v) {
                            ?>
                                <tr class="odd gradeA">
                                    <td><input type="checkbox" value="<?php echo $v->question_id;?>" id="questionId" /></td>
                                    <td><?php echo  $v->ta_question_order;?></td>
                                    <td><pre><?php echo $v->ta_question?></pre></td>
                                    <td><?php echo $v->ta_right_answer;?></td>
                                    <td><pre><?php echo $v->ta_tooltip;?></pre></td>
                                    <td><a href="#" class="btn btn-tertiary btn-xs" id="editQuestion" style="margin-right: 5px;"><i class="fa fa-edit"></i>Edit</a>
                                </tr>
                           <?php
                               } 
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