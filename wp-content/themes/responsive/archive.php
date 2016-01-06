<?php get_header(); ?>
<div class="row">
    <div class="eightcol" id="content">
            <?php if (is_category()) { ?>
                <h1 class="archive-title h2">
                    <span><?php _e("Posts Categorized:"); ?></span> <?php single_cat_title(); ?>
                </h1>
            
            <?php } elseif (is_tag()) { ?> 
                <h1 class="archive-title h2">
                    <span><?php _e("Posts Tagged:"); ?></span> <?php single_tag_title(); ?>
                </h1>
            
            <?php } elseif (is_author()) { 
                global $post;
                $author_id = $post->post_author;
            ?>
                <h1 class="archive-title h2">
        
                    <span><?php _e("Posts By:"); ?></span> <?php echo get_the_author_meta('display_name', $author_id); ?>
        
                </h1>
            <?php } elseif (is_day()) { ?>
                <h1 class="archive-title h2">
                    <span><?php _e("Daily Archives:"); ?></span> <?php the_time('l, F j, Y'); ?>
                </h1>
        
            <?php } elseif (is_month()) { ?>
                <h1 class="archive-title h2">
                    <span><?php _e("Monthly Archives:"); ?></span> <?php the_time('F Y'); ?>
                </h1>
        
            <?php } elseif (is_year()) { ?>
                <h1 class="archive-title h2">
                    <span><?php _e("Yearly Archives:"); ?></span> <?php the_time('Y'); ?>
                </h1>
            <?php } ?>
        
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
            <article id="post-<?php the_ID(); ?>" role="article">
            
                <header class="article-header">
                
                    <h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>		
                </header> <!-- end article header -->
        
                <section class="entry-content">
            
				<?php if ( has_post_thumbnail() ) {echo "<div class='featured-archive-image'>"; the_post_thumbnail('thumbnail'); echo "</div>";}?>	
            
                    <?php the_excerpt(); ?>
        
                </section> <!-- end article section -->
            
                <footer class="article-footer">
                
                </footer> <!-- end article footer -->
        
            </article> <!-- end article -->
        
            <?php endwhile; ?>	
        
                <?php if(function_exists("pagination")){ 
                    pagination($additional_loop->max_num_pages); 
                    
                }else{ ?>
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
                        <h1><?php _e("Oops, Post Not Found!"); ?></h1>
                    </header>
                    <section class="entry-content">
                        <p><?php _e("Uh Oh. Something is missing. Try double checking things."); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e("This is the error message in the archive.php template."); ?></p>
                    </footer>
                </article>
        
            <?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>