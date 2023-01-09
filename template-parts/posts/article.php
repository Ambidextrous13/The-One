<?php 
    $single_post_link = get_permalink( ); 

    $src = '__NEEDS_TO_FILL__'; 
    if( has_post_thumbnail( ) ) {
        $src = get_the_post_thumbnail_url( '', 'indexing-size' );
    }
?>
<article class="post">
    <figure class="post_img">
        <a href="<?php echo esc_url( $single_post_link ); ?>">
            <img src="<?php esc_html_e( $src ); ?>" alt="blog post">
        </a>
    </figure>
    <div class="post_date">
        <span class="day"><?php the_time( 'd' ); ?></span>
        <span class="month"><?php the_time( 'M' ); ?></span>
    </div>
    <div class="post_content">
        <div class="post_meta">
            <h2>
                <a href="<?php echo esc_url( $single_post_link ); ?>"><?php the_title( ); ?></a>
            </h2>
            <div class="metaInfo">
                <span><i class="fa fa-calendar"></i> <a href="#"><?php the_time( 'M d, Y' ); ?></a> </span>
                <span><i class="fa fa-user"></i> <?php _e( 'By', 'the-one' ); ?> <a href="#"><?php the_author( ); ?></a> </span>
                
                <span><i class="fa fa-tag"></i> <?php the_tags( '', ', ' ); ?> </span>
                <span><i class="fa fa-comments"></i> <a href="<?php echo esc_url( $single_post_link ); ?>"><?php echo get_comments_number( ). ' ' . __( 'Comments','the-one' ); ?></a></span>
            </div>
        </div>
        <?php the_excerpt( ); ?>
        <a class="btn btn-small btn-default" href="<?php echo esc_url( $single_post_link ); ?>"><?php _e( 'Read More', 'the-one' ); ?></a>
    </div>
</article>