<div class="form-container">

    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>
    <?php echo form_hidden('redirect', $redirect); ?>


    <div class="control-group">
        <label class="control-label form-lbl" for="city_name"><?php _e('City Name') ?></label>
        <div class="controls">
            <?php
            echo form_input('city_name', set_value('city_name', object_element('city_name', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="city_name" tabindex="2" ');
            ?>
        </div>
    </div>                

    <div class="control-group">
        <label class="control-label form-lbl" for="country_id"><?php _e('Country') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('country_id', $dropdown_country_id, set_value('country_id', object_element('country_id', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-xlarge nice-select" id="country_id" tabindex="3"');
            ?>
        </div>
    </div> 
    <div class="control-group">
        <label class="control-label form-lbl" for="state_id"><?php _e('State') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('state_id', $dropdown_state_id, set_value('state_id', object_element('state_id', $row)), 'class="validate[custom[integer]] input-xlarge nice-select" id="state_id" tabindex="4"');
            ?>
        </div>
    </div> 
    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="cityModal">
               <?php _e('Cancel'); ?>
        </a>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->

</div>