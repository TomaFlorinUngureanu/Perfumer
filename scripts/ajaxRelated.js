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

            //console.log(this.responseText);
            theParent = document.getElementById('fragranceNotToDelete');
            let wrapperReborn = document.createElement("div");

            wrapperReborn.setAttribute('class', 'fragranceGridWrapper');
            wrapperReborn.setAttribute('name', 'fragranceGridWrapper');
            wrapperReborn.setAttribute('id', 'fragranceGridWrapper');
            theParent.appendChild(wrapperReborn);

            console.log(this.responseText);
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
            }

            else
            {
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

    let shoppingCartInfo=document.getElementById('shoppingCartText');
    if(shoppingCartInfo !== null)
    {
        let fragranceIdElements = shoppingCartInfo.getElementsByClassName('fragranceShoppingCartId');
        if(fragranceIdElements !== null)
        {
            fragranceId = fragranceIdElements[0];
        }
    }
    else {
        fragranceId = document.getElementById('fragranceId');
    }

    if (fragranceId === null || fragranceId.innerHTML === '') {
        alert("Could not retrieve the fragrance id!");
        return false;
    }

    let fragranceIdText = fragranceId.innerText;

    let fragranceQuantity;
    if(shoppingCartInfo !== null)
    {
        fragranceQuantity = document.getElementById('shoppingCartQuantity');
    }
    else
    {
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
            return true;
        }
    };

    xmlhttp.send("&fragranceCartId=" + fragranceJson +
        "&fragranceCartOption=" + quantityJson +
        "&amountCart=" + quantityAmountJson +
        "&costCart=" + costJson);
}

function updateCart(shoppingCartTextElem, id)
{

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
    let cost = parseInt(costElement.innerText.replace(" RON",""));
    let quantityAmountElement = shoppingCartTextElem.getElementsByClassName("shoppingCartNumber")[0];
    let quantityAmount = parseInt(quantityAmountElement.innerHTML.replace("No. of items: ",""));
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
        let oldItemCount = parseInt(itemCountElement.innerHTML.replace("No. of items: ",""));
        let costElements = shoppingCartTextElem.getElementsByClassName('shoppingCartCost');
        let costElement = costElements[0];
        let cost = parseInt(costElement.innerHTML.replace(" RON",""));

        costElement.innerHTML = (cost / oldItemCount * newItemCount).toString() + " RON";
        itemCountElement.innerHTML = "No. of items: " + newItemCount.toString();

        updateCart(shoppingCartTextElem,elem);
    }
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

function getSpecificPerfumeFunctions()
{
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
    console.log(fragranceId);

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
            console.log(this.responseText);
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
