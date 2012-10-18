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
                        <div id='calendar'></div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>

<div id='loading' style='display:none'>loading...</div>
<script type='text/javascript'>

    $(document).ready(function() {
	
        $('#rerenderEvents').click(function(){
            $('#calendar').fullCalendar( 'rerenderEvents' );
            return false;
        });
        $('#refetchEvents').click(function(){
            $('#calendar').fullCalendar( 'refetchEvents' )
            return false;
        });
        $('#renderEvent').click(function(){            
            $('#calendar').fullCalendar( 'renderEvent', 
                {"id":252,"title":"Event1","start":"2012-10-10 13:10","end":"2012-10-10 15:10","className":"","color":"red","textColor":"white","editable":true}
            );
            return false;
        });
        
        $('#render').click(function(){            
            $('#calendar').fullCalendar( 'render');
            return false;
        });
        
        $('#addEventSource').click(function(){            
            $('#calendar').fullCalendar( 'addEventSource', 
            'https://www.google.com/calendar/embed?src=usa__en@holiday.calendar.google.com'
        );
            return false;
        });
    
        $('#calendar').fullCalendar({
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
                console.log(element);
                console.log(event);
            },
            events: '<?php echo admin_url('sample/events'); ?>',
            eventMouseover : function( event, jsEvent, view ) { },
            eventClick: function(event) {
                var url = adminUrl + 'sample/events/id/'+event.id;
                var _dialog = {
                    title : '', 
                    modal : true,
                    iframe : false,
                    content:url,
                    activate : function(){
                        
                    }
                };
                uiDialog({
                    varName:'eventModal',
                    type:'inline',
                    dialog:_dialog
                }); 
                
                return false;
            },
            eventDrop: function(event, delta) {				
                console.log(event);
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
            
            /*selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                var url = adminUrl + 'sample/event';
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
                    }
                };
                uiDialog({
                    varName:'eventModal',
                    type:'inline',
                    dialog:_dialog
                }); 
                
                
//                calendar.fullCalendar('renderEvent',
//                    {
//                        title: title,
//                        start: start,
//                        end: end,
//                        allDay: allDay
//                    },
//                    true // make the event "stick"
//                );
                $('#calendar').fullCalendar('unselect');
            },*/
    
            dayClick: function(date, allDay, jsEvent, view) {

                console.log(date);
                console.log(allDay);
                console.log(jsEvent);
                console.log(view);

                // change the day's background color just for fun
                //$(this).css('background-color', 'red');

            },
            viewDisplay: function(view) {
                console.log('The new title of the view is ' + view.title);
            }

        });
		
    });

</script>