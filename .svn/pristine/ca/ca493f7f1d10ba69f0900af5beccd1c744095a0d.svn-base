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
                            <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
                            <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
                               data-window="<?php echo $window ?>"
                               data-modal-name="matter_note_typeModal">
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