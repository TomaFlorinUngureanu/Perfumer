function selectedElements(tagName) {
    const elementsArray = document.getElementsByName(tagName + '[]');
    //console.log(elementsArray);
    let selectedElemArray = [];
    if (tagName === "price") {
        //console.log(tagName + " " + elementsArray[0].value + " is Checked");
        selectedElemArray.push(elementsArray[0].value);
    } else {
        for (let element = 0; element < Object.keys(elementsArray).length; element++) {
            if (elementsArray[element].checked === true) {
                //console.log(tagName + " " + elementsArray[element].value + " is Checked");
                selectedElemArray.push(elementsArray[element].value)
            }
        }
    }

    return selectedElemArray;
}

function loadXMLDoc() {

    let theParent = document.getElementById("fragranceGridWrapper");
    theParent.parentNode.removeChild(theParent);

    let xmlhttp;
    const brandsArray = selectedElements('brands');
    const occasion = selectedElements('occasions');
    const seasonOpt = selectedElements('seasons');
    const noteOpt = selectedElements('notes');
    const price = selectedElements('price');
    const genderArray = selectedElements('genders');

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/PerfumeGetter.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            //console.log(this.responseText);
            theParent = document.getElementById('fragranceNotToDelete');
            let wrapperReborn = document.createElement("div");

            wrapperReborn.setAttribute('class', 'fragranceGridWrapper');
            wrapperReborn.setAttribute('name', 'fragranceGridWrapper');
            wrapperReborn.setAttribute('id', 'fragranceGridWrapper');
            theParent.appendChild(wrapperReborn);

            //console.log(this.responseText);
            const response = JSON.parse(this.responseText);
            const size = Object.keys(response).length;
            const wrapper = document.getElementById("fragranceGridWrapper");
            let oDiv = null;
            let oImg = null;
            let oTitle = null;
            let oBrand = null;
            let oPrice = null;
            let oNotes = null;
            let oId = null;

            for (let i = 0; i < size; i++) {
                //create the div class
                oDiv = document.createElement("div");
                oDiv.setAttribute('class', 'fragranceGrid');
                oDiv.setAttribute('name', 'fragranceGrid');
                //console.log(oDiv);

                //create the img element and append it to the div class
                oImg = document.createElement("img");
                oImg.setAttribute('src', response[i]['POZA']);
                oImg.setAttribute('height', '200');
                oImg.setAttribute('width', '200');
                oImg.setAttribute('class', 'centerFragrancePicture');
                oImg.addEventListener("click", sendToSpecificFragrance);
                oImg.setAttribute('id','fragranceImage');
                oImg.setAttribute('name', 'fragranceImage');
                oDiv.appendChild(oImg);

                //create the title element and append it to the div class
                oTitle = document.createElement("p");
                oTitle.setAttribute('id','fragranceTitle');
                oTitle.setAttribute('name', 'fragranceTitle');
                oTitle.innerHTML = response[i]['NUME'];
                //oTitle.addEventListener("click", sendToSpecificFragrance);
                oDiv.appendChild(oTitle);

                //create the title element and append it to the div class
                oId = document.createElement("p");
                oId.innerHTML = response[i]['ID'];
                oId.setAttribute('id','fragranceId');
                oId.setAttribute('name', 'fragranceId');
                oId.setAttribute('hidden',true);
                oDiv.appendChild(oId);

                //create the brand element and append it to the div class
                oBrand = document.createElement("p");
                oBrand.innerHTML = response[i]['BRAND'];
                oBrand.setAttribute('id','fragranceBrand');
                oBrand.setAttribute('name', 'fragranceBrand');
                oDiv.appendChild(oBrand);

                //create the notes element and append it to the div class
                oNotes = document.createElement("p");
                oNotes.innerHTML = response[i]['NOTE'];
                oNotes.setAttribute('id','fragranceNotes');
                oNotes.setAttribute('name', 'fragranceNotes');
                oDiv.appendChild(oNotes);

                //create the price element and append it to the div class
                oPrice = document.createElement("p");
                oPrice.innerHTML = response[i]['PRET'] + " RON";
                oPrice.setAttribute('id','fragrancePrice');
                oPrice.setAttribute('name', 'fragrancePrice');
                oDiv.appendChild(oPrice);

                //console.log(wrapper);
                wrapper.appendChild(oDiv);
            }
        }
    };

    xmlhttp.send("&occasions=" + JSON.stringify(occasion) +
        "&seasons=" + JSON.stringify(seasonOpt) +
        "&myRange=" + JSON.stringify(price) +
        "&genders=" + JSON.stringify(genderArray) +
        "&brands=" + JSON.stringify(brandsArray) +
        "&notes=" + JSON.stringify(noteOpt));
}

function sendToSpecificFragrance(event) {
    let fragranceImage = event.target;
    let fragranceDiv = fragranceImage.parentElement.getElementsByTagName('p');
    let fragranceId = fragranceDiv[1].innerHTML;
    console.log(fragranceId);
    let fragranceArray = [fragranceId];
    let xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/RedirectSpecificPerfume.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            return true;
        }
    };

    xmlhttp.send("&fragranceId=" + JSON.stringify(fragranceArray));
    window.location = "PerfumerSpecificFragrance.php";
}