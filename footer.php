<!-- 
* ====================
 *  @Package EFT Theme
 * ====================
 */
 -->
<footer class="footer_area bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="popular-post">
                        <h2"> Popular Posts</h2>
                        <?php
query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=3');
if (have_posts()) : while (have_posts()) : the_post();
?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
endwhile; endif;
wp_reset_query();
?>
                    </div>
                </div>
                <div class="col-md-4">
                
                </div><!-- .col-md-4 -->
                <div class="col-md-3">
                
                </div><!-- .col-md-3 -->
            </div>
        </div> <!-- .container-->
</footer> 



<?php wp_footer(); ?>
</body>
</html>