<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        th {
            background-color: #f8f8f8;
            font-weight: 600;
            color: #333;
        }
        
        tr:hover {
            background-color: #f5f7fa;
        }
        
        .delete-btn {
            background-color: transparent;
            border: none;
            color: #ff4d4d;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
        }
        
        .delete-btn:hover {
            background-color: #fff1f1;
        }
        
        .actions-cell {
            text-align: center;
        }
        
        .project-details {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .project-details:hover {
            white-space: normal;
            overflow: visible;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payroll Management</h1>
        
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
                <tr>
                    <td>Earl Kian Bancayrin</td>
                    <td>Payroll Management</td>
                    <td class="project-details">Develop a comprehensive payroll management system with automated tax calculations and employee portal.</td>
                    <td>05/31/2025</td>
                    <td>$100 (USD)</td>
                    <td class="actions-cell">
                        <button class="delete-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Charles Dominic Guevarra</td>
                    <td>Employee Management</td>
                    <td class="project-details">Create an employee management system with attendance tracking and performance evaluation tools.</td>
                    <td>06/15/2025</td>
                    <td>$150 (USD)</td>
                    <td class="actions-cell">
                        <button class="delete-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Amani Uri</td>
                    <td>Financial Analysis</td>
                    <td class="project-details">Develop financial analysis dashboard with reporting tools and predictive analytics.</td>
                    <td>05/20/2025</td>
                    <td>$100 (USD)</td>
                    <td class="actions-cell">
                        <button class="delete-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="../js/buyTable.js"></script>
</body>
</html>