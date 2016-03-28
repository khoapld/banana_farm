<ul class="nav main-menu">
    <li>
        <a href="<?php echo \Fuel\Core\Uri::base(); ?>admin"
           class="<?php echo $controller == 'Controller_Admin_Dashboard' ? 'active' : ''; ?>">
            <i class="fa fa-home"></i>
            <span class="hidden-xs"><?php echo \Fuel\Core\Lang::get('menu.dashboard'); ?></span>
        </a>
    </li>
    <li>
        <a href="<?php echo \Fuel\Core\Uri::base(); ?>admin/user"
           class="<?php echo $controller == 'Controller_Admin_User' ? 'active' : ''; ?>">
            <i class="fa fa-user"></i>
            <span class="hidden-xs"><?php echo \Fuel\Core\Lang::get('menu.user'); ?></span>
        </a>
    </li>
    <li>
        <a href="<?php echo \Fuel\Core\Uri::base(); ?>admin/group"
           class="<?php echo $controller == 'Controller_Admin_Group' ? 'active' : ''; ?>">
            <i class="fa fa-group"></i>
            <span class="hidden-xs"><?php echo \Fuel\Core\Lang::get('menu.group'); ?></span>
        </a>
    </li>

    <li>
        <a href="<?php echo \Fuel\Core\Uri::base(); ?>admin/permission"
           class="<?php echo $controller == 'Controller_Admin_Permission' ? 'active' : ''; ?>">
            <i class="fa fa-key"></i>
            <span class="hidden-xs"><?php echo \Fuel\Core\Lang::get('menu.permission'); ?></span>
        </a>
    </li>
</ul>
