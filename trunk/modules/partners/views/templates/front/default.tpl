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
{*<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/themes/base/jquery-ui.css" />*}
{*<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/jquery-ui.min.js"></script>*}
{*<script type="text/javascript" src="{$jsSource}partners.js"></script>*}
<style>
    .std label {
        display: inherit;
    }
    #dob {
        background: white;
        cursor: auto;
    }
</style>
{capture name=path}{l s='Partners'}{/capture}
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
                    <h1>{l s='Partner With Us'}</h1>
                </div>
                {if isset($confirmation)}
                    <p>{l s='Thank for applying to us. Our team will soon get in touch with you.'}</p>
                    <ul class="footer_links">
                        <li><a href="{$base_dir}"><img class="icon" alt="" src="{$img_dir}icon/home.gif"/></a><a
                                    href="{$base_dir}">{l s='Home'}</a></li>
                    </ul>
                {else}
                    {include file="$tpl_dir./errors.tpl"}
                    <p>Option 1: For any queries, complaints, suggestions you can call on 9910069920 or 0124-4309577.
                        Timings: 9:30 AM – 7:30 PM.</p>
                    <p>Option 2: Also feel free to write to <a href="mailto:sales@milagrow.in">sales@milagrow.in</a></p>
                    <p>You can also fill the form below and we will get back to you.</p>
                    <form action="{$request_uri|escape:'htmlall':'UTF-8'}" method="post" class="std"
                          enctype="multipart/form-data">
                        <fieldset>
                            <p class="text">
                                <label for="name">{l s='Name Of Company*'}</label>
                                <input type="text" id="name" name="name"
                                       value="{if isset($name)}{$name|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
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
                                <label for="phone">{l s='Contact Number*'}</label>
                                <input type="text" id="phone" name="phone"
                                       value="{if isset($phone)}{$phone|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text select">
                                <label for="product">{l s='Product*'}</label>
                                <select name="product" id="product">
                                    <option value="" {if $product eq ''}selected="selected"{/if}>{l s='-- Choose Product --'}</option>
                                    <option value="TabTops" {if $product eq 'TabTops'}selected="selected"{/if}>{l s='Tab Tops'}</option>
                                    <option value="Robots" {if $product eq 'Robots'}selected="selected"{/if}>{l s='Robots'}</option>
                                    <option value="TV Mounts" {if $product eq 'TV Mounts'}selected="selected"{/if}>{l s='TV Mounts'}</option>
                                    <option value="All" {if $product eq 'All'}selected="selected"{/if}>{l s='ALL'}</option>
                                </select>

                            </p>

                            <p class="text select">
                                <label for="state">{l s='State & UT.*'}</label>
                                <select name="state" id="state">
                                    <option value="">{l s='-- Choose State --'}</option>
                                    {foreach from=$states item=state}
                                        <option value="{$state.name}" {if $stateselected eq $state.name}selected="selected"{/if}>{$state.name|escape:'htmlall':'UTF-8'}</option>
                                    {/foreach}
                                </select>
                            </p>




                            <p class="text">
                                <label for="city">{l s='City*'}</label>
                                <input type="text" id="city" name="city"
                                       value="{if isset($city)}{$city|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text select">
                                <label for="purpose">{l s='Purpose'}</label>
                                <select name="purpose" id="purpose">
                                    <option value="" {if $purpose eq ''}selected="selected"{/if}>{l s='-- Choose purpose --'}</option>
                                    <option value="Dealer" {if $purpose eq 'Dealer'}selected="selected"{/if}>{l s='Dealer'}</option>
                                    <option value="Distributor" {if $purpose eq 'Distributor'}selected="selected"{/if}>{l s='Distributor'}</option>
                                    <option value="Service Center" {if $purpose eq 'Service Center'}selected="selected"{/if}>{l s='Service Center'}</option>
                                    <option value="Institutional Dealer" {if $purpose eq 'Institutional Dealer'}selected="selected"{/if}>{l s='Institutional Dealer'}</option>
                                    <option value="All" {if $purpose eq 'All'}selected="selected"{/if}>{l s='ALL'}</option>
                                </select>

                            </p>
                            <p class="text">
                                <label for="website">{l s='Your Website'}</label>
                                <input type="text" id="website" name="website"
                                       value="{if isset($website)}{$website|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="turnover">{l s='Current TurnOver'}</label>
                                <input type="text" id="turnover" name="turnover"
                                       value="{if isset($turnover)}{$turnover|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="textarea">
                                <label for="message">{l s='Message'}</label>
                                <textarea id="message" name="message" rows="5"
                                          cols="50">{if isset($message)}{$message|escape:'htmlall':'UTF-8'|stripslashes}{/if}</textarea>
                            </p>

                            <p class="text">
                                <label for="Captcha">{l s='Are you a human'} <strong>{$captchaText}</strong></label>

                                <input type="text" name="captcha" id="captch"/>
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

