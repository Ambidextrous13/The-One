<?php 
    global $post;

    if( have_posts(  ) ):
        while ( have_posts() ) : the_post();

        $src = '__NEEDS_TO_FILL__'; 
        if( has_post_thumbnail( ) ) {
            $src = get_the_post_thumbnail_url( '', 'indexing-size' );
        }

        $author_ID = $post->post_author
?>

<!--start wrapper-->
<section class="wrapper">
    <section class="content blog">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="blog_single">
                        <article class="post">
                            <div class="post_date">
                                <span class="day"><?php the_time( 'd' ); ?></span>
                                <span class="month"><?php the_time( 'M' ); ?></span>
                            </div>
                            <div class="post_content">
                                <div class="post_meta">
                                    <h2>
                                        <a><?php the_title( ); ?></a>
                                    </h2>
                                    <div class="metaInfo">
                                        <span><i class="fa fa-calendar"></i> <a><?php the_time( 'M d, Y' ); ?></a> </span>
                                        <span><i class="fa fa-user"></i> <?php _e( 'By', 'the-one' ); ?> <a href="<?php echo esc_url(get_author_posts_url( $author_ID ) ); ?>"><?php the_author( ); ?></a> </span>
                                        <span><i class="fa fa-tag"></i> <?php the_tags( '', ', ' ); ?> </span>
                                        <span><i class="fa fa-comments"></i> <a><?php echo get_comments_number( ). ' ' . __( 'Comments','the-one' ); ?></a></span>
                                    </div>
                                </div>
                                <?php 
                                    the_content( );
                                    the_one_post_paginator();
                                ?>
                            </div>
                            <ul class="shares">
                                <li class="shareslabel"><h3><?php _e( 'Share This Story', 'the-one' ); ?></h3></li>
                                <li><a class="twitter" href="#" data-placement="bottom" data-toggle="tooltip" title="Twitter"></a></li>
                                <li><a class="facebook" href="#" data-placement="bottom" data-toggle="tooltip" title="Facebook"></a></li>
                                <li><a class="gplus" href="#" data-placement="bottom" data-toggle="tooltip" title="Google Plus"></a></li>
                                <li><a class="pinterest" href="#" data-placement="bottom" data-toggle="tooltip" title="Pinterest"></a></li>
                                <li><a class="yahoo" href="#" data-placement="bottom" data-toggle="tooltip" title="Yahoo"></a></li>
                                <li><a class="linkedin" href="#" data-placement="bottom" data-toggle="tooltip" title="LinkedIn"></a></li>
                            </ul>
                    
                        </article>
                        <div class="about_author">
                            <div class="author_desc">
                                <img src="images/blog/author.png" alt="about author">
                                <ul class="author_social">
                                    <li><a class="fb" href="#." data-placement="top" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twtr" href="#." data-placement="top" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="skype" href="#." data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
                                </ul>
                            </div>
                            <div class="author_bio">
                                <h3 class="author_name"><a href="<?php echo esc_url(get_author_posts_url( $author_ID ) ); ?>"><?php echo  get_the_author_meta( 'display_name', $author_ID ); ?></a></h3>
                                <h5>CEO at <a href="#">Yahoo Baba</a></h5>
                                <p class="author_det">
                                    Lorem ipsum dolor sit amet, consectetur adip, sed do eiusmod tempor incididunt  ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus omnis saperet docendi nec, eos ea alii molestiae aliquand.
                                </p>
                            </div>
                        </div>
                        <div id="anchor-comments"></div>
                    </div>
                    
                    <?php
                        endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                    <!--News Comments-->
                    <div class="news_comments">
                        <div class="dividerHeading">
                            <h4><span>Comments (6)</span></h4>
                        </div>
                        <div id="comment">
                            <ul id="comment-list">
                                <li class="comment">
                                    <div class="avatar"><img alt="" src="images/blog/avatar_1.png" class="avatar"></div>
                                    <div class="comment-container">
                                        <h4 class="comment-author"><a href="#">John Smith</a></span></h4>
                                        <div class="comment-meta"><a href="#" class="comment-date">February 22, 2015</a><a class="comment-reply-link" href="#respond">Reply &raquo;</a></div>
                                        <div class="comment-body">
                                            <p>Ne omnis saperet docendi nec, eos ea alii molestiae aliquand. Latine fuisset mele, mandamus atrioque eu mea, wi forensib argumentum vim an. Te viderer conceptam sed, mea et delenit fabellas probat.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="comment">
                                    <div class="avatar"><img alt="" src="images/blog/avatar_2.png" class="avatar"></div>
                                    <div class="comment-container">
                                        <h4 class="comment-author"><a href="#">Eva Smith</a></span></h4>
                                        <div class="comment-meta"><a href="#" class="comment-date">February 13, 2015</a><a class="comment-reply-link" href="#respond">Reply &raquo;</a></div>
                                        <div class="comment-body">
                                            <p>Vidit nulla errem ea mea. Dolore apeirian insolens mea ut, indoctum consequuntur hasi. No aeque dictas dissenti as tusu, sumo quodsi fuisset mea in. Ea nobis populo interesset cum, ne sit quis elit officiis, min im tempor iracundia sit anet. Facer falli aliquam nec te. In eirmod utamur offendit vis, posidonium instructior sed te.</p>
                                        </div>
                                    </div>
                                    <ul class="children">
                                        <li class="comment">
                                            <div class="avatar"><img alt="" src="images/blog/avatar_3.png" class="avatar"></div>
                                            <div class="comment-container">
                                                <h4 class="comment-author"><a href="#">Thomas Smith</a></span></h4>
                                                <div class="comment-meta"><a href="#" class="comment-date">February 14, 2015</a><a class="comment-reply-link" href="#respond">Reply &raquo;</a></div>
                                                <div class="comment-body">
                                                    <p>Labores pertinax theophrastus vim an. Error ditas in sea, per no omnis iisque nonumes. Est an dicam option, ad quis iriure saperet nec, ignota causae inciderint ex vix. Iisque qualisque imp duo eu, pro reque consequ untur. No vero laudem legere pri, error denique vis ne, duo iusto bonorum.</p>
                                                </div>
                                            </div>
                                            <ul class="children">
                                                <li class="comment">
                                                    <div class="avatar"><img alt="" src="images/blog/avatar_2.png" class="avatar"></div>
                                                    <div class="comment-container">
                                                        <h4 class="comment-author"><a href="#">Eva Smith</a></span></h4>
                                                        <div class="comment-meta"><a href="#" class="comment-date">February 14, 2015</a><a class="comment-reply-link" href="#respond">Reply &raquo;</a></div>
                                                        <div class="comment-body">
                                                            <p>Dico animal vis cu, sed no aliquam appellantur, et exerci eleifend eos. Vixese eros tiloi novum adtam, mazim inimicus maiestatis ad vim. Ex his unum fuisset reformidans, has iriure ornatus atomorum ut, ad tation feugiat impedit per.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="comment">
                                    <div class="avatar"><img alt="" src="images/blog/avatar_1.png" class="avatar"></div>
                                    <div class="comment-container">
                                        <h4 class="comment-author"><a href="#">John Smith</a></span></h4>
                                        <div class="comment-meta"><a href="#" class="comment-date">February 07, 2015</a><a class="comment-reply-link" href="#respond">Reply &raquo;</a></div>
                                        <div class="comment-body">
                                            <p>Eu mea harum soleat albucius. At duo nihil saperet inimicus. Ne quo dicit offendit eloquenam. Ut intellegam inn theophras tus mea. Vide ceteros mediocritatem est in, utamur gubergren contentiones.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="comment">
                                    <div class="avatar"><img alt="" src="images/blog/avatar_3.png" class="avatar"></div>
                                    <div class="comment-container">
                                        <h4 class="comment-author"><a href="#">Thomas Smith</a></span></h4>
                                        <div class="comment-meta"><a href="#" class="comment-date">February 02, 2015</a><a class="comment-reply-link" href="#respond">Reply &raquo;</a></div>
                                        <div class="comment-body">
                                            <p>Quodsi eirmod salutandi usu ei, ei mazim facete mel. Deleniti interesset at sed, sea ei malis expetenda. Ei efficiat integebat mel, vis alii insoles te. Vis ex bonorum contentiones. An cum possit reformidans. Est at eripuit theophrastus. Scripta imper diet ad nec, everti contentiones id eam, an eum causae officiis.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /#comments -->
                        <div class="dividerHeading">
                            <h4><span>Leave a comment</span></h4>
                            </div>

                        <div class="comment_form">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input class="col-lg-4 col-md-4 form-control" name="name" type="text" id="name" size="30"  onfocus="if(this.value == 'Name') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Name'; }" value="Name" placeholder="Name" >
                                </div>
                                <div class="col-sm-4">
                                    <input class="col-lg-4 col-md-4 form-control" name="email" type="text" id="email" size="30" onfocus="if(this.value == 'E-mail') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'E-mail'; }" value="E-mail" placeholder="E-mail">
                                </div>
                                <div class="col-sm-4">
                                    <input class="col-lg-4 col-md-4 form-control" name="url" type="text" id="url" size="30" onfocus="if(this.value == 'Url') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Url'; }" value="Url" placeholder="Url">
                                </div>
                            </div>
                        </div>
                        <div class="comment-box row">
                            <div class="col-sm-12">
                                <p>
                                    <textarea name="comments" class="form-control" rows="6" cols="40" id="comments" onfocus="if(this.value == 'Message') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Message'; }" placeholder="Message">Message</textarea>
                                </p>
                            </div>
                        </div>

                        <a class="btn btn-lg btn-default" href="#">Post Comment</a>
                    </div>
                </div>

                <!--Sidebar Widget-->
                
            </div><!--/.row-->
        </div> <!--/.container-->
    
    </section> 
</section>
	<!--end wrapper-->
	<!--start footer-->
