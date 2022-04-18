<?php

$this->layout("admin::index"); ?>

<?= $this->insert("admin::partials/header", ["nav" => $nav ?? null]); ?>

<div style="min-height: calc(100vh - 111px);">
    <?= $this->section("content"); ?>
</div>

<?php
$this->insert("admin::user/inc/modal", [
    "id" => "user-modal"
]);
?>

<?php $this->push("scripts"); ?>
<script src="<?=url("js/user.js")?>"></script>
<?php $this->end(); ?>

<?= $this->insert("admin::partials/footer"); ?>

