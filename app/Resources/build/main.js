$(document).ready(function () {
    console.log("main : resources/main.js");

    $('.material-select').formSelect();

    // setup listener for custom event to re-initialize on change
    $('.material-select').on('contentChanged', function() {
        $(this).formSelect();
    });
});