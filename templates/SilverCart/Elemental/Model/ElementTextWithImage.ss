<div class="row d-flex element-text-with-image" id="element-text-with-image-{$ID}">
    <div class="col-lg-6 px-45 py-60 <% if $Layout == 'ContentRight' %>order-2<% end_if %>" {$StyleText}>
        <% if $ShowTitle %><h2 class="text-uppercase mb-10 line-height-30px">{$Title.RAW}</h2><% end_if %>
        <% if $ShowSubTitle %><h3 class="text-uppercase mt-20 mb-10 line-height-22px" {$StyleSubTitle}>{$SubTitle.RAW}</h3><% end_if %>
        <% if $Content %><div class="text-lg">{$Content}</div><% end_if %>
    </div>
    <div class="col-lg-6 px-45 py-60 <% if $Layout == 'ContentRight' %>order-1<% end_if %>" {$StyleImage}>
        <div class="image-container">
            <a class="fancybox d-inline-block" href="{$Image.ScaleWidth(800).Link}">
                <img src="{$Image.ScaleWidth(450).Link}"
                     srcset="
                        {$Image.ScaleWidth(220).Link} 320w,
                        {$Image.ScaleWidth(500).Link} 600w,
                        {$Image.ScaleWidth(800).Link} 900w,
                        {$Image.ScaleWidth(450).Link} 1200w"
                     alt="{$Title.StripTags}"
                     class="img-fluid"
                 ></a>
        </div>
    </div>
</div>