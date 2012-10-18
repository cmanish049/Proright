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
                    <td><?php echo kendouiDataItemTemplateString('user_type_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Unique Key'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('unique_key'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Username'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('username'); ?></td>
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
                    <td><strong><?php _e('Home Phone'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('home_phone'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Work Phone'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('work_phone'); ?></td>
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
                    <td><?php echo kendouiDataItemDateTimeTemplateString('insert_date'); ?></td>
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
                				width: 100,
                				template : '#= isnull(user_type_name, "") #',
                                values : jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_user_types)); ?>')
            			},
            			{
                				field:'unique_key',
                				title:'<?php _e('Unique Key'); ?>',
                				filterable: true,
                				width: 260,
                				template : '#= isnull(unique_key, "") #'
            			},
            			{
                				field:'full_name',
                				title:'<?php _e('Name'); ?>',
                				filterable: true,
                				width: 300,
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
                				template : '#if(gender=="1"){# <?php _e('Male') ?> #}else if(gender==2){# <?php _e('Female') ?>#}#',
                                values : jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_genders)); ?>')
            			},
            			{
                				field:'country_id',
                				title:'<?php _e('Country'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(country_name, "") #',
                                values : jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_countries)); ?>')
            			},
            			{
                				field:'state_id',
                				title:'<?php _e('State'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(state_name, "") #',
                                values : jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_states)); ?>')
            			},
            			{
                				field:'city_name',
                				title:'<?php _e('City'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(city_name, "") #'
            			},
            			{
                				field:'zip_code_id',
                				title:'<?php _e('Zip Code'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(zip_code, "") #'
            			},
            			{
                				field:'attorney_id',
                				title:'<?php _e('Attorney'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(attorney_id, "") #'
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
                				template : "<?php echo kendouiDataItemDateTimeTemplateString('insert_date') ?>"
            			}
                    ]
                }

            }
        );      
        userGrid = $('#userGrid').data('kendoGrid');

    });
</script>