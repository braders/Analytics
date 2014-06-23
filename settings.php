<div class="wrap">
	<h2>Analytics Settings</h2>
		<form method="post" action="options.php">
		<?php 
			settings_fields( 'analytics-options' ); 
			do_settings_sections( 'analytics-options', 'analytics-main' );
			submit_button(); 
		?>
		</form>
</div>