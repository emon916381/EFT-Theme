<!-- 
* ====================
 *  @Package EFT Theme
 * ====================
 */
 -->

 <article class="standerd_article" id="aricle-no-<?php echo $post->ID; ?>">
    <div class="container-fluid bg-black">
        <div class="row p-2 ">
            <div class="col-md-12 pl-0">
                <div class="thumbnail_img">
                   <?php the_post_thumbnail(null,array(
                        'class' => 'img-fluid'
                    ));  ?>
                </div>
            </div> <!--col-md-5-->
            <div class="col-md-12">
                <h1>
                    <?php the_title() ?>
                </h1>
                <div class="post_meta">
                    <p class="text-right text-light"> <i class="fa fa-eye"></i> <?php echo setPostViews(get_the_ID());?> Views</p>
                    <a class="ctg_link_ele" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?> "><?php the_author() ?></a>-<?php echo eft_data_and_time();?> 
                </div>
                <div class="excerpt p-1 text-justify">
                    <p class="mb-1">
                         <?php the_content(); ?>
                    </p>
                </div> <!--.excerpt-->
                <div class="readmore-btn">
                    <a class="btn bg-dark btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a>
                    <a class="btn bg-dark btn-social-icon btn-twitter"><span class="fa fa-facebook"></span></a>
                    <a class="btn bg-dark btn-social-icon btn-linkedin"><span class="fa fa-linkedin"></span></a>
                    <a class="btn bg-dark btn-social-icon btn-instagram"><span class="fa fa-instagram"></span></a>
                </div>
            </div>
        </div>
    </div>   
   
</article>

