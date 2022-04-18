<?php

$this->layout("email::index", ["title" => $subject]); ?>

<h2>Perdeu sua senha <?= $name; ?>?</h2>
<p>Você está recebendo este e-mail pois foi solicitado a recuperação da sua senha na plataforma Coopgal.</p>
<p><a title='Recuperar Senha' href='<?= $link; ?>'>CLIQUE AQUI PARA CRIAR UMA NOVA SENHA</a></p>
<p><b>IMPORTANTE:</b> Se não foi você que solicitou ignore o e-mail. Seus dados permanecem seguros.</p>