function limitReports() {
    let notes = selectedElements('notes');
    let seasons = selectedElements('seasons');
    let occasions = selectedElements('occasions');
    let byStockElement = document.getElementById('byStock');
    let emailAddressElement = document.getElementById('emailAddress');
    let fromDateElement = document.getElementById('fromDate');
    let toDateElement = document.getElementById('toDate');

    let emailAddress = emailAddressElement.innerText;
    let fromDate = fromDateElement.value;
    let toDate = toDateElement.value;
    let byStock = byStockElement.checked;


    if(Object.keys(notes).length === 0 && Object.keys(notes).length === 0 && Object.keys(occasions).length === 0 && byStock === false
    && fromDate === '' && emailAddress === '' && toDate === '')
    {
        alert("Please select ONE criteria");
        return false;
    }

    if(Object.keys(notes).length === 1 && Object.keys(notes).length === 0 && Object.keys(occasions).length === 0 && byStock === false
        && fromDate === '' && emailAddress === '' && toDate === '')
    {

    }

    else if(Object.keys(seasons).length === 1 && Object.keys(occasions).length === 0 && byStock === false
        && fromDate === '' && emailAddress === '' && toDate === '' && Object.keys(notes).length === 0)
    {

    }

    else if(Object.keys(occasions).length === 1 && byStock === false
        && fromDate === '' && emailAddress === '' && toDate === '' && Object.keys(notes).length === 0  && Object.keys(seasons).length === 1)
    {

    }

    else if(byStock !== false && fromDate === '' && emailAddress === '' && toDate === ''
        && Object.keys(notes).length === 0  && Object.keys(notes).length === 0 && Object.keys(occasions).length === 0)
    {

    }

    else if(fromDate !== '' && toDate !== '' && emailAddress === '' &&
        byStock === false && Object.keys(notes).length === 0  && Object.keys(notes).length === 0 && Object.keys(occasions).length === 0)
    {

    }

    else if(emailAddress !== '' &&  byStock === false && Object.keys(notes).length === 0  && Object.keys(notes).length === 0 && Object.keys(occasions).length === 0
    && fromDate === '' && toDate === '')
    {

    }

    else
    {
        alert("Please select ONLY ONE criteria!");
        return false;
    }
}