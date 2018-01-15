<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index.simple') }}">TZ for ABZ</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">

                <li><a href="{{ route('index.simple') }}">
                        <i class="fa fa-comment" aria-hidden="true"></i> LaravelTable </a></li>
                <li><a href="{{ route('index.datatable') }}">
                        <i class="fa fa-bell" aria-hidden="true"></i> DataTable </a></li>
                <li><a href="{{ route('index.ajax') }}">
                        <i class="fa fa-question-circle" aria-hidden="true"></i> AjaxTable </a></li>

                {{--<li><a href="{{ route('index.tree') }}">
                    <i class="fa fa-comment" aria-hidden="true"></i> Tree--}}
                {{-- === <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span> === --}}
                {{--</a>
            </li>--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User options <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if(Auth::check())
                            <li><a href="#">
                                    <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                                    Users
                                </a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">
                                    <i class="fa fa-home" aria-hidden="true"></i>&nbsp;
                                    Home
                                </a></li>
                            <li role="separator" class="divider"></li>
                            {{--<li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>--}}

                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out"></i>&nbsp;
                                    Logout
                                </a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                            {{--<li><a href="{{route('tree.child.parent', ['id'=>1])}}"> <i class="fa fa-sitemap" aria-hidden="true"></i> Tree </a></li>--}}
                            {{--<li><a href="{{route('index.tree', ['id'=>1])}}"> <i class="fa fa-sitemap" aria-hidden="true"></i> Tree Simple</a></li>--}}
                            <li><a href="{{route('tree.full', ['id'=>1, 'pid'=>0])}}"> <i class="fa fa-sitemap" aria-hidden="true"></i> Tree Session </a></li>
                            <li><a href="{{route('tree.class', ['id'=>1])}}"> <i class="fa fa-cubes" aria-hidden="true"></i> Tree Class</a></li>
                            {{--<li><a href="{{route('class.table', ['id'=>27])}}"> <i class="fa fa-bell" aria-hidden="true"></i> Tree ajax</a></li> нада для отладки аякса--}}

                            <li role="separator" class="divider"></li>

                            <li><a href="{{route('index.table', ['id'=>1])}}"> <i class="fa fa-th-list" aria-hidden="true"></i> Table </a></li>
                            <li><a href="{{route('login')}}"> <i class="fa fa-sign-in"></i> Login </a></li>
                        @endif

                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>