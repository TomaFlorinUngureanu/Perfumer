<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<html>

<head>
    <link rel="stylesheet" type="text/css" href="..\styles\PerfumerParfumStyles.css">
</head>

<body>

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="..\images\logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Le petit parfum</h1>
    <p>Develop your taste</p>
</div>
<div class="topnav">
    <a href="PerfumerIndex.php">Home</a>
    <a href="PerfumerPromo.php">Promo</a>
    <a href="PerfumerFragrances.php">Fragrances</a>
    <div class="dropdown">
        <button class="dropbtn">Brands
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="#">Lancôme</a>
            <a href="#">Paco Rabanne</a>
            <a href="#">Hugo Boss</a>
            <a href="#">Versace</a>
            <a href="#">Armani</a>
            <a href="#">Calvin Klein</a>
            <a href="#">Chanel</a>
        </div>
    </div>
    <a href="#" style="float:right">Shopping Cart</a>
    <a href="../html/PerfumerLogin.html" style="float:right">Login</a>
    <a href="#" style="float:right">Contact</a>
    <div class="search-container">
        <form action="SearchAction.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="row">
    <div class="rightcolumn">
        <div class="card" style="position:relative">
            <h2>...</h2>
            <div class="priceCart">
                <div class="price" style="float:none;padding-bottom:2px;">
                    <h2 style="color:black;font-size: 26px;">...<br>...<br></h2>
                </div>
                <div class="cart" style="float:none">
                    <button class="substract-counter" style="height: 30px; width: 30px ">-</button>
                    <button class="add-counter" style="height: 30px; width: 30px"> +</button>
                    <a>Qty:</a>
                    <span class="click-text"><a id="clicks"></a></span>

                    <button style="height: 50px; width: 50px" type="submit"><i class="fa fa-shopping-cart"
                                                                               aria-hidden="true"></i></button>
                    <script src="..\scripts\counter.js"></script>
                </div>
            </div>
            <div class="image">
                <img src=""
                     style="width:300px;height:500px;display: block;margin-left: auto;margin-right: auto;">
            </div>
            <div class="about">
                <h3>About ...</h3>
                <a>...</a>
                <h3>...</h3>
                <ul type="square">
                    <li><a>...</a></li>
                    <li><a>...</a></li>
                    <li><a>...</a></li>
                    <li><a>...</a></li>
                    <li><a>...</a></li>
                </ul>
            </div>

        </div>
        <div class="card">
            <h3>Resembling fragrances</h3>
            <div class="fakeimg">
                <p>Image with Resembling fragrance #1 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with Resembling fragrance #2 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with Resembling fragrance #3 for men and women</p>
            </div>
            <div class="fakeimg">
                <p>Image with Resembling fragrance #4 for men and women</p>
            </div>
        </div>
    </div>
    <div class="leftcolumn">
        <div class="card">
            <h2>Other parfumes from the same brand</h2>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Notes of the fragrance #1.</p>
            <p>Some description of the fragrance #1.</p>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Notes of the fragrance #2.</p>
            <p>Some description of the fragrance #2.</p>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Notes of the fragrance #3.</p>
            <p>Some description of the fragrance #3.</p>
        </div>
    </div>
</div>

<div class="footer">
    <h2>Contact and authors</h2>
</div>

</body>

</html>