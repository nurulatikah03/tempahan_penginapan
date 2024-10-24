<style>
ul.navigation li a.active {
    color: #c77a63 !important;
}

</style>

<header class="main-header header-style-two">
        <div class="header-upper">
            <div class="auto-container">
                <div class="inner-container d-flex align-items-center justify-content-between">
                    <div class="logo-box">
						<a href="index.php">
							<span class="logo-lg d-flex align-items-center justify-content-center">
								<div class="logo" style="width:200px;"><a href="index.php"><img src="assets/images/logo1.png" alt="logo"></a></div>
							</span>
						</a>
					</div>
					
					<div class="middle-column">
						<div class="nav-outer">
							<div class="mobile-nav-toggler"><img src="assets/images/icons/icon-bar.png" alt=""></div>
							<nav class="main-menu navbar-expand-md navbar-light">
								<div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
									<ul class="navigation">
										<?php 
										$current_page = basename($_SERVER['PHP_SELF']); // Get the current page
										?>
										<li>
											<a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
												Laman Utama
											</a>
										</li>   
										<li>
											<a href="kemudahanDewan.php" class="<?php echo ($current_page == 'kemudahanDewan.php') ? 'active' : ''; ?>">
												Dewan
											</a>
										</li>   
										<li>
											<a href="pakejPenginapan.php" class="<?php echo ($current_page == 'pakejPenginapan.php') ? 'active' : ''; ?>">
												Penginapan
											</a>
										</li> 
										<li>
											<a href="pakejAktiviti.php" class="<?php echo ($current_page == 'pakejAktiviti.php') ? 'active' : ''; ?>">
												Aktiviti
											</a>
										</li> 
										<li>
											<a href="pakejPerkahwinan.php" class="<?php echo ($current_page == 'pakejPerkahwinan.php') ? 'active' : ''; ?>">
												Pakej Perkahwinan
											</a>
										</li>         
									</ul>
								</div>
							</nav>
						</div>
					</div>

                    <div class="right-column d-flex align-items-center"> 
                        <li>
							<button type="button" class="theme-btn search-toggler" onclick="window.location.href='contact.php'" style="border: none; background: transparent; padding: 0;">
								<i class="fas fa-phone" style="font-size: 20px; color: white;"></i>
							</button>
						</li>	                    
                        <div class="header-link-btn"><a href="index.php" class="btn-1 btn-small btn-alt">Book Your Stay <span></span></a></div>
                    </div>                      
                </div>
            </div>
        </div>
        <div class="sticky-header dark-bg">
            <div class="header-upper">
                <div class="auto-container">
                    <div class="inner-container d-flex align-items-center justify-content-between">
                        <!--Logo-->
                        <div class="logo-box">
                            <div class="logo" style="width:200px;"><a href="index.php"><img src="assets/images/logo1.png" alt="logo"></a></div>
                        </div>
                        <div class="middle-column">
                            <!--Nav Box-->
                            <div class="nav-outer">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler"><img src="assets/images/icons/icon-bar-2.png" alt=""></div>
    
                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md navbar-light">
                                </nav>
                            </div>
                        </div>
                        <div class="right-column d-flex align-items-center">
							<li>
								<button type="button" class="theme-btn search-toggler" onclick="window.location.href='contact.php'" style="border: none; background: transparent; padding: 0;">
									<i class="fas fa-phone" style="font-size: 20px; color: white;"></i>
								</button>
							</li>	                        
                            <div class="header-link-btn"><a href="javascript:void(0);" class="btn-1 btn-small btn-alt">Book Your Stay <span></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="fal fa-times"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="index.php"><img src="assets/images/logo-light.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="#"><span class="fab fa-twitter"></span></a></li>
						<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="#"><span class="fab fa-instagram"></span></a></li>
						<li><a href="#"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div>

        <div class="nav-overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div>
    </header>