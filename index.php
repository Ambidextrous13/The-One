<?php
/**
 * Main Template file.
 * 
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

 get_header( );
?>  
<!--start wrapper-->
<section class="wrapper">
    <section class="content blog">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div class="blog_large">

                    <?php
                        if( is_home(  ) ){
                            if( have_posts(  ) ) : while( have_posts(  ) ) : the_post(  );
                               get_template_part( '/template-parts/posts/article' );
                            
                        endwhile;
                    endif;
                    wp_reset_postdata();
                        }
                    ?>
                    
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <ul class="pagination pull-left mrgt-0">

                        <?php
                        $arg = [
                            'type'  => 'array',
                        ];  
                            $posts_pagination = paginate_links( $arg );
                            if ( ! empty( $posts_pagination ) ){
                                foreach ($posts_pagination as $index => $link) {
                                    $class = '';
                                    if ( substr_count( $link, '<span',0, 5 ) === 1 ) {
                                        $class = ' class="active"';
                                    }
                                    printf( '<li%1$s>%2$s</li>', $class, $link );
                                }
                            }
                        ?>

                        </ul>
                    </div>
                </div>
                <!--Sidebar Widget-->
                <?php
                get_sidebar();
                ?>
            </div><!--/.row-->
        </div> <!--/.container-->
    </section>
</section>
<!--end wrapper-->
<!--start footer-->
<?php
    get_footer( );
?>