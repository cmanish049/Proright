<div class="section corners">

    <div class="row">
        <div class="span12">
            <h2 class ="ico-mug"><?php echo $page_title; ?></h2>
            <?php
            echo flash_data_alert_admin();
            echo form_alert_admin();
            echo alert_admin($error, 'error');
            echo alert_admin($success, 'success');
            echo alert_admin($warning, 'warning');
            ?>
        </div>        
    </div>

    <?php echo form_open_multipart($form_action, 'class="form form-horizontal"'); ?>

    <?php echo form_hidden('group_id', object_element('group_id', $row)); ?>
    <?php echo form_hidden('redirect', $redirect); ?>

    <div class="row">
        <div class="span6">

            <div class="control-group">
                <label class="control-label form-lbl" for="group_name">Group Name</label>
                <div class="controls">
                    <?php echo form_input('group_name', set_value('group_name', object_element('group_name', $row)), 'class="validate[maxSize[255],required] input-xlarge" id="group_name" tabindex="2" '); ?>
                </div>
            </div>                

            <div class="control-group">
                <label class="control-label form-lbl" for="active">Active</label>
                <div class="controls">
                    <?php
                    $dropdown_active = array(
                        'yes' => 'Yes',
                        'no' => 'No'
                    );
                    echo form_dropdown('active', $dropdown_active, set_value('active', object_element('active', $row)), 'class="validate[,required] input-xlarge" id="active" tabindex="3"');
                    ?>
                </div>
            </div> 
            
            <div class="control-group">
                <label class="form-lbl control-label"><?php _e('Admins'); ?></label>
                <div class="controls">
					<p class="help-block">
						<?php _e('Select users for this group'); ?>
						<br/>&nbsp;
					</p>
                    <ul class="nav nav-tabs nav-stacked">
                        <?php
                        if(!empty($admins)): foreach($admins as $e):
                                $checked = (in_array($e->user_id, $users_id)) ? TRUE : FALSE;
                                echo '<li><label class="checkbox">' . form_checkbox(array('name' => 'user_id[]', 'class' => 'noborder'), $e->user_id, $checked) . "$e->full_name" . '</label></li>';
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
            
            <div class="form-actions">
                <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
                <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
                   data-window="<?php echo $window ?>"
                   data-modal-name="auth_user_groupModal">
                       <?php _e('Vazgeç'); ?>
                </a>
            </div>
        </div>
        
        <div class="span6">
            <label class="form-lbl"><?php _e('Grup Yetkileri'); ?></label>
			<div id="sidetreecontrol"> <a href="#" class="btn btn-mini">
			<i class="icon-minus"></i> <?php _e('Close All') ?></a> | 
			<a href="#" class="btn btn-mini">
			<i class="icon-plus"></i> <?php _e('Open All') ?></a> </div>
            <?php echo $module_tree; ?>
        </div>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->

</div>


<script type="text/javascript">
    $(function() {
        $(".tree-list").treeview({
            collapsed: false,
            animated: "fast",
            control:"#sidetreecontrol",
            //prerendered: true,
            persist: "location"
        });
    });
</script>