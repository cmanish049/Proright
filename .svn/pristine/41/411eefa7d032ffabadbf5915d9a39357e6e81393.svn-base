<div class="control-group">
    <label class="control-label form-lbl" for="is_active"><?php _e('Is Active') ?></label>
    <div class="controls">
        <?php $dropdown_is_active = array('' =>'','1' => __('Yes'), '0' => __('No')) ?>

        <?php
        echo form_dropdown('is_active', $dropdown_is_active, 
                set_value('is_active', object_element('is_active', $row)), 
                'class="validate[funcCall[validateDropdownRequired]] input-xlarge nice-select" id="is_active" tabindex="3"');
        ?>
    </div>
</div>