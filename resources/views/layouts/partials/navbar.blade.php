<nav class="navbar navbar-expand-lg">
    <div class="container-fluid justify-content-center">
        <a class="navbar-brand" href="/home">Ugel Sullana</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Elementos de navegación -->
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/seguimiento">Seguimiento</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin-view">Admin</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png"
                                    alt="User" class="user-image"> <!-- Añade esta línea -->
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </form>
        </div>
    </div>
</nav>
