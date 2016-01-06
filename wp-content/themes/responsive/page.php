<?php get_header(); ?>
<div class="row">
    <div class="eightcol" id="content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">

                    <header class="article-header">

                       <h1 class="page-title" itemprop="headline"><?php
									$msh_h1tag_data = get_option('msh_h1tag_data');
									if ($msh_h1tag_data[$post->ID] != NULL){
									echo $msh_h1tag_data[$post->ID];
									}else{
									the_title(); 
									}
									?></h1>
                    </header> <!-- end article header -->

                    <section class="entry-content" itemprop="articleBody">
                        <?php the_content(); ?>
                    </section> <!-- end article section -->

                    <footer class="article-footer">
                        <?php the_tags('<span class="tags">' . __('Tags:') . '</span> ', ', ', ''); ?>

                    </footer> <!-- end article footer -->

                    <?php // comments_template(); // uncomment if you want to use them ?>

                </article> <!-- end article -->

            <?php endwhile;
        else : ?>

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
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>