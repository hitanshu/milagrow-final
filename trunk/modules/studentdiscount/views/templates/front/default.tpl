{*
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
*}
<script type="text/javascript" src="{$jsSource}studentdiscount.js"></script>
<style>
    .std label {
        display: inherit;
    }
</style>
{capture name=path}{l s='Student Discount'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<div class="main">
    <div class="main-inner">
        <div class="row-fluid show-grid">
            {if $themesdev.td_siderbar_without=="enable"}
                <div class="col-left sidebar span3">
                    {$HOOK_LEFT_COLUMN}
                    {$themesdev.td_left_sidebar_customhtml|html_entity_decode}

                </div>
            {/if}

            <div class="span9">
                <div class="page-title">
                    <h1>{l s='Student Discount- upto Rs.1000 off on tabTop'}<sup>TM</sup> PCs</h1>
                </div>
                {if isset($confirmation)}
                    <p>{l s='Thank for applying to us. Our team will soon get in touch with you.'}</p>
                    <ul class="footer_links">
                        <li><a href="{$base_dir}"><img class="icon" alt="" src="{$img_dir}icon/home.gif"/></a><a
                                    href="{$base_dir}">{l s='Home'}</a></li>
                    </ul>
                {else}
                    {include file="$tpl_dir./errors.tpl"}
                    <form action="{$request_uri|escape:'htmlall':'UTF-8'}" method="post" class="std"
                          enctype="multipart/form-data">
                        <fieldset>
                            <p class="text">
                                <label for="name">{l s='Name*'}</label>
                                <input type="text" id="name" name="name"
                                       value="{if isset($name)}{$name|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text select">
                                <label for="interest">{l s='Interested In*'}</label>
                                <select name="interest" id="interest">
                                    <option value=""
                                            {if $interest eq ''}selected="selected"{/if}>{l s='-- Choose Product --'}</option>
                                    <option value="TabTop 7.16- 4GB"
                                            {if $interest eq 'TabTop 7.16- 4GB'}selected="selected"{/if}>{l s='TabTop 7.16- 4GB'}</option>
                                    <option value="TabTop 7.16- 8GB Pro"
                                            {if $interest eq 'TabTop 7.16- 8GB Pro'}selected="selected"{/if}>{l s='TabTop 7.16- 8GB Pro'}</option>
                                    <option value="TabTop 8.4- 16GB"
                                            {if $interest eq 'TabTop 8.4- 16GB'}selected="selected"{/if}>{l s='TabTop 8.4- 16GB'}</option>
                                    <option value="TabTop 10.4- 16GB"
                                            {if $interest eq 'TabTop 10.4- 16GB'}selected="selected"{/if}>{l s='TabTop 10.4- 16GB'}</option>
                                    <option value="TabTop M8 Pro 3G- 16 GB"
                                            {if $interest eq 'TabTop M8 Pro 3G- 16 GB'}selected="selected"{/if}>{l s='TabTop M8 Pro 3G- 16 GB'}</option>

                                </select>
                            </p>

                            <p class="text">
                                <label for="college">{l s='College*'}</label>
                                <input type="text" id="college" name="college"
                                       value="{if isset($college)}{$college|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="city">{l s='City*'}</label>
                                <input type="text" id="city" name="city"
                                       value="{if isset($city)}{$city|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="mobile">{l s='Mobile*'}</label>
                                <input type="text" id="mobile" name="mobile"
                                       value="{if isset($mobile)}{$mobile|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="email">{l s='Email address*'}</label>
                                {if isset($customerThread.email)}
                                    <input type="text" id="email" name="from"
                                           value="{$customerThread.email|escape:'htmlall':'UTF-8'}"
                                           readonly="readonly"/>
                                {else}
                                    <input type="text" id="email" name="from"
                                           value="{$email|escape:'htmlall':'UTF-8'}"/>
                                {/if}
                            </p>

                            <p class="text">
                                <label for="fileUpload">{l s='Attach College ID Proof* (jpeg,png,jpg,pdf,doc,docx,rtf)'}</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                                <input type="file" name="fileUpload" id="fileUpload"/>
                            </p>


                            <p class="submit">
                                <button type="submit" name="submitMessage" id="submitMessage" class="button"
                                        onclick="$(this).hide();"><span><span>{l s='Send'}</span></span></button>
                            </p>
                        </fieldset>
                    </form>
                {/if}
            </div>
        </div>
    </div>
</div>

