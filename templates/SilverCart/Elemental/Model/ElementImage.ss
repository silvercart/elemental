<% if $ShowTitle || $DescriptionText %>
<div class="banner container-wide overlay--blue-gradient-left-strong">
    <% if $Image %>
    <div class="overlay__img lazypreload art-direct-image atom art-direct-image--fit-cover" sizes="1440px">
        <div class="art-direct-image__spacer" style="object-position: center center !important;">
            <picture>
                <source data-srcset="
                        {$Image.Fill(400,267).URL} 400w,
                        {$Image.Fill(800,533).URL} 800w,
                        {$Image.Fill(1088,725).URL} 1088w,
                        {$Image.Fill(2176,1451).URL} 2176w,
                        {$Image.Fill(2880,1920).URL} 2880w"
                        srcset="
                        {$Image.Fill(400,267).URL} 400w,
                        {$Image.Fill(800,533).URL} 800w,
                        {$Image.Fill(1088,725).URL} 1088w,
                        {$Image.Fill(2176,1451).URL} 2176w,
                        {$Image.Fill(2880,1920).URL} 2880w"
                        data-aspectratio="1.5001500150015" data-tag="landscape portrait" data-style="object-position: center center !important;" sizes="1440px" >
                <img data-sizes="auto" data-parent-fit="cover" alt="<% if $Image.Title %>{$Image.Title.ATT}<% else %>{$Title.ATT}<% end_if %>" class="lazyautosizes" sizes="1440px">
            </picture>
            <div class="overlay__color"></div>
        </div>
    </div>
    <% end_if %>
    <div class="container px-16 py-64">
        <div class="banner__content">
        <% if $Title && $ShowTitle %>
            <p class="banner__title" style="font-size:32px;font-weight:600;">{$Title}</p>
        <% end_if %>
        <% if $DescriptionText %>
            <div class="banner__text">
                <h3 class="font-weight-normal" style="font-size:24px;line-height:28px;">{$DescriptionText}</h3>
            </div>
        <% end_if %>
            <div role="group" class="btn-row btn-row--align-center container--content-flow">
            <% if $SlideLink && $SlideLink.Template != 'buttonghost' %><% with $SlideLink %>
                <a href="{$LinkURL}"{$TargetAttr}{$setCSSClass('btn btn--default btn--size-primary d-inline-flex').ClassAttr} title="{$Title}">
                    <div class="btn__label">Mehr</div>
                    <ion-icon name="caret-forward-outline"></ion-icon>
                </a>
            <% end_with %><% end_if %>
            </div>
        </div>
    </div>
    <% if $SlideLink && $SlideLink.Template == 'buttonghost' %><% with $SlideLink %>
    <a href="{$LinkURL}"{$TargetAttr} title="{$Title}" class="stretched-link"></a>
    <% end_with %><% end_if %>
</div>
<% else %>
<div class="banner container-wide overlay--blue-gradient-left-strong">
    <% if $Image %>
    <div class="overlay__img lazypreload art-direct-image atom art-direct-image--fit-cover" sizes="1440px">
        <div>
            <picture>
                <source data-srcset="
                        {$Image.ScaleWidth(400).URL} 400w,
                        {$Image.ScaleWidth(800).URL} 800w,
                        {$Image.ScaleWidth(1088).URL} 1088w,
                        {$Image.ScaleWidth(2176).URL} 2176w,
                        {$Image.ScaleWidth(2880).URL} 2880w"
                        srcset="
                        {$Image.ScaleWidth(400).URL} 400w,
                        {$Image.ScaleWidth(800).URL} 800w,
                        {$Image.ScaleWidth(1088).URL} 1088w,
                        {$Image.ScaleWidth(2176).URL} 2176w,
                        {$Image.ScaleWidth(2880).URL} 2880w"
                        data-aspectratio="1.5001500150015" data-tag="landscape portrait" sizes="1440px" >
                <img data-sizes="auto" alt="<% if $Image.Title %>{$Image.Title.ATT}<% else %>{$Title.ATT}<% end_if %>" class="lazyautosizes" sizes="1440px">
            </picture>
        </div>
    </div>
    <% end_if %>
    <% if $SlideLink %><% with $SlideLink %>
    <a href="{$LinkURL}"{$TargetAttr} title="{$Title}" class="stretched-link"></a>
    <% end_with %><% end_if %>
</div>
<% end_if %>