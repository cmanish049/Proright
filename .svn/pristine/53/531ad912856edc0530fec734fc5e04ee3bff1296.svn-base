<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  
    
    <div class="row-fluid">
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="priority_name"><?php _e('Priority Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('priority_name',  
                        set_value('priority_name', object_element('priority_name', $row)), 
                        'class="validate[required,maxSize[255]] input-xlarge " id="event_priority_priority_name" tabindex="2" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="priority_color"><?php _e('Priority Color') ?></label>
                    <div class="controls">
                        <?php echo form_input('priority_color',  
                        set_value('priority_color', object_element('priority_color', $row)), 
                        'class="validate[required,maxSize[20]] input-xlarge " id="event_priority_priority_color" tabindex="3" '); ?>
                    </div>
                </div>
        
                <div class="control-group">
                    <label class="control-label form-lbl" for="priority_rating"><?php _e('Priority Color') ?></label>
                    <div class="controls">
                        <?php echo form_input('priority_rating',  
                        set_value('priority_rating', object_element('priority_rating', $row,10)), 
                        'class="validate[required,max[10],min[1]] input-xlarge input-integer" min="1" max="10" id="event_priority_priority_rating" tabindex="4" '); ?>
                    </div>
                </div>
        
    </div>
    
    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'class' => 'btn btn-primary btn-large btn-form-submit',
            'data-modal-name' => 'event_priorityModal',
            'data-window' => $window)); ?>
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="event_priorityModal">
               <?php _e('Cancel'); ?>
        </a>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>