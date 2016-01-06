<?php get_header(); ?>


	<div id="content">  
    <h1 style="font-size:22px; margin-bottom:15px;">Search Results</h1>
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		
		
        <div style="margin-bottom:20px; border-bottom:dotted thin #999; padding-bottom:10px; width:97%;">
				<h2 style="font-size:16px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				

				
<?php if(has_post_thumbnail()) : ?>

				<div id="thumbnail2">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { the_post_thumbnail(array(125,125), array("class" => "thumbs")); } ?></a>
				</div>
<?php else : ?>
<?php endif; ?>
					<div style="padding-top:10px;"><?php the_excerpt(); ?></div>
                <div style="clear:both;"></div>
				
</div>
					
		
	<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>