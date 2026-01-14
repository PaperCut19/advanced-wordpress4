<?php
function university_post_types()
{
    // campus post type
    register_post_type("campus", [
        'capability_type' => 'campus',
        'map_meta_cap' => true,
        "supports" => ["title", "editor"],
        "rewrite" => [
            "slug" => "campuses",
        ],
        "has_archive" => true,
        "public" => true,
        "show_in_rest" => true,
        "labels" => [
            "name" => "Campuses",
            "add_new_item" => "Add New Campus",
            "edit_item" => "Edit Campus",
            "all_items" => "All Campuses",
            "singular_name" => "Campus",
        ],
        "menu_icon" => "dashicons-location-alt",
    ]);

    // event post type
    register_post_type("event", [
        'capability_type' => 'event',
        'map_meta_cap' => true,
        "supports" => ["title", "editor", "excerpt"],
        "rewrite" => [
            "slug" => "events",
        ],
        "has_archive" => true,
        "public" => true,
        "show_in_rest" => true,
        "labels" => [
            "name" => "Events",
            "add_new_item" => "Add New Event",
            "edit_item" => "Edit Event",
            "all_items" => "All Events",
            "singular_name" => "Event",
        ],
        "menu_icon" => "dashicons-calendar",
    ]);

    // program post type
    register_post_type("program", [
        "supports" => ["title"],
        "rewrite" => [
            "slug" => "programs",
        ],
        "has_archive" => true,
        "public" => true,
        "show_in_rest" => true,
        "labels" => [
            "name" => "Programs",
            "add_new_item" => "Add New Program",
            "edit_item" => "Edit Program",
            "all_items" => "All Programs",
            "singular_name" => "Program",
        ],
        "menu_icon" => "dashicons-awards",
    ]);

    // professor post type
    register_post_type("professor", [
        "supports" => ["title", "editor", "thumbnail"],
        "public" => true,
        "show_in_rest" => true,
        "labels" => [
            "name" => "Professors",
            "add_new_item" => "Add New Professor",
            "edit_item" => "Edit Professor",
            "all_items" => "All Professors",
            "singular_name" => "Professor",
        ],
        "menu_icon" => "dashicons-welcome-learn-more",
    ]);
}

add_action("init", "university_post_types");

/*
Code to rebuild wordpress permalink structure.
Useful after making a new custom post type.
COMMENT OUT THIS CODE AFTER YOU FINISH USING IT, this is because of performance reasons.

function rebuild_permalinks()
{
    flush_rewrite_rules();
}
add_action("init", "rebuild_permalinks");
*/
