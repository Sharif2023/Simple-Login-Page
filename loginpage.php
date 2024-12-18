<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        /* General styles */
        body {
            background: #f7f7f7;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 0 15px;
        }

        .panel {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .panel-primary {
            border-color: #ff6600;
        }

        .panel-heading {
            background: #ff6600;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 24px;
        }

        .panel-body {
            padding: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #ff6600;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none; /* Remove underline */
            margin: 8px; /* Add margin for spacing */
            font-size: 16px;
            text-align: center;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background: #e65c00;
            transform: scale(1.05);
        }

        .btn-danger {
            background: #d9534f;
        }

        .btn-danger:hover {
            background: #c9302c;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        /* Popup styles */
        #updatePopup, #deletePopup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 80%;
            max-width: 400px;
        }

        #popupOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form button {
            margin-top: 10px;
        }

        .error {
            color: red;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1>Home Page</h1>
            </div>
            <div class="panel-body">
                <form id="searchForm" action="search.php" method="get">
                    <input type="text" name="search" placeholder="Search by name..." required>
                    <button type="submit" class="btn">Search</button>
                </form>

                <div class="button-container">
                    <a href="demologinpage.php" class="btn">Sign Up</a>
                    <button type="button" class="btn" onclick="showUpdatePopup()">Update</button>
                    <a href="view_data.php" class="btn">View All Users</a>
                    <button type="button" class="btn btn-danger" onclick="showDeletePopup()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup for updating -->
    <div id="popupOverlay"></div>
    <div id="updatePopup">
        <form id="updateForm" action="verify_update.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit" class="btn">Verify</button>
            <button type="button" class="btn" onclick="hideUpdatePopup()">Cancel</button>
        </form>
    </div>

    <!-- Popup for deleting -->
    <div id="deletePopup">
        <form id="deleteForm" action="delete_user.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="deleteEmail" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="deletePassword" required>
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="button" class="btn" onclick="hideDeletePopup()">Cancel</button>
        </form>
    </div>

    <script>
        function showUpdatePopup() {
            document.getElementById('updatePopup').style.display = 'block';
            document.getElementById('popupOverlay').style.display = 'block';
        }

        function hideUpdatePopup() {
            document.getElementById('updatePopup').style.display = 'none';
            document.getElementById('popupOverlay').style.display = 'none';
        }

        function showDeletePopup() {
            document.getElementById('deletePopup').style.display = 'block';
            document.getElementById('popupOverlay').style.display = 'block';
        }

        function hideDeletePopup() {
            document.getElementById('deletePopup').style.display = 'none';
            document.getElementById('popupOverlay').style.display = 'none';
        }
    </script>
</body>
</html>
