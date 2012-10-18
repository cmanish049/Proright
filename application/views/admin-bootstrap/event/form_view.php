<?php 
$form_class = 'ajax-form';
if($this->input->get('ref')=='calendar')
{
    $form_class = '';
}

?>

<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal '.$form_class.'"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  
    
    <div class="row-fluid">        
        
            <div class="control-group">
                <label class="control-label form-lbl" for="event_category_id"><?php _e('Category') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('category_id', $dropdown_category_id, 
                                set_value('category_id', object_element('category_id', $row)), 
                                'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="event_category_id" tabindex="2"' );
                        autocomplete_new_button(array(
                            'url' => admin_url('event_category/edit'),
                            'target_selector' => '#event_category_id',
                            'modal_name' => 'event_categoryModal'
                        ));
                    ?>
                </div>
            </div>     
        
        <div class="control-group">
            <label class="control-label form-lbl" for="event_subject_id"><?php _e('Subject') ?></label>
            <div class="controls">
                <?php

                    echo form_dropdown('subject_id', $dropdown_subject_id, 
                            set_value('subject_id', object_element('subject_id', $row)), 
                            'class="validate[funcCall[validateDropdownRequired]] span11 nice-select" id="event_subject_id" tabindex="6"' );
                    autocomplete_new_button(array(
                        'url' => admin_url('event_subject/edit'),
                        'target_selector' => '#event_subject_id',
                        'modal_name' => 'event_subjectModal'
                    ));
                ?>
            </div>
        </div>
        
        <div class="clearfix">
                
                <div class="row-fluid">
                    <div class="span5">
                        
                        <div class="controls">
                            <label class="form-lbl" for="event_is_all_day"><?php _e('Is All Day') ?></label>
                            <?php
                                $dropdown_is_all_day = yes_no_dropdown_items();
                                echo form_dropdown('is_all_day', $dropdown_is_all_day, 
                                        set_value('is_all_day', object_element('is_all_day', $row,0)), 
                                        'class="validate[funcCall[validateDropdownRequired]] input-medium  nice-select" id="event_is_all_day" tabindex="3"' );
                            ?>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="control-group">
                            <label class=" form-lbl" for="event_begin_date"><?php _e('Begin Date') ?></label>
                            <div class="">
                                <?php echo form_input('begin_date',  
                                set_value('begin_date', object_element('begin_date', $row)), 
                                'class="validate[required,funcCall[validateDate] input-date show-current-time" style="width:100px" id="event_begin_date" tabindex="4" '); ?>
                            
                                <?php echo form_input('begin_time',  
                                set_value('begin_time', object_element('begin_time', $row)), 
                                'class="validate[funcCall[validateTime]] input-time show-current-time" style="width:65px" id="event_begin_time" tabindex="4" '); ?>
                            </div>
                        </div>   
                    </div>
                    <div class="span4">
                        <div class="control-group">
                            <label class=" form-lbl" for="event_end_date"><?php _e('End Date') ?></label>
                            <div class="">
                                <?php echo form_input('end_date',  
                                set_value('end_date', object_element('end_date', $row)), 
                                'class="validate[required,funcCall[validateDateTime]] input-xlarge input-date show-current-time" style="width:100px" id="event_end_date" tabindex="5" '); ?>
                            
                                <?php echo form_input('end_time',  
                                set_value('end_time', object_element('end_time', $row)), 
                                'class="validate[funcCall[validateTime]] input-time" style="width:65px" id="event_end_time" tabindex="4" '); ?>
                            </div>
                        </div>  
                    </div>
                </div>
                                                
            </div>
                       
               <div class="control-group">
                <label class="control-label form-lbl" for="event_event_location_id"><?php _e('Event Location') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('event_location_id', $dropdown_event_location_id, 
                                set_value('event_location_id', object_element('event_location_id', $row)), 
                                'class="validate[] span11 nice-select" id="event_event_location_id" tabindex="8"' );
                        autocomplete_new_button(array(
                            'url' => admin_url('location/edit'),
                            'target_selector' => '#event_event_location_id',
                            'modal_name' => 'locationModal'
                        ));
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="event_description"><?php _e('Description') ?></label> 
                <div class="controls">
                    <?php echo form_textarea(array('name' => 'description', 'rows' => 2, 'cols' => 40), 
                                    set_value('description', (object_element('description', $row))), 
                                    'class="validate[] span11 js-editor " id="event_description" tabindex="7"'); ?>
                </div>                
            </div>
        
                   
            <div class="clearfix">
                <div class="span5">
                    <div class="control-group">                        
                        <div class="controls">
                            <label class="form-lbl" for="event_priority_id"><?php _e('Priority') ?></label>
                            <?php
                                echo form_dropdown('priority_id', $dropdown_priority_id, 
                                        set_value('priority_id', object_element('priority_id', $row)), 
                                        'class="validate[] input-medium  nice-select" id="event_priority_id" tabindex="9"' );
                                autocomplete_new_button(array(
                                    'url' => admin_url('event_priority/edit'),
                                    'target_selector' => '#event_event_priority_id',
                                    'modal_name' => 'event_priorityModal'
                                ));
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="span3">
                    <div class="control-group">                        
                        <div class="">
                            <label class="form-lbl" for="event_event_status_id"><?php _e('Event Status') ?></label>
                            <?php
                                echo form_dropdown('event_status_id', $dropdown_event_status_id, 
                                        set_value('event_status_id', object_element('event_status_id', $row)), 
                                        'class="validate[] input-medium  nice-select" id="event_event_status_id" tabindex="10"' );
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="span4">
                    <div class="control-group">                        
                        <div class="">
                            <label class=" form-lbl" for="event_is_private"><?php _e('Private') ?></label>
                            <?php echo form_dropdown('is_private', yes_no_dropdown_items(),
                            set_value('is_private', object_element('is_private', $row,0)), 
                            'class="validate[custom[integer]] input-medium nice-select" id="event_is_private" tabindex="13" '); ?>
                        </div>
                    </div> 
                </div>
            </div>
        
            <fielset>
                <div class="control-group">
                <label class="control-label form-lbl" for="event_matter_id"><?php _e('Matter') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_input('matter_id', 
                                set_value('matter_id', object_element('matter_id', $row)), 
                                'class="validate[] input-xlarge  nice-remote-data-select" id="event_matter_id" tabindex="11"
                                data-url="'.  admin_url('ajax_search/matters').'"
                                data-text="'.  object_element('matter_name', $row).'"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="event_client_id"><?php _e('Client') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_input('client_id', 
                                set_value('client_id', object_element('client_id', $row)), 
                                'class="validate[] input-xlarge  nice-remote-data-select" id="event_client_id" tabindex="12"
                                data-url="'.  admin_url('ajax_search/users?is_admin=0').'"
                                data-text="'.  object_element('client_name', $row).'"' );
                    ?>
                </div>
            </div>
            </fielset>
                                                           
    </div>
    
    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'class' => 'btn btn-primary btn-large btn-form-submit',
            'data-modal-name' => 'eventModal',
            'data-window' => $window)); ?>
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="eventModal">
               <?php _e('Cancel'); ?>
        </a>
        
        <?php if(!empty($row->event_id)): ?>       
            <a href="<?php echo admin_url('event/delete/id/'.$row->event_id); ?>" class="btn btn-large btn-danger pull-right btn-delete-event"
               data-modal-name="eventModal">
                   <?php _e('Delete'); ?>
            </a>
        <?php endif; ?>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>