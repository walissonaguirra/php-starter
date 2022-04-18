<?php

$this->layout("admin::auth/layout");?>

<div class="mx-auto" style="max-width: 380px;">
    <form action="<?=$this->route("auth.forget")?>" method="POST" autocomplete="off">
        <input type="hidden" name="_method" value="POST">
        <?=csrf_input();?>
        <div class="text-center">
            <span class="h4">Recuperar senha</span>
        </div>

        <p class="text-secondary mt-4">
            Nós enviaremos um link de redefinição
            de senha para seu e-mail
        </p>

        <div class="form-floating mt-4">
            <input id="email" class="form-control" type="email" name="email" value="<?=$cookieEmail ?? null?>" autofocus placeholder="Email" required>
            <label for="email">Email</label>
        </div>

        <div class="mt-4">
            <a class="text-decoration-none" href="<?=$this->route("auth.login")?>">Volta para página de login</a>
        </div>

        <div class="d-grid mt-4">
            <button class="btn btn-primary" type="submit">Recuperar</button>
        </div>
    </form>
</div>
