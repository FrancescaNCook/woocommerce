<?php declare( strict_types=1 );

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

namespace MultiSafepay\WooCommerce\PaymentMethods;

use MultiSafepay\Api\Transactions\OrderRequest\Arguments\GatewayInfoInterface;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Babycadeaubon;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Beautywellness;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Boekenbon;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Fashioncheque;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Fashiongiftcard;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Fietsenbon;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Gezondheidsbon;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Givacard;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Good4fun;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Goodcard;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Nationaletuinbon;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Parfumcadeaukaart;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Podium;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Sportenfit;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Vvvcadeaukaart;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Webshopgiftcard;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Wellnessgiftcard;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Wijncadeau;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Winkelcheque;
use MultiSafepay\WooCommerce\PaymentMethods\Giftcards\Yourgift;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Afterpay;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Alipay;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Amex;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\ApplePay;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Bancontact;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\BankTrans;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Belfius;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Cbc;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\CreditCard;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Dbrtp;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Dirdeb;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Dotpay;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Einvoicing;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Eps;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Giropay;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Ideal;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\IdealQr;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\In3;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\IngHomePay;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Kbc;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Klarna;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Maestro;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\MasterCard;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\MultiSafepay;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\PayAfterDelivery;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\PayPal;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Paysafecard;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Santander;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Sofort;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Trustly;
use MultiSafepay\WooCommerce\PaymentMethods\PaymentMethods\Visa;

/**
 * Define the Gateways.
 *
 * @since   4.0.0
 */
class Gateways {

    const GATEWAYS = array(
        'multisafepay_multisafepay'      => MultiSafepay::class,
        'multisafepay_afterpay'          => Afterpay::class,
        'multisafepay_alipay'            => Alipay::class,
        'multisafepay_amex'              => Amex::class,
        'multisafepay_applepay'          => ApplePay::class,
        'multisafepay_bancontact'        => Bancontact::class,
        'multisafepay_banktrans'         => BankTrans::class,
        'multisafepay_belfius'           => Belfius::class,
        'multisafepay_cbc'               => Cbc::class,
        'multisafepay_creditcard'        => CreditCard::class,
        'multisafepay_dbrtp'             => Dbrtp::class,
        'multisafepay_dirdeb'            => Dirdeb::class,
        'multisafepay_dotpay'            => Dotpay::class,
        'multisafepay_einvoice'          => Einvoicing::class,
        'multisafepay_eps'               => Eps::class,
        'multisafepay_giropay'           => Giropay::class,
        'multisafepay_ideal'             => Ideal::class,
        'multisafepay_idealqr'           => IdealQr::class,
        'multisafepay_in3'               => In3::class,
        'multisafepay_inghome'           => IngHomePay::class,
        'multisafepay_kbc'               => Kbc::class,
        'multisafepay_klarna'            => Klarna::class,
        'multisafepay_maestro'           => Maestro::class,
        'multisafepay_mastercard'        => MasterCard::class,
        'multisafepay_payafter'          => PayAfterDelivery::class,
        'multisafepay_paypal'            => PayPal::class,
        'multisafepay_paysafecard'       => Paysafecard::class,
        'multisafepay_santander'         => Santander::class,
        'multisafepay_directbank'        => Sofort::class,
        'multisafepay_trustly'           => Trustly::class,
        'multisafepay_visa'              => Visa::class,

        'multisafepay_babycadeaubon'     => Babycadeaubon::class,
        'multisafepay_beautywellness'    => Beautywellness::class,
        'multisafepay_boekenbon'         => Boekenbon::class,
        'multisafepay_fashioncheque'     => Fashioncheque::class,
        'multisafepay_fashiongiftcard'   => Fashiongiftcard::class,
        'multisafepay_fietsenbon'        => Fietsenbon::class,
        'multisafepay_gezondheidsbon'    => Gezondheidsbon::class,
        'multisafepay_givacard'          => Givacard::class,
        'multisafepay_good4fun'          => Good4fun::class,
        'multisafepay_good4card'         => Goodcard::class,
        'multisafepay_nationaletuinbon'  => Nationaletuinbon::class,
        'multisafepay_parfumcadeaukaart' => Parfumcadeaukaart::class,
        'multisafepay_podium'            => Podium::class,
        'multisafepay_sportenfit'        => Sportenfit::class,
        'multisafepay_vvvcadeaukaart'    => Vvvcadeaukaart::class,
        'multisafepay_webshopgiftcard'   => Webshopgiftcard::class,
        'multisafepay_wellnessgiftcard'  => Wellnessgiftcard::class,
        'multisafepay_wijncadeau'        => Wijncadeau::class,
        'multisafepay_winkelcheque'      => Winkelcheque::class,
        'multisafepay_yourgift'          => Yourgift::class,
    );

    const GATEWAYS_WITH_SHOPPING_CART = array(
        'AFTERPAY',
        'KLARNA',
        'EINVOICE',
        'PAYAFTER',
        'IN3',
    );

    /**
     * Return an array with all MultiSafepay gateways ids
     *
     * @return array
     */
    public static function get_gateways_ids(): array {
        $gateways_ids = array();
        foreach ( self::GATEWAYS as $gateway_id => $gateway ) {
            $gateways_ids[] = $gateway_id;
        }

        return $gateways_ids;
    }

    /**
     * Return the payment method code needed by WooCommerce
     *
     * @param string $code
     *
     * @return mixed string|false
     */
    public static function get_payment_method_id_by_gateway_code( string $code ) {
        foreach ( self::GATEWAYS as $gateway ) {
            $gateway = new $gateway();
            if ( $gateway->get_payment_method_code() === $code ) {
                return $gateway->get_payment_method_id();
            }
        }
        return false;
    }

    /**
     * Return the payment method title needed by WooCommerce
     *
     * @param string $code
     *
     * @return mixed string|false
     */
    public static function get_payment_method_name_by_gateway_code( string $code ) {
        foreach ( self::GATEWAYS as $gateway ) {
            $gateway = new $gateway();
            if ( $gateway->get_payment_method_code() === $code ) {
                return $gateway->get_payment_method_title();
            }
        }
        return false;
    }

    /**
     * Return the gateway code for the given gateway_id
     *
     * @param string $gateway_id
     *
     * @return string
     */
    public static function get_gateway_code_by_gateway_id( string $gateway_id ): string {
        $gateway = self::GATEWAYS[ $gateway_id ];

        return ( new $gateway() )->get_payment_method_code();
    }

    /**
     * Return the gateway info for the given gateway_id
     *
     * @param string $gateway_id
     * @return GatewayInfoInterface
     */
    public static function get_gateway_info_by_gateway_id( string $gateway_id ): GatewayInfoInterface {
        $gateway = self::GATEWAYS[ $gateway_id ];
        return ( new $gateway() )->get_gateway_info();
    }

}
