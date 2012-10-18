<?php 
$container_tag_selector = $this->input->get('container_tag_id'); 
$container_tag_selector = $container_tag_selector?"#$container_tag_selector":'body';
?>

<?php if($this->input->get('show_only_grid')=='1'): ?>
<div class="grid-container">
    <div id="emailGrid"></div>
</div>
<?php else: ?>
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
                            <div id="emailGrid"></div>
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
    'grid_name' => 'email'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'email'
)); 
?>


<script type="text/javascript">
    var emailGrid;
    var containerTagObj = $('<?php echo $container_tag_selector; ?>');
    $(function() {
        grid(
            containerTagObj.find('#emailGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'email_id',
                    fields: {
                        actions:{},
                        matter_id: { type: 'number' },
                        email_subject: { type: 'string' },
                        email_body: { type: 'string' },
                        email_template_id: { type: 'number' },
                        inserter_id: { type: 'number' },
                        insert_date: { type: 'date' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#email-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#email-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
                			{
                    				field:'matter_id',
                    				title:'<?php _e('Matter'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(matter_id, "") #'
                			},
                			{
                    				field:'email_subject',
                    				title:'<?php _e('Email Subject'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(email_subject, "") #'
                			},
                			{
                    				field:'email_body',
                    				title:'<?php _e('Email Body'); ?>',
                    				filterable: true,
                    				//width: 200,
                    				template : '<div style="max-height:80px;overflow:hidden">#= isnull(email_body, "") #</div>',
                                    encoded:false
                			},
                			{
                    				field:'email_template_id',
                    				title:'<?php _e('Email Template'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(email_template_id, "") #'
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
                    				template: "<?php echo kendouiDataItemDateTemplateString('insert_date'); ?>"
                			}
                    ]
                }

            }
        );      
        emailGrid = $('#emailGrid').data('kendoGrid');

    });
</script>


<script type="text/x-kendo-template" id="email-quickview-template">
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
                        <td><strong><?php _e('Matter'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('matter_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Email Subject'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('email_subject'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Email Body'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('email_body'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Email Template'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('email_template_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Inserter'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('inserter_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Insert Date'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('insert_date'); ?></td>
                 	</tr>

            </tbody>
        </table>        
    </div>
</script>
