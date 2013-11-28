<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class AttachmentControllerCore extends FrontController
{
    public function postProcess()
    {
        $a = new Attachment(Tools::getValue('id_attachment'), $this->context->language->id);
        if (!$a->id)
            Tools::redirect('index.php');
        if ($a->mime == 'application/pdf' || $a->mime == 'pdf') {
            // send output to a browser
            header('Content-Transfer-Encoding: binary');
            header('Content-Type: application/pdf');
            header('Content-Length: ' . filesize(_PS_DOWNLOAD_DIR_ . $a->file));
            readfile(_PS_DOWNLOAD_DIR_ . $a->file);
            exit;
        } else {
            header('Content-Transfer-Encoding: binary');
            header('Content-Type: ' . $a->mime);
            header('Content-Length: ' . filesize(_PS_DOWNLOAD_DIR_ . $a->file));
            header('Content-Disposition: attachment; filename="' . utf8_decode($a->file_name) . '"');
            readfile(_PS_DOWNLOAD_DIR_ . $a->file);
            exit;
        }

    }
}