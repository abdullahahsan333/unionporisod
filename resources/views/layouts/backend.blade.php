<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="myApp">
    <head>
        @php($siteInfo = settings())
        @php($privilege = Auth::user()->privilege)
        <!-- required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- title -->
        <title>{{ (!empty($siteInfo->site_name) ? $siteInfo->site_name : '') }}</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset(!empty($siteInfo->favicon) ? $siteInfo->favicon : '') }}">

        <!-- ionicons css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <!-- toastr css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <!-- selectpicker css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <!-- datepicker css -->
        <link rel="stylesheet" href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css">
        <!-- perfect scrollbar css -->
        <link rel="stylesheet" href="{{asset('backend')}}/vendors/scrollbar/perfect-scrollbar.css">
        <!-- include style -->
        <link rel="stylesheet" href="{{asset('backend')}}/style/master.css">



        <!-- jQuery js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Anguler Js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>var app = angular.module('myApp', []);</script>
        @stack('header-style')
        @stack('header-script')
    </head>

    <body>
        {{--@dd($mainMenu)--}}
        <section class="wrapper" data-menu="{{(!empty($asideMenu) ? $asideMenu : '')}}" data-submenu="{{(!empty($asideSubmenu) ? $asideSubmenu : '')}}">
            <!-- panel aside start -->
            <aside class="panel_aside">
                <div class="brand">
                    <span class="brand_icon"><i class="icon ion-md-home"></i></span>
                    <h3>{{ strFilter(Auth::user()->name) }}</h3>
                    <a href="javascript:void(0)" id="panelClose_btn">
                        <i class="icon ion-ios-close io-36"></i>
                    </a>
                    <a href="javascript:void(0)" id="panelOpen_btn">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <!-- aside nav start -->
                <ul class="aside_nav">
                    @if(accessPrivilege("dashboard","",""))
                    <!-- dashboard -->
                    <li id="dashboard">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="menu_title">ড্যাশবোর্ড</span>
                        </a>
                    </li>
                    @endif


                    @if(accessPrivilege("member","",""))
                    <!-- Product -->
                    <li id="member" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-user-shield"></i>
                            <span class="menu_title">খানা সদস্য</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("member","new_member",""))
                            <li class="addMember"><a href="{{route('admin.member.create')}}">নতুন খানা সদস্য</a></li>
                            @endif

                            @if(accessPrivilege("member","all_member",""))
                            <li class="allMember"><a href="{{route('admin.member')}}">সকল খানা সদস্য</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("bazar_member","",""))
                    <!-- Bazar Member -->
                    <li id="bazar_member" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-user-shield"></i>
                            <span class="menu_title">বাজারের সদস্য</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("bazar_member","new_member",""))
                            <li class="addMember"><a href="{{route('admin.bazar_member.create')}}">নতুন সদস্য</a></li>
                            @endif
                            
                            @if(accessPrivilege("bazar_member","all_member",""))
                            <li class="allMember"><a href="{{route('admin.bazar_member')}}">সকল সদস্য</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("tax_collection","",""))
                    <!-- Tax Collection -->
                    <li id="tax_collection" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="menu_title">কর-সংগ্রহ</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("tax_collection","add_tax",""))
                            <li class="addTaxCollection"><a href="{{route('admin.tax-collection.create')}}">খানা সদস্য কর-সংগ্রহ করুন</a></li>
                            @endif
                            
                            @if(accessPrivilege("tax_collection","bazar_tax",""))
                            <li class="bazarTaxCollection"><a href="{{route('admin.tax-collection.bazar')}}">বাজারের সদস্য কর-সংগ্রহ করুন</a></li>
                            @endif
                            
                            @if(accessPrivilege("tax_collection","all_tax",""))
                            <li class="allTaxCollection"><a href="{{route('admin.tax-collection')}}">সকল কর দেখুন</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("notice","",""))
                    <!-- Notice -->
                    <li id="notice" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span class="menu_title">ট্যাক্স নোটিশ</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("notice","add_notice",""))
                            <li class="addNotice"><a href="{{route('admin.notice.create')}}">নতুন নোটিশ</a></li>
                            @endif
                            
                            @if(accessPrivilege("notice","all_notice",""))
                            <li class="allNotice"><a href="{{route('admin.notice')}}">সকল নোটিশ</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("report","",""))
                    <!-- Report -->
                    <li id="report" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-flag"></i>
                            <span class="menu_title">রিপোর্ট</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("report","union_report",""))
                            <li class="unionReport"><a href="{{route('admin.reports.union_report')}}">ইউনিয়ন রিপোর্ট</a></li>
                            @endif
                            
                            @if(accessPrivilege("report","member_wise_tax_report",""))
                            <li class="memberReport"><a href="{{route('admin.reports.member')}}">সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
                            @endif
                            
                            @if(accessPrivilege("report","bazar_member_wise_tax_report",""))
                            <li class="memberReport"><a href="{{route('admin.reports.bazar_member')}}">বাজার সদস্য ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
                            @endif
                            
                            @if(accessPrivilege("report","ward_wise_tax_report",""))
                            <li class="wardReport"><a href="{{route('admin.reports.ward')}}">ওয়ার্ড ওয়াইজ ট্যাক্স রিপোর্ট</a></li>
                            @endif
                            
                            @if(accessPrivilege("report","daily_tax_report",""))
                            <li class="collectionReport"><a href="{{route('admin.reports.collection')}}">দৈনিক ট্যাক্স সংগ্রহ রিপোর্ট</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("trade_license","",""))
                    <!-- Mobile Sms -->
                    <li id="trade_license" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-trademark"></i>
                            <span class="menu_title">ট্রেড লাইসেন্স</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("trade_license","add_trade",""))
                            <li class="add_trade"><a href="{{route('admin.trade_license.create')}}"> নতুন ট্রেড লাইসেন্স </a></li>
                            @endif
                            
                            @if(accessPrivilege("trade_license","all_trade",""))
                            <li class="all_trade"><a href="{{route('admin.trade_license')}}"> সকল ট্রেড লাইসেন্স </a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("affidavit","",""))
                    <!-- Affidavit -->
                    <li id="affidavit" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-file-invoice"></i>
                            <span class="menu_title">প্রত্যয়ন পত্র</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("affidavit","new_affidavit",""))
                            <li class="newAffidavit"><a href="{{route('admin.affidavit.new_affidavit')}}">১ম প্রত্যয়ন পত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","add_affidavit",""))
                            <li class="addAffidavit"><a href="{{route('admin.affidavit.create')}}">২য় নাগরিকত্ব সনদপত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","inheritance_certificate",""))
                            <li class="inheritanceCertificate"><a href="{{route('admin.affidavit.inheritance')}}">৩য় উত্তরাধিকার সনদপত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","family_certificate",""))
                            <li class="familyCertificate"><a href="{{route('admin.affidavit.family')}}">৪র্থ পারিবারিক সনদপত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","unmarried_certificate",""))
                            <li class="unmarriedCertificate"><a href="{{route('admin.affidavit.unmarried')}}">৫ম অবিবাহিত সনদপত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","married_certificate",""))
                            <li class="marriedCertificate"><a href="{{route('admin.affidavit.married')}}">৬ষ্ঠ বিবাহিত সনদপত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","income_certificate",""))
                            <li class="incomeCertificate"><a href="{{route('admin.affidavit.income')}}">৭ম বার্ষিক আয় সনদপত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","carecture_certificate",""))
                            <li class="carectureCertificate"><a href="{{route('admin.affidavit.carecture')}}">৮ম চারিত্রিক সনদপত্র </a></li>
                            @endif

                            @if(accessPrivilege("affidavit","all_affidavit",""))
                            <li class="allAffidavit"><a href="{{route('admin.affidavit')}}" >সকল সনদপত্র</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("sms","",""))
                    <!-- Mobile Sms -->
                    <li id="sms" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-comment-dots"></i>
                            <span class="menu_title">এসএমএস</span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("sms","custom_sms",""))
                            <li class="customSms"><a href="{{route('admin.sms.custom_sms')}}">কাস্টম এসএমএস</a></li>
                            @endif
                            
                            @if(accessPrivilege("sms","send_sms",""))
                            <li class="sendSms"><a href="{{route('admin.sms.send_sms')}}">সেন্ড এসএমএস</a></li>
                            @endif
                            
                            @if(accessPrivilege("sms","sms_report",""))
                            <li class="smsReport"><a href="{{route('admin.sms')}}">এসএমএস রিপোর্ট</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(accessPrivilege("chairman","",""))
                    <!-- Chairman -->
                    <li id="chairman" class="dropdown">
                        <a href="javascript:void(0)">
                            <i class="fas fa-people-arrows"></i>
                            <span class="menu_title"> চেয়ারম্যান ও সচিব </span>
                            <span class="menu_arrow">
                                <i class="icon ion-ios-arrow-forward right"></i>
                                <i class="icon ion-ios-arrow-down down"></i>
                            </span>
                        </a>
                        <ul>
                            @if(accessPrivilege("chairman","add_chairman",""))
                            <li class="addChairman"><a href="{{route('admin.chairman.create')}}">নতুন চেয়ারম্যান</a></li>
                            @endif

                            @if(accessPrivilege("chairman","all_chairman",""))
                            <li class="allChairman"><a href="{{route('admin.chairman')}}">সব দেখুন</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    <!-- Not User Only Admin & Super -->
                    @if($privilege != 'user')
                        @if(accessPrivilege("user","",""))
                        <li id="user" class="dropdown">
                            <a href="javascript:void(0)">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="menu_title">ইউজার</span>
                                <span class="menu_arrow">
                                    <i class="icon ion-ios-arrow-forward right"></i>
                                    <i class="icon ion-ios-arrow-down down"></i>
                                </span>
                            </a>
                            <ul>
                                @if(accessPrivilege("user","add_user",""))
                                <li class="add_user"><a href="{{route('admin.user.create')}}">নতুন ইউজার</a></li>
                                @endif
                                
                                @if(accessPrivilege("user","all_user",""))
                                <li class="all_user"><a href="{{route('admin.user')}}">সকল ইউজার</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        @if(accessPrivilege("privilege","",""))
                        <!-- privilege -->
                        <li id="privilege">
                            <a href="{{route('admin.privilege')}}">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="menu_title">প্রিভিলেজ</span>
                            </a>
                        </li>
                        @endif

                        @if(accessPrivilege("settings","",""))
                        <!-- Settings -->
                        <li id="settings">
                            <a href="{{route('admin.settings')}}">
                                <i class="fas fa-cogs"></i>
                                <span class="menu_title">সেটিংস</span>
                            </a>
                        </li>
                        @endif
                    @endif
                </ul>
            </aside>
            <!-- panel aside end -->


            <!-- body section start -->
            <div class="main_body">
                <!-- main nav start -->
                <nav class="main_nav">
                    <ul class="function_menu">
                        <li class="user_dropdown">
                            <a href="javascript:void(0)" id="aside-toggle">
                                <i class="icon ion-ios-menu io-23"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="user_menu">
                        <!-- message -->
                        <li class="user_dropdown">
                            <a href="javascript:void(0)" class="menu-button">
                                <i class="icon ion-ios-mail io-21"></i>
                            </a>
                            <ul class="sub_menu">
                                <li class="head">
                                    <a href="javascript:void(0)">
                                        <h6>You have 2 Message</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span>Awesome aminmate.css</span>
                                        <small>10 minit ago</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span>Awesome aminmate.css</span>
                                        <small>10 minit ago</small>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- profile -->
                        <li class="user_dropdown">
                            <a href="javascript:void(0)" class="menu-button">
                                @if(!empty(Auth::user()->avatar))
                                    <img src="{{asset(Auth::user()->avatar)}}" alt="">
                                @else
                                    <img src="{{asset('backend')}}/images/user/02.png" alt="">
                                @endif
                            </a>
                            <ul class="sub_menu">
                                <li class="head">
                                    <a href="">
                                        <h6>{{strFilter(Auth::user()->name)}}</h6>
                                        <small>{{strFilter(Auth::user()->privilege)}}</small>
                                    </a>
                                </li>
                                <li><a href="{{route('admin.user.show', strEncode(Auth::user()->id))}}">প্রোফাইল</a></li>
                                <li>
                                    <a href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">লগআউট</a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- main nav end -->

                @yield('content')
            </div>
            <!-- body section end -->


            <!-- footer start -->
            <!--<div class="developer">-->
            <!--    <p>Developed By : <a href="https://freelanceitlab.com/" target="_blank">Freelance It Lab</a></p>-->
            <!--</div>-->
            <div class="wrapper_background"></div>
        </section>


        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
        <!-- selectpicker js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <!-- toastr js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- ckeditor4 js -->
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        <!-- datepicker js -->
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
        <!-- perfect scrollbar js -->
        <script src="{{asset('backend')}}/vendors/scrollbar/perfect-scrollbar.min.js"></script>

        <!-- include js -->
        <script src="{{asset('backend')}}/js/app.js"></script>
        <script src="{{asset('backend')}}/js/ngScript.js"></script>

        @include('components.toastr')

        @stack('footer-style')
        @stack('footer-script')
    </body>
</html>

