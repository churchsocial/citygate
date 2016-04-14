<?php get_header() ?>

    <div class="wysiwyg">
        <h1>Search results for "<?=$_GET['s']?>":</h1>
        <?php if (have_posts()): ?>
            <ul>
                <?php while (have_posts()) : the_post() ?>
                    <li>
                        <a href="<?php the_permalink() ?>">
                            <?php the_title() ?>
                        </a>
                    </li>
                <?php endwhile ?>
            </ul>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif ?>
    </div>

<?php get_footer() ?>