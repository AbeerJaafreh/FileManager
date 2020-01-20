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
    <style>
        .sign {
            color: white;
            font-family: 'Arial Narrow Bold', sans-serif;
            display: grid;
            grid-template-rows: 2fr 2fr;
            grid-gap: 5em;
            padding: 50px;

        }

        body {
            display: grid;
            grid-template-columns: 4fr 8fr;
            padding: 5% 20% 5%;
        }

        body,
        html {
            height: 100%;
        }

        p {
            padding-top: 5px;
        }

        .signin {
            padding-top: 5em;
        }

        #login {
            display: none;
        }

        .innerDiv {
            margin: 10%;
        }

        form {
            padding: 10%
        }

        .w3-input {
            padding: 0px;
            padding-bottom: 0px;
            margin-top: -6px;


        }

        label {
            padding-top: 28px;
        }

        .button {
            padding: 0px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 3px;
            border-style: none;
        }

        .form-check-input {
            position: relative
        }

        .btn-success {
            color: #fff;
            background-color: green;

        }

        label {
            color: black;

        }

        span {
            font-weight: lighter;
            font-stretch: ultra-condensed;
        }
    </style>
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


        <form class="w-75 container" action="" method="post" id="register">
            <label for="fname">FIRST NAME</label>
            <input class="w3-input bg-light" type="text" name="fname" placeholder="Enter First name ">
            <label for="lname">LAST NAME</label>
            <input class="w3-input bg-light" type="text" name="lname" placeholder="Enter Last name " require>

            <label for="email">EMAIL</label>
            <input class="w3-input bg-light" type="email" name="email" placeholder="Enter Email  " require>

            <label for="password">PASSWORD</label>
            <input class="w3-input bg-light" type="password" name="password" placeholder="Password" require>
            <br />
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I agree with the term and conditions </label>
            </div>
            <br />
            <div class=" pr-20 mr-30 float-left">
                <button type="submit" class="button btn-success" name="submit">Sign up</button>
                <span style="padding: 8px" ;>or </span>
                <a onclick="openForm()" class="button btn-light p-2" style="padding-top: 10px">log in</a>
            </div>
        </form>

        <form class="w-75 container" action="" method="post" id="login">

            <label for="email">EMAIL </label>
            <input class="w3-input bg-light" type="email" name="email" placeholder="Enter Email  " require>

            <label for="password">PASSWORD</label>
            <input class="w3-input bg-light" type="password" name="password" placeholder="Enter Password  " require>
            <br />


            <button type="submit" class="button btn-primary float-left" name="signIn">Log in</button>


        </form>
    </div>


</body>

</html>

<?php
if (isset($_POST['submit'])) {
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
}


?>

<script>
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