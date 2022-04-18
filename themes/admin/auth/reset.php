<?php

$this->layout("admin::auth/layout");?>

<div class="mx-auto" style="max-width: 380px;">
    <form action="<?=$this->route("auth.reset", ["code" => $forgetCode])?>" method="POST" autocomplete="off">
        <input type="hidden" name="_method" value="POST">
        <?=csrf_input();?>
        <div class="text-center">
            <span class="h4">Criar uma nova senha</span>
        </div>

        <div class="form-floating mt-4">
            <input id="passwd" class="form-control" type="password" name="passwd" autofocus placeholder="Senha" required>
            <label for="passwd">Nova senha</label>
        </div>

        <div class="form-floating mt-4">
            <input id="passwd_re" class="form-control" type="password" name="passwd_re" placeholder="Senha" required>
            <label for="passwd_re">Confirma senha</label>
        </div>

        <div class="d-grid mt-4">
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </form>
</div>
