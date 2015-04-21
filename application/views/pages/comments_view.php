<link rel="stylesheet" href="<?php echo HTTP_PLUGIN_PATH; ?>fancybox/source/jquery.fancybox.css">
<script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>fancybox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pages/profile.css">
<link href="<?php echo HTTP_PLUGIN_PATH; ?>star-rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php echo HTTP_PLUGIN_PATH; ?>star-rating/js/star-rating.js" type="text/javascript"></script>
<script src="<?php echo HTTP_JS_PATH; ?>pages/comments.js"></script>
<style>
    .color-blue .rating-stars {
        color: #3498db;
    }
    .rating-xxs {
        font-size: 1em;
    }
    .rating-xxs span{
        font-size: 11px;
    }
</style>
<div class="container content">
	<div class="row margin-bottom-30">
        <!-- Bordered Funny Boxes -->
        <div class="col-md-12">
            <div class="funny-boxes funny-boxes-default">
                <div class="row">
                    <div class="col-md-8">
                        <h2><?php echo $applicationName;?></h2>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
    <div class="row margin-bottom-30">
        <div class="col-md-12 text-right">
            <?php if ($this->session->userdata('USER_TYPE') == '1' && $this->session->userdata('IS_FRONT_LOGIN')) {?>
                <a href="<?php echo base_url()?>application/download_user_feedback/<?php echo $commentUrl;?>" id="download_feedback" class="btn-u btn-u-default" >Download User Feedback</a>
             <?php }?>
             <a href="#" id="addComment" class="btn-u btn-u-blue">Add Feedback</a>
        </div>
    </div>
    <!-- End Bordered Funny Boxes -->
    <div class="profile">
        <div class="profile-body">
            <div class="panel panel-profile">
                <div class="panel-heading overflow-h">
                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-comments"></i>Feedback View</h2>
                </div>
                <div class="panel-body">
                    <?php
                    if ($comments != '-1') {
                    foreach ($comments as $key => $value) {
                    if ($value->user_image == null)
                        $img = base_url()."assets/img/user.jpg";
                    else $img = $value->user_image;
                    if ($value->user_id == 0)
                        $userName = "Unknown User";
                    else $userName = $value->ea_first_name." ".$value->ea_last_name;
                    $tempArray = explode('/', $value->screenshot);
                    ?>
                    <div class="media media-v2 margin-bottom-20">
                        <a class="pull-left" href="#">
                            <img class="media-object rounded-x" src="<?php echo $img;?>" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <strong><a href="#"><?php echo $userName;?></a></strong>
                                <small><?php echo date('Y-m-d', $value->timestamp);?></small>
                            </h4>
                            <div class="row">
                                <div class="col-md-10">
                                     <p><?php echo nl2br($value->feedback_text);?></p>
                                </div>
                                <div class="col-md-2">
                                    <input id="user-rated"  value="<?php echo $value->user_f_rate1;?>" type="number" data-container-class='rating-xxs' disabled="true">
                                    <div class="clearfix"></div>
                                    <input id="user-rated"  value="<?php echo $value->user_f_rate2;?>" type="number" data-container-class='rating-xxs' disabled="true">
                                    <div class="clearfix"></div>
                                    <input id="user-rated"  value="<?php echo $value->dev_f_rate1;?>" type="number" data-container-class='rating-xxs color-blue' disabled="true">
                                    <div class="clearfix"></div>
                                    <input id="user-rated"  value="<?php echo $value->dev_f_rate2;?>" type="number" data-container-class='rating-xxs color-blue' disabled="true">
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <?php if ($value->screenshot != null && ($tempArray[1] != "9j")) {?>
                            <ul class="list-inline img-uploaded">
                                <li><a class="screenshot-fancy" data-rel="fancybox-button" title="screenshot" href="data:image/jpeg;base64,<?php echo $value->screenshot; ?>">
                                        <img class="img-responsive" src="<?php echo $value->screenshot;?>" /></a></li>
                            </ul>
                            <?php } else if ( $value->screenshot != null ) {?>
                            <ul class="list-inline img-uploaded">
                                <li><a class="screenshot-fancy" data-rel="fancybox-button" title="screenshot" href="data:image/jpeg;base64,<?php echo $value->screenshot; ?>">
                                        <img src="data:image/jpeg;base64,<?php echo $value->screenshot; ?>" class="img-responsive" /></a></li>
                            </ul>
                            <?php } ?>
                            <ul class="list-inline results-list pull-left">
                                <li><a href="#" id="comment_like"><i class="fa fa-thumbs-up"></i></a><span id="like_cnt"><?php if ($value->unlike_cnt == '') echo '0'; else echo $value->like_cnt; ?></span></li>
                                <li><a href="#" id="comment_unlike"><i class="fa fa-thumbs-down"></i></a><span id="unlike_cnt"><?php if ($value->unlike_cnt == '') echo '0'; else echo $value->unlike_cnt; ?></span></li>
                            </ul>
                            <ul class="list-inline pull-right">
                                <li><button class="btn-u btn-u-default btn-u-sm margin-bottom-5" type="button" id="feedbackReply">Reply</button>
                                    <input type="hidden" id="feedback_id" value="<?php echo $value->id; ?>">
                                </li>
                                <?php if ($value->revised_feedback == null) {?>
                                <li><button class="btn-u btn-u-danger btn-u-sm" type="button" id="add_revised_feedback">Add revised feedback</button></li>
                                <?php } ?>
                                <li><button class="btn-u btn-u-sea btn-u-sm" type="button" id="leave_feedback_rate">Leave Rate</button></li>
                            </ul>
                            <?php if ($value->revised_feedback != '') {?>
                            <div class="clearfix"></div>
                            <div class="media media-v2 alert-blocks-error">
                                <a class="pull-left" href="#">
                                    <?php if ($value->revised_img != '') {?>
                                        <img class="media-object rounded-x" src="<?php echo $value->revised_img ?>" alt="">
                                    <?php }?>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <strong><?php echo $value->revised_name;?></strong>
                                        <small><?php echo date('Y-m-d', strtotime($value->revised_time)); ?></small>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p><?php echo nl2br($value->revised_feedback);?></p>
                                        </div>
                                        <div class="col-md-2">
                                            <input id="user-rated"  value="<?php echo $value->user_r_rate1;?>" type="number" data-container-class='rating-xxs' disabled="true">
                                            <div class="clearfix"></div>
                                            <input id="user-rated"  value="<?php echo $value->user_r_rate2;?>" type="number" data-container-class='rating-xxs' disabled="true">
                                            <div class="clearfix"></div>
                                            <input id="user-rated"  value="<?php echo $value->dev_r_rate1;?>" type="number" data-container-class='rating-xxs color-blue' disabled="true">
                                            <div class="clearfix"></div>
                                            <input id="user-rated"  value="<?php echo $value->dev_r_rate2;?>" type="number" data-container-class='rating-xxs color-blue' disabled="true">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <ul class="list-inline pull-right">
                                        <li><button class="btn-u btn-u-sea btn-u-sm" type="button" id="leave_revised_rate">Leave Rate</button>
                                            <input type="hidden" id="revised_id" value="<?php echo $value->revised_id; ?>">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php }?>
                            <?php if ($repliesData[$key] != null) {
                            foreach ($repliesData[$key] as $key1 => $value1) {
                            ?>
                            <div class="clearfix"></div>
                            <div class="media media-v2">
                                <a class="pull-left" href="#">
                                    <?php if ($value1->reply_img != '') {?>
                                        <img class="media-object rounded-x" src="<?php echo $value1->reply_img ?>" />
                                    <?php }?>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <strong><?php echo $value1->reply_name;?></strong>
                                        <small><?php echo date('Y-m-d', strtotime($value1->ea_created_time));?></small>
                                    </h4>
                                    <p><?php echo nl2br($value1->reply_text);?></p>
                                    <ul class="list-inline pull-right">
                                        <li><button class="btn-u btn-u-default btn-u-sm margin-bottom-5" type="button" id="multi_reply">Reply</button>
                                            <input type="hidden" id="reply_id" value="<?php echo $value1->reply_id; ?>" />
                                        </li>
                                    </ul>
                                    <?php echo DisplaySubReplies ($value1->reply_id);
                                    ?>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div><!--/end media media v2-->
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
    <!--End Colored Funny Boxes -->
    <!-- add comment modal -->
     <div class="modal fade" id="addCommentsModal">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				<h4 class="modal-title">Add Feedback</h4>
    			</div>
    			<div class="modal-body">
    			    <div class="form-horizontal">
    			        <form id="commentForm" method="post">
    			            <input type="hidden" name="screenShot"/>
    			            <input type="hidden" name="applicationName" value="<?php echo $applicationName;?>" />
            				<div class="form-group">
            				    <div class="col-md-12">
            				        <textarea placeholder="Description" name="description" rows="7" class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
                        <div class="form-group form-group-sm margin-bottom-0">
    		        		<div class="col-sm-6">
    		          			<form id="imageUploadForm" class="attached-form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>application/uploadScreenShot/" style="margin: 0">
                                    <input type="file" class="form-control" name="screenShotUpload" id="fileUpload" style="height: auto;">                        
    							</form>
    		        		</div>
    		        		<div class="col-sm-3" id="img_wrap">
    		        		</div>
    		      		</div>      
		      		</div>           
    			</div>
    			<div class="modal-footer">
    				<a href="#" class="btn-u btn-u-blue" id="commentSubmit">Add</a>
    			</div>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /add comment modal -->
    <!-- add reply modal -->
     <div class="modal fade" id="addReplyModal">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				<h4 class="modal-title">Reply Form</h4>
    			</div>
    			<div class="modal-body">
    			    <div class="form-horizontal">
    			        <form id="replyForm" method="post">
    			            <input type="hidden" name="feedbackId" value="" />
            				<div class="form-group">
            				    <div class="col-md-12">
            				        <textarea placeholder="Description" name="replyDescription" rows="7" class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
		      		</div>           
    			</div>
    			<div class="modal-footer">
    				<a href="#" class="btn-u btn-u-blue" id="replySubmit">Submit</a>
    			</div>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- multi reply modal -->
    <div class="modal fade" id="multi_reply_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Reply Form</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <form id="multi_reply_form" method="post">
                            <input type="hidden" name="replyId" value="" />
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea placeholder="Description" name="replyDescription" rows="7" class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn-u btn-u-blue" id="multi_reply_submit">Submit</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add revised feedback form modal-->
    <div class="modal fade" id="revised_feedback_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Revised Feedback Form</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <form id="revised_feedback_form" method="post">
                            <input type="hidden" name="feedbackId" value="" />
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea placeholder="Description" name="revisedDescription" rows="7" class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn-u btn-u-blue" id="add_revised_submit">Submit</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- rate modal-->
    <div class="modal fade" id="star_rating_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Revised Feedback Form</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="referenceId" value="" />
                    <?php if ($this->session->userdata('USER_TYPE') == '0') { ?>
                    <h5>Urgency</h5>
                    <input id="rating-input1" type="number"/>
                    <div class="clearfix"></div>
                    <hr>
                    <h5>Importance</h5>
                    <input id="rating-input2" type="number" />
                    <div class="clearfix"></div>
                    <hr>
                    <?php } else {?>
                    <h5>Feasibility</h5>
                    <input id="rating-input1" type="number" data-container-class='color-blue'/>
                    <div class="clearfix"></div>
                    <hr>
                    <h5>Informativity</h5>
                    <input id="rating-input2" type="number" data-container-class='color-blue'/>
                    <div class="clearfix"></div>
                    <hr>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn-u btn-u-blue" id="add_rating_star">Submit</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("a#add_rating_star").click(function () {
            var star1 = $('div#star_rating_modal').find('input#rating-input1').val();
            var star2 = $('div#star_rating_modal').find('input#rating-input2').val();
            var referenceId=  $('div#star_rating_modal').find("input[name='referenceId']").val();
            var type = $('div#star_rating_modal').find("input[name='referenceId']").attr('reference-type');
            $.ajax({
                url: Base_Url + '/application/add_user_rate',
                dataType: 'json',
                type: 'POST',
                cache: false,
                data: {star1: star1, star2: star2, referenceId: referenceId, type: type},
                success: function (data) {
                    if (data.result == "success") {
                        alert("Submit Successfully!");
                        window.location.reload();
                        return;
                    } else if (data.result == 'exist') {
                        alert("someone had already replied.");
                        return;
                    } else if (data.result == 'login_failed') {
                        alert("Please Login First.");
                        window.location.href = Base_Url + '/user/login';
                    }
                }
            });
        });
    });
</script>