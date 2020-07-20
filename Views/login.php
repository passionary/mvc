<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/layouts/header.php';
?>

<h2 class="text-center my-5">Authorisation</h2>
<?php if(isset($_COOKIE['error'])): ?>
  <div class="alert alert-danger w-50 mx-auto text-center"><?php echo $_COOKIE['error']; ?></div>
<?php endif;?>

<p class="text-center"><a href="/">Show Todos</a></p>
<form class="w-75 mx-auto" action="/login" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="login" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="password"  type="password" class="form-control" id="exampleInputPassword1">
  </div>  
  <button type="submit" class="mt-3 btn btn-primary">Submit</button>
</form>

<?php 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/layouts/footer.php';
?>