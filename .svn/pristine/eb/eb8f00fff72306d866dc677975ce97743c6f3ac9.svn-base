<table>
    <tbody>
        <?php foreach($rows as $e): $edit_url = admin_url("auth_user_group/edit/window/modal/id/" . $e->group_id); ?>
            <tr id="id-<?php echo $e->group_id; ?>">
                <td class="islemler">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor($edit_url, '<i class="icon-edit"></i> ' . __('Edit'), 'title="'.__('Edit').'" class="modal-for-grid" 
                                    data-modal-size="max-max"  data-modal-name="auth_user_groupModal" data-update-grid="auth_user_groupGrid"'); ?></li>
                            <?php                            
                                echo '<li>', anchor(admin_url("auth_user_group/delete/id/$e->group_id"), '<i class="icon-remove"></i> ' . __('Delete'), 'class="action-delete"'), '</li>';
                            ?>
                        </ul>
                    </div>
                </td>

                <td style=""><?php echo $e->group_name; ?></td>
<td style="text-align:center;"><?php echo grid_column_label($e->active); ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
