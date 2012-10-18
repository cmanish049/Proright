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
                            <div id="countryGrid"></div>
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
    'grid_name' => 'country'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'country'
)); 
?>

<script type="text/x-kendo-template" id="country-quickview-template">
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
                    <td><strong><?php _e('Country Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('country_name'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var countryGrid;
    
    $(function() {
        grid(
            $('#countryGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'country_id',
                    fields: {
                        actions:{},
                        country_name: { type: 'string' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#country-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#country-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'country_name',
                				title:'<?php _e('Country Name'); ?>',
                				filterable: true,
                				width: '80%',
                				template : '#= isnull(country_name, "") #'
            			}
           
                    ]
                }

            }
        );      
        countryGrid = $('#countryGrid').data('kendoGrid');

    });
</script>