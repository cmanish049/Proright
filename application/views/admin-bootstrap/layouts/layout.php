<?php echo doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $this->template->view('head'); ?>
    </head>
    <body>
        <div class="navbar nnavbar-fixed-top">
                <div class="navbar-innerr">
                    <div class="container" style="">
                        <!--<a class="brand" href="<?php echo admin_url(); ?>"><?php echo config_item('project_name'); ?></a>
                        <ul class="nav pull-right">
                            
                            <?php if(config_item('show_language_dropdown')): ?>
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Dil : <strong><?php echo config_item('language_name'); ?></strong><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach(config_item('languages') as $e): ?>
                                        <li>
                                            <a href="<?php echo current_url() . query_string(array('language' => $e['language'])) ?>"><?php echo $e['language_name'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            
                            <li class="divider-vertical"></li>
                            <?php if($is_logged_in): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php _e('Hoş Geldin'); ?> <strong><?php echo $logged_in_user->full_name; ?></strong><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo admin_url('user/edit/window/modal/id/'.$logged_in_user->user_id); ?>"
                                            class="open-modal" data-modal-size="max-max" data-modal-name="userModal" ><?php _e('Settings') ?></a></li>
                                    <li><a href="<?php echo admin_url('user/logout'); ?>"><?php _e('Logout'); ?></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo admin_url('user/logout'); ?>"><?php _e('Logout'); ?></a>
                            </li>
                            <?php endif; ?>
                        </ul>-->

                        <?php echo $top_menu; ?>
                    </div>
                </div>
            </div>


        <div class="container">
            <?php
            if(isset($content))
            {
                if(is_array($content))
                {
                    foreach($content as $e)
                    {
                        echo $e;
                    }
                }
                else
                {
                    echo $content;
                }
            }
            ?>
        </div>
        <?php
        echo $js, $script;
        ?>
        
       <div class="container" style="margin-top:10px;margin-bottom: 20px;">
            <div class="section" style="text-align: center;">
                <a href="http://www.3digitaltech.com" title="2 Digital Technologies" target="_blank"><strong>3</strong></a>
            </div>
        </div>
    </body>
</html>
