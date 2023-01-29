<?php
    $tab_1 = 'Pinned Notices';
    $tab_2 = 'Recent';
    if ( isset( $args[ 'tab-1' ] ) ) {
        $tab_1 = $args[ 'tab-1' ];
    }

    if ( isset( $args[ 'tab-2' ] ) ) {
        $tab_2 = $args[ 'tab-2' ];
    }

    $tabs = [
        'pinned_notices' => [
            'name' => $tab_1,
            'query_params' => [
                'showposts' => 3,
                'meta_query' => [
                    [
                        'key' => 't-o-pinned',
                        'value' => 'on',
                        'compare' => '=',
                    ],
                ]
            ] 
        ],
        'recent' => [
            'name' => $tab_2,
            'query_params' => [
                'showposts' => 3,
            ] 
        ],
    ];
?>

<div class="ProBusiness-tab sidebar-tab">
    <ul class="nav nav-tabs">
        <?php
            $is_first_iteration = true;
            foreach ($tabs as $tab => $params) {
                $class = '';
                if ( $is_first_iteration ) {
                    $class = ' class="active"';
                    $is_first_iteration = false;
                }
                _e( sprintf( '<li%1$s><a href="#%2$s" data-toggle="tab">%3$s</a></li>', $class , $tab, $params[ 'name' ] ), 'the-one' );     
            }
        ?>
        <!-- <li class="last-tab"><a href="#Comment" data-toggle="tab"><i class="fa fa-comments-o"></i></a></li> -->
    </ul>
    <div class="tab-content clearfix">

<?php
    $is_first_iteration = true;
    foreach ( $tabs as $tab => $params ) {
        $pinned_posts = new WP_Query( $params[ 'query_params' ] );
        $class = ' ';
        if ( $is_first_iteration ) {
            $class = ' active in';
            $is_first_iteration = false;
        }
?>
        <div class="tab-pane fade<?php esc_attr_e( $class, 'the-one' ); ?>" id="<?php esc_attr_e( $tab, 'the-one' ); ?>">
            <ul class="recent_tab_list">
    
    <?php
        if( $pinned_posts -> have_posts() ) :
            while( $pinned_posts -> have_posts() ) :
                $pinned_posts -> the_post();
   
    ?>

                <li>
                    <span><a href="<?php echo esc_url( get_the_permalink( ) ); ?>"><img src="<?php the_post_thumbnail_url()?>" alt="" height="50" width="50"></a></span>
                    <a href="<?php echo esc_url( get_the_permalink( ) ); ?>"><?php esc_html_e( the_title(), 'the-one' ); ?></a>
                    <i><?php the_time( 'M d, Y' ) ?></i>
                </li>

    <?php 
            endwhile;
        else:
            echo "<p>No posts found.</p>";
        endif;
        wp_reset_postdata();
    ?>
    
            </ul>
        </div>

<?php
    };
?>	
        <!-- <div class="tab-pane fade" id="Recent">
            <ul class="recent_tab_list">
                <li>
                    <span><a href="#"><img src="images/content/recent_4.png" alt=""></a></span>
                    <a href="#">Various versions has evolved over the years</a>
                    <i>October 18, 2015</i>
                </li>
                <li>
                    <span><a href="#"><img src="images/content/recent_5.png" alt=""></a></span>
                    <a href="#">Rarious versions has evolve over the years</a>
                    <i>October 17, 2015</i>
                </li>
                <li class="last-tab">
                    <span><a href="#"><img src="images/content/recent_6.png" alt=""></a></span>
                    <a href="#">Marious versions has evolven over the years</a>
                    <i>October 16, 2015</i>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="Comment">
            <ul class="comments">
                <li class="comments_list clearfix">
                    <a class="post-thumbnail" href="#"><img width="60" height="60" src="images/content/recent_3.png" alt="#"></a>
                    <p><strong><a href="#">Prambose</a> <i>says: </i> </strong> Morbi augue velit, tempus mattis dignissim nec, porta sed risus. Donec eget magna eu lorem tristique pellentesque eget eu dui. Fusce lacinia tempor malesuada.</p>
                </li>
                <li class="comments_list clearfix">
                    <a class="post-thumbnail" href="#"><img width="60" height="60" src="images/content/recent_1.png" alt="#"></a>
                    <p><strong><a href="#">Makaroni</a> <i>says: </i> </strong> Tempus mattis dignissim nec, porta sed risus. Donec eget magna eu lorem tristique pellentesque eget eu dui. Fusce lacinia tempor malesuada.</p>
                </li>
                <li class="comments_list clearfix">
                    <a class="post-thumbnail" href="#"><img width="60" height="60" src="images/content/recent_2.png" alt="#"></a>
                    <p><strong><a href="#">Prambanan</a> <i>says: </i> </strong> Donec convallis, metus nec tempus aliquet, nunc metus adipiscing leo, a lobortis nisi dui ut odio. Nullam ultrices, eros accumsan vulputate faucibus, turpis tortor.</p>
                </li>
            </ul>
        </div> -->
    </div>
</div>