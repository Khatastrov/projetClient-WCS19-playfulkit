let $addToolLink = $('<button class="add_tool_link btn btnAddTool">Ajouter un outil</button>');
let $newLinkLiTool = $('<p></p>').append($addToolLink);

jQuery(document).ready(function () {
    // Get the ul that holds the collection of tags
    let $collectionHolder = $('ol.tools');

    // add the "add a step" anchor and <li> to the .steps <ul>
    $collectionHolder.append($newLinkLiTool);

    // count the current form inputs, use that as the new
    // index when inserting a new item
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addToolLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new Step form (see code block below)
        addToolForm($collectionHolder, $newLinkLiTool);
    });


});

//allow existing steps removal
$('button.remove-existing-tool').click(function () {
    event.preventDefault();
    $(this).parent().remove();

    return false;
});

function addToolForm($collectionHolder, $newLinkLiTool)
{
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newFormTool = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an <li>, before the "Ajouter une étape" link <li>
    var $newFormLiTool = $('<li></li>').append(newFormTool);

    // Add a remove link <li>
    $newFormLiTool.append('<button class="remove-tag btn btnRemoveStep">Supprimer cet outil</button>');

    $newLinkLiTool.before($newFormLiTool);

    // handles the removal
    $('.remove-tag').click(function (e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}
