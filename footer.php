        </div>

        <div class="copyright">
            <p class="church">&copy; Copyright <?=date('Y')?> <?php bloginfo('blogname')?></p>
            <p class="software">Powered by <a href="http://churchsocialapp.com" title="Church Management Software">Church Social</a>.</p>
        </div>

    </div>

    <div class="sidebar">

        <div class="info">
            <h2>Join us this Sunday</h2>
            <ul>
                <?php if (get_theme_mod('church_address')){ ?>
                    <li class="church_address">
                        <h3>Worship with us:</h3>
                        <p><?=get_theme_mod('church_address')?></p>
                    </li>
                <?php } ?>
                <?php if (get_theme_mod('service_times')){ ?>
                    <li class="service_times">
                        <h3>Service times:</h3>
                        <p><?=get_theme_mod('service_times')?></p>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <ul class="dynamic">
            <?php dynamic_sidebar('Page') ?>
        </ul>

    </div>

</div>

<script src="<?php bloginfo('template_url') ?>/js/all.min.js"></script>

<?php wp_footer() ?>

</body>
</html>