<?php

abstract class SaveBD
{

	protected function save_subscriber($email)
	{

		global $wpdb;

		return $wpdb->replace(
			Table::get_table_name(),
			[
				'email' => sanitize_email($email),
			],
			[
				'email' => '%s',
			]
		);
	}

}