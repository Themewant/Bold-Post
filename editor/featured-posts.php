<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Bold_Post_Featured_Post' ) ) {

	class Bold_Post_Featured_Post {

		public function __construct() {

			// Meta box
			add_action( 'add_meta_boxes', [ $this, 'register_meta_box' ] );
			add_action( 'save_post', [ $this, 'save_featured_meta' ] );

			// Admin column
			add_filter( 'manage_posts_columns', [ $this, 'add_featured_column' ] );
			add_action( 'manage_posts_custom_column', [ $this, 'render_featured_column' ], 10, 2 );

			// Quick Edit
			add_action( 'quick_edit_custom_box', [ $this, 'quick_edit_field' ], 10, 2 );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_quick_edit_script' ] );
		}

		/* ================= Meta Box ================= */

		public function register_meta_box() {
			add_meta_box(
				'bold_featured_post',
				'Featured Post',
				[ $this, 'render_meta_box' ],
				'post',
				'side'
			);
		}

		public function render_meta_box( $post ) {
			wp_nonce_field( 'bold_featured_nonce', 'bold_featured_nonce' );
			$is_featured = get_post_meta( $post->ID, '_is_featured', true );
			?>
			<label>
				<input type="checkbox" name="bold_is_featured" value="yes" <?php checked( $is_featured, 'yes' ); ?> />
				Mark as Featured
			</label>
			<?php
		}

		public function save_featured_meta( $post_id ) {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}

			// Verify nonce
			if ( ! isset( $_POST['bold_featured_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bold_featured_nonce'] ) ), 'bold_featured_nonce' ) ) {
				return;
			}

			if ( isset( $_POST['bold_is_featured'] ) ) {
				update_post_meta( $post_id, '_is_featured', 'yes' );
			} else {
				update_post_meta( $post_id, '_is_featured', 'no' );
			}
		}

		/* ================= Admin Column ================= */

		public function add_featured_column( $columns ) {
			$columns['is_featured'] = 'Featured';
			return $columns;
		}

		public function render_featured_column( $column, $post_id ) {
			if ( $column !== 'is_featured' ) {
				return;
			}

			$value = get_post_meta( $post_id, '_is_featured', true );
			echo '<span class="bold-featured-value" data-featured="' . esc_attr( $value ) . '">';
			echo $value === 'yes' ? '⭐ Yes' : '—';
			echo '</span>';
		}

		/* ================= Quick Edit ================= */

		public function quick_edit_field( $column_name, $post_type ) {

			if ( $column_name !== 'is_featured' || $post_type !== 'post' ) {
				return;
			}
			?>
			<fieldset class="inline-edit-col-right">
				<div class="inline-edit-col">
					<label class="alignleft">
						<input type="checkbox" name="bold_is_featured" value="yes">
						<span class="checkbox-title">Featured Post</span>
					</label>
				</div>
			</fieldset>
			<?php
		}

		public function enqueue_quick_edit_script( $hook ) {

			if ( $hook !== 'edit.php' ) {
				return;
			}

			wp_add_inline_script(
				'jquery-core',
				$this->quick_edit_js()
			);
		}

		private function quick_edit_js() {
			$js = "
				jQuery(function($){

					var wp_inline_edit = inlineEditPost.edit;

					inlineEditPost.edit = function( id ) {
						wp_inline_edit.apply( this, arguments );

						var post_id = 0;
						if ( typeof(id) === 'object' ) {
							post_id = parseInt( this.getId( id ) );
						}

						if ( post_id > 0 ) {
							var row = $('#post-' + post_id);
							var featured = row.find('.bold-featured-value').data('featured');

							var checkbox = $('.inline-edit-row input[name=\"bold_is_featured\"]');
							checkbox.prop( 'checked', featured === 'yes' );
						}
					};

				});
			";
			return $js;
		}
	}
}

new Bold_Post_Featured_Post();
