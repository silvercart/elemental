<div class="row d-flex element-text-with-image" id="element-text-with-image-{$ID}">
    <div class="col-lg-6 px-25 px-lg-45 py-30 py-lg-60 border-bottom border-lg-bottom-0 <% if $Layout == 'ContentRight' %>order-2<% end_if %>" {$StyleText}>
        <% if $ShowDisplayTitle %><h2 class="text-uppercase mb-10 line-height-30px">{$Title.RAW}</h2><% end_if %>
        <% if $DisplayContent %><div class="text-lg text-justify">{$DisplayContent}</div><% end_if %>
        <% if $Product %>
        <% with $Product %>
        <div class="price h1 text-right">{$PriceNice}</div>
        <div class="row mt-20">
            <div class="col-12 col-xs-4">
                <a href="{$Link}" class="btn btn-gray d-block d-xs-inline-block mb-10 mb-xs-0px"><%t SilverCart\Model\Pages\Page.DETAILS 'Details' %> <span class="fa fa-angle-double-right"></span></a>
            </div>
            <div class="col-12 col-xs-8">
                <% if $isBuyableDueToStockManagementSettings %>
                    {$AddToCartForm('List')}
                <% else %>
                    <div class="alert alert-warning"><%t SilverCart\Model\Pages\ProductPage.OUT_OF_STOCK 'This product is out of stock.' %></div>
                    {$AfterOutOfStockNotificationContent}
                <% end_if %>
            </div>
        </div>
            <% end_with %>
        <% end_if %>
    </div>
    <div class="col-lg-6 px-5px px-sm-25 px-lg-45 py-5px py-sm-30 py-lg-60 border-bottom border-lg-bottom-0 <% if $Layout == 'ContentRight' %>order-1<% end_if %>" {$StyleImage}>
        <div class="image-container h-100">
            <a class="fancybox d-inline-block text-nowrap h-100" href="{$DisplayImage.Link}">
                <img src="{$DisplayImage.ScaleWidth(450).Link}"
                     srcset="
                        {$DisplayImage.ScaleWidth(220).Link} 320w,
                        {$DisplayImage.ScaleWidth(500).Link} 600w,
                        {$DisplayImage.ScaleWidth(800).Link} 900w,
                        {$DisplayImage.ScaleWidth(450).Link} 1200w"
                     alt="{$Title.StripTags}"
                     class="img-fluid"
                 ></a>
                <span class="alignment-helper"></span>
        </div>
    </div>
</div>