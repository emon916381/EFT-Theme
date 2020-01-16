<!-- 
    ===============
        @EFT Theme 
        ^^^^^^ this is wordpress default template..sidebar.php
        ******* To get sidebar.php just call get_sidebar() function 
    ===============
 -->
<div class="sidebar">
    <div class="sidebar-content bg-black p-2">
        <div class="social-share p-2">
        <h5 class="text-center bg-dark p-1"> Social Share</h5>
            <?php include get_template_directory()."/eft-template/social-share.php" ?> 
        </div>
        <div class="popular-post p-2">
            <?php include get_template_directory()."/eft-template/popular-post.php" ?> 
        </div>
        <div class="popular-post p-2">
        <ul class="list-unstyled">
    <?php wp_list_categories(); ?> 
    </ul>
    </div>
</div>