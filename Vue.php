<?php

class Vue
{
	public function hooks()
	{
		add_shortcode('subscribe_form', [$this, 'form']);
		add_action('wp_enqueue_scripts', [$this, 'register_styles']);
		add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
	}
	public function register_styles()
	{
		wp_register_style(
			'subscribe',
			SUBSCRIBE_URL . '/assets/css/main.css',
			[],
			SUBSCRIBE_VERSION
		);
	}
	public function register_scripts()
	{
		wp_register_script(
			'subscribe',
			SUBSCRIBE_URL . '/assets/js/main.js',
			[],
			SUBSCRIBE_VERSION,
			true
		);
		wp_localize_script(
			'subscribe',
			'subscribe',
			[
				'adminUrl' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce(Ajax::SUBSCRIBE_NONCE_ACTION),
			]
		);
	}
	public function form()
	{
		wp_enqueue_style('subscribe');
		wp_enqueue_script('subscribe');
		ob_start();
?>
		<form action="" method="POST" class="subscribe-form">
			<div class="subscribe-form-row">
				<input type="email" name="email" class="subscribe-form-field" required>
				<button type="submit" class="subscribe-form-button"><?php echo esc_html('Subscribe', 'subscribe'); ?></button>
			</div>
			<div class="subscribe-form-message" style="display: none"></div>
		</form>
<?php
		return ob_get_clean();
	}
};

$vue = new Vue();
$vue->hooks();
