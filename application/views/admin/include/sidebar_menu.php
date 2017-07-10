<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
<!--        <div class="user-info">
            <div class="image">
                <img src="<?= BACKEND_IMAGE_FOLDER ?>user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrator</div>
                <div class="email">ppg_mlg_barat@gmail.com</div>
                <div class="btn-group user-helper-dropdown">
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="seperator" class="divider"></li>

                        <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>

                        <li role="seperator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>-->
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <?php
                if ($active_page == 'dashboard') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>
                <a href="<?= site_url() ?>admin" >
                    <i class="mdi mdi-view-dashboard mdi-24px"></i>
                    <span>Dashboard</span>
                </a>
                </li>
                <?php
                if ($active_page == 'pc') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-home mdi-24px"></i>
                    <span>Pengurus Cabang (PC)</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-block">
                            <span>Tambah PC</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/tpq" class="waves-effect waves-block">
                            <span>Data PC</span>
                        </a>
                    </li>

                </ul>
                <?php
                if ($active_page == 'tpq') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-domain mdi-24px"></i>
                    <span>TPQ</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/tpq/add" class="waves-effect waves-block">
                            <span>Tambah TPQ</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/pengurus_tpq/" class="waves-effect waves-block">                                
                            <span>Pengurus TPQ</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/tpq" class="waves-effect waves-block">
                            <span>Data TPQ</span>
                        </a>
                    </li>

                </ul>
                </li>
                <?php
                if ($active_page == 'pengajar') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="mdi mdi-human-greeting mdi-24px"></i>
                        <span>Pengajar</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li>
                            <a href="<?= site_url() ?>admin/pengajar/add" class="waves-effect waves-block">
                                <span>Tambah Pengajar</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url() ?>admin/pengajar" class="waves-effect waves-block">
                                <span>Data Pengajar</span>
                            </a>
                        </li>

                    </ul>
                </li>
                 <?php
                if ($active_page == 'siswa') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="mdi mdi-human-male-female mdi-24px"></i>
                        <span>Siswa</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li>
                            <a href="<?= site_url() ?>admin/siswa/add" class="waves-effect waves-block">
                                <span>Tambah Siswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url() ?>admin/siswa" class="waves-effect waves-block">
                                <span>Data Siswa</span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                <a href="javascript:void(0);">SIGRUS - LDII KOTA BATU</a> &copy; 2017
            </div>

        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <!-- #END# Right Sidebar -->
</section>
