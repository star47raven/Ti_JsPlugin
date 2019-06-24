function __comp_cat(params) { 
    return `
<div itemid="${params.key}" catcol="${params.color}" class="ti-citem">
    <img src="${params.img}" />
    <div class="ti-name">${params.name}</div>
</div>` }