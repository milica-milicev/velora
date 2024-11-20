<div class="blog">
    <div class="container">
        <div class="blog__wrap">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Trenutna stranica

            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 3, // Prikazujemo 4 posta na svim stranicama
                'paged'          => $paged // Postavljamo trenutnu stranicu
            );

            $all_posts = new WP_Query($args);

            if ($all_posts->have_posts()) :
                while ($all_posts->have_posts()) : $all_posts->the_post(); ?>
                    <div class="post-item blog__item">
                        <a class="post-item__img" href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url('blog-item'); ?>" alt="<?php the_title(); ?>">
                        </a>
                        <h4 class="post-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="post-item__excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                <?php
                endwhile;

                // Uslov za prikazivanje paginacije
                if ($all_posts->found_posts > 3) : ?>
                    <div class="blog__nav">
                        <?php
                        // Paginacija
                        echo paginate_links(array(
                            'total'    => $all_posts->max_num_pages,
                            'prev_text' => 'Prethodno',
                            'next_text' => 'Sledeće'
                        ));
                        ?>
                    </div>
                <?php
                endif;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>