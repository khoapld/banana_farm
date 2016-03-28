<script>
    var locale = '<?php echo \Fuel\Core\Config::get('locale'); ?>';
</script>

<?php
echo \Fuel\Core\Asset::js([
    '../../plugins/jquery/jquery-2.1.0.min.js',
    '../../plugins/jquery-ui/jquery-ui.min.js',
    '../../plugins/bootstrap/js/bootstrap.min.js',
    'admin.js',
]);
?>

<?php if ($controller === 'Controller_Admin_User' && $action === 'list'): ?>
    <?php echo \Fuel\Core\Asset::js(['../../plugins/jquery-pagination/jquery.pagination.js']); ?>
    <script>
        $('#pagination').jqueryPagination({
            totalPages: <?php echo $total_page; ?>,
            visiblePages: <?php echo _DEFAULT_VISIBLE_PAGES_; ?>,
            prev: '&lsaquo;',
            next: '&rsaquo;',
            first: '&laquo;',
            last: '&raquo;',
            onPageClick: function (event, page) {
                var posting = $.post('/admin/user', {page: page});
                posting.done(function (data) {
                    if (typeof data !== 'undefined') {
                        $('#user-list').html(data);
                    }
                });
            }
        });

        // Change group
        $(document).on('change', 'select[name="group"]', function () {
            var group = $(this).val();
            var user_id = $(this).parents('tr').attr('user-id');
            var posting = $.post('/admin/user/group', {user_id: user_id, group: group});
            posting.done(function (data) {
                if (typeof data.success !== 'undefined' && data.success !== false) {
                    show_alert_success(data.success);
                } else if (typeof data.errors !== 'undefined') {
                    var msg = '';
                    $.each(data.errors, function (index, value) {
                        msg += value + '<br>';
                    });
                    show_alert_error(msg);
                }
            });
        });

        // Change status
        $(document).on('change', 'select[name="status"]', function () {
            var status = $(this).val();
            var user_id = $(this).parents('tr').attr('user-id');
            var posting = $.post('/admin/user/status', {user_id: user_id, status: status});
            posting.done(function (data) {
                if (typeof data.success !== 'undefined' && data.success !== false) {
                    show_alert_success(data.success);
                } else if (typeof data.errors !== 'undefined') {
                    var msg = '';
                    $.each(data.errors, function (index, value) {
                        msg += value + '<br>';
                    });
                    show_alert_error(msg);
                }
            });
        });
    </script>
<?php elseif ($controller === 'Controller_Admin_Group'): ?>
    <script>
        // Update group
        $(document).on('click', 'button.update-group', function () {
            var id = $(this).parents('tr').attr('group-id');
            var group = $(this).parents('tr').find('input[name=group]').val();
            var posting = $.post('/admin/group/update', {id: id, group: group});
            posting.done(function (data) {
                if (typeof data.success !== 'undefined' && data.success !== false) {
                    show_alert_success(data.success);
                } else if (typeof data.errors !== 'undefined') {
                    var msg = '';
                    $.each(data.errors, function (index, value) {
                        msg += index + ': ' + value + '<br>';
                    });
                    show_alert_error(msg);
                }
            });
        });
    </script>
<?php elseif ($controller === 'Controller_Admin_Permission'): ?>
    <script>
        // Update permission
        $(document).on('click', 'input[type=checkbox]', function () {
            var action = $(this).parents('tr').attr('permission-action');
            var group = $(this).parents('tr').find('input[name="group[]"]:checked:enabled').map(function () {
                return $(this).val();
            }).get();
            var posting = $.post('/admin/permission/update', {action: action, group: group});
            posting.done(function (data) {
                if (typeof data.success !== 'undefined' && data.success !== false) {
                    show_alert_success(data.success);
                } else if (typeof data.errors !== 'undefined') {
                    var msg = '';
                    $.each(data.errors, function (index, value) {
                        msg += index + ': ' + value + '<br>';
                    });
                    show_alert_error(msg);
                }
            });
        });
    </script>
<?php endif; ?>
