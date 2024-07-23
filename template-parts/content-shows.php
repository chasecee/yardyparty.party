<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content show-content banner">
		<div class="content-content">
		<?php the_title( '<h1 class="entry-titl">', '</h1>' ); ?>
		<div class="date"><?php the_field('date'); ?></div>
		
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			)
		);
		?>
		
		<?php 
$images = get_field('gallery');
	if( $images ): ?>
	<div class="masonry">
		<?php foreach( $images as $image ): 
			$data_type = pathinfo($image['url'], PATHINFO_EXTENSION);
			if ($data_type == 'mov') {?>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<video preload="metadata">
					<source src="<?php echo $image['url'];?>#t=0.5" type="video/mp4">
					Your browser does not support the video tag.
				</video>
			</div>
			<?php } else {?>
			<div class="item">
				<!-- <a href="<?php echo esc_url($image['url']); ?>"> -->
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" height="<?php echo esc_attr($image['height']); ?>" width="<?php echo esc_attr($image['width']); ?>" />
				<!-- </a> -->
			</div>
		<?php } endforeach; ?>
	</div>
<?php endif; ?>
<?php
if( have_rows('artist') ): ?>
	<div class="artists">
<?php
    while( have_rows('artist') ) : the_row();

        $name = get_sub_field('name');
		$embed_code = get_sub_field('embed_code'); ?>
		<div class="artist">
			<h2><?php echo esc_attr($name); ?></h2>
			<?php if($embed_code) { ?>
			<div class="iframe"><?php echo _($embed_code); ?></div>
			<?php } ?>
		</div>
		<?php

    // End loop.
    endwhile; ?>
	</div>
<?php
endif; ?>
<div class="back_to_home"><a href="<?php echo home_url(); ?>" title="back to home">All shows ></a></div>
</div>
</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
