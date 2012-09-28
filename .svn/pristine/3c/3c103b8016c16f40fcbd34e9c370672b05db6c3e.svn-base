<?php echo doctype(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $this->template->view('head'); ?>
    </head>
    <body class="iframe-body" style="" >
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

        <?php echo $js,$script; ?>
    </body>
</html>
