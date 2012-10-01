<?php
define('ADMIN_CONTROLLER_DIRECTORY', 'admin');

/**
 * Description of class_generator
 *
 * @author Alexander
 */
class class_generator extends Admin_Controller
{
    public $table_name;
    private $table_fields = array();
    private $search_fields = array();
    private $auto_increment;
    public $single_name;
    public $controller_name;
    public $controller_class_name;
    public $model_name;
    public $model_class_name;
    private $db_string_types = array('varchar', 'text', 'longtext', 'char');
    private $db_int_types = array('int', 'tinyint', 'bigint', 'float', 'double', 'decimal', 'numeric');
    private $db_float_types = array('float', 'double', 'decimal', 'numeric');
    private $db_textarea_types = array('text', 'longtext');
    private $db_date_types = array('date','datetime');
    public $messages = array();

    
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL);
        $this->load->helper('file');
        
        
    }

    public function index()
    {
        $this->data['page_title'] = 'Class Oluşturucu';
        $this->data['form_action'] = admin_url('class_generator/index');
        
        /*
        $sql = "SHOW COLUMNS FROM countries";
        $query = $this->db->query($sql);
        $row = $query->row();pre($row);
        echo $row->field;*/
        
        if($_POST)
        {
            /*
            pre($_POST);
            pre(explode("\n", $_POST['joins']));            
            exit;
            */
            $this->table_name = trim(strtolower($this->input->post('table_name')));
            $this->single_name = trim(strtolower($this->input->post('single_name')));
            $this->search_fields = explode(',', trim($this->input->post('search_fields')));

            $this->controller_name = $this->single_name;
            $this->controller_class_name = ucfirst($this->controller_name);

            $this->model_name = "{$this->controller_name}_model";
            $this->model_class_name = ucfirst($this->model_name);

            if($this->db->table_exists($this->table_name))
            {
                $sql = "SHOW COLUMNS FROM $this->table_name";
                $query = $this->db->query($sql);
                $row = $query->row();
                
                $this->table_fields = $this->db->field_data($this->table_name);
                
                /**
                 * set fields is null 
                 */
                $sql = "SHOW COLUMNS FROM $this->table_name ";
                $query = $this->db->query($sql);
                $fields = $query->result();
                foreach($this->table_fields as $key => $e)
                {
                    foreach($fields as $f)
                    {
                        if($f->Field==$e->name)
                        {
                            $e->null = $f->Null;
                            $this->table_fields[$key] = $e;
                        }
                    }
                }
                
                $this->set_auto_increment();

                if(is_input_checked('controller'))
                {
                    $this->generate_controller();
                }

                if(is_input_checked('model'))
                {
                    $this->generate_model();
                }

                if(is_input_checked('views'))
                {
                    $this->generate_views();
                }
            }
            else
            {
                $this->messages[] = 'Tablo veritabanında bulunamadı.';
            }
        }

        $this->data['messages'] = $this->messages;

        $this->template->view_parts('content', 'class_generator/index_view', $this->data)
                ->title('Class oluşturucu')
                ->build();
    }

    public function set_auto_increment()
    {
        foreach($this->table_fields as $key => $e)
        {
            if($e->primary_key)
            {
                $this->auto_increment = $e->name;
                break;
            }
        }
    }

    public function generate_controller()
    {
        $path_controller = APPPATH . "controllers/" . ADMIN_CONTROLLER_DIRECTORY . "/{$this->controller_name}.php";
        $template_controller = read_file('class_templates/controller_template.php');

        $template_db_data = "'{field_name}' => " . '$this->input' . "->post('{field_input_name}', TRUE),";
        $template_validation_rule = "array(
            'field' => '{field_name}',
            'label' => __('{field_label}'),
            'rules' => 'trim|max_length[{size}]|numeric|required'
        ),";

        $db_string_types = $this->db_string_types;
        $db_int_types = $this->db_int_types;

        $str_validation_rules = '';
        $str_db_data = '';
        $str_col_sort_params = "'',";
        $str_col_widths = "'100px',";
        $col_width_percent = ceil(90 / (count($this->table_fields) - 1));
        foreach($this->table_fields as $key => $e)
        {
            $field_name = $e->name;
            $type = $e->type;
            $max_length = $e->max_length;
            $is_primary_key = $e->primary_key;

            if($is_primary_key)
            {
                continue;
            }            
            
            $str_col_sort_params .= "'$field_name',";
            $str_col_widths .= "'$col_width_percent%',";

            //db_table dizisi string
            $search = array('{field_name}','{field_input_name}');
            $replace = array(strtolower($field_name),strtolower($field_name));
            $str_db_data .= str_replace($search, $replace, $template_db_data) . "\n";

            //validasyon kuralları string
            $search = array('{field_name}', '|max_length[{size}]', '|numeric', '|required', '{field_label}');
            $replace = array(
                strtolower($field_name),
                (in_array($type, $db_string_types) && $max_length > 0) ? "|max_length[{$max_length}]" : '',
                (in_array($type, $db_int_types)) ? '|numeric' : '',
                $e->null=='NO' ? '|required' : '',
                str_replace('_', ' ', humanize($field_name)),
            );
            $str_validation_rules .= str_replace($search, $replace, $template_validation_rule) . "\n";
        }
        $str_col_sort_params = substr_replace($str_col_sort_params, '', -1);
        $str_col_widths = substr_replace($str_col_widths, '', -1);

        //controller dosyasını oluştur
        $search = array('{class_name}', '{controller_name}', '{modul_name}', '{model_name}',
            '{single_name}', '{db_data}', '{validation_rules}', '{col_sort_params}', '{col_widths}','{auto_increment}');
        $replace = array(
            $this->controller_class_name,
            $this->controller_name,
            $this->single_name,
            $this->model_name,
            $this->single_name,
            $str_db_data,
            $str_validation_rules,
            $str_col_sort_params,
            $str_col_widths,
            $this->auto_increment
        );
        $str = str_replace($search, $replace, $template_controller);
       
        $overwrite = (boolean)$this->input->post('overwrite');
        if($overwrite!==TRUE && file_exists($path_controller))
        {
            $this->messages[] = $path_controller . ' dosyası zaten oluşturulmuş<br/>';
        }
        elseif(write_file($path_controller, $str))
        {
            $this->messages[] = "$path_controller => Başarılı";
        }
    }

    public function generate_model()
    {
        $path_model = APPPATH . "models/{$this->model_name}.php";
        $template_model = read_file('class_templates/model_template.php');

        #joins
        $str_vars = '';
        $str_vars_set_values = '';
        $str_join_callbacks = '';
        $str_add_search_fields = '';       
        $str_add_search_fields = $this->input->post('extra_join_fields');
        
        
        $template_join_callback = '
    public function callback_join_{funcname}($extra=array())
    {
        $this->join_select[] = "{as}.*";
        $this->db->join("$this->{table_var_name} {as}","$this->as.{join_field_1}={as}.{join_field_2}", \'LEFT\');
    }            
        ';
        
        $joins_array = explode("\n", $this->input->post('joins'));        
        foreach($joins_array as $e)
        {
            #table_name, join_fields(country_id,country_id), select_str
            $join_table_info_array = explode('@', $e);
            array_walk($join_table_info_array, 'trim');
           
            if(count($join_table_info_array)<2)
            {
                continue;
            }
            $table_name = $join_table_info_array[0];
            $joined_fields = explode(',', $join_table_info_array[1]);
            //$select_statement = $join_table_info_array[2];
            
            $str_vars .= '
    private $' . strtolower($table_name) . ";";
            $str_vars_set_values .= '
        $this->' . strtolower($table_name) . " = self::table_name('$table_name'); " ;    
            
            
            $search = array('{funcname}','{as}', '{table_var_name}', '{join_field_1}', '{join_field_2}');
            $replace = array(
                strtolower($table_name),
                strtoupper($table_name),
                strtolower($table_name),
                $joined_fields[0],
                $joined_fields[1]
            );
            $str = str_replace($search, $replace, $template_join_callback); 
            $str_join_callbacks .= $str;
        }
        
        #model dosyasını oluştur
        $search = array('{model_class_name}', '{table_name}', '{primary_key}', '{search_fields}',
            '{vars}','{vars_set_values}','{join_callbacks}','{add_search_fields}');
        $replace = array(
            $this->model_class_name,
            strtolower($this->table_name),
            strtolower($this->auto_increment),
            strtolower(implode(',', $this->search_fields)),
            $str_vars,
            $str_vars_set_values,
            $str_join_callbacks,
            $str_add_search_fields
        );
        $str = str_replace($search, $replace, $template_model);                
        
        $overwrite = (boolean)$this->input->post('overwrite');
        if($overwrite!==TRUE && file_exists($path_model))
        {
            $this->messages[] = $path_model . ' dosyası zaten oluşturulmuş<br/>';
        }
        elseif(write_file($path_model, $str))
        {
            $this->messages[] = "$path_model => Başarılı";
        }
    }

    public function generate_views()
    {
        $path_view_index = APPPATH . "views/admin-bootstrap/{$this->controller_name}/index_view.php";
        //$path_view_grid = APPPATH . "views/admin-bootstrap/{$this->controller_name}/grid_view.php";
        $path_view_form = APPPATH . "views/admin-bootstrap/{$this->controller_name}/form_view.php";
        $path_view_edit = APPPATH . "views/admin-bootstrap/{$this->controller_name}/edit_view.php";

        $template_view_form = read_file('class_templates/views/form_view.php');
        $template_view_edit = read_file('class_templates/views/edit_view.php');
        //$template_view_grid = read_file('class_templates/views/grid_view.php');
        $template_view_index = read_file('class_templates/views/index_view.php');

        $template_input_controls = '            
                <div class="control-group">
                    <label class="control-label form-lbl" for="{field_name}"><?php _e(\'{field_label}\') ?></label>
                    <div class="controls">
                        <?php echo form_input(\'{field_name}\',  
                        set_value(\'{field_name}\', object_element(\'{field_name}\', $row)), 
                        \'class="validate[{validation_rules}] input-xlarge {input_class}" id="{controller_name}_{field_name}" tabindex="{tabindex}" \'); ?>
                    </div>
                </div>                
        ';

        $template_input_textarea = '
            <div class="control-group">
                <label class="control-label form-lbl" for="{field_name}"><?php _e(\'{field_label}\') ?></label> 
                <div class="controls">
                    <?php echo form_textarea(array(\'name\' => \'{field_name}\', \'rows\' => 5, \'cols\' => 40), 
                                    set_value(\'{field_name}\', (object_element(\'{field_name}\', $row))), 
                                    \'class="validate[{validation_rules}] input-xlarge js-editor {input_class}" id="{controller_name}_{field_name}" tabindex="{tabindex}"\'); ?>
                </div>                
            </div>';

        $template_input_dropdown = '
            <div class="control-group">
                <label class="control-label form-lbl" for="{field_name}"><?php _e(\'{field_label}\') ?></label>
                <div class="controls">
                    <?php
                        {dropdown_options}
                        echo form_dropdown(\'{field_name}\', $dropdown_{field_name}, 
                                set_value(\'{field_name}\', object_element(\'{field_name}\', $row)), 
                                \'class="validate[{validation_rules}] input-xlarge {input_class}" id="{controller_name}_{field_name}" tabindex="{tabindex}"\' );
                    ?>
                </div>
            </div> ';

        $enum_dropdown_options = "array(
            'yes' => __('Yes'),
            'no' => __('No')
        )";
        
        $str_input_controls = '';        
        $str_dropdown_options = '';
        $str_quickview_rows = '';
        $str_grid_columns_script = '';
        $str_grid_models_script = '';
        $table_fields = array();
        foreach($this->table_fields as $e)
        {
            $e->name = strtolower($e->name);
            $table_fields[] = $e;
        }
        
        foreach($table_fields as $key => $e)
        {
            $field_name = $e->name;
            $type = $e->type;
            $max_length = $e->max_length;
            $is_primary_key = $e->primary_key;
            $default = $e->default;

            if($is_primary_key)
            {
                continue;
            }
            $field_label = str_replace('_', ' ', humanize($field_name));            
            $field_name_humanize = str_replace('_', ' ', humanize($field_name));
            $field_name_humanize = str_replace(' Id', '', $field_name_humanize);
            
            $str_quickview_rows .= "
            \t<tr>
                    <td><strong><?php _e('" . $field_name_humanize . "'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('".$field_name."'); ?></td>
             \t</tr>\n";
            
            $str_grid_column_template = "template : '#= isnull($field_name, \"\") #'";
            if(in_array($field_name, $this->db_date_types))
            {
                $str_grid_column_template = "template: \"<?php echo kendouiDataItemDateTemplateString('$field_name'); ?>\"";
            }
            $str_grid_columns_script .= "
            \t\t\t{
                \t\t\t\tfield:'$field_name',
                \t\t\t\ttitle:'<?php _e('" . $field_name_humanize . "'); ?>',
                \t\t\t\tfilterable: true,
                \t\t\t\twidth: 200,
                \t\t\t\t$str_grid_column_template
            \t\t\t},";
                  
            //Number|String|Boolean|Date
            $grid_column_model_types = array(
                'text' => 'string',
                'varchar' => 'string',
                'longtext' => 'string',
                'char' => 'string',
                
                'int' => 'number',
                'tinyint' => 'number',
                'bigint' => 'number',
                'float' => 'number',
                'double' => 'number',
                'decimal' => 'number',
                'numeric' => 'number',
                
                'date' => 'date',
                'datetime' => 'date'
            );
            $str_grid_models_script .= "
                        $field_name: { type: '".  element(strtolower($type), $grid_column_model_types,'string')."' },";
            
            if($type == 'enum')
            {
                $_dropdown_options = $enum_dropdown_options;
                $str_dropdown_options = '$dropdown_' . "$field_name = $_dropdown_options;";
            }
            
            $is_dropdown_field = strpos($field_name, '_ID')!==FALSE || strpos($field_name, '_id')!==FALSE || $type == 'enum';
            
            //integer,maxSize[{size}],required,funcCall[validateDateTime]
            $str_input_class = '';
            $str_validation_rules = '';
            $validation_rules = array();                        
            if($e->null=='NO')
            {                
                if($is_dropdown_field)
                {
                    $validation_rules[] = 'funcCall[validateDropdownRequired]';
                }  
                else
                {
                    $validation_rules[] = 'required';
                }
            }            
            if((in_array($type, $this->db_string_types) && $max_length > 0))
            {
                $validation_rules[] = 'maxSize[{maxSize}]';
            }
            else if(!$is_dropdown_field && (in_array($type, $this->db_float_types)))
            {
                $validation_rules[] = 'custom[number]';
                $str_input_class .= ' input-number';
            }
            else if(!$is_dropdown_field && (in_array($type, $this->db_int_types)))
            {                
                $validation_rules[] = 'custom[integer]';
                if($is_dropdown_field)
                {
                    $str_input_class .= ' nice-select';
                }
                else{
                    $str_input_class .= ' input-integer';
                }
            }
            else if((in_array($type, $this->db_date_types)))
            {
                if($type=='datetime')
                {
                    $validation_rules[] = 'funcCall[validateDateTime]';
                    $str_input_class .= ' input-datetime';
                }
                else if($type=='date')
                {
                    $validation_rules[] = 'funcCall[validateDate]';
                    $str_input_class .= ' input-date';
                }
                else if($type=='time')
                {
                    $validation_rules[] = 'funcCall[validateDateTime]';
                    $str_input_class .= ' input-time';
                }                
            }                          
            
            //{validation_rules}
            $str_validation_rules = implode(',', $validation_rules);
                $str_validation_rules = str_replace(array('{maxSize}'), array($max_length),$str_validation_rules);         
            
            /**
             * form elemanını oluştur 
             */
            $search = array('{field_name}', '{validation_rules}', '{dropdown_options}',
                '{tabindex}','{input_class}','{field_label}','{controller_name}');
            $replace = array(
                $field_name,
                $str_validation_rules,
                $str_dropdown_options,
                $key+1,
                $str_input_class,
                $field_name_humanize,
                $this->controller_name
            );
            $str_dropdown_options = '';
                
            if(in_array($type, $this->db_textarea_types))
            {
                $str_input_controls .= str_replace($search, $replace, $template_input_textarea);
            }
            elseif(strpos($field_name, '_id') !== FALSE || $type == 'enum')
            {
                $str_input_controls .= str_replace($search, $replace, $template_input_dropdown);
            }
            else
            {
                $str_input_controls .= str_replace($search, $replace, $template_input_controls);
            }
            
        }
        
        $view_directory = "views/admin-bootstrap/$this->controller_name";
        if(!is_dir(APPPATH . $view_directory))
        {
            mkdir(APPPATH . $view_directory);
        }

        /**
         * index_view dosyasını oluştur  
         */ 
        $search = array('{single_name}', '{controller_name}', '{primary_key}',
            '{controls}', '{quick_view_rows}','{grid_columns_script}','{grid_models_script}');
        $replace = array(
            $this->single_name,
            $this->controller_name,
            strtolower($this->auto_increment),
            $str_input_controls,
            $str_quickview_rows,
            substr_replace($str_grid_columns_script, '', -1),
            substr_replace($str_grid_models_script, '', -1),            
        );
        $str = str_replace($search, $replace, $template_view_index);
        
        $overwrite = (boolean)$this->input->post('overwrite');
        
        if($overwrite!==TRUE && file_exists($path_view_index))
        {
            $this->messages[] = $path_view_index . ' dosyası zaten oluşturulmuş<br/>';
        }
        elseif(write_file($path_view_index, $str))
        {
            $this->messages[] = "$path_view_index => Başarılı";
        }
        
        /**
         * form_view oluştur 
         */
        $str = str_replace($search, $replace, $template_view_form);
        if($overwrite!==TRUE && file_exists($path_view_form))
        {
            $this->messages[] = $path_view_form . ' dosyası zaten oluşturulmuş<br/>';
        }
        elseif(write_file($path_view_form, $str))
        {
            $this->messages[] = "$path_view_form => Başarılı";
        }
        
        /**
         * edit_view oluştur 
         */
        $str = str_replace($search, $replace, $template_view_edit);
        if($overwrite!==TRUE && file_exists($path_view_edit))
        {
            $this->messages[] = $path_view_edit . ' dosyası zaten oluşturulmuş<br/>';
        }
        elseif(write_file($path_view_edit, $str))
        {
            $this->messages[] = "$path_view_edit => Başarılı";
        }
    }

}
