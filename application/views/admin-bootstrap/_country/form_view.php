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

    <?php echo form_hidden('COUNTRY_ID', object_element('COUNTRY_ID', $row)); ?>
    <?php echo form_hidden('redirect', $redirect); ?>

    <div class="row">
        <div class="span12">
                        
                <div class="control-group">
                    <label class="control-label form-lbl" for="country_name">Country Name</label>
                    <div class="controls">
                        <?php echo form_input('country_name',  set_value('country_name', object_element('country_name', $row)), 'class="validate[maxSize[100],required] input-xlarge" id="country_name" tabindex="2" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="country_seo">Country Seo</label>
                    <div class="controls">
                        <?php echo form_input('country_seo',  set_value('country_seo', object_element('country_seo', $row)), 'class="validate[maxSize[100]] input-xlarge" id="country_seo" tabindex="3" '); ?>
                    </div>
                </div>                
        
            <div class="form-actions">
                <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
                <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
                   data-window="<?php echo $window ?>"
                   data-modal-name="countryModal">
                    <?php _e('Vazgeç'); ?>
                </a>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->

</div>