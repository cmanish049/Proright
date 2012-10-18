<style type="text/css">
    #loading {
        position: absolute;
        top: 5px;
        right: 5px;
    }
    #calendar {background-color: #fff}
</style>
<a href="#" id="rerenderEvents">rerenderevents</a>
<a href="#" id="refetchEvents">refetchEvents</a>
<a href="#" id="renderEvent">renderEvent</a>
<a href="#" id="render">render</a>

<?php 
$container_tag_selector = $this->input->get('container_tag_id'); 
$container_tag_selector = $container_tag_selector?"#$container_tag_selector":'body';
?>

<?php if($this->input->get('show_only_grid')=='1'): ?>
<div class="section-padding">
    <div id="calendar"></div>
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
                        <div id='calendar'></div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<div id='loading' style='display:none'>loading...</div>
<script type='text/javascript'>
    var containerTagObj = $('<?php echo $container_tag_selector; ?>');
    var calendarObj = containerTagObj.find('#calendar');
    
    $(document).ready(function() {
        
        calendarObj.fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            theme:false,
            editable: true,
            allDayDefault : false,
            //eventColor: '#378006',
            eventRender: function(event, element) {
                                
                /*element.find('.fc-event-inner')
                    .prepend('<img src="'+event.icon_path+'" title="'+event.category_name+'" class="fc-event-category-icon">');*/
                //                console.log(element);
                //                console.log(event);
            },
            events: '<?php echo admin_url('event/events'); ?>',
            eventMouseover : function( event, jsEvent, view ) { },
            eventClick: function(event) {                
                var url = adminUrl + 'event/edit/id/'+event.id;
                openEdit({
                    url : url,
                    mode : 'edit',
                    id : event.id
                });
                //openEdit(start, end, allDay);
                
                return false;
            },
            eventDrop: function(event, delta) {				
                //console.log(event);
            },
            /*eventRender: function(event, element) {
                element.qtip({
                    content: event.description
                });
            },*/
            loading: function(bool) {
                if (bool) $('#loading').show();
                else $('#loading').hide();
            },
            
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {  
                var url = adminUrl + 'event/edit?ref=calendar&start=' + moment(start).unix() + '&end='+moment(end).unix();
                openEdit({
                    url : url,
                    start : start,
                    end : end,
                    allDay : allDay,
                    mode : 'new'
                });                
                
                calendarObj.fullCalendar('unselect');
            },
    
            dayClick: function(date, allDay, jsEvent, view) {

                //                console.log(date);
                //                console.log(allDay);
                //                console.log(jsEvent);
                //                console.log(view);

                // change the day's background color just for fun
                //$(this).css('background-color', 'red');

            },
            viewDisplay: function(view) {
                //console.log('The new title of the view is ' + view.title);
            }

        });
		
    });
    function openEdit(o){
        var url = o.url;
        var mode = o.mode;
        
        var _dialog = {
            title : '', 
            modal : true,
            iframe : false,
            content:url,
            activate : function(){
                        
            },
            refresh  : function(e){
                var windowObj = this;
                windowObj.center();
                var wrapperObj = $(this.wrapper);
                var formObj = this.element.find('form');                                                
                init(this.wrapper);
                
                //on form submit
                formObj.on('submit', function(){
                    if (!formObj.validationEngine('validate')) {
                        return false;
                    }

                    $.ajax({
                        type : 'POST',
                        url : formObj.attr('action'),
                        cache:false,
                        data : formObj.serialize(),
                        dataType : 'json',
                        success:function(json){                    
                            if(json !=null && json != undefined && json.error == 'yes'){
                                formObj.find('.ajax-validation-errors').remove();
                                formObj.prepend('<div class="ajax-validation-errors">'+json.message_html+'</div>');
                                formObj.find('input[type="submit"]').attr('disabled',false);
                                return false;
                            }      
                                        
                            var event = json.row;
                            
                            if (mode=='edit') {
                                calendarObj.fullCalendar( 'removeEvents', o.id );
                            }
                            
                            calendarObj.fullCalendar('renderEvent',
                            {
                                title: event.subject,
                                start: event.begin_date,
                                end: event.end_date,
                                allDay: event.is_all_day==1,
                                id : event.event_id,
                                color : event.category_color
                            },
                            true // make the event "stick"
                        );
                            windowObj.close();
                        }
                    });
                    return false;
                });                
                
                //on click delete button
                wrapperObj.find('.btn-delete-event').on('click',function(){        
                    var confirmMessage = '<?php _e('Are sure to delete?') ?>';
                    if (!confirm(confirmMessage)) {
                        return false;
                    }
                            
                    var thisObj = $(this);
                    var dialogExist = false;
                    $.ajax({
                        type : 'GET',
                        url : thisObj.attr('href'),
                        cache:false,
                        dataType : 'json',
                        success:function(json){
                            if(json !=null && json != undefined && json.error == 'yes'){
                                showAlert(json.message);
                                return false;
                            }
                                    
                            calendarObj.fullCalendar( 'removeEvents', json.id );
                                    
                            var dataModalName = thisObj.attr('data-modal-name');
                            dialogExist = isDialogExist(dataModalName);
                            if (dialogExist) {
                                closeDialog(dataModalName);                                        
                            }
                        }
                    });
                            
                    return false;
                    return dialogExist?false:true;
                });     
            }
        };
        uiDialog({
            varName:'eventModal',
            type:'inline',
            dialog:_dialog
        }); 
    }
    
$(function(){
    
        containerTagObj.find('#rerenderEvents').click(function(){
            calendarObj.fullCalendar( 'rerenderEvents' );
            return false;
        });
        containerTagObj.find('#refetchEvents').click(function(){
            calendarObj.fullCalendar( 'refetchEvents' )
            return false;
        });
        containerTagObj.find('#renderEvent').click(function(){            
            calendarObj.fullCalendar( 'renderEvent', 
            {"id":252,"title":"Event1","start":"2012-10-10 13:10","end":"2012-10-10 15:10","className":"","color":"red","textColor":"white","editable":true}
        );
            return false;
        });
        
        containerTagObj.find('#render').click(function(){            
            calendarObj.fullCalendar( 'render');
            return false;
        });
        
        containerTagObj.find('#addEventSource').click(function(){            
            calendarObj.fullCalendar('addEventSource', 
                'https://www.google.com/calendar/embed?src=usa__en@holiday.calendar.google.com'
            );
            return false;
        });
    
});
</script>