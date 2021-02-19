<div class="row d-flex element-text-with-image" id="element-text-with-image-{$ID}">
    <div class="col-lg-6 px-25 px-lg-45 py-30 py-lg-60 border-bottom border-lg-bottom-0 <% if $Layout == 'ContentRight' %>order-lg-2<% end_if %>" {$StyleText}>
        <% if $ShowTitle %><h2 class="text-uppercase mb-10 line-height-30px">{$Title.RAW}</h2><% end_if %>
        <% if $ShowSubTitle %><h3 class="text-uppercase mt-20 mb-10 line-height-22px" {$StyleSubTitle}>{$SubTitle.RAW}</h3><% end_if %>
        <% if $Content %><div class="text-lg text-justify">{$Content}</div><% end_if %>
    </div>
    <div class="col-lg-6 px-5px px-sm-10 px-lg-20 px-xxl-30 py-5px py-sm-10 py-lg-20 py-xxl-30 border-bottom border-lg-bottom-0 <% if $Layout == 'ContentRight' %>order-lg-1<% end_if %>" {$StyleImage}>
        <div class="image-container text-nowrap h-100">
        <% if $Image.ID == $PreviewImage.ID %>
            <a class="fancybox d-none d-md-inline-block h-100" href="{$Image.Link}">
                <img src="{$PreviewImage.ScaleWidth(500).Link}"
                     srcset="
                        {$PreviewImage.ScaleWidth(220).Link} 320w,
                        {$PreviewImage.ScaleWidth(500).Link} 600w,
                        {$PreviewImage.ScaleWidth(800).Link} 900w,
                        {$PreviewImage.ScaleWidth(500).Link} 1200w,
                        {$PreviewImage.ScaleWidth(900).Link} 1600w"
                     alt="{$Title.StripTags}"
                     class="img-fluid"
                 ></a>
            <span class="d-inline-block d-md-none h-100">
                <img src="{$PreviewImage.ScaleWidth(500).Link}"
                     srcset="
                        {$PreviewImage.ScaleWidth(220).Link} 320w,
                        {$PreviewImage.ScaleWidth(500).Link} 600w,
                        {$PreviewImage.ScaleWidth(800).Link} 900w,
                        {$PreviewImage.ScaleWidth(500).Link} 1200w,
                        {$PreviewImage.ScaleWidth(900).Link} 1600w"
                     alt="{$Title.StripTags}"
                     class="img-fluid"
                 ></span>
                <span class="alignment-helper"></span>
        <% else %>
            <a class="fancybox d-inline-block h-100" href="{$Image.Link}">
                <img src="{$PreviewImage.ScaleWidth(500).Link}"
                     srcset="
                        {$PreviewImage.ScaleWidth(220).Link} 320w,
                        {$PreviewImage.ScaleWidth(500).Link} 600w,
                        {$PreviewImage.ScaleWidth(800).Link} 900w,
                        {$PreviewImage.ScaleWidth(500).Link} 1200w,
                        {$PreviewImage.ScaleWidth(900).Link} 1600w"
                     alt="{$Title.StripTags}"
                     class="img-fluid"
                 ></a>
                <span class="alignment-helper"></span>
        <% end_if %>
        </div>
    </div>
</div>