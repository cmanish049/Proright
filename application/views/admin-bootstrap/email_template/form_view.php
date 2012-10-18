<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  

    <div class="row-fluid">
        <div class="span5">
            <div class="control-group">
                <label class="control-label form-lbl" for="email_template_name"><?php _e('Email Template Name') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('email_template_name', set_value('email_template_name', object_element('email_template_name', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="email_template_email_template_name" tabindex="2" ');
                    ?>
                </div>
            </div>                

            <div class="control-group">
                <label class="control-label form-lbl" for="email_template_subject"><?php _e('Email Template Subject') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('email_template_subject', set_value('email_template_subject', object_element('email_template_subject', $row)), 'class="validate[maxSize[255]] input-xlarge " id="email_template_email_template_subject" tabindex="3" ');
                    ?>
                </div>
            </div>      

            <div class="control-group">
                <label class="control-label form-lbl" for="is_active"><?php _e('Is Active') ?></label>
                <div class="controls">
                    <?php
                    $dropdown_is_active = yes_no_dropdown_items();
                    echo form_dropdown('is_active', $dropdown_is_active, set_value('is_active', object_element('is_active', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="email_template_is_active" tabindex="5"');
                    ?>
                </div>
            </div>

            <div class="form-actions">
                <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
                <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
                   data-window="<?php echo $window ?>"
                   data-modal-name="email_templateModal">
                       <?php _e('Cancel'); ?>
                </a>
            </div>

        </div>

        <div class="span7">                  
            <div class="control-group">
    <!--            <p>
                    <label class="form-lbl" for="email_template_body"><?php _e('Email Template Body') ?></label> 
                </p>-->
                <div class="">
                    <?php
                    echo form_textarea(array('name' => 'email_template_body', 'rows' => 5, 'cols' => 40), decode_html(set_value('email_template_body', (object_element('email_template_body', $row)))), 'class="validate[required] js-editor span6" id="email_template_email_template_body" tabindex="4"');
                    ?>
                </div>                
            </div>
        </div>
    </div>

    <div class="clear"></div>    

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>

<script type="text/javascript">
    $(function(){
        $("#email_template_email_template_body").kendoEditor({
            encoded: false
        });
    });
</script>