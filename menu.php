<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <ul class="nav navbar-nav">
    <li><a>Studying</a></li>
    <li><a><?php echo $_SESSION['correct'] . " / " . $_SESSION['total']; ?></a></li>
    <li><a>Best Streak: <?php echo $_SESSION['best_streak']; ?></a></li>
    <li><a>Current Streak: <?php echo $_SESSION['current_streak']; ?></a></li>
    <li><a href="reset.php">Reset All Stats</a></li>
  </ul>
</nav>

<?php

if($message_type == "fail")
{ ?>
<div class="alert alert-danger" style="width:50%">
  <?php echo $message; ?>
</div>
<?php }
else if($message_type == "success")
{ ?>
<div class="alert alert-success" style="width:50%">
  <?php echo $message; ?>
</div>
<?php }
else if($message_type == "info")
{ ?>
<div class="alert alert-info" style="width:50%">
  <?php echo $message; ?>
</div>
<?php } ?>
