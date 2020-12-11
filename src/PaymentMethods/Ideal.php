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
 *
 */

namespace MultiSafepay\WooCommerce\PaymentMethods;

use MultiSafepay\Api\Transactions\OrderRequest\Arguments\GatewayInfo\Ideal as IdealGatewayInfo;
use MultiSafepay\Api\Transactions\OrderRequest\Arguments\GatewayInfoInterface;
use MultiSafepay\WooCommerce\Services\IssuerService;

class Ideal extends BasePaymentMethod {

    /**
     * @return string
     */
    public function get_payment_method_id(): string {
        return 'multisafepay_ideal';
    }

    /**
     * @return string
     */
    public function get_payment_method_code(): string {
        return 'IDEAL';
    }

    /**
     * @return string
     */
    public function get_payment_method_type(): string {
        return 'direct';
    }

    /**
     * @return string
     */
    public function get_payment_method_title(): string {
        return __('iDEAL', 'multisafepay');
    }

    /**
     * @return string
     */
    public function get_payment_method_description(): string {
        $method_description = sprintf(
            __('The leading ecommerce payment method in the Netherlands connecting all major Dutch banks. <br />Read more about <a href="%s" target="_blank">%s</a> on MultiSafepay\'s Documentation Center.', 'multisafepay'),
            'https://docs.multisafepay.com/payment-methods/banks/ideal/?utm_source=woocommerce&utm_medium=woocommerce-cms&utm_campaign=woocommerce-cms',
            $this->get_payment_method_title()
        );
        return $method_description;
    }

    /**
     * @return boolean
     */
    public function has_fields(): bool {
        return true;
    }

    /**
     * @return array
     */
    public function get_checkout_fields_ids(): array {
        return array( 'ideal_issuers' );
    }

    /**
     * @return string
     */
    public function get_payment_method_icon(): string {
        return 'ideal.png';
    }

    /**
     * Prints checkout custom fields
     *
     * @return  void
     */
    public function payment_fields(): void
    {
        $issuerService = new IssuerService();
        $issuers = $issuerService->get_issuers($this->get_payment_method_code());

        require($this->plugin_dir_path . 'templates/multisafepay-checkout-fields-display.php');
    }

    /**
     * @param array|null $data
     * @return IdealGatewayInfo
     */
    public function get_gateway_info(array $data = null): GatewayInfoInterface {
        $gatewayInfo = new IdealGatewayInfo();

        if (isset($_POST[ $this->id . '_issuer_id'])) {
            $gatewayInfo->addIssuerId($_POST[ $this->id . '_issuer_id']);
        }

        return $gatewayInfo;
    }

    /**
     * Check if issuer_id has been set
     *
     * @param GatewayInfoInterface $gatewayInfo
     * @return boolean
     */
    public function validate_gateway_info(GatewayInfoInterface $gatewayInfo): bool
    {
        $data = $gatewayInfo->getData();

        if (empty($data[ 'issuer_id' ])) {
            $this->type = 'redirect';
            return false;
        }

        return true;
    }

}