<div class="section">
    <div class="row">
        <div class="span12">
            <h2 class ="ico-mug"><?php echo $page_title; ?>
                <?php echo anchor($edit_url, __('Add New'), 
                        'title="'.('Add New').'" class="btn btn-primary btn-small modal-for-grid" 
                            data-modal-size="max-max" data-modal-name="auth_moduleModal" data-update-grid="auth_moduleGrid"'); ?>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <div class="section-padding">
                <table class="table" id="auth_moduleGrid">
                    <thead>
                        <tr>           
                            <th><?php _e('Processes'); ?></th>
                            <th>Module Code</th>
<th>Module Name</th>
<th>Module Single Label</th>
<th>Module Plural Label</th>
<th>Parent Id</th>
<th>Module Url</th>
<th>Active</th>
<th>Show In Menu</th>
<th>Show In Form</th>
<th>Sequence Number</th>

                        </tr>
                    </thead>
                    <tbody></tbody>    
                </table>
            </div>
        </div>
    </div>
</div>





