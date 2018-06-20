$(document).ready(function () {
    console.log("main : resources/main.js");

    $('.material-select').formSelect();

    $('.sidenav').sidenav();

    $('.sidebar-close').on('click', function () {
        $('.sidenav').close();
    })
});