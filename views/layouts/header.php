<?php

use yii\helpers\Url;

?>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
     id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                       aria-label="Search..."/>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item lh-1 me-3">
                <!-- Place this tag where you want the button to render. -->
                <a class="github-button" href="https://github.com/Rahmatillo05/workly" data-size="large"
                   data-show-count="true" aria-label="Star Rahmatillo05/workly on GitHub">Star</a>
            </li>

            <li class="nav-item">
                <a class="dropdown-item text-danger" href="<?= Url::to(['site/logout']) ?>" data-method="post">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</nav>