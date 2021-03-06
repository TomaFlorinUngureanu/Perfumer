function selectedElements(tagName) {
    const elementsArray = document.getElementsByName(tagName + '[]');
    if (elementsArray === null || Object.keys(elementsArray).length === 0) {
        alert("Could not retrieve the elements from the " + tagName + " tag");
        return false;
    }

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

    let ourRecommendation = document.getElementById('ourRecommendationWrapper');
    if (ourRecommendation != null) {
        ourRecommendation.parentNode.removeChild(ourRecommendation);
    }
    ourRecommendation = document.getElementById('ourRecommendation');
    if (ourRecommendation != null) {
        ourRecommendation.parentNode.removeChild(ourRecommendation);
    }

    let byName = document.getElementById('searchByNameWrapper');
    if (byName != null) {
        byName.parentNode.removeChild(byName);
    }

    let theParent = document.getElementById("fragranceGridWrapper");
    if (theParent != null) {
        theParent.parentNode.removeChild(theParent);
    }

    let xmlhttp;
    const brandsArray = selectedElements('brands');
    const occasion = selectedElements('occasions');
    const seasonOpt = selectedElements('seasons');
    const noteOpt = selectedElements('notes');
    const price = selectedElements('price');
    const genderArray = selectedElements('genders');
    if (theParent === null || brandsArray === false || occasion === false || seasonOpt === false
        || price === false || genderArray === false) {
        return false;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/PerfumeGetter.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            theParent = document.getElementById('fragranceNotToDelete');
            let wrapperReborn = document.createElement("div");

            wrapperReborn.setAttribute('class', 'fragranceGridWrapper');
            wrapperReborn.setAttribute('name', 'fragranceGridWrapper');
            wrapperReborn.setAttribute('id', 'fragranceGridWrapper');
            theParent.appendChild(wrapperReborn);

            const wrapper = document.getElementById("fragranceGridWrapper");
            if (this.responseText !== '[]') {
                const response = JSON.parse(this.responseText);
                const size = Object.keys(response).length;
                let oDiv = null;
                let oImg = null;
                let oTitle = null;
                let oBrand = null;
                let oPrice = null;
                let oNotes = null;
                let oId = null;

                for (let i = 0; i < size; i++) {
                    generateHTML(wrapper, response, i);
                }
            } else {
                let notFoundElement = document.createElement("h2");
                notFoundElement.innerText = "There are not so many options as you may think. We are sorry :(";
                wrapper.appendChild(notFoundElement);
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
    let fragranceArray = [fragranceId];
    let xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/RedirectSpecificPerfume.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            return true;
        }
    };

    xmlhttp.send("&fragranceId=" + JSON.stringify(fragranceArray));
    window.location = "PerfumerSpecificFragrance.php";
}

function checkStock(callback, param) {
    let xmlhttp;
    let fragranceId;

    let shoppingCartInfo = document.getElementById('shoppingCartText');
    if (shoppingCartInfo !== null) {
        let fragranceIdElements = shoppingCartInfo.getElementsByClassName('fragranceShoppingCartId');
        if (fragranceIdElements !== null) {
            fragranceId = fragranceIdElements[0];
        }
    } else {
        fragranceId = document.getElementById('fragranceId');
    }

    if (fragranceId === null || fragranceId.innerHTML === '') {
        alert("Could not retrieve the fragrance id!");
        return false;
    }

    let fragranceIdText = fragranceId.innerText;

    let fragranceQuantity;
    if (shoppingCartInfo !== null) {
        fragranceQuantity = document.getElementById('shoppingCartQuantity');
    } else {
        fragranceQuantity = document.getElementById('fragranceQuantity');
    }

    if (fragranceQuantity === null) {
        alert("Could not retrieve the fragrance quantity!");
        return false;
    }
    if (fragranceQuantity.innerText === '' || fragranceQuantity.innerText.length < 10) {
        alert("Could not retrieve the fragrance quantity!");
        return false;
    }

    let fragranceQuantityText = fragranceQuantity.innerText;

    fragranceQuantityText = fragranceQuantityText.substr(10, 3);
    let fragranceQuantityArray = [fragranceQuantityText];
    let fragranceIdArray = [fragranceIdText];


    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/shoppingCartRelated/CheckStock.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            param = this.responseText;
            callback(param);
        }
    };

    xmlhttp.send("&fragranceId=" + JSON.stringify(fragranceIdArray) +
        "&fragranceQuantity=" + JSON.stringify(fragranceQuantityArray));
}

function desiredQuantity(clickedId) {
    let fragranceId = document.getElementById('fragranceId');
    if (fragranceId === null) {
        alert("Could not retrieve the fragrance id");
        return false;
    }

    let fragranceIdText = fragranceId.innerText;
    let fragranceIdArray = [fragranceIdText];
    let optionArray = [clickedId];

    let xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/RedirectSpecificPerfume.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            return true;
        }
    };

    xmlhttp.send("&fragranceId=" + JSON.stringify(fragranceIdArray) +
        "&fragranceOption=" + JSON.stringify(optionArray));

    window.location = "PerfumerSpecificFragrance.php";
}

function addToCart() {
    let fragranceQuantity = document.getElementById("fragranceQuantity");
    if (fragranceQuantity === null) {
        alert("Could not retrieve the fragrance quantity!");
        return false;
    }

    if (fragranceQuantity.innerText === '' || fragranceQuantity.innerText < 10) {
        alert("Could not retrieve the fragrance quantity!");
        return false;
    }

    let fragranceQuantityNumber = fragranceQuantity.innerText.substr(10, 3);

    let fragranceQuantityOption = null;
    switch (fragranceQuantityNumber) {
        case '50 ': {
            fragranceQuantityOption = ['0'];
            break;
        }
        case '100': {
            fragranceQuantityOption = ['1'];
            break;
        }
        case '150': {
            fragranceQuantityOption = ['2'];
            break;
        }
        case '200': {
            fragranceQuantityOption = ['3'];
            break;
        }
        default: {
            alert("Invalid Quantity!");
            return false;
        }
    }

    let fragranceId = document.getElementById("fragranceId");
    if (fragranceId == null || fragranceId.innerText === '') {
        alert("Could not retrieve the fragrance id!");
        return false;
    }

    let fragranceIdText = fragranceId.innerText;
    let fragranceIdArray = [fragranceIdText];

    let quantityAmountElement = document.getElementById("quantity-amount");
    let quantityAmount = quantityAmountElement.value;
    let quantityAmountArray = [quantityAmount];

    let pricePerItemElement = document.getElementById("fragrancePrice");
    if (pricePerItemElement === null || pricePerItemElement.innerText === '') {
        alert("Could not retrieve the price of the item!");
        return false;
    }

    let pricePerItem = pricePerItemElement.innerText;
    pricePerItem = pricePerItem.replace(' RON', '');
    let cost = pricePerItem * quantityAmount;
    let costString = cost.toString();
    let costArray = [costString];

    let xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    let fragranceJson = JSON.stringify(fragranceIdArray);
    let quantityJson = JSON.stringify(fragranceQuantityOption);
    let quantityAmountJson = JSON.stringify(quantityAmountArray);
    let costJson = JSON.stringify(costArray);

    xmlhttp.open("POST", "../../backend/utils/shoppingCartRelated/AddToCart.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "You must login first!") {
                alert(this.responseText);
            }
        }
    };

    xmlhttp.send("&fragranceCartId=" + fragranceJson +
        "&fragranceCartOption=" + quantityJson +
        "&amountCart=" + quantityAmountJson +
        "&costCart=" + costJson);
}

function updateCart(shoppingCartTextElem, id) {

    let fragranceQuantity = shoppingCartTextElem.getElementsByClassName('shoppingCartQuantity')[0];
    if (fragranceQuantity === null) {
        alert("Could not retrieve the fragrance quantity!");
        return false;
    }

    if (fragranceQuantity.innerText === '' || fragranceQuantity.innerText < 10) {
        alert("Could not retrieve the fragrance quantity!");
        return false;
    }

    let fragranceQuantityNumber = fragranceQuantity.innerText.substr(10, 3);
    let fragranceQuantityOption = null;
    switch (fragranceQuantityNumber) {
        case '50': {
            fragranceQuantityOption = ['0'];
            break;
        }
        case '100': {
            fragranceQuantityOption = ['1'];
            break;
        }
        case '150': {
            fragranceQuantityOption = ['2'];
            break;
        }
        case '200': {
            fragranceQuantityOption = ['3'];
            break;
        }
        default: {
            alert("Invalid Quantity!");
            return false;
        }
    }

    let fragranceId = shoppingCartTextElem.getElementsByClassName("fragranceShoppingCartId")[0];
    if (fragranceId == null || fragranceId.innerText === '') {
        alert("Could not retrieve the fragrance id!");
        return false;
    }

    let fragranceIdText = fragranceId.innerText;
    let fragranceIdArray = [fragranceIdText];
    let costElement = shoppingCartTextElem.getElementsByClassName('shoppingCartCost')[0];
    let cost = parseInt(costElement.innerText.replace(" RON", ""));
    let quantityAmountElement = shoppingCartTextElem.getElementsByClassName("shoppingCartNumber")[0];
    let quantityAmount = parseInt(quantityAmountElement.innerHTML.replace("No. of items: ", ""));
    let quantityAmountArray = [quantityAmount];

    let costString = cost.toString();
    let costArray = [costString];

    let xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    let fragranceJson = JSON.stringify(fragranceIdArray);
    let quantityJson = JSON.stringify(fragranceQuantityOption);
    let quantityAmountJson = JSON.stringify(quantityAmountArray);
    let costJson = JSON.stringify(costArray);

    xmlhttp.open("POST", "../../backend/utils/shoppingCartRelated/AddToCart.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            return true;
        }
    };

    xmlhttp.send("&fragranceCartId=" + fragranceJson +
        "&fragranceCartOption=" + quantityJson +
        "&amountCart=" + quantityAmountJson +
        "&costCart=" + costJson);
}

function updateQuantity() {
    let value = [];
    let numberOfElem = Object.keys(document.getElementsByClassName("shoppingCartText")).length;
    for (let elem = 0; elem < numberOfElem; elem++) {
        let newItemCountElem = document.getElementsByClassName('quantity-amount-' + elem)[0];
        let newItemCount = parseInt(newItemCountElem.value);
        let shoppingCartTextElem = newItemCountElem.parentElement.parentElement.parentElement
            .getElementsByClassName("shoppingCartText")[0];

        let itemCountElements = shoppingCartTextElem.getElementsByClassName('shoppingCartNumber');
        let itemCountElement = itemCountElements[0];
        let oldItemCount = parseInt(itemCountElement.innerHTML.replace("No. of items: ", ""));
        let costElements = shoppingCartTextElem.getElementsByClassName('shoppingCartCost');
        let costElement = costElements[0];
        let cost = parseInt(costElement.innerHTML.replace(" RON", ""));

        costElement.innerHTML = (cost / oldItemCount * newItemCount).toString() + " RON";
        itemCountElement.innerHTML = "No. of items: " + newItemCount.toString();

        updateCart(shoppingCartTextElem, elem);
    }
    setTotalCost();
}


function deleteFromCart(id) {
    let deleteElement = document.getElementById(id).parentElement;
    console.log(deleteElement);
    let perfumeId = [deleteElement.getElementsByClassName('fragranceShoppingCartId')[0].innerText];
    let commandId = [deleteElement.getElementsByClassName('shoppingCartCommandId')[0].innerText];
    let quantity = [deleteElement.getElementsByClassName('shoppingCartNumber')[0].innerText
        .replace("No. of items: ", "")];
    let cost = [deleteElement.getElementsByClassName('shoppingCartCost')[0].innerText
        .replace(" RON", "")];

    let xmlhttp;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/shoppingCartRelated/EraseFromCart.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
        }
    };

    let perfumeIdJson = JSON.stringify(perfumeId);
    let commandIdJson = JSON.stringify(commandId);
    let quantityJson = JSON.stringify(quantity);
    let costJson = JSON.stringify(cost);


    xmlhttp.send("&fragranceId=" + perfumeIdJson +
        "&fragranceCommandId=" + commandIdJson +
        "&fragranceQuantity=" + quantityJson +
        "&costCart=" + costJson);

    setTotalCost();

    window.location = "PerfumerShoppingCart.php";
}

function getClearanceSales() {
    let xmlhttp;
    let fragranceArray = [];
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/GetClearanceSales.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let theParent = document.getElementById('clearanceSalesGrid');
            const response = JSON.parse(this.responseText);
            const size = Object.keys(response).length;

            console.log(this.responseText);
            for (let fragrance = 0; fragrance < size; fragrance++) {
                generateHTML(theParent, response, fragrance);
            }
        }
    };

    xmlhttp.send();
}

function getOurRecommendation() {
    let xmlhttp;
    let fragranceArray = [];
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/GetOurRecommendation.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let theParent = document.getElementById('ourRecommendationGrid');
            const response = JSON.parse(this.responseText);
            const size = Object.keys(response).length;
            for (let fragrance = 0; fragrance < size; fragrance++) {
                generateHTML(theParent, response, fragrance);
            }
        }
    };

    xmlhttp.send();
}

function getSpecificPerfumeFunctions() {
    getResemblingFragrances();
    getNewestReleases();
}

function getNewestReleases() {
    let xmlhttp;
    let fragranceArray = [];
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    let oDate = null;
    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/GetNewestReleases.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // console.log(this.responseText);
            let theParent = document.getElementById('newestReleasesGrid');
            const response = JSON.parse(this.responseText);
            const size = Object.keys(response).length;

            for (let fragrance = 0; fragrance < size; fragrance++) {
                generateHTML(theParent, response, fragrance);
                let grid = document.getElementsByClassName('fragranceGrid')[fragrance];
                oDate = document.createElement("p");
                oDate.setAttribute('id', 'fragranceDate');
                oDate.setAttribute('name', 'fragranceDate');
                oDate.setAttribute('style', 'font-size: 14px');
                oDate.innerHTML = "Launched on: " + response[fragrance]['DATA_LANSARE'];
                grid.appendChild(oDate);

                oDate = document.createElement("p");
                oDate.setAttribute('id', 'fragranceGender');
                oDate.setAttribute('name', 'fragranceGender');
                oDate.setAttribute('style', 'font-size: 14px');
                if (response[fragrance]['SEX'] === '1') {
                    oDate.innerHTML = 'Male';
                } else {
                    oDate.innerHTML = 'Female';
                }
                grid.appendChild(oDate);
            }
        }
    };

    xmlhttp.send();
}

function getYouMightLike() {
    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/GetYouMightLike.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            if (this.responseText !== '') {
                let theParent = document.getElementById('youMighLikeGrid');
                const response = JSON.parse(this.responseText);
                const size = Object.keys(response).length;
                for (let fragrance = 0; fragrance < size; fragrance++) {
                    generateHTML(theParent, response, fragrance);
                }
            }

        }
    };

    xmlhttp.send();
}

function getResemblingFragrances() {
    let fragranceTextElement = document.getElementsByClassName('specificPerfumeText');
    let fragranceIdElement = fragranceTextElement[0].getElementsByClassName('fragranceId')[0];
    let fragranceId = fragranceIdElement.innerHTML;

    let fragranceIdArray = [fragranceId];
    let fragranceIdJson = JSON.stringify(fragranceIdArray);

    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/GetResemblingFragrances.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText !== '') {
                let theParent = document.getElementById('resemblingFragranceGrid');
                const response = JSON.parse(this.responseText);
                const size = Object.keys(response).length;
                for (let fragrance = 0; fragrance < size; fragrance++) {
                    generateHTML(theParent, response, fragrance);
                }
            }

        }
    };

    xmlhttp.send('&fragranceId=' + fragranceIdJson);
}

function loadMultiple() {

    getNewestReleases();
    getOurRecommendation();
    getYouMightLike();
}

function getFragrancesByName() {

    let ourRecommendation = document.getElementById('ourRecommendationWrapper');
    if (ourRecommendation != null) {
        ourRecommendation.parentNode.removeChild(ourRecommendation);
    }
    ourRecommendation = document.getElementById('ourRecommendation');
    if (ourRecommendation != null) {
        ourRecommendation.parentNode.removeChild(ourRecommendation);
    }

    let byName = document.getElementById('searchByNameWrapper');
    if (byName != null) {
        byName.parentNode.removeChild(byName);
    }

    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/fragrancesRelated/FilterByName.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    let nameElement = document.getElementById('byNameSearch');
    let name = nameElement.value;

    let lt = /</g,
        gt = />/g,
        ap = /'/g,
        ic = /"/g;

    name = name.toString().replace(lt, "&lt;").replace(gt, "&gt;").replace(ap, "&#39;").replace(ic, "&#34;").replace(" ", "");

    if (name.search("&lt;") !== -1 || name.search("&gt;") !== -1 ||
        name.search("&#39;") !== -1 || name.search("&#34;") !== -1) {
        alert("Invalid fragrance name");
        return false;
    }

    let nameJson = JSON.stringify([name]);

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText !== '') {
                let theParent = document.getElementById('fragranceNotToDelete');
                let wrapperReborn = document.createElement("div");

                wrapperReborn.setAttribute('class', 'searchByNameWrapper');
                wrapperReborn.setAttribute('name', 'searchByNameWrapper');
                wrapperReborn.setAttribute('id', 'searchByNameWrapper');


                let gridReborn = document.createElement("div");
                gridReborn.setAttribute('class', 'searchByNameGrid');
                gridReborn.setAttribute('name', 'searchByNameGrid');
                gridReborn.setAttribute('id', 'searchByNameGrid');
                wrapperReborn.appendChild(gridReborn);
                theParent.appendChild(wrapperReborn);

                theParent = document.getElementById('searchByNameGrid');
                const response = JSON.parse(this.responseText);
                const size = Object.keys(response).length;
                for (let fragrance = 0; fragrance < size; fragrance++) {
                    generateHTML(theParent, response, fragrance);
                }
            }

        }
    };

    xmlhttp.send("&fragranceName=" + nameJson);
}

function generateHTML(theParent, response, fragrance) {
    let oDiv;
    let oImg;
    let oTitle;
    let oBrand;
    let oPrice;
    let oNotes;
    let oId;

    //create the div class
    oDiv = document.createElement("div");
    oDiv.setAttribute('class', 'fragranceGrid');
    oDiv.setAttribute('name', 'fragranceGrid');
    oDiv.setAttribute('id', 'fragranceGrid');

    //create the img element and append it to the div class
    //console.log(response[fragrance]['POZA']);
    oImg = document.createElement("img");
    oImg.setAttribute('src', response[fragrance]['POZA']);
    oImg.setAttribute('height', '200');
    oImg.setAttribute('width', '200');
    oImg.setAttribute('class', 'centerFragrancePicture');
    oImg.addEventListener("click", sendToSpecificFragrance);
    oImg.setAttribute('id', 'fragranceImage');
    oImg.setAttribute('name', 'fragranceImage');
    oDiv.appendChild(oImg);

    //create the title element and append it to the div class
    oTitle = document.createElement("p");
    oTitle.setAttribute('id', 'fragranceTitle');
    oTitle.setAttribute('name', 'fragranceTitle');
    oTitle.innerHTML = response[fragrance]['NUME'];
    //oTitle.addEventListener("click", sendToSpecificFragrance);
    oDiv.appendChild(oTitle);

    //create the title element and append it to the div class
    oId = document.createElement("p");
    oId.innerHTML = response[fragrance]['ID'];
    oId.setAttribute('id', 'fragranceId');
    oId.setAttribute('name', 'fragranceId');
    oId.setAttribute('hidden', 'true');
    oDiv.appendChild(oId);

    //create the brand element and append it to the div class
    oBrand = document.createElement("p");
    oBrand.innerHTML = response[fragrance]['BRAND'];
    oBrand.setAttribute('id', 'fragranceBrand');
    oBrand.setAttribute('name', 'fragranceBrand');
    oDiv.appendChild(oBrand);

    //create the notes element and append it to the div class
    oNotes = document.createElement("p");
    oNotes.innerHTML = response[fragrance]['NOTE'];
    oNotes.setAttribute('id', 'fragranceNotes');
    oNotes.setAttribute('name', 'fragranceNotes');
    oDiv.appendChild(oNotes);

    //create the price element and append it to the div class
    oPrice = document.createElement("p");
    oPrice.innerHTML = response[fragrance]['PRET'] + " RON";
    oPrice.setAttribute('id', 'fragrancePrice');
    oPrice.setAttribute('name', 'fragrancePrice');
    oDiv.appendChild(oPrice);

    theParent.appendChild(oDiv);
}

function getUserCommnds() {
    let userEmailElement = document.getElementById('userEmail');
    let userEmail = userEmailElement.innerText;
    let userEmailJson = JSON.stringify([userEmail]);

    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/commandRelated/GetUserCommands.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText !== '') {
                const response = JSON.parse(this.responseText);
                const size = Object.keys(response).length;
                let theParent = document.getElementById('myCommandsWrapper');
                for (let command = 0; command < size; command++) {
                    generateCommandHTML(response, command, theParent);
                }
            }

        }
    };

    xmlhttp.send("&userEmail=" + userEmailJson);
}

function finishCommand() {
    if (!confirm("Are you sure you want to finish the command?")) {
        return false;
    }

    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../backend/utils/commandRelated/CartToCommand.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            if (this.responseText !== '') {
                if (this.responseText === '1') {
                    alert("Command sent! Thank you!");
                    window.location = "PerfumerIndex.php";
                }
            } else {
                alert("Sending command failed. Please try again later");
            }
        }
    };

    xmlhttp.send();
}

function setTotalCost() {
    let costElement = document.getElementById('totalCostH2');
    if (costElement === null) {
        return false;
    }
    let textWrappers = document.getElementsByClassName('shoppingCartTextWrapper');
    let totalCost = 0;

    for (let textWrapper = 0; textWrapper < Object.keys(textWrappers).length; textWrapper++) {
        let costElements = textWrappers[textWrapper].getElementsByClassName('shoppingCartCost');
        if (costElements === null) {
            alert("Something went wrong. Please refresh");
            return false;
        }

        if (costElements[0].innerText === '') {
            alert("Couldn't retrieve the price. Please refresh");
            return false;
        }

        let cost = parseInt(costElements[0].innerText.replace(" RON", ""));
        totalCost += cost;
    }

    costElement.innerText = totalCost.toString();
}

function generateCommandHTML(response, command, theParent) {
    let oDiv;
    let oTitle;
    let oBrand;
    let oNotes;
    let oId;
    let oCost;
    let oCommandDate;
    let oCommandId;
    let oCommandStatus;

    //create the div class
    oDiv = document.createElement("div");
    oDiv.setAttribute('class', 'perfumeData');
    oDiv.setAttribute('name', 'perfumeData');
    oDiv.setAttribute('id', 'perfumeData');

    //create the price element and append it to the div class
    oCommandId = document.createElement("p");
    oCommandId.innerHTML = "Command Id: " + response[command]['ID_COMANDA'];
    oCommandId.setAttribute('id', 'commandDate');
    oCommandId.setAttribute('name', 'commandDate');
    oDiv.appendChild(oCommandId);

    oId = document.createElement("p");
    oId.innerHTML = response[command]['ID'];
    oId.setAttribute('id', 'fragranceId');
    oId.setAttribute('name', 'fragranceId');
    oId.setAttribute('hidden', 'true');
    oDiv.appendChild(oId);

    //create the title element and append it to the div class
    oTitle = document.createElement("p");
    oTitle.setAttribute('id', 'fragranceTitle');
    oTitle.setAttribute('name', 'fragranceTitle');
    oTitle.innerHTML = "TITLE: " + response[command]['NUME'];
    oTitle.addEventListener("click", sendToSpecificFragrance);
    oDiv.appendChild(oTitle);


    //create the brand element and append it to the div class
    oBrand = document.createElement("p");
    oBrand.innerHTML = "BRAND: " + response[command]['BRAND'];
    oBrand.setAttribute('id', 'fragranceBrand');
    oBrand.setAttribute('name', 'fragranceBrand');
    oDiv.appendChild(oBrand);
    //

    //create the notes element and append it to the div class
    oNotes = document.createElement("p");
    oNotes.innerHTML = "NOTES: " + response[command]['NOTE'];
    oNotes.setAttribute('id', 'fragranceNotes');
    oNotes.setAttribute('name', 'fragranceNotes');
    oDiv.appendChild(oNotes);

    //create the price element and append it to the div class
    oCost = document.createElement("p");
    oCost.innerHTML = "PRICE: " + response[command]['COST'] + " RON";
    oCost.setAttribute('id', 'commandCost');
    oCost.setAttribute('name', 'commandCost');
    oDiv.appendChild(oCost);


    //create the price element and append it to the div class
    oCommandDate = document.createElement("p");
    oCommandDate.innerHTML = "DATE: " + response[command]['DATA_COMANDA'];
    oCommandDate.setAttribute('id', 'commandDate');
    oCommandDate.setAttribute('name', 'commandDate');
    oDiv.appendChild(oCommandDate);

    //create the price element and append it to the div class
    oCommandStatus = document.createElement("p");
    oCommandStatus.innerHTML = "DATE: " + response[command]['STARE'];
    oCommandStatus.setAttribute('id', 'commandDate');
    oCommandStatus.setAttribute('name', 'commandDate');
    oDiv.appendChild(oCommandStatus);

    let dellimiter = document.createElement("br");
    let delimiter1 = document.createElement("p");
    delimiter1.innerText = "----------------------------------------";
    oDiv.appendChild(delimiter1);
    oDiv.appendChild(dellimiter);
    theParent.appendChild(oDiv);
}

function onLoadShoppingCart() {
    setTotalCost();
    getNewestReleases();
}