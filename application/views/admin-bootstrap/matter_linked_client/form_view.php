<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  

    <div class="control-group">
        <label class="control-label form-lbl" for="link_type_id"><?php _e('Link Type') ?></label>
        <div class="controls">
            <?php
            echo form_dropdown('linked_type_id', $dropdown_link_type_id, 
                    set_value('linked_type_id', object_element('linked_type_id', $row)), 
                    'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" 
                        id="matter_linked_client_linked_type_id" tabindex="2"');
            autocomplete_new_button(array(
                'url' => admin_url('matter_linked_client_type/edit'),
                'target_selector' => '#matter_linked_client_linked_type_id',
                'modal_name' => 'matter_linked_client_typeModal'
            ));
            ?>
        </div>
    </div> 
    <div class="control-group">
        <label class="control-label form-lbl" for="matter_id"><?php _e('Matter') ?></label>
        <div class="controls">
            <?php            
            echo form_input('matter_id', set_value('matter_name', object_element('matter_id', $row)), 
                    'class="validate[funcCall[validateDropdownRequired]] input-xlarge nice-remote-data-select"
                                    id="matter_linked_client_matter_id" tabindex="3" 
                                    data-url="' . admin_url('ajax_search/matters') . '" 
                                        data-text="'.object_element('matter_name', $row).'"');
            ?>
        </div>
    </div> 
    <div class="control-group">
        <label class="control-label form-lbl" for="client_id"><?php _e('Client') ?></label>
        <div class="controls">
            <?php
            echo form_input('client_id', set_value('client_id', object_element('client_id', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-remote-data-select" 
                                    id="matter_linked_client_client_id" tabindex="4"
                                    data-url="' . admin_url('ajax_search/users?is_admin=0') . '"
                                    data-text="'.object_element('client_name', $row).'"');
            ?>
        </div>
    </div> 
    <div class="control-group">
        <label class="control-label form-lbl" for="description"><?php _e('Description') ?></label> 
        <div class="controls">
            <?php
            echo form_textarea(array('name' => 'description', 'rows' => 5, 'cols' => 40), set_value('description', (object_element('description', $row))), 'class="validate[] input-xlarge js-editor " id="matter_linked_client_description" tabindex="5"');
            ?>
        </div>                
    </div>


    <div class="form-actions">
        <?php $this->template->view('templates/form_footer_buttons_view',array('modal_name'=>'matter_linked_clientModal')); ?>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>