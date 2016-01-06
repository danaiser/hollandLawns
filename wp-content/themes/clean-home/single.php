<?php get_header(); ?>


	<div id="content">
		<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		
		  <div class="post">
				<h1><?php the_title(); ?></h1>
				<small><span class="time"><?php the_time('F jS, Y') ?></span>  <span class="author"><?php the_author() ?></span> </small>

				<div class="entry">
<?php if(has_post_thumbnail()) : ?>

				<div class="featured-image">
				<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { the_post_thumbnail(array(325,325), array("class" => "thumbs")); } ?>
				</div>
<?php else : ?>
<?php endif; ?>
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p><br />
<br />
   <!--enable comments template on single.php-->  
			
				  <?php comments_template(); ?> 

				  
<div align="right">
<span class="button"><?php next_post_link('%link', 'Next post', TRUE, '13'); ?> </span>
<span class="button"><?php previous_post_link('%link', 'Previous post', TRUE, '13'); ?> </span>
</div>

			</div>		
		
	<?php endwhile; ?>

		<div class="navigation">
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi('', '', '', '', 3, false);} ?>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

    </div>
<?php get_sidebar(); ?>	

<?php get_footer(); ?>