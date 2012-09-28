function init(container){
    
    var collapseButtonHtml = '<i class="icon-chevron-down pull-right button-box-collapse" title="Close content"></i>';
    var collapseButtonObj = $(collapseButtonHtml);
    
    collapseButtonObj.on('click', function(e){
        var thisObj = $(this);
        var boxObj = thisObj.closest('.box');
        var boxContentObj = boxObj.find('.box-content');
		
        thisObj.removeClass('icon-chevron-down');
        thisObj.removeClass('icon-chevron-right');
		
        var isBoxContentVisible = boxContentObj.is(":visible");
		
        //Content Açık ise kapat
        if(isBoxContentVisible){
            thisObj.attr('title','Open content');
            thisObj.addClass('icon-chevron-right');
            boxContentObj.slideUp();
			
            return false;
        }
		
        //content kapalı ise aç
        thisObj.attr('title','Close content');
        thisObj.addClass('icon-chevron-down');
        boxContentObj.slideDown();
		
    });
    container.find('.box .box-header-container').not('.no-collapse').append(collapseButtonObj);

    container.find(".nice-select").select2({
        placeholder: "Please select",
        allowClear: true       
    });
    container.find('.chained-select').on('change',function(){
        var thisObj = $(this);
        var targetObj = $(thisObj.attr('data-target'));
        var url = thisObj.attr('data-url');
        $.ajax({
            url : url,
            dataType : 'json',
            cache : false,
            data : {
                id: thisObj.val(),
                result_type:'option_html'
            },
            success : function(json){
                var html = '<option></option>'+json.html;
                targetObj.html(html);
                targetObj.trigger("liszt:updated");
                targetObj.select2('val','');
            }
        });
    }); 
    
    container.find(".nice-remote-data-select").each(function(i,e){
        var thisObj = $(this);
        var url = thisObj.attr('data-url');
        
        if (!url || url==undefined) {
            alert('data-url attribute not found');
            return false;
        }
        thisObj.select2({
            placeholder: "Please select",
            allowClear: true,
            placeholder: "Search",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: url,
                dataType: 'json',
                data: function (term, page) {               
                    return {
                        q: term, // search term
                        limit: 10,
                        result_type : 'array'
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    
                    if (!data.options || data.options ==undefined) {
                        return {
                            results : {}
                        }
                    }
                    
                    return {
                        results: data.options
                    };
                }
            }
        });
    });
    
    //$.mask.definitions['~']='[+-]';
    var maskPlaceholder = '_';
    container.find(".input-date").kendoDatePicker({
        format : 'yyyy-MM-dd',
        value : new Date()
    }).mask('9999-99-99',{
        placeholder:maskPlaceholder
    });
    
    container.find(".input-datetime").kendoDateTimePicker({
        parseFormats:['yyyy-MM-dd', 'HH:mm'],
        format : 'yyyy-MM-dd HH:mm',
        timeFormat: 'HH:mm',
        value : new Date(),
        interval  : 30
    })
    .mask('9999-99-99 99:99',{
        placeholder:maskPlaceholder
    });
    
    container.find(".input-time").kendoTimePicker({
        format : 'HH:mm',
        value : new Date(),
        interval  : 30
//        max:,
//        min:,
    }).mask('99:99',{
        placeholder:maskPlaceholder
    });
    
    container.find(".input-integer").kendoNumericTextBox({
        format: "0",
        min: 0,
        max: 10,
        step: 1,
        value:0,
        upArrowText: "İncrease value",
        downArrowText: "Decrease value"
    });
    
    container.find('.basic-tooltip').tooltip({
        placement : 'top'
    });        
    
    container.find('.form-validation-engine').validationEngine('attach', {
        promptPosition : "bottomLeft:0,-5", 
        scroll: true,
        autoPositionUpdate:true
        //binded : true
        //showOneMessage
    });
    
    container.on('submit','.form-validation-engine',function(){
        var thisObj = $(this);
        var isValid = thisObj.validationEngine('validate');
        var isAjaxForm = thisObj.hasClass('ajax-form');
        var isAutoCompleteForm = thisObj.hasClass('autocomplete-ajax-form');
     
        if (!isValid) {
            return false;
        }
        else{
            $(this).find('input[type="submit"]').attr('disabled',true);
        }
        
        if (isAjaxForm || isAutoCompleteForm) {            
            
            
            return false;
        }
    });
    
    
    var validator = $(".kendo-form").kendoValidator().data("kendoValidator");    
    $(".kendo-form").find('input[type="submit"]').on('click',function(){

        var isValid = validator.validate();
        
        if (!isValid) {
            var errors = validator.errors();            
            return false;
        }
        
    });
    
    /**
     * Delete butonuna tıklandığında çalışır
     */
    container.on('click','.action-ajax',function() {
        var thisObj = $(this);
        var showConfirm = thisObj.hasClass('show-confirm');
        var confirmMessage = 'Are sure to continue?';
        var isDeleteAction = thisObj.hasClass('action-delete');
        
        if (isDeleteAction) {
            confirmMessage = 'Are sure to delete?';            
        }
        
        if(showConfirm && !confirm(confirmMessage))
            return false;
        
        $.ajax({
            type : 'GET',
            url : thisObj.attr('href'),
            cache:false,
            dataType : 'json',
            success:function(data){
                if(data !=null && data != undefined && data.error == 'yes'){
                    alert(data.message);
                    return false;
                }
                
                if (isDeleteAction) {
                    refreshGrid(getKendoGrid($(thisObj.attr('data-grid-selector'))));
                }
            }
        });
        
        return false;
    });
    
    
    container.on('click','.action-reset-grid',function(){
        var thisObj = $(this);
        var url = thisObj.attr('href');
        
        var kendoGrid = getKendoGrid($(thisObj.attr('data-grid-selector')));
        resetGrid(url, kendoGrid);  
        return false;
    });
    
    container.on('click','.action-quickview',function(){
        var thisObj = $(this);
        var modalSizes = thisObj.attr('data-modal-size');  
        var kendoGrid = getKendoGrid($(thisObj.attr('data-grid-selector')));
        var dataModalName = thisObj.attr('data-modal-name');
        var detailsTemplateSelector = thisObj.attr('data-quickview-template-selector');        
        var gridRowObj = thisObj.closest('tr');
        var dataItem = kendoGrid.dataItem(gridRowObj);
        var detailsTemplate = kendo.template($(detailsTemplateSelector).html());

        modalSizes = modalSizes.split('-');
        var width = modalSizes[0];

        uiDialog({
            varName:dataModalName,
            type:'inline',
            dialog:{
                title : thisObj.attr('title'),
                width : width,  
                content:{
                    template : detailsTemplate(dataItem)
                }
            }
        }); 

        getDialogObj(dataModalName).element.find('.quickview-grid').kendoGrid({
            scrollable:false
        });
        return false;
    });
    
    container.on('click','.btn-cancel-form',function(){
        var thisObj = $(this);
        var dataWindow = thisObj.attr('data-window');
        var dataModalName = thisObj.attr('data-modal-name');
        if (dataWindow=='modal') {
            closeDialog(dataModalName);
            return false;
        }                
    });
        
    container.on('click','.modal-for-grid',function(){
        var thisObj = $(this);
        var dataModalSize = thisObj.attr('data-modal-size');
        var kendoGrid = getKendoGrid($(thisObj.attr('data-grid-selector')));
        var dataModalName = thisObj.attr('data-modal-name');
        
        var _dialog = {
            title : thisObj.attr('title'),
            content : thisObj.attr('href'),
            close:function(e){
                refreshGrid(kendoGrid);                
            }
        };
        
        if (dataModalSize) {
            dataModalSize = dataModalSize.split('-');
            var width = dataModalSize[0];
            var height = dataModalSize[1];
            _dialog.width = width;
            _dialog.height = height;
        }        
        
        uiDialog({
            varName : dataModalName,
            dialog : _dialog
        });
        return false;
        
    });
    
    container.on('click','.open-modal',function(){
        var thisObj = $(this);
        var dataModalSize = $(this).attr('data-modal-size');
        var dataModalName = $(this).attr('data-modal-name');

        var _dialog = {
            title : $(this).attr('title'),
            content : thisObj.attr('href')
        };
        
        if (dataModalSize) {
            dataModalSize = dataModalSize.split('-');
            var width = dataModalSize[0];
            var height = dataModalSize[1];            
            
            _dialog.width = width;
            _dialog.height = height;
        }
        
        uiDialog({
            varName : dataModalName,
            dialog : _dialog
        });
        return false;        
    });
    
    container.on('click','.btn-autocomplete-new',function(){
            var thisObj = $(this);
            var dataModalName = thisObj.attr('data-modal-name');
            var dataModalSize = thisObj.attr('data-modal-size');
            var targetInputObj = $(thisObj.attr('data-target-selector'));
            var url = thisObj.attr('href');                        
            
            var _dialog = {
                title : thisObj.attr('title'), 
                content: url,
                iframe : false,
                modal : true,
                refresh  : function(e){   
                  var windowObj = this;
                  
                  this.element.find('form').addClass('autocomplete-ajax-form');
                  this.element.find('form').on('submit', function(){
                        var formObj = $(this);
                        $.ajax({
                            type : 'POST',
                            url : formObj.attr('action'),
                            cache:false,
                            data : formObj.serialize(),
                            dataType : 'json',
                            success:function(data){                    
                                if(data !=null && data != undefined && data.error == 'yes'){
                                    formObj.find('.ajax-validation-errors').remove();
                                    formObj.prepend('<div class="ajax-validation-errors">'+data.message+'</div>');
                                    formObj.find('input[type="submit"]').attr('disabled',false);
                                    return false;
                                }      

                                var select2Data = {id:data.item.value, text : data.item.text};                                
                                                                
                                if(targetInputObj.is('select')){
                                    var html = '<option value="'+select2Data.id+'">' + select2Data.text +'</option>';                                    
                                    targetInputObj.find('option:first').after(html);                                    
                                    targetInputObj.trigger("liszt:updated");
                                    targetInputObj.select2('val',select2Data.id);
                                }           
                                else{
                                    targetInputObj.select2('data',select2Data);
                                }
                                windowObj.close();
                            }
                        });
                  });
                  init(this.element);
                  
                }
            };
            
            if (dataModalSize) {
                dataModalSize = dataModalSize.split('-');
                var width = dataModalSize[0];
                var height = dataModalSize[1];
                _dialog.width = width;
                _dialog.height = height;
            }   
            
            uiDialog({
                varName:dataModalName,
                type:'inline',
                dialog:_dialog
            }); 
            
            return false;
        });
}


$(function(){  
	
	init($('body'));
    $('.sf-menu').kendoMenu();
    
    /*$('body').on('click','.btn-grid-export',function(){
        var thisObj = $(this);
        var kendoGrid = getKendoGrid($(thisObj.attr('data-grid-selector')));        
        
        var columns = kendoGrid.columns;console.log(columns);
        
       var fields = {};
       $.each(columns,function(i,e){
            if (e.field!=undefined && e.field!='') {
                fields[e.field] = e.title;                
            }                                         
       });
       console.log(fields);
        
        return false;
    });
    */
    });


function isnull(a, b) {
    b = b || '';
    return a || b;
}

var dialogs = {};        
function uiDialog(options){
    var o = {
        varName : 'dialog',
        type : 'iframe',
        tagAttrs : {},
        dialog :{}
    };
    $.extend(o, options);
        	    
    var uiDialogOptions = {
        title: '',
        modal: false,
        visible: true,
        resizable: true,
        width: 980,
        scrollable: false,
        //animation :{open: { effects: 'expand:vertical' }},
        close: function(e){
            
        },
        open : function(e){
            this.wrapper.css('top','30px');
        },
        activate : function(e){
        },
        deactivate: function() {
            this.destroy();                                           
        },
        //maxHeight : maxHeight,
        //iframe:true,
        actions: ['Maximize', 'Close']//'Minimize', 
    };
    $.extend(uiDialogOptions, o.dialog);
    
    var _modalType = (o.type != undefined)?o.type:'inline';
    if (uiDialogOptions.width=='max') {
        var maxWidth = $(window).width() - 100;        
        uiDialogOptions.width = maxWidth;
    }
    
    // || _modalType=='iframe'
    if (uiDialogOptions.height!=undefined && uiDialogOptions.height=='max') {
        var maxHeight = $(window).height() -  100;
        uiDialogOptions.height = maxHeight;
    }
    
    var contentObj,dialogContainerId = 'dialog-container' + parseInt(Math.random()*100);
    if ($('#' + dialogContainerId).length>0) {
        contentObj = $('#'+dialogContainerId);
    }else{
        $('body').append('<div id="'+dialogContainerId+'"></div>');
        contentObj = $('#'+dialogContainerId);
    }    
    
    contentObj.kendoWindow(uiDialogOptions);//create window obj
    var wnd = contentObj.data("kendoWindow");
    window.top.dialogs[o.varName] = wnd;
    wnd.center();     
    wnd.open();
}

function getDialogObj(dialogName){
    return window.top.dialogs[dialogName];
}

function closeDialog(dialogName)
{
    window.top.dialogs[dialogName].close();
    window.top.dialogs[dialogName].destroy();
}

function setPositionDialog(dialogName){
    var pos = getDialogObj(dialogName).wrapper.position();    
    getDialogObj(dialogName).wrapper.css('top',pos.top-30 + 'px');
}

/**
 * Pencere kapatılsınmı sorusu
 */
function bindAlertClosingWindow()
{
    jQuery(window).bind("beforeunload", function(){
        return "Sayfadan ayrılmak istediğinize eminmisiniz";
    });
}
function unbindAlertClosingWindow(selector,event)
{
    jQuery(selector).bind(event,function() {
        jQuery(window).unbind("beforeunload");
    });
}

function clean_autocomplete(selector, target)
{
    var element = $(selector);
    if (element.is('input')) {
        element.val('');
    }
    else{
        element.html('');
    }
    
    element = $(target);
    if (element.is('input')) {
        element.val('');
    }
    else{
        element.html('');
    }
    
    return false;
}

function bindSelect(selector, target, url)
{
    $(selector).on('change',function(){
        $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            data: {
                value :$(this).find('option:selected').attr('value')
            },
            success : function(json){
                $(target).html('');
                var op = [];
                $.each(json,function(i,o){
                    op[i] = '<option value="'+o.value+'">'+o.text+'</option>';
                });
                $(target).append(op.join(''));
                $(target).change();
            }
        });
    });   
}

function gridDataSourceReadAjax(url,options){
    $.ajax( {
        cache : false,
        url : url,
        type:'POST',
        dataType: 'json',
        data: options.data,
        success: function(result) {
            options.success(result);
        }
    });
}

function getKendoGrid(obj){
    return obj.data('kendoGrid');
}

function resetGrid(url,kendoGrid){
    kendoGrid.dataSource.query({
        page:1, 
        pageSize:10,
        skip:0, 
        take:10
    });
}

function refreshGrid(kendoGrid){
    kendoGrid.dataSource.read();
    
    
/*kendoGrid.dataSource.data(
                   dataFromAjax
    );*/
    
//kendoGrid.dataSource.filter({});
//kendoGrid.dataSource.page(1);
//kendoGrid.dataSource.sort({});
//kendoGrid.dataSource.read();
}

function grid(gridObj,o){
    //gridObj, url, model, o
    var dataSource = {
        type: 'json',
        //autoSync: true,
        transport: {
            read : function(options) {
                gridDataSourceReadAjax(o.url,options);
            }
        },
        schema: {            
            total : 'total',
            data : 'rows',
            errors: 'message',
            groups : 'groups'
        },
        //filter : {}, //ajax isteği yapılırken ekstra param gibi düşün
        pageSize: 10,
        pageable: true,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,
        serverGrouping:true
    };
    if (o.datasource != undefined) {
        $.extend(dataSource, o.datasource);
    }
    dataSource.schema.model = o.model;
    
    var gridOptions = {
        dataSource: new kendo.data.DataSource(dataSource),
        //detailInit : function(e){},
        //dataBinding : function(e){},
        dataBound: function(e) {
            //this.element.find('.grid-action-menu').kendoMenu({direction:'bottom',orientation: 'vertical'});
            var thisObj = $(this);   
            var rowsObj = this.element.find("tr[data-uid]");
            var rowsLength = rowsObj.length;
            //rowsObj.slice(rowsLength-4, rowsLength).find('.grid-row-action-menu').addClass('dropup');
            //console.log(this);
            this.element.find('.basic-tooltip').tooltip({
                placement : 'top'
            });
            rowsObj.dblclick(function(e) {
                $(this).find('.action-edit').trigger('click');
            });   
                        
            if (thisObj.data('isFilterMenuSetted')!=true) {
                var dropDowns = $(".k-filter-menu").find("[data-role=dropdownlist]");
                setTimeout(function(){
                    dropDowns.each(function(i,e){                    
                        $(this).data("kendoDropDownList").select(0);
                        $(this).data("kendoDropDownList").trigger('change');
                    });   
                    thisObj.data('isFilterMenuSetted',true);
                });
            }
        },
        groupable:false,
        selectable:'multiple, row',
        scrollable: true,
        /*height:500,*/
        editable : false,
        navigatable: true,
        reorderable: true,
        resizable: true,
        filterable: {
            name: "FilterMenu",
            extra: false, // turns on/off the second filter option
            messages: {
                info: "Show items with value that:",
                isTrue: "is true",
                isFalse: "is false",
                filter: "Filter",
                clear: "Clear",
                and: "And",
                or: "Or",
                selectValue: "-Select value-"
            },
            operators: {
                //filter menu for "string" type columns
                string: {                    
                    contains: "Contains",
                    doesnotcontain: "Does not contain",
                    eq: "Equal to",
                    neq: "Not equal to",
                    startswith: "Starts with",
                    endswith: "Ends with"
                },
                //filter menu for "number" type columns
                number: {
                    eq: "Equal to",
                    neq: "Not equal to",
                    gte: "Is greater than or equal to",
                    gt: "Is greater than",
                    lte: "Is less than or equal to",
                    lt: "Is less than"
                },
                //filter menu for "date" type columns
                date: {
                    eq: "Equal to",
                    neq: "Not equal to",
                    gte: "Is after or equal to",
                    gt: "Is after",
                    lte: "Is before or equal to",
                    lt: "Is before"
                }
            }
        },
        //height: 100,            
        sortable: {
            mode: 'multiple',
            allowUnsort: true
        },        
        pageable: {
            input: false,
            numeric: true,
            refresh: true,
            pageSizes: [5,10,20,30,40,50],
            messages: {
                display: "{0} - {1} of {2} items",
                empty: "No items to display",
                page: "Page",
                of: "of {0}",
                itemsPerPage: "items per page",
                first: "Go to the first page",
                previous: "Go to the previous page",
                next: "Go to the next page",
                last: "Go to the last page",
                refresh: "Refresh"
            }
        },
        /*groupable: {
            messages: {
                empty: "Drag a column header and drop it here to group by that column"
            }
        },*/        
        columnMenu: {
            messages: {
                sortAscending: "Sort Ascending",
                sortDescending: "Sort Descending",
                filter: "Filter",
                columns: "Columns"
            }
        }
    };
    if (o.gridOptions != undefined) {
        $.extend(gridOptions, o.gridOptions);
    }
    
    gridObj.kendoGrid(gridOptions);    
}

var dateFormat = 'yyyy-MM-dd';
var dateTimeFormat = 'yyyy-MM-dd HH:mm';
var dateTimeFormatWithSecond = 'yyyy-MM-dd HH:mm:ss';
var timeFormat = 'HH:mm';
var timeFormatWithSecond = 'HH:mm:ss';

function isValidDateTime(val){
    var timestamp=Date.parseExact(val,dateTimeFormat);
    if (!timestamp || timestamp==null || isNaN(timestamp))
    {
        return false;
    }  
    return true;
}

function isValidDate(val){
    var timestamp=Date.parseExact(val,dateFormat);
    if (!timestamp || timestamp==null || isNaN(timestamp))
    {
        return false;
    }  
    return true;
}

function isValidTime(val){
    var timestamp=Date.parseExact(val,timeFormat);
    if (!timestamp || timestamp==null || isNaN(timestamp))
    {
        return false;
    }  
    return true;
}


/*validasyon*/
function validateDateTime(field, rules, i, options){    
    if (!isValidDateTime(field.val()))
    {
        return options.allrules.validateDateTime.alertText;
    }    
}

function validateDate(field, rules, i, options){    
    if (!isValidDate(field.val()))
    {
        return options.allrules.validateDate.alertText;
    }    
}

function validateTime(field, rules, i, options){
    if (!isValidTime(field.val())) {
        // this allows to use i18 for the error msgs
        return options.allrules.validateTime.alertText;
    }
}

function validateDropdownRequired(field, rules, i, options){    
    field.val('maksat validasyona girsin diye değer attık');
    var selectObj = field.next('select');        
    
    if (!selectObj.val() || selectObj.val()=='') {
        return options.allrules.required.alertText;
    }
}