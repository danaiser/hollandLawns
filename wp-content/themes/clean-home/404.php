<?php get_header(); ?>

	<div id="content">
<div style="clear:both;">   
<div class="post">

    <h1>Page Not Found</h1>  
				<p>You 
<?php
#some variables for the script to use
#if you have some reason to change these, do.  but wordpress can handle it
$adminemail = get_option('admin_email'); #the administrator email address, according to wordpress
$website = get_bloginfo('url'); #gets your blog's url from wordpress
$websitename = get_bloginfo('name'); #sets the blog's name, according to wordpress

  if (!isset($_SERVER['HTTP_REFERER'])) {
    #politely blames the user for all the problems they caused
        echo "tried going to "; #starts assembling an output paragraph
	$casemessage = "All is not lost!";
  } elseif (isset($_SERVER['HTTP_REFERER'])) {
    #this will help the user find what they want, and email me of a bad link
	echo "clicked a link to"; #now the message says You clicked a link to...
        #setup a message to be sent to me
	$failuremess = "A user tried to go to $website"
        .$_SERVER['REQUEST_URI']." and received a 404 (page not found) error. ";
	$failuremess .= "It wasn't their fault, so try fixing it.  
        They came from ".$_SERVER['HTTP_REFERER'];
	mail($adminemail, "Bad Link To ".$_SERVER['REQUEST_URI'],
        $failuremess, "From: $websitename <noreply@$website>"); #email you about problem
	$casemessage = "An administrator has been emailed 
        about this problem, too.";#set a friendly message
  }
  echo " ".$website.$_SERVER['REQUEST_URI']; ?> 
and it doesn't exist. <?php echo $casemessage; ?>  You can click back 
and try again or search for what you're looking for:

</p>    <p>None of us are perfect, but have you checked your address bar? There might be a typo in the URL.</p>  
    <p>If there isn't, you could try searching my website for the content you were looking for:</p> 
    <?php get_search_form(); ?> 
    <p>Or maybe you were looking for one of my popular pages:</p> 
   
    <ul>
	<?php wp_list_pages('title_li=&depth=1'); ?>
    </ul>

    <p>Alternatively, you can go to <a href="/">my home page</a>.</p> 
    <p>One last thing, if you're feeling so kind, please <?php echo '<a href="mailto:'.get_bloginfo('admin_email').'">TELL ME</a>'; ?> about this error, so that I can fix it. Thanks!</p>  
</div>  
            </div>
</div><?php get_sidebar(); ?>
	</div>
	


<?php get_footer(); ?>