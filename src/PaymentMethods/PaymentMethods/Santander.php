<?php declare(strict_types=1);

namespace MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods;

use MultiSafepay\Api\Transactions\OrderRequest\Arguments\GatewayInfoInterface;
use MultiSafepay\WooCommerce\PaymentMethods\Base\BasePaymentMethod;

class Santander extends BasePaymentMethod {

    /**
     * @return string
     */
    public function get_payment_method_id(): string {
        return 'multisafepay_santander';
    }

    /**
     * @return string
     */
    public function get_payment_method_code(): string {
        return 'SANTANDER';
    }

    /**
     * @return string
     */
    public function get_payment_method_type(): string {
        return ( $this->get_option( 'direct', 'yes' ) === 'yes' ) ? 'direct' : 'redirect';
    }

    /**
     * @return string
     */
    public function get_payment_method_title(): string {
        return __( 'Santander Consumer Finance | Pay per month', 'multisafepay' );
    }

    /**
     * @return string
     */
    public function get_payment_method_description(): string {
        $method_description = sprintf(
            /* translators: %2$: The payment method title */
            __( 'Allows customers to pay for online purchases as a one-off post-payment or in monthly installments. <br />Read more about <a href="%1$s" target="_blank">%2$s</a> on MultiSafepay\'s Documentation Center.', 'multisafepay' ),
            'https://docs.multisafepay.com/payment-methods/billing-suite/betaalplan/?utm_source=woocommerce&utm_medium=woocommerce-cms&utm_campaign=woocommerce-cms',
            $this->get_payment_method_title()
        );
        return $method_description;
    }

    /**
     * @return boolean
     */
    public function has_fields(): bool {
        return ( $this->get_option( 'direct', 'yes' ) === 'yes' ) ? true : false;
    }

    /**
     * @return array
     */
    public function add_form_fields(): array {
        $form_fields                          = parent::add_form_fields();
        $form_fields['min_amount']['default'] = '250';
        $form_fields['max_amount']['default'] = '8000';
        $form_fields['direct']                = array(
            'title'    => __( 'Transaction Type', 'multisafepay' ),
            /* translators: %1$: The payment method title */
            'label'    => sprintf( __( 'Enable direct %1$s', 'multisafepay' ), $this->get_payment_method_title() ),
            'type'     => 'checkbox',
            'default'  => 'yes',
            'desc_tip' => __( 'If enabled, additional information can be entered during WooCommerce checkout. If disabled, additional information will be requested on the MultiSafepay payment page.', 'multisafepay' ),
        );
        return $form_fields;
    }

    /**
     * @return array
     */
    public function get_checkout_fields_ids(): array {
        return array( 'gender', 'birthday', 'bank_account' );
    }

    /**
     * @return string
     */
    public function get_payment_method_icon(): string {
        return 'betaalplan.png';
    }

    /**
     * @param array|null $data
     *
     * @return GatewayInfoInterface
     */
    public function get_gateway_info( array $data = null ): GatewayInfoInterface {
        return $this->get_gateway_info_meta( $data );
    }

}
