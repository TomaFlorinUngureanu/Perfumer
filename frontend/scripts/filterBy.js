function loadXMLDoc()
{
    var xmlhttp;
    var brandsArray = ["Avon", "Calvin Klein", "Versace"];
    var occasion = ["Work"];
    var seasonOpt = ["Summer"];
    var noteOpt = ["Aquatic"];
    var price = ["1539"];
    var genderArray = ["male"];

    if (window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    }
    else
    {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST","../../backend/utils/PerfumeGetter.php",true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function()
    {
        if(this.readyState === 4 && this.status === 200)
        {
            const response = JSON.parse(this.responseText);
            const size = Object.keys(response).length;
            const wrapper = document.getElementById("fragranceGridWrapper");
            let oDiv = null;
            let oImg = null;
            let oTitle = null;
            let oBrand = null;
            let oPrice = null;
            let oNotes = null;

            for(let i = 0; i < size; i++)
            {
                //create the div class
                oDiv = document.createElement("div");
                oDiv.setAttribute('class', 'fragranceGrid');
                console.log(oDiv);

                //create the img element and append it to the div class
                oImg = document.createElement("img");
                oImg.setAttribute('src', response[i]['POZA'] );
                oImg.setAttribute('height', '200');
                oImg.setAttribute('width', '200');
                oImg.setAttribute('class','centerFragrancePicture');
                oDiv.appendChild(oImg);

                //create the title element and append it to the div class
                oTitle = document.createElement("p");
                oTitle.innerHTML = response[i]['NUME'];
                oDiv.appendChild(oTitle);

                //create the brand element and append it to the div class
                oBrand = document.createElement("p");
                oBrand.innerHTML = response[i]['BRAND'];
                oDiv.appendChild(oBrand);

                //create the notes element and append it to the div class
                oNotes = document.createElement("p");
                oNotes.innerHTML = response[i]['NOTE'];
                oDiv.appendChild(oNotes);

                //create the price element and append it to the div class
                oPrice = document.createElement("p");
                oPrice.innerHTML = response[i]['PRET'] + " RON";
                oDiv.appendChild(oPrice);

                console.log(wrapper);
                wrapper.appendChild(oDiv);
            }
        }
    };

    xmlhttp.send( "&occasions=" + JSON.stringify(occasion) +
        "&seasons=" + JSON.stringify(seasonOpt) +
        "&myRange=" + JSON.stringify(price) + "&genders=" + JSON.stringify(genderArray));
}