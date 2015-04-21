<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/27/2015
 * Time: 10:54 AM
 */
function GetSubReplies ($replyId) {
    $CI =& get_instance();
    $CI->load->model('application_model');
    $result = $CI->application_model->GetSubReplies($replyId);
    return $result;
}

function DisplaySubReplies ($replyId) {
?>
<?php $subRepliesData = GetSubReplies($replyId);
    if ($subRepliesData !== null) {
        foreach ($subRepliesData as $key3 => $value3) {
            ?>
            <div class="clearfix"></div>
            <div class="media media-v2">
                <a class="pull-left" href="#">
                    <?php if ($value3->reply_img != '') {?>
                        <img class="media-object rounded-x" src="<?php echo $value3->reply_img ?>" />
                    <?php }?>
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        <strong><?php echo $value3->reply_name;?></strong>
                        <small><?php echo date('Y-m-d', strtotime($value3->ea_created_time));?></small>
                    </h4>
                    <p><?php echo nl2br($value3->reply_text);?></p>
                    <ul class="list-inline pull-right">
                        <li><button class="btn-u btn-u-default btn-u-sm margin-bottom-5" type="button" id="multi_reply">Reply</button>
                            <input type="hidden" id="reply_id" value="<?php echo $value3->reply_id; ?>" />
                        </li>
                    </ul>
                    <?php echo DisplaySubReplies($value3->reply_id); ?>
                </div>
            </div>
<?php } }
}
?>