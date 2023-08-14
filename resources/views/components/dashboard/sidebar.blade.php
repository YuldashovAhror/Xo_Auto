<header class="main-nav">
    <div class="sidebar-user text-center">
        <img class="img-90 rounded-circle" src="/assets/images/dashboard/1.png" alt="">
        <a href="user-profile.html">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6>
        </a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Меню</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('dashboard.slider.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i>
                            <span>Slider</span>
                        </a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Feedbacks</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.order.index')}}">Orders</a></li>
                            <li><a href="{{route('dashboard.machinetype.index')}}">Machine type</a></li>
                            <li><a href="{{route('dashboard.feedback.index')}}">Feedbacks</a></li>
                            <li><a href="{{route('dashboard.type.index')}}">Feedback Type</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Steps</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.stepbook.index')}}">Step Book</a></li>
                            <li><a href="{{route('dashboard.step.index')}}">Step</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Comments</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.commentcompany.index')}}">Company Comment</a></li>
                            <li><a href="{{route('dashboard.usercomment.index')}}">User Comment</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Section</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.brend.index')}}">Brend</a></li>
                            <li><a href="{{route('dashboard.homevideo.index')}}">Home Video</a></li>
                            <li><a href="{{route('dashboard.homesection.index')}}">Home Section</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Blogs</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.blog.index')}}">List</a></li>
                            <li><a href="{{route('dashboard.blog.create')}}">create</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Works</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.work.index')}}">Work video</a></li>
                            <li><a href="{{route('dashboard.howwork.index')}}">How Work</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Services</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.service.index')}}">List</a></li>
                            <li><a href="{{route('dashboard.service.create')}}">Create</a></li>
                            {{-- <li><a href="{{route('dashboard.homesection.index')}}">Home Section</a></li> --}}
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Abouts</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.about.index')}}">List</a></li>
                            <li><a href="{{route('dashboard.about.create')}}">Create</a></li>
                            <li><a href="{{route('dashboard.aboutvideo.index')}}">About Video</a></li>
                            <li><a href="{{route('dashboard.aboutdiscription.index')}}">About discription</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('dashboard.review.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i>
                            <span>Review</span>
                        </a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i></i><span>Carriers</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.carriers.index')}}">Carrier</a></li>
                            <li><a href="{{route('dashboard.forcarriers.index')}}">For Carriers</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="{{route('dashboard.helpcenter.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i>
                            <span>Help Center</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="{{route('dashboard.team.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i>
                            <span>Team</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('dashboard.words.index')}}"><i data-feather="file-text"></i>
                            <span>Texts</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>