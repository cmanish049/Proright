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
                    <div class="section-top-padding">
                        <?php
                        echo flash_data_alert_admin();
                        echo form_alert_admin();
                        echo alert_admin($error, 'error');
                        echo alert_admin($success, 'success');
                        echo alert_admin($warning, 'warning');
                        ?>
                        
                        <?php $this->template->view('matter_linked_client_type/form_view'); ?>

                    </div>
                </div>

                <div class="box-footer">

                </div>
            </div>
        </div>
    </div>        
</div>