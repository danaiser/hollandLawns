<div class="container" id="footer-container">
    <div class="row" id="footer-row">
        <div class="twelvecol" id="footer">
        	<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> <?php bloginfo('description'); ?> | <a href="/sitemap">Sitemap</a></p>
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer')) ?>
            <p><?php wp_footer() ?></p>
        </div>
    </div>
</div>
</body>
</html>