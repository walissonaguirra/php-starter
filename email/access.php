<?php

$this->layout("email::index", ["title" => $subject]); ?>

<h2>Você fez login na plataforma <?= CONF_SITE_NAME, " ", $name; ?>?</h2>
<p>Foi detectado um novo acesso a sua conta.</p>
<p><b>Data:</b> <?=$date?></p>
<p><b>Não foi você?</b> É importante atualizar sua conta o quanto antes. Para isso <a href="<?=$link?>">ACESSE SUA CONTA</a> e altere sua senha.</p>
<p><b>Foi você?</b> Então pode ignorar este e-mail. </p>