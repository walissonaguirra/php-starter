<footer class="border-top bg-light mt-auto">
    <div class="<?=$wrap ?? true ? "container-xxl" : null?> d-flex justify-content-between py-3 text-muted small">
        <span>
            © 2022 - <?=date("Y")?>, <?= CONF_SITE_NAME ?> — Todo os direitos reservados
        </span>
        <span>
            Desenvolvido por <a class="link-secondary text-decoration-none" href="<?=CONF_DEV_WEBSITE?>" target="_blank"><?=CONF_DEV_AUTHOR?></a>
        </span>
    </div>
</footer>
