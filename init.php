<?php

/*
 * Plugin Name : Doctors Info Slider
 *
 * @package DocInfoSlider
 * @author Sakib MD Nazmush
 * @copyright 2019 Sakib
 * @license GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Doctors Info Slider
 * Plugin URI: https://sakib.com/doctorsInfo
 * Description: A plugin with Doctors images and details like name, age, education, speciality and degree.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Sakib MD Nazmush
 * Author URI: https://sakib.com
 * Text Domain: doctors-info
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI: https://sakib.com/doctorsInfo/
 */

// defined('ASBPATH') or die('directory browsing is disabled');


// required files

// if (file_exists(dirname(__FILE__) . '/metabox/init.php')) {
//     require_once(dirname(__FILE__) . '/metabox/init.php');
// }
// if (file_exists(dirname(__FILE__) . '/metabox/metabox-config.php')) {
//     require_once(dirname(__FILE__) . '/metabox/metabox-config.php');
// }


class Doctor
{
    public function __construct()
    {
        // required files
        if (file_exists(dirname(__FILE__) . '/metabox/init.php')) {
            require_once(dirname(__FILE__) . '/metabox/init.php');
        }
        if (file_exists(dirname(__FILE__) . '/metabox/metabox-config.php')) {
            require_once(dirname(__FILE__) . '/metabox/metabox-config.php');
        }
        add_action('init', array($this, 'ss_doctors_info_slider'));
    }
    public function ss_doctors_info_slider()
    {
        $labels = array(
            'name' => _x('Doctors', 'Post type general name', 'doctors-info'),
            'singular_name' => _x('Doctor', 'Post type singular name', 'doctors-info'),
            'menu_name' => _x('Doctors', 'Doctor Menu text', 'doctors-info'),
            'name_admin_bar' => _x('Doctor', 'Add New on Toolbar', 'doctors-info'),
            'add_new' => __('Add New', 'doctors-info'),
            'add_new_item' => __('Add New Doctor', 'doctors-info'),
            'new_item' => __('New Doctor', 'doctors-info'),
            'edit_item' => __('Edit Info', 'doctors-info'),
            'view_item' => __('View Doctor', 'doctors-info'),
            'all_items' => __('All Doctors', 'doctors-info'),
            'search_items' => __('Search Doctors', 'doctors-info'),
            'parent_item_colon' => __('Parent Doctors:', 'doctors-info'),
            'not_found' => __('No Doctors found.', 'doctors-info'),
            'not_found_in_trash' => __('No Doctors found in Trash.', 'doctors-info'),
            'featured_image' => _x('Doctor Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'doctors-info'),
            'set_featured_image' => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'doctors-info'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'doctors-info'),
            'use_featured_image' => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'doctors-info'),
            'archives' => _x('Doctor archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'doctors-info'),
            'insert_into_item' => _x('Insert into Doctor', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'doctors-info'),
            'uploaded_to_this_item' => _x('Uploaded to this Doctor', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'doctors-info'),
            'filter_items_list' => _x('Filter Doctors list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'doctors-info'),
            'items_list_navigation' => _x('Doctors list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'doctors-info'),
            'items_list' => _x('Doctors list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'doctors-info'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'doctor'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon' => 'dashicons-buddicons-buddypress-logo',
            'supports' => array('title', 'thumbnail'),
        );

        register_post_type('doctors_info', $args);


        // Taxonomies

        $label = array(
            'name' => _x('Speciality', 'Speciality general name', 'doctors-info'),
            'singular_name' => _x('Speciality', 'Speciality singular name', 'doctors-info'),
            'search_items' => __('Search Speciality', 'doctors-info'),
            'popular_items' => __('Popular Speciality', 'doctors-info'),
            'all_items' => __('All Speciality', 'doctors-info'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Speciality', 'doctors-info'),
            'update_item' => __('Update Speciality', 'doctors-info'),
            'add_new_item' => __('Add New Speciality', 'doctors-info'),
            'new_item_name' => __('New Speciality Name', 'doctors-info'),
            'separate_items_with_commas' => __('Separate Speciality with commas', 'doctors-info'),
            'add_or_remove_items' => __('Add or remove Speciality', 'doctors-info'),
            'choose_from_most_used' => __('Choose from the most used Speciality', 'doctors-info'),
            'not_found' => __('No Speciality found.', 'doctors-info'),
            'menu_name' => __('Speciality', 'doctors-info'),
        );

        $arguments = array(
            'hierarchical' => true,
            'labels' => $label,
            'show_ui' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'Speciality'),
        );

        register_taxonomy('doctors-speciality', 'doctors_info', $arguments);
    }

    public function doctors_shortcode()
    {
        add_shortcode('doctors-info', array($this, 'doctors_info_output'));
    }

    public function doctors_info_output()
    {
        ob_start();

        $prefix = '__prefix__';

        $doctor_info = new WP_Query(
            array(
                'post_type' => 'doctors_info',
                'post_per_page' => -1
            )
        );
        while ($doctor_info->have_posts()):
            $doctor_info->the_post();
            ?>

            <div class="doctors-info-style">
                <div class="info-left">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                </div>
                <div class="info-right">
                    <div class="informations">
                        <ul>
                            <li>Name:
                                <span>
                                    <?php echo get_post_meta(get_the_id(), $prefix . 'doctors_name', true);
                                    ?>
                                </span>
                            </li>
                            <li>Speciality:
                                <span>
                                    <?php $specialities = get_the_terms(get_the_id(), 'doctors-speciality');

                                    foreach ($specialities as $speciality) {
                                        echo $speciality->name;
                                    }

                                    ?>
                                </span>
                            </li>
                            <li>Age:
                                <span>
                                    <?php echo get_post_meta(get_the_id(), $prefix . 'doctors_age', true); ?>
                                </span>
                            </li>
                            <li>Education:
                                <span>
                                    <?php echo get_post_meta(get_the_id(), $prefix . 'doctors_education', true); ?>
                                </span>
                            </li>
                            <li>Degree:
                                <span>
                                    <?php echo get_post_meta(get_the_id(), $prefix . 'doctors_degree', true); ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        <?php return ob_get_clean();

    }
}


$doctor = new Doctor();

$doctor->doctors_shortcode();

?>