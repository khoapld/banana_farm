<?php
$url = empty($user) ? '/admin/user/create' : ($action === 'profile' ? '/admin/user/profile' : '/admin/user/update/' . $user['id']);
$form_id = empty($user) ? 'create-user-form' : ($action === 'profile' ? 'update-profile-form' : 'update-user-form');
$form_button = empty($user) ? \Fuel\Core\Lang::get('button.create') : \Fuel\Core\Lang::get('button.update');
?>
<form id="<?php echo $form_id; ?>" class="form-horizontal" method="post"
      action="<?php echo \Fuel\Core\Uri::create($url); ?>">
    <!-- Username -->
    <div class="form-group">
        <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.username'); ?></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" autocomplete="off" name="username"
            <?php echo $action === 'profile' ? 'disabled' : ''; ?>
                   value="<?php echo empty($user['username']) ? '' : $user['username']; ?>">
            <span class="error username"></span>
        </div>
    </div>
    <!-- Password -->
    <div class="form-group">
        <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.password'); ?></label>
        <div class="col-sm-2">
            <input type="password" class="form-control" name="password" autocomplete="off">
            <span class="error password"></span>
        </div>
    </div>
    <!-- Group -->
    <?php if ($action !== 'profile'): ?>
        <div class="form-group">
            <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.group'); ?></label>
            <div class="col-sm-2">
                <select class="form-control" name="group">
                    <?php foreach ($user_config['group'] as $k => $v): ?>
                        <?php $selected = isset($user['group']) && $k == $user['group'] ? 'selected' : (!isset($user['group']) && $k == 2 ? 'selected' : ''); ?>
                        <option value="<?php echo $k; ?>" <?php echo $selected; ?> >
                            <?php echo $v; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="error group"></span>
            </div>
        </div>
        <!-- Status -->
        <div class="form-group">
            <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.status'); ?></label>
            <div class="col-sm-2">
                <select class="form-control" name="status">
                    <?php foreach ($user_config['status'] as $k => $v): ?>
                        <?php $selected = isset($user['status']) && $k == $user['status'] ? 'selected' : (!isset($user['status']) && $k == 1 ? 'selected' : ''); ?>
                        <option value="<?php echo $k; ?>" <?php echo $selected; ?> >
                            <?php echo \Fuel\Core\Lang::get('text.' . $v); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="error status"></span>
            </div>
        </div>
    <?php endif; ?>
    <!-- Fullname -->
    <div class="form-group">
        <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.full_name'); ?></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="full_name"
                   value="<?php echo empty($user['full_name']) ? '' : $user['full_name']; ?>">
            <span class="error full_name"></span>
        </div>
    </div>
    <hr>
    <!-- Gender -->
    <div class="form-group">
        <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.gender'); ?></label>
        <div class="col-sm-2">
            <select class="form-control" name="gender">
                <option value=""><?php echo \Fuel\Core\Lang::get('text.select'); ?></option>
                <?php foreach ($user_config['gender'] as $k => $v): ?>
                    <?php $selected = isset($user['gender']) && $k == $user['gender'] ? 'selected' : ''; ?>
                    <option value="<?php echo $k; ?>" <?php echo $selected; ?> >
                        <?php echo \Fuel\Core\Lang::get('text.' . $v); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span class="error gender"></span>
        </div>
    </div>
    <!-- Telephone -->
    <div class="form-group">
        <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.telephone'); ?></label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="telephone"
                   value="<?php echo empty($user['telephone']) ? '' : $user['telephone']; ?>">
            <span class="error telephone"></span>
        </div>
    </div>
    <!-- Email -->
    <div class="form-group">
        <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.email'); ?></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="email"
                   value="<?php echo empty($user['email']) ? '' : $user['email']; ?>">
            <span class="error email"></span>
        </div>
    </div>
    <!-- Address -->
    <div class="form-group">
        <label class="control-label col-sm-4"><?php echo \Fuel\Core\Lang::get('label.address'); ?></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="address"
                   value="<?php echo empty($user['address']) ? '' : $user['address']; ?>">
            <span class="error address"></span>
        </div>
    </div>
    <!-- Buttons -->
    <div class="form-group">
        <!-- Buttons -->
        <div class="col-sm-6 col-sm-offset-4">
            <button type="submit" class="btn btn-info"><?php echo $form_button; ?></button>
            <span class="error system_error"></span>
        </div>
    </div>
</form>
