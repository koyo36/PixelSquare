<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

/**
 * This Theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme_setup()
{
   	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
    load_theme_textdomain( 'pixelsquare' );

	// Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Image size
	 */
	add_image_size('pixelsquare_thumb', 380, 400, array( 'top', 'left' ));
	add_image_size('pixelsquare_freebie',  750, 800);


	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'pixelsquare' ),
		'social' => __( 'Social Links Menu', 'pixelsquare' ),
    ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

    // Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
     */
    // TODO
	//add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function theme_scripts()
{
    // Load Bootstrap
	wp_enqueue_style( 'theme-bootstrap', get_theme_file_uri( '/assets/vendor/bootstrap/css/bootstrap.min.css' ));
	// Load Font-Awesome
	wp_enqueue_style( 'theme-fontawesome', get_theme_file_uri( '/assets/vendor/font-awesome/css/all.min.css' ));
    // Theme stylesheet.
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts', 'theme_scripts');


/**
 * Creating custom post type for articles
 */
function pixelsquare_post_type(){
	$labels = array(
					'name' => __('Freebies'),
					'singular_name' => __('Freebie'),
					'add_new' => 'Add New',
					'new_item' => 'Edit Freebies',
					'view_item' => 'View Freebies',
					'search_items' => 'Search Freebies',
					'not_found' => 'No Freebies Found Bro',
					'rewrite' => true
	);

	$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'freebie'),
				'capability_type' => 'post',
				'has_archive' => true,
				'hierarchical' => false,
				'has_archive' => 'freebie',
				'taxonomies' => array('category'),
				'supports' => array(
					'title',
					'editor',
					'comments',
					'thumbnail',
					'custom-fields',
					'page-attributes',
					'tags'
				)
	  );

	register_post_type('freebie_articles', $args);
	register_taxonomy_for_object_type('category', 'freebie_articles');

}
add_action('init', 'pixelsquare_post_type');
//flush_rewrite_rules();

/**
 * Download Link Metabox
 */
 function pixelsquare_download_metabox(){

 	//add_meta_box(html_id, meatbox_heading, callback_fun, post_type_where_its_diasplayed, position(normal,side), priority)
 	add_meta_box('download_metabox', 'Download Link', 'display_download_metabox', 'post', 'side', 'high');

 }
 add_action('admin_init', 'pixelsquare_download_metabox');


//Callback/Display function for download metabox
 function display_download_metabox(){

 	$values = get_post_custom( $post->ID );
	//print_r($values);
	$text = isset( $values['download_metaboxu'][0] ) ? $values['download_metaboxu'][0] : '';
	//var_dump($length);
	//var_dump($_POST);
 	//Retrive download link

	global $post;

	   // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
 	?>
	<p>
		<label for="download_metaboxu"> Enter download link: </label>
		<input type="text" class="widefat" name="download_metaboxu" id="download_metaboxu" value="<?php echo $text; ?>"/>
	</p>
	<?php
 }


add_action('save_post', 'download_metabox_save');

function download_metabox_save($post_id){

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

	if(isset($_POST['download_metaboxu'])){
		update_post_meta($post_id, 'download_metaboxu', wp_kses( $_POST['download_metaboxu'], $allowed ));
	}

}


// =========================
// POST LOVE
// =========================

add_action('wp_enqueue_scripts', 'ajax_test_enqueue_scripts');
function ajax_test_enqueue_scripts()
{
	if( is_single() ) {
		wp_enqueue_style( 'love', get_theme_file_uri( '/assets/vendor/love/love.css' )  );
	}

	wp_enqueue_script( 'love', get_theme_file_uri( '/assets/vendor/love/love.js' ), array('jquery'));

	wp_localize_script( 'love', 'postlove', array(
		'ajax_url'	=> admin_url('admin-ajax.php')
	) );
}

function post_index_love_display() {
	$love_text = '';

	// $love = get_post_meta( get_the_ID(), 'post_love', true );
	// $love = ( empty( $love ) ) ? 0 : $love;

	//$love_text = '<p class="love-received"><a class="love-button" href="' . admin_url( 'admin-ajax.php?action=post_love_add_love&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '">give love</a><span id="love-count">' . $love . '</span></p>';
	// $love_text  = '<a href="' . admin_url( 'admin-ajax.php?action=post_love_add_love&post_id=' . get_the_ID() ) . '" class="ps-btn ps-pink love-button" data-id="' . get_the_ID() . '">';
	// $love_text .= '<i class="far fa-heart"></i> Give love <span id="love-count">' . $love . '</span>';
	// $love_text .= '</a>';

	$love_text = '<a href="' . admin_url( 'admin-ajax.php?action=post_love_add_love&post_id=' . get_the_ID() ) . '" class="btn btn-love btn-love-index" data-id="' . get_the_ID() . '"><i class="far fa-heart"></i> Love It</a>';

	return $love_text;
}

function post_love_display() {
	$love_text = '';

	if ( is_single() ) {

		$love = get_post_meta( get_the_ID(), 'post_love', true );
		$love = ( empty( $love ) ) ? 0 : $love;

		//$love_text = '<p class="love-received"><a class="love-button" href="' . admin_url( 'admin-ajax.php?action=post_love_add_love&post_id=' . get_the_ID() ) . '" data-id="' . get_the_ID() . '">give love</a><span id="love-count">' . $love . '</span></p>';
		$love_text  = '<a href="' . admin_url( 'admin-ajax.php?action=post_love_add_love&post_id=' . get_the_ID() ) . '" class="ps-btn ps-pink love-button" data-id="' . get_the_ID() . '">';
		$love_text .= '<i class="far fa-heart"></i> Give love <span id="love-count">' . $love . '</span>';
		$love_text .= '</a>';

	}

	return $love_text;

}

add_action( 'wp_ajax_nopriv_post_love_add_love', 'post_love_add_love' );
add_action( 'wp_ajax_post_love_add_love', 'post_love_add_love' );

function post_love_add_love() {
	$love = get_post_meta( $_REQUEST['post_id'], 'post_love', true );
	$love++;
	update_post_meta( $_REQUEST['post_id'], 'post_love', $love );
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		echo $love;
		die();
	}
	else {
		wp_redirect( get_permalink( $_REQUEST['post_id'] ) );
		exit();
	}
}


// Pagination
function ps_numeric_posts_nav_a()
{

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page **/
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max = intval( $wp_query->max_num_pages );

	/** Add current page to the array **/
	var_dump($max);
	var_dump($paged);

	if ( $paged >= 2 )
		$links[] = $paged -1;
		$links[] = $paged;

	/** Add the pages around the current page to the array **/
	if( $paged >= 3 ) {
		var_dump(' >= '.$paged);
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if(( $paged + 2 ) <= $max )
	{
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	/** Link to first page, plus ellipses if necessary */
	sort( $links );
	var_dump( $links );

	foreach( (array) $links as $link ) {
		$class = $paged == $link ? ' class="nav-item active" ' : ' class="nav-item"';

		printf( '<li %s ><a class="nav-link" href="%s">%s </a></li>' . "\n", $class , esc_url( get_pagenum_link( $link ) ), $link );


	}

	/** Link to last page, plus ellipses if necessary */
	if( ! in_array( $max, $links ) ) {
		if( ! in_array( $max - 1, $links ) )
			echo '<li class="nav-link">...</li>' . "\n";

		$class = $paged == $max ? ' class="nav-item active"' : ' class="nav-item"';
		printf( '<li %s ><a class="nav-link" href="%s">%s </a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

}

function ps_numeric_posts_nav()
{
	global $wp_query;

	$total = $wp_query->max_num_pages;

	// Only bother with the rest if we have more than 1 page
	if( $total > 1 )
	{
		// get current page
		if( !$current_page = get_query_var('paged') )
			$current_page = 1;

		// Structure of "format" depends on whether we're using pretty permalinks
		if( get_option('permalink_structure') )
		{
			$format = '&paged=%#%';
		}
		else
		{
			$format = 'page/%#%/';
		}

		echo paginate_links(array(
			'base'		=> get_pagenum_link(1) . '%_%',
			'format'	=> $format,
		));
	}
}
