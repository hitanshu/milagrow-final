{capture name=path}{l s='Book a Demo'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}
<div class="main">
    <div class="main-inner">
        <div class="col-main">
            <div class="page-title">
                <h1>Transaction Success</h1>
            </div>
            <p>Thank you for registering the demo with our pre sales team. Our sales representative shall arrive with
                required kit to demonstrate the product on above date and
                address. Please note that the demo shall last for half an hour only.</p>

            {*{if !empty($coupon)}*}
            {*<p>You can use given below coupon code of value Rs.750/- on purchase of floor cleaner robots with*}
            {*us.</p>*}
            {*<p>COUPON CODE : {$coupon['couponCode']}</p>*}
            {*<p>Please note that this coupon is only valid for 1 month.</p>*}
            {*{/if}*}

            <p>
                For any queries, complaints or suggestions, please email us at customercare@milagrow.in or call
                09953476189 and 0124-4309570/71/72. Timings: 9:30 AM - 7:30 PM.
            </p>
        </div>
    </div>
</div>

