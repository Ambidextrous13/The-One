<?php
/**
 * Generic Header File
 * 
 * @package The-One 
 * @author Janak Patel <pateljanak830@gmail.com>
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes( ) ?>>
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>ProBusiness Responsive Multipurpose Template</title>
	<meta name="description" content="">
    <?php
        wp_head( );
    ?>
</head>
<body>
<header id="header">
<div id="header-top">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-lg-7 col-sm-5 top-info">
                <span><i class="fa fa-phone"></i>Phone: (123) 456-7890</span>
                <span class="hidden-sm"><i class="fa fa-envelope"></i>Email: mail@example.com</span>
            </div>
            <div class="col-lg-5">
                <ul class="dropdown-items clearfix">
                    <li>
                        <div class="site-language">
                            <div class="dropdown">
                                <a class="language-dropdown" href="#" data-toggle="dropdown">
                                    <img alt="English (US)" src="images/flags/United-States.png">
                                    English (US)
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">
                                            <img alt="English (US)" src="images/flags/United-States.png">
                                            English (US)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img alt="English (UK)" src="images/flags/United-Kingdom.png">
                                            English (UK)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img alt="Spanish" src="images/flags/Spain.png">
                                            Spanish
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="my-account">
                            <div class="dropdown">
                                <a class="account-dropdown" href="#" data-toggle="dropdown">
                                    Hi, User

                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#">My Account</a>
                                            </li>
                                            <li>
                                                <a href="#">Checkout</a>
                                            </li>
                                            <li>
                                                <a href="cart.html">Cart</a>
                                            </li>
                                            <li>
                                                <a href="shop.html">Shop</a>
                                            </li>
                                        </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="shope-cart">
                            <div class="dropdown">
                                <a class="cart-dropdown" href="#" data-toggle="dropdown">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="cart-items">2</span>
                                </a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li class="cart-products">
                                        <ul style="overflow: hidden;" tabindex="5000">
                                            <li>
                                                <div class="cart-product clearfix">
                                                    <div class="left-data">
                                                        <img alt="" src="images/cart-product.png">
                                                    </div>
                                                    <div class="right-data">
                                                        <strong>
                                                            <a href="#">Flying Ninja </a>
                                                        </strong>
                                                        <p>$45.00 x 1</p>
                                                        <a class="remove-item" href="#">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cart-product clearfix">
                                                    <div class="left-data">
                                                        <img alt="" src="images/cart-product2.png">
                                                    </div>
                                                    <div class="right-data">
                                                        <strong>
                                                            <a href="#">Flying Ninja </a>
                                                        </strong>
                                                        <p>$45.00 x 2</p>
                                                        <a class="remove-item" href="#">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="cart-subtotal">Subtotal: $135.00</li>
                                    <li class="cart-buttons clearfix">
                                        <a class="btn btn-default grey" href="#" role="button">View Cart</a>
                                        <a class="btn btn-default" href="#" role="button">Checkout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <!-- Logo / Mobile Menu -->
            <div  class="col-lg-3 col-sm-3 ">
                <div id="logo">
                    <!-- <h1><a href="index.html"><img src="images/logo.png" alt=""/></a></h1> -->
                    <?php
                        if ( function_exists( 'the_custom_logo' )  ) {
                            the_custom_logo( );
                        }
                    ?>
                </div>
            </div>
            <!-- Navigation================================================== -->

            <?php
                require THE_BASE . 'template-parts/header/menu.php'
            ?>

        </div>
    </div>
</div>
<section class="page_head">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>blog</li>
                    </ul>
                </nav>

                <div class="page_title">
                    <h2>Blog Large Images</h2>
                </div>
            </div>
        </div>
    </div>
</section>
</header>