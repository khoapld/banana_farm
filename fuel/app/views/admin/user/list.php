<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-arrows"></i>
                    <span><?php echo \Fuel\Core\Lang::get('title.user_list'); ?></span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <div class="form-group text-right">
                    <a class="btn btn-lg btn-primary" href="/admin/user/new"><?php echo Fuel\Core\Lang::get('button.new_user'); ?></a>
                </div>
                <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                    <thead>
                        <tr>
                            <th><?php echo \Fuel\Core\Lang::get('label.username'); ?></th>
                            <th><?php echo \Fuel\Core\Lang::get('label.full_name'); ?></th>
                            <th class="col-sm-2"><?php echo \Fuel\Core\Lang::get('label.group'); ?></th>
                            <th class="col-sm-2"><?php echo \Fuel\Core\Lang::get('label.status'); ?></th>
                            <th class="col-sm-1"><?php echo \Fuel\Core\Lang::get('label.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="user-list">
                        <?php echo \Fuel\Core\View::forge('admin/user/partial/_list', ['users' => $users, 'user_config' => $user_config]); ?>
                    </tbody>
                </table>
                <div class="form-group text-right">
                    <ul id="pagination" class="pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
