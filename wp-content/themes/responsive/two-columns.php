<?php /* Template Name: Two Column Page */ ?>

<?php get_header(); ?>
<div class="row">
    <div class="eightcol" id="content">
		<?php if (have_posts()) : ?>
    
            <?php while (have_posts()) : the_post(); ?>
            
                <h1><?php the_title(); ?></h1>                
    
            <?php endwhile; ?>
            <?php  if (have_posts()) : while (have_posts()) : the_post();?>
            <?php $page_columns = explode("[column]", $post->post_content); endwhile; endif;?>
            <div class="sixcol" id="left-column">
                <?php  print apply_filters('the_content', $page_columns[0]);?>
            </div>
            <div class="sixcol last" id="right-column">
                <?php  print apply_filters('the_content', $page_columns[1]);?>
            </div>
			<div class="twelvecol last" id="right-column">
                <?php  print apply_filters('the_content', $page_columns[2]);?>
            </div>
            <div class="navigation">
                <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
                <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
            </div>
    
        <?php else: ?>
    
            <h2 class="center">Not Found</h2>
            <p class="center">Sorry, but you are looking for something that isn't here.</p>
    
        <?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>