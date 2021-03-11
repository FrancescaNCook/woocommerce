<?php declare(strict_types=1);

/**
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the MultiSafepay plugin
 * to newer versions in the future. If you wish to customize the plugin for your
 * needs please document your changes and make backups before you update.
 *
 * @category    MultiSafepay
 * @package     Connect
 * @author      TechSupport <integration@multisafepay.com>
 * @copyright   Copyright (c) MultiSafepay, Inc. (https://www.multisafepay.com)
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace MultiSafepay\WooCommerce\Settings;

use MultiSafepay\WooCommerce\Services\SdkService;

/**
 * The settings fields.
 *
 * Defines all the settings fields properties
 *
 * @since   4.0.0
 */
class SettingsFields {

    /**
     * The ID of this plugin.
     *
     * @var      string
     */
    private $plugin_name;

    /**
     * Constructor the the class
     *
     * @param   string $plugin_name
     */
    public function __construct( string $plugin_name ) {
        $this->plugin_name = $plugin_name;
    }

    /**
     * Return the settings fields
     *
     * @return  array
     */
    public function get_settings(): array {
        $settings                 = array();
        $settings['general']      = $this->get_settings_general();
        $settings['options']      = $this->get_settings_options();
        $settings['order_status'] = $this->get_settings_order_status();
        $settings                 = apply_filters( 'multisafepay_common_settings_fields', $settings );
        return $settings;
    }

    /**
     * Return the settings fields for general section
     *
     * @return  array
     */
    private function get_settings_general(): array {
        return array(
            'title'  => '',
            'intro'  => '',
            'fields' => array(
                array(
                    'id'           => $this->plugin_name . '_testmode',
                    'label'        => __( 'Test Mode', 'multisafepay' ),
                    'description'  => '',
                    'type'         => 'checkbox',
                    'default'      => false,
                    'placeholder'  => __( 'Test Mode', 'multisafepay' ),
                    'tooltip'      => __( 'Check this option if you want to enable MultiSafepay in test mode.', 'multisafepay' ),
                    'callback'     => '',
                    'setting_type' => 'boolean',
                    'sort_order'   => 1,
                ),
                array(
                    'id'           => $this->plugin_name . '_test_api_key',
                    'label'        => __( 'Test API Key', 'multisafepay' ),
                    'description'  => '',
                    'type'         => 'text',
                    'default'      => '',
                    'placeholder'  => '',
                    'tooltip'      => __( 'Test API Key', 'multisafepay' ),
                    'callback'     => '',
                    'setting_type' => 'string',
                    'sort_order'   => 2,
                ),
                array(
                    'id'           => $this->plugin_name . '_api_key',
                    'label'        => __( 'API Key', 'multisafepay' ),
                    'description'  => '',
                    'type'         => 'text',
                    'default'      => '',
                    'placeholder'  => __( 'API Key ', 'multisafepay' ),
                    'tooltip'      => __( 'API Key', 'multisafepay' ),
                    'callback'     => '',
                    'setting_type' => 'string',
                    'sort_order'   => 3,
                ),
            ),
        );
    }

    /**
     * Return the settings fields for options section
     *
     * @return  array
     */
    private function get_settings_options(): array {
        return array(
            'title'  => '',
            'intro'  => '',
            'fields' => array(
                array(
                    'id'           => $this->plugin_name . '_debugmode',
                    'label'        => __( 'Debug Mode', 'multisafepay' ),
                    'description'  => '',
                    'type'         => 'checkbox',
                    'default'      => false,
                    'placeholder'  => __( 'Debug Mode', 'multisafepay' ),
                    'tooltip'      => __( 'Logs additional information to the system log', 'multisafepay' ),
                    'callback'     => '',
                    'setting_type' => 'boolean',
                    'sort_order'   => 1,
                ),
                array(
                    'id'           => $this->plugin_name . '_order_request_description',
                    'label'        => __( 'Order Description', 'multisafepay' ),
                    'description'  => __( 'A text which will be shown with the order in MultiSafepay Control. If the customer’s bank supports it this description will also be shown on the customer’s bank statement', 'multisafepay' ),
                    'type'         => 'text',
                    'default'      => 'Payment for order: {order_number}',
                    'placeholder'  => __( 'Order Description.', 'multisafepay' ),
                    'tooltip'      => __( 'You can include the order number using {order_number}', 'multisafepay' ),
                    'callback'     => '',
                    'setting_type' => 'string',
                    'sort_order'   => 2,
                ),
                array(
                    'id'           => $this->plugin_name . '_ga',
                    'label'        => __( 'Google Analytics', 'multisafepay' ),
                    'description'  => __( 'Google Analytics Universal Account ID. Format: UA-XXXXXXXXX', 'multisafepay' ),
                    'type'         => 'text',
                    'default'      => '',
                    'placeholder'  => __( 'Google Analytics', 'multisafepay' ),
                    'tooltip'      => '',
                    'callback'     => '',
                    'setting_type' => 'string',
                    'sort_order'   => 3,
                ),
                array(
                    'id'           => $this->plugin_name . '_trigger_transaction_to_invoiced',
                    'label'        => __( 'Set transaction as invoiced', 'multisafepay' ),
                    'description'  => __( 'When the order reaches this status, we send the invoice id to MultiSafepay', 'multisafepay' ),
                    'type'         => 'select',
                    'options'      => array(
                        'wc-processing' => __( 'Processing', 'multisafepay' ),
                        'wc-completed'  => __( 'Completed', 'multisafepay' ),
                    ),
                    'default'      => 'wc-completed',
                    'placeholder'  => __( 'Set transaction as invoiced', 'multisafepay' ),
                    'tooltip'      => 'The invoice id will be added to financial reports and exports generated within MultiSafepay Control',
                    'callback'     => '',
                    'setting_type' => 'string',
                    'sort_order'   => 4,
                ),
                array(
                    'id'           => $this->plugin_name . '_trigger_transaction_to_shipped',
                    'label'        => __( 'Set transaction as shipped', 'multisafepay' ),
                    'description'  => __( 'When the order reaches this status, a notification will be sent to MultiSafepay to set the transaction status as shipped', 'multisafepay' ),
                    'type'         => 'select',
                    'options'      => array(
                        'wc-processing' => __( 'Processing', 'multisafepay' ),
                        'wc-completed'  => __( 'Completed', 'multisafepay' ),
                    ),
                    'default'      => 'wc-completed',
                    'placeholder'  => __( 'Set transaction as shipped', 'multisafepay' ),
                    'tooltip'      => '',
                    'callback'     => '',
                    'setting_type' => 'string',
                    'sort_order'   => 5,
                ),
                array(
                    'id'           => $this->plugin_name . '_time_active',
                    'label'        => __( 'Value lifetime of payment link', 'multisafepay' ),
                    'description'  => '',
                    'type'         => 'text',
                    'default'      => '30',
                    'placeholder'  => __( 'Value lifetime of payment link', 'multisafepay' ),
                    'tooltip'      => '',
                    'callback'     => '',
                    'setting_type' => 'int',
                    'sort_order'   => 6,
                ),
                array(
                    'id'           => $this->plugin_name . '_time_unit',
                    'label'        => __( 'Unit lifetime of payment link', 'multisafepay' ),
                    'description'  => __( 'The lifetime of a payment link by default is 30 days. This means that the customer has 30 days to complete the transaction using the payment link', 'multisafepay' ),
                    'type'         => 'select',
                    'options'      => array(
                        'days'    => __( 'Days', 'multisafepay' ),
                        'hours'   => __( 'Hours', 'multisafepay' ),
                        'seconds' => __( 'Seconds', 'multisafepay' ),
                    ),
                    'default'      => 'days',
                    'placeholder'  => __( 'Unit lifetime of payment link', 'multisafepay' ),
                    'tooltip'      => '',
                    'callback'     => '',
                    'setting_type' => 'string',
                    'sort_order'   => 7,
                ),
                array(
                    'id'           => $this->plugin_name . '_second_chance',
                    'label'        => __( 'Second Chance', 'multisafepay' ),
                    'description'  => __( 'More information about Second Chance on <a href="https://docs.multisafepay.com/tools/second-chance/?utm_source=woocommerce&utm_medium=woocommerce-cms&utm_campaign=woocommerce-cms" target="_blank">MultiSafepay\'s Documentation Center</a>.', 'multisafepay' ),
                    'type'         => 'checkbox',
                    'default'      => false,
                    'placeholder'  => __( 'Second Chance', 'multisafepay' ),
                    'tooltip'      => __( 'MultiSafepay will send two Second Chance reminder emails. In the emails, MultiSafepay will include a link to allow the consumer to finalize the payment. The first Second Chance email is sent 1 hour after the transaction was initiated and the second after 24 hours. To receive second chance emails, this option must also be activated within your MultiSafepay account, otherwise it will not work.', 'multisafepay' ),
                    'callback'     => '',
                    'setting_type' => 'boolean',
                    'sort_order'   => 8,
                ),
                array(
                    'id'           => $this->plugin_name . '_tokenization',
                    'label'        => __( 'Tokenization', 'multisafepay' ),
                    'placeholder'  => __( 'Tokenization', 'multisafepay' ),
                    'description'  => __( 'More information about Tokenization on <a href="https://docs.multisafepay.com/tools/tokenization/?utm_source=woocommerce&utm_medium=woocommerce-cms&utm_campaign=woocommerce-cms" target="_blank">MultiSafepay\'s Documentation Center</a>.', 'multisafepay' ),
                    'type'         => 'checkbox',
                    'default'      => false,
                    'tooltip'      => '',
                    'callback'     => '',
                    'setting_type' => 'boolean',
                    'sort_order'   => 9,
                ),
                array(
                    'id'           => $this->plugin_name . '_remove_all_settings',
                    'label'        => __( 'Delete settings if uninstall', 'multisafepay' ),
                    'description'  => '',
                    'type'         => 'checkbox',
                    'default'      => false,
                    'placeholder'  => __( 'Delete settings if uninstall', 'multisafepay' ),
                    'tooltip'      => __( 'Delete all settings of this plugin if you uninstall', 'multisafepay' ),
                    'callback'     => '',
                    'setting_type' => 'boolean',
                    'sort_order'   => 10,
                ),
            ),
        );
    }

    /**
     * Return the settings fields for order status section
     *
     * @return  array
     */
    private function get_settings_order_status(): array {
        $wc_order_statuses = $this->get_wc_get_order_statuses();

        // Complete status is manage by $order->complete_payment() in the notification;
        // but still is important get a default value for this in case is required somewhere else as a fallback.
        $multisafepay_order_statuses = $this->get_multisafepay_order_statuses();
        unset( $multisafepay_order_statuses['completed_status'] );

        $order_status_fields = array();
        $sort_order          = 1;
        foreach ( $multisafepay_order_statuses as $key => $multisafepay_order_status ) {
            $order_status_fields[] = array(
                'id'           => $this->plugin_name . '_' . $key,
                'label'        => $multisafepay_order_status['label'],
                'description'  => '',
                'type'         => 'select',
                'options'      => $wc_order_statuses,
                'default'      => $multisafepay_order_status['default'],
                'placeholder'  => __( 'Select order status', 'multisafepay' ),
                'tooltip'      => '',
                'callback'     => '',
                'setting_type' => 'string',
                'sort_order'   => $sort_order,
            );
            $sort_order++;
        }

        return array(
            'title'  => '',
            'intro'  => '',
            'fields' => $order_status_fields,
        );
    }


    /**
     * Returns the WooCommerce registered order statuses
     *
     * @see     http://hookr.io/functions/wc_get_order_statuses/
     *
     * @return  array
     */
    private function get_wc_get_order_statuses(): array {
        $order_statuses = wc_get_order_statuses();
        return $order_statuses;
    }

    /**
     * Returns the MultiSafepay order statused to create settings fields
     * and match them with WooCommerce order statuses
     *
     * @return  array
     */
    public static function get_multisafepay_order_statuses(): array {
        return array(
            'initialized_status' => array(
				'label'   => __( 'Initialized', 'multisafepay' ),
				'default' => 'wc-pending',
			),
            'completed_status'   => array(
				'label'   => __( 'Completed', 'multisafepay' ),
				'default' => 'wc-processing',
			),
            'uncleared_status'   => array(
				'label'   => __( 'Uncleared', 'multisafepay' ),
				'default' => 'wc-on-hold',
			),
            'reserved_status'    => array(
				'label'   => __( 'Reserved', 'multisafepay' ),
				'default' => 'wc-on-hold',
			),
            'void_status'        => array(
				'label'   => __( 'Void', 'multisafepay' ),
				'default' => 'wc-cancelled',
			),
            'declined_status'    => array(
				'label'   => __( 'Declined', 'multisafepay' ),
				'default' => 'wc-failed',
			),
            'expired_status'     => array(
				'label'   => __( 'Expired', 'multisafepay' ),
				'default' => 'wc-cancelled',
			),
            'shipped_status'     => array(
				'label'   => __( 'Shipped', 'multisafepay' ),
				'default' => 'wc-completed',
			),
            'refunded_status'    => array(
				'label'   => __( 'Refunded', 'multisafepay' ),
				'default' => 'wc-refunded',
			),
            'cancelled_status'   => array(
				'label'   => __( 'Cancelled', 'multisafepay' ),
				'default' => 'wc-cancelled',
			),
            'chargedback_status' => array(
                'label'   => __( 'Chargedback', 'multisafepay' ),
                'default' => 'wc-on-hold',
            ),
        );
    }

}
