function setUserAddress(inputElementName, toModifyElementName) {
    let userAddressElement = document.getElementById(inputElementName);
    if (userAddressElement == null || userAddressElement.value === '') {
        alert("Data unchanged!");
        return false;
    }

    let userAddress = userAddressElement.value;
    let lt = /</g,
        gt = />/g,
        ap = /'/g,
        ic = /"/g;

    userAddress = userAddress.toString().replace(lt, "&lt;").
    replace(gt, "&gt;").
    replace(ap, "&#39;").
    replace(ic, "&#34;").
    replace(" ","");

    if (userAddress.search("&lt;") !== -1 || userAddress.search("&gt;") !== -1 ||
        userAddress.search("&#39;") !== -1 || userAddress.search("&#34;") !== -1) {
        alert("Invalid email address");
        return false;
    }

    let mailformat = /\S+@\S+\.\S+/;
    if (userAddress.match(mailformat))
    {
        let updateUserAddressElement = document.getElementById(toModifyElementName);
        updateUserAddressElement.innerText = userAddress;
    }
    else {
        alert("You have entered an invalid email address!")
        return (false)
    }

    return true;
}

function resetMailAddress()
{
    let userAddressElement = document.getElementById('emailAddress');
    userAddressElement.innerText = '';
}


function updateUserData() {
    let note = selectedElements('notes');
    let occasion = selectedElements('occasions');
    let season = selectedElements('seasons');
    let deliveryAddress = document.getElementById('userAddress');
    let userEmail = document.getElementById('userEmail');

    if (deliveryAddress == null || note == null || occasion == null || season == null || userEmail == null) {
        alert("Something has gone wrong! Please refresh the page");
        return false;
    }

    if (deliveryAddress.innerText === '') {
        alert("Please enter your delivery address");
        return false;
    }

    if (userEmail.innerText === '') {
        alert("Please enter your delivery address");
        return false;
    }

    let noteJson = JSON.stringify(note);
    let occasionJson = JSON.stringify(occasion);
    let seasonJson = JSON.stringify(season);
    let deliveryAddressJson = JSON.stringify(deliveryAddress.innerText);
    let userEmailJson = JSON.stringify(userEmail.innerText);

    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.open("POST", "../../backend/utils/UpdateUserData.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === '1') {
                alert("User data updated successfully!");
            } else {
                alert("Something went wrong. Please try again");
            }
        }
    };

    xmlhttp.send("&userEmail=" + userEmailJson + "&occasion=" + occasionJson +
        "&season=" + seasonJson + "&deliveryAddress=" + deliveryAddressJson + "&note=" + noteJson);
}