<?php
/**
 * Main Template file.
 * 
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

 get_header( );
?>  
<section class="wrapper">
    <section class="content blog">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div id ="append_here" class="blog_large">
                    <?php
                        $instance = THE_ONE\Inc\Classes\Infinite_Scroll::get_instance();
                        $instance->give_feeds();
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
                                    if ( 1 === substr_count( $link, '<span',0, 5 ) ) {
                                        $class = ' class="active"';
                                    }
                                    printf( '<li%1$s>%2$s</li>', $class, $link );
                                }
                            }
                        ?>

                        </ul>
                    </div>
                </div>
                <?php
                get_sidebar();
                ?>
            </div>
        </div>
    </section>
</section>

<?php
    get_footer( );
?>