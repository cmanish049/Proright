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
                    <div class="section-padding">
                        <div class="grid-container">
                            <div id="userGrid"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>

<?php 
$this->template->view('templates/kendo_grid_toolbar_template',array(
    'edit_modal_size' => 'max-max',
    'grid_name' => 'user'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'user'
)); 
?>

<script type="text/x-kendo-template" id="user-quickview-template">
    <div id="quickview-container">
        <table class="quickview-grid">
            <thead>
                <tr>
                    <th class="label"><?php _e('Label'); ?></th>
                    <th class="value"><?php _e('Value'); ?></th>
                </tr>
            </thead>
            <tbody>  
                
            	<tr>
                    <td><strong><?php _e('User Type'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('user_type_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Unique Key'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('unique_key'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Is Admin'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('is_admin'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Username'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('username'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Name Prefix'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('name_prefix'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('First Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('first_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Last Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('last_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Full Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('full_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Email'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('email'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Website'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('website'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Company'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('company_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Home Phone'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('home_phone'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Work Phone'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('work_phone'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Day Phone'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('day_phone'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Evening Phone'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('evening_phone'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Mobile'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('mobile'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Fax'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('fax'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Address'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('address'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Gender'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('gender'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Country'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('country_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('State'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('state_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('City'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('city_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Zip Code'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('zip_code_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Attorney'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('attorney_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Date Of Record'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('date_of_record'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Referred By'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('referred_by'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Active'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('active'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Inserter'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('inserter_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Insert Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('insert_date'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Updater'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('updater_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Update Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('update_date'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Height'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('height'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Weight'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('weight'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Hair Color'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('hair_color'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Eye Color'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('eye_color'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Date Of Birth'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('date_of_birth'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Birth Country'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('birth_country'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Birth State'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('birth_state'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Birth City'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('birth_city'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Nationality'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('nationality'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Race'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('race'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Ssn'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('ssn'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Passport'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('passport'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Passport Country'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('passport_country_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Date Passport Expires'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('date_passport_expires'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Marital Status'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('marital_status_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Previous Marriages Count'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('previous_marriages_count'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Date Married'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('date_married'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Place Married'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('place_married'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var userGrid;
    
    $(function() {
        grid(
            $('#userGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'user_id',
                    fields: {
                        actions:{},
                        user_type_id: { type: 'number' },
                        unique_key: { type: 'string' },
                        is_admin: { type: 'number' },
                        username: { type: 'string' },
                        name_prefix: { type: 'string' },
                        first_name: { type: 'string' },
                        last_name: { type: 'string' },
                        full_name: { type: 'string' },
                        email: { type: 'string' },
                        website: { type: 'string' },
                        company_id: { type: 'number' },
                        home_phone: { type: 'string' },
                        work_phone: { type: 'string' },
                        day_phone: { type: 'string' },
                        evening_phone: { type: 'string' },
                        mobile: { type: 'string' },
                        fax: { type: 'string' },
                        address: { type: 'string' },
                        gender: { type: 'string' },
                        country_id: { type: 'number' },
                        state_id: { type: 'number' },
                        city_id: { type: 'number' },
                        zip_code_id: { type: 'number' },
                        attorney_id: { type: 'number' },
                        date_of_record: { type: 'date' },
                        referred_by: { type: 'string' },
                        active: { type: 'number' },
                        inserter_id: { type: 'number' },
                        insert_date: { type: 'date' },
                        updater_id: { type: 'number' },
                        update_date: { type: 'date' },
                        height: { type: 'number' },
                        weight: { type: 'number' },
                        hair_color: { type: 'string' },
                        eye_color: { type: 'string' },
                        date_of_birth: { type: 'date' },
                        birth_country: { type: 'string' },
                        birth_state: { type: 'string' },
                        birth_city: { type: 'string' },
                        nationality: { type: 'string' },
                        race: { type: 'string' },
                        ssn: { type: 'string' },
                        passport: { type: 'string' },
                        passport_country_id: { type: 'number' },
                        date_passport_expires: { type: 'date' },
                        marital_status_id: { type: 'number' },
                        previous_marriages_count: { type: 'number' },
                        date_married: { type: 'date' },
                        place_married: { type: 'string' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#user-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#user-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'user_type_id',
                				title:'<?php _e('User Type'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(user_type_id, "") #'
            			},
            			{
                				field:'unique_key',
                				title:'<?php _e('Unique Key'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(unique_key, "") #'
            			},
            			{
                				field:'is_admin',
                				title:'<?php _e('Is Admin'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(is_admin, "") #'
            			},
            			{
                				field:'username',
                				title:'<?php _e('Username'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(username, "") #'
            			},
            			{
                				field:'name_prefix',
                				title:'<?php _e('Name Prefix'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(name_prefix, "") #'
            			},
            			{
                				field:'first_name',
                				title:'<?php _e('First Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(first_name, "") #'
            			},
            			{
                				field:'last_name',
                				title:'<?php _e('Last Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(last_name, "") #'
            			},
            			{
                				field:'full_name',
                				title:'<?php _e('Full Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(full_name, "") #'
            			},
            			{
                				field:'email',
                				title:'<?php _e('Email'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(email, "") #'
            			},
            			{
                				field:'website',
                				title:'<?php _e('Website'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(website, "") #'
            			},
            			{
                				field:'company_id',
                				title:'<?php _e('Company'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(company_id, "") #'
            			},
            			{
                				field:'home_phone',
                				title:'<?php _e('Home Phone'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(home_phone, "") #'
            			},
            			{
                				field:'work_phone',
                				title:'<?php _e('Work Phone'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(work_phone, "") #'
            			},
            			{
                				field:'day_phone',
                				title:'<?php _e('Day Phone'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(day_phone, "") #'
            			},
            			{
                				field:'evening_phone',
                				title:'<?php _e('Evening Phone'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(evening_phone, "") #'
            			},
            			{
                				field:'mobile',
                				title:'<?php _e('Mobile'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(mobile, "") #'
            			},
            			{
                				field:'fax',
                				title:'<?php _e('Fax'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(fax, "") #'
            			},
            			{
                				field:'address',
                				title:'<?php _e('Address'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(address, "") #'
            			},
            			{
                				field:'gender',
                				title:'<?php _e('Gender'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(gender, "") #'
            			},
            			{
                				field:'country_id',
                				title:'<?php _e('Country'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(country_id, "") #'
            			},
            			{
                				field:'state_id',
                				title:'<?php _e('State'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(state_id, "") #'
            			},
            			{
                				field:'city_id',
                				title:'<?php _e('City'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(city_id, "") #'
            			},
            			{
                				field:'zip_code_id',
                				title:'<?php _e('Zip Code'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(zip_code_id, "") #'
            			},
            			{
                				field:'attorney_id',
                				title:'<?php _e('Attorney'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(attorney_id, "") #'
            			},
            			{
                				field:'date_of_record',
                				title:'<?php _e('Date Of Record'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(date_of_record, "") #'
            			},
            			{
                				field:'referred_by',
                				title:'<?php _e('Referred By'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(referred_by, "") #'
            			},
            			{
                				field:'active',
                				title:'<?php _e('Active'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(active, "") #'
            			},
            			{
                				field:'inserter_id',
                				title:'<?php _e('Inserter'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(inserter_id, "") #'
            			},
            			{
                				field:'insert_date',
                				title:'<?php _e('Insert Date'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(insert_date, "") #'
            			},
            			{
                				field:'updater_id',
                				title:'<?php _e('Updater'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(updater_id, "") #'
            			},
            			{
                				field:'update_date',
                				title:'<?php _e('Update Date'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(update_date, "") #'
            			},
            			{
                				field:'height',
                				title:'<?php _e('Height'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(height, "") #'
            			},
            			{
                				field:'weight',
                				title:'<?php _e('Weight'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(weight, "") #'
            			},
            			{
                				field:'hair_color',
                				title:'<?php _e('Hair Color'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(hair_color, "") #'
            			},
            			{
                				field:'eye_color',
                				title:'<?php _e('Eye Color'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(eye_color, "") #'
            			},
            			{
                				field:'date_of_birth',
                				title:'<?php _e('Date Of Birth'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(date_of_birth, "") #'
            			},
            			{
                				field:'birth_country',
                				title:'<?php _e('Birth Country'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(birth_country, "") #'
            			},
            			{
                				field:'birth_state',
                				title:'<?php _e('Birth State'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(birth_state, "") #'
            			},
            			{
                				field:'birth_city',
                				title:'<?php _e('Birth City'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(birth_city, "") #'
            			},
            			{
                				field:'nationality',
                				title:'<?php _e('Nationality'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(nationality, "") #'
            			},
            			{
                				field:'race',
                				title:'<?php _e('Race'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(race, "") #'
            			},
            			{
                				field:'ssn',
                				title:'<?php _e('Ssn'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(ssn, "") #'
            			},
            			{
                				field:'passport',
                				title:'<?php _e('Passport'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(passport, "") #'
            			},
            			{
                				field:'passport_country_id',
                				title:'<?php _e('Passport Country'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(passport_country_id, "") #'
            			},
            			{
                				field:'date_passport_expires',
                				title:'<?php _e('Date Passport Expires'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(date_passport_expires, "") #'
            			},
            			{
                				field:'marital_status_id',
                				title:'<?php _e('Marital Status'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(marital_status_id, "") #'
            			},
            			{
                				field:'previous_marriages_count',
                				title:'<?php _e('Previous Marriages Count'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(previous_marriages_count, "") #'
            			},
            			{
                				field:'date_married',
                				title:'<?php _e('Date Married'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(date_married, "") #'
            			},
            			{
                				field:'place_married',
                				title:'<?php _e('Place Married'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(place_married, "") #'
            			}
                    ]
                }

            }
        );      
        userGrid = $('#userGrid').data('kendoGrid');

    });
</script>