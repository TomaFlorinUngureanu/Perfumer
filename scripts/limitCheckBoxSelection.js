let checkboxgroup = document.getElementById('fragranceNotes').getElementsByTagName("input");
let limit = 3;
for (let i = 0; i < checkboxgroup.length; i++) {
    checkboxgroup[i].onclick = function () {
        let checkedcount = 0;
        for (let i = 0; i < checkboxgroup.length; i++) {
            checkedcount += (checkboxgroup[i].checked) ? 1 : 0;
        }
        if (checkedcount > limit) {
            console.log("You can select maximum of " + limit + " notes.");
            alert("You can select maximum of " + limit + " notes.");
            this.checked = false;
        }
    }
}