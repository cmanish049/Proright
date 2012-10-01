<?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>                       
<?php echo form_hidden('redirect', $redirect); ?>                        

<div class="control-group">
    <label class="control-label form-lbl" for="user_type_name"><?php _e('User Type Name') ?></label>
    <div class="controls">
        <?php
        echo form_input('user_type_name', set_value('user_type_name', object_element('user_type_name', $row)), 'class="validate[required,maxSize[100]] input-xlarge " id="user_type_name" tabindex="2" ');
        ?>
    </div>
</div>                

<div class="control-group">
    <label class="control-label form-lbl" for="active"><?php _e('Active') ?></label>
    <div class="controls">
        <?php
        echo form_input('active', set_value('active', object_element('active', $row)), 'class="validate[required,custom[integer]] input-xlarge  input-integer" id="active" tabindex="3" ');
        ?>
    </div>
</div>                

<div class="form-actions">
    <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
    <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
       data-window="<?php echo $window ?>"
       data-modal-name="user_typeModal">
           <?php _e('Cancel'); ?>
    </a>
</div>

<?php echo form_close(); ?>
<!--############################ Form  Bitişi ############################ -->