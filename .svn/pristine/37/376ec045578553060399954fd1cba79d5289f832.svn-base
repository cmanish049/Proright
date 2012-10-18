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
                            <label class="control-label form-lbl" for="user_type_id"><?php _e('User Type') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('user_type_id', $dropdown_user_type_id, 
                                        set_value('user_type_id', object_element('user_type_id', $row)), 
                                        'class="validate[funcCall[validateDropdownRequired]] input-xlarge nice-select" id="user_type_id" tabindex="2"');
                                autocomplete_new_button(array(
                                    'url' => admin_url('user_type/edit'),
                                    'target_selector' => '#user_type_id',
                                    'modal_name' => 'user_typeModal'
                                ));
                                ?>
                            </div>
                        </div> 
                        
                        <div class="control-group">
                            <label class="control-label form-lbl" for="admin_type_id"><?php _e('Admin Type') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('admin_type_id', $dropdown_admin_type_id, 
                                        set_value('admin_type_id', object_element('admin_type_id', $row)), 
                                        'class="validate[funcCall[validateDropdownRequired]] input-xlarge nice-select" id="admin_type_id" tabindex="2"');
                                ?>
                            </div>
                        </div> 
                        
                        <div class="control-group">
                            <label class="control-label form-lbl" for="unique_key"><?php _e('Unique Key') ?></label>
                            <div class="controls">
                                <?php
                                /*echo form_input('unique_key', 
                                        set_value('unique_key', object_element('unique_key', $row)), 
                                        'class="validate[maxSize[100]] input-xlarge nice-remote-data-select" id="unique_key" tabindex="3" '
                                        . 'data-url="'.  admin_url('ajax_search/cities').'"');    */                            
                                echo form_input('unique_key', 
                                        set_value('unique_key', object_element('unique_key', $row)), 
                                        'class="validate[maxSize[32],minSize[32]] input-xlarge" id="unique_key" tabindex="3" '
                                        . 'data-url=""');                                
                                ?>    
                                <a href="<?php echo admin_url('ajax/generate_unique_key_for_customer'); ?>"
                                   class="basic-tooltip btn btn-success btn-mini" id="btn-generate-customer-key"
                                   title="<?php _e('Generate key'); ?>">
                                    <i class="icon-random"></i>
                                </a>
<script type="text/javascript">
$(function(){
    $('body').on('click','#btn-generate-customer-key',function(){
        var thisObj = $(this);
        $.ajax({
            url : thisObj.attr('href'),
            dataType : 'html',
            success : function(data){
                $('#unique_key').val(data);
            }
        });
        return false;
    });
});
</script>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="is_admin"><?php _e('Is Admin') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('is_admin', yes_no_dropdown_items(), 
                                        set_value('is_admin', object_element('is_admin', $row)), 
                                        'class="validate[funcCall[validateDropdownRequired]] input-xlarge nice-select" id="is_admin" tabindex="2"');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="username"><?php _e('Username') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('username', set_value('username', object_element('username', $row)), 'class="validate[maxSize[20]] input-xlarge " id="username" tabindex="5" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="name_prefix"><?php _e('Name Prefix') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('name_prefix', set_value('name_prefix', object_element('name_prefix', $row)), 'class="validate[maxSize[50]] input-xlarge " id="name_prefix" tabindex="6" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="first_name"><?php _e('First Name') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('first_name', set_value('first_name', object_element('first_name', $row)), 
                                        'class="validate[maxSize[30]] input-xlarge " id="first_name" tabindex="7" ');
                                ?>
                            </div>
                        </div>     
                        
                        <div class="control-group">
                            <label class="control-label form-lbl" for="middle_name"><?php _e('Middle Name') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('middle_name', set_value('middle_name', object_element('middle_name', $row)), 
                                        'class="validate[maxSize[30]] input-xlarge " id="middle_name" tabindex="7" ');
                                ?>
                            </div>
                        </div>     

                        <div class="control-group">
                            <label class="control-label form-lbl" for="last_name"><?php _e('Last Name') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('last_name', set_value('last_name', object_element('last_name', $row)), 'class="validate[maxSize[30]] input-xlarge " id="last_name" tabindex="8" ');
                                ?>
                            </div>
                        </div>                
                        
                        <div class="control-group">
                            <label class="control-label form-lbl" for="maiden_name"><?php _e('Maiden') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('maiden_name', set_value('maiden_name', object_element('maiden_name', $row)), 
                                        'class="validate[maxSize[30]] input-xlarge " id="maiden_name" tabindex="8" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="email"><?php _e('Email') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('email', 
                                        set_value('email', object_element('email', $row)),
                                        'class="validate[maxSize[100],custom[email]] input-xlarge " id="email" tabindex="10" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="website"><?php _e('Website') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('website', set_value('website', object_element('website', $row)), 'class="validate[maxSize[255]] input-xlarge " id="website" tabindex="11" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="company_id"><?php _e('Company') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('company_id', $dropdown_company_id, 
                                        set_value('company_id', object_element('company_id', $row)), 
                                        'class="validate[] input-xlarge nice-select" id="company_id" tabindex="12"');
                                autocomplete_new_button(array(
                                    'url' => admin_url('company/edit'),
                                    'target_selector' => '#company_id',
                                    'modal_name' => 'companyModal'
                                ));
                                ?>
                            </div>
                        </div>             
                        <div class="control-group">
                            <label class="control-label form-lbl" for="home_phone"><?php _e('Home Phone') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('home_phone', set_value('home_phone', object_element('home_phone', $row)), 'class="validate[maxSize[50]] input-xlarge " id="home_phone" tabindex="13" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="work_phone"><?php _e('Work Phone') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('work_phone', set_value('work_phone', object_element('work_phone', $row)), 'class="validate[maxSize[50]] input-xlarge " id="work_phone" tabindex="14" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="day_phone"><?php _e('Day Phone') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('day_phone', set_value('day_phone', object_element('day_phone', $row)), 'class="validate[maxSize[50]] input-xlarge " id="day_phone" tabindex="15" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="evening_phone"><?php _e('Evening Phone') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('evening_phone', set_value('evening_phone', object_element('evening_phone', $row)), 'class="validate[maxSize[50]] input-xlarge " id="evening_phone" tabindex="16" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="mobile"><?php _e('Mobile') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('mobile', set_value('mobile', object_element('mobile', $row)), 'class="validate[maxSize[50]] input-xlarge " id="mobile" tabindex="17" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="fax"><?php _e('Fax') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('fax', set_value('fax', object_element('fax', $row)), 'class="validate[maxSize[50]] input-xlarge " id="fax" tabindex="18" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="address"><?php _e('Address') ?></label> 
                            <div class="controls">
                                <?php
                                echo form_textarea(array('name' => 'address', 'rows' => 5, 'cols' => 40), 
                                        set_value('address', (object_element('address', $row))), 
                                        'class="validate[] input-xlarge js-editor " id="address" tabindex="19"');
                                ?>
                            </div>                
                        </div>            
                        <div class="control-group">
                            <label class="control-label form-lbl" for="gender"><?php _e('Gender') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('gender', $dropdown_gender, set_value('gender', object_element('gender', $row)), 
                                        'class="validate[] input-xlarge nice-select" id="gender" tabindex="20" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="country_id"><?php _e('Country') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('country_id', $dropdown_country_id, set_value('country_id', object_element('country_id', $row)), 'class="validate[] input-xlarge nice-select chained-select" id="country_id" tabindex="21" ' .
                                        'data-url="' . admin_url('ajax_search/cities') . '" data-target="#city_id"');
                                autocomplete_new_button(array(
                                    'url' => admin_url('country/edit'),
                                    'target_selector' => '#country_id',
                                    'modal_name' => 'countryModal'
                                ));
                                ?>
                            </div>
                        </div> 
                        <div class="control-group">
                            <label class="control-label form-lbl" for="state_id"><?php _e('State') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('state_id', $dropdown_state_id, 
                                        set_value('state_id', object_element('state_id', $row)), 
                                        'class="validate[] input-xlarge nice-select" id="state_id" tabindex="22"');
                                autocomplete_new_button(array(
                                    'url' => admin_url('state/edit'),
                                    'target_selector' => '#state_id',
                                    'modal_name' => 'stateModal'
                                ));
                                ?>
                            </div>
                        </div> 
                        <div class="control-group">
                            <label class="control-label form-lbl" for="city_id"><?php _e('City') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('city_id', $dropdown_city_id, 
                                        set_value('city_id', object_element('city_id', $row)), 
                                        'class="validate[] input-xlarge nice-select" id="city_id" tabindex="23"');
                                autocomplete_new_button(array(
                                    'url' => admin_url('city/edit'),
                                    'target_selector' => '#city_id',
                                    'modal_name' => 'cityModal'
                                ));
                                ?>
                            </div>
                        </div> 
                        <div class="control-group">
                            <label class="control-label form-lbl" for="zip_code_id"><?php _e('Zip Code') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('zip_code_id', $dropdown_zip_code_id, 
                                        set_value('zip_code_id', object_element('zip_code_id', $row)), 
                                        'class="validate[] input-xlarge nice-select" id="zip_code_id" tabindex="24"');
                                autocomplete_new_button(array(
                                    'url' => admin_url('zip_code/edit'),
                                    'target_selector' => '#zip_code_id',
                                    'modal_name' => 'zip_codeModal'
                                ));
                                ?>
                            </div>
                        </div> 
                        <div class="control-group">
                            <label class="control-label form-lbl" for="attorney_id"><?php _e('Attorney') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('attorney_id', $dropdown_attorney_id, set_value('attorney_id', object_element('attorney_id', $row)), 'class="validate[] input-xlarge nice-select" id="attorney_id" tabindex="25"');
                                ?>
                            </div>
                        </div>             
                        <div class="control-group">
                            <label class="control-label form-lbl" for="date_of_record"><?php _e('Date Of Record') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('date_of_record', 
                                        set_value('date_of_record', object_element('date_of_record', $row)), 
                                        'class="validate[funcCall[validateDateTime]] input-xlarge input-datetime" id="date_of_record" tabindex="26" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="referred_by"><?php _e('Referred By') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('referred_by', set_value('referred_by', object_element('referred_by', $row)), 'class="validate[maxSize[100]] input-xlarge " id="referred_by" tabindex="27" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="active"><?php _e('Active') ?></label>
                            <div class="controls">
                                <?php                                
                                echo form_input('active', set_value('active', object_element('active', $row)), 
                                        'class="validate[custom[integer]] input-xlarge input-integer" id="active" tabindex="28" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="height"><?php _e('Height') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('height', set_value('height', object_element('height', $row)), 'class="validate[custom[number]] input-xlarge  input-number" id="height" tabindex="33" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="weight"><?php _e('Weight') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('weight', set_value('weight', object_element('weight', $row)), 'class="validate[custom[number]] input-xlarge  input-number" id="weight" tabindex="34" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="hair_color"><?php _e('Hair Color') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('hair_color', set_value('hair_color', object_element('hair_color', $row)), 'class="validate[maxSize[20]] input-xlarge " id="hair_color" tabindex="35" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="eye_color"><?php _e('Eye Color') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('eye_color', set_value('eye_color', object_element('eye_color', $row)), 'class="validate[maxSize[20]] input-xlarge " id="eye_color" tabindex="36" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="date_of_birth"><?php _e('Date Of Birth') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('date_of_birth', 
                                        set_value('date_of_birth', object_element('date_of_birth', $row)), 
                                        'class="validate[funcCall[validateDate]] input-xlarge input-date" id="date_of_birth" tabindex="37" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="birth_country"><?php _e('Birth Country') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('birth_country', set_value('birth_country', object_element('birth_country', $row)), 'class="validate[maxSize[100]] input-xlarge " id="birth_country" tabindex="38" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="birth_state"><?php _e('Birth State') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('birth_state', set_value('birth_state', object_element('birth_state', $row)), 'class="validate[maxSize[100]] input-xlarge " id="birth_state" tabindex="39" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="birth_city"><?php _e('Birth City') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('birth_city', set_value('birth_city', object_element('birth_city', $row)), 'class="validate[maxSize[100]] input-xlarge " id="birth_city" tabindex="40" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="nationality"><?php _e('Nationality') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('nationality', set_value('nationality', object_element('nationality', $row)), 'class="validate[maxSize[100]] input-xlarge " id="nationality" tabindex="41" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="race"><?php _e('Race') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('race', set_value('race', object_element('race', $row)), 'class="validate[maxSize[100]] input-xlarge " id="race" tabindex="42" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="ssn"><?php _e('Ssn') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('ssn', set_value('ssn', object_element('ssn', $row)), 'class="validate[maxSize[9]] input-xlarge " id="ssn" tabindex="43" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="passport"><?php _e('Passport') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('passport', set_value('passport', object_element('passport', $row)), 'class="validate[maxSize[100]] input-xlarge " id="passport" tabindex="44" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="passport_country_id"><?php _e('Passport Country') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('passport_country_id', $dropdown_country_id, 
                                        set_value('passport_country_id', object_element('passport_country_id', $row)), 
                                        'class="validate[] input-xlarge nice-select" id="passport_country_id" tabindex="45"');
                                ?>
                            </div>
                        </div>             
                        <div class="control-group">
                            <label class="control-label form-lbl" for="date_passport_expires"><?php _e('Date Passport Expires') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('date_passport_expires', set_value('date_passport_expires', object_element('date_passport_expires', $row)), 'class="validate[funcCall[validateDateTime]] input-xlarge input-datetime" id="date_passport_expires" tabindex="46" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="marital_status_id"><?php _e('Marital Status') ?></label>
                            <div class="controls">
                                <?php
                                echo form_dropdown('marital_status_id', $dropdown_marital_status_id, 
                                        set_value('marital_status_id', object_element('marital_status_id', $row)), 
                                        'class="validate[] input-xlarge nice-select" id="marital_status_id" tabindex="47"');
                                ?>
                            </div>
                        </div>             
                        <div class="control-group">
                            <label class="control-label form-lbl" for="previous_marriages_count"><?php _e('Previous Marriages Count') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('previous_marriages_count', set_value('previous_marriages_count', object_element('previous_marriages_count', $row)), 'class="validate[custom[integer]] input-xlarge  input-integer" id="previous_marriages_count" tabindex="48" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="date_married"><?php _e('Date Married') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('date_married', set_value('date_married', object_element('date_married', $row)), 'class="validate[funcCall[validateDateTime]] input-xlarge input-datetime" id="date_married" tabindex="49" ');
                                ?>
                            </div>
                        </div>                

                        <div class="control-group">
                            <label class="control-label form-lbl" for="place_married"><?php _e('Place Married') ?></label>
                            <div class="controls">
                                <?php
                                echo form_input('place_married', set_value('place_married', object_element('place_married', $row)), 'class="validate[maxSize[100]] input-xlarge " id="place_married" tabindex="50" ');
                                ?>
                            </div>
                        </div>                

                        <div class="form-actions">
                            <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
                            <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
                               data-window="<?php echo $window ?>"
                               data-modal-name="userModal">
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