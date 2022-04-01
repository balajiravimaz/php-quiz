<?php
if (!empty($_POST)) {
    require "db/Database.php";
    require "header.php";

    $db = new Database();
    $score=0;

?>
    <div class="container">        
        <?php
        // echo "<pre>";
        // echo print_r($_POST);
        // echo "</pre>";
        foreach ($_POST as $key => $value) {
            $db->query("SELECT * FROM quiz_answer where qid=$key");
            $answer = $db->resultSet();
            
            if($answer[0]->option_number == $value){
                $score++;
            }
            // echo $value;
            // echo "\n";
            // echo $answer[0]->option_number;
            // echo "\n";
            // echo $score;

            // echo $answer[0]->option_number;
            // echo "<br>";            
            // echo "<pre>";
            // echo print_r($answer[0]->qa_id);
            // echo "</pre>";
            //   die();                                  
        }
        ?>
        <h1>Result is: <?php echo $score; ?></h1>
        <a href="index.php" class="btn">Try Again</a>
    </div>

<?php require "footer.php";
} else {
    header("Location: index.php");
}
