<nav class="paginator mt-4 mx-auto">
<?php   
      preg_match('/[^?]+(?=\?*)/',$_SERVER['REQUEST_URI'],$matches);
      if(!empty($matches) > 0) $url = $matches[0];
      $params = '?' . $_SERVER['QUERY_STRING'];      
 ?>
  <ul class="pagination">
  <?php for($i = 0; $i < count($todos); $i++): ?>    
    <li class="page-item <?php if(isset($_GET['page']) && $_GET['page'] == ($i+1))
      echo 'active';
    ?>">
      <a class="page-link" href="<?php
        if(preg_match('/page=/', $params) === 1){        
          echo $url . preg_replace('/page=[^=]+/','page=' . ($i+1),$params);
        }
        else if(preg_match('/\?[^\=]+\=[^\=]+/', $params) === 1) echo $url . $params .'&page=' . ($i + 1);
        else echo $url . '?page=' . ($i + 1);
      ?>"><?php echo ($i + 1);?>
      </a>
    </li>
  <?php endfor;?>
  </ul>
</nav>