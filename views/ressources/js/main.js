
/* Get the url select value */

function getSelectValue() {
    //Get the url select
    var select = document.getElementById("url");
    var selectValue = select.options[select.selectedIndex].text;

    //Set the select value
    var slug = document.getElementById("slug");
    slug.innerText = selectValue;
}

/* Get a random rgb color */
function random_rgb() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgb(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ')';
}

