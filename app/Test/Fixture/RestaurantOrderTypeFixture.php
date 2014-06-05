<?php
/**
 * RestaurantOrderTypeFixture
 *
 */
class RestaurantOrderTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'restaurant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'order_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'long' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 35),
		'lat' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 35),
		'radius' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 20),
		'delivery_min' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2'),
		'delivery_charge' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2'),
		'upsell' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'restaurant_id' => array('column' => 'restaurant_id', 'unique' => 0),
			'order_type_id' => array('column' => 'order_type_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'restaurant_id' => 1,
			'order_type_id' => 1,
			'long' => 1,
			'lat' => 1,
			'radius' => 1,
			'delivery_min' => 1,
			'delivery_charge' => 1,
			'upsell' => 1,
			'created' => '2013-03-14 22:45:48',
			'modified' => '2013-03-14 22:45:48'
		),
	);

}
