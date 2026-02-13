<!DOCTYPE html>
<html lang="en">
<head>
    @yield("head")
    <style>
        /* 1. Force sidebar visibility */
        .main-sidebar { transform: translate(0, 0) !important; }
        .sidebar-menu li { white-space: normal !important; }

        /* 2. FIX: Stop the flickering/fast closing */
        /* This forces the menu to STAY visible as long as 'menu-open' is there */
        .treeview.menu-open > .treeview-menu { 
            display: block !important; 
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* 3. Make child links easier to click */
        .treeview-menu > li > a {
            padding: 12px 15px 12px 25px !important;
            display: block !important;
        }
    </style>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">

    {{-- Header Logic --}}
    @if(Auth::guard('web')->check())
        @include("backend.layouts.header") 
    @elseif(Auth::guard('admin')->check())
        @include("backend.layouts.adminHeader") 
    @elseif(Auth::guard('manager')->check())
        @include("backend.layouts.managerHeader")    
    @elseif(Auth::guard('employee')->check())
        @include("backend.layouts.employeeHeader")    
    @endif

    {{-- Sidebar Logic --}}
    @if(Auth::guard('web')->check())
        @include("backend.layouts.leftbar") 
    @elseif(Auth::guard('admin')->check())
        @include("backend.layouts.adminLeftbar") 
    @elseif(Auth::guard('manager')->check())
        @include("backend.layouts.managerLeftbar")    
    @elseif(Auth::guard('employee')->check())
        @include("backend.layouts.employeeLeftbar")    
    @endif
  
    @yield("content")
    
    @include("backend.layouts.footer")

    <aside class="control-sidebar control-sidebar-dark"> 
        <div class="tab-content"> 
            <div class="tab-pane" id="control-sidebar-home-tab"></div>
        </div>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>

{{-- Scripts --}}
<script src="{{ asset('dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('dist/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/bizadmin.js') }}"></script>

{{-- FINAL STABLE SIDEBAR SCRIPT --}}
<script>
$(document).ready(function () {
    // Select the toggle link
    $('.treeview > a').off('click').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation(); // Stop click from "bubbling" up and closing the menu

        var $li = $(this).parent();
        var $menu = $li.find('.treeview-menu');

        if ($li.hasClass('menu-open')) {
            // Close the menu
            $menu.stop(true, true).slideUp(300, function() {
                $li.removeClass('menu-open');
            });
        } else {
            // Close other open menus first to prevent clutter
            $('.treeview.menu-open').not($li).find('.treeview-menu').stop(true, true).slideUp(300);
            $('.treeview.menu-open').not($li).removeClass('menu-open');
            
            // Open this menu
            $li.addClass('menu-open');
            $menu.stop(true, true).slideDown(300);
        }
    });

    // Prevent the sub-menu from closing itself when you click inside it
    $('.treeview-menu').on('click', function(e) {
        e.stopPropagation();
    });
});
</script>

@yield("scripts")
</body>
</html>