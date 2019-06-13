function incrementValue()
{
    let  value = parseInt(document.getElementById('quantity-amount').value, 10);
    value = isNaN(value) ? 0 : value;

    let returnedStock = null;
    checkStock(function(returnedStock){
        if(value < returnedStock)
        {
            value++;
            document.getElementById('quantity-amount').value = value;
        }

        else
        {
            alert("Stock limit reached!");
        }

    },returnedStock);
}

function decrementValue()
{
    let value = parseInt(document.getElementById('quantity-amount').value, 10);
    value = isNaN(value) ? 0 : value;
    if(value > 1)
    {
        value--;
    }
    document.getElementById('quantity-amount').value = value;
}

function decrementShopCart(classId)
{
    let value = parseInt(document.getElementsByClassName(classId.replace("button-",""))[0].value, 10);
    value = isNaN(value) ? 0 : value;
    if(value > 1)
    {
        value--;
    }
    document.getElementsByClassName(classId.replace("button-",""))[0].value = value;
}

function incrementShopCart(classId)
{
    let value = parseInt(document.getElementById(classId.replace("button+","")).value, 10);
    value = isNaN(value) ? 0 : value;

    let returnedStock = null;
    checkStock(function(returnedStock){
        if(value < returnedStock)
        {
            value++;
            document.getElementById(classId.replace("button+","")).value = value;
        }

        else
        {
            alert("Stock limit reached!");
        }

    },returnedStock);
}

