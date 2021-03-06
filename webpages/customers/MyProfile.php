<?php
    @include "../../configuration/session.php";
    include_once "../../classes/Customer.php";
    include_once "../../classes/User.php";
    include_once "../../classes/SqlFunctions.php";
    if(class_exists("User"))
    {
        $userObject = new User();
    }
    if(class_exists("Customer"))
    {
        $customerObject = new Customer();
    }
    if(class_exists("SqlFunctions"))
    {
        $sqlFunctions = new SqlFunctions();
    }
?>
<html>
    <head>
        <title>Shoe Store</title>
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <link rel="stylesheet" type="texut/css" href="../../css/slider.css">
        <link rel="stylesheet" type="text/css" href="../../css/smoothMenu.css">

        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/ddsmoothmenu.js"></script>
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
                    <div id="siteTitle"><h1><a href="../../index.php">AXI's sneakers</a></h1></div>
                    <div id="headerRight">
                        <?php
                            if(isset($_Session["loggedIn"]) && ($accType == "Customer"))
                            {
                                echo "<p>Hi, $name . ' '.$surname | <a href='../../webpages/shoppingcart.php'>My Cart</a> | <a href='../../webpages/checkout.php'>Checkout</a> | <a href='../../webpages/logout.php'>Logout</a></p>";
                            }
                            else if(isset($_Session["loggedIn"]) && ($accType == "Admin"))
                            {
                                echo "<p>Hi, $name| <a href='../../webpages/logout.php'>Logout</a></p>";
                            }
                            else
                            {
                                echo "<p><a href='../../webpages/login.php'>Log in</a> | <a href='../../webpages/register.php'>Register</a></p>";
                            }
                        ?>
                    </div>
                    <div class="cleaner"></div>
                </div> <!-- END Header -->

                <div id="menuBar">
                    <div id="topNav" class="smoothMenu">
                        <ul>
                            <li><a href="../../index.php">Home</a></li>
                            <li><a href="../products.php">Products</a></li>
                            <li><a href="../checkout.php">Checkout</a></li>
                            <?php
                                if(isset($_SESSION["loggedIn"]) && $accType == "Customer")
                                {
                                    echo "<li><a href='MyProfile.php'>My profile</a></li>";
                                }
                            ?>
                            <li><a href="../about.php">About</a></li>
                            <li><a href="../contact.php">Contact Us</a></li>
                        </ul>
                        <br style="clear: left" />
                    </div> <!-- end of topNav-->
                    <!-- We could use this to search for products -->
                    <div id="search">
                        <form action="../../webpages/searchresults.php" method="post">
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
                                            echo "<li class='first'><a href='MyProfile.php'>My Profile</a></li>";
                                            echo "<li><a href='../about.php'>About us</a></li>";
                                            echo "<li><a href='../faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='../contact.php'>Contact US</a></li>";
                                            echo "<li><a href='../exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='../privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='../shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                        else if(isset($_SESSION["loggedIn"]) && $accType == "Admin")
                                        {
                                            echo "<li class='first'><a href='../admin/reports/brandreport.php'>View Brands</a></li>";
                                            echo "<li><a href='../admin/reports/customerreport.php'>View Customers</a></li>";
                                            echo "<li><a href='../admin/reports/deliveriesreport.php'>View Deliveries</a></li>";
                                            echo "<li><a href='../admin/reports/departmentsreport.php'>View Departments</a></li>";
                                            echo "<li><a href='../admin/reports/distriburtorreport.php'>View Distributors</a></li>";
                                            echo "<li><a href='../admin/reports/orderhistory.php'>View Orders</a></li>";
                                            echo "<li><a href='../admin/reports/staffreport.php'>View Staff</a></li>";
                                            echo "<li><a href='../admin/reports/stockreport.php'>View Stock</a></li>";
                                            echo "<li><a href='../admin/reports/suppliersreport.php'>View Suppliers</a></li>";
                                            echo "<li class='last'><a href='../admin/reports/usersreport.php'>view Users</a></li>";
                                        }
                                        else if(!isset($_SESSION["loggedIn"]))
                                        {
                                            echo "<li class='first'><a href='../about.php'>About us</a></li>";
                                            echo "<li><a href='../faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='../contact.php'>Contact US</a></li>";
                                            echo "<li><a href='../exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='../privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='../shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END sidebar -->
                    <div id="content" class="floatRight">
                        <?php
                            echo "<h2>Personal Details</h2>";
                            echo "<p>First Name: ".$customerObject->getCustomerName()."</p>";
                            echo "<p>Surname: ".$customerObject->getCustomerSurname()."</p>";
                            echo "<p>Contact Number:".$customerObject->getContactNumber()."</p>";
                            echo "<h2>Login Details</h2>";
                            echo "<p>Username/Email Address: ".$userObject->getUserName()."</p>";
                            echo "<h2>Update Details</h2>";
                        ?>
                    </div> <!-- END content -->
                    <div class="cleaner"></div>
                </div> <!-- END main -->

                <div id="footer">
                    <p><a href="../../index.php">Home</a> | <a href="../../webpages/about.php">About</a> | <a href="../../webpages/faqs.php">FAQs</a> | <a href="../../webpages/contact.php">Contact Us</a></p>
                    Copyright © 2016 <a href="#">Shoe Store</a>
                </div> <!-- END of footer -->

            </div> <!-- END innerWrapper -->
        </div> <!-- END bodyWrapper -->
    </body>
</html>