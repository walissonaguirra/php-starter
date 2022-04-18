<form action="<?=$action?>" method="post" autocomplete="off">
    <div class="ajax-response"></div>
    <input type="hidden" name="_method" value="<?=$method?>">
    <div class="form-floating">
        <input class="form-control" id="name" type="text" name="name" value="<?=$user->name ?? null?>" required placeholder="Nome completo"/>
        <label for="name">Nome completo</label>
    </div>

    <div class="form-floating mt-3">
        <input class="form-control" id="email" type="email" name="email" value="<?=$user->email ?? null?>" required placeholder="Email"/>
        <label for="email">Email</label>
    </div>

    <p class="text-secondary mt-4 fw-bold">Cria senha</p>
    <div class="form-floating mt-3">
        <input class="form-control" id="passwd" type="password" name="passwd" placeholder="Senha" <?= $user ?? false ? "" : "required"?>/>
        <label for="passwd">Senha</label>
    </div>

    <div class="form-floating mt-3">
        <input class="form-control" id="passwd_re" type="password" name="passwd_re" placeholder="Comfirma senha" <?= $user ?? false ? "" : "required"?>/>
        <label for="passwd_re">Comfirma senha</label>
    </div>

    <div class="d-flex gap-2 justify-content-end mt-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar</button>
    </div>
</form>
