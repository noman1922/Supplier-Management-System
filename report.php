<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management System Report</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: rgba(0, 0, 0, 0.7); /* Dark, semi-transparent background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        th, td {
            padding: 10px;
            border: 1px solid white;
            text-align: left;
        }
        th {
            background-color: #FFD700; /* Gold */
            color: black;
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.2);
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-container input[type="text"],
        .form-container select,
        .form-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 1em;
        }

        .form-container input[type="submit"] {
            background-color: #3498db;
            color: white;
            font-size: 1.2em;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .form-container p {
            color: #333;
        }

        .message {
            margin-top: 20px;
            color: green;
            font-size: 1.2em;
        }

        .container {
            margin-left: auto;
            margin-right: auto;
        }

        .print-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .print-button:hover {
            background-color: #2980b9;
        }

        /* Print Styles */
        @media print {
            table {
                width: 100%;
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            th, td {
                word-wrap: break-word;
            }
        }
    </style>
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

    <div class="container">
        <h2>Supplier, Product, and Transaction Report</h2>
        <?php 
        $conn = mysqli_connect("localhost", "root", "", "db_s"); 

        // LEFT JOIN to fetch all suppliers, including those without products or transactions
        $sql_report = "
            SELECT s.supplier_id, s.supplier_name, s.email, s.address, s.phone, s.other_info,
                   p.product_id, p.product_name, p.quantity, p.unit_price,
                   t.transaction_id, t.total_price, t.payment_method, t.transaction_date
            FROM suppliers s
            LEFT JOIN products p ON s.supplier_id = p.supplier_id
            LEFT JOIN transactions t ON s.supplier_id = t.supplier_id AND p.product_id = t.product_id
        ";
        $result_report = mysqli_query($conn, $sql_report);
        ?>

        <table>
            <tr>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Other Info</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Transaction ID</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Transaction Date</th>
            </tr>
            <?php
            if (mysqli_num_rows($result_report) > 0) {
                while ($row = mysqli_fetch_assoc($result_report)) {
                    echo "<tr>
                            <td>" . $row["supplier_id"] . "</td>
                            <td>" . $row["supplier_name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td>" . $row["phone"] . "</td>
                            <td>" . $row["other_info"] . "</td>
                            <td>" . ($row["product_id"] ?? 'N/A') . "</td>
                            <td>" . ($row["product_name"] ?? 'N/A') . "</td>
                            <td>" . ($row["quantity"] ?? 'N/A') . "</td>
                            <td>" . ($row["unit_price"] ?? 'N/A') . "</td>
                            <td>" . ($row["transaction_id"] ?? 'N/A') . "</td>
                            <td>" . ($row["total_price"] ?? 'N/A') . "</td>
                            <td>" . ($row["payment_method"] ?? 'N/A') . "</td>
                            <td>" . ($row["transaction_date"] ?? 'N/A') . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='14'>No records found.</td></tr>";
            }
            ?>
        </table>

        <button class="print-button" onclick="window.print()">Print</button>
    </div>

    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
