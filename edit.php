<?php

require "db/Database.php";
require "header.php";

$db = new Database();

// choices


if (isset($_GET['lid'])) {
    $lid = $_GET['lid'];

    $db->query("DELETE FROM lang where lid = $lid ");
    $result1 = $db->execute();

    if ($result1) {
        echo "<script>alert('Data Deleted');</script>";
        echo "<script>window.location.href='edit.php?id=" . $id . "';</script>";
    }
}


if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    // Delete

    if (!empty($_POST['name'])) {
        for ($z = 0; $z < count($_POST['email']); $z++) {

            $lang = trim($_POST['language'][$z]);

            $uid = trim($_POST['uid'][$z]);

            $name = trim($_POST['name'][$z]);
            $email = trim($_POST['email'][$z]);
            $email1 = trim($_POST['email1'][$z]);


            if (!empty($_POST['name'][$z])) {
                if (!empty($_POST['id'][$z])) {
                    $lid = $_POST['id'][$z];
                    // var_dump($lid, $lang, $name, $email, $email1);   
                    $db->query("UPDATE `lang` SET `lan` = :lan, readProf=:name, write=:write, speak =:speak WHERE `lid` = :lid");                    
                    $db->bind(":lan", $lang);
                    $db->bind(":name", $name);
                    $db->bind(":write", $email);
                    $db->bind(":speak", $email1);
                    $db->bind(":lid", $lid);   
                    $ans = $db->execute();                 
                    echo "<br>";
                } else {
                    $db->query("INSERT INTO `lang` (`userid`, `lan`, `readProf`, `write`, `speak`) VALUES (:id, :lang, :name, :email, :email1)");                    
                    $db->bind(":id", $uid);                    
                    $db->bind(":lang", $lang);                    
                    $db->bind(":name", $name);                    
                    $db->bind(":email", $email);                    
                    $db->bind(":email1", $email1);      
                    $ans = $db->execute();              
                    // var_dump($id, $lang, $name, $email, $email1);
                }
            }
        }


        if ($ans) {
            echo "<script>alert('Data Added')</script>";
            echo "<script>window.location.href='multiple.php';</script>";
        } else {
            echo "<script>alert('Failed')</script>";
        }
    }


    $db->query("SELECT * FROM lang where userid ='$id'");
    $result = $db->resultSet();

    $l = ['Tamil', 'English', 'Telugu', 'Malayalam', 'Kanada', 'French', 'Hindhi', 'spanish'];
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
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <?php foreach ($result as $language) : ?>
                <div class="inp">
                    <input type="hidden" name="id[]" value="<?php echo $language->lid; ?>">
                    <input type="hidden" name="uid[]" value="<?php echo $language->userid; ?>">
                    <select name="language[]" id="">
                        <?php foreach ($l as $ll) :
                            if ($language->lan == $ll) { ?>
                                <option value="<?php echo $ll ?>" selected><?php echo $ll; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $ll ?>"><?php echo $ll; ?></option>
                            <?php  } ?>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="name[]" value="<?php echo $language->readProf; ?>" placeholder="Proficiency Level">
                    <input type="text" name="email[]" value="<?php echo $language->write; ?>" placeholder="Proficiency Level">
                    <input type="text" name="email1[]" value="<?php echo $language->speak; ?>" placeholder="Proficiency Level">
                    <a href="editDelete.php?id=<?php echo $language->lid; ?>" class="delete">&times;</a>
                </div>
            <?php endforeach; ?>
            <div class="inp-group">
            </div>
            <input type="submit" value="Update" name="submit" class="btn">
        </form>
    </div>

<?php require "footer.php";
} ?>