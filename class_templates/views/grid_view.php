<table>
    <tbody>
        <?php foreach($rows as $e): $edit_url = admin_url("{controller_name}/edit/window/modal/id/" . $e->{primary_key}); ?>
            <tr id="id-<?php echo $e->{primary_key}; ?>">
                <td class="islemler">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor($edit_url, '<i class="icon-edit"></i> ' . __('Edit'), 'title="'.__('Edit').'" class="modal-for-grid" 
                                    data-modal-size="max-max"  data-modal-name="{single_name}Modal" data-update-grid="{single_name}Grid"'); ?></li>
                            <?php                            
                                echo '<li>', anchor(admin_url("{controller_name}/delete/id/$e->{primary_key}"), '<i class="icon-remove"></i> ' . __('Delete'), 'class="action-delete"'), '</li>';
                            ?>
                        </ul>
                    </div>
                </td>

                {grid_columns}
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
