<!-- 
    ================
    @EFT Theme
    *** This template handel all content template part.......
    *** We controll all pages content tempalte........is_home()...is_archive().....is_single().
    ================
 -->

<div class="post-formates-post">
    <?php 
    if(is_archive(  )){
        ?>
        <div class="archive-title pt-3 pb-3 p-2 bg-dark">
        <!-- Archive, tag and category title and desc -->
                <h2 class="text-center" ><?php the_archive_title(); ?></h2>
                <?php the_archive_description('<span class="archive_desc">', '</span>' ); ?>
        </div>
        
        <?php
    }
        if(have_posts()):
            while(have_posts()):the_post();
            if(is_home()){
                    get_template_part( 'eft-template/content/content', get_post_type() );
            }
            elseif( is_single()|| is_page()){
                include( get_template_directory().'/eft-template/single_page.php' );
            }elseif( is_archive() ){
                include get_template_directory().'/eft-template/archive.php';
            }
               
            endwhile;
         endif;
    
    ?> 
<?php
echo bootstrap_pagination();

?>
</div>