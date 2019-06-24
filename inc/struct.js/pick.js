function __comp_pick(params) { 
    return `
<div itemid="${params.id}" class="ti-witem">
    <div class="ti-xitem">
        <span></span>
        <div class="ti-name">
            <div>${params.name}</div>
            <span>${params.info}</span>
        </div>
    </div>
    <div class="ti-xdiscounts">${params.discs}</div>
</div>` }