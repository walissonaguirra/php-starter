<?php

$this->layout("admin::index");
?>

<div class="col-4 mx-auto mt-5 text-center">
    <h1 class="display-1 text-secondary">•<?=$errcode?>•</h1>
    <h2 class="h3 mt-4">Conteúdo indisponível</h2>
    <a class="btn btn-primary mt-4" href="<?=$this->route("auth.login")?>">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>
