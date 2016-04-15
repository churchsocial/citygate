        </div>
        <div class="copyright first">
            <p class="church">&copy; Copyright <?=date('Y')?> <?php bloginfo('blogname')?></p>
            <p class="software">Powered by <a href="http://churchsocialapp.com" title="Church Management Software">Church Social</a>.</p>
        </div>
    </div>

    <ul class="sidebar">

        <?php if (get_theme_mod('church_address') or get_theme_mod('service_times')): ?>
            <li class="join_us_widget">
                <h2>Join us this Sunday</h2>
                <ul>
                    <?php if (get_theme_mod('church_address')): ?>
                        <li>
                            <h3>Our Location:</h3>
                            <p><?=get_theme_mod('church_address')?></p>
                        </li>
                    <?php endif ?>
                    <?php if (get_theme_mod('service_times')): ?>
                        <li>
                            <h3>Service Times:</h3>
                            <p><?=get_theme_mod('service_times')?></p>
                        </li>
                    <?php endif ?>
                </ul>
            </li>
        <?php endif ?>

        <?php dynamic_sidebar('Page') ?>
    </ul>

    <div class="copyright second">
        <p class="church">&copy; Copyright <?=date('Y')?> <?php bloginfo('blogname')?></p>
        <p class="software">Powered by <a href="http://churchsocialapp.com" title="Church Management Software">Church Social</a>.</p>
    </div>

</div>

<script src="<?php bloginfo('template_url') ?>/js/all.js?v=<?=wp_get_theme()->get('Version')?>"></script>

<?php wp_footer() ?>

</body>
</html>