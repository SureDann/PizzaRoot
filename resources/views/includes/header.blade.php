<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">PizzaRoot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('logout')}}">@lang('welcome.logout')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('cart_view')}}">@lang('welcome.cart')</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @lang('welcome.language')
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/locale/ru">@lang('welcome.russian')</a></li>
                            <li><a class="dropdown-item" href="/locale/en">@lang('welcome.english')</a></li>

                        </ul>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login_view')}}">@lang("welcome.Login")</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('registration_view')}}">@lang("welcome.Registration")</a>
                </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @lang("welcome.language")
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/locale/ru">Russian</a></li>
                            <li><a class="dropdown-item" href="/locale/en">English</a></li>

                        </ul>
                    </li>
            </ul>
                @endauth
        </div>
    </div>
</nav>
<style>
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    .navbar.navbar-scrolled {
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        transition: background-color 0.3s ease;
    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <!-- ваше содержимое навигационного меню -->
</nav>

<script>
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar');
        if (window.scrollY > 0) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
</script>
