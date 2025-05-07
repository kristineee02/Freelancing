<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Table</title>
    <style>
        :root {
            --primary-color:rgb(208, 219, 52);
            --primary-dark:rgb(185, 182, 41);
            --danger-color: #e74c3c;
            --danger-hover: #c0392b;
            --text-primary: #2c3e50;
            --text-secondary: #7f8c8d;
            --bg-light: #f9f9f9;
            --border-color: #ecf0f1;
            --card-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 30px;
            background-color: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px;
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }
        
        h1 {
            color: var(--text-primary);
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
        }
        
        h1:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }
        
        th, td {
            padding: 16px 20px;
            text-align: left;
        }
        
        th {
            background-color: #f8fafb;
            font-weight: 600;
            color: var(--text-primary);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border-color);
        }
        
        td {
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
            font-size: 14px;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover {
            background-color: #f5f9ff;
            transition: background-color 0.2s ease;
        }
        
        .delete-btn {
            background-color: transparent;
            border: 1px solid var(--danger-color);
            color: var(--danger-color);
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .delete-btn:hover {
            background-color: var(--danger-color);
            color: white;
        }
        
        .actions-cell {
            text-align: center;
        }
        
        .project-details {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .project-details:hover {
            white-space: normal;
            overflow: visible;
            background-color: white;
            box-shadow: var(--card-shadow);
            padding: 12px;
            border-radius: 6px;
            z-index: 100;
            position: absolute;
            max-width: 300px;
        }
        
        .project-budget {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .target-date {
            color: var(--text-secondary);
            font-style: italic;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .container {
                padding: 15px;
            }
            
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            th, td {
                padding: 12px 15px;
            }
            
            .project-details {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Client Application</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Client's Name</th>
                    <th>Work Name</th>
                    <th>Project Details</th>
                    <th>Target Date</th>
                    <th>Project Budget</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="content">
               <!--js-->
            </tbody>
        </table>
    </div>
    <script src="../js/buyTable.js"></script>
</body>
</html>