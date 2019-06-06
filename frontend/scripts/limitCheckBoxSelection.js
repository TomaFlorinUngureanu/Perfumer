var checkboxgroup = document.getElementById('fragranceNotes').getElementsByTagName("input");
var limit = 3;
for (var i = 0; i < checkboxgroup.length; i++) {
    checkboxgroup[i].onclick = function () {
        var checkedcount = 0;
        for (var i = 0; i < checkboxgroup.length; i++) {
            checkedcount += (checkboxgroup[i].checked) ? 1 : 0;
        }
        if (checkedcount > limit) {
            console.log("You can select maximum of " + limit + " notes.");
            alert("You can select maximum of " + limit + " notes.");
            this.checked = false;
        }
    }
}