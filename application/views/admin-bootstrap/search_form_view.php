
<div class="search-div">
    <div class="search-input">
        <form action="<?php ?>" method="GET" class="form-search">
            <?php
                echo form_input(array('name' => 'kelime'), (isset($kelime))?$kelime:$this->input->get('kelime'), 'class="input-medium search-query" style=""');
                ?>
           <?php echo form_submit(array('class' => 'btn'), 'Ara', 'style=""');?>
        </form>
    </div>
</div>



