<?php
namespace plugins\city\models;

use stdClass;

/**
 * @property int $id
 * @property string $alias
 * @property string $name
 */
class City {

	public $id;
	public $alias;
	public $name;
	public $region_id;
	public $isConfirmed = true;

	public function __construct($city=null) {
		if ($city !== null) {
			$this->id = $city->id;
			$this->alias = $city->alias;
			$this->name = $city->name;
			$this->region_id = $city->region_id;
		}
	}

	/**
	 * @return City
	 */
	public static function findDomainCity() {
		global $wpdb;
		$tale = $wpdb->prefix . 'city';
		$alias = self::subDomainName();
		$city = new stdClass();
		$city->id = null;
		$city->region_id = null;
		$city->name = '';
		$city->alias = $alias;
		if ($alias !== 'index') {
			$city = $wpdb->get_row("SELECT * FROM `$tale` WHERE alias='$alias'");
		}
		return new City($city);
	}

	public function url() {
		$http = is_ssl() ? 'https://' : 'http://';
		if ($this->alias === 'index') {
			return $http . City::rootDomain();
		}
		return $http . $this->alias . '.' . City::rootDomain();
	}

	public static function subDomainName() {
		$domain = $_SERVER['HTTP_HOST'];
		$domainArr = explode('.', $domain);
		if (count($domainArr) === 4) {
			return $domainArr[0];
		}
		return 'index';
	}

	/**
	 * @return string
	 */
	public static function rootDomain() {
		$domain = $_SERVER['HTTP_HOST'];
		$domainArr = explode('.', $domain);
		if (count($domainArr) === 4) {
			$serch =  $domainArr[0] . '.';
			$domain = str_replace($serch, '', $domain);
		}
		return $domain;
	}

	/**
	 * @return City[]
	 */
	public function all() {
		$out = [];
		global $wpdb;
		// wp_cache_delete('wp_all_cities');
		$cities = wp_cache_get('wp_all_cities');
		if (false === $cities) {
			$table = $wpdb->prefix . 'city';
			$cities = $wpdb->get_results("SELECT * FROM `$table`");
			wp_cache_set('wp_all_cities', $cities);
		}
		if (is_array($cities)) {
			foreach ($cities as $city) {
				$out[] = new City($city);
			}
		}
		return $out;
	}

	private $_region;
	/**
	 * @return Region
	 */
	public function region() {
		if ($this->_region === null) {
			$this->_region = Region::findById($this->region_id);
		}
		return $this->_region;
	}

}