<div class="element-content mt-20 mb-50 <% if $Style %>{$StyleVariant}<% end_if %>" id="element-content-{$ID}">
    <% if $ShowTitle %><h2 class="text-uppercase mb-10">{$Title.RAW}</h2><% end_if %>
    <% if $ShowSubTitle %><h3 class="text-uppercase mt-20 mb-10">{$SubTitle.RAW}</h3><% end_if %>
    <% if $HTML %><div class="column-count-{$ColumnCount} text-lg text-justify">{$HTML}</div><% end_if %>
</div>
