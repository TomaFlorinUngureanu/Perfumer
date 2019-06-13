function createReport(typeOfReport) {
    let type;
    switch (typeOfReport) {
        case  'html' : {
            type = 'HtmlReport.php';
            break;
        }
        case 'pdf' : {
            type = 'PdfReport.php';
            break;
        }

        case 'csv' : {
            type = 'CsvReport.php';
            break;
        }

        default: {
            return false;
        }
    }

    let notes = selectedElements('notes');
    let seasons = selectedElements('seasons');
    let occasions = selectedElements('occasions');
    let byStockElement = document.getElementById('byStock');
    let emailAddressElement = document.getElementById('emailAddress');
    let fromDateElement = document.getElementById('fromDate');
    let toDateElement = document.getElementById('toDate');
    let rowLimitElement = document.getElementById('inputRowLimit');

    let rowLimit = rowLimitElement.value;
    let rowLimitInt;

    if (parseInt(rowLimit)) {
        rowLimitInt = parseInt(rowLimit);
    } else {
        alert("Invalid row number. Try again!");
        return false;
    }

    let rowLimitJson = JSON.stringify([rowLimitInt]);
    let notesJson = JSON.stringify(notes);
    let seasonsJson = JSON.stringify(seasons);
    let occasionsJson = JSON.stringify(occasions);
    let byStockJson;
    if (byStockElement.checked !== false) {
        byStockJson = JSON.stringify([byStockElement.checked]);
    } else {
        byStockJson = JSON.stringify([]);
    }
    let emailJson = JSON.stringify([emailAddressElement.innerText]);

    const months = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    let date = new Date(fromDateElement.value);
    //console.log(date);
    //console.log(date.getDate());
    let fromDate = date.getDate() + '-' + months[date.getMonth()] + '-' + date.getFullYear().toString().replace("20", "");

    date = new Date(toDateElement.value);
    //console.log(date);
    let toDate = date.getDate() + '-' + months[date.getMonth()] + '-' + date.getFullYear().toString().replace("20", "");

    let fromDateJson = JSON.stringify([fromDate]);
    let toDateJson = JSON.stringify([toDate]);

    //console.log(fromDateJson);
    // console.log(toDateJson);

    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "../../../backend/utils/reportRelated/" + type, true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === '1') {
                alert(typeOfReport + " report created with success!");
            }
        }
    };

    xmlhttp.send("&note=" + notesJson + "&season=" + seasonsJson + "&occasion=" + occasionsJson +
        "&byStock=" + byStockJson + "&userEmail=" + emailJson + "&date1=" + fromDateJson + "&date2=" + toDateJson +
        "&rowLimit=" + rowLimitJson);

}