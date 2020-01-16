<div class="popular-post">
                        <h5 class="text-center bg-dark p-1"> Popular Posts</h5>
                        <?php
                            query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=3');
                            if (have_posts()) : while (have_posts()) : the_post();
                        ?>
                             <div class="container-fluid">
                                <div class="row p-1">
                                    <div class="col-3">
                                        <div class="popular-post">
                                            <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(null,array(
                                                'class' => 'img-fluid'
                                            ));?></a>
                                        </div>
                                    </div> <!--col-md-5-->
                                    <div class="col-9 pl-0">
                                        <p class="post-title" onclick="location.href='<?php the_permalink() ?>';" style="cursor:pointer;"  >
                                            <?php echo wp_trim_words( get_the_title( ), 7 ,'....'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>   
                        <?php
                        endwhile; endif;
                        wp_reset_query();
                        ?>
                    </div>