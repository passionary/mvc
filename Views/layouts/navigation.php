<?php if(isset($_COOKIE['error'])): ?>
  <div class="alert alert-danger w-50 mx-auto text-center"><?php echo $_COOKIE['error']; ?></div>
<?php elseif(isset($_COOKIE['message'])): ;?>
  <div class="alert alert-success w-50 mx-auto text-center"><?php echo $_COOKIE['message']; ?></div>
<?php endif;?>
<div class="d-flex justify-content-between">
  <div class="d-flex justify-content-between navigation mt-3 mb-3 ml-3">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sort by
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="/sort?by=username&<?php
        if(isset($_GET['by']) && $_GET['by'] == 'username'
        && isset($_GET['dir']) && $_GET['dir'] == 'ASC') echo 'dir=DESC';
        else echo 'dir=ASC';
        ?>"
        >
        Username
        </a>
        <a class="dropdown-item" href="/sort?by=email&<?php
        if(isset($_GET['by']) && $_GET['by'] == 'email'
        && isset($_GET['dir']) && $_GET['dir'] == 'ASC') echo 'dir=DESC';
        else echo 'dir=ASC';
        ?>"
        ">
          Email
        </a>
        <a class="dropdown-item" href="/sort?by=status&<?php
        if(isset($_GET['by']) && $_GET['by'] == 'status'
        && isset($_GET['dir']) && $_GET['dir'] == 'ASC') echo 'dir=DESC';
        else echo 'dir=ASC';
        ?>
        ">
          Status
        </a>
      </div>
    </div>
    <?php if($user != false) {?>
      <a class="btn btn-secondary logout" href="/logout?id=<?=$user['id']?>">Logout</a>
    <?php } else {?>
      <a class="btn btn-secondary login" href="/to-login">Login</a>
    <?php }?>
  </div>
  <?php if($user != false):?>
    <p class="mt-4 mr-3 user"><?php echo $user['login']?></p>
  <?php endif;?>
</div>