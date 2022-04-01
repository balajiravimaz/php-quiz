<?php

require "db/Database.php";
require "header.php";

$db = new Database();

// question
$db->query("SELECT * FROM questions");
$result = $db->resultSet();

// choices


if (isset($_POST['submit'])) {
    for ($z = 0; $z < count($_POST['email']); $z++) {
        if (!empty($_POST['name'][$z])) {

            $name = trim($_POST['name'][$z]);
            $email = trim($_POST['email'][$z]);

            $db->query("INSERT INTO users(uname,email) values (:name,:email) ");
            $db->bind(":name", $name);
            $db->bind(":email", $email);
            $db->execute();
        }
    }
    if ($db->lastId()) {
        echo "Data Added";
    }
}

$db->query("SELECT * from users");
$result = $db->resultSet();

// var_dump($result);

?>


<div class="container">
    <table>
        <thead>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Language</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php $i=1; foreach ($result as $value) : ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value->uname; ?></td>
                    <td><?php echo $value->email; ?></td>
                    <td>

                    <?php 
                    
                    $db->query("SELECT * FROM lang where userid='$value->user_id'");
                    $lang = $db->resultSet();
                    if(!empty($lang)){
                    foreach($lang as $lan):
                    ?>
                    <ul>
                        <b><?php echo  $lan->lan  ?></li></b>
                        <li><?php echo  $lan->readProf  ?></li>
                        <li><?php echo  $lan->write  ?></li>
                        <li><?php echo  $lan->speak  ?></li>
                    </ul>
                    <?php endforeach; } else { ?>
                        <p>Not Found</p>
                    <?php } ?>

                    </td>
                    <td><a href="edit.php?id=<?php echo $value->user_id; ?>">Edit</a> | <a href="delete.php?id=<?php echo $value->user_id; ?>">Delete</a> | <a href="add.php?id=<?php echo $value->user_id; ?>">Add</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br>



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
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="inp">
            <input type="text" name="name[]" placeholder="Enter your name">
            <input type="email" name="email[]" placeholder="Enter your email">
        </div>
        <div class="inp-group">
        </div>
        <div class="inp">
            <input type="submit" value="submit" name="submit" class="btn">
        </div>
    </form>
</div>

<?php require "footer.php"; ?>