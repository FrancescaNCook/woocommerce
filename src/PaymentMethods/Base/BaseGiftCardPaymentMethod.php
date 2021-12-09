<?php declare( strict_types=1 );

namespace MultiSafepay\WooCommerce\PaymentMethods\Base;

abstract class BaseGiftCardPaymentMethod extends BasePaymentMethod {

    /**
     * @return string
     */
    public function get_payment_method_type(): string {
        return 'redirect';
    }

    /**
     * @param WC_Order $order
     *
     * @return bool
     */
    public function can_refund_order( $order ) {
        return false;
    }

    /**
     * @return string
     */
    public function get_payment_method_description(): string {
        $method_description = sprintf(
        /* translators: %2$: The payment method title */
            __( 'Read more about <a href="%1$s" target="_blank">%2$s</a> on MultiSafepay\'s Documentation Center.', 'multisafepay' ),
            'https://docs.multisafepay.com/payment-methods/prepaid-cards/gift-cards/?utm_source=woocommerce&utm_medium=woocommerce-cms&utm_campaign=woocommerce-cms',
            $this->get_payment_method_title()
        );
        return $method_description;
    }

}
