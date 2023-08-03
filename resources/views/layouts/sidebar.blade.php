{{-- WHEN PLATFORM ADMIN LOGINS --}}
@if (Auth::user()->user_type == 1)
<div class="left-side-bar" style="background-color: lightblue;">
    <div class="brand-logo">
        <a href="{{ url('platformadmin/dashboard') }}">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="dark-logo">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu icon-style-1 icon-list-style-6">
            <ul id="accordion-menu">
                <li class="@if (Request::segment(2) == 'dashboard') dropdown show @endif">
                    <a href="{{ url('platformadmin/dashboard') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-home"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>

                <li class="@if (Request::segment(2) == 'view_all_company' ||
                                Request::segment(2) == 'view_pending_company' ||
                                Request::segment(2) == 'view_suspend_company' ||
                                Request::segment(2) == 'create_new_sys_admin_account_for_company' ) dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-building"></span>
                        <span class="mtext">Companies</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('platformadmin/company/view_all_company') }}"
                                class="@if (Request::segment(3) == 'view_all_company') active @endif" style="font-size: 1.5rem;">View All Company</a>
                        </li>
                        <li>
                            <a href="{{ url('platformadmin/company/view_pending_company') }}"
                                class="@if (Request::segment(3) == 'view_pending_company') active @endif" style="font-size: 1.5rem;">Pending Company</a>
                        </li>
                        <li>
                            <a href="{{ url('platformadmin/company/view_suspend_company') }}"
                                class="@if (Request::segment(3) == 'view_suspend_company') active @endif" style="font-size: 1.5rem;">Suspend Company</a>
                        </li>
                        <li>
                            <a href="{{ url('platformadmin/account/create_new_sys_admin_account_for_company') }}"
                                class="@if (Request::segment(3) == 'create_new_sys_admin_account_for_company') active @endif" style="font-size: 1.5rem;">Create New System Admin</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'view_all_seller' ||
                                Request::segment(2) == 'view_pending_seller' ||
                                Request::segment(2) == 'create_new_sys_admin_account_for_seller') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-building"></span>
                        <span class="mtext">Sellers</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('platformadmin/seller/view_all_seller') }}"
                                class="@if (Request::segment(3) == 'view_all_seller') active @endif" style="font-size: 1.5rem;">View All Seller</a>
                        </li>
                        <li>
                            <a href="{{ url('platformadmin/seller/view_pending_seller') }}"
                                class="@if (Request::segment(3) == 'view_pending_seller') active @endif" style="font-size: 1.5rem;">Pending Seller</a>
                        </li>
                        <li>
                            <a href="{{ url('platformadmin/account/create_new_sys_admin_account_for_seller') }}"
                                class="@if (Request::segment(3) == 'create_new_sys_admin_account_for_seller') active @endif" style="font-size: 1.5rem;">Create New System Admin </a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'my_account' ||
                                Request::segment(2) == 'change_password') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon bi bi-gear-fill"></span><span class="mtext">My Account</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('platformadmin/settings/my_account') }}"
                                class="@if (Request::segment(3) == 'my_account') active @endif" style="font-size: 1.5rem;">My Account</a>
                        </li>
                        <li>
                            <a href="{{ url('platformadmin/settings/change_password') }}"
                                class="@if (Request::segment(3) == 'change_password') active @endif" style="font-size: 1.5rem;">Change Password</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- WHEN SELLER LOGINS --}}
@elseif (Auth::user()->user_type == 2)
<div class="left-side-bar" style="background-color: lightblue;">
    <div class="brand-logo">
        <a href="{{ url('seller/dashboard') }}">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="dark-logo">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu icon-style-1 icon-list-style-6">
            <ul id="accordion-menu">
                <li class="@if (Request::segment(2) == 'dashboard') dropdown show @endif">
                    <a href="{{ url('seller/dashboard') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-home"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>

                <li class="@if (Request::segment(2) == 'add_new_product' ||
                            Request::segment(2) == 'view_all_products' ||
                            Request::segment(2) == 'view_individual_product' ||
                            Request::segment(2) == 'view_delete_product') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-user"></span>
                        <span class="mtext">Products</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('seller/product/add_new_product') }}"
                                class="@if (Request::segment(3) == 'add_new_product') active @endif" style="font-size: 1.5rem;">Add New Product</a>
                        </li>
                        <li>
                            <a href="{{ url('seller/product/view_all_products') }}"
                                class="@if (Request::segment(3) == 'view_all_products' || Request::segment(3) == 'view_individual_product') active @endif" style="font-size: 1.5rem;">View All Products</a>
                        </li>
                        <li>
                            <a href="{{ url('seller/product/view_delete_product') }}"
                                class="@if (Request::segment(3) == 'view_delete_product') active @endif" style="font-size: 1.5rem;">Deleted Product</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'my_account' ||
                                Request::segment(2) == 'change_password') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon bi bi-gear-fill"></span><span class="mtext">My Account</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('seller/settings/my_account') }}"
                                class="@if (Request::segment(3) == 'my_account') active @endif" style="font-size: 1.5rem;">My Account</a>
                        </li>
                        <li>
                            <a href="{{ url('seller/settings/change_password') }}"
                                class="@if (Request::segment(3) == 'change_password') active @endif" style="font-size: 1.5rem;">Change Password</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- WHEN SYSTEM ADMIN LOGINS --}}
@elseif (Auth::user()->user_type == 4)
    @if (Auth::user()->user_status == 0)
    <div class="left-side-bar" style="background-color: lightblue;">
        <div class="brand-logo">
            <a href="{{ url('systemadmin/dashboard') }}">
                <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="dark-logo">
                <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu icon-style-1 icon-list-style-6">
                <ul id="accordion-menu">
                    <li class="@if (Request::segment(2) == 'dashboard') dropdown show @endif">
                        <a href="{{ url('systemadmin/dashboard') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                            <span class="micon fa fa-home"></span>
                            <span class="mtext">Home</span>
                        </a>
                    </li>

                    <li class="@if (Request::segment(2) == 'make_payment') dropdown show @endif">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                            <span class="micon bi bi-cash"></span><span class="mtext">Payment</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('systemadmin/payment/make_payment') }}"
                                    class="@if (Request::segment(3) == 'make_payment') active @endif" style="font-size: 1.5rem;">Make Payment</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if (Request::segment(2) == 'my_account'
                                || Request::segment(2) == 'change_password') dropdown show @endif">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                            <span class="micon bi bi-gear-fill"></span><span class="mtext">My Account</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('systemadmin/settings/my_account') }}"
                                    class="@if (Request::segment(3) == 'my_account') active @endif" style="font-size: 1.5rem;">My Account</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/settings/change_password') }}"
                                    class="@if (Request::segment(3) == 'change_password') active @endif" style="font-size: 1.5rem;">Change Password</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                            <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="left-side-bar" style="background-color: lightblue;">
        <div class="brand-logo">
            <a href="{{ url('systemadmin/dashboard') }}">
                <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="dark-logo">
                <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu icon-style-1 icon-list-style-6">
                <ul id="accordion-menu">
                    <li class="@if (Request::segment(2) == 'dashboard') dropdown show @endif">
                        <a href="{{ url('systemadmin/dashboard') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                            <span class="micon fa fa-home"></span>
                            <span class="mtext">Home</span>
                        </a>
                    </li>

                    <li class="@if (Request::segment(2) == 'create_new_roles' ||
                                    Request::segment(2) == 'view_all_roles' ||
                                    Request::segment(2) == 'view_individual_role' ||
                                    Request::segment(3) == 'edit_roles' ||
                                    Request::segment(2) == 'view_deleted_roles' ||
                                    Request::segment(2) == 'view_suspend_roles') dropdown show @endif">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                            <span class="micon fa fa-user"></span>
                            <span class="mtext">User Roles</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('systemadmin/roles/create_new_roles') }}"
                                    class="@if (Request::segment(3) == 'create_new_roles') active @endif" style="font-size: 1.5rem;">Create New Roles</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/roles/view_all_roles') }}"
                                    class="@if (Request::segment(3) == 'view_all_roles' || Request::segment(3) == 'view_individual_role') active @endif" style="font-size: 1.5rem;">View All Roles</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/roles/view_deleted_roles') }}"
                                    class="@if (Request::segment(3) == 'view_deleted_roles') active @endif" style="font-size: 1.5rem;">Deleted Roles</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/roles/view_suspend_roles') }}"
                                    class="@if (Request::segment(3) == 'view_suspend_roles') active @endif" style="font-size: 1.5rem;">Suspend Role</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if (Request::segment(2) == 'create_new_account' ||
                                    Request::segment(2) == 'view_all_account' ||
                                    Request::segment(3) == 'edit_account' ||
                                    Request::segment(2) == 'view_individual_account' ||
                                    Request::segment(2) == 'view_deleted_account' ||
                                    Request::segment(2) == 'view_suspend_account') dropdown show @endif">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                            <span class="micon fa fa-users"></span>
                            <span class="mtext">User Account</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('systemadmin/account/create_new_account') }}"
                                    class="@if (Request::segment(3) == 'create_new_account') active @endif" style="font-size: 1.5rem;">Create New Account</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/account/view_all_account') }}"
                                    class="@if (Request::segment(3) == 'view_all_account' || Request::segment(3) == 'view_individual_account') active @endif" style="font-size: 1.5rem;">View All Account</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/account/view_deleted_account') }}"
                                    class="@if (Request::segment(3) == 'view_deleted_account') active @endif" style="font-size: 1.5rem;">Deleted Account</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/account/view_suspend_account') }}"
                                    class="@if (Request::segment(3) == 'view_suspend_account') active @endif" style="font-size: 1.5rem;">Suspend Account</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if (Request::segment(2) == 'my_account' ||
                                    Request::segment(2) == 'change_password') dropdown show @endif">
                        <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                            <span class="micon bi bi-gear-fill"></span><span class="mtext">My Account</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('systemadmin/settings/my_account') }}"
                                    class="@if (Request::segment(3) == 'my_account') active @endif" style="font-size: 1.5rem;">My Account</a>
                            </li>
                            <li>
                                <a href="{{ url('systemadmin/settings/change_password') }}"
                                    class="@if (Request::segment(3) == 'change_password') active @endif" style="font-size: 1.5rem;">Change Password</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                            <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif

{{-- WHEN HR & CUSTOMER SERVICE LOGINS --}}
@elseif (Auth::user()->user_type == 5)
<div class="left-side-bar" style="background-color: lightblue;">
    <div class="brand-logo">
        <a href="{{ url('hr_customer_service/dashboard') }}">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="dark-logo">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu icon-style-1 icon-list-style-6">
            <ul id="accordion-menu">
                <li class="@if (Request::segment(2) == 'dashboard') dropdown show @endif">
                    <a href="{{ url('hr_customer_service/dashboard') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-home"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>

                <li class="@if (Request::segment(2) == 'view_all_customer_pending_bills' ||
                                Request::segment(2) == 'view_void_bills') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-money"></span>
                        <span class="mtext">Customer <br>Billing</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('hr_customer_service/customerbilling/view_all_customer_pending_bills') }}"
                                class="@if (Request::segment(3) == 'view_all_customer_pending_bills') active @endif" style="font-size: 1.5rem;">View Pending Customer Billing</a>
                        </li>
                        <li>
                            <a href="{{ url('hr_customer_service/customerbilling/view_void_bills') }}"
                                class="@if (Request::segment(3) == 'view_void_bills') active @endif" style="font-size: 1.5rem;">View Void Bills</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'view_all_customer_payment') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-money"></span>
                        <span class="mtext">Customer <br>Payment</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('hr_customer_service/customerpayment/view_all_customer_payment') }}"
                                class="@if (Request::segment(3) == 'view_all_customer_payment' || Request::segment(3) == 'view_individual_customer_payment_history') active @endif" style="font-size: 1.5rem;">View Customer Payment</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'view_feedback' ||
                                Request::segment(2) == 'view_individual_feedback' ||
                                Request::segment(2) == 'view_service_request' ||
                                Request::segment(2) == 'view_individual_service_request' ||
                                Request::segment(2) == 'issue_credits' ) dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-comments"></span>
                        <span class="mtext">Customer <br>Interaction</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('hr_customer_service/customerinteraction/view_feedback') }}"
                                class="@if (Request::segment(3) == 'view_feedback' || Request::segment(3) == 'view_individual_feedback') active @endif" style="font-size: 1.5rem;">View Feedback</a>
                        </li>
                        <li>
                            <a href="{{ url('hr_customer_service/customerinteraction/view_service_request') }}"
                                class="@if (Request::segment(3) == 'view_service_request' || Request::segment(3) == 'view_individual_service_request') active @endif" style="font-size: 1.5rem;">View Service Request</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'my_account' ||
                                Request::segment(2) == 'change_password') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon bi bi-gear-fill"></span><span class="mtext">My Account</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('hr_customer_service/settings/my_account') }}"
                                class="@if (Request::segment(3) == 'my_account') active @endif" style="font-size: 1.5rem;">My Account</a>
                        </li>
                        <li>
                            <a href="{{ url('hr_customer_service/settings/change_password') }}"
                                class="@if (Request::segment(3) == 'change_password') active @endif" style="font-size: 1.5rem;">Change Password</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- WHEN SUPERVISOR LOGINS --}}
@elseif (Auth::user()->user_type == 6)
<div class="left-side-bar" style="background-color: lightblue;">
    <div class="brand-logo">
        <a href="{{ url('supervisor/dashboard') }}">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="dark-logo">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu icon-style-1 icon-list-style-6">
            <ul id="accordion-menu">
                <li class="@if (Request::segment(2) == 'dashboard') dropdown show @endif">
                    <a href="{{ url('supervisor/dashboard') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-home"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>

                <li class="@if (Request::segment(2) == 'create_new_equipment' ||
                                Request::segment(2) == 'view_all_equipment' ||
                                Request::segment(3) == 'edit_equipment' ||
                                Request::segment(2) == 'view_individual_equipment' ||
                                Request::segment(2) == 'view_deleted_equipment' ||
                                Request::segment(2) == 'view_suspend_equipment') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-user"></span>
                        <span class="mtext">Equipments</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('supervisor/equipment/create_new_equipment') }}"
                                class="@if (Request::segment(3) == 'create_new_equipment') active @endif" style="font-size: 1.5rem;">Create New Equipment </a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/equipment/view_all_equipment' ) }}"
                                class="@if (Request::segment(3) == 'view_all_equipment' || Request::segment(3) == 'view_individual_equipment') active @endif" style="font-size: 1.5rem;">View All Equipments</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/equipment/view_deleted_equipment') }}"
                                class="@if (Request::segment(3) == 'view_deleted_equipment') active @endif" style="font-size: 1.5rem;">Deleted Equipments</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/equipment/view_suspend_equipment') }}"
                                class="@if (Request::segment(3) == 'view_suspend_equipment') active @endif" style="font-size: 1.5rem;">Suspend Equipments</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'create_new_chemical' ||
                                Request::segment(2) == 'view_all_chemical' ||
                                Request::segment(3) == 'edit_chemical' ||
                                Request::segment(2) == 'view_individual_chemical' ||
                                Request::segment(2) == 'view_deleted_chemical' ||
                                Request::segment(2) == 'view_suspend_chemical') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-user"></span>
                        <span class="mtext">Chemicals</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('supervisor/chemical/create_new_chemical') }}"
                                class="@if (Request::segment(3) == 'create_new_chemical') active @endif" style="font-size: 1.5rem;">Create New Chemical</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/chemical/view_all_chemical' ) }}"
                                class="@if (Request::segment(3) == 'view_all_chemical' || Request::segment(3) == 'view_individual_chemical') active @endif" style="font-size: 1.5rem;">View All Chemicals</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/chemical/view_deleted_chemical') }}"
                                class="@if (Request::segment(3) == 'view_deleted_chemical') active @endif" style="font-size: 1.5rem;">Deleted Chemicals</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/chemical/view_suspend_chemical') }}"
                                class="@if (Request::segment(3) == 'view_suspend_chemical') active @endif" style="font-size: 1.5rem;">Suspend Chemicals</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'create_new_water_supply_equipment' ||
                                Request::segment(2) == 'view_all_water_supply_equipment' ||
                                Request::segment(3) == 'edit_water_supply_equipment' ||
                                Request::segment(2) == 'view_individual_water_supply_equipment' ||
                                Request::segment(2) == 'view_deleted_water_supply_equipment' ||
                                Request::segment(2) == 'view_suspend_water_supply_equipment') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon bi bi-hammer"></span>
                        <span class="mtext">Water Supply <br> Equipment</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('supervisor/water_supply_equipment/create_new_water_supply_equipment') }}"
                                class="@if (Request::segment(3) == 'create_new_water_supply_equipment') active @endif" style="font-size: 1.5rem;">Create New Water Supply Equipment</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/water_supply_equipment/view_all_water_supply_equipment') }}"
                                class="@if (Request::segment(3) == 'view_all_water_supply_equipment' || Request::segment(3) == 'view_individual_water_supply_equipment') active @endif" style="font-size: 1.5rem;">View All Water Supply Equipment</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/water_supply_equipment/view_deleted_water_supply_equipment') }}"
                                class="@if (Request::segment(3) == 'view_deleted_water_supply_equipment') active @endif" style="font-size: 1.5rem;">Deleted Water Supply Equipment</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/water_supply_equipment/view_suspend_water_supply_equipment') }}"
                                class="@if (Request::segment(3) == 'view_suspend_water_supply_equipment') active @endif" style="font-size: 1.5rem;">Suspend Water Supply Equipment</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'view_all_customer_meter_reading' ||
                                Request::segment(2) == 'view_individual_customer_meter_reading' ||
                                Request::segment(2) == 'view_customer_by_region' ||
                                Request::segment(3) == 'view_customer_north_region' ||
                                Request::segment(3) == 'view_customer_south_region' ||
                                Request::segment(3) == 'view_customer_east_region' ||
                                Request::segment(3) == 'view_customer_west_region' ) dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-tasks"></span>
                        <span class="mtext">Reports & <br>Analysis</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('supervisor/report_analysis/view_all_customer_meter_reading') }}"
                                class="@if (Request::segment(3) == 'view_all_customer_meter_reading' ||
                                            Request::segment(3) == 'view_individual_customer_meter_reading') active @endif" style="font-size: 1.5rem;">View Meter Reading</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/report_analysis/view_customer_by_region') }}"
                                class="@if (Request::segment(3) == 'view_customer_by_region' ||
                                            Request::segment(3) == 'view_customer_north_region' ||
                                            Request::segment(3) == 'view_customer_south_region' ||
                                            Request::segment(3) == 'view_customer_east_region' ||
                                            Request::segment(3) == 'view_customer_west_region') active @endif" style="font-size: 1.5rem;">View Customer By Region</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'create_new_job' ||
                                Request::segment(2) == 'view_all_pending_job' ||
                                Request::segment(3) == 'edit_job' ||
                                Request::segment(2) == 'view_all_completed_job' ||
                                Request::segment(3) == 'view_comment' ||
                                Request::segment(2) == 'view_all_job_require_assistance' ||
                                Request::segment(2) == 'view_deleted_job') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-tasks"></span>
                        <span class="mtext">Job <br>Management</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('supervisor/job/create_new_job') }}"
                                class="@if (Request::segment(3) == 'create_new_job' || Request::segment(3) == 'send_assistance') active @endif" style="font-size: 1.5rem;">Create New Jobs</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/job/view_all_pending_job') }}"
                                class="@if (Request::segment(3) == 'view_all_pending_job' || Request::segment(3) == 'view_more_job_description' ) active @endif" style="font-size: 1.5rem;">View All Pending Jobs</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/job/view_all_completed_job') }}"
                                class="@if (Request::segment(3) == 'view_all_completed_job' ||  Request::segment(3) == 'view_report' ) active @endif" style="font-size: 1.5rem;">View All Completed Jobs by Technicians</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/job/view_all_job_require_assistance') }}"
                                class="@if (Request::segment(3) == 'view_all_job_require_assistance' ) active @endif" style="font-size: 1.5rem;">View All Jobs Require Assistance</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/job/view_deleted_job') }}"
                                class="@if (Request::segment(3) == 'view_deleted_job') active @endif" style="font-size: 1.5rem;">View All Deleted Job</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'my_account' ||
                                Request::segment(2) == 'change_password') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon bi bi-gear-fill"></span><span class="mtext">My Account</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('supervisor/settings/my_account') }}"
                                class="@if (Request::segment(3) == 'my_account') active @endif" style="font-size: 1.5rem;">My Account</a>
                        </li>
                        <li>
                            <a href="{{ url('supervisor/settings/change_password') }}"
                                class="@if (Request::segment(3) == 'change_password') active @endif" style="font-size: 1.5rem;">Change Password</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- WHEN TECHNICAN LOGINS --}}
@elseif (Auth::user()->user_type == 7)
<div class="left-side-bar" style="background-color: lightblue;">
    <div class="brand-logo">
        <a href="{{ url('technician/dashboard') }}">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="dark-logo">
            <img src="{{ url('WaterWiseLogo.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu icon-style-1 icon-list-style-6">
            <ul id="accordion-menu">
                <li class="@if (Request::segment(2) == 'dashboard') dropdown show @endif">
                    <a href="{{ url('technician/dashboard') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-home"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>

                <li class="@if (Request::segment(2) == 'view_pending_job' ||
                                Request::segment(2) == 'view_more_job_description' ||
                                Request::segment(3) == 'update_job' ||
                                Request::segment(3) == 'comment') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-tasks"></span>
                        <span class="mtext">Job <br>Managment</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('technician/job/view_pending_job') }}"
                                class="@if (Request::segment(3) == 'view_pending_job' ||
                                            Request::segment(3) == 'view_more_job_description') active @endif" style="font-size: 1.5rem;">View Pending Job</a>
                        </li>
                        <li>
                            <a href="{{ url('technician/job/view_my_completed_jobs') }}"
                                class="@if (Request::segment(3) == 'view_my_completed_jobs' || Request::segment(3) == 'report') active @endif" style="font-size: 1.5rem;">View My Completed Job</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'view_customer_by_region' ||
                                Request::segment(3) == 'view_customer_north_region' ||
                                Request::segment(3) == 'view_customer_south_region' ||
                                Request::segment(3) == 'view_customer_east_region' ||
                                Request::segment(3) == 'view_customer_west_region') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-users"></span>
                        <span class="mtext">Customer <br>Management</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('technician/customermanagement/view_customer_by_region') }}"
                                class="@if (Request::segment(3) == 'view_customer_by_region' ||
                                            Request::segment(3) == 'view_customer_north_region' ||
                                            Request::segment(3) == 'view_customer_south_region' ||
                                            Request::segment(3) == 'view_customer_east_region' ||
                                            Request::segment(3) == 'view_customer_west_region') active @endif" style="font-size: 1.5rem;">View Customer By Region</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'view_all_customer_meter_reading' ||
                                Request::segment(2) == 'view_individual_customer_meter_reading') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon fa fa-users"></span>
                        <span class="mtext">Meter Reading</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('technician/meterreading/view_all_customer_meter_reading') }}"
                                class="@if (Request::segment(3) == 'view_all_customer_meter_reading' ||
                                            Request::segment(3) == 'view_individual_customer_meter_reading') active @endif" style="font-size: 1.5rem;">View Meter Reading</a>
                        </li>
                    </ul>
                </li>

                <li class="@if (Request::segment(2) == 'my_account' ||
                                Request::segment(2) == 'change_password') dropdown show @endif">
                    <a href="javascript:;" class="dropdown-toggle" style="font-size: 1.5rem;">
                        <span class="micon bi bi-gear-fill"></span><span class="mtext">My Account</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('technician/settings/my_account') }}"
                                class="@if (Request::segment(3) == 'my_account') active @endif" style="font-size: 1.5rem;">My Account</a>
                        </li>
                        <li>
                            <a href="{{ url('technician/settings/change_password') }}"
                                class="@if (Request::segment(3) == 'change_password') active @endif" style="font-size: 1.5rem;">Change Password</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('logout') }}" class="dropdown-toggle no-arrow" style="font-size: 1.5rem;">
                        <span class="micon fa fa-sign-out"></span><span class="mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif
