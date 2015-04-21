<script src="<?php echo HTTP_JS_PATH; ?>pages/index.js"></script>
<div class="container content">
     <div class="table-responsive">
         <table id="example1" cellpadding="0" cellspacing="0" border="0" class="table table-hover">
            <thead>
            <tr>
                <th>Application Name</th>
                <th>Feedback Counts</th>
                <th style="width: 15%;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($applications as $key => $v) {
            ?>
                <tr class="odd gradeA">
                    <td><?php echo $v->application_name; ?></td>
                    <td><?php if ($v->comments_cnt == '') echo "0"; else echo $v->comments_cnt; ?></td>
                    <td class="text-right">
                        <a href="<?php echo base_url();?>application/view_comments/<?php echo base64_encode($v->id);?>" class="btn-u btn-u-sea btn-u-sm" id="gathererEdit">
                        <i class="fa fa-edit"></i>View Feedback</a>
                     </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
