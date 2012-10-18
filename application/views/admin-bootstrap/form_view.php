<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  
    
            <div class="control-group">
                <label class="control-label form-lbl" for="matter_type_id"><?php _e('Matter Type') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('matter_type_id', $dropdown_matter_type_id, 
                                set_value('matter_type_id', object_element('matter_type_id', $row)), 
                                'class="validate[funcCall[validateDropdownRequired]] input-xlarge " id="_matter_type_id" tabindex="2"' );
                    ?>
                </div>
            </div>             
                <div class="control-group">
                    <label class="control-label form-lbl" for="matter_name"><?php _e('Matter Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('matter_name',  
                        set_value('matter_name', object_element('matter_name', $row)), 
                        'class="validate[maxSize[255]] input-xlarge " id="_matter_name" tabindex="3" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="case_number"><?php _e('Case Number') ?></label>
                    <div class="controls">
                        <?php echo form_input('case_number',  
                        set_value('case_number', object_element('case_number', $row)), 
                        'class="validate[required,maxSize[50]] input-xlarge " id="_case_number" tabindex="4" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="court_case_number"><?php _e('Court Case Number') ?></label>
                    <div class="controls">
                        <?php echo form_input('court_case_number',  
                        set_value('court_case_number', object_element('court_case_number', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="_court_case_number" tabindex="5" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="attorney_id"><?php _e('Attorney') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('attorney_id', $dropdown_attorney_id, 
                                set_value('attorney_id', object_element('attorney_id', $row)), 
                                'class="validate[] input-xlarge " id="_attorney_id" tabindex="6"' );
                    ?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label form-lbl" for="court_id"><?php _e('Court') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('court_id', $dropdown_court_id, 
                                set_value('court_id', object_element('court_id', $row)), 
                                'class="validate[] input-xlarge " id="_court_id" tabindex="7"' );
                    ?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label form-lbl" for="description"><?php _e('Description') ?></label> 
                <div class="controls">
                    <?php echo form_textarea(array('name' => 'description', 'rows' => 5, 'cols' => 40), 
                                    set_value('description', (object_element('description', $row))), 
                                    'class="validate[] input-xlarge js-editor " id="_description" tabindex="8"'); ?>
                </div>                
            </div>            
                <div class="control-group">
                    <label class="control-label form-lbl" for="open_date"><?php _e('Open Date') ?></label>
                    <div class="controls">
                        <?php echo form_input('open_date',  
                        set_value('open_date', object_element('open_date', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="_open_date" tabindex="9" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="close_date"><?php _e('Close Date') ?></label>
                    <div class="controls">
                        <?php echo form_input('close_date',  
                        set_value('close_date', object_element('close_date', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="_close_date" tabindex="10" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="is_closed"><?php _e('Is Closed') ?></label>
                    <div class="controls">
                        <?php echo form_input('is_closed',  
                        set_value('is_closed', object_element('is_closed', $row)), 
                        'class="validate[custom[integer]] input-xlarge  input-integer" id="_is_closed" tabindex="11" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="inserter_id"><?php _e('Inserter') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('inserter_id', $dropdown_inserter_id, 
                                set_value('inserter_id', object_element('inserter_id', $row)), 
                                'class="validate[] input-xlarge " id="_inserter_id" tabindex="12"' );
                    ?>
                </div>
            </div>             
                <div class="control-group">
                    <label class="control-label form-lbl" for="insert_date"><?php _e('Insert Date') ?></label>
                    <div class="controls">
                        <?php echo form_input('insert_date',  
                        set_value('insert_date', object_element('insert_date', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="_insert_date" tabindex="13" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="updater_id"><?php _e('Updater') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('updater_id', $dropdown_updater_id, 
                                set_value('updater_id', object_element('updater_id', $row)), 
                                'class="validate[] input-xlarge " id="_updater_id" tabindex="14"' );
                    ?>
                </div>
            </div>             
                <div class="control-group">
                    <label class="control-label form-lbl" for="update_date"><?php _e('Update Date') ?></label>
                    <div class="controls">
                        <?php echo form_input('update_date',  
                        set_value('update_date', object_element('update_date', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="_update_date" tabindex="15" '); ?>
                    </div>
                </div>                
        
    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="Modal">
               <?php _e('Cancel'); ?>
        </a>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>