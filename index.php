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
                        }
                    ?>
                    
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <ul class="pagination pull-left mrgt-0">
                            <li><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!--Sidebar Widget-->
                <?php
                get_template_part( 'template-parts/sidebar' )
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