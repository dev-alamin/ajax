<?php
$host = "localhost";
$dbname = "ajax";
$username = "root";
$password = "";


try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "Connection failed:" .  $e->getMessage();
}


// Input form value
$fname = $lname = $email = $phone = "";


if (isset($_POST['submit-btn'])) {


    $fname = addslashes($_POST['fname']);
    $lname = addslashes($_POST['lname']);
    $email = addslashes($_POST['email']);
    $phone = addslashes($_POST['phone']);

    $sql = "INSERT INTO form(fname, lname, email, phone) VALUES('$fname', '$lname', '$email', '$phone')";
    $conn->exec($sql);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>


    <?php
    try {
        $connnection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $sql_get = "SELECT * FROM form LIMIT 5";
        $statement = $connnection->prepare( $sql_get );
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $e) {

        echo "Failed" . $e->getMessage();
    }
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h2>Get the result using ajax</h2>
                <select name="users" onclick="showUser(this.value);">
                    <option value="0">Select a user</option>
                    <option value="1">User one</option>
                    <option value="2">User Two</option>
                    <option value="3">User Three</option>
                    <option value="4">User 4</option>
                    <option value="5">User 5</option>
                    <option value="8">User 6</option>
                    <option value="9">User 7</option>
                    <option value="10">User 8</option>
                    <option value="11">User 8</option>
                    <option value="12">User 10</option>
                </select>
                <div id="mydiv">User will the there</div>
            </div>
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <h4>Ajax form handling</h4>


                <form method="POST" action="" class="form mt-2">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input name="fname" type="text" class="form-control" id="firstname" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="exampleInputPassword1" placeholder="Last Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                    </div>

                    <button id="submitbtn" type="submit" name="submit-btn" class="btn btn-primary mt-2">Submit</button>
                    <!-- <input type="submit" name="submit-btn" id="submitbtn" value="Submit"> -->
                </form>
            </div>
        </div>
    </div>


    <script>
        const btn = document.getElementById("submitbtn");
        const div = document.getElementById("mydiv");

        btn.addEventListener("click", function(e) {});

        function showUser(str) {

            if (str == '') {

                div.innerHTML = 'Select id to get the details';
                return;

            } else {

                var XHR = new XMLHttpRequest();

                XHR.onreadystatechange = function() {

                    if (this.readyState == 4 && this.status == 200) {
                        div.innerHTML = this.responseText;
                    }

                }

                XHR.open("GET", "read.php?q=" + str, true);
                XHR.send();
            }
        }

        // Console log for git restore testing 
        
    </script>
</body>

</html>