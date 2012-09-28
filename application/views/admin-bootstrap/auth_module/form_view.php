<div class="section">
    <div class="row">
        <div class="span12">
            <div class="box">
                <div class="box-header-container">
                    <h1 class="box-header">
                        <?php echo $page_title; ?>
                    </h1>
                </div>

                <div class="box-content">
                    <div class="section-top-padding">
                        <?php
                        echo flash_data_alert_admin();
                        echo form_alert_admin();
                        echo alert_admin($error, 'error');
                        echo alert_admin($success, 'success');
                        echo alert_admin($warning, 'warning');
                        ?>

                        <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>

                        <?php echo form_hidden('country_id', object_element('country_id', $row)); ?>
                        <?php echo form_hidden('redirect', $redirect); ?>

                                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_code"><?php _e('Module Code') ?></label>
                    <div class="controls">
                        <?php echo form_input('module_code',  
                        set_value('module_code', object_element('module_code', $row)), 
                        'class="validate[required,maxSize[50]] input-xlarge " id="module_code" tabindex="2" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_name"><?php _e('Module Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('module_name',  
                        set_value('module_name', object_element('module_name', $row)), 
                        'class="validate[required,maxSize[255]] input-xlarge " id="module_name" tabindex="3" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_single_label"><?php _e('Module Single Label') ?></label>
                    <div class="controls">
                        <?php echo form_input('module_single_label',  
                        set_value('module_single_label', object_element('module_single_label', $row)), 
                        'class="validate[required,maxSize[255]] input-xlarge " id="module_single_label" tabindex="4" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_plural_label"><?php _e('Module Plural Label') ?></label>
                    <div class="controls">
                        <?php echo form_input('module_plural_label',  
                        set_value('module_plural_label', object_element('module_plural_label', $row)), 
                        'class="validate[maxSize[255]] input-xlarge " id="module_plural_label" tabindex="5" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="parent_id"><?php _e('Parent Id') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('parent_id', $dropdown_parent_id, 
                                set_value('parent_id', object_element('parent_id', $row)), 
                                'class="validate[custom[integer]] input-xlarge" id="parent_id" tabindex="6"' );
                    ?>
                </div>
            </div>             
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_url"><?php _e('Module Url') ?></label>
                    <div class="controls">
                        <?php echo form_input('module_url',  
                        set_value('module_url', object_element('module_url', $row)), 
                        'class="validate[maxSize[255]] input-xlarge " id="module_url" tabindex="7" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="active"><?php _e('Active') ?></label>
                <div class="controls">
                    <?php
                        $dropdown_active = array(
            'yes' => __('Yes'),
            'no' => __('No')
        );
                        echo form_dropdown('active', $dropdown_active, 
                                set_value('active', object_element('active', $row)), 
                                'class="validate[required] input-xlarge " id="active" tabindex="8"' );
                    ?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label form-lbl" for="show_in_menu"><?php _e('Show In Menu') ?></label>
                <div class="controls">
                    <?php
                        $dropdown_show_in_menu = array(
            'yes' => __('Yes'),
            'no' => __('No')
        );
                        echo form_dropdown('show_in_menu', $dropdown_show_in_menu, 
                                set_value('show_in_menu', object_element('show_in_menu', $row)), 
                                'class="validate[required] input-xlarge " id="show_in_menu" tabindex="9"' );
                    ?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label form-lbl" for="show_in_form"><?php _e('Show In Form') ?></label>
                <div class="controls">
                    <?php
                        $dropdown_show_in_form = array(
            'yes' => __('Yes'),
            'no' => __('No')
        );
                        echo form_dropdown('show_in_form', $dropdown_show_in_form, 
                                set_value('show_in_form', object_element('show_in_form', $row)), 
                                'class="validate[required] input-xlarge " id="show_in_form" tabindex="10"' );
                    ?>
                </div>
            </div>             
                <div class="control-group">
                    <label class="control-label form-lbl" for="sequence_number"><?php _e('Sequence Number') ?></label>
                    <div class="controls">
                        <?php echo form_input('sequence_number',  
                        set_value('sequence_number', object_element('sequence_number', $row)), 
                        'class="validate[custom[integer]] input-xlarge  input-integer" id="sequence_number" tabindex="11" '); ?>
                    </div>
                </div>                
        
                        <div class="form-actions">
                            <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
                            <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
                               data-window="<?php echo $window ?>"
                               data-modal-name="auth_moduleModal">
                                   <?php _e('Cancel'); ?>
                            </a>
                        </div>

                        <?php echo form_close(); ?>
                        <!--############################ Form  Bitişi ############################ -->

                    </div>
                </div>

                <div class="box-footer">

                </div>
            </div>
        </div>
    </div>        
</div>