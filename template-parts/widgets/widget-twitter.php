<?php
/**
 * Template part: Widget Twitter tweets.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$tweet1 = ( json_decode( json_decode( $args['embed_1'], true )['text'], true ) );
$tweet2 = ( json_decode( json_decode( $args['embed_2'], true )['text'], true ) );
?>

<div class="widget_content">
	<ul class="tweet_list">
		<li class="tweet_content item">
			<span class="time"><?php echo esc_html( $tweet1['date'] ); ?></span>
			<p class="tweet_link"><a href="<?php echo esc_url( $tweet1['link'] ); ?>"><?php echo esc_html( $tweet1['author'] ); ?> </a> <?php echo esc_html( the_one_short_text( $tweet1['text'] ) ); ?></p>
		</li>
		<li class="tweet_content item">
			<span class="time"><?php echo esc_html( $tweet2['date'] ); ?></span>
			<p class="tweet_link"><a href="<?php echo esc_url( $tweet2['link'] ); ?>"><?php echo esc_html( $tweet2['author'] ); ?> </a> <?php echo esc_html( the_one_short_text( $tweet2['text'] ) ); ?></p>
		</li>
	</ul>
</div>


