<?php get_header(); ?>
<div class="row">
    <div class="eightcol" id="content">
    <?php
		$query = new WP_Query(array( 
			'post_type' => 'page',
			'p' => get_option('page_for_posts'),
			'posts_per_page' => 1
		) );  
	?>
		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<header class="article-header">

				<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
			</header> <!-- end article header -->

			<section class="entry-content" itemprop="articleBody">
				<?php the_content(); ?>
		</section> <!-- end article section -->

			<footer class="article-footer">
				<?php the_tags('<span class="tags">' . __('Tags:') . '</span> ', ', ', ''); ?>

			</footer> <!-- end article footer -->

			<?php // comments_template(); // uncomment if you want to use them ?>

		</article> <!-- end article -->

		<?php endwhile; else : ?>

				<article id="post-not-found" class="hentry">
					<header class="article-header">
						<h1><?php _e("Oops, Post Not Found!"); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e("Uh Oh. Something is missing. Try double checking things."); ?></p>
					</section>
					<footer class="article-footer">
							<p><?php _e("This is the error message in the page.php template."); ?></p>
					</footer>
				</article>

		<?php endif; ?>
<?php 
	wp_reset_query(); 
	query_posts(array( 
        'post_type' => 'post',
		'paged' => get_query_var('paged') 
    ) );  
?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" role="article" class="blog-article twelvecol">

<header class="article-header">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>		
</header> <!-- end article header -->

<section class="entry-content">

<?php if ( has_post_thumbnail() ) {echo "<div class='featured-archive-image'><a href='"; the_permalink(); echo "'>"; the_post_thumbnail('thumbnail'); echo "</a></div>";}?>	

<?php the_excerpt(); ?>

</section> <!-- end article section -->

<footer class="article-footer">

</footer> <!-- end article footer -->

</article> <!-- end article -->

<?php endwhile; ?>	
		<?php if (function_exists('pagination')) { ?>
        	<?php if (function_exists("pagination")) {pagination($additional_loop->max_num_pages);} ?>
        <?php } else { ?>
            <nav class="wp-prev-next">
                <ul>
                    <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries')) ?></li>
                    <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;')) ?></li>
                </ul>
        	</nav>
        <?php } wp_reset_query();  ?> 
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>