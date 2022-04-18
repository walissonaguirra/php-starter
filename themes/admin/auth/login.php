<?php

$this->layout("admin::auth/layout");?>

<div class="mx-auto" style="max-width: 380px;">
    <form action="<?=$this->route("auth.login")?>" method="POST" autocomplete="off">
        <input type="hidden" name="_method" value="POST">
        <?=csrf_input();?>
        <div class="text-center">
            <span class="h4">Acessar a plataforma</span>
        </div>

        <div class="ajax-response"></div>
        <div class="form-floating mt-4">
            <input id="email" class="form-control" type="email" name="email" value="<?=($cookieEmail ?? null)?>" <?=($cookieEmail ?? null ? null : "autofocus")?> placeholder="Email" required>
            <label for="email">Email</label>
        </div>

        <div class="form-floating mt-4">
            <input id="passwd" class="form-control" type="password" name="passwd" <?=($cookieEmail ?? null ? "autofocus" : null)?> placeholder="Senha" required>
            <label for="passwd">Senha</label>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <div class="form-check">
                <input id="remenber_me" class="form-check-input" type="checkbox" name="remenber_me" <?=($cookieEmail ?? null ? "checked" : null)?>>
                <label for="remenber_me">Lembra de mim</label>
            </div>
            <a class="text-decoration-none" href="<?=$this->route("auth.forget")?>">Esqueceu a senha?</a>
        </div>

        <div class="d-grid mt-4">
            <button class="btn btn-primary" type="submit">Entrar</button>
        </div>
    </form>
</div>
