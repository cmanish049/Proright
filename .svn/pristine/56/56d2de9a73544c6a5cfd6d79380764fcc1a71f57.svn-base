<?php 
$container_tag_selector = $this->input->get('container_tag_id'); 
$container_tag_selector = $container_tag_selector?"#$container_tag_selector":'body';
?>


<?php if($this->input->get('show_only_grid')=='1'): ?>
<div class="grid-container">
    <div id="{single_name}Grid"></div>
</div>
<?php else: ?>
    
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
                            <div id="{single_name}Grid"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php 
$this->template->view('templates/kendo_grid_toolbar_template',array(
    'edit_modal_size' => 'max-max',
    'grid_name' => '{single_name}'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => '{single_name}'
)); 
?>



<script type="text/javascript">    
    var containerTagObj = $('<?php echo $container_tag_selector; ?>');
    $(function() {
        grid(
            containerTagObj.find('#{single_name}Grid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'{primary_key}',
                    fields: {
                        actions:{},{grid_models_script}
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#{single_name}-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#{single_name}-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        {grid_columns_script}
                    ]
                }

            }
        );              

    });
</script>


<script type="text/x-kendo-template" id="{single_name}-quickview-template">
    <div id="quickview-container">
        <table class="quickview-grid">
            <thead>
                <tr>
                    <th class="label"><?php _e('Label'); ?></th>
                    <th class="value"><?php _e('Value'); ?></th>
                </tr>
            </thead>
            <tbody>  
                {quick_view_rows}
            </tbody>
        </table>        
    </div>
</script>