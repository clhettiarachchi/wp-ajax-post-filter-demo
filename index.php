<?php 
    get_header();
?>

<?php global $wp_query; ?>

<main data-max="<?php echo $wp_query->max_num_pages; ?>">
    <?php
        //$args = array();
        $the_query = new WP_Query( array(
            'post_type' => 'post',
            'tag' => isset($_Request['term']) ? isset($_Request['term']) : ''
        ) ); ?>
    <?php if ( $the_query->have_posts() ) : ?>

    <h2>Posts</h2>

    <div class="posts-output">
        <ul>
            <?php   while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            
            <li>
                <?php the_title(); ?>
            </li>

            <?php endwhile; ?>
        </ul>
    </div>

    <button class="load-more">Load More</button>

    <?php endif; ?>

    <?php 
        $tags = get_tags(); 
    ?>
    <ul>
        <?php foreach ( $tags as $tag ) : ?>
            <li class="tag" data-term="<?php echo $tag->slug ?>"><?php echo $tag->name ?></li>
        <?php endforeach; ?>
    </ul>
</main>

<?php 
    get_footer();
?>