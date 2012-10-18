<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>                        


    <div class="control-group">
        <label class="control-label form-lbl" for="linked_type_name"><?php _e('Linked Type Name') ?></label>
        <div class="controls">
            <?php
            echo form_input('linked_type_name', set_value('linked_type_name', object_element('linked_type_name', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="linked_type_name" tabindex="2" ');
            ?>
        </div>
    </div>                

    <?php $this->template->view('templates/form_input_is_active'); ?>

    <div class="form-actions">
        <?php $this->template->view('templates/form_footer_buttons_view',array('modal_name'=>'matter_linked_client_typeModal')); ?>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->

</div>