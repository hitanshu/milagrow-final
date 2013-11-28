








<?php

class SeniorDiscountDefaultModuleFrontController extends ModuleFrontController
{

    public function postProcess()
    {
        if (Tools::isSubmit('submitMessage')) {
            $fileAttachment = null;
            if (isset($_FILES['fileUpload']['name']) && !empty($_FILES['fileUpload']['name']) && !empty($_FILES['fileUpload']['tmp_name'])) {
                $extension = array('.rtf', '.doc', '.docx', '.pdf', '.jpeg', '.png', '.jpg');
                $filename = uniqid() . substr($_FILES['fileUpload']['name'], -5);
                $fileAttachment['content'] = file_get_contents($_FILES['fileUpload']['tmp_name']);
                $fileAttachment['name'] = $_FILES['fileUpload']['name'];
                $fileAttachment['mime'] = $_FILES['fileUpload']['type'];
            }
            if (!($name = trim(Tools::getValue('name'))))
                $this->errors[] = Tools::displayError('Name is Required');
            if (!($interest = trim(Tools::getValue('interest'))))
                $this->errors[] = Tools::displayError('Interested in is Required');
            if (!($city = trim(Tools::getValue('city'))))
                $this->errors[] = Tools::displayError('City is Required');
            if (!($mobile = trim(Tools::getValue('mobile'))))
                $this->errors[] = Tools::displayError('Mobile is Required');
            if (!($dob = trim(Tools::getValue('dob'))))
                $this->errors[] = Tools::displayError('DOB is Required');
            if (!($from = trim(Tools::getValue('from'))) || !Validate::isEmail($from))
                $this->errors[] = Tools::displayError('Invalid email address.');
            if (empty($_FILES['fileUpload']['name']))
                $this->errors[] = Tools::displayError('Please upload your id proof');
            if (!empty($_FILES['fileUpload']['name']) && $_FILES['fileUpload']['error'] != 0)
                $this->errors[] = Tools::displayError('An error occurred during the uploading process.');
            if (!empty($_FILES['fileUpload']['name']) && !in_array(substr(Tools::strtolower($_FILES['fileUpload']['name']), -4), $extension) && !in_array(substr(Tools::strtolower($_FILES['fileUpload']['name']), -5), $extension))
                $this->errors[] = Tools::displayError('Bad file extension');
            if (count($this->errors) == 0) {
                $currentDate = new DateTime('now', new DateTimeZone('UTC'));
                $currentTime = $currentDate->format("Y-m-d H:i:s");
                if (isset($filename) && rename($_FILES['fileUpload']['tmp_name'], _PS_MODULE_DIR_ . '../upload/seniorcitizendiscount/' . $filename))
                    $file_name = $filename;
                //updating entry to the database and sending mail to admin and customer
                $insertData = array('name' => $name, 'interest' => $interest, 'dob' => $dob, 'city' => $city, 'mobile' => $mobile, 'email' => $from, 'id_proof_file' => $file_name, 'created_at' => $currentTime);
                Db::getInstance()->insert('senior_discount', $insertData
                );

                if (Db::getInstance()->Insert_ID()) {
                    //sending mail to user
                    $userVarList = array('{name}' => $name, '{interest}' => $interest);
                    Mail::Send(
                        $this->context->language->id,
                        'senior_discount_form_customer',
                        Mail::l('Senior Citizen Discount Enquiry', (int)1),
                        $userVarList,
                        $from,
                        $name,
                        null,
                        null,
                        null,
                        null,
                        getcwd() . _MODULE_DIR_ . 'seniordiscount/',
                        false,
                        null
                    );
                    //sending mail to admin
                    $var_list = array('{name}' => $name,
                        '{interest}' => $interest,
                        '{dob}' => $dob,
                        '{city}' => $city,
                        '{mobile}' => $mobile,
                        '{email}' => $from,
                        '{id_proof_file}' => $file_name,
                        '{created_at}' => $currentTime);

                    if (isset($filename))
                        $var_list['{attached_file}'] = $_FILES['fileUpload']['name'];
                    Mail::Send(
                        $this->context->language->id,
                        'senior_discount_form',
                        Mail::l('New Entry At Senior Citizen Discount Form', (int)1),
                        $var_list,
                        Configuration::get('PS_SHOP_EMAIL'),
                        'Administrator',
                        $from,
                        $name,
                        $fileAttachment,
                        null,
                        getcwd() . _MODULE_DIR_ . 'seniordiscount/',
                        false,
                        null
                    );
                    $this->context->smarty->assign('confirmation', 1);
                } else
                    $this->errors[] = Tools::displayError('An error occurred while sending the message.');
            }
        }
    }

    public function initContent()
    {

        parent::initContent();

        $email = Tools::safeOutput(Tools::getValue('from',
            ((isset($this->context->cookie) && isset($this->context->cookie->email) && Validate::isEmail($this->context->cookie->email)) ? $this->context->cookie->email : '')));
        $this->context->smarty->assign(array(
            'errors' => $this->errors,
            'email' => $email,
            'action' => $this->context->link->getModuleLink('seniordiscount'),
            'jsSource' => $this->module->getPathUri()
        ));


        $this->context->smarty->assign(array(
            'name' => trim(Tools::getValue('name')),
            'interest' => trim(Tools::getValue('interest')),
            'city' => trim(Tools::getValue('city')),
            'dob' => trim(Tools::getValue('dob')),
            'mobile' => Tools::getValue('mobile'),
        ));

        $this->setTemplate('default.tpl');
    }


}
