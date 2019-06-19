var $addStepLink = $('<button class="add_step_link btn btnAddStep">Ajouter une étape</button>');
var $newLinkLi = $('<p></p>').append($addStepLink);

jQuery(document).ready(function () {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('ol.steps');

    // add the "add a step" anchor and <li> to the .steps <ul>
    $collectionHolder.append($newLinkLi);

    // count the current form inputs, use that as the new
    // index when inserting a new item
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addStepLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new Step form (see code block below)
        addStepForm($collectionHolder, $newLinkLi);
    });


});

//allow existing steps removal
$('button.remove-existing-step').click(function () {
    event.preventDefault();
    $(this).parent().remove();

    return false;
});

function addStepForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an <li>, before the "Ajouter une étape" link <li>
    var $newFormLi = $('<li></li>').append(newForm);

    // Add a remove link <li>
    $newFormLi.append('<button class="remove-tag btn btnRemoveStep">Supprimer cette étape</button>');

    $newLinkLi.before($newFormLi);

    // handles the removal
    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}
