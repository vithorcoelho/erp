<nav class="navbar ks-navbar">
    <?php $this->load->view('logo'); ?>
    <div class="ks-wrapper">
        <nav class="nav navbar-nav">
            
            <?php $this->load->view('nav'); ?>
            
            <div class="ks-navbar-actions">
                <?php //$this->load->view('languages'); ?>

                <?php //$this->load->view('messages'); ?>

                <?php //$this->load->view('notifications'); ?>

                <?php //$this->load->view('user'); ?>
            </div>
        </nav>

        <nav class="nav navbar-nav ks-navbar-actions-toggle">
            <a class="nav-item nav-link" href="#">
                <span class="la la-ellipsis-h ks-icon ks-open"></span>
                <span class="la la-close ks-icon ks-close"></span>
            </a>
        </nav>

        <nav class="nav navbar-nav ks-navbar-menu-toggle">
            <a class="nav-item nav-link" href="#">
                <span class="la la-th ks-icon ks-open"></span>
                <span class="la la-close ks-icon ks-close"></span>
            </a>
        </nav>
    </div>
</nav>

<div id="msg">
    <div id="msgflutuante">
        <i class="la la-check-circle"></i><span></span>
    </div>
</div>