<?php
session_start();
if(!isset($_SESSION['study_user_id']))
{
    $_SESSION['study_user_id'] = mt_rand(100000,1000000);
    $_SESSION['correct'] = 0;
    $_SESSION['total'] = 0;
    $_SESSION['current_streak'] = 0;
    $_SESSION['best_streak'] = 0;
    $_SESSION['correct_answer_id'] = -1;
    $_SESSION['correct_answer'] = "";
}
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
$request_method = $_SERVER["REQUEST_METHOD"];

if($request_method == "POST" && $_SESSION['correct_answer_id'] != -1)
{
    $_SESSION['total'] = $_SESSION['total'] + 1;
    if($_POST['answer_id'] == $_SESSION['correct_answer_id'])
    {
        $_SESSION['correct'] = $_SESSION['correct'] + 1;
        $_SESSION['current_streak'] = $_SESSION['current_streak'] + 1;
        
        $message_type = "success";
        $message = "Correct! The answer was:" . PHP_EOL . $_SESSION['correct_answer'];
    }
    else
    {
        $_SESSION['current_streak'] = 0;
        
        $message_type = "fail";
        $message = "Incorrect. The answer was:" . PHP_EOL . $_SESSION['correct_answer'];
    }
    
    if($_SESSION['current_streak'] > $_SESSION['best_streak'])
    {
        $_SESSION['best_streak'] = $_SESSION['current_streak'];
    }
}

$_SESSION['correct_answer_id'] = -1;

function get_random_qa($used)
{
    $qa_file = file_get_contents('qas.txt');
    
    $qas = explode(PHP_EOL, $qa_file);
    $done = false;
    $inf_stop = 0;
    
    while(!$done && $inf_stop < 1000)
    {
        $inf_stop++;
        $rand_qa_id = mt_rand(1,count($qas)) - 1;
        $done = true;
        for($i = 0; $i < count($used); $i++)
        {
            if($used[$i] == $rand_qa_id)
            {
                $done = false;
            }
        }
    }
    
    
    $qa = explode("|", $qas[$rand_qa_id]);
    $qa[] = $rand_qa_id;
    return $qa;
}

function printa($qa, $num)
{
    echo "<tr><td style='width:5%;'>";
    echo "<button class='btn btn-primary btn-lg active' onclick='answer(" . $num . ");'>";
    echo "<span class='glyphicon glyphicon-arrow-right'></span>";
    echo "</button>";
    echo "</td><td>";
    echo $qa[1];
    echo "</td></tr>";
}

$qas = array();
$used = array();
for($i = 0; $i < 4; $i++)
{
    $qas[] = get_random_qa($used);
    $used[] = $qas[$i][2];
}
$correct = mt_rand(0,3);
$_SESSION['correct_answer_id'] = $correct;
$_SESSION['correct_answer'] = $qas[$correct][1];
?>

<head>
<title>Studying</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './menu.php'; ?>
<div class="container">
<h2><?php echo $qas[$correct][0]; ?></h2>
<table class="table table-bordered" style="width:50%;">
<?php 
for($i = 0; $i < 4; $i++)
{
    printa($qas[$i], $i);  
}
?>
</table>
<form id='answerform' action='index.php' method='post'>
<input id='answerform_ans' type='hidden' name='answer_id' value='-1' />
</form>
</div>
<script>
function answer(choice)
{
    a = document.getElementById('answerform_ans');
    if(a)
    {
        a.value = choice;
        f = document.getElementById('answerform');
        if(f)
        {
            f.submit();
        }
    }
}
</script>
</body>
