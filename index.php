<?php

session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome To File Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>


<body>

    <div class="sign bg-primary">
        <div class="innerDiv" onmouseover="openForm2()">
            <h2>Sign Up</h2>
            <span>Sign up with your simple details. It will be cross checked by the adminstration</span>
        </div>
        <div class="innerDiv" onmouseover="openForm()">
            <h2>Sign In</h2>
            <span>Sign in with your username and password</span>
        </div>
    </div>
    <div class="row  bg-light">


        <form class="w-75 container" name="registerForm" action="" method="post" id="register" enctype="multipart/form-data" onsubmit="return validationForm()">
            <p class="text-danger" style="visibility:hidden">Please fill the fields !</p>
            <label for="fname">FIRST NAME</label>
            <input class="w3-input bg-light" type="text" value="" name="fname" placeholder="Enter First name ">
            <label for="lname">LAST NAME</label>
            <input class="w3-input bg-light" type="text" value="" name="lname" placeholder="Enter Last name ">

            <label for="email">EMAIL</label>
            <input class="w3-input bg-light" type="email" value="" name="email" placeholder="Enter Email  ">

            <label for="password">PASSWORD</label>
            <input class="w3-input bg-light" type="password" value="" name="password" placeholder="Password">
            <br />
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1" name="checkBox">I agree with the term and conditions </label>
            </div>
            <!-- <p class="text-danger" id="warning">Please fill the fields !</p> -->

            <br />
            <div class=" pr-20 mr-30 float-left">
                <button type="submit" class="button btn-success" name="submit">Sign up</button>
                <span style="padding: 8px" ;>or </span>
                <a onclick="openForm()" class="button btn-transperent p-2" style="padding-top: 10px">log in</a>
            </div>
        </form>

        <form class="w-75 container" action="" method="post" id="login" enctype="multipart/form-data">

            <label for="email">EMAIL </label>
            <input class="w3-input bg-light" type="email" name="email" placeholder="Enter Email  ">

            <label for="password">PASSWORD</label>
            <input class="w3-input bg-light" type="password" name="password" placeholder="Enter Password  ">
            <br />


            <button type="submit" class="button btn-primary float-left" name="signIn">Log in</button>


        </form>
    </div>


</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $check_value = isset($_POST['checkbox']) ? 1 : 0;
    if ($_POST['fname'] !== "" && $_POST['lname'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "") {
        $xml = new DOMDocument('1.0');
        $xml->load("users.xml");
        $rootTag = $xml->getElementsByTagName("doc")->item(0);
        $dataTag = $xml->createElement("data");

        $fname = $xml->createElement("fname", $_REQUEST['fname']);
        $lname = $xml->createElement("lname", $_REQUEST['lname']);
        $email = $xml->createElement("email", $_REQUEST['email']);
        $password = $xml->createElement("password", $_REQUEST['password']);

        $dataTag->appendChild($fname);
        $dataTag->appendChild($lname);
        $dataTag->appendChild($email);
        $dataTag->appendChild($password);

        $rootTag->appendChild($dataTag);

        $xml->save("users.xml");
    } else {
        // echo "<script>alert('please fill the fields !!!')</script>";
        echo "<p class='text-danger>**please fill the fields</p>";
    }
}


?>

<script>
    function changeCheck() {
        document.getElementById("warning").style.visibility = "visible";

    }

    function openForm() {
        document.getElementById("login").style.display = "block";
        document.getElementById("register").style.display = "none";
    }

    function openForm2() {
        document.getElementById("login").style.display = "none";
        document.getElementById("register").style.display = "block";
    }
</script>

<?php

if (isset($_POST['signIn'])) {
    if ($_POST['email'] !== "" && $_POST['password'] !== "") {
        $xml = simplexml_load_file("users.xml");
        echo (string) $xml;
        foreach ($xml->data as $data) {
            if ($_POST['email'] == $data->email && $_POST['password'] == $data->password) {
                $name = htmlentities((string) $data->fname);
                $_SESSION["username"] = $name;
                echo "<script>location.href='view.php'</script>";
                break;
            }
        }
    } else {
        echo "<script>alert('user name or password incorrect ')</script>";
    }
}

?>