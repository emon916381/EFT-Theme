<div class="post-formates-post">
    <?php 
        if(have_posts()):
            while(have_posts()):the_post();
            if(is_home()){
                    get_template_part( 'eft-template/content/content', get_post_type() );
            }
            elseif( is_single()|| is_page()){
                include( get_template_directory().'/eft-template/content/single_page.php' );
            }
               
            endwhile;
         endif;
    
    ?> 
<?php
echo bootstrap_pagination();

?>
</div>