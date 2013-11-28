<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

/**
 * @since 1.5.0
 */
require("libFunctions.php");
class EMIValidationModuleFrontController extends ModuleFrontController
{
    public $ssl = true;

//	public function postProcess()
//	{
//		if ($this->context->cart->id_customer == 0 || $this->context->cart->id_address_delivery == 0 || $this->context->cart->id_address_invoice == 0 || !$this->module->active)
//			Tools::redirectLink(__PS_BASE_URI__.'order.php?step=1');
//
//		// Check that this payment option is still available in case the customer changed his address just before the end of the checkout process
//		$authorized = false;
//		foreach (Module::getPaymentModules() as $module)
//			if ($module['name'] == 'emi')
//			{
//				$authorized = true;
//				break;
//			}
//		if (!$authorized)
//			die(Tools::displayError('This payment method is not available.'));
//
//		$customer = new Customer($this->context->cart->id_customer);
//		if (!Validate::isLoadedObject($customer))
//			Tools::redirectLink(__PS_BASE_URI__.'order.php?step=1');
//
//		if (Tools::getValue('confirm'))
//		{
//			$customer = new Customer((int)$this->context->cart->id_customer);
//			$total = $this->context->cart->getOrderTotal(true, Cart::BOTH);
//			$this->module->validateOrder((int)$this->context->cart->id, Configuration::get('PS_OS_PREPARATION'), $total, $this->module->displayName, null, array(), null, false, $customer->secure_key);
//			Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key.'&id_cart='.(int)$this->context->cart->id.'&id_module='.(int)$this->module->id.'&id_order='.(int)$this->module->currentOrder);
//		}
//	}

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();


        $threemonthstaxperAnnum = Configuration::get('EMI_CCAVENUE_3_MONTHS_TAX');
        $threeMonthsTax = ($threemonthstaxperAnnum / 12) * 3;
        $sixmonthstaxperAnnum = Configuration::get('EMI_CCAVENUE_6_MONTHS_TAX');
        $sixMonthsTax = ($sixmonthstaxperAnnum / 12) * 6;
        $serviceTax = 12.36;
        $orderTotal = $this->context->cart->getOrderTotal(true, Cart::BOTH);
        $Redirect_Url = Tools::getShopDomainSsl(true, true) . '/index.php?fc=module&module=emi&controller=paymentnotification'; //your redirect URL where your customer will be redirected after authorisation from CCAvenue

        //making details for 3 months EMI
        $merchantid3month = Configuration::get('_MERCHANT_ID_EMI_CCAVENUE_3');
        $Order_Id = 'ccAvenue_' . (int)$this->context->cart->id;
        $threeMonthsEMIProcessingFees = ($orderTotal * $threeMonthsTax) / 100;
        $serviceTax3Months = ($threeMonthsEMIProcessingFees * $serviceTax) / 100;
        $totalThreeMonthsAmount = $threeMonthsEMIProcessingFees + $serviceTax3Months + $orderTotal;
        $ThreeMonthsWorkingKey = Configuration::updateValue('WORKING_KEY_EMI_3_MONTHS'); //put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key login to your
        $threemonthsChecksum = getChecksum($merchantid3month, $Order_Id, round($totalThreeMonthsAmount, 1), $Redirect_Url, $ThreeMonthsWorkingKey);

        //end details to be send to 3 months EMI screen

        //start making details for 6 months EMI screen
        $merchantid6month = Configuration::get('_MERCHANT_ID_EMI_CCAVENUE_6');
        $Order_Id = 'ccAvenue_' . (int)$this->context->cart->id;
        $sixMonthsEMIProcessingFees = ($orderTotal * $sixMonthsTax) / 100;
        $serviceTax6Months = ($sixMonthsEMIProcessingFees * $serviceTax) / 100;
        $totalSixMonthsAmount = $sixMonthsEMIProcessingFees + $serviceTax6Months + $orderTotal;
        $sixMonthsWorkingKey = Configuration::updateValue('WORKING_KEY_EMI_6_MONTHS'); //put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key login to your
        $sixmonthsChecksum = getChecksum($merchantid6month, $Order_Id, round($totalSixMonthsAmount, 1), $Redirect_Url, $sixMonthsWorkingKey);
        //end details to be send to 6 months EMI Screen

        $billing = new Address($this->context->cart->id_address_invoice);
        $billing_state = $billing->id_state ? new State($billing->id_state) : false;

        $delivery = new Address($this->context->cart->id_address_delivery);
        $delivery_state = $delivery->id_state ? new State($delivery->id_state) : false;

        //assigning data for 3 months EMI Option
        $this->context->smarty->assign(array(
            'ccAvenue_merchant_id_3' => $merchantid3month,
            'ccAvenue_checksum_3' => $threemonthsChecksum,
            'ccAvenue_order_id' => $Order_Id,
            'ccAvenue_amount_3' => round($totalThreeMonthsAmount, 0),
            'ccAvenue_redirect_link' => $Redirect_Url,
            'billing_cust_name' => $billing->firstname . '' . $billing->lastname,
            'billing_cust_address' => $billing->address1 . '' . $billing->address2,
            'billing_cust_country' => $billing->country,
            'billing_cust_state' => $billing->id_state ? $billing_state->name : '',
            'billing_city' => $billing->city,
            'billing_zip' => $billing->postcode,
            'billing_cust_tel' => ($billing->phone) ? $billing->phone : $billing->phone_mobile,
            'billing_cust_email' => $this->context->customer->email,
            'merchant_param_3' => '3_months',
            'processing_fee_3' => round($threeMonthsEMIProcessingFees, 1),
            'emi_3_processing_fee_tax' => $threeMonthsTax,
            'serviceTax3Months' => round($serviceTax3Months, 1),
            'emi3Amount' => round(($totalThreeMonthsAmount / 3)),
            'delivery_cust_name' => $delivery->firstname . '' . $delivery->lastname,
            'delivery_cust_address' => $delivery->address1 . '' . $delivery->address2,
            'delivery_cust_country' => $delivery->country,
            'delivery_cust_state' => $delivery->id_state ? $delivery_state->name : '',
            'delivery_city' => $delivery->city,
            'delivery_zip' => $delivery->postcode,
            'delivery_cust_tel' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
            'delivery_cust_email' => $this->context->customer->email,


        ));

        //assigning data for 6 months EMI Option

        $this->context->smarty->assign(array(
            'ccAvenue_merchant_id_6' => $merchantid6month,
            'ccAvenue_checksum_6' => $sixmonthsChecksum,
            'ccAvenue_amount_6' => $totalSixMonthsAmount,
            'merchant_param_6' => '6_months',
            'processing_fee_6' => round($sixMonthsEMIProcessingFees, 1),
            'emi_6_processing_fee_tax' => $sixMonthsTax,
            'serviceTax6Months' => round($serviceTax6Months, 1),
            'emi6Amount' => round(($totalSixMonthsAmount / 6), 1)
        ));

        $this->context->smarty->assign(array(
            'total' => $this->context->cart->getOrderTotal(true, Cart::BOTH),
            'this_path' => $this->module->getPathUri(),
            'this_path_ssl' => Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . 'modules/emi/'
        ));

        $this->setTemplate('validation.tpl');
    }


}