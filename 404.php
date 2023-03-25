<?php
$args = [
   'header_text' => 'Lost in space !!!!',
];
get_header( null, $args );
?>
<section class="wrapper">
    <section class="content not_found">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="page_404">
                        <h1>404</h1>
                        <p>Sorry, The page you're looking for is not found</p>
                        <a href="<?php echo get_home_url( ) ?>" class="btn btn-default btn-lg back_home">
                            <i class="fa fa-arrow-circle-o-left"></i>
                            Home
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    
    <section class="promo_box">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="promo_content">
                        <h3>This Wordpress theme is developed by Janak Patel.</h3>
                        <p>It is meant to serve learning purpose only, hence there is no chance you get this theme <br>Though you get it, and by any chance you are recruiter kindly refer below <span style="font-size: 26px">resume</span> </p>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="pb_action">
                        <a class="btn btn-lg btn-default" href="<?php echo wp_get_attachment_url( 195 ) ?>">
                            <i class="fa  fa-file-text"></i>
                            Download Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>
<?php
    get_footer();
?>
