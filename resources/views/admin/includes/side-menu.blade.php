<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <div class="logo">

                </div> <strong>Admin</strong> </div>
        </div>
        <nav class="menu">
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <li class="{{ route('admin.dashboard') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard </a>
                </li>
                <li class="{{ route('admin.view.cashiers') == url()->current() ||
                            route('admin.add.cashier') == url()->current() ||
                            route('admin.view.registrars') == url()->current() ||
                            route('admin.add.registrar') == url()->current() || route('admin.view.faculties') == url()->current() ? 'active' : '' }}">
                    <a href="">
                        <i class="fa fa-users"></i> Users Manager
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('admin.view.cashiers') }}"> Cashiers </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.view.registrars') }}"> Registrars </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.view.faculties') }}"> Faculties </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ route('admin.students') == url()->current() || route('admin.stduent.search') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('admin.students') }}">
                        <i class="fa fa-graduation-cap"></i> Students
                    </a>
                </li>
                <li class="{{ route('admin.view.programs') == url()->current() || route('admin.add.program') == url()->current() || route('admin.courses') == url()->current() || route('admin.add.course') == url()->current() ? 'active' : '' }}">
                    <a href="">
                        <i class="fa fa-book"></i> Programs &amp; Courses
                        <i class="fa arrow"></i>
                    </a>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('admin.courses') }}"> Courses </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.view.programs') }}"> Programs </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ route('admin.subjects') == url()->current() || route('admin.add.subject') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('admin.subjects') }}">
                        <i class="fa fa-book"></i> Subjects
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file-text-o"></i> Enrollment
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file"></i> Assessments
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-paypal"></i> Paypal Payments
                    </a>
                </li>
                <li class="{{ route('admin.activity.logs') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('admin.activity.logs') }}">
                        <i class="fa fa-history"></i> Activity Log </a>
                </li>
            </ul>
        </nav>
    </div>
    <footer class="sidebar-footer">
        <ul class="sidebar-menu metismenu" id="customize-menu">
            <li>
                <ul>
                    <li class="customize">
                        <div class="customize-item">
                            <div class="row customize-header">
                                <div class="col-4"> </div>
                                <div class="col-4">
                                    <label class="title">fixed</label>
                                </div>
                                <div class="col-4">
                                    <label class="title">static</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="title">Sidebar:</label>
                                </div>
                                <div class="col-4">
                                    <label>
                                        <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label>
                                        <input class="radio" type="radio" name="sidebarPosition" value="">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="title">Header:</label>
                                </div>
                                <div class="col-4">
                                    <label>
                                        <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label>
                                        <input class="radio" type="radio" name="headerPosition" value="">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="title">Footer:</label>
                                </div>
                                <div class="col-4">
                                    <label>
                                        <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label>
                                        <input class="radio" type="radio" name="footerPosition" value="">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="customize-item">

                        </div>
                    </li>
                </ul>
                <a href="">
                    <i class="fa fa-cog"></i> Customize </a>
            </li>
        </ul>
    </footer>
</aside>