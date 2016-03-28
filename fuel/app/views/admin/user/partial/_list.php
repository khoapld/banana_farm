<?php foreach ($users as $user): ?>
    <tr user-id="<?php echo $user['id']; ?>">
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['full_name']; ?></td>
        <td>
            <select class="form-control" name="group">
                <?php foreach ($user_config['group'] as $k => $v): ?>
                    <?php $selected = isset($user['group']) && $k == $user['group'] ? 'selected' : (!isset($user['group']) && $k == 200 ? 'selected' : ''); ?>
                    <option value="<?php echo $k; ?>" <?php echo $selected; ?> ><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <select class="form-control" name="status">
                <?php foreach ($user_config['status'] as $k => $v): ?>
                    <?php $selected = isset($user['status']) && $k == $user['status'] ? 'selected' : (!isset($user['status']) && $k == 1 ? 'selected' : ''); ?>
                    <option value="<?php echo $k; ?>" <?php echo $selected; ?> >
                        <?php echo \Fuel\Core\Lang::get('text.' . $v); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <a href="/admin/user/edit/<?php echo $user['id']; ?>">
                <button class="btn btn-xs btn-info">
                    <?php echo \Fuel\Core\Lang::get('button.update'); ?>
                </button>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
