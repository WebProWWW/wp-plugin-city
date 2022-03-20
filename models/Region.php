<?php
namespace plugins\city\models;

/**
 * @property int $id
 * @property int $code
 * @property string $name
 */
class Region {

	public $id;
	public $code;
	public $name;

	public function __construct($region=null) {
		if ($region !== null) {
			$this->id = $region->id;
			$this->code = $region->code;
			$this->name = $region->name;
		}
	}

	/**
	 * @param int $id
	 * @return Region
	 */
	public static function findById($id) {
		global $wpdb;
		$tale = $wpdb->prefix . 'region';
		$region = $wpdb->get_row("SELECT * FROM `$tale` WHERE id='$id'");
		return new Region($region);
	}

	/**
	 * @return Region[]
	 */
	public static function all() {
		$out = [];
		global $wpdb;
		// wp_cache_delete('wp_all_cities');
		$regions = wp_cache_get('wp_all_regions');
		if (false === $regions) {
			$table = $wpdb->prefix . 'region';
			$regions = $wpdb->get_results("SELECT * FROM `$table`");
			wp_cache_set('wp_all_regions', $regions);
		}
		if (is_array($regions)) {
			foreach ($regions as $region) {
				$out[] = new Region($region);
			}
		}
		return $out;
	}

	/**
	 * @return City[]
	 */
	public function cities() {
		$out = [];
		global $wpdb;
//		 wp_cache_delete('wp_all_region_cities_' . $this->id);
		$cities = wp_cache_get('wp_all_region_cities_' . $this->id);
		if (false === $cities) {
			$table = $wpdb->prefix . 'city';
			$cities = $wpdb->get_results("SELECT * FROM {$table} WHERE region_id={$this->id} ORDER BY name");
			wp_cache_set('wp_all_region_cities_' . $this->id, $cities);
		}
		if (is_array($cities)) {
			foreach ($cities as $city) {
				$out[] = new City($city);
			}
		}
		return $out;
	}

}