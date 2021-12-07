
/* Get the url select value */

function getSelectValue() {
    //Get the url select
    var select = document.getElementById("url");
    var selectValue = select.options[select.selectedIndex].text;

    //Set the select value
    var slug = document.getElementById("slug");
    slug.innerText = selectValue;
}

