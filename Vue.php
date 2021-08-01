<?php

class Vue
{
	function __construct()
	{
		add_shortcode('subscribe_form', [$this, 'form']);
		add_action('wp_enqueue_scripts', [$this, 'add_styles']);
		add_action('wp_enqueue_scripts', [$this, 'add_scripts']);
	}
	public function add_styles()
	{
		wp_enqueue_style('subscribe', SUBSCRIBE_URL . '/assets/css/main.css', [], SUBSCRIBE_VERSION);
	}
	public function add_scripts()
	{
		wp_enqueue_script('subscribe', SUBSCRIBE_URL . '/assets/js/main.js', [], SUBSCRIBE_VERSION, true);
		wp_localize_script(
			'subscribe',
			'subscribe',
			[
				'adminUrl' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce(SaveBD::SUBSCRIBE_NONCE_ACTION),
			]
		);
	}
	public function form()
	{
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