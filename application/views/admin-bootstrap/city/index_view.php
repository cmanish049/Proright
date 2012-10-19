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
                            <div id="cityGrid"></div>
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
    'grid_name' => 'city'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'quickview_modal_size' => '600-max',
    'grid_name' => 'city'
)); 
?>

<script type="text/x-kendo-template" id="city-quickview-template">
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
                    <td><strong><?php _e('City Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('city_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Country'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('country_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('State'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('state_name'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var cityGrid;
    var countries = jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_countries)); ?>');
    var states = jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_states)); ?>');
    
    $(function() {
                
        grid(
            $('#cityGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'city_id',
                    fields: {
                        actions:{},
                        city_name: { type: 'string' },
                        country_id: { field:'country_id' },
                        state_id: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#city-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#city-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false,
                            columnMenu : true
                        },
                        
            			{
                				field:'city_name',
                				title:'<?php _e('City Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(city_name, "") #'
            			},
            
            			{
                				//field: "CategoryID", width: "150px", values: categories, title: "Category"
                                field: 'country_id',
                				title:'<?php _e('Country'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(country_name, "") #',
                                values: countries
            			},
            
            			{
                				field:'state_id',
                				title:'<?php _e('State'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(state_name, "") #',
                                values : states
            			}
           
                    ]
                }

            }
        );      
        cityGrid = $('#cityGrid').data('kendoGrid');

    });
</script>