<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  

    <div class="control-group">
        <label class="control-label form-lbl" for="note_type_id"><?php _e('Note Type') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('note_type_id', $dropdown_note_type_id, set_value('note_type_id', object_element('note_type_id', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="matter_note_note_type_id" tabindex="2"');

            autocomplete_new_button(array(
                'url' => admin_url('matter_note_type/edit'),
                'target_selector' => '#matter_note_note_type_id',
                'modal_name' => 'matter_note_typeModal'
            ));
            ?>
        </div>
    </div>             
    <div class="control-group">
        <label class="control-label form-lbl" for="note_date"><?php _e('Note Date') ?></label>
        <div class="controls">
            <?php
            echo form_input('note_date', set_value('note_date', object_element('note_date', $row)), 
                    'class="validate[required,funcCall[validateDateTime]] input-xlarge  input-datetime show-current-date show-current-time" id="matter_note_note_date" tabindex="3" ');
            ?>
        </div>
    </div>                

    <div class="control-group">
        <label class="control-label form-lbl" for="description"><?php _e('Note') ?></label> 
        <div class="controls">
            <?php
            echo form_textarea(array('name' => 'description', 'rows' => 5, 'cols' => 40), 
                    set_value('description', (object_element('description', $row))), 
                    'class="validate[required] input-xlarge js-editor " id="matter_note_description" tabindex="4"');
            ?>
        </div>                
    </div>  
<!--    
    <div class="control-group">
        <label class="control-label form-lbl" for="phone"><?php _e('Phone') ?></label>
        <div class="controls">
            <?php
            echo form_input('phone', set_value('phone', object_element('phone', $row)), 'class="validate[maxSize[30]] input-xlarge " id="matter_note_phone" tabindex="5" ');
            ?>
        </div>
    </div>                

    <div class="control-group">
        <label class="control-label form-lbl" for="minute"><?php _e('Minute') ?></label>
        <div class="controls">
            <?php
            echo form_input('minute', set_value('minute', object_element('minute', $row)), 'class="validate[custom[integer]] input-xlarge  input-integer" id="matter_note_minute" tabindex="6" ');
            ?>
        </div>
    </div>                -->

    <div class="control-group">
        <label class="control-label form-lbl" for="matter_id"><?php _e('Matter') ?></label>
        <div class="controls">
            <?php
            echo form_input('matter_id', 
                    set_value('matter_id', object_element('matter_id', $row)), 
                    'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-remote-data-select show-current-date" id="matter_note_matter_id" tabindex="7" 
                        data-url="'.  admin_url('ajax_search/matters').'" 
                        data-text="'.object_element('matter_name', $row).'"');
            ?>
        </div>
    </div> 

    <div class="control-group">
        <label class="control-label form-lbl" for="client_id"><?php _e('Client') ?></label>
        <div class="controls">
            <?php
            echo form_input('client_id', 
                    set_value('client_id', object_element('client_id', $row)), 
                    'class="validate[] input-xlarge  nice-remote-data-select" id="matter_note_client_id" tabindex="8" 
                        data-url="'.  admin_url('ajax_search/users?is_admin=0').'" 
                        data-text="'.object_element('client_name', $row).'"');
            ?>
        </div>
    </div> 

<!--    <div class="control-group">
        <label class="control-label form-lbl" for="operator_id"><?php _e('Operator') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('operator_id', $dropdown_operator_id, set_value('operator_id', object_element('operator_id', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="matter_note_operator_id" tabindex="9"');
            ?>
        </div>
    </div> -->

    <div class="control-group">
        <label class="control-label form-lbl" for="is_private"><?php _e('Is Private') ?></label>
        <div class="controls">
            <?php
            $dropdown_is_private = yes_no_dropdown_items();
            echo form_dropdown('is_private', $dropdown_is_private, 
                    set_value('is_private', object_element('is_private', $row,0)), 
                    'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="matter_note_is_private" tabindex="10"');
            ?>
        </div>
    </div> 

    <div class="form-actions">
        <?php $this->template->view('templates/form_footer_buttons_view',array('modal_name'=>'matter_noteModal')); ?>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>