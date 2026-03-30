<?php

/*
    Plugin Name: Our Word Filter Plugin
    Description: Replaces a list of words.
    Version 1.0
    Author: Cristian Sanchez-Espinosa
    Author URI: https://sanchez-labs.com
*/

if (! defined('ABSPATH')) exit; // Exit if accessed directly

class OurWordFilterPlugin
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'ourMenu']);
    }

    function ourMenu()
    {
        add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'ourwordfilter', [$this, 'wordFilterPage'], 'dashicons-smiley', 100);
        add_submenu_page('ourwordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);
    }

    function wordfilterpage()
    { ?>
        Hello world.
    <?php }

    function optionsSubPage()
    { ?>
        Hello world.
<?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();
