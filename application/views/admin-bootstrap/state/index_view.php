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
                            <div id="stateGrid"></div>
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
    'grid_name' => 'state'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'state'
)); 
?>

<script type="text/x-kendo-template" id="state-quickview-template">
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
                    <td><strong><?php _e('State Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('state_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Country'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('country_name'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var stateGrid;
    var countries = jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_countries)); ?>');
    
    $(function() {
        grid(
            $('#stateGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'state_id',
                    fields: {
                        actions:{},
                        state_name: { type: 'string' },
                        country_id: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#state-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#state-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'state_name',
                				title:'<?php _e('State Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(state_name, "") #'
            			},
            
            			{
                				field:'country_id',
                				title:'<?php _e('Country'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(country_name, "") #',
                                values : countries
            			}
           
                    ]
                }

            }
        );      
        stateGrid = $('#stateGrid').data('kendoGrid');

    });
</script>