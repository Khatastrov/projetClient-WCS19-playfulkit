let fablabElt = document.getElementById("fablab");
$.getJSON("http://www.makery.info/api/labs/", function (data) {
    const fablabs = data.features.filter((feature)=>{
        return feature.properties.type_lab === 'fablab';
    });
    fablabs.map((fablab)=>{
        let nameElt = document.createElement('h3');
        nameElt.innerText = fablab.properties.name;
        fablabElt.appendChild(nameElt);
    });
});

