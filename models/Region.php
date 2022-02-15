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

}