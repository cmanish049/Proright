<?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>

<?php echo form_hidden('country_id', object_element('country_id', $row)); ?>
<?php echo form_hidden('redirect', $redirect); ?>


<div class="control-group">
    <label class="control-label form-lbl" for="location_name"><?php _e('Location Name') ?></label>
    <div class="controls">
        <?php
        echo form_input('location_name', set_value('location_name', object_element('location_name', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="location_name" tabindex="2" ');
        ?>
    </div>
</div>                

<div class="form-actions">
    <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
    <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
       data-window="<?php echo $window ?>"
       data-modal-name="locationModal">
           <?php _e('Cancel'); ?>
    </a>
</div>

<?php echo form_close(); ?>
<!--############################ Form  Bitişi ############################ -->