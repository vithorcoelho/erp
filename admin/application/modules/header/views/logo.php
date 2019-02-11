    <div href="<?php echo base_url() ?>index.html" class="navbar-brand">


        <div class="ks-navbar-logo">
            <a href="<?php echo base_url() ?>" class="ks-logo">
                <?php echo $config_header['titulo'] ?>
            </a>

            <span class="nav-item dropdown ks-dropdown-grid-images">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url() ?>#" role="button" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu ks-info ks-scrollable" aria-labelledby="Preview" data-height="260">
                    <div class="ks-scroll-wrapper">
                        <?php foreach ($config_header['navlogo'] as $titulo => $valores): ?>
                        <a href="<?php echo $valores[1] ?>" class="ks-grid-item">
                            <img class="ks-icon" src="<?php echo $valores[0] ?>">
                            <span class="ks-text"><?php echo $titulo; ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </span>

            <!-- END GRID NAVIGATION -->
        </div>
    </div>
    <!-- END LOGO -->