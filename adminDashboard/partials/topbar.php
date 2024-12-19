<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>

        <li class="notification-list">
            <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                <i class="dripicons-gear noti-icon"></i>
            </a>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0 d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle" height="35">
                </span>
                <span class="account-user-name ms-2"><?= $_SESSION['username'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selamat Datang !</h6>
                </div>

                <!-- item-->
                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>Akaun saya</span>
                                    </a> -->

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Log Keluar</span>
                </a>


            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left" id="sidebar-toggle">
        <i class="mdi mdi-menu"></i>
    </button>
</div>
<!-- Logout Modal -->
<div class="modal fade modal-backdrop-edit" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <i class="mdi mdi-logout text-primary" style="font-size: 48px;"></i>
                <h4 class="mt-3">Log Keluar</h4>
                <p class="mt-2">Adakah anda pasti untuk log keluar?</p>
                <div class="mt-4">
                    <button type="button" class="btn btn-secondary me-2 rounded-button" data-bs-dismiss="modal">Batal</button>
                    <a href="require/logout.php" class="btn btn-primary rounded-button">Log Keluar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Topbar -->