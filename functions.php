<?php 

function add_theme_scripts() {
    wp_enqueue_script( 'app-script', get_template_directory_uri() . '/assets/js/app.js', array ('jquery'), 1, true);
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
            var ajaxurl = "' . admin_url('admin-ajax.php') . '"
        </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

function post_filter_ajax_request() {
    if ( isset($_POST) ) {
        $term = $_POST['term'];

        $query = new WP_QUERY([
            'post_type' => 'post',
            'tag' => $term
        ]);

        $response = '<ul>';

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ): $query->the_post();
                $response .= '<li>' . get_the_title() . '</li>';
            endwhile;

            $response .= '</ul>';
        } else {
            $response = 'empty';
        }

        echo $response;
        	
        wp_reset_query();
    }

    exit;
}

add_action('wp_ajax_post_filter_ajax_request', 'post_filter_ajax_request');
add_action('wp_ajax_nopriv_post_filter_ajax_request', 'post_filter_ajax_request');