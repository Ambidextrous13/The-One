<?php
  $arg1 = get_the_value( $args, 'div_1_id', '' );
?>

<section class="wrapper">
    <section class="content blog">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div <?php echo $arg1 ?> class="blog_large">