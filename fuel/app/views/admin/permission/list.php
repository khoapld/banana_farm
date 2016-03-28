<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-arrows"></i>
                    <?php echo \Fuel\Core\Lang::get('title.permission_list'); ?>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <?php foreach ($groups as $group): ?>
                                <th><?php echo $group['group']; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody id="permission-list">
                        <?php foreach ($pages as $k => $v): ?>
                            <tr permission-action="<?php echo $k; ?>">
                                <td>
                                    <input type="hidden" name="action" value="<?php echo $k; ?>">
                                    <?php echo $v; ?>
                                </td>
                                <?php foreach ($groups as $group): ?>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="group[]" class="form-control"
                                                <?php echo array_key_exists($k, $permission) && in_array($group['id'], $permission[$k]) ? 'checked' : ''; ?>
                                                       value="<?php echo $group['id']; ?>">
                                                <i class="fa fa-square-o small"></i>
                                            </label>
                                        </div>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
