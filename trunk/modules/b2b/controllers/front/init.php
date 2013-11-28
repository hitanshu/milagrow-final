<?php

//define('_IS_SMS_SEND', true);
//define('_SMS_URL', 'http://admin.dove-sms.com/TransSMS/SMSAPI.jsp');
//define('_SMS_USERNAME', 'GreenApple1');
//define('_SMS_PASSWORD', 'GreenApple1');
//define('_SMS_SENDERID', 'MSNGRi');
//define('_B2B_SMS_MESSAGE', 'Please use code %s to validate your inquiry at Milagrow Bulk Purchase. Please ignore if you have received this message in error.');
class B2bInitModuleFrontController extends ModuleFrontController
{

    public function postProcess()
    {
        if (Tools::getValue('formName')) {
            $name = Tools::getValue('name');
            $companyName = Tools::getValue('companyName');
            $email = Tools::getValue('email');
            $mobile = Tools::getValue('mobile');
            $country = Tools::getValue('country');
            $pincode = Tools::getValue('pincode');
            $city = Tools::getValue('city');
            $stateSelect = Tools::getValue('stateselect');
            $stateText = Tools::getValue('statetext');
            $category = Tools::getValue('category');
            $product = Tools::getValue('product');
            if (empty($product))
                $product = 'No Specific Product Chosen';
            $quantity = Tools::getValue('quantity');
            $comment = Tools::getValue('comment');

            if (!empty($country) && $country == 'India') {
                if (empty($name) || empty($companyName) || empty($email) || empty($mobile) || empty($country) || empty($pincode) || empty($stateSelect) || empty($category) || empty($quantity)) {
                    echo json_encode(array('status' => false, 'message' => 'Please Fill the required fields'));
                    exit;
                }
            } else {
                if (empty($name) || empty($companyName) || empty($email) || empty($mobile) || empty($country) || empty($pincode) || empty($stateText) || empty($category) || empty($quantity)) {
                    echo json_encode(array('status' => false, 'message' => 'Please Fill the required fields'));
                    exit;
                }
            }

            $currentDate = new DateTime('now', new DateTimeZone('UTC'));
            $currentTime = $currentDate->format("Y-m-d H:i:s");
            $insertData = array('name' => $name, 'companyName' => $companyName, 'email' => $email, 'country' => $country, 'mobile' => $mobile, 'pincode' => $pincode, 'city' => $city, 'product' => $product, 'category'=>$this->getCategoryName($category),'quantity' => $quantity, 'comment' => $comment, 'created_at' => $currentTime, 'updated_at' => $currentTime);
            if (!empty($country) && $country == 'India') {
                $insertData['state'] = $stateSelect;
            } else {
                $insertData['state'] = $stateText;
            }
            Db::getInstance()->insert('b2b', $insertData
            );

            if (Db::getInstance()->Insert_ID()) {
//                $this->sendSMS($mobile, $mobileCode);
//                $last_insert_id = Db::getInstance()->Insert_ID();

                $adminVars = array(
                    '{name}' => $insertData['name'],
                    '{companyName}' => $insertData['companyName'],
                    '{email}' => $insertData['email'],
                    '{mobile}' => $insertData['mobile'],
                    '{country}' => $insertData['country'],
                    '{pincode}' => $insertData['pincode'],
                    '{city}' => $insertData['city'],
                    '{state}' => $insertData['state'],
                    '{product}' => $insertData['product'],
                    '{category}' => $insertData['category'],
                    '{quantity}' => $insertData['quantity'],
                    '{comment}' => $insertData['comment']
                );
                $adminEmail = 'sales@milagrow.in';
//                $adminEmail = Configuration::get('PS_SHOP_EMAIL');


                //sending mail to milagrow related to form details
                Mail::Send(
                    (int)1,
                    'b2b_admin_mail',
                    Mail::l('New Entry at - Bulk Purchase Form', (int)1),
                    $adminVars,
                    $adminEmail,
                    'admin',
                    null,
                    null,
                    null,
                    null,
                    getcwd() . _MODULE_DIR_ . 'b2b/',
                    false,
                    null
                );

                //sending mail to customer related to form details
                Mail::Send(
                    (int)1,
                    'b2b_mail',
                    Mail::l('Bulk Purchase Enquiry', (int)1),
                    $adminVars,
                    $insertData['email'],
                    $insertData['name'],
                    null,
                    null,
                    null,
                    null,
                    getcwd() . _MODULE_DIR_ . 'b2b/',
                    false,
                    null
                );
                $url = B2b::getShopDomainSsl(true, true);
                $url .= '/bulk-purchase-success';
                echo json_encode(array('status' => true, 'url' => $url));
            } else {
                echo json_encode(array('status' => false, 'message' => 'Sorry an error occured please try again..'));
            }
            exit;
        }
    }

    public function initContent()
    {

        parent::initContent();

        $this->b2b = new b2b();
        $this->context = Context::getContext();
        $this->id_module = (int)Tools::getValue('id_module');


        $this->context->smarty->assign(array(
            'form_action' => B2b::getShopDomainSsl(true, true) . '/index.php?fc=module&module=' . $this->b2b->name . '&controller=init',
            'categories' => $this->getCategories(),
            'states' => $this->getStates(),
            'jsSource' => $this->module->getPathUri() . 'b2b.js',
            'this_path' => $this->module->getPathUri()
        ));

        $this->setTemplate('b2b.tpl');
    }

    private function getCategories()
    {
        $sql = 'select * from ' . _DB_PREFIX_ . 'category_lang join ' . _DB_PREFIX_ . 'category on ' . _DB_PREFIX_ . 'category_lang.id_category=' . _DB_PREFIX_ . 'category.id_category where active=1 and ' . _DB_PREFIX_ . 'category.id_category in(6,10,85,86,87,4)';
        if ($results = Db::getInstance()->ExecuteS($sql))
            return $results;
        return array();
    }

    private function getStates()
    {
        return State::getStatesByIdCountry(110);
    }

    private function getCategoryName($categoryId)
    {
        $sql = 'select name from ' . _DB_PREFIX_ . 'category_lang where id_category='.$categoryId;
        if ($value = Db::getInstance()->getValue($sql))
            return $value;
        return 'No Category Chosen';
    }

}
