<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
	
	if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
		echo '<p class="nocomments">This post is password protected. Enter the password to view comments.</p>';
	 	return;
	}}
	/* This variable is for alternating comment background */
	$oddcomment = 'alt';
?>

<div id="comments">
	<?php if ($comments) : ?>
    
        <h3 id="comment-count">
			<?php comments_number('No Comments', 'One Comment', '% Comments' );?> on &#8220;<?php the_title(); ?>&#8221;
        </h3>
        <div class="comment-list row">
			<?php foreach ($comments as $comment) : ?>
            
                <div class="comment twelvecol <?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
                    <div class="tencol">
                        <?php comment_text() ?>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em>Your comment is awaiting moderation.</em>
                        <?php endif; ?>
                     </div>  
                    <div class="twocol last" id="comment-avatar" style="text-align:right;padding:.25em">
						<?php echo get_avatar( $comment, 64 ); ?>
                    </div>
                    <div class="twelvecol">
						<cite>
							<?php comment_author_link() ?> on 
                            <a href="#comment-<?php comment_ID() ?>" title="">
                                <?php comment_date('F jS, Y') ?> at <?php comment_time() ?> 
                            </a>
                            <?php edit_comment_link(__('edit'), '| ', ''); ?>
                        </cite>
                	</div>
                </div>
			<?php
                /* Changes every other comment to a different class */
                $oddcomment = ( empty( $oddcomment ) ) ? 'alt' : '';
            ?>
           	<?php endforeach; /* end for each comment */ ?>

        </div>
    
		<?php else : // this is displayed if there are no comments so far ?>
        
        <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->
        
        <?php else : // comments are closed ?>
            <!-- If comments are closed. -->
            <p class="nocomments">Comments are closed.</p>
        <?php endif; ?>
    <?php endif; ?>
    
    
    <?php if ('open' == $post->comment_status) : ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

	<h3 id="comment-reply">Leave a Reply</h3>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
        <p>Your email address will not be published. All required fields are marked with an <span class="required">*</span>   
        
        <?php if ( $user_ID ) : ?>
            <p>
                Logged in as 
                <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
                <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">
                    Log out &raquo;
                </a>
            </p>
        <?php else : ?>
            <p>
            	<label for="author">Name <span class="required">*</span></label><br>
            	<input type="text" name="author" id="author" value="" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
            </p>
            
            <p>
            	<label for="email">Email <span class="required">*</span></label><br>
            	<input type="text" name="email" id="email" value="" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
            </p>
            
            <p>
            	<label for="url">Website</label><br>
            	<input type="text" name="url" id="url" value=""  tabindex="3" />
            </p>
        
        <?php endif; ?>
        
        <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
        
        <p><textarea name="comment" id="comment" cols="70%" rows="10" tabindex="4" value="Enter comment here."></textarea></p>
        
        <p class="submitbutton"><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></p>
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        
        <?php do_action('comment_form', $post->ID); ?>
    
    </form>
    <?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>