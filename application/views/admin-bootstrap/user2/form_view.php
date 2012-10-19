<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  
    
    <div class="row-fluid">
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_user_type_id"><?php _e('User Type') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('user_type_id', $dropdown_user_type_id, 
                                set_value('user_type_id', object_element('user_type_id', $row)), 
                                'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="user2_user_type_id" tabindex="2"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_admin_type_id"><?php _e('Admin Type') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('admin_type_id', $dropdown_admin_type_id, 
                                set_value('admin_type_id', object_element('admin_type_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_admin_type_id" tabindex="3"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_is_admin"><?php _e('Is Admin') ?></label>
                <div class="controls">
                    <?php
                        $dropdown_is_admin = yes_no_dropdown_items();
                        echo form_dropdown('is_admin', $dropdown_is_admin, 
                                set_value('is_admin', object_element('is_admin', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_is_admin" tabindex="4"' );
                    ?>
                </div>
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_unique_key"><?php _e('Unique Key') ?></label>
                    <div class="controls">
                        <?php echo form_input('unique_key',  
                        set_value('unique_key', object_element('unique_key', $row)), 
                        'class="validate[maxSize[32]] input-xlarge " id="user2_unique_key" tabindex="5" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_username"><?php _e('Username') ?></label>
                    <div class="controls">
                        <?php echo form_input('username',  
                        set_value('username', object_element('username', $row)), 
                        'class="validate[maxSize[20]] input-xlarge " id="user2_username" tabindex="6" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_name_prefix"><?php _e('Name Prefix') ?></label>
                    <div class="controls">
                        <?php echo form_input('name_prefix',  
                        set_value('name_prefix', object_element('name_prefix', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="user2_name_prefix" tabindex="7" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_first_name"><?php _e('First Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('first_name',  
                        set_value('first_name', object_element('first_name', $row)), 
                        'class="validate[maxSize[30]] input-xlarge " id="user2_first_name" tabindex="8" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_middle_name"><?php _e('Middle Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('middle_name',  
                        set_value('middle_name', object_element('middle_name', $row)), 
                        'class="validate[maxSize[30]] input-xlarge " id="user2_middle_name" tabindex="9" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_last_name"><?php _e('Last Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('last_name',  
                        set_value('last_name', object_element('last_name', $row)), 
                        'class="validate[maxSize[30]] input-xlarge " id="user2_last_name" tabindex="10" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_maiden_name"><?php _e('Maiden Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('maiden_name',  
                        set_value('maiden_name', object_element('maiden_name', $row)), 
                        'class="validate[maxSize[30]] input-xlarge " id="user2_maiden_name" tabindex="11" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_full_name"><?php _e('Full Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('full_name',  
                        set_value('full_name', object_element('full_name', $row)), 
                        'class="validate[maxSize[255]] input-xlarge " id="user2_full_name" tabindex="12" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_email"><?php _e('Email') ?></label>
                    <div class="controls">
                        <?php echo form_input('email',  
                        set_value('email', object_element('email', $row)), 
                        'class="validate[maxSize[100]] input-xlarge " id="user2_email" tabindex="13" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_website"><?php _e('Website') ?></label>
                    <div class="controls">
                        <?php echo form_input('website',  
                        set_value('website', object_element('website', $row)), 
                        'class="validate[maxSize[255]] input-xlarge " id="user2_website" tabindex="14" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_company_id"><?php _e('Company') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('company_id', $dropdown_company_id, 
                                set_value('company_id', object_element('company_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_company_id" tabindex="15"' );
                    ?>
                </div>
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_home_phone"><?php _e('Home Phone') ?></label>
                    <div class="controls">
                        <?php echo form_input('home_phone',  
                        set_value('home_phone', object_element('home_phone', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="user2_home_phone" tabindex="16" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_work_phone"><?php _e('Work Phone') ?></label>
                    <div class="controls">
                        <?php echo form_input('work_phone',  
                        set_value('work_phone', object_element('work_phone', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="user2_work_phone" tabindex="17" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_day_phone"><?php _e('Day Phone') ?></label>
                    <div class="controls">
                        <?php echo form_input('day_phone',  
                        set_value('day_phone', object_element('day_phone', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="user2_day_phone" tabindex="18" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_evening_phone"><?php _e('Evening Phone') ?></label>
                    <div class="controls">
                        <?php echo form_input('evening_phone',  
                        set_value('evening_phone', object_element('evening_phone', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="user2_evening_phone" tabindex="19" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_mobile"><?php _e('Mobile') ?></label>
                    <div class="controls">
                        <?php echo form_input('mobile',  
                        set_value('mobile', object_element('mobile', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="user2_mobile" tabindex="20" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_fax"><?php _e('Fax') ?></label>
                    <div class="controls">
                        <?php echo form_input('fax',  
                        set_value('fax', object_element('fax', $row)), 
                        'class="validate[maxSize[50]] input-xlarge " id="user2_fax" tabindex="21" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_address"><?php _e('Address') ?></label> 
                <div class="controls">
                    <?php echo form_textarea(array('name' => 'address', 'rows' => 5, 'cols' => 40), 
                                    set_value('address', (object_element('address', $row))), 
                                    'class="validate[] input-xlarge js-editor " id="user2_address" tabindex="22"'); ?>
                </div>                
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_gender"><?php _e('Gender') ?></label>
                    <div class="controls">
                        <?php echo form_input('gender',  
                        set_value('gender', object_element('gender', $row)), 
                        'class="validate[maxSize[10]] input-xlarge " id="user2_gender" tabindex="23" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_country_id"><?php _e('Country') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('country_id', $dropdown_country_id, 
                                set_value('country_id', object_element('country_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_country_id" tabindex="24"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_state_id"><?php _e('State') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('state_id', $dropdown_state_id, 
                                set_value('state_id', object_element('state_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_state_id" tabindex="25"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_city_id"><?php _e('City') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('city_id', $dropdown_city_id, 
                                set_value('city_id', object_element('city_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_city_id" tabindex="26"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_zip_code_id"><?php _e('Zip Code') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('zip_code_id', $dropdown_zip_code_id, 
                                set_value('zip_code_id', object_element('zip_code_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_zip_code_id" tabindex="27"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_attorney_id"><?php _e('Attorney') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('attorney_id', $dropdown_attorney_id, 
                                set_value('attorney_id', object_element('attorney_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_attorney_id" tabindex="28"' );
                    ?>
                </div>
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_date_of_record"><?php _e('Date Of Record') ?></label>
                    <div class="controls">
                        <?php echo form_input('date_of_record',  
                        set_value('date_of_record', object_element('date_of_record', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="user2_date_of_record" tabindex="29" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_referred_by"><?php _e('Referred By') ?></label>
                    <div class="controls">
                        <?php echo form_input('referred_by',  
                        set_value('referred_by', object_element('referred_by', $row)), 
                        'class="validate[maxSize[100]] input-xlarge " id="user2_referred_by" tabindex="30" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_is_active"><?php _e('Is Active') ?></label>
                <div class="controls">
                    <?php
                        $dropdown_is_active = yes_no_dropdown_items();
                        echo form_dropdown('is_active', $dropdown_is_active, 
                                set_value('is_active', object_element('is_active', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_is_active" tabindex="31"' );
                    ?>
                </div>
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_height"><?php _e('Height') ?></label>
                    <div class="controls">
                        <?php echo form_input('height',  
                        set_value('height', object_element('height', $row)), 
                        'class="validate[custom[number]] input-xlarge  input-number" id="user2_height" tabindex="36" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_weight"><?php _e('Weight') ?></label>
                    <div class="controls">
                        <?php echo form_input('weight',  
                        set_value('weight', object_element('weight', $row)), 
                        'class="validate[custom[number]] input-xlarge  input-number" id="user2_weight" tabindex="37" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_hair_color"><?php _e('Hair Color') ?></label>
                    <div class="controls">
                        <?php echo form_input('hair_color',  
                        set_value('hair_color', object_element('hair_color', $row)), 
                        'class="validate[maxSize[20]] input-xlarge " id="user2_hair_color" tabindex="38" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_eye_color"><?php _e('Eye Color') ?></label>
                    <div class="controls">
                        <?php echo form_input('eye_color',  
                        set_value('eye_color', object_element('eye_color', $row)), 
                        'class="validate[maxSize[20]] input-xlarge " id="user2_eye_color" tabindex="39" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_date_of_birth"><?php _e('Date Of Birth') ?></label>
                    <div class="controls">
                        <?php echo form_input('date_of_birth',  
                        set_value('date_of_birth', object_element('date_of_birth', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="user2_date_of_birth" tabindex="40" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_birth_country_id"><?php _e('Birth Country') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('birth_country_id', $dropdown_birth_country_id, 
                                set_value('birth_country_id', object_element('birth_country_id', $row)), 
                                'class="validate[maxSize[100]] input-xlarge " id="user2_birth_country_id" tabindex="41"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_birth_state_id"><?php _e('Birth State') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('birth_state_id', $dropdown_birth_state_id, 
                                set_value('birth_state_id', object_element('birth_state_id', $row)), 
                                'class="validate[maxSize[100]] input-xlarge " id="user2_birth_state_id" tabindex="42"' );
                    ?>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_birth_city_id"><?php _e('Birth City') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('birth_city_id', $dropdown_birth_city_id, 
                                set_value('birth_city_id', object_element('birth_city_id', $row)), 
                                'class="validate[maxSize[100]] input-xlarge " id="user2_birth_city_id" tabindex="43"' );
                    ?>
                </div>
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_nationality"><?php _e('Nationality') ?></label>
                    <div class="controls">
                        <?php echo form_input('nationality',  
                        set_value('nationality', object_element('nationality', $row)), 
                        'class="validate[maxSize[100]] input-xlarge " id="user2_nationality" tabindex="44" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_race"><?php _e('Race') ?></label>
                    <div class="controls">
                        <?php echo form_input('race',  
                        set_value('race', object_element('race', $row)), 
                        'class="validate[maxSize[100]] input-xlarge " id="user2_race" tabindex="45" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_ssn"><?php _e('Ssn') ?></label>
                    <div class="controls">
                        <?php echo form_input('ssn',  
                        set_value('ssn', object_element('ssn', $row)), 
                        'class="validate[maxSize[9]] input-xlarge " id="user2_ssn" tabindex="46" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_passport"><?php _e('Passport') ?></label>
                    <div class="controls">
                        <?php echo form_input('passport',  
                        set_value('passport', object_element('passport', $row)), 
                        'class="validate[maxSize[100]] input-xlarge " id="user2_passport" tabindex="47" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_passport_country_id"><?php _e('Passport Country') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('passport_country_id', $dropdown_passport_country_id, 
                                set_value('passport_country_id', object_element('passport_country_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_passport_country_id" tabindex="48"' );
                    ?>
                </div>
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_date_passport_expires"><?php _e('Date Passport Expires') ?></label>
                    <div class="controls">
                        <?php echo form_input('date_passport_expires',  
                        set_value('date_passport_expires', object_element('date_passport_expires', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="user2_date_passport_expires" tabindex="49" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_marital_status_id"><?php _e('Marital Status') ?></label>
                <div class="controls">
                    <?php
                        
                        echo form_dropdown('marital_status_id', $dropdown_marital_status_id, 
                                set_value('marital_status_id', object_element('marital_status_id', $row)), 
                                'class="validate[] input-xlarge  nice-select" id="user2_marital_status_id" tabindex="50"' );
                    ?>
                </div>
            </div>
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_previous_marriages_count"><?php _e('Previous Marriages Count') ?></label>
                    <div class="controls">
                        <?php echo form_input('previous_marriages_count',  
                        set_value('previous_marriages_count', object_element('previous_marriages_count', $row)), 
                        'class="validate[custom[integer]] input-xlarge  input-integer" id="user2_previous_marriages_count" tabindex="51" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_date_married"><?php _e('Date Married') ?></label>
                    <div class="controls">
                        <?php echo form_input('date_married',  
                        set_value('date_married', object_element('date_married', $row)), 
                        'class="validate[funcCall[validateDateTime]] input-xlarge  input-datetime" id="user2_date_married" tabindex="52" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="user2_place_married"><?php _e('Place Married') ?></label>
                    <div class="controls">
                        <?php echo form_input('place_married',  
                        set_value('place_married', object_element('place_married', $row)), 
                        'class="validate[maxSize[100]] input-xlarge " id="user2_place_married" tabindex="53" '); ?>
                    </div>
                </div>                
        
            <div class="control-group">
                <label class="control-label form-lbl" for="user2_description"><?php _e('Description') ?></label> 
                <div class="controls">
                    <?php echo form_textarea(array('name' => 'description', 'rows' => 5, 'cols' => 40), 
                                    set_value('description', (object_element('description', $row))), 
                                    'class="validate[] input-xlarge js-editor " id="user2_description" tabindex="54"'); ?>
                </div>                
            </div>
        
    </div>
    
    <div class="form-actions">
        <?php $this->template->view('templates/form_footer_buttons_view',array('modal_name'=>'user2Modal','index_url'=>$index_url)); ?>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>