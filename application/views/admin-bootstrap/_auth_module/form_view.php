<div class="section">

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

    <?php echo form_open_multipart($form_action, 'class="form form-horizontal"');  ?>

    <?php echo form_hidden('MODULE_ID', object_element('MODULE_ID', $row)); ?>
    <?php echo form_hidden('redirect', $redirect); ?>

    <div class="row">
        <div class="span12">
                        
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_code">Module Code</label>
                    <div class="controls">
                        <?php echo form_input('module_code',  set_value('module_code', object_element('module_code', $row)), 'class="validate[maxSize[50],required] input-xlarge" id="module_code" tabindex="2" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_name">Module Name</label>
                    <div class="controls">
                        <?php echo form_input('module_name',  set_value('module_name', object_element('module_name', $row)), 'class="validate[maxSize[255],required] input-xlarge" id="module_name" tabindex="3" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_single_label">Module Single Label</label>
                    <div class="controls">
                        <?php echo form_input('module_single_label',  set_value('module_single_label', object_element('module_single_label', $row)), 'class="validate[maxSize[255],required] input-xlarge" id="module_single_label" tabindex="4" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_plural_label">Module Plural Label</label>
                    <div class="controls">
                        <?php echo form_input('module_plural_label',  set_value('module_plural_label', object_element('module_plural_label', $row)), 'class="validate[maxSize[255]] input-xlarge" id="module_plural_label" tabindex="5" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="parent_id">Parent Id</label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('parent_id', $dropdown_parent_id, set_value('parent_id', object_element('parent_id', $row)), 
                                'class="validate[integer] input-xlarge" id="parent_id" tabindex="6"' );
                    ?>
                </div>
            </div>             
                <div class="control-group">
                    <label class="control-label form-lbl" for="module_url">Module Url</label>
                    <div class="controls">
                        <?php echo form_input('module_url',  set_value('module_url', object_element('module_url', $row)), 'class="validate[maxSize[255]] input-xlarge" id="module_url" tabindex="7" '); ?>
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
                        echo form_dropdown('active', $dropdown_active, set_value('active', object_element('active', $row)), 
                                'class="validate[,required] input-xlarge" id="active" tabindex="8"' );
                    ?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label form-lbl" for="show_in_menu">Show In Menu</label>
                <div class="controls">
                    <?php
                        $dropdown_show_in_menu = array(
            'yes' => 'Yes',
            'no' => 'No'
        );
                        echo form_dropdown('show_in_menu', $dropdown_show_in_menu, set_value('show_in_menu', object_element('show_in_menu', $row)), 
                                'class="validate[,required] input-xlarge" id="show_in_menu" tabindex="9"' );
                    ?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label form-lbl" for="show_in_form">Show In Form</label>
                <div class="controls">
                    <?php
                        $dropdown_show_in_form = array(
            'yes' => 'Yes',
            'no' => 'No'
        );
                        echo form_dropdown('show_in_form', $dropdown_show_in_form, set_value('show_in_form', object_element('show_in_form', $row)), 
                                'class="validate[,required] input-xlarge" id="show_in_form" tabindex="10"' );
                    ?>
                </div>
            </div>             
                <div class="control-group">
                    <label class="control-label form-lbl" for="sequence_number">Sequence Number</label>
                    <div class="controls">
                        <?php echo form_input('sequence_number',  set_value('sequence_number', object_element('sequence_number', $row)), 'class="validate[integer] input-xlarge" id="sequence_number" tabindex="11" '); ?>
                    </div>
                </div>                
        
            <div class="form-actions">
                <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
                <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
                   data-window="<?php echo $window ?>"
                   data-modal-name="auth_moduleModal">
                    <?php _e('Vazgeç'); ?>
                </a>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->

</div>