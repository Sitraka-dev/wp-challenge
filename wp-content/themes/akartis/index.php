<?php 
    get_header();

        if (have_posts()) : ?>
            <div class="row">
                <?php while (have_posts()) : the_post(); ?>

                    <div class="card" style="width: 18rem;">
                        <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'style' => 'height: auto']); ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"> <?php the_excerpt(); ?> </p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?= __('Voir plus', 'akartis') ?></a>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p><?= __('Pas d\'article', 'akartis') ?></p>
        <?php endif;

    get_footer(); 
?>