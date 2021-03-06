<?php

namespace GFPDF\Tests\EnhancedOptions;

use GFPDF\Plugins\CoreBooster\EnhancedOptions\Fields\AllCheckbox;
use WP_UnitTestCase;

/**
 * @package     Gravity PDF Core Booster
 * @copyright   Copyright (c) 2020, Blue Liquid Designs
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class TestAllCheckbox
 *
 * @package GFPDF\Tests\EnhancedOptions
 *
 * @group   options
 */
class TestAllCheckbox extends WP_UnitTestCase {

	/**
	 * @var AllCheckbox
	 * @since 1.0
	 */
	private $class;

	/**
	 * @since 1.0
	 */
	public function setUp() {
		$checkbox          = new \GF_Field_Checkbox();
		$checkbox->id      = 1;
		$checkbox->choices = [
			[
				'text'  => 'Option 1',
				'value' => 'Option 1 Value',
			],

			[
				'text'  => 'Option 2',
				'value' => 'Option 2 Value',
			],

			[
				'text'  => 'Option 3',
				'value' => 'Option 3 Value',
			],

			[
				'text'  => 'Option 4',
				'value' => 'Option 4 Value',
			],
		];

		$checkbox->inputs = [
			[
				'id'    => '1.1',
				'label' => 'Option 1',
			],

			[
				'id'    => '1.2',
				'label' => 'Option 2',
			],

			[
				'id'    => '1.3',
				'label' => 'Option 3',
			],

			[
				'id'    => '1.4',
				'label' => 'Option 4',
			],
		];

		$id = \GFAPI::add_form( [ 'title' => 'Form', 'fields' => [] ] );

		$this->class = new AllCheckbox( $checkbox, [
			'form_id' => $id,
			'id'      => 1,
			'1.2'     => 'Option 2 Value',
			'1.4'     => 'Option 4 Value',
		], \GPDFAPI::get_form_class(), \GPDFAPI::get_misc_class() );
	}

	/**
	 * @since 1.0
	 */
	public function tearDown() {
		remove_all_filters( 'gfpdf_show_field_value' );
	}

	/**
	 * @since 1.0
	 */
	public function test_html() {
		$results = $this->class->html();

		/* Check all fields get rendered with an unchecked box */
		$this->assertNotFalse( strpos( $results, "&#9744;</span> Option 1" ) );
		$this->assertNotFalse( strpos( $results, "&#9746;</span> Option 2" ) );
		$this->assertNotFalse( strpos( $results, "&#9744;</span> Option 3" ) );
		$this->assertNotFalse( strpos( $results, "&#9746;</span> Option 4" ) );

		/* Show all values */
		add_filter( 'gfpdf_show_field_value', '__return_true' );

		$results = $this->class->html();

		$this->assertNotFalse( strpos( $results, "&#9744;</span> Option 1 Value" ) );
		$this->assertNotFalse( strpos( $results, "&#9746;</span> Option 2 Value" ) );
		$this->assertNotFalse( strpos( $results, "&#9744;</span> Option 3 Value" ) );
		$this->assertNotFalse( strpos( $results, "&#9746;</span> Option 4 Value" ) );
	}
}
