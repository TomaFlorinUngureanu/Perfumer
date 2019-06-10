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
    let value = parseInt(document.getElementsByClassName(classId)[0].value, 10);
    value = isNaN(value) ? 0 : value;
    if(value > 1)
    {
        value--;
    }
    document.getElementsByClassName(classId)[0].value = value;
}

function incrementShopCare()
{
    let value = parseInt(document.getElementsByClassName(classId)[0].value, 10);
    value = isNaN(value) ? 0 : value;
    if(value > 1)
    {
        value--;
    }
    document.getElementsByClassName(classId)[0].value = value;
}

function updateQuantities()
{
    let value = [];
    let numberOfElem = document.getElementsByClassName("shoppingCartText").length;
    for(let elem = 0; elem < numberOfElem; elem++)
    {
        let quantityElem = document.getElementsByClassName('quantity-amount-' + elem)[0];
        let quantityParent = quantityElem.parentElement.parentElement.parentElement.
        getElementsByClassName("shoppingCartText")[0];

        //console.log(quantityParent);
        let fragranceName = quantityParent.getElementsByClassName("shoppingCartTitle")[0].innerHTML;
        fragranceName = fragranceName.replace("Name: ","");
        let fragranceBrand = quantityParent.getElementsByClassName("shoppingCartBrand")[0].innerHTML;
        fragranceBrand = fragranceBrand.replace("Brand: ","");
        let fragranceQuantity = quantityParent.getElementsByClassName("shoppingCartQuantity")[0].innerHTML;
        fragranceQuantity = fragranceQuantity.replace("Quantity: ","");
        let quantityText = quantityElem.value;

        console.log(fragranceName);
        console.log(fragranceBrand);
        console.log(fragranceQuantity);
        console.log(quantityText);
    }
}

