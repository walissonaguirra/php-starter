<?php

$this->layout("admin::index");
?>

<div class="container-xxl">
    <div class="row">
        <div class="col-6 bg-dark vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1 class="display-4 text-light"><?=CONF_SITE_NAME?></h1>
            <h4 class="h4 text-light mt-3"><?=CONF_SITE_TITLE?></h4>
        </div>
        <div class="col-6 vh-100 d-flex flex-column">
            <div class="align-items-center d-flex" style="min-height: calc(100vh - 54px);">
                <div class="flex-grow-1">
                    <?=$this->section("content")?>
                </div>
            </div>
            <?=$this->insert("admin::partials/footer", ["wrap" => false])?>
        </div>
    </div>
</div>
