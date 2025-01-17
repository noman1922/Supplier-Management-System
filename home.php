<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>Supplier Management System</h1>
        <div class="nav">
            <a href="home.php">Home</a>
            <div class="dropdown">
                <a href="javascript:void(0)">Insert &#9662;</a> <!-- Dropdown sign -->
                <div class="dropdown-content">
                    <a href="insert_supplier.php">Insert Supplier</a>
                    <a href="insert_product.php">Insert Product</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0)">View &#9662;</a> <!-- Dropdown sign -->
                <div class="dropdown-content">
                    <a href="view_supplier.php">View Supplier</a>
                    <a href="view_product.php">View Product</a>
                </div>
            </div>
            <a href="search.php">Search</a>
            <a href="report.php">Report</a>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="main-content">
        <h2>Welcome to the Dashboard</h2>
        <p>From here, you can manage stocks, suppliers, and view the stock overview. Use the navigation above to access different sections.</p>

        <h3>About Us</h3>
        <p>We are dedicated to providing the best supplier management solutions. Our system is designed to streamline the process of managing suppliers and stocks, ensuring efficiency and reliability.</p>

        <h3>Types of Products</h3>
        <p>We manage a wide range of products from our suppliers, including:</p>
        <ul>
            <li>Electronics</li>
            <li>Furniture</li>
            <li>Apparel</li>
            <li>Food and Beverages</li>
            <li>Office Supplies</li>
        </ul>

        <h3>Process</h3>
        <p>Our supplier management system follows a streamlined process:</p>
        <ol>
            <li>Supplier Registration: Suppliers register and provide their product catalogs.</li>
            <li>Product Listing: Products are listed and categorized in our system.</li>
            <li>Order Placement: Orders are placed through our system based on inventory needs.</li>
            <li>Order Tracking: Track orders in real-time from placement to delivery.</li>
            <li>Inventory Management: Maintain optimal inventory levels with automated restocking.</li>
            <li>Reporting and Analysis: Generate detailed reports for better decision-making.</li>
        </ol>

        <h3>Functionality Ideas</h3>
        <p>Our system offers a variety of functions to ensure smooth operations:</p>
        <ul>
            <li><strong>Search:</strong> Quickly find suppliers, products, and orders.</li>
            <li><strong>Reports:</strong> Generate comprehensive reports on supplier performance, order history, and inventory levels.</li>
            <li><strong>Alerts:</strong> Receive notifications for low stock levels, pending orders, and supplier updates.</li>
            <li><strong>Integration:</strong> Seamlessly integrate with accounting and CRM systems for end-to-end management.</li>
            <li><strong>Support:</strong> Access customer support for any queries or issues.</li>
        </ul>

        <h3>Contact Details</h3>
        <p>If you have any questions or need assistance, feel free to reach out to us:</p>
        <p>Email: support@suppliermanagement.com</p>
        <p>Phone: +880 1234-567890</p>
        <p>Address: 123 Supplier Lane, Dhaka, Bangladesh 1212</p>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan,Sec:'B', ID-23103052.</p>
    </div>
</body>
</html>
