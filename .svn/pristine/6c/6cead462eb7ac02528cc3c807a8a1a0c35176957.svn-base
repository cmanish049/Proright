<div class="section corners">
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
                            <div id="zip_codeGrid"></div>
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
    'grid_name' => 'zip_code'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'zip_code'
)); 
?>

<script type="text/x-kendo-template" id="zip_code-quickview-template">
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
                    <td><strong><?php _e('Zip Code'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('zip_code'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Area Code'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('area_code'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Country'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('country_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('State'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('state_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('City'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('city_name'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var countries = jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_countries)); ?>');
    var states = jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_states)); ?>');
    
    var zip_codeGrid;    
    $(function() {
        grid(
            $('#zip_codeGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'zip_code_id',
                    fields: {
                        actions:{},
                        zip_code: { type: 'string' },
                        area_code: { type: 'string' },
                        country_id: { type: 'number' },
                        state_id: { type: 'number' },
                        city_id: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#zip_code-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#zip_code-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'zip_code',
                				title:'<?php _e('Zip Code'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(zip_code, "") #'
            			},
            
            			{
                				field:'area_code',
                				title:'<?php _e('Area Code'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(area_code, "") #'
            			},
            
            			{
                				field:'country_id',
                				title:'<?php _e('Country'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(country_name, "") #',
                                values : countries
            			},
            
            			{
                				field:'state_id',
                				title:'<?php _e('State'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(state_name, "") #',
                                values : states
            			},
            
            			{
                				field:'city_name',
                				title:'<?php _e('City'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(city_name, "") #'
            			}
           
                    ]
                }

            }
        );      
        zip_codeGrid = $('#zip_codeGrid').data('kendoGrid');

    });
</script>