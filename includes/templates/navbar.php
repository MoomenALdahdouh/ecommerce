<?php
$lang = 'en';
if ($_SESSION['lang'] == "en") {
    $lang = 'ar';
} elseif ($_SESSION['lang'] == "ar") {
    $lang = 'en';
} ?>
<div class="navbar-section">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
                <img src="layout/images/eco-logo-text.png"
                     height="40"
                     alt=""
                     loading="lazy"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="items-nav collapse navbar-collapse" id="navbarSupportedContent">
                <!--Left elements -->
                <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php"><?php echo lang('home') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page"
                           href="blog.php"><?php echo lang('blog') ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?lang=<?php echo $lang; ?>" id="lang-button"
                           class="nav-link btn btn-dark"
                           aria-current="page"><?php echo lang('language') ?> | <?php echo $lang ?></a>
                    </li>
                </ul>

            </div>
            <!--Right elements -->
            <!--<form style="margin: 0 10px" class="search-key-box d-flex input-group w-auto">
                <input
                        type="search"
                        class="form-control"
                        placeholder="Search"
                        aria-label="Search"
                        aria-describedby="search-addon"
                />
                <span class="input-group-text border-0" id="search-addon"><i class="fas fa-search"></i></span>
            </form>-->
            <a class="text-reset me-3" href="cart.php">
                <i class="fas text-light fa-shopping-cart"></i>
                <span style="font-size: 12px"
                      class="badge rounded-pill badge-notification bg-danger"><?php if (cartNotification() > 0) echo cartNotification() ?></span>
            </a>
            <ul class="dropdown-box nav navbar-nav">
                <li class="dropdown ">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas text-light fa-bell"></i>
                        <span style="font-size: 12px"
                              class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['Username'])) { ?>
                <ul class="dropdown-box nav navbar-nav">
                    <li class="dropdown ">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['Username']; ?>
                            <img
                                    src="https://mdbootstrap.com/img/new/avatars/2.jpg"
                                    class="rounded-circle"
                                    height="25"
                                    alt=""
                                    loading="lazy"
                            />
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item"
                                   href="members.php?page=Edit&userid=<?php echo $_SESSION['ID']; ?>">Edit
                                    Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Sittings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="dropdown-box nav navbar-nav">
                    <li class="dropdown ">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                            <img
                                    src="layout/images/account.webp"
                                    class="rounded-circle"
                                    height="25"
                                    alt=""
                                    loading="lazy"
                            />
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="registerUser.php">Join</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </nav>
</div>


