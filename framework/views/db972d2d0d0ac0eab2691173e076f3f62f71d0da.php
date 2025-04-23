<div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <!--<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="index.html"><img src="admin/assets/images/logo.svg" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="admin/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>-->
        <ul class="nav">
            <li class="nav-item profile">
                <!-- Profile section -->
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="<?php echo e(url('/login1')); ?>">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-icon">
                        <i class="mdi mdi-laptop"></i>
                    </span>
                    <span class="menu-title">Basic UI Elements</span>
                    <i class="menu-arrow"></i>
            </a>
              <div class="collapse" id="ui basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" herf="admin/pages/ui-features/buttons.html">Buttons</a><li>
                    <li class="nav-item"><a class="nav-link" herf="admin/pages/ui-features/buttons.html">Dropdowns</a><li>
                    <li class="nav-item"><a class="nav-link" herf="admin/pages/ui-features/buttons.html">Typography</a><li>
</ul>
</div>
                </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="<?php echo e(url('/view_product')); ?>">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Add Product</span>
                </a>
            </li>


            <li class="nav-item menu-items">
                <a class="nav-link" href="<?php echo e(url('/show_product')); ?>">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">show product</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="<?php echo e(url('/view_category')); ?>">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Category</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="<?php echo e(url('chatify')); ?>">
                    <span class="menu-icon">
                        <i class="mdi mdi-charts-bar"></i>
                    </span>
                    <span class="menu-title">Charts</span>
                </a>
            </li>

            

        </ul>
    </nav>
</div>
<?php /**PATH C:\laravel\wood furniture\wood\resources\views\admin\sidebars.blade.php ENDPATH**/ ?>