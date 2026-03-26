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
        add_filter('the_content', [$this, 'ifWrap']);
    }

    function ifWrap($content)
    {
        if (is_main_query() and is_single() and (get_option('wcp_wordcount', '1') or get_option('wcp_charactercount', '1') or get_option('wcp_readtime', '1'))) {
            return $this->createHTML($content);
        }

        return $content;
    }

    function createHTML($content)
    {
        return $content . 'hello';
    }

    function settings()
    {
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

        //wcp_location
        add_settings_field('wcp_location', 'Display Location', [$this, 'locationHTML'], 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_location', ['sanitize_callback' => [$this, 'sanitizeLocation'], 'default' => '0']);

        //wcp_headline
        add_settings_field('wcp_headline', 'Headline Text', [$this, 'headlineHTML'], 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_headline', ['sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics']);

        //wcp_wordcount
        add_settings_field('wcp_wordcount', 'Word Count', [$this, 'checkboxHTML'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_wordcount']);
        register_setting('wordcountplugin', 'wcp_wordcount', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);

        //wcp_charactercount
        add_settings_field('wcp_charactercount', 'Character Count', [$this, 'checkboxHTML'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_charactercount']);
        register_setting('wordcountplugin', 'wcp_charactercount', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);

        //wcp_readtime
        add_settings_field('wcp_readtime', 'Read Time', [$this, 'checkboxHTML'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_readtime']);
        register_setting('wordcountplugin', 'wcp_readtime', ['sanitize_callback' => 'sanitize_text_field', 'default' => '1']);
    }

    /*
    function wordcountHTML()
    { ?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1') ?>>
    <?php }
    */

    function sanitizeLocation($input)
    {
        if ($input != 0 and $input != '1') {
            add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end.');
            return get_option('wcp_location');
        }

        return $input;
    }

    function checkboxHTML($args)
    { ?>
        <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
    <?php }

    function headlineHTML()
    { ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')) ?>">
    <?php }

    function locationHTML()
    { ?>
        <select name="wcp_location">
            <option value="0" <?php selected(get_option('wcp_location'), '0'); ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location'), '1'); ?>>End of post</option>
        </select>
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
                settings_fields('wordcountplugin');
                do_settings_sections('word-count-settings-page');
                submit_button();
                ?>
            </form>
        </div>
<?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();

?>