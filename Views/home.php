<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/layouts/header.php';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/layouts/navigation.php'; ?>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Body</th>
      <th scope="col">Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>        
    <?php
        $array = [];
        if(isset($_GET['page'])) {
          $page = $_GET['page'];
          if(isset($todos[$page - 1]))
          $array = $todos[$page - 1];
        }
        else if(!empty($todos)) $array = $todos[0];        
        foreach($array as $todo):
      ?>
        <tr>
          <th scope="row"><?php echo $todo['id']; ?></th>
          <td>
            <?php echo $todo['username']; ?>
          </td>
          <td><?php echo $todo['email']; ?></td>
          <form action="/edit-todo" method="POST">
          <input name="todo_id" type="hidden" value="<?php echo $todo['id'];?>">
            <td>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">
                    Body
                    <?php if($todo['modified'] != 0) echo '(modified by administrator)'; ?>
                  </span>
                </div>
                <input value="<?php echo htmlspecialchars($todo['body']); ?>"
                  name="body" 
                  type="text" 
                  <?php echo $user != false ? '' : 'disabled';?> 
                  class="form-control" 
                  aria-label="Sizing example input" 
                  aria-describedby="inputGroup-sizing-default"
                >
              </div>
            </td>
            <td>
              <div class="input-group-text d-flex justify-content-between">
                <input 
                  <?php echo isset($todo['status']) ? 'checked' : '' ;?>
                  <?php echo $user != false ? '' : 'disabled';?> 
                  id="status" name="status" 
                  type="checkbox" 
                  aria-label="Checkbox for following text input"
                >
                <label for="status">
                  <?php echo $todo['status'] ? $todo['status'] : 'uncompleted'; ?>
                </label>
              </div>
            </td>
            <td>
            <?php if($user != false): ?>
              <input type="submit" class="btn btn-primary" value="Edit">
            <?php endif;?>            
            </td>            
          </form>        
        </tr>
      <?php endforeach;?>    
  </tbody>
</table>

<form action="/create-todo" method="POST" class="w-25 mt-4 ml-3">
  <h3 class="mb-4">Create new Todo</h3>
  <div class="form-group">
    <label for="username">Username</label>
    <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">    
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input name="email" type="text" class="form-control" id="email">
  </div>  
  <div class="form-group">
    <label for="body">Text</label>
    <input name="body" type="text" class="form-control" id="body">
  </div>  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/layouts/pagination.php'; ?>

<?php 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/layouts/footer.php';
?>