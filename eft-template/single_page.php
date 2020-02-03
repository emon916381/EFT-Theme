<!-- 
* ====================
 *  @Package EFT Theme
 ^^^ Single.php to show content
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
                                        <div class="cate-shows">
                    <?php
                    $categories = get_the_category();
                    $separator = '/';
                    $output = '';
                    if ( ! empty( $categories ) ) {
                        foreach( $categories as $category ) {
                            $output .= '<a class="p-1 text-decoration-none text-light" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                        }
                        echo trim( $output, $separator );
                    }?>
                    </div>
                </div>
            </div> <!--col-md-5-->
            <div class="col-md-12">
                <h1>
                    <?php the_title() ?>
                </h1>
                <?php if(!is_page()){ ?>

                <div class="post_meta">
                    <p class="text-right text-light"> <i class="fa fa-eye"></i> <?php echo setPostViews(get_the_ID());?> Views</p>
                    <a class="ctg_link_ele" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?> "><?php the_author() ?></a>-<?php echo eft_data_and_time();?> 
                </div>
                <?php } ?>
                <div class="excerpt p-1 text-justify">
                    <p class="mb-1">
                         <?php the_content(); ?>
                    </p>
                </div> <!--.excerpt-->

                <?php if( !is_page() ): ?>
                <?php include get_template_directory(  )."/eft-template/social-share.php" ?>
                <div class="tag-show pt-2">
                <?php esc_attr( the_tags( 'Tags: <span class="p-2 bg-dark ml-1" >#','</span><span class="p-1 bg-dark ml-1">#', '<span>') )  ?>
                </div>
                <?php echo eft_single_navigation(); ?> 
                <?php endif ?>

            </div>
        </div>
      
    </div>   
   
</article>

