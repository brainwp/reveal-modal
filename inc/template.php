<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05/08/14
 * Time: 17:52
 */ ?>
<?php if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content();?>
<?php endwhile; ?>
<?php endif; ?>
