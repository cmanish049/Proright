<meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
<title><?php echo (isset($title)) ? $title : ''; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php echo (isset($meta)) ? $meta : ''; ?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<?php echo css(array('bootstrap.css',
    'kendo.common.css','kendo.silver.min.css',
    'custom.css')); ?>

<?php

echo js('languages/jquery.validationEngine.en-US.js');
echo js(
        array(
            'kendo.web.min.js','languages/kendo.culture.en-US.js',
            'jquery-plugins.js',
            'custom.js'
        )
);
?>

<?php echo $css; ?>
<script>
//set current culture to "en-GB".
kendo.culture("en-US");
</script>