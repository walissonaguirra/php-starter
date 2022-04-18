<div class="navbar navbar-expand navbar-light bg-light border-bottom">
    <div class="container-xxl">
        <a class="navbar-brand" href="<?=$this->route("panel.index")?>" title="Voltar">
            <?=CONF_SITE_NAME?>
        </a>
        <ul class="navbar-nav ms-auto gap-3">
            <li class="nav-item"><a class="nav-link <?=(1 == $nav ? "text-primary" : null)?>" href="<?=$this->route("panel.index")?>"><i class="bi bi-grid-fill"></i> Painel</a></li>
            <li class="nav-item"><a class="nav-link <?=(2 == $nav ? "text-primary" : null)?>" href="<?=$this->route("client.index")?>"><i class="bi bi-person-square"></i> Clientes</a></li>
            <li class="nav-item"><a class="nav-link <?=(3 == $nav ? "text-primary" : null)?>" href="<?=$this->route("user.index")?>"><i class="bi bi-people"></i> Usuários</a></li>
            <div class="vr align-self-center" style="height: 22px;"></div>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                    <?= htmlspecialchars($currentUser->name); ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" 
                    data-bs-toggle="modal" 
                    data-bs-target="#user-modal" 
                    data-url="<?=$this->route("user.modal", ["id" => $currentUser->id])?>"><i class="bi bi-person-badge"></i> Perfio</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?=$this->route("auth.logout")?>"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
