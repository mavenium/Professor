<?php

	/* If loaded directly */
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('لطفا" این صفحه را به صورت مستقیم بارگیری نکنید. سپاس!');

	/* If password protected */
	if (post_password_required()) { 
		?><?php _e('این نوشته با رمز محافظت شده است. رمز عبور را برای مشاهده دیدگاه وارد کنید.'); ?><?php
		return;
	}
	
	wp_reset_query();
	
?>

<!-- Master Comments -->
<div id="master-comments">

<?php if ( have_comments() ) : ?>

<!-- commentlist -->
<section class="qa-message-list" id="commentlist">

	<?php wp_list_comments('type=comment&callback=norma_comment_layout'); ?>
	
</section>
<!-- /commentlist -->
    
<?php endif; ?>

<?php if ( comments_open() ) : ?>
    
<!-- leave-comment -->
<div id="leave-cm">

    <header id="cm-header">
        <i class="fa fa-comment-o fa-lg"></i>
        <?php _e('نوشتن دیدگاه:'); ?>
        
        <div class="pull-left">
        	<?php comments_number(__('0 دیدگاه'), __('1 دیدگاه'), __('% دیدگاه'));?>
        </div>
        
    </header>

	<!-- CM Body -->
	<div id="cm-body">
    
		<?php if (get_option('comment_registration') && !is_user_logged_in()): /* Only logged in users can comment */ ?>
        
        <?php _e('برای ارسال دیدگاه باید وارد حساب کربری خود شوید.'); ?>
        
		<?php else : ?>
        
        <!-- Do Comments -->
        <div id="do-comments">
        
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                    
                    <div class="row">
                    
                        <!-- Fieldset -->
                        <div id="cm-filds" class="col-md-6 clearfix">

                            <?php if (is_user_logged_in()): /* If user logged in show details */ ?>
                                <?php _e('وارد شده با', $domain); ?> 
                                <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
                                <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="خروج از حساب کاربری"><?php _e('خروج'); ?> &raquo;</a>
                            <?php else: /* If not logged in show fields for name, email and website  */ ?>

                                <input name="author" id="author" type="text" onfocus="if(this.value=='<?php _e('نام (لازم)'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('نام (لازم)'); ?>';" value="<?php if(esc_attr($comment_author) == ''){ _e('نام (لازم)'); }else{ echo esc_attr($comment_author); } ?>">

                                <input name="email" id="email" type="text" onfocus="if(this.value=='<?php _e('ایمیل (لازم)'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('ایمیل (لازم)'); ?>';" value="<?php if(esc_attr($comment_author_email) == ''){ _e('ایمیل (لازم)'); }else{ echo esc_attr($comment_author_email); } ?>">

                                <input name="url" id="url" type="text" onfocus="if(this.value=='<?php _e('وب سایت'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('وب سایت'); ?>';" value="<?php if(esc_attr($comment_author_url) == ''){ _e('وب سایت'); }else{ echo esc_attr($comment_author_url); } ?>">

                            <?php endif; /* End if user logged in or not */ ?>

                        </div>
                        <!-- /Fieldset -->

                        <div class="col-md-6">
                            <!-- Textarea -->        
                            <textarea name="comment" id="comment" rows="3" placeholder="<?php _e('دیدگاه خود را بنویسید'); ?>"></textarea>
                            <!-- /Textarea -->
                        </div>
                        
                    </div>
                    
                    <div class="row">
                    
                        <div class="col-md-6">
                            <button type="submit" name="submit">
                                <i class="fa fa-send-o" style="margin-left: 10px;"></i>
                                <?php _e('ارسال دیدگاه'); ?>
                            </button>
                        </div>
                        
                        <div class="col-md-6"><?php cancel_comment_reply_link(); ?></div>
                    
                    </div>
                        
                    <?php comment_id_fields(); ?>
                    
                    <?php do_action('comment_form', $post->ID); ?>
        
                </form>
              
        </div>
        <!-- /Do Comments -->
        
		<?php endif; /* End if only logged in user can comment or not */ ?>

	</div>
	<!-- /CM Body -->

</div>
<!-- /leave-comment -->

<?php endif; /* End if comments are open */ ?>

</div>
<!-- /Master Comments -->