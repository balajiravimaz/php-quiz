<?php

require "db/Database.php";
require "header.php";

$db = new Database();



// choices



if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    if (!empty($_POST['name'])) {
        for ($z = 0; $z < count($_POST['email']); $z++) {

            $lang = trim($_POST['language'][$z]);

            $name = trim($_POST['name'][$z]);
            $email = trim($_POST['email'][$z]);
            $email1 = trim($_POST['email1'][$z]);

            if (!empty($_POST['name'][$z])) {

                // var_dump($id, $lang, $name, $email, $email1);

                $db->query("INSERT INTO `lang` (`userid`, `lan`, `readProf`, `write`, `speak`) VALUES (:id, :lang, :name, :email, :email1)");
                $db->bind(":id", $id);
                $db->bind(":lang", $lang);
                $db->bind(":name", $name);
                $db->bind(":email", $email);
                $db->bind(":email1", $email);
                $db->execute();

            }

            // if (!empty($_POST['id'][$z])) {
            //     $id  = trim($_POST['name'][$z]);

            //     var_dump($id,$name,$email,$email1, $lang);                

            //     // $db->query("INSERT INTO users(uname,email) values (:name,:email) ");
            //     // $db->bind(":name", $name);
            //     // $db->bind(":email", $email);
            //     // $db->execute();
            // }
            // else{
            //     var_dump($name,$email,$email1,$lang);
            // }
        }

        if ($db->lastId()) {
            echo "<script>alert('Data Added')</script>";
            echo "<script>window.location.href='multiple.php';</script>";
        }else{
            echo "<script>alert('Failed')</script>";
        }
    }
?>
    <div class="container">
        <div class="wrap">
            <label for="user">Select No. of Users</label>
            <select name="user" id="user">
                <option value="0">select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <form action="add.php?id=<?php echo $id; ?>" method="POST">
            <div class="inp">
                <select name="language[]" id="">
                    <option value="Tamil">Tamil</option>
                    <option value="English">English</option>
                    <option value="Telugu">Telugu</option>
                    <option value="Malayalam">Malayalam</option>
                    <option value="Kanada">Kanada</option>
                    <option value="French">French</option>
                    <option value="Hindhi">Hindhi</option>
                    <option value="spanish">Spanish</option>
                </select>
                <input type="text" name="name[]" placeholder="Proficiency Level">
                <input type="text" name="email[]" placeholder="Proficiency Level">
                <input type="text" name="email1[]" placeholder="Proficiency Level">
            </div>
            <div class="inp-group">
            </div>
            <input type="submit" value="submit" name="submit" class="btn">
        </form>
    </div>

<?php require "footer.php";
} ?>