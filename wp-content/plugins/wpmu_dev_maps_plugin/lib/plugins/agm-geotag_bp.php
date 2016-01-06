<?php
/*
Plugin Name: Geotag my activities
Description: Allows your users to add location context to their BuddyPress activity updates.<br /><b>Requires BuddyPress.</b>
Plugin URI: http://premium.wpmudev.org/project/wordpress-google-maps-plugin
Version: 1.0
Author: Ve Bailovity (Incsub)
*/

class Agm_GwaUserPages {

	private $_data;
	private $_model;

	private function __construct () {
		$this->_data = new Agm_GwaModel;
		$this->_model = new AgmMapModel;
	}

	public static function serve () {
		$me = new Agm_GwaUserPages;
		$me->_add_hooks();
	}

	private function _add_hooks () {
		add_action('agm_google_maps-load_user_scripts', array($this, 'load_scripts'));
		/*

		add_shortcode('agm_gwp_geocoded_posts', array($this, 'all_geocoded_posts_map'));
		*/

		// Nearby activities argument
		add_filter('agm_google_map-shortcode-attributes_defaults', array($this, 'set_attribute_defaults'));
		add_filter('agm_google_map-shortcode-overrides_process', array($this, 'process_overrides'), 10, 2);
		add_filter('agm_google_maps-shortcode-create_tag', array($this, 'process_tag'), 10, 2);
		add_action('bp_activity_post_form_options', array($this, 'add_form_markup'));
	}

	function set_attribute_defaults ($args) {
		$args['nearby_activities'] = false;
		$args['activities_within'] = 1000;
		return $args;
	}

	function process_overrides ($overrides, $args) {
		$_yes = agm_positive_values();
		if (isset($args['nearby_activities'])) $overrides['nearby_activities'] = in_array($args['nearby_activities'], $_yes);
		if (isset($args['activities_within'])) $overrides['activities_within'] = (int)$args['activities_within'];
		return $overrides;
	}

	function process_tag ($map, $overrides) {
		if (empty($overrides['nearby_activities'])) return $map;
		$within = (int)$overrides['activities_within'] ? (int)$overrides['activities_within'] : 1000;
		$seen = $to_add = array();

		foreach ($map['markers'] as $marker) {
			$posts = $this->_data->find_nearby_posts($marker['position'][0], $marker['position'][1], $within);
			foreach ($posts as $post) {
				if (in_array($post->id, $seen)) continue; // Only add once
				$to_add[] = $this->_data->post_to_marker($post);
				$seen[] = $post->id;
			}
		}
		$map['markers'] = array_merge($to_add, $map['markers']); // Reverse the order, so not to skew map default centering
		return $map;
	}

	function add_form_markup () {
		echo '<div id="agm-gwp-location_root">' .
			'<label for="agm-address" id="">' .
				__('Address', 'agm_google_maps') .
				': <input type="text" class="widefat" name="agm-address" id="agm-address" value="" />' .
				'<input type="hidden" autocomplete="off" name="agm-latitude" id="agm-latitude" value="" />' .
				'<input type="hidden" autocomplete="off" name="agm-longitude" id="agm-longitude" value="" />' .
			'</label>' .
		'</div>';
	}

	function load_scripts () {
		wp_enqueue_script('gwa-user', AGM_PLUGIN_URL . '/js/gwa-user.js');
		if (bp_is_activity_component()) {
			add_thickbox();
		}
	}

}


class Agm_GwaModel {

	private $_data;
	private $_db;
	private $_bp;
	private $_model;

	public function __construct () {
		global $wpdb, $bp;
		$this->_db = $wpdb;
		$this->_bp = $bp;
		$this->_data = apply_filters('agm_google_maps-options-gbp', get_option('agm_google_maps'));
		$this->_model = new AgmMapModel;
	}

	public function post_to_marker ($post) {
		$body = '<p>' . $post->content . '</p>';
		$avatar = bp_core_fetch_avatar(array(
			'object' => 'user',
			'item_id' => $post->user_id,
			'width' => 32,
			'height' => 32,
			'html' => false,
		));
		return array(
			'title' => $post->action,
			'body' => $body,
			'icon' => $avatar,
			'position' => array (
				bp_activity_get_meta($post->id, '_agm_latitude', true),
				bp_activity_get_meta($post->id, '_agm_longitude', true),
			),
			'disposition' => 'activity_marker'
		);
	}

	public function find_nearby_posts ($lat, $lng, $distance) {
		list($min_lat, $max_lat, $min_lng, $max_lng) = $this->_model->find_bounding_coordinates($lat, $lng, $distance);
		$meta_table = $this->_bp->activity->table_name_meta;
		// Dude!
		$sql = "
SELECT DISTINCT activity_id
FROM (
	SELECT latitude, longitude, t1.activity_id FROM
	(SELECT activity_id, meta_value as longitude FROM {$meta_table} WHERE meta_key='_agm_longitude') as t1
	LEFT JOIN
	(SELECT activity_id, meta_value as latitude FROM {$meta_table} WHERE meta_key='_agm_latitude') as t2
	ON t1.activity_id=t2.activity_id
) as meta
WHERE
longitude+0.0 > {$min_lng}
AND longitude+0.0 < {$max_lng}
AND
latitude+0.0 > {$min_lat}
AND latitude+0.0 < {$max_lat}
";
		$post_ids = $this->_db->get_col($sql);
		if (!$post_ids) return array();
		$post_ids = join(',', $post_ids);
		$sql = "SELECT a.*, u.user_email, u.user_nicename, u.user_login, u.display_name " .
			"FROM {$this->_bp->activity->table_name} a LEFT JOIN {$this->_db->users} u ON a.user_id = u.ID " .
			"WHERE a.id IN ({$post_ids})"
		;
		return $this->_db->get_results($sql);
	}

	function process_activity_update ($content, $user_id, $activity_id) {
		$address = !empty($_POST['agm-address']) ? wp_strip_all_tags($_POST['agm-address']) : false;
		$lat = !empty($_POST['agm-latitude']) ? (float)$_POST['agm-latitude'] : false;
		$lng = !empty($_POST['agm-longitude']) ? (float)$_POST['agm-longitude'] : false;

		if ($lat && $lng) return $this->_update_activity_geotag($activity_id, $lat, $lng);

		if (!$address) return false;
		$result = $this->_model->geocode_address($address);
		return $this->_update_activity_geotag(
			$activity_id,
			$result->geometry->location->lat,
			$result->geometry->location->lng
		);
	}

	function process_group_activity_update ($content, $user_id, $group_id, $activity_id) {
		return $this->process_activity_update($content, $user_id, $activity_id);
	}

	private function _update_activity_geotag ($activity_id, $lat, $lng) {
		bp_activity_update_meta($activity_id, '_agm_latitude', $lat);
		bp_activity_update_meta($activity_id, '_agm_longitude', $lng);
	}
}

function _agm_gwa_init () {
	$data = new Agm_GwaModel;
	add_action('bp_activity_posted_update', array($data, 'process_activity_update'), 10, 3);
	add_action('bp_groups_posted_update', array($data, 'process_group_activity_update'), 10, 4);
}
add_action('bp_init', '_agm_gwa_init');

if (!is_admin()) Agm_GwaUserPages::serve();