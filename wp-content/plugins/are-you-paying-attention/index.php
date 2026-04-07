<?php

/*
    Plugin Name: Are You Paying Attention Quiz
    Description: Give your readers a multiple choice question.
    Version: 1.0
    Author: Cristian Sanchez-Espinosa
    Author URI: https://sanchez-labs.com
*/

if (! defined('ABSPATH')) exit;

class AreYouPayingAttention
{
    function __construct()
    {
        add_action('init', [$this, 'adminAssets']);
    }

    function adminAssets()
    {
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', ['wp-blocks', 'wp-element']);
        register_block_type('ourplugin/are-you-paying-attention', [
            'editor_script' => 'ournewblocktype',
            'render_callback' => [$this, 'theHTML']
        ]);
    }

    function theHTML($attributes)
    {
        return '<h1>Today the sky is' . $attributes['skyColor'] . ' and the grass is ' . $attributes['grassColor'] . '!!!</h1>';
    }
}

$areYouPayingAttention = new AreYouPayingAttention();
