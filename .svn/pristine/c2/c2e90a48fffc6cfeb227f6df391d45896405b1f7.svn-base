<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function autocomplete_new_button($data=array(),$return=FALSE)
{
    $CI =& get_instance();
    if($return)
    {
        return $CI->template->view('templates/form_input_autocomplete_new_button',$data,TRUE);
    }
    
    $CI->template->view('templates/form_input_autocomplete_new_button',$data);
}
function grid_column_label($str = '')
{
    if(!$str)
    {
        return $str;
    }

    $class = 'label';
    $success_str_array = array(
        'yes'        
    );
    $warning_str_array = array(
        'pasif',
        'taslak',
        'onaysiz'
    );
    $info_str_array = array(
        'bekliyor',
    );
    $important_str_array = array(
        'no'
    );

    if(in_array($str, $success_str_array))
    {
        $class .= ' label-success';
    }
    elseif(in_array($str, $warning_str_array))
    {
        $class .= ' label-warning';
    }
    elseif(in_array($str, $info_str_array))
    {
        $class .= ' label-info';
    }
    elseif(in_array($str, $important_str_array))
    {
        $class .= ' label-important';
    }

    return "<span class='$class'>" . humanize($str) . "</span>";
}

function html_portlet($title='',$content='',$id='')
{
    $id OR $id = random_string('unique');
    ?>
    <div class="accordion-group white-background portlet">
        <div class="accordion-heading">
            <h4><a class="accordion-toggle" data-toggle="collapse" href="#<?php echo $id; ?>"><?php echo $title; ?></a></h4>
        </div>
        <div id="<?php echo $id; ?>" class="accordion-body collapse in">
            <div class="accordion-inner">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
    <?php
    
}
