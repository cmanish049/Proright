<table>
    <tbody>
        <?php foreach($rows as $e): $edit_url = admin_url("country/edit/window/modal/id/" . $e->country_id); ?>
            <tr id="id-<?php echo $e->country_id; ?>">
                <td class="islemler">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor($edit_url, '<i class="icon-edit"></i> ' . __('Edit'), 'title="'.__('Edit').'" class="modal-for-grid" 
                                    data-modal-size="max-max"  data-modal-name="countryModal" data-update-grid="countryGrid"'); ?></li>
                            <?php                            
                                echo '<li>', anchor(admin_url("country/delete/id/$e->country_id"), '<i class="icon-remove"></i> ' . __('Delete'), 'class="action-delete"'), '</li>';
                            ?>
                        </ul>
                    </div>
                </td>

                <td style=""><?php echo $e->country_name; ?></td>
<td style=""><?php echo $e->country_seo; ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
