<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Applications</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-view {
            background-color: #3498db;
            color: white;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }
        .search-bar input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
        }
        .search-bar button {
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .add-new {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Freelancer Applications</h1>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Search applications...">
            <button>Search</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="contents">
                <!-- <tr>
                    <td>1</td>
                    <td>John Smith</td>
                    <td>john.smith@example.com</td>
                    <td>+1 234-567-8901</td>
                    <td>123 Main St, New York, NY 10001</td>
                    <td class="actions">
                        <a href="#" class="btn btn-view">View</a>
                        <a href="#" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Emily Johnson</td>
                    <td>emily.j@example.com</td>
                    <td>+1 987-654-3210</td>
                    <td>456 Oak Ave, San Francisco, CA 94102</td>
                    <td class="actions">
                        <a href="#" class="btn btn-view">View</a>
                        <a href="#" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Michael Brown</td>
                    <td>michael.b@example.com</td>
                    <td>+1 555-123-4567</td>
                    <td>789 Pine Rd, Chicago, IL 60601</td>
                    <td class="actions">
                        <a href="#" class="btn btn-view">View</a>
                        <a href="#" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Sarah Miller</td>
                    <td>sarah.m@example.com</td>
                    <td>+1 444-555-6666</td>
                    <td>321 Cedar Ln, Seattle, WA 98101</td>
                    <td class="actions">
                        <a href="#" class="btn btn-view">View</a>
                        <a href="#" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>David Wilson</td>
                    <td>david.w@example.com</td>
                    <td>+1 777-888-9999</td>
                    <td>654 Birch St, Austin, TX 78701</td>
                    <td class="actions">
                        <a href="#" class="btn btn-view">View</a>
                        <a href="#" class="btn btn-delete">Delete</a>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
    <script src="../js/applicationTable.js"></script>
</body>
</html>