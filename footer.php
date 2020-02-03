<!-- 
* ====================
 *  @Package EFT Theme
 * ====================
 */
 -->
<footer class="footer_area bg-black mt-2">
        <div class="container p-2">
            <div class="row">
                
                        <?php if(is_active_sidebar( 'sidebar-footer' )){
                             dynamic_sidebar( 'sidebar-footer' );
                        } ?>
                
            </div>
        </div> <!-- .container-->
</footer> 



<?php wp_footer(); ?>
</body>
</html>