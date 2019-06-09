<!DOCTYPE html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../styles/PerfumerFragrancesStyles.css">
</head>

<body>

<div class="header">
    <div style="display: flex; justify-content: center;">
        <img src="../images/logo.png" alt="Le petit parfum" style="width:180px;height:180px">
    </div>
    <h1>Search</h1>
</div>

<div class="topnav">
    <a href="../php/PerfumerIndex.php">Home</a>
    <a href="PerfumerPromo.html">Promo</a>
    <a href="PerfumerFragrances.html">Fragrances</a>
    <div class="dropdown">
        <button class="dropbtn">Brands
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="#">Lancome</a>
            <a href="#">Paco Rabanne</a>
            <a href="#">Hugo Boss</a>
            <a href="#">Versace</a>
            <a href="#">Armani</a>
            <a href="#">Calvin Klein</a>
            <a href="#">Chanel</a>
        </div>
    </div>
    <a href="#" style="float:right">Shopping Cart</a>
    <a href="PerfumerLogin.html" style="float:right">Login</a>
    <a href="#" style="float:right">Contact</a>
    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">Go!</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="leftcolumn" style="padding-bottom: 35px">
        <div class="card">
            <h2>Filters</h2>
            <h3>Price range:</h3>
            <div class="slidecontainer">
                <input type="range" min="100" max="1000" value="100" class="slider" id="myRange">
                <p>Max value: <span id="demo"></span></p>
                <script src="..\scripts\fragranceSliders.js">
                </script>
            </div>
            <h3>For who?</h3>
            <label class="container">Her
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="container">Him
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="container">Unisex
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
    <div class="rightcolumn">
        <div class="card">
            <div class="card">
                <h3>Results</h3>
                <div class="fakeimg">
                    <p>Image with perfume #1 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #2 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #3 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #4 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #5 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #6 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #7 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #8 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #9 + price, size in ml</p>
                </div>
                <div class="fakeimg">
                    <p>Image with perfume #10 + price, size in ml</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <h2>Contact and authors</h2>
    </div>

</body>

</html>