<link rel="stylesheet" media="all" type="text/css"
      href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
<link rel="stylesheet" media="all" type="text/css" href="/js/jquery/plugins/timepicker/jquery-ui-timepicker-addon.css"/>
<link rel="stylesheet" media="all" type="text/css" href="{$jsSource}demoregistration.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="{$jsSource}jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="{$jsSource}demoregistration.js"></script>


{capture name=path}{l s='Book a demo'}{/capture}
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
                    <h1>{l s='Request for Pre - Sales Home Demo for Robots'}</h1>
                </div>

                <form id="demo" action="{$request_uri|escape:'htmlall':'UTF-8'}" method="post" data-ajax="true"
                      novalidate="">
                    <p>
                        1.Please fill the form below to submit your request for Pre-Sales Home Demo only.
                    </p>

                    <p>
                        2.Demo charges will be Rs. 750/. The same shall be refunded if you buy a Milagrow Floor Cleaning
                        Robot.
                    </p>

                    <p>3.The customer care team will call you with in 24 hrs after the form submission to confirm the
                        date and time of demo.</p>

                    <p>4.The demo will be for half an hour only.</p>
                    <br/>
                    <ul class="form-list">
                        <li>

                            <label for="name" class="required"><em>*</em>Name</label>

                            <div class="input-box">
                                <input type="text" id="name" name="name"/>
                            </div>
                        </li>
                        <li>
                            <label for="email" class="required"><em>*</em>Email</label>

                            <div class="input-box">
                                <input type="email" id="email" name="email"/>
                            </div>
                        </li>
                        <li>
                            <label for="mobile" class="required"><em>*</em>Mobile</label>

                            <div class="input-box">
                                <input type="text" id="mobile" name="mobile"/>
                            </div>
                        </li>
                        <li>
                            <label for="product" class="required"><em>*</em>Select Product</label>

                            <div class="input-box">
                                <select name="product" id="product">
                                    <option value="" {if $selectedProduct eq ''}selected='selected'{/if}>Select
                                        Product
                                    </option>

                                    <OPTGROUP LABEL="Robotic Floor Cleaners">
                                        <option value="RedHawk"
                                                {if $selectedProduct eq 'RedHawk'}selected='selected'{/if}>RedHawk
                                        </option>
                                        <option value="SuperBot/RoboCop"
                                                {if $selectedProduct eq 'SuperBot/RoboCop'}selected='selected'{/if}>
                                            SuperBot/RoboCop
                                        </option>
                                    </OPTGROUP>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label for="city" class="required"><em>*</em>Select City</label>

                            <div class="input-box">
                                <select name="city" id="city">
                                    <option value="">Select City</option>
                                    <option value="Banglore">Bangalore</option>
                                    <option value="Chennai">Chennai</option>
                                    <option value="Delhi">Delhi NCR</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                </select>
                            </div>
                        </li>

                        <li>
                            <label for="address" class="required"><em>*</em>Address</label>

                            <div class="input-box">
                                <textarea id="address" name="address" style="width:36%"></textarea>
                            </div>
                        </li>

                        <li>
                            <label for="zip" class="required"><em>*</em>Zip Code</label>

                            <div class="input-box">
                                <input id="zip" type="text" name="zip"/>
                            </div>
                        </li>
                        <li>
                            <label for="dateTime" class="required"><em>*</em>Preferred Date and
                                Time</label>

                            <div class="input-box">
                                <input type="text" id="dateTime" name="dateTime"
                                       placeholder="" readonly/>
                            </div>
                        </li>


                        <li>
                            <label for="comments">Special Comments</label>

                            <div class="input-box">
                                <textarea name="special_comments" style="width:36%"></textarea>
                            </div>
                        </li>
                        <input type="hidden" name="demo" value="demo"/>

                        {*<li>*}
                        {*<label for="price" class="required"><em>*</em>Price</label>*}

                        {*<div class="input-box">*}
                        {*<input type="text" id="price" readonly="readonly" name="price"*}
                        {*value="{$price}"/>*}
                        {*</div>*}
                        {*</li>*}

                        <li>
                            <p class="required">*Required Fields</p>
                            <button type="submit" name="submit" class="button">
                                <span><span>Submit</span></span>
                            </button><span id="ajax-loader" style="display: none"><img
                                        src="{$this_path}loader.gif"
                                        alt="{l s='loader' mod='demoregistration'}"/></span>

                        </li>

                    </ul>
                </form>

            </div>
        </div>
    </div>
</div>
