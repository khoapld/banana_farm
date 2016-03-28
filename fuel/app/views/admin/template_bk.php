<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
    </head>
    <body>
        <?php echo $header; ?>

        <div class="content">
            <!-- Sidebar -->
            <?php echo $sidebar; ?>

            <!-- Main bar -->
            <div class="mainbar">
                <!-- Page heading -->
                <div class="page-head">
                    <h2 class="pull-left"><i class="icon-home"></i>
                        <?php foreach (\Fuel\Core\Uri::segments() as $k => $segment): ?>
                            <?php $url = empty($url) ? '/admin' : $url . '/' . $segment; ?>
                            <a href="<?php echo $url; ?>"><?php echo \Fuel\Core\Str::ucfirst($segment); ?></a>
                            <?php if ($k + 1 < count(\Fuel\Core\Uri::segments())): ?>
                                <span class="divider">/</span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <!-- Matter -->
                <?php echo $content; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Footer starts -->
        <?php echo $footer; ?>

        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>

        <?php echo $script; ?>

        <div id="alert" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
    </body>
</html>
