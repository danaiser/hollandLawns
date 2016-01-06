<?php get_header(); ?>
<div class="row">
    <div class="eightcol" id="content">
	<h1 style="font-size:22px; margin-bottom:15px;">Search Results</h1>
	<h1 class="archive-title"><span><?php _e('Search Results for:'); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" role="article">

			<header class="article-header">

				<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

			</header> <!-- end article header -->

			<section class="entry-content">
					<?php the_excerpt('<span class="read-more">' . __('Read more &raquo;') . '</span>'); ?>

			</section> <!-- end article section -->

			<footer class="article-footer">

			</footer> <!-- end article footer -->

		</article> <!-- end article -->

	<?php endwhile; ?>

					<?php if (function_exists('pagination')) { ?>
						<nav class="pagination"><?php pagination('´','ª'); ?></nav>
					<?php } else { ?>
					<nav class="wp-prev-next">
							<ul>
								<li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries')) ?></li>
								<li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;')) ?></li>
							</ul>
					</nav>
			<?php } ?>

		<?php else : ?>

				<article id="post-not-found" class="hentry">
					<header class="article-header">
						<h1><?php _e("Sorry, No Results."); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e("Try your search again."); ?></p>
					</section>
					<footer class="article-footer">
							<p><?php _e("This is the error message in the search.php template."); ?></p>
					</footer>
				</article>

		<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>