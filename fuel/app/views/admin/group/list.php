<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-arrows"></i>
                    <?php echo \Fuel\Core\Lang::get('title.group_info'); ?>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <form id="create-group-form" class="form-horizontal" method="post"
                      action="<?php echo \Fuel\Core\Uri::create('/admin/group/create'); ?>">
                    <!-- Group -->
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <input type="text" class="form-control" name="group" autocomplete="off"
                                   placeholder="<?php echo \Fuel\Core\Lang::get('placeholder.group'); ?>">
                            <span class="error group system_error"></span>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">
                                <?php echo \Fuel\Core\Lang::get('button.create'); ?>
                            </button>
                        </div>
                    </div>
                </form>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo \Fuel\Core\Lang::get('label.group'); ?></th>
                            <th class="col-sm-1"><?php echo \Fuel\Core\Lang::get('label.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="group-list">
                        <?php echo \Fuel\Core\View::forge('admin/group/partial/_list', ['groups' => $groups]); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
