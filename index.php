<?php
if (isset($_POST['mysubmit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $country = trim($_POST['country']);
    $comments = trim($_POST['comments']);
    $website = trim($_POST['website']);
    $gender = trim($_POST['gender']);
    $newsletter = trim($_POST['newsletter']);

    // echo "$user, $email, $password, $address, $city, $province, $country, $comments, $website, $gender, $newsletter";

    $valid = 1;
    $msgPreError = "\n<div class=\"alert alert-danger\" role=\"alert\">";
    $msgPreSuccess = "\n<div class=\"alert alert-primary\" role=\"alert\">";
    $msgPost = "\n</div>";

    //Valid Name 
    if ((strlen($name) < 2) || (strlen($name) > 25)) {
        $valid = 0;
        $valNameMsg = "Please enter a name between 2 to 25 characters.";
    }

    //Valid Email & clense email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = 0;
        $valEmailMsg .= "\nPlease enter a valid email address. Ex: name@mail.com";
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    //Valid Password
    if ((strlen($password) < 6) || (strlen($password) > 25)) {
        $valid = 0;
        $valPasswordMsg = "Please enter a password that is greater than 6 characters & less than 25 characters.";
    }

    //Valid Address 
    if ($address != "") {
        if ((strlen($address) < 5) || (strlen($address) > 200)) {
            $valid = 0;
            $valAddressMsg = "Please enter an address that is greater than 5 characters & less than 200 characters.";
        }
    }

    //Valid City
    if ($city != "") {
        if ((strlen($city) < 2) || (strlen($city) > 100)) {
            $valid = 0;
            $valCityMsg = "Please enter a City that is greater than 2 characters & less than 100 characters.";
        }
    }

    //Valid Country 
    if ($country == "") {
        $valid = 0;
        $valCountryMsg = "Please select a country.";
    }

    //If Comments Exist 
    if ($comments != "") {
        if ((strlen($comments) < 2) || (strlen($comments) > 200)) {
            $valid = 0;
            $valCommentsMsg = "Please enter a message that is greater than 2 characters & less than 200 characters.";
        }
    }

    //Valid Website
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
        $valid = 0;
        $valWebsiteMsg = "Please enter a valid URL. Ex: https://website.com";
    }

    $website = filter_var($website, FILTER_SANITIZE_URL);

    //Success Message
    if ($valid == 1) {
        $msgSuccess = "Sucess. You have successfully submitted the form data.";
    }
} //If Submitted
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Three - Trevin Shu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="container">
        <h1>PHP Form Validation</h1>
        <?php
        if ($msgSuccess) {
            echo $msgPreSuccess . $msgSuccess . $msgPost;
        }
        ?>
        <form name="myform" class="formstyle form-row" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="col-xl-6">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo "$name" ?>">
                    <?php
                    if ($valNameMsg) {
                        echo $msgPreError . $valNameMsg .  $msgPost;
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="<?php echo "$email" ?>">
                    <?php
                    if ($valEmailMsg) {
                        echo $msgPreError . $valEmailMsg . $msgPost;
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                    <?php
                    if ($valPasswordMsg) {
                        echo $msgPreError . $valPasswordMsg . $msgPost;
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" class="form-control" value="<?php echo "$address" ?>">
                    <?php
                    if ($valAddressMsg) {
                        echo $msgPreError . $valAddressMsg . $msgPost;
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" name="city" class="form-control" value="<?php echo "$city" ?>">
                    <?php
                    if ($valCityMsg) {
                        echo $msgPreError . $valCityMsg . $msgPost;
                    }
                    ?>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label for="province">Province:</label>
                    <select name="province" class="form-control">
                        <option value="">--Please Select A Province--</option>
                        <option value="AB" <?php if (isset($province) && $province == "AB") {
                                                echo "selected";
                                            } ?>>Alberta</option>
                        <option value="BC" <?php if (isset($province) && $province == "BC") {
                                                echo "selected";
                                            } ?>>British Columbia</option>
                        <option value="MB" <?php if (isset($province) && $province == "MB") {
                                                echo "selected";
                                            } ?>>Manitoba</option>
                        <option value="NB" <?php if (isset($province) && $province == "NB") {
                                                echo "selected";
                                            } ?>>New Brunswick</option>
                        <option value="NL" <?php if (isset($province) && $province == "NL") {
                                                echo "selected";
                                            } ?>>Newfoundland and Labrador</option>
                        <option value="NS" <?php if (isset($province) && $province == "NS") {
                                                echo "selected";
                                            } ?>>Nova Scotia</option>
                        <option value="ON" <?php if (isset($province) && $province == "ON") {
                                                echo "selected";
                                            } ?>>Ontario</option>
                        <option value="PE" <?php if (isset($province) && $province == "PE") {
                                                echo "selected";
                                            } ?>>Prince Edward Island</option>
                        <option value="QC" <?php if (isset($province) && $province == "QC") {
                                                echo "selected";
                                            } ?>>Quebec</option>
                        <option value="SK" <?php if (isset($province) && $province == "SK") {
                                                echo "selected";
                                            } ?>>Saskatchewan</option>
                        <option value="NT" <?php if (isset($province) && $province == "NT") {
                                                echo "selected";
                                            } ?>>Northwest Territories</option>
                        <option value="NU" <?php if (isset($province) && $province == "NU") {
                                                echo "selected";
                                            } ?>>Nunavut</option>
                        <option value="YT" <?php if (isset($province) && $province == "YT") {
                                                echo "selected";
                                            } ?>>Yukon</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select name="country" class="form-control">
                        <option value="">--Please Select A Country--</option>
                        <option value="Canada" <?php if (isset($country) && $country == "Canada") {
                                                    echo "selected";
                                                } ?>>Canada</option>
                        <option value="America" <?php if (isset($country) && $country == "America") {
                                                    echo "selected";
                                                } ?>>America</option>
                        <option value="England" <?php if (isset($country) && $country == "England") {
                                                    echo "selected";
                                                } ?>>England</option>
                        <option value="Australia" <?php if (isset($country) && $country == "Australia") {
                                                        echo "selected";
                                                    } ?>>Australia</option>
                        <option value="France" <?php if (isset($country) && $country == "France") {
                                                    echo "selected";
                                                } ?>>France</option>
                    </select>
                    <?php
                    if ($valCountryMsg) {
                        echo $msgPreError . $valCountryMsg . $msgPost;
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="comments">Comments:</label>
                    <textarea name="comments" class="form-control" rows="2"><?php if ($comments) {
                                                                                echo $comments;
                                                                            } ?></textarea>
                    <?php
                    if ($valCommentsMsg) {
                        echo $msgPreError . $valCommentsMsg . $msgPost;
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="text" name="website" class="form-control" value="<?php echo "$website" ?>">
                    <?php
                    if ($valWebsiteMsg) {
                        echo $msgPreError . $valWebsiteMsg . $msgPost;
                    }
                    ?>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="male" <?php if (isset($gender) && $gender == "male") {
                                                                                                    echo "checked";
                                                                                                } ?>>Male
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="female" <?php if (isset($gender) && $gender == "female") {
                                                                                                        echo "checked";
                                                                                                    } ?>>Female
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="newsletter" value="1" <?php if (isset($newsletter) && $newsletter == "1") {
                                                                                                        echo "checked";
                                                                                                    } ?>>Subscribe to Newsletter
                    </label>
                </div>
                <input type="submit" class="btn btn-primary" name="mysubmit">
            </div>
        </form>
    </div>
</body>

</html>