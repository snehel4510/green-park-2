<?php get_header(); ?>

<div id="container">
<div id="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">
            <h1><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h1>
            <div class="entry">
                <p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
                <div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>

		<?php the_content((__( '&raquo; Read more: ', 'greenpark')) . the_title('', '', false)); ?>

                <div class="navigation clearfix">
                    <div class="alignleft"><?php previous_image_link() ?></div>
                    <div class="alignright"><?php next_image_link() ?></div>
                </div>
            </div>


            <div class="postmetadata alt clearfix">
                <p class="categories">
                    <?php _e('Posted in ', 'greenpark' ); the_category(', '); ?>
                </p>
                <?php the_tags('<p class="tags">Tags: ', ' ', '</p>'); ?>
                <p class="infos">
                    <?php _e('You can follow any responses to this entry through the', 'greenpark'); ?> <a href="<?php echo get_post_comments_feed_link() ?>" rel="nofollow"><?php _e('RSS 2.0 Feed', 'greenpark'); ?></a>. 

                    <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                            // Both Comments and Pings are open ?>
                            <?php _e('You can', 'greenpark'); ?> <a href="#respond"><?php _e('leave a response', 'greenpark'); ?></a> <?php _e(', or ', 'greenpark'); ?> <a href="<?php trackback_url(); ?>" rel="trackback nofollow"><?php _e('trackback', 'greenpark'); ?></a> <?php _e('from your own site', 'greenpark'); ?>.

                    <?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                            // Only Pings are Open ?>
                            <?php _e('Responses are currently closed, but you can', 'greenpark'); ?> <a href="<?php trackback_url(); ?> " rel="trackback nofollow"><?php _e('trackback', 'greenpark'); ?></a> <?php _e('from your own site', 'greenpark'); ?>.

                    <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                            // Comments are open, Pings are not ?>
                            <?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', 'greenpark'); ?>

                    <?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                            // Neither Comments, nor Pings are open ?>
                            <?php _e('Both comments and pings are currently closed.', 'greenpark'); ?>

                    <?php } edit_post_link(__( 'Edit this entry', 'greenpark' ),'','.'); ?>
                </p>
            </div>

        </div>
    
        <?php comments_template('', true); ?>

    <?php endwhile; else: ?>

        <?php get_template_part( 'content', 'missing' ); ?>

    <?php endif; ?>

</div> <!-- #content -->
</div> <!-- #container -->

<?php if(get_option('greenpark2_sidebar_disablesidebar') != true) get_sidebar(); ?>
<?php get_footer(); ?>
