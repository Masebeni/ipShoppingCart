<?php
    @include "../../../configuration/session.php";
    include_once "../../../classes/SqlFunctions.php";
    if(class_exists("SqlFunctions"))
    {
        $sqlFunctions = new SqlFunctions();
    }
    @include "../../../configuration/config.php";
?>
<html>
    <head>
        <title>Shoe Store</title>
        <link rel="stylesheet" type="text/css" href="../../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../../css/slider.css">
        <link rel="stylesheet" type="text/css" href="../../../css/smoothMenu.css">

        <script type="text/javascript" src="../../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../../js/ddsmoothmenu.js"></script>
        <script type="text/javascript">
            smoothMenu.init({
                mainmenuid: "topNav", //menu DIV id
                orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'smoothMenu', //class added to menu's outer DIV
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
            })
        </script>
    </head>
    <body>
        <div id="bodyWrapper">
            <div id="innerWrapper">
                <div id="header">
                    <div id="siteTitle"><h1><a href="../../../index.php">AXI's sneakers</a></h1></div>
                    <div id="headerRight">
                        <?php
                            if(isset($_Session["loggedIn"]) && $accType == "Customer")
                            {
                                echo "<p>Hi, $name . ' '.$surname | <a href='../../shoppingcart.php'>My Cart</a> | <a href='../../checkout.php'>Checkout</a> | <a href='../../logout.php'>Logout</a></p>";
                            }
                            else if(isset($_Session["loggedIn"]) && $accType == "Admin")
                            {
                                echo "<p>Hi, $name| <a href='../../logout.php'>Logout</a></p>";
                            }
                            else
                            {
                                echo "<p><a href='../../login.php'>Log in</a> | <a href='../../register.php'>Register</a></p>";
                            }
                        ?>
                    </div>
                    <div class="cleaner"></div>
                </div> <!-- END Header -->

                <div id="menuBar">
                    <div id="topNav" class="smoothMenu">
                        <ul>
                            <li><a href="../../../index.php">Home</a></li>
                            <li><a href="../../products.php">Products</a></li>
                            <li><a href="../../checkout.php">Checkout</a></li>
                            <?php
                                if(isset($_SESSION["loggedIn"]) && $accType == "Customer")
                                {
                                    echo "<li><a href='../../customers/MyProfile.php'>My profile</a></li>";
                                }
                            ?>
                            <li><a href="../../about.php">About</a></li>
                            <li><a href="../../contact.php">Contact Us</a></li>
                        </ul>
                        <br style="clear: left" />
                    </div> <!-- end of topNav-->
                    <!-- We could use this to search for products -->
                    <div id="search">
                        <form action="../../searchresults.php" method="post">
                            <input type="text" value=" " name="keyword" id="keyword" title="keyword"  class="txtSearch" />
                            <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="subBtn"  />
                        </form>
                    </div> <!-- END Search -->
                </div><!-- END menuBar -->

                <div id="main">
                    <div id="sidebar" class="floatLeft">
                        <div class="sidebarBox"><span class="bottom"></span>
                            <h3>Categories</h3>
                            <div class="content">
                                <ul class="sidebarList">
                                    <?php
                                        if(isset($_SESSION["loggedIn"]) & $accType == "Customer")
                                        {
                                            echo "<li class='first'><a href='../../customers/MyProfile.php'>My Profile</a></li>";
                                            echo "<li><a href='../../about.php'>About us</a></li>";
                                            echo "<li><a href='../../faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='../../contact.php'>Contact US</a></li>";
                                            echo "<li><a href='../../exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='../../privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='../../shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                        else if(isset($_SESSION["loggedIn"]) && $accType == "Admin")
                                        {
                                            echo "<li class='first'><a href='brandreport.php'>View Brands</a></li>";
                                            echo "<li><a href='customerreport.php'>View Customers</a></li>";
                                            echo "<li><a href='deliveriesreport.php'>View Deliveries</a></li>";
                                            echo "<li><a href='departmentsreport.php'>View Departments</a></li>";
                                            echo "<li><a href='distriburtorreport.php'>View Distributors</a></li>";
                                            echo "<li><a href='orderhistory.php'>View Orders</a></li>";
                                            echo "<li><a href='staffreport.php'>View Staff</a></li>";
                                            echo "<li><a href='stockreport.php'>View Stock</a></li>";
                                            echo "<li><a href='suppliersreport.php'>View Suppliers</a></li>";
                                            echo "<li class='last'><a href='usersreport.php'>view Users</a></li>";
                                        }
                                        else if(!isset($_SESSION["loggedIn"]))
                                        {
                                            echo "<li class='first'><a href='../../about.php'>About us</a></li>";
                                            echo "<li><a href='../../faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='../../contact.php'>Contact US</a></li>";
                                            echo "<li><a href='../../exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='../../privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='../../shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END sidebar -->

                    <div id="content" class="floatRight">
                        <?php
                            $sqlFunctions->departmentsReport($conn);
                        ?>
                    </div> <!-- END content -->
                    <div class="cleaner"></div>
                </div> <!-- END main -->

                <div id="footer">
                     <?php
                        echo"<p><a href='../../../index.php'>Home</a> | <a href='../../about.php'>About</a> | <a href='../../faqs.php'>FAQS</a> | <a href='../../contact.php'>Contact Us</a></p>";
                        echo "<p>Copyright © 2016 <a href='../../../index.php'>AXI's Sneakers</a></p>";
                    ?>
                </div> <!-- END of footer -->

            </div> <!-- END innerWrapper -->
        </div> <!-- END bodyWrapper -->
    </body>
</html>