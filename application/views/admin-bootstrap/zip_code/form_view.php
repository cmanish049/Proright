<div class="clearfix form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>

    <?php echo form_hidden('country_id', object_element('country_id', $row)); ?>
    <?php echo form_hidden('redirect', $redirect); ?>

    <div class="control-group">
        <label class="control-label form-lbl" for="zip_code"><?php _e('Zip Code') ?></label>
        <div class="controls">
            <?php
            echo form_input('zip_code', 
                    set_value('zip_code', object_element('zip_code', $row)), 
                    'class="validate[required,maxSize[50]] input-xlarge " id="zip_code" tabindex="2"');
            ?>
        </div>
    </div>                

    <div class="control-group">
        <label class="control-label form-lbl" for="area_code"><?php _e('Area Code') ?></label>
        <div class="controls">
            <?php
            echo form_input('area_code', 
                    set_value('area_code', object_element('area_code', $row)), 
                    'class="validate[maxSize[50]] input-xlarge " id="area_code" tabindex="3" ');
            ?>
        </div>
    </div>                

    <div class="control-group">
        <label class="control-label form-lbl" for="country_id"><?php _e('Country') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('country_id', $dropdown_country_id, 
                    set_value('country_id', object_element('country_id', $row)), 
                    'class="validate[funcCall[validateDropdownRequired]] input-xlarge nice-select chained-select" id="country_id" tabindex="4" ' .
                    'data-url="' . admin_url('ajax_search/cities') . '" data-target="#zip_code_city_id"');
            ?>
        </div>
    </div> 
    <div class="control-group">
        <label class="control-label form-lbl" for="state_id"><?php _e('State') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('state_id', $dropdown_state_id, set_value('state_id', object_element('state_id', $row)), 
                    'class="validate[] input-xlarge nice-select" id="state_id" tabindex="5"');
            ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label form-lbl" for="city_id"><?php _e('City') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('city_id', $dropdown_city_id, set_value('city_id', object_element('city_id', $row)), 
                    'class="validate[] input-xlarge nice-select" id="zip_code_city_id" tabindex="6"');
            ?>
        </div>
    </div> 

    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="zip_codeModal">
               <?php _e('Cancel'); ?>
        </a>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>