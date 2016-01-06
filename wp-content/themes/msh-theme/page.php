<?php get_header(); ?>
      
	<div id="content">
    	<div id="inner-content" class="wrap clearfix">
        
			<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">
                                
                                <h1 class="page-title"><?php
									$msh_h1tag_data = get_option('msh_h1tag_data');
									if ($msh_h1tag_data[$post->ID] != NULL){
									echo $msh_h1tag_data[$post->ID];
									}else{
									the_title(); 
									}
									?></h1>
                                    
										<?php if ( is_front_page() ) { ?>
                                        
                                        <hr/>
                                        
                                        <div id="highlight-wrapper" class="wrap">
                                        	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Highlight')) ?>
                                        </div>
                                        
                                        
                                        <div style="clear:both;"></div>
                                        
                                        <hr/>
                                        
                                        <?php } ?>
							
								</header> <!-- end article header -->
                                
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
							</section> <!-- end article section -->

								<footer class="article-footer">
									<?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?>

								</footer> <!-- end article footer -->


							</article> <!-- end article -->

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <!-- end #main -->

						<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->
		</div><!-- end mainwrapper -->
        
<?php get_footer(); ?>
