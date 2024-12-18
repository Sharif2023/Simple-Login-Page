<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <style>
        /* General styles */
        body {
            background: #f7f7f7;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Container styles */
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 0 15px;
        }

        /* Panel styles */
        .panel {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .panel-primary {
            border-color: #ff6600;
        }

        .panel-heading {
            background: #ff6600;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .panel-body {
            padding: 15px;
        }

        .panel-footer {
            background: #f7f7f7;
            padding: 10px;
            text-align: right;
            border-top: 1px solid #ddd;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .radio-inline {
            margin-right: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #ff6600;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background: #e65c00;
        }

        #popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation-duration: 1.5s;
            animation-fill-mode: both;
        }

        .fadeIn {
            animation-name: fadeIn;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Registration Form</h1>
                </div>
                <div class="panel-body">
                    <form id="registrationForm" action="" method="post" onsubmit="showPopup(event)">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required />
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required />
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <div>
                                <label for="male" class="radio-inline">
                                    <input type="radio" name="gender" value="m" id="male" required />Male
                                </label>
                                <label for="female" class="radio-inline">
                                    <input type="radio" name="gender" value="f" id="female" required />Female
                                </label>
                                <label for="others" class="radio-inline">
                                    <input type="radio" name="gender" value="o" id="others" required />Others
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required />
                        </div>
                        <div class="form-group">
                            <label for="number">Phone Number</label>
                            <input type="number" class="form-control" id="number" name="number" required />
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit" />
                        <button type="reset" class="btn btn-secondary" onclick="resetPage()">Reset</button>
                    </form>
                </div>
                <div id="popup" class="popup">
                    Your Registration Successful!!!
                </div>
                <div class="panel-footer text-right">
                    <small>&copy; Shariful Islam-011221078</small>
                    <br>
                    <a href="view_data.php" class="btn">View All Users</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function resetPage(){
            document.querySelector('form').reset();
        }

        function showPopup(event) {
            event.preventDefault();
            var popup = document.getElementById('popup');
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.display = 'none';
                document.getElementById('registrationForm').submit();
            }, 3000);
        }
    </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['firstName'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $number = $_POST['number'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'demologinpage');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $number);

        // Execute and check if successful
        if ($stmt->execute()) {
            echo '<script>document.getElementById("popup").style.display = "block";</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
