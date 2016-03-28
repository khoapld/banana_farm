<?php foreach ($groups as $group): ?>
    <tr group-id="<?php echo $group['id']; ?>">
        <td>
            <input type="text" name="group" value="<?php echo $group['group']; ?>" class="form-control"
                   placeholder="<?php echo \Fuel\Core\Lang::get('placeholder.group'); ?>">
        </td>
        <td>
            <button class="btn btn-xs btn-info update-group">
                <?php echo \Fuel\Core\Lang::get('button.update'); ?>
            </button>
        </td>
    </tr>
<?php endforeach; ?>
