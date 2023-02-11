<?php
    $about      = isset( $args[ 'about_us_text' ] ) ? $args[ 'about_us_text' ] : 'Donec earum rerum hic tenetur ans sapiente delectus, ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus asperiores.';
    $address    = isset( $args[ 'address' ] ) ? $args[ 'address' ] : '#2021 Lorem Ipsum';
    $phone      = isset( $args[ 'phone_number' ] ) ? $args[ 'phone_number' ] : '(+91) 9000-12345';
    $email      = isset( $args[ 'email' ] ) ? $args[ 'email' ] : 'mail@example.com';
?>
<div class="widget_content">
    <p><?php esc_attr_e( $about, 'the-one' ); ?></p>
    <ul class="contact-details-alt">
        <li><i class="fa fa-map-marker"></i> <p><strong>Address</strong> : <?php esc_attr_e( $address, 'the-one' ); ?></p></li>
        <li><i class="fa fa-user"></i> <p><strong>Phone</strong><a href="tel:"> : <?php esc_attr_e( $phone, 'the-one' ); ?></a></p></li>
        <li><i class="fa fa-envelope"></i> <p><strong>Email</strong>: <a href="mailto:"><?php esc_attr_e( $email, 'the-one' ); ?></a></p></li>
    </ul>
</div>