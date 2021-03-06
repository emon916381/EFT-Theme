<!-- 
* ====================
 *  @Package EFT Theme
 * ====================
 */
 -->

<article class="standerd_article" id="aricle-no-<?php echo $post->ID; ?>">
    <div class="container-fluid bg-black">
        <div class="row p-2 ">
            <div class="col-md-5 pl-0">
                <div class="thumbnail-img">
                   <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(null,array(
                        'class' => 'img-fluid'
                    ));?></a>
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
            <div class="col-md-7">
                <h1 class="post-title" onclick="location.href='<?php the_permalink() ?>';" style="cursor:pointer;"  >
                    <?php echo wp_trim_words( get_the_title( ), 7 ,'....'); ?>
                </h1>
                <div class="post_meta">
                <a class="ctg_link_ele" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?> "><?php the_author() ?></a>-<?php echo eft_data_and_time();?>
                </div>
                <div class="excerpt">
                    <p class="mb-1">
                         <?php if(has_excerpt()){
                            the_excerpt();
                        }else{
                            echo wp_trim_words( get_the_content(), 10 ,'....');
                        }  ?>
                    </p>
                </div> <!--.excerpt-->
                <div class="readmore_btn">
                    <a href="<?php the_permalink(); ?>" class="btn-secondary p-1 text-decoration-none text-light">Read More</a> 
                </div>
            </div>
        </div>
    </div>   
   
</article>

