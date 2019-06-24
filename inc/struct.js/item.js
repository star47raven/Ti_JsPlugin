function __comp_item(params) { 
    return `
<div itemid="${params.id}" class="ti-witem">
    <div class="ti-xitem">
        <span style="background-image: url(${params.image})"></span>
        <div class="ti-nametitle">${params.name}</div>
        <div class="ti-name">
            <span class="${params.ac}"><i class="material-icons">people</i>${params.aut}</span>
            <span class="${params.tc}"><i class="material-icons">today</i>${params.time}</span>
            <span class="${params.pc}"><i class="material-icons">map</i>${params.place}</span>
        </div>
    </div>
</div>` }