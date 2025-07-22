<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>@yield('title', 'Carnet de Contacts')</title>
</head>
<body>
    <nav class="sticky-top navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="fas fa-address-book"></i> Carnet de Contacts
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacts.index') ? 'active' : '' }}" href="{{ route('contacts.index') }}">
                            <i class="fas fa-users"></i> Mes Contacts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacts.create') ? 'active' : '' }}" href="{{ route('contacts.create') }}">
                            <i class="fas fa-user-plus"></i> Nouveau Contact
                        </a>
                    </li>
                @endauth
            </ul>

            @auth
                <form class="form-inline mr-3" method="GET" action="{{ route('contacts.index') }}">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher un contact..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            @endauth

            <ul class="navbar-nav">

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-edit"></i> Mon Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
            
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container mt-4">
        @yield('content')
    
    </main>

    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>