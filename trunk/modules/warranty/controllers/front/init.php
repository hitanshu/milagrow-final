<?php

class WarrantyInitModuleFrontController extends ModuleFrontController
{
    public $display_column_left = true;


    public function postProcess()
    {

        if (Tools::getValue('product')) {

            $name = Tools::getValue('name');
            $email = Tools::getValue('email');
            $mobile = Tools::getValue('mobile');
            $city = Tools::getValue('city');
            $city = empty($city) ? '-' : $city;
            $state = Tools::getValue('state');
            $state = empty($state) ? '-' : $state;
            $productId = Tools::getValue('product');
            $date = Tools::getValue('date');
            $storeName = Tools::getValue('storeName');
            $address = Tools::getValue('address');
            $address = empty($address) ? '-' : $address;
            $productNumber = Tools::getValue('productNumber');


            if (empty($name) || empty($email) || empty($mobile) || empty($productId) ||
                empty($date) || empty($storeName) || empty($productNumber)
            ) {
                echo json_encode(array('status' => false, 'message' => 'Please Fill the required fields'));
                exit;
            }
            $productName = $this->getProductName($productId);
            $currentDate = new DateTime('now', new DateTimeZone('UTC'));
            $currentTime = $currentDate->format("Y-m-d H:i:s");
            $insertData = array('name' => $name, 'email' => $email, 'mobile' => $mobile,
                'city' => $city, 'state' => $state, 'product' => $productId, 'date' => $date, 'store_name' => $storeName,
                'product_number' => $productNumber, 'address' => $address, 'created_at' => $currentTime, 'updated_at' => $currentTime);
            //Mail if data inserted
            if (Db::getInstance()->insert('product_registration', $insertData)) {
                $customerEmailResult = $this->sendMailToCustomer($name, $email, array('{name}' => $name, '{product}' => $productName));
                $adminEmailResult = $this->sendMailToAdmin('Administrator', Configuration::get('PS_SHOP_EMAIL'), array('{name}' => $name, '{email}' => $email,
                    '{mobile}' => $mobile, '{city}' => $city, '{state}' => $state, '{product}' => $productName,
                    '{date}' => date("d-m-Y", strtotime($date)), '{storeName}' => $storeName, '{productNumber}' => $productNumber, '{address}' => $address));
                $url = Warranty::getShopDomainSsl(true, true);
                $url .= '/product-warranty-registration-success';
                echo json_encode(array('status' => true, 'url' => $url));
            } else {
                echo json_encode(array('status' => false, 'message' => 'Sorry an error occurred please try again..'));
            }
            exit;
        }
    }

    public function initContent()
    {
        parent::initContent();

        $products = $this->getProducts();
        $this->context->smarty->assign(array('products' => $products,
            'form_action' => Warranty::getShopDomainSsl(true, true) . '/index.php?fc=module&module=' . Warranty::MODULE_NAME . '&controller=init',
            'jsSource' => $this->module->getPathUri(),
            'states' => $this->getStates(),
            'this_path' => $this->module->getPathUri()));

        $this->setTemplate('warranty1.tpl');

    }

    private function getProducts()
    {
        $sql = "SELECT " . _DB_PREFIX_ . "product.id_product as id, " . _DB_PREFIX_ . "product_lang.name as name
                FROM " . _DB_PREFIX_ . "product JOIN " . _DB_PREFIX_ . "product_lang
                ON " . _DB_PREFIX_ . "product.id_product=" . _DB_PREFIX_ . "product_lang.id_product where " . _DB_PREFIX_ . "product.active=1;";
        if ($results = Db::getInstance()->ExecuteS($sql))
            return $results;
        return array();
    }


    private function sendMailToCustomer($customerName, $customerEmailId, $vars)
    {
        try {
            $res = Mail::Send(
                (int)1,
                'warranty_mail',
                Mail::l('Product Registration', (int)1),
                $vars,
                $customerEmailId,
                null,
                strval(Configuration::get('PS_SHOP_EMAIL')),
                strval(Configuration::get('PS_SHOP_NAME')),
                null,
                null,
                getcwd() . _MODULE_DIR_ . 'warranty/',
                false,
                null
            );

        } catch (Exception $e) {
            return false;
        }
        return $res;
    }


    private function sendMailToAdmin($adminName, $adminEmailId, $vars)
    {
        try {
            $res = Mail::Send(
                (int)1,
                'warranty_admin_mail',
                Mail::l('New Product Registration', (int)1),
                $vars,
                $adminEmailId,
                $adminName,
                strval(Configuration::get('PS_SHOP_EMAIL')),
                strval(Configuration::get('PS_SHOP_NAME')),
                null,
                null,
                getcwd() . _MODULE_DIR_ . 'warranty/',
                false,
                null
            );

        } catch (Exception $e) {
            return false;
        }
        return $res;
    }

    private function getProductName($productId)
    {
        $sql = "SELECT name from " . _DB_PREFIX_ . "product_lang where id_product=" . $productId;
        if ($results = Db::getInstance()->getRow($sql))
            return $results['name'];
        return "OTHER";
    }

    private function getStates()
    {
        return State::getStatesByIdCountry(110);
    }

}