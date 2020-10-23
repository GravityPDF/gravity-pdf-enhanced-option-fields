<?php

namespace GFPDF\Plugins\CoreBooster\FieldSelector\Options;

use GFPDF\Helper\Helper_Form;
use GFPDF\Plugins\CoreBooster\Shared\DoesTemplateHaveGroup;
use GFPDF\Helper\Helper_Interface_Filters;
use GFPDF\Helper\Helper_Trait_Logger;

/**
 * @package     Gravity PDF Core Booster
 * @copyright   Copyright (c) 2020, Blue Liquid Designs
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.1
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class FilterFields
 *
 * @package GFPDF\Plugins\CoreBooster\FieldSelector\Options
 */
class FilterFields implements Helper_Interface_Filters {

	/**
	 * @since 1.1
	 */
	use Helper_Trait_Logger;

	/**
	 * Initialise our module
	 *
	 * @since 1.1
	 */
	public function init() {
		$this->add_filters();
	}

	/**
	 * @since 1.1
	 */
	public function add_filters() {
		add_filter( 'gfpdf_current_pdf_configuration', [ $this, 'disable_excluded_fields' ], 10 );
		add_filter( 'gfpdf_field_middleware', [ $this, 'filter_fields' ], 20, 5 );
	}

	/**
	 * @param array $config
	 *
	 * @return array
	 *
	 * @since 1.1
	 */
	public function disable_excluded_fields( $config ) {
		if ( isset( $config['settings']['form_field_selector'] ) ) {
			$config['meta']['exclude'] = false;
		}

		return $config;
	}

	/**
	 * Filter out any fields not found in our Field Selector setting
	 *
	 * @param $filter
	 * @param $field
	 * @param $entry
	 * @param $form
	 * @param $config
	 *
	 * @return bool
	 *
	 * @since 1.1
	 */
	public function filter_fields( $filter, $field, $entry, $form, $config ) {
		/* Skip if not activated */
		if ( ! $this->is_field_selector_toggle_active( $config['settings'] ) ) {
			return $filter;
		}

		/* Check if the selector isn't activated, or if the field is included in the selector */
		if ( ! isset( $config['settings']['form_field_selector'] ) || in_array( (string) $field->id, (array) $config['settings']['form_field_selector'], true ) ) {
			return $filter;
		}

		/* Selector activated, filter out undefined fields */
		$this->logger->notice( 'Removing field %s from PDF display due to Form Field Selector option' );

		return true;
	}

	/**
	 * Checks if the PDF was setup before the Core Booster was installed, or if the checkbox / toggle is activated
	 *
	 * @param array $settings
	 *
	 * @return bool
	 *
	 * @since 1.3
	 */
	protected function is_field_selector_toggle_active( $settings ) {
		return ! isset( $settings['form_field_filter_fields'] ) || in_array( $settings['form_field_filter_fields'], [ 'Yes', '1' ], true );
	}
}
