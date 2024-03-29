<?php echo js('kendo.web.min.js'), css('kendo.default.min.css'); ?>
<div id="grid"></div>
            <script>
                $(document).ready(function() {
                    $("#grid").kendoGrid({
                        dataSource: {
                            type: "json",
                            transport: {
                                read: "<?php echo admin_url('country/kendo'); ?>"
                            },
                            schema: {
                                model: {
                                    fields: {
                                        country_name: { type: "string" },
                                        country_seo: { type: "string" }
                                        /*ShipName: { type: "string" },
                                        OrderDate: { type: "date" },
                                        ShipCity: { type: "string" }*/
                                    }
                                }
                            },
                            pageSize: 10,
                            serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true
                        },
                        scrollable: {
                                virtual: false
                            },
                        //height: 250,
                        filterable: true,
                        sortable: true,
                        pageable: true,
                        columns: [
                            {
                                field:"country_name",
                                title:"Country Name",
                                filterable: true
                            },
                            {
                                field:"country_seo",
                                title:"Country Seo",
                                filterable: true
                            }
                        ]
                    });
                });
            </script>


<!-- View -->
 <div id="view">
   <!-- The value of the INPUT element is bound to the "firstName" field of the View-Model.
   When the value changes so will the "firstName" field and vice versa.  -->
   <label>First Name:<input data-bind="value: firstName" /></label>
   <!-- The value of the INPUT element is bound to the "lastName" field of the View-Model.
   When the value changes so will the "lastName" field and vice versa.   -->
   <label>Last Name:<input data-bind="value: lastName" /></label>
   <!-- The click event of the BUTTON element is bound to the "displayGreeting" method of the View-Model.
   When the user clicks the button the "displayGreeting" method will be invoked.  -->
   <button data-bind="click: displayGreeting">Display Greeting</button>
 </div>
 <script>
   // View-Model
   var viewModel = kendo.observable({
      firstName: "John",
      lastName: "Doe",
      displayGreeting: function() {
          // Get the current values of "firstName" and "lastName"
          var firstName = this.get("firstName");
          var lastName = this.get("lastName");
          alert("Hello, " + firstName + " " + lastName + "!!!");
      }
   });

   // Bind the View to the View-Model
   kendo.bind($("#view"), viewModel);
 </script>
<br />
<br />
<br />
<br />
<br />
<div class="section">
    <div class="row">
        <div class="span12">
            <h2 class ="ico-mug"><?php echo $page_title; ?>
                <?php echo anchor($edit_url, __('Add New'), 
                        'title="'.('Add New').'" class="btn btn-primary btn-small modal-for-grid" 
                            data-modal-size="max-max" data-modal-name="countryModal" data-update-grid="countryGrid"'); ?>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <div class="section-padding">
                <table class="table" id="countryGrid">
                    <thead>
                        <tr>           
                            <th><?php _e('Processes'); ?></th>
                            <th>Country Name</th>
<th>Country Seo</th>

                        </tr>
                    </thead>
                    <tbody></tbody>    
                </table>
            </div>
        </div>
    </div>
</div>
