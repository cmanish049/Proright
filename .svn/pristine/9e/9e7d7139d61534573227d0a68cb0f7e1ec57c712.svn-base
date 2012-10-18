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
                            <div id="email_templateGrid"></div>
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
    'grid_name' => 'email_template'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'email_template'
)); 
?>

<script type="text/x-kendo-template" id="email_template-quickview-template">
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
                        <td><strong><?php _e('Email Template Name'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('email_template_name'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Email Template Subject'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('email_template_subject'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Email Template Body'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('email_template_body'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Is Active'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('is_active'); ?></td>
                 	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var email_templateGrid;
    
    $(function() {
        grid(
            $('#email_templateGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'email_template_id',
                    fields: {
                        actions:{},
                        email_template_name: { type: 'string' },
                        email_template_subject: { type: 'string' },
                        email_template_body: { type: 'string' },
                        is_active: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#email_template-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#email_template-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
                			{
                    				field:'email_template_name',
                    				title:'<?php _e('Email Template Name'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(email_template_name, "") #'
                			},
                			{
                    				field:'email_template_subject',
                    				title:'<?php _e('Email Template Subject'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(email_template_subject, "") #'
                			},
                			{
                    				field:'email_template_body',
                    				title:'<?php _e('Email Template Body'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '<div style="max-height:80px;overflow:hidden">#= isnull(email_template_body, "") #</div>',
                                    encoded: false
                			},
                			{
                    				field:'is_active',
                    				title:'<?php _e('Is Active'); ?>',
                    				filterable: true,
                    				width: 100,
                    				template: '<?php echo kendouiDataItemBooleanImageTemplateString('is_active'); ?>'
                			}
                    ]
                }

            }
        );      
        email_templateGrid = $('#email_templateGrid').data('kendoGrid');

    });
</script>