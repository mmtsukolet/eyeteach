<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.2
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'                  - Fixed Header

// Sidebar options
1. '.sidebar-fixed'                 - Fixed Sidebar
2. '.sidebar-hidden'                - Hidden Sidebar
3. '.sidebar-off-canvas'        - Off Canvas Sidebar
4. '.sidebar-compact'               - Compact Sidebar Navigation (Only icons)

// Aside options
1. '.aside-menu-fixed'          - Fixed Aside Menu
2. '.aside-menu-hidden'         - Hidden Aside Menu
3. '.aside-menu-off-canvas' - Off Canvas Aside Menu

// Footer options
1. 'footer-fixed'                       - Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

    <header class="app-header navbar">
        @include('includes.header')
    </header>

    <div class="app-body">

        <div class="sidebar">
            @include('includes.sidebar')
        </div>

        <!-- Main content -->
        <main class="main">

            @include('widgets.breadcrumbs')

            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.conainer-fluid -->
        </main>

    </div>

    {{--    @include('includes.footer') --}}

    <!-- GenesisUI main scripts -->
    <script src="{{ url('js/all.js') }}"></script>
    <script type="text/javascript">
        
        function deleteHandler(id, classController) {
        
            if (classController == "categories")
                classController = "category";

            swal({
                 title: "Are you sure?",
                 text: "You will not be able to recover this item!",
                 type: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#DD6B55",
                 confirmButtonText: "Yes, delete it!",
                 closeOnConfirm: false
            },
            function(){
                var url = '<?= url(); ?>/api/' + classController + '/{id}/delete'.replace('{id}', id);

                $.ajax({
                    url: url,
                    method: "post",
                    success: function (res) {
                        var obj = $.parseJSON(res);
                        swal("Deleted!", "Item has been deleted.", "success");
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    }
                })

            });
        }

    </script>
    
    @yield('categories_js')

</body>
</html>