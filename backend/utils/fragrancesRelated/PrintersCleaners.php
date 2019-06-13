<?php
error_reporting(0);
function cleanModel(PerfumeModel &$perfumeModel)
{
    $text = str_replace("\u0026amp;", "&", $perfumeModel->getName());
    $perfumeModel->setName($text);
    $text = str_replace("\u0027", "'", $perfumeModel->getName());
    $perfumeModel->setName($text);

    $text = str_replace("\u0026amp;", "&", $perfumeModel->getBrand());
    $perfumeModel->setBrand($text);
    $text = str_replace("\u0027", "'", $perfumeModel->getBrand());
    $perfumeModel->setBrand($text);
}

function printShoppingCart($fragranceArray)
{
    $perfumeModel = new PerfumeModel();
    $perfumeController = new PerfumeController();
    $perfumeWrapperArray = array();
    $id = 0;
    if ($fragranceArray != false)
    {
        foreach ($fragranceArray as $row)
        {
            $fragranceArray = $perfumeController->getSingleSpecificFragrance($row['ID']);
            $perfumeModel->setModel($fragranceArray);
            cleanModel($perfumeModel);

            array_push($perfumeWrapperArray,
                "<div class=\"shoppingCartFragrance\">" .
                "<div class=\"shoppingCartImageWrapper\" id=\"shoppingCartImageWrapper\"> " .
                "<img src=\"" . $perfumeModel->getPicture() . "\" alt=\"fragrance picture\" 
                                class=\"shoppingCartPicture\">" .
                "<div class=\"quantityWrapper\">
                                <button type=\"button\" class=\"minusButton\" onclick=\"decrementShopCart(this.id)\" 
                                    id=\"button-quantity-amount-" . $id . "\">-</button>
                                <input style=\"width: 40px; text-align: center;font-size: 20px;\" type=\"text\" class=\"quantity-amount-" . $id . "\" 
                                    id=\"quantity-amount-" . $id . "\" value=\"" . $row['CANTITATE'] . "\" readonly/>
                               <button type=\"button\" class=\"minusButton\" onclick=\"incrementShopCart(this.id)\" 
                                    id=\"button+quantity-amount-" . $id . "\">+</button>" .
                "</div>" .
                "</div>" .
                "<div class=\"shoppingCartTextWrapper\" id=\"shoppingCartTextWrapper\">" .
                "<div class=\"shoppingCartText\" id=\"shoppingCartText\"> " .
                "<button type=\"button\" class=\"deleteFromCart\" id=\"deleteFromCart-" . $id .
                "\"onclick=\"deleteFromCart(this.id)\">X</button>" .
                "<p class=\"shoppingCartTitle\" id=\"shoppingCartTitle\">Name: " .
                $perfumeModel->getName() . "</p>" .
                "<p class=\"shoppingCartBrand\" id=\"shoppingCartBrand\">Brand: " .
                $perfumeModel->getBrand() . "</p>" .
                "<p class=\"fragranceShoppingCartId\" id=\"fragranceShoppingCartId\" hidden>" .
                $row['ID'] . "</p>" .
                "<p class=\"shoppingCartCommandId\" id=\"shoppingCartCommandId\" hidden>" .
                $row['ID_COMANDA'] . "</p>" .
                "<p class=\"shoppingCartCost\" id=\"shoppingCartCost\">" . $row['COST'] . " RON</p>" .
                "<p class=\"shoppingCartNumber\" id=\"shoppingCartNumber\">No. of items: " .
                $row['CANTITATE'] . "</p>" .
                "<p class=\"shoppingCartQuantity\" id=\"shoppingCartQuantity\">Quantity: " .
                $perfumeModel->getQuantity() . "</p>" .
                "</div>" .
                "</div>" .
                "</div>" .
                "<br>");
            $id++;
        }

        if (sizeof($fragranceArray) === 0)
        {
            array_push($perfumeWrapperArray, "<h3>Your shopping cart is empty!</h3>");
        }
    }
    return implode("\n", $perfumeWrapperArray);
}