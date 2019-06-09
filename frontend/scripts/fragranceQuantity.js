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