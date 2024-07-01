<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/assets/images/hush_2.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/assets/images/hush_2.png" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="/assets/images/hush_2.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/assets/images/hush_2.png" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/u/dashboard">
                        <i class="bx bxs-dashboard"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/u/wallet">
                        <i class="bx bx-wallet-alt"></i> <span>Wallet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/u/nabung">
                        <i class="bx bx-calendar-event"></i> <span>Nabung</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/u/goals">
                        <i class=" bx bx-list-ul"></i> <span>Goals</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarIncome" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class=" bx bx-money
                        "></i> <span>Income</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarIncome">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/u/income" class="nav-link" data-key="t-analytics">
                                    List </a>
                            </li>
                            <li class="nav-item">
                                <a href="/u/income/laporan" class="nav-link" data-key="t-crm"> Laporan </a>
                            </li>
                        </ul>
                    </div>
                </li> 
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOutcome" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class=" bx bx-money
                        "></i> <span>Outcome</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOutcome">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="u/outcome" class="nav-link" data-key="t-analytics">
                                    List </a>
                            </li>
                            <li class="nav-item">
                                <a href="u/outcome/laporan" class="nav-link" data-key="t-crm"> Laporan </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>