<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">Ugel Sullana</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <form class="d-flex" role="search">
                <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png"
                                    alt="User" class="user-image"> <!-- Añade esta línea -->
                                {{ auth()->user()->name ?? auth()->user()->username }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </form>
        </div>
    </div>
</nav>
