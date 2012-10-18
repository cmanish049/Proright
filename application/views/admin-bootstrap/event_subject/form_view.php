<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  
    
    <div class="row-fluid">
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="subject"><?php _e('Subject') ?></label>
                    <div class="controls">
                        <?php echo form_input('subject',  
                        set_value('subject', object_element('subject', $row)), 
                        'class="validate[required,maxSize[255]] input-xlarge " id="event_subject_subject" tabindex="2" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="is_active"><?php _e('Is Active') ?></label>
                <div class="controls">
                    <?php
                        $dropdown_is_active = yes_no_dropdown_items();
                        echo form_dropdown('is_active', $dropdown_is_active, 
                                set_value('is_active', object_element('is_active', $row)), 
                                'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="event_subject_is_active" tabindex="3"' );
                    ?>
                </div>
            </div>
        
    </div>
    
    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'class' => 'btn btn-primary btn-large btn-form-submit',
            'data-modal-name' => 'event_subjectModal',
            'data-window' => $window)); ?>
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="event_subjectModal">
               <?php _e('Cancel'); ?>
        </a>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>