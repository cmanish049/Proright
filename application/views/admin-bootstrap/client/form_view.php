<script type="text/javascript">
    
    function setVisibleFieldsets(activeTabObj){
        jQuery('#form-user').validationEngine('hide');      
        var fieldsetsObj = $('#form-user fieldset');
        fieldsetsObj.hide('fast',function(){
            fieldsetsObj.fadeIn('fast',function(){
                if (activeTabObj.data('hidden_objects')) {
                    $.each(activeTabObj.data('hidden_objects'),function(){
                        $(this).fadeOut('fast',function(){});                        
                    });
                }
            });
        });         
    }
    
    $(function(){        
    
        $('#tab-basic').data('hidden_objects', [
            //$('#fieldset-name'),
            //$('fieldset-contact-information'),
            //$('fieldset-phone'),
            //$('fieldset-address'),
            $('#fieldset-other-informations'),
            $('#fieldset-physical-appearance'),
            $('#fieldset-passport-informations'),
            $('#marital-informations')
        ]);
        $('.fieldset-tab-item').on('shown',function(e){
                var thisObj = $(this);
                setVisibleFieldsets(thisObj);
                
        });
        
        setVisibleFieldsets($('#fieldset-tab li.active a'));    
    });
</script>

<div class="section clearfix">
            <div class="box">
                <div class="box-header-container">
                    <h1 class="box-header">
                        <?php echo $page_title; ?>
                    </h1>
                </div>

                <div class="box-content">
                    <div class="section-padding">
                        
                        <ul class="nav nav-pills" id="fieldset-tab" >
                            <li class="active"><a id="tab-basic" href="#basic" class="fieldset-tab-item" data-toggle="tab"><?php _e('Basic'); ?></a></li>
                            <li><a id="tab-advanced" href="#advanced" class="fieldset-tab-item" data-toggle="tab"><?php _e('Advanced') ?></a></li>
                        </ul>
<!--<div id="fieldset-tab">
    <ul class="" >
        <li id="tab-basic"><?php _e('Basic'); ?></li>
        <li id="tab-advanced"><?php _e('Advanced') ?></li>
    </ul>
</div>-->
                        
                        
                        <?php
                        echo flash_data_alert_admin();
                        echo form_alert_admin();
                        echo alert_admin($error, 'error');
                        echo alert_admin($success, 'success');
                        echo alert_admin($warning, 'warning');
                        ?>

                        <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-vertical" id="form-user"'); ?>                       
                        <?php echo form_hidden('redirect', $redirect); ?>                        

                        
                        <fieldset class="k-state-active" id="fieldset-name">
                            <legend class="k-header k-state-active"><?php _e('Name') ?></legend>
                            <div class="row-fluid">                            
                                    <div class="span2">
                                        <div class="control-group ">
                                            <label class="control-label form-lbl" for="name_prefix"><?php _e('Name Prefix') ?></label>
                                            <div class="controls">
                                                <?php
                                                echo form_input('name_prefix', set_value('name_prefix', object_element('name_prefix', $row)), 
                                                        'class="validate[maxSize[50]] input-medium  " id="name_prefix" tabindex="6" ');
                                                ?>
                                            </div>
                                        </div>
                                    </div>                

                                    <div class="span3">                                
                                        <div class="control-group">
                                            <label class="control-label form-lbl" for="first_name"><?php _e('First Name') ?></label>
                                            <div class="controls">
                                                <?php
                                                echo form_input('first_name', set_value('first_name', object_element('first_name', $row)), 
                                                        'class="validate[required,maxSize[30]] input-large " id="first_name" tabindex="7" ');
                                                ?>
                                            </div>
                                        </div> 
                                    </div>    

                                    <div class="span2">
                                        <div class="control-group">
                                            <label class="control-label form-lbl" for="middle_name"><?php _e('Middle Name') ?></label>
                                            <div class="controls">
                                                <?php
                                                echo form_input('middle_name', set_value('middle_name', object_element('middle_name', $row)), 
                                                        'class="validate[maxSize[30]] input-medium " id="middle_name" tabindex="7" ');
                                                ?>
                                            </div>
                                        </div>
                                    </div>     

                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label form-lbl" for="last_name"><?php _e('Last Name') ?></label>
                                            <div class="controls">
                                                <?php
                                                echo form_input('last_name', set_value('last_name', object_element('last_name', $row)), 
                                                        'class="validate[maxSize[30]] input-large " id="last_name" tabindex="8" ');
                                                ?>
                                            </div>
                                        </div> 
                                    </div>               

                                    <div class="span2">
                                        <div class="control-group">
                                            <label class="control-label form-lbl" for="maiden_name"><?php _e('Maiden') ?></label>
                                            <div class="controls">
                                                <?php
                                                echo form_input('maiden_name', set_value('maiden_name', object_element('maiden_name', $row)), 
                                                        'class="validate[maxSize[30]] input-medium " id="maiden_name" tabindex="8" ');
                                                ?>
                                            </div>
                                        </div>   
                                    </div>

                                </div>             
                        </fieldset>                        

                        <fieldset class="k-state-active" id="fieldset-contact-information">
                            <legend class="k-header k-state-active"><?php _e('Contact Information') ?></legend>
                            <div class="row-fluid">                                

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="email"><?php _e('Email') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('email', set_value('email', object_element('email', $row)), 
                                                'class="validate[maxSize[100],custom[email]]  " id="email" tabindex="10" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="website"><?php _e('Website') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('website', set_value('website', object_element('website', $row)), 'class="validate[maxSize[255]]  " id="website" tabindex="11" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="company_id"><?php _e('Company') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('company_id', $dropdown_company_id, 
                                                set_value('company_id', object_element('company_id', $row)), 
                                                'class="validate[]  nice-select input-large" id="company_id" tabindex="12"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('company/edit'),
                                            'target_selector' => '#company_id',
                                            'modal_name' => 'companyModal'
                                        ));
                                        ?>
                                    </div>
                                </div>   
                            </div> 
                        </fieldset>                      
                                  
                        
                        <fieldset class="k-state-active" id="fieldset-phone">
                            <legend class="k-header k-state-active"><?php _e('Phone') ?> </legend>
                            <div class="row-fluid">
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="home_phone"><?php _e('Home Phone') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('home_phone', set_value('home_phone', object_element('home_phone', $row)), 
                                                'class="validate[maxSize[50]]  input-medium " id="home_phone" tabindex="13" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="work_phone"><?php _e('Work Phone') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('work_phone', set_value('work_phone', object_element('work_phone', $row)), 
                                                'class="validate[maxSize[50]]  input-medium " id="work_phone" tabindex="14" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="day_phone"><?php _e('Day Phone') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('day_phone', set_value('day_phone', object_element('day_phone', $row)), 
                                                'class="validate[maxSize[50]]  input-medium " id="day_phone" tabindex="15" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="evening_phone"><?php _e('Evening Phone') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('evening_phone', set_value('evening_phone', object_element('evening_phone', $row)), 
                                                'class="validate[maxSize[50]]  input-medium " id="evening_phone" tabindex="16" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="mobile"><?php _e('Mobile') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('mobile', set_value('mobile', object_element('mobile', $row)), 
                                                'class="validate[maxSize[50]] input-medium " id="mobile" tabindex="17" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="fax"><?php _e('Fax') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('fax', set_value('fax', object_element('fax', $row)), 
                                                'class="validate[maxSize[50]]  input-medium " id="fax" tabindex="18" ');
                                        ?>
                                    </div>
                                </div> 
                            </div> 
                        </fieldset>

                        <fieldset class="k-state-active" id="fieldset-address">
                            <legend class="k-header k-state-active"><?php _e('Address') ?></legend>
                            
                            <div class="row-fluid">
                                <div class="control-group">
                                    <label class="control-label form-lbl" for="address"><?php _e('Address') ?></label> 
                                    <div class="controls">
                                        <?php
                                        echo form_textarea(array('name' => 'address', 'rows' => 1, 'cols' => 40), 
                                                set_value('address', (object_element('address', $row))), 
                                                'class="validate[]  js-editor span12" id="address" tabindex="19"');
                                        ?>
                                    </div>                
                                </div>
                            </div>

                            <div class="row-fluid">                                
                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="country_id"><?php _e('Country') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('country_id', $dropdown_country_id, 
                                                set_value('country_id', object_element('country_id', $row)), 
                                                'class="validate[]  nice-select chained-select input-large" id="country_id" tabindex="21" ' .
                                                'data-url="' . admin_url('ajax_search/cities') . '" data-target="#city_id"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('country/edit'),
                                            'target_selector' => '#country_id',
                                            'modal_name' => 'countryModal'
                                        ));
                                        ?>
                                    </div>
                                </div> 

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="state_id"><?php _e('State') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('state_id', $dropdown_state_id, 
                                                set_value('state_id', object_element('state_id', $row)), 
                                                'class="validate[]  nice-select  input-large" id="state_id" tabindex="22"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('state/edit'),
                                            'target_selector' => '#state_id',
                                            'modal_name' => 'stateModal'
                                        ));
                                        ?>
                                    </div>
                                </div> 

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="city_id"><?php _e('City') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('city_id', $dropdown_city_id, 
                                                set_value('city_id', object_element('city_id', $row)), 
                                                'class="validate[]  nice-select input-large" id="city_id" tabindex="23"' . 
                                                'data-value="'.  object_element('city_id', $row).'"' .
                                                'data-text="'.  object_element('city_name', $row).'"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('city/edit'),
                                            'target_selector' => '#city_id',
                                            'modal_name' => 'cityModal'
                                        ));
                                        ?>
                                    </div>
                                </div> 

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="zip_code_id"><?php _e('Zip Code') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('zip_code_id', $dropdown_zip_code_id, 
                                                set_value('zip_code_id', object_element('zip_code_id', $row)), 
                                                'class="validate[]  nice-select input-large" id="zip_code_id" tabindex="24"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('zip_code/edit'),
                                            'target_selector' => '#zip_code_id',
                                            'modal_name' => 'zip_codeModal'
                                        ));
                                        ?>
                                    </div>
                                </div>
                            </div> 
                        </fieldset>
                        
                        <fieldset class="k-state-active" id="fieldset-other-informations">
                            <legend class="k-header k-state-active"><?php _e('Other Informations') ?></legend>
                            
                            <div class="row-fluid">
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="gender"><?php _e('Gender') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('gender', $dropdown_gender, 
                                                set_value('gender', object_element('gender', $row)), 
                                                'class="validate[]  nice-select input-medium" id="gender" tabindex="20" ');
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="date_of_birth"><?php _e('Date Of Birth') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('date_of_birth', 
                                                set_value('date_of_birth', object_element('date_of_birth', $row)), 
                                                'class="validate[funcCall[validateDate]]  input-date" style="width:140px" id="date_of_birth" tabindex="37" ');
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="user_birth_country_id"><?php _e('Country of Birth') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('birth_country_id', $dropdown_country_id, 
                                                set_value('birth_country_id', object_element('birth_country_id', $row)), 
                                                'class="validate[]  nice-select chained-select input-large" id="user_birth_country_id" tabindex="21" ' .
                                                'data-url="' . admin_url('ajax_search/cities') . '" data-target="#user_birth_city_id"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('country/edit'),
                                            'target_selector' => '#birth_country_id',
                                            'modal_name' => 'countryModal'
                                        ));
                                        ?>
                                    </div>
                                </div> 

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="user_birth_state_id"><?php _e('State of Birth') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('birth_state_id', $dropdown_state_id, 
                                                set_value('birth_state_id', object_element('birth_state_id', $row)), 
                                                'class="validate[]  nice-select  input-large" id="user_birth_state_id" tabindex="22"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('state/edit'),
                                            'target_selector' => '#user_birth_state_id',
                                            'modal_name' => 'stateModal'
                                        ));
                                        ?>
                                    </div>
                                </div> 

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="user_birth_city_id"><?php _e('City of Birth') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('birth_city_id', $dropdown_city_id, 
                                                set_value('birth_city_id', object_element('birth_city_id', $row)), 
                                                'class="validate[]  nice-select input-medium" id="user_birth_city_id" tabindex="23"' . 
                                                'data-value="'.  object_element('birth_city_id', $row).'"' .
                                                'data-text="'.  object_element('birth_city_name', $row).'"');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('city/edit'),
                                            'target_selector' => '#user_birth_city_id',
                                            'modal_name' => 'cityModal'
                                        ));
                                        ?>
                                    </div>
                                </div> 
                                                                
                            </div>
                        </fieldset>
                        
                        <fieldset class="k-state-active" id="fieldset-physical-appearance">
                            <legend class="k-header k-state-active"><?php _e('Physical Appearance'); ?></legend>
                            
                            <div class="row-fluid">
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="height"><?php _e('Height') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('height', set_value('height', object_element('height', $row)), 
                                                'class="validate[custom[number]] input-number input-medium" id="height" tabindex="33" ');
                                        ?>
                                    </div>
                                </div>  
                                
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="weight"><?php _e('Weight') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('weight', set_value('weight', object_element('weight', $row)), 
                                                'class="validate[custom[number]]   input-number input-medium" id="weight" tabindex="34" ');
                                        ?>
                                    </div>
                                </div>                                  
                                
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="hair_color"><?php _e('Hair Color') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('hair_color', set_value('hair_color', object_element('hair_color', $row)), 
                                                'class="validate[maxSize[20]] input-medium " id="hair_color" tabindex="35" ');
                                        ?>
                                    </div>
                                </div> 
                                
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="eye_color"><?php _e('Eye Color') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('eye_color', set_value('eye_color', object_element('eye_color', $row)), 
                                                'class="validate[maxSize[20]]  input-medium " id="eye_color" tabindex="36" ');
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </fieldset>                
                                
                        <fieldset class="k-state-active" id="fieldset-passport-informations">
                            <legend class="k-header k-state-active"><?php _e('Passport Informations') ?></legend>
                            
                            <div class="row-fluid">
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="nationality"><?php _e('Nationality') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('nationality', 
                                                set_value('nationality', object_element('nationality', $row)), 
                                                'class="validate[maxSize[100]] input-medium " id="nationality" tabindex="41" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="race"><?php _e('Race') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('race', set_value('race', object_element('race', $row)), 'class="validate[maxSize[100]] input-medium " id="race" tabindex="42" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="ssn"><?php _e('Ssn') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('ssn', set_value('ssn', object_element('ssn', $row)), 'class="validate[maxSize[9]] input-medium " id="ssn" tabindex="43" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="passport"><?php _e('Passport') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('passport', set_value('passport', object_element('passport', $row)), 'class="validate[maxSize[100]] input-medium " id="passport" tabindex="44" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="passport_country_id"><?php _e('Passport Country') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('passport_country_id', $dropdown_country_id, 
                                                set_value('passport_country_id', object_element('passport_country_id', $row)), 
                                                'class="validate[]  nice-select input-medium" id="passport_country_id" tabindex="45"');
                                        ?>
                                    </div>
                                </div>             
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="date_passport_expires"><?php _e('Date Passport Expires') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('date_passport_expires', set_value('date_passport_expires', object_element('date_passport_expires', $row)), 
                                                'class="validate[funcCall[validateDate]]  input-date input-medium" style="width:100px" id="date_passport_expires" tabindex="46" ');
                                        ?>
                                    </div>
                                </div>                                 
                            </div>
                        </fieldset>
                        
                        <fieldset class="k-state-active" id="marital-informations">
                            <legend class="k-header k-state-active"><?php _e('Marital Informations') ?></legend>
                            
                            <div class="row-fluid">
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="marital_status_id"><?php _e('Marital Status') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('marital_status_id', $dropdown_marital_status_id, 
                                                set_value('marital_status_id', object_element('marital_status_id', $row)), 
                                                'class="validate[]  nice-select input-medium" id="marital_status_id" tabindex="47"');
                                        ?>
                                    </div>
                                </div>             
                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="previous_marriages_count"><?php _e('Previous Marriages Count') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('previous_marriages_count', 
                                                set_value('previous_marriages_count', object_element('previous_marriages_count', $row)), 
                                                'class="validate[custom[integer]] input-medium  input-integer" id="previous_marriages_count" tabindex="48" ');
                                        ?>
                                    </div>
                                </div>                  

                                <div class="control-group span2">
                                    <label class="control-label form-lbl" for="place_married"><?php _e('Place Married') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('place_married', set_value('place_married', object_element('place_married', $row)), 
                                                'class="validate[maxSize[100]] input-medium " id="place_married" tabindex="50" ');
                                        ?>
                                    </div>
                                </div>              

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="date_married"><?php _e('Date Married') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('date_married', set_value('date_married', object_element('date_married', $row)), 
                                                'class="validate[funcCall[validateDate]] input-medium input-date" id="date_married" tabindex="49" ');
                                        ?>
                                    </div>
                                </div>                
                                
                            </div>
                        </fieldset>
                        
                        

                                       
                        <fieldset class="k-state-active">
                            <!--<legend class="k-header k-state-active"><?php _e('Other') ?></legend>-->
                        
                            <div class="row-fluid">
                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="user_type_id"><?php _e('User Type') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('user_type_id', $dropdown_user_type_id, set_value('user_type_id', object_element('user_type_id', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-large nice-select" id="user_type_id" tabindex="2"
                                                    ');
                                        autocomplete_new_button(array(
                                            'url' => admin_url('user_type/edit'),
                                            'target_selector' => '#user_type_id',
                                            'modal_name' => 'user_typeModal'
                                        ));
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="attorney_id"><?php _e('Attorney') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_dropdown('attorney_id', $dropdown_attorney_id, 
                                                set_value('attorney_id', object_element('attorney_id', $row)), 
                                                'class="validate[]  nice-select input-large" id="attorney_id" tabindex="25"');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="referred_by"><?php _e('Referred By') ?></label>
                                    <div class="controls">
                                        <?php
                                        echo form_input('referred_by', 
                                                set_value('referred_by', object_element('referred_by', $row)), 
                                                'class="validate[maxSize[100]] input-large " id="referred_by" tabindex="27" ');
                                        ?>
                                    </div>
                                </div>                

                                <div class="control-group span3">
                                    <label class="control-label form-lbl" for="user_is_active"><?php _e('Is Active') ?></label>
                                    <div class="controls">
                                        <?php
                                            $dropdown_is_active = yes_no_dropdown_items();
                                            echo form_dropdown('is_active', $dropdown_is_active, 
                                                    set_value('is_active', object_element('is_active', $row)), 
                                                    'class="validate[funcCall[validateDropdownRequired]] input-medium  nice-select" id="user_is_active" tabindex="3"' );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                                        

                                       

                        
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