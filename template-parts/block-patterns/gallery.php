<div class="col-sm-6 col-md-3 col-lg-3">
<div class="widget_title">
    <h4><span>Flickr Gallery</span></h4>
</div>
<div class="widget_content">
    <div class="flickr">
        <ul class="flickr-feed">
<?php
    for ( $i = 0; $i < 9; $i++ ) { 
?>
            <li>
                <a class="mfp-gallery" title="<?php echo esc_attr( $i ); ?>" href="">
                    <i class="fa fa-search"></i>
                    <div class="hover"></div>
                </a>
                <img src="" alt="<?php echo esc_attr( $i ); ?>">
            </li>

<?php
    }    
?>
    </div>
</div>
</div>