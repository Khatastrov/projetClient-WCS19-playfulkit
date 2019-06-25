let fablabElt = document.getElementById("articles");
ajaxGet("http://www.makery.info/api/labs/", function (reponse) {
    // Transforme la réponse en un tableau d'articles
    let features = JSON.parse(reponse);
    features.forEach(function (feature) {
        let properties = JSON.parse(reponseProperties);
            properties.forEach(function (propertie) {
                if (propertie.type_lab == "fablab") {
                    let nameElt = document.createElement('h3');
                    nameElt.name = propertie.name;
                    fablabElt.appendChild(nameElt);
                } else {
                    let alertElt = document.createElement('p');
                    alertElt.alert = "Not found !";
                }
            })
    });
});

