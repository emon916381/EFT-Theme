<?php
/**=========== Sidebar Register ================ */
function eft_sidebar(){
    register_sidebar( array(
        'name'  =>  'Home Page Sidebar',
        'id'    =>  'sidebar-home',
        'description' => 'Drag and Drop any weidget',
        'before_widget' => '<div class="popular-post">',
        'after_widget' => '</div>',
        'before_title'  => '<h5 class="text-center bg-dark p-1">',
        'after_title'=> '</h5>'
    ) );
}
add_action( 'widgets_init','eft_sidebar' );
function eft_footer_sidebar(){
    register_sidebar( array(
        'name'  =>  'Footer',
        'id'    =>  'sidebar-footer',
        'description' => 'Drag and Drop any weidget',
        'before_widget' => '<div class="col-md-4"><div class="popular-post">',
        'after_widget' => '</div></div>',
        'before_title'  => '<h5 class="p-1 text-light eft-footer-title">',
        'after_title'=> '</h5>'
    ) );
}
add_action( 'widgets_init','eft_footer_sidebar' );

/**======= Popular Post List widget ============== */

class eft_widget_option extends WP_Widget{

    public function __construct(){
        $widget_option = array(
            
            'classname' => 'eft-popular-posts',
            'description'   => 'Most Popular Posts'
        );
        parent:: __construct('eft-popular-post','EFT Popular Posts',$widget_option);
    }

/**========= This function make option on Admin panel ============== */
    function form( $instance ){

        $title = ( !empty($instance['title']) ) ? $instance['title'] : 'Popular Posts';
        $total =( !empty($instance['number']) ) ? $instance['number'] : 3 ;
        $box = ( !empty( $instance['chk_box'] ) ) ? $instance['chk_box'] : '' ;

       $output = '<p><label for="'.esc_attr(  $this->get_field_id('title') ).'"> Title: </label>';
       $output .= '<input type="text" class="widefat" id="'.esc_attr( $this->get_field_id('title') ).'" name="'.esc_attr( $this->get_field_name('title') ).'" value="'. esc_attr( $title ) .'"  ></p>';

       $output .= '<p><label for="'.esc_attr(  $this->get_field_id('number') ).'"> Number of posts to show: </label>';
       $output .= '<input type="number" class="tiny-text" id="'.esc_attr( $this->get_field_id('number') ).'" name="'.esc_attr( $this->get_field_name('number') ).'" value="'. esc_attr( $total ) .'"  ></p>';

       $output .= '<p><input type="checkbox" class="checkbox" id="'.esc_attr( $this->get_field_id('chk_box') ).'" name="'.esc_attr( $this->get_field_name('chk_box') ).'" '.$box.' >';
        $output .= '<label for="'.esc_attr(  $this->get_field_id('chk_box') ).'"> Show views number </label></p>';
       echo $output;
    }

/**========= This function save and update data in databases ============== */
    function update(  $new_instance, $old_instance){
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
        $instance['number'] = ( !empty( $new_instance['number'] ) ) ? $new_instance['number'] : 0;
        $instance['chk_box'] = ( !empty( $new_instance['chk_box'] ) ) ? 'checked': '';
        return $instance;
    }

/**========= This widget function show data in font page markup ============ */

    function widget( $args, $instance ){
           $tol = absint( $instance['number']);
            echo $args['before_widget'];
            if( !empty($instance['title']) ):
                echo $args['before_title'] .$instance['title']. $args['after_title'];
            endif;?>

<?php
/**================= Popular Post content  ================*/ 
                           $popular = new WP_Query(array(
                                'meta_key' => 'post_views_count',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'posts_per_page' => $tol
                            ));
                            if ($popular->have_posts()) : while ($popular->have_posts()) : $popular->the_post();
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
 


            <?php echo $args['after_widget'];
    }

}
add_action( 'widgets_init', function(){ register_widget( 'eft_widget_option' ); }   );


/**^^^^^^^^^^^^^^^ Unregister Widget ^^^^^^^^^^^^^^^^ */
if (!function_exists('my_unregister_default_wp_widgets')) {
    function my_unregister_default_wp_widgets() { 
        unregister_widget('WP_Widget_Calendar');
    }
    add_action('widgets_init', 'my_unregister_default_wp_widgets', 1);
}

/**========== Category markup =========== */

Class My_Categories_Widget extends WP_Widget_Categories {
    public function widget( $args, $instance ) {
        static $first_dropdown = true;
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Categories' );
 
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
 
        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
        $d = ! empty( $instance['dropdown'] ) ? '1' : '0';
 
        echo $args['before_widget'];
 
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
 
        $cat_args = array(
            'orderby'      => 'name',
            'show_count'   => $c,
            'hierarchical' => $h,
        );
 
        if ( $d ) {
            echo sprintf( '<form action="%s" method="get">', esc_url( home_url() ) );
            $dropdown_id    = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
            $first_dropdown = false;
 
            echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';
 
            $cat_args['show_option_none'] = __( 'Select Category' );
            $cat_args['id']               = $dropdown_id;
 
            /**
             * Filters the arguments for the Categories widget drop-down.
             *
             * @since 2.8.0
             * @since 4.9.0 Added the `$instance` parameter.
             *
             * @see wp_dropdown_categories()
             *
             * @param array $cat_args An array of Categories widget drop-down arguments.
             * @param array $instance Array of settings for the current widget.
             */
            wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args, $instance ) );
 
            echo '</form>';
 
            $type_attr = current_theme_supports( 'html5', 'script' ) ? '' : ' type="text/javascript"';
            ?>
 
<script<?php echo $type_attr; ?>>
/* <![CDATA[ */
(function() {
    var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
    function onCatChange() {
        if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
            dropdown.parentNode.submit();
        }
    }
    dropdown.onchange = onCatChange;
})();
/* ]]> */
</script>
 
            <?php
        } else {
           
        echo '<ul class="list-group list-group-flush bg-black">';   
            $categories = get_categories();
            foreach  ($categories as $category) {
                //Display the sub category information using $category values like $category->cat_name

                echo '<li class="list-group-item bg-black pt-1 pb-1"><a class="text-light" href="'.get_category_link( $category->term_id
         ).'">'.$category->name.'</a></li>';
            }
        echo '</ul>';
    }

//  after widget class
        echo $args['after_widget'];
    }
}

function my_categories_widget_register() {
    unregister_widget( 'WP_Widget_Categories' );
    register_widget( 'My_Categories_Widget' );
}
add_action( 'widgets_init', 'my_categories_widget_register' );


/**Tags markup change */

class my_tags extends WP_Widget_Tag_Cloud{

    public function widget( $args, $instance ) {
        $current_taxonomy = $this->_get_current_taxonomy( $instance );
 
        if ( ! empty( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
            if ( 'post_tag' === $current_taxonomy ) {
                $title = __( 'Tags' );
            } else {
                $tax   = get_taxonomy( $current_taxonomy );
                $title = $tax->labels->name;
            }
        }
 
        $show_count = ! empty( $instance['count'] );
 
      
 
       
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
 
        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }?>
       

       <div class="tag-show pt-2">
            <?php
            $tags = get_tags( 'post_tag' ); //taxonomy=post_tag
            if ( $tags ) :
                foreach ( $tags as $tag ) : ?>
                    <span class="bg-dark ml-1">
                        <a class="tag" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>">#<?php echo esc_html( $tag->name );
                        if( $show_count == 1){
                            echo ' (' .$tag->count. ')';
                        }
                        ?>    
                </a></span>
                <?php endforeach; ?>
            <?php endif; ?>
       </div>
     <?php echo $args['after_widget'];
    }


}
function my_tags_list(){
    unregister_widget( 'WP_Widget_Tag_Cloud' );
    register_widget( 'my_tags' );
}
add_action( 'widgets_init','my_tags_list' );



/**^^^^ EXPEREMENTAL FILTER HOOK ^^^^^^^^^^ */
function first_filter_hook( $title ){

    $title = "OK GOOGLE FUCK U";
    echo $title;

}
apply_filters('the_title ', 'first_filter_hook');






