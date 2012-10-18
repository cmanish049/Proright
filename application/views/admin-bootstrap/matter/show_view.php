<?php ?>

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
                        <div class="row-fluid">
                            <div class="span6">
                                <ul class="detail-list">
                                    <li>
                                        <label><?php _e('Matter Name') ?></label>
                                        <span><?php echo $row->matter_name; ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('Matter Type') ?></label>
                                        <span><?php echo $row->matter_type_name; ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('Case Number') ?></label>
                                        <span><?php echo $row->case_number; ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('Court Case Number') ?></label>
                                        <span><?php echo $row->court_case_number; ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('Attorney') ?></label>
                                        <span><?php echo $row->attorney_name; ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('Court Name') ?></label>
                                        <span><?php echo $row->court_name; ?></span>
                                    </li>
                                    
                                </ul>
                                
                            </div>
                            <div class="span6">
                                <ul class="detail-list">
                                    <li>
                                        <label><?php _e('Open Date') ?></label>
                                        <span><?php echo get_date_string($row->open_date); ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('Close Date') ?></label>
                                        <span><?php echo get_date_string($row->close_date); ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('İs Closed') ?></label>
                                        <span><?php echo ($row->is_closed == 1) ? __('Yes') : __('No');?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('İnserter') ?></label>
                                        <span><?php echo $row->inserter_name; ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('İnsert Date') ?></label>
                                        <span><?php echo get_date_string($row->insert_date); ?></span>
                                    </li>
                                    <li>
                                        <label><?php _e('Description') ?></label>
                                        <span><?php echo $row->description; ?></span>
                                    </li>
                                </ul> 
                            </div>
                        </div>                        
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>

            <div id="details-container">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var urlList = [
        {
            id : 'detail-matter-linked-client',
            url : '<?php echo admin_url("matter_linked_client/index?matter_id=$row->matter_id"); ?>'
        },
        {
            id : 'detail-matter-note',
            url : '<?php echo admin_url("matter_note/index?matter_id=$row->matter_id"); ?>'
        },
        {
            id : 'detail-matter-email',
            url : '<?php echo admin_url("email/index?matter_id=$row->matter_id"); ?>'
        },
        {
            id : 'detail-matter-document',
            url : '<?php echo admin_url("matter_document/index?matter_id=$row->matter_id"); ?>'
        }
    ];
    
    $(function(){
        var detailsContainerObj = $('#details-container');
        $.each(urlList,function(i,e){
            $.ajax({
                url : e.url,
                dataType : 'html',
                cache : false,
                data : {
                    //show_only_grid : 1
                },
                beforeSend : function(){
                    var obj = $('<div id="'+e.id+'" class="detail-container"></div>');
                    obj.append('<div class="detail-loading-container radius"><div class="k-loading-image"></div></div>');
                    detailsContainerObj.append(obj);
                },
                success : function(html){
                    var obj = $(html);
                    $('#'+e.id).find('.detail-loading-container').remove();
                    $('#'+e.id).append(obj);
                    init(obj);
                }
            });
        })
    });
</script>