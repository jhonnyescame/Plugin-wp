<?php
/*
 Plugin Name: Destaque Post Star
Version: 1.0
Author: João Paulo de Oliveira
*/

define('NV_PLUGIN_URL', plugin_dir_url( __FILE__ ));



add_action('wp_ajax_destaque_action', 'destaque_action_callback');

function destaque_action_callback() {
	global $wpdb; // this is how you get access to the database

	$id = intval( $_POST['post_id'] );

	$value = get_post_meta( $id, 'destaque_home', true);

	if ( $value == 1 ) {
		delete_post_meta( $id, 'destaque_home' );
		echo json_encode( array('status' => 'ok', 'id' => $id, 'acao' => 'removido' ) );
	} else {
		update_post_meta( $id, 'destaque_home', '1' );
		echo json_encode( array('status' => 'ok', 'id' => $id, 'acao' => 'ativado' ) );
	}

	die(); // this is required to return a proper result
}

/* Display custom column */
function display_posts_destaque( $column, $post_id ) {
	if ( $column == 'Destaque' ) {
		?>
		<div class="destaque_check <?php echo (get_post_meta($post_id, 'destaque_home',TRUE) == 1) ? "destaque_home" : "" ?>">
			<input class="post_id" type="hidden" value="<?php echo $post_id?>" />
		</div>
		<?php } }
		add_action( 'manage_posts_custom_column' , 'display_posts_destaque', 10, 2 );
		add_action( 'manage_videos_posts_custom_column' , 'display_posts_destaque', 10, 2 );


		/* Add custom column to post list */
		function add_destaque_column($columns) {
			return array_merge( $columns,
				array('Destaque' => 'Destaque') );
		}

		if( ! isset ($_GET['post_type']) ) {
			add_filter('manage_posts_columns' , 'add_destaque_column');
		}

		add_filter('manage_videos_posts_columns' , 'add_destaque_column');



		function destaque_admin_head () {
			echo '<script type="text/javascript" src="' . NV_PLUGIN_URL . 'js/quickedit_functions.js" ></script>';
			?>
			<style>

			.destaque_check {
				cursor: pointer;
				width: 37px;
				height: 36px;
				background: url("<?php echo NV_PLUGIN_URL?>img/star.png") 0 bottom;
			}

			.destaque_check.destaque_home {
				background-position: 0 top;
			}

			td.Destaque.column-Destaque .destaque_check {
			    display: none;
			}

			td.Destaque.column-Destaque .destaque_check:first-child {
			    display: block;
			}

			</style>
			<?php
		}

		add_action( 'admin_head', 'destaque_admin_head');
