<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>
        Dashboard - {{$setting->name}} | @yield('title')
    </title>
    <meta name="description" content="Latest updates and statistic charts" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @includeIf('layouts.dashboard.css')
    @yield('css')
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{route('dashboard_admin.index')}}" class="m-brand__logo-wrapper">
                                <img style="width: 60px;height:60px;text-align: center;border-radius: 100%;" alt="{{$setting->name}}" src="{{url('/').$get_url_photo.$setting->logo}}"/>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block
					 ">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Header Menu Toggler -->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>
                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    <!-- BEGIN: Horizontal Menu -->
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                        <i class="la la-close"></i>
                    </button>
                    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-add"></i>
                                    <span class="m-menu__link-text">
												Actions
											</span>
                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item "  aria-haspopup="true">
                                            <a  href="" class="m-menu__link ">
                                                <i class="m-menu__link-icon flaticon-file"></i>
                                                <span class="m-menu__link-text">
															Create New Managing Consulting
												</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- END: Horizontal Menu -->
                    <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img style="width:40px;height: 40px;" src="{{url($get_url_photo.$user->avatar)}}" class="m--img-rounded m--marginless m--img-centered" alt="{{$user->name}}"/>
												</span>
                                        <span class="m-topbar__username m--hide">
												{{$user->name}}
												</span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center" style="background: url(/dashboard/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img style="width:70px;height: 70px;" src="{{url($get_url_photo.$user->avatar)}}" class="m--img-rounded m--marginless" alt="{{$user->name}}"/>
                                                    </div>
                                                    <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	{{$user->name}}
																</span>
                                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                            {{$user->email}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{route('profile',['email'=>$user->email,'id'=>$user->id])}}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>
																			</span>
																		</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('logout') }}"
                                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form2').submit();" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                Logout
                                                            </a>
                                                            <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Topbar -->
                </div>
            </div>
        </div>
    </header>
    <!-- END: Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
            <div
                    id="m_ver_menu"
                    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                    data-menu-vertical="true"
                    data-menu-scrollable="false" data-menu-dropdown-timeout="500"
            >
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__item m-menu__item--active " aria-haspopup="true" >
                        <a  href="{{route('dashboard_admin.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Dashboard
											</span>
										</span>
									</span>
                        </a>
                    </li>
                    <li class="m-menu__section">
                        <h4 class="m-menu__section-text">
                            Components
                        </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                    </li>
                    <li class="m-menu__item  " aria-haspopup="true" >
                        <a  href="{{route('post.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-transport"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
											 Register Post
											</span>
										</span>
									</span>
                        </a>
                    </li>
                    <li class="m-menu__item  " aria-haspopup="true" >
                        <a  href="{{route('travel.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-transport"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
											 Register Travel
											</span>
										</span>
									</span>
                        </a>
                    </li>
                    <li class="m-menu__item  " aria-haspopup="true" >
                        <a  href="{{route('tourism_companies.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-transport"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
											 Register Tourism Companies
											</span>
										</span>
									</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('countries.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-coins"></i>
                            <span class="m-menu__link-text">
															Register Countries
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('users.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-users"></i>
                            <span class="m-menu__link-text">
															Register Users
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('partner.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-user-add"></i>
                            <span class="m-menu__link-text">
															Register Pratner
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('setting_admin.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-settings"></i>
                            <span class="m-menu__link-text">
															Setting Site
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('feedback.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-information"></i>
                            <span class="m-menu__link-text">
															FeedBack Clients
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('comment_users.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-information"></i>
                            <span class="m-menu__link-text">
															Approve Comment User
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('newsletter.index')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-signs"></i>
                            <span class="m-menu__link-text">
															Newsletter
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                        <a  href="{{route('home_page')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-web"></i>
                            <span class="m-menu__link-text">
															Site {{$setting->name}}
														</span>
                        </a>
                    </li>
                    <li class="m-menu__item  " aria-haspopup="true" >
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form3').submit();" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-logout"></i>
                            <span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
											Logout
											</span>
										</span>
									</span>
                        </a>
                        <form id="logout-form3" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            @yield('title')
                        </h3>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- end:: Body -->
    <!-- begin::Footer -->
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								&copy; {{date('Y')}} Total Tech. All Rights Reserved
							</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->
</div>


<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<div class="modal fade" id="ModDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deletion process</h4>
            </div>
            <div class="modal-body">
                {{csrf_field()}}
                <input id="iddel" name="id" type="hidden">
                <p class="text-danger">
                    are sure of the deleting process
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn_deleted btn btn-danger">Yes,sure</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@includeIf('layouts.dashboard.scripts')

<script>

    $(document).ready(function () {

        $('.pagination .active').attr('class','page_style_active');
        $('.pagination .disabled').attr('class','page_style');

        $('.datepicker').datepicker();

        $('.sumernote').summernote({
            height:200,
            codemirror: {
                "theme": "ambiance"
            },
            focus: false,
            placeholder: 'write here...',
            fontname: ["Roboto","Arial", "Arial Black", "Comic Sans MS", "Courier New",
                "Helvetica Neue", "Helvetica", "Impact", "Lucida Grande",
                "Tahoma", "Times New Roman", "Verdana"],
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['fontname', ["fontname"]],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview']],
                ["table", ["table"]],
                ["insert", ["link", "hr"]],
                ["help", ["help"]]
            ],
        });


        $('.modal .close').click(function () {
            $('#data_Table tbody tr').css('background','transparent');
        });

        $('.modal .btn-secondary').click(function () {
            $('#data_Table tbody tr').css('background','transparent');
        });

        $('.modal .btn-default').click(function () {
            $('#data_Table tbody tr').css('background','transparent');
        });

        $(document).on('keyup',function(evt) {
            if (evt.keyCode == 27) {
                $('#data_Table tbody tr').css('background','transparent');
            }
        });

    });


</script>
@yield('js')

</body>
<!-- end::Body -->
</html>
