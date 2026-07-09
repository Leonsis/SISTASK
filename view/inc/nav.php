<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <h2>SISTASKS</h2>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <ul class="nav-menu">
                <li class="nav-item">
                    <button id="logoutAction" class="btn btn-sm btn-primary">Sair</button>
                </li>                    
            </ul>
        <?php endif; ?>
    </div>
</nav>