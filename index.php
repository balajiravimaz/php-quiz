<?php

require "db/Database.php";
require "header.php";

$db = new Database();

// question
$db->query("SELECT * FROM questions");
$result = $db->resultSet();

// choices





?>

<div class="container">
    <h1>PHP Quiz</h1>
    <div class="question">
        <form action="result.php" method="POST">            
            <?php foreach ($result as $ques) : ?>
                <div class="wrap">
                    <div class="title">
                        <h4><?php echo $ques->qid . '.  ' .  $ques->question; ?></h4>
                        <?php $db->query("SELECT * FROM quiz_options where qid= $ques->qid");
                        $choice = $db->resultSet();
                        // echo "<pre>";
                        // print_r($choice);
                        // echo "</pre>"; 
                        ?>
                        <ul>
                            <?php
                             $i=0; 
                             foreach ($choice as $choices) :  $i++; ?>
                                <li>
                                    <input type="radio" name="<?php echo $choices->qid; ?>" id="<?php echo $choices->option_id ?>" value="<?php echo $i; ?>">
                                    <label for="<?php echo $choices->option_id ?>"><?php echo $choices->option; ?></label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
            <input type="submit">
        </form>
    </div>
</div>

<?php require "footer.php"; ?>