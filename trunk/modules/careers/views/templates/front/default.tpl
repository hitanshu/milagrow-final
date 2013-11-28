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
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/themes/base/jquery-ui.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="{$jsSource}careers.js"></script>
<style>
    .std label {
        display: inherit;
    }

    #dob {
        background: white;
        cursor: auto;
    }
</style>
{capture name=path}{l s='Careers'}{/capture}
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
                    <h1>{l s='Careers'}</h1>
                </div>
                {if isset($confirmation)}
                    <p>{l s='Thank you for considering milagrow as your employer of choice. Our HR department will get back you, In case we have an open vacancy suiting your profile and qualification we will get back to you. If we do not have an open vacancy currently your bio data would go
                        into our manpower bank and we will get back to you at an appropriate time.'}</p>
                    <ul class="footer_links">
                        <li><a href="{$base_dir}"><img class="icon" alt="" src="{$img_dir}icon/home.gif"/></a><a
                                    href="{$base_dir}">{l s='Home'}</a></li>
                    </ul>
                {else}
                    {include file="$tpl_dir./errors.tpl"}
                    <p>Milagrow is always in search for good people, for its various departments and functions. Kindly
                        fill in the form below and if we have open vacancy matching your experience and qualification we
                        will get back to you. If we do not have an open vacancy currently, your bio data would go
                        into our manpower bank and we will get back to you at an appropriate time.</p>
                    <form action="{$request_uri|escape:'htmlall':'UTF-8'}" method="post" class="std"
                          enctype="multipart/form-data">
                        <fieldset>
                            <p class="text">
                                <label for="name">{l s='Name*'}</label>
                                <input type="text" id="name" name="name"
                                       value="{if isset($name)}{$name|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="dob">{l s='Date Of Birth*'}</label>
                                <input type="text" id="dob" name="dob"
                                       readonly
                                       value="{if isset($dob)}{$dob|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>


                            <p class="textarea">
                                <label for="address">{l s='Address'}</label>
                                <textarea id="address" name="address" rows="5"
                                          cols="50">{if isset($address)}{$address|escape:'htmlall':'UTF-8'|stripslashes}{/if}</textarea>
                            </p>

                            <p class="text">
                                <label for="phone">{l s='Phone*'}</label>
                                <input type="text" id="phone" name="phone"
                                       value="{if isset($phone)}{$phone|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="email">{l s='Email Address*'}</label>
                                {if isset($customerThread.email)}
                                    <input type="text" id="email" name="from"
                                           value="{$customerThread.email|escape:'htmlall':'UTF-8'}"
                                           readonly="readonly"/>
                                {else}
                                    <input type="text" id="email" name="from"
                                           value="{$email|escape:'htmlall':'UTF-8'}"/>
                                {/if}
                            </p>

                            <p class="text select">
                                <label for="department">{l s='Department*'}</label>
                                <select name="department" id="department">
                                    <option value=""
                                            {if $department eq ''}selected="selected"{/if}>{l s='Select Department'}</option>
                                    <option value="Marketing & Sales"
                                            {if $department eq 'Marketing & Sales'}selected="selected"{/if}>{l s='Marketing & Sales'}</option>
                                    <option value="HR/Admin"
                                            {if $department eq 'HR/Admin'}selected="selected"{/if}>{l s='HR/Admin'}</option>
                                    <option value="Finance/Accounts"
                                            {if $department eq 'Finance/Accounts'}selected="selected"{/if}>{l s='Finance/Accounts'}</option>
                                    <option value="After Sales"
                                            {if $department eq 'After Sales'}selected="selected"{/if}>{l s='After Sales'}</option>
                                    <option value="Technical Service"
                                            {if $department eq 'Technical Service'}selected="selected"{/if}>{l s='Technical Service'}</option>
                                    <option value="Others"
                                            {if $department eq 'Others'}selected="selected"{/if}>{l s='Others'}</option>

                                </select>

                            </p>
                            <p class="text">
                                <label for="education">{l s='Education Qualification*'}</label>
                                <input type="text" id="education" name="education"
                                       value="{if isset($education)}{$education|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="professional">{l s='Professional Qualification*'}</label>
                                <input type="text" id="professional" name="professional"
                                       value="{if isset($professional)}{$professional|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="skill">{l s='Primary Skill'}</label>
                                <input type="text" id="skill" name="primarySkill"
                                       value="{if isset($primarySkill)}{$primarySkill|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>


                            <p class="textarea">
                                <label for="careerhighlights">{l s='Career Highlights*'}</label>
                                <textarea id="careerhighlights" name="careerhighlights" rows="5"
                                          cols="50">{if isset($careerhighlights)}{$careerhighlights|escape:'htmlall':'UTF-8'|stripslashes}{/if}</textarea>
                            </p>

                            <p class="text">
                                <label for="work">{l s='Work Experience'}</label>
                                <input type="text" id="work" name="workExperience"
                                       value="{if isset($workExperience)}{$workExperience|escape:'htmlall':'UTF-8'|stripslashes}{/if}"/>
                            </p>

                            <p class="text">
                                <label for="fileUpload">{l s='Attach Resume* (pdf,doc,docx,rtf)'}</label>
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

