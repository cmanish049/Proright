<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>                        


    <div class="control-group">
        <label class="control-label form-lbl" for="note_type_name"><?php _e('Note Type Name') ?></label>
        <div class="controls">
            <?php
            echo form_input('note_type_name', set_value('note_type_name', object_element('note_type_name', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="note_type_name" tabindex="2" ');
            ?>
        </div>
    </div>                

    <?php $this->template->view('templates/form_input_is_active'); ?>

    <div class="form-actions">
        <?php $this->template->view('templates/form_footer_buttons_view',array('modal_name'=>'matter_note_typeModal')); ?>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->      
</div>