<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Kibertārps')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- idek why it wont work if i put it in the css file -->
    <style>
        .hiddenSidebar {
            transition: all 0.3s ease;
            min-width: 0px;
            width: 0px;
            border: none;
            overflow: hidden;
        }
        .not-hiddenSidebar {
            transform: translateX(0);
            transition: all 0.3s ease;
            width: 240px;
        }
        .hiddenCategories{
            min-height: 0;
            overflow: hidden;
            height: 0;
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }
        .not-hiddenCategories{
            overflow: visible;
            height: 150px;
            transition: all 0.3s ease;
        }
        .hiddenFilters{
            min-height: 0;
            overflow: hidden;
            height: 0;
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }
        .not-hiddenFilters{
            overflow: visible;
            height: 200px;
            transition: all 0.3s ease;
        }

        @media (max-width: 800px) {
            .hiddenSidebar {
                min-height: 0;
                overflow: hidden;
                height: 0;
                opacity: 0;
                border: none;
                transition: all 0.3s ease-in-out;
            }
            .not-hiddenSidebar {
                overflow: visible;
                height: 800px;
                transition: all 0.3s ease;
            }
            .hiddenCategories{
                min-height: 0;
                overflow: hidden;
                height: 0;
                opacity: 0;
                transition: all 0.3s ease-in-out;
            }
            .not-hiddenCategories{
                overflow: visible;
                height: 150px;
                transition: all 0.3s ease;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">

        <a href="{{ route('posts.index') }}" class="brand">
            <img class="logo" src="{{ asset('images/worm.png') }}">
            Kibertārps
        </a>
        <form action="{{route('posts.index')}}" method="get" class="search-form">
            <input type="text" class="search-bar" name="search" placeholder="Meklējiet publikāciju pēc tā virsraksta">
            <button type="submit" class="search-btn button">🔍</button>
        </form>

        <div class="nav-links">

            @auth
                <a href="{{ route('posts.create') }}" class="nav-button">Pievienot ierakstu</a>

                @can('view-admin-dashboard')
                    <a href="{{ route('admin.dashboard') }}" class="nav-button">Admin</a>
                @endcan

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-button">Izrakstīties</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-button">Pierakstīties</a>
                <a href="{{ route('register') }}" class="nav-button">Reģistrēties</a>
            @endauth
        </div>
    </nav>
    <button id="sidebarToggle" class="toggleSidebar" onclick="toggleSidebar()">☰</button>
    <main class="page-container">
        <sidebar class="sidebar" id="sidebar">
            @auth
            <span class="side-user">&nbsp;Sveiks, {{ auth()->user()->name }}!</span>
            <a href="{{ route('profile') }}" class="side-button">Jūsu profils</a>
            @else
            <span class="side-user">&nbsp;Sveiks, Viesi!</span>
            @endauth
            <a href="{{ route('profile.index') }}" class="side-button">Visi profili</a>
            <button class="category-dropdown side-button" onclick="toggleCategories()">Kategorijas</button>
            <div class="side-categories" id="side-categories">
            @foreach(["Dārzniecība", "Zveja", "Zinātniski", "RP", "Jebkas"] as $category)
                <form action="{{route('posts.index')}}" method="get" class="category-form">
                    <input type="hidden" name="category" value="{{$category}}">
                    <button type="submit" class="category-dropdown specific-category">
                        {{$category}}
                    </button>
                </form>
            @endforeach
            </div>
            <button class="filter-dropdown side-button" onclick="toggleFilters()">Filtrēt</button>
            <div id="side-filters" class="side-filters">
                <form action="{{route('posts.index')}}" method="get" class="filter-form">
                    <label for="search">Meklēt pēc virsraksta</label>
                    <input type="text" name="search" id="search">
                    <label for="category">Kategorija</label>
                    <select name="category" id="category">
                    <option value="">Visas kategorijas</option>
                    @foreach(["Dārzniecība", "Zveja", "Zinātniski", "RP", "Jebkas"] as $category)
                        <option value={{$category}}>{{$category}}</option>
                    @endforeach
                    </select>
                    <label for="sort">Kārtot pēc</label>
                    <select name="sort" id="sort">
                        <option value="newest">Jaunākie</option>
                        <option value="oldest">Vecākie</option>
                        <option value="most_commented">Visvairāk komentētie</option>
                        <option value="least_commented">Vismazāk komentētie</option>
                        <option value="most_liked">Visvairāk patiktie</option>
                        <option value="least_liked">Vismazāk patiktie</option>
                    </select>
                    <button type="submit" class="filter-btn">Filtrēt</button>
                </form>
            </div>

            <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2fonZn3I-GXPQZXQidIA3dIpP1DuA8GhpJGk6igFyJYMUB526ShtvsdJG&s=10" class="side-button">Placeholder</a>
            <a href="{{ route('worms.index') }}" class="side-button">Tārpi</a>
        </sidebar>
        
        <div class="content">
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <div class="ad-container" id="adContainer">
        <div class="ad-track">
            <div class="ad-group">
                <img src="{{ asset('images/ad.png') }}" alt="Advertisement" class="ad-image">
                <h2 class="ad-text">Jūsu reklāma šeit!</h2>
                <img src="{{ asset('images/ad.png') }}" alt="Advertisement" class="ad-image">
            </div>
        </div>
    </div>
            @yield('content')
        </div>
    </main>
    
    <script>
        const sideBar = document.getElementById("sidebar");
        sideBar.classList.toggle("hiddenSidebar");
        const categoriesDropdown = document.getElementById("side-categories");
        categoriesDropdown.classList.toggle("hiddenCategories");
        const filterDropdown = document.getElementById("side-filters");
        filterDropdown.classList.toggle("hiddenFilters");
        function toggleCategories() {
            if (categoriesDropdown.classList.contains("hiddenCategories")) {
                categoriesDropdown.classList.remove("hiddenCategories");
                categoriesDropdown.classList.add("not-hiddenCategories");
            } else {
                categoriesDropdown.classList.remove("not-hiddenCategories");
                categoriesDropdown.classList.add("hiddenCategories");
            }
        }
        function toggleSidebar() {
            if (sideBar.classList.contains("hiddenSidebar")) {
                sideBar.classList.remove("hiddenSidebar");
                sideBar.classList.add("not-hiddenSidebar");
            } else {
                sideBar.classList.remove("not-hiddenSidebar");
                sideBar.classList.add("hiddenSidebar");
            }
        }
        function toggleFilters() {
            if(filterDropdown.classList.contains("hiddenFilters")) {
                filterDropdown.classList.remove("hiddenFilters");
                filterDropdown.classList.add("not-hiddenFilters");
            } else {
                filterDropdown.classList.remove("not-hiddenFilters");
                filterDropdown.classList.add("hiddenFilters");
            }
        }
        document.getElementById('adContainer').addEventListener('click', function() {
            window.location.href = 'https://www.compostcommunity.com.au/uploads/6/8/7/8/68784659/worm-on-white-background-20_orig.png';
        });
    </script>
</body>
</html>