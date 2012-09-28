<table>
    <tbody>
        <?php foreach($rows as $e): $edit_url = admin_url("auth_module/edit/window/modal/id/" . $e->module_id); ?>
            <tr id="id-<?php echo $e->module_id; ?>">
                <td class="islemler">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor($edit_url, '<i class="icon-edit"></i> ' . __('Edit'), 'title="'.__('Edit').'" class="modal-for-grid" 
                                    data-modal-size="max-max"  data-modal-name="auth_moduleModal" data-update-grid="auth_moduleGrid"'); ?></li>
                            <?php                            
                                echo '<li>', anchor(admin_url("auth_module/delete/id/$e->module_id"), '<i class="icon-remove"></i> ' . __('Delete'), 'class="action-delete"'), '</li>';
                            ?>
                        </ul>
                    </div>
                </td>

                <td style=""><?php echo $e->module_code; ?></td>
<td style=""><?php echo $e->module_name; ?></td>
<td style=""><?php echo $e->module_single_label; ?></td>
<td style=""><?php echo $e->module_plural_label; ?></td>
<td style="text-align:right;"><?php echo $e->parent_id; ?></td>
<td style=""><?php echo $e->module_url; ?></td>
<td style="text-align:center;"><?php echo grid_column_label($e->active); ?></td>
<td style="text-align:center;"><?php echo grid_column_label($e->show_in_menu); ?></td>
<td style="text-align:center;"><?php echo grid_column_label($e->show_in_form); ?></td>
<td style="text-align:right;"><?php echo $e->sequence_number; ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
