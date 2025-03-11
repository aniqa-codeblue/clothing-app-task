<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Our products
        </title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nanum+Gothic:wght@400;700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
        {{-- <link href="product_gallery.css" rel="stylesheet"> --}}
        <style>
            body {
                font-family: "Barlow", sans-serif;
            }

            .container {
                display: flex;
            }

            .dashboard-nav {
                display: flex;
            }

            li {
                list-style: none;
                margin-right: 4rem;
            }

            a {
                text-decoration-line: none;
                color: black;
            }

            nav {
                display: flex;
                flex-grow: 1;
                justify-content: space-around;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <nav>
                Logo
            </nav>
            <nav>
                <ul class="dashboard-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </nav>
            <nav>Sign Up</nav>
        </div>
    </body>
</html>