<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=$head ?? null?>

    <link rel="stylesheet" href="<?=url("css/bootstrap.min.css");?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <?= $this->section("styles"); ?>
  </head>
  <body style="background-color: #f5f5f5;">
    
    <?= $this->section("content"); ?>

    <script src="<?=url("lib/bootstrap.min.js")?>"></script>
    <script src="<?=url("js/form.js")?>"></script>
    <?= $this->section("scripts"); ?>
  </body>
</html>
