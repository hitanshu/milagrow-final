
 <div class="ma-newproductslider-container">

<div class="ma-newproductslider-title"><h2>{l s='Lastest Products' mod='tdnewproducts'}</h2></div>
<div class="flexslider carousel">
{if $new_products !== false}
        <ul class="slides">
        {foreach from=$new_products item=newproduct name=myLoop} 
            <li class="newproductslider-item">
                 <div class="item-inner">
                     {if isset($newproduct.new) && $newproduct.new == 1}<div class="label-pro-new">{l s='New' mod='tdnewproducts'}</div>{/if}
{if isset($newproduct.on_sale) && $newproduct.on_sale && isset($newproduct.show_price) && $newproduct.show_price && !$PS_CATALOG_MODE} <div class="label-pro-sale">{l s='Sale' mod='tdnewproducts'}</div>{/if}
                    <a href="{$newproduct.link}" title="{$newproduct.name|escape:html:'UTF-8'}" class="product_img_link product-image">
                        <img src="{$link->getImageLink($newproduct.link_rewrite, $newproduct.id_image, 'home_default')}"  alt="{$newproduct.name|escape:html:'UTF-8'}" />
                    </a>
                    <h2 class="product-name"> <a href="{$newproduct.link}" title="{$newproduct.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">{$newproduct.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}</a></h2>
                    <div class="price-box">


                        {if ((isset($newproduct.on_sale) && $newproduct.on_sale) || (isset($newproduct.reduction) && $newproduct.reduction)) && $newproduct.price_without_reduction > $newproduct.price && $newproduct.show_price AND !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
                            <p class="old-price">
                                <span class='price'>
                                    {convertPrice price=$newproduct.price_without_reduction}
                                </span>
                            </p>{else}     
                        {/if}
                        <p class="special-price"> 
            {if $newproduct.show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}  {if !$priceDisplay}<span class="price">{convertPrice price=$newproduct.price}</span>{else}<span class="price">{convertPrice price=$newproduct.price_tax_exc}</span>{/if}{else}<div style="height:21px;"></div>{/if}
        </p>



    </div>
    <div class="actions">

        {if ($newproduct.id_product_attribute == 0 OR (isset($add_prod_display) AND ($add_prod_display == 1))) AND $newproduct.available_for_order AND !isset($restricted_country_mode) AND $newproduct.minimal_quantity == 1 AND $newproduct.customizable != 2 AND !$PS_CATALOG_MODE}
            {if ($newproduct.quantity > 0 OR $newproduct.allow_oosp)}
                <a class="exclusive ajax_add_to_cart_button  button btn-cart" rel="ajax_id_product_{$newproduct.id_product}" href="{$link->getPageLink('cart')}?qty=1&amp;id_product={$newproduct.id_product}&amp;token={$static_token}&amp;add" title="{l s='Add to cart' mod='tdnewproducts'}"><span><span>{l s='Add to cart' mod='tdnewproducts'}</span></span></a>
            {else}
                <button type="button" title="{l s='Out of Stock' mod='tdnewproducts'}" class="button btn-cart" ><span><span>{l s='Out of Stock' mod='tdnewproducts'}</span></span></button>
            {/if}

        {/if}
        <ul class="add-to-links">
            <input type="hidden" name="qty" id="quantity_wanted" class="text"  value="1" size="2" maxlength="3" />

            <li><a rel="tooltip"  onclick="WishlistCart('wishlist_block_list', 'add', '{$newproduct.id_product|intval}', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" title="{l s='Add to Wishlist' mod='tdnewproducts'}" class="link-wishlist">{l s='Add to Wishlist' mod='tdnewproducts'}</a></li>
            <li><span class="separator">|</span>
                <a id="comparator_item_{$newproduct.id_product}" rel="tooltip"  title="{l s='Add to Compare' mod='tdnewproducts'}"  class="link-compare link-compare">{l s='Add to Compare' mod='tdnewproducts'}</a>
            </li>


        </ul>
    </div>

</div>
                
                
                
            </li>  
        {/foreach}
        </ul>
{else}
    <p>{l s='No new products at this time' mod='tdnewproducts'}</p>
{/if}

    <script type="text/javascript">
$jq('.ma-newproductslider-container .flexslider').flexslider({
slideshow: false,
itemWidth: 220,
itemMargin: 5,
minItems: 1,
maxItems: 5,
slideshowSpeed: 3000,
animationSpeed: 600,
controlNav: false,
animation: "slide"
});
    </script>
</div>	
</div> 

<div class="content-sample-block">
    <div class="row-fluid">
          {$themesdev.td_hcustomb_content|html_entity_decode}
    </div>
</div>

                                               
