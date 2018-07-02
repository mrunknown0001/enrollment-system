<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <div class="logo">

                </div> Student </div>
        </div>
        <nav class="menu">
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                <li class="{{ route('student.dashboard') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('student.dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard </a>
                </li>
                @if(Auth::user()->info->enrolling_for == 1)
                <li class="{{ route('student.subjects') == url()->current() ? 'active' : ''}}">
                    <a href="{{ route('student.subjects') }}">
                        <i class="fa fa-book"></i> Subjects
                    </a>
                </li>
                @elseif(Auth::user()->info->enrolling_for == 2)
                <li class="{{ route('student.programs') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('student.programs') }}">
                        <i class="fa fa-book"></i> Program
                    </a>
                </li>
                @endif
                <li class="{{ route('student.enroll') == url()->current() ? 'active' : ''}}">
                    <a href="{{ route('student.enroll') }}">
                        <i class="fa fa-file-text-o"></i> Enroll
                    </a>
                </li>
                <li class="{{ route('student.assessment') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('student.assessment') }}">
                        <i class="fa fa-file"></i> Assessment
                    </a>
                </li>
                <li class="{{ route('students.payments') == url()->current() ? 'active' : '' }}">
                    <a href="{{ route('students.payments') }}">
                        <i class="fa fa-paypal"></i> Paypal Payments
                    </a>
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