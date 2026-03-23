<?php

/*
 Plugin Name: Our Test Plugin
 Description: A truly amazing plugin.
 Version: 1.0
 Author: Cristian
 Author URI: https://sanchez-labs.com
*/

class WordCountAndTimePlugin
{
    function __construct()
    {
        add_action('admin_menu', [
            $this,
            'adminPage'
        ]);
        add_action('admin_init', [$this, 'settings']);
    }

    function settings()
    {
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');
        add_settings_field('wcp_location', 'Display Location', [$this, 'locationHTML'], 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_location', ['sanitize_callback' => 'sanitize_text_field', 'default' => '0']);
    }

    function locationHTML()
    { ?>
        Hello
    <?php }

    function adminPage()
    {
        add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', [$this, 'ourHTML']);
    }

    function ourHTML()
    { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
                <?php
                do_settings_sections('word-count-settings-page');
                submit_button();
                ?>
            </form>
        </div>
<?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();

?>