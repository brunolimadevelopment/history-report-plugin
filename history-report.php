<?php
/**
 * Plugin Name:     History Report
 * Plugin URI:      https://github.com/brunolimadevelopment/history-report-plugin
 * Description:     Prints a log history report on the terminal.
 * Author:          Bruno Lima
 * Author URI:      https://www.linkedin.com/in/bruno-lima-b6a034177/
 * Text Domain:     history-report
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         History_Report
 */


if (!class_exists('WP_CLI')) {
    return;
}

class Click_Tracker_CLI_Command {
    /**
     * Run in terminal
     * wp click-tracker report
     */
    public function report($args, $assoc_args) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'click_tracker';

        $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY click_time DESC LIMIT 10");

        if ($results) {
            foreach ($results as $result) {
                WP_CLI::line("ID: {$result->id}, Data e Hora: {$result->click_time}");
            }
        } else {
            WP_CLI::line('Nenhum registro encontrado.');
        }
    }
}

WP_CLI::add_command('click-tracker', 'Click_Tracker_CLI_Command');
