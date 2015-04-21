<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>datatables/dataTables.bootstrap.css">
<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>style.css">
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery.dataTables.js"></script>    
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>dataTables.bootstrap.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>table-managed-tables.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery.validate.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>pages/question.js"></script>
<div id="main-content" style="margin-left: 225px;">
    <div id="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">Question Management&nbsp;</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li><i class="fa fa-home"></i>&nbsp;
                        <a href="/admin">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li>
                        <a href="/admin/home">Question Management</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li class="active">Edit Question</li>
                </ol>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="portlet portlet-tertiary">
                <div class="portlet-header" style="padding: 7px 10px;">
                    <div class="caption" style="margin: 0;line-height: 26px;">
                        Edit Question
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form" class="form-horizontal" id="editQuestionForm" method="post">
                        <div class="form-body">
                            <input type="hidden" name="questionId" value="<?php echo $questionList->question_id; ?>" >
                            <div class="form-group">
                                <label class="col-md-3 control-label">Question</label>
                                <div class="col-md-6">
                                    <textarea rows="7" name="question" placeholder="Enter Question" class="form-control"><?php echo $questionList->ta_question; ?></textarea>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-md-3 control-label">Order</label>
                                <div class="col-md-4">
                                    <input type="number" name="questionOrder" value="<?php echo $questionList->ta_question_order; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Right Answer</label>
                                <div class="col-md-6">
                                    <select name="rightAnswer" class="form-control">
                                        <option value="Y" <?php if ($questionList->ta_right_answer == "Y") echo 'selected' ?>>Yes</option>
                                        <option value="N" <?php if ($questionList->ta_right_answer == "N") echo 'selected' ?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tool Tip</label>
                                <div class="col-md-6">
                                    <textarea  rows="7" name="tooltip" placeholder="Enter Tooltip" class="form-control"><?php echo $questionList->ta_tooltip; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="#" id="saveQuestion" class="btn btn-primary">Save</a>
                                &nbsp;
                                <a href="<?php echo base_url();?>admin/question_manage" class="btn btn-danger">List</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">tableManaged.init();</script>