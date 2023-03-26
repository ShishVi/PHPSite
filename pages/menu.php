<div class="container">
    <a class="navbar-brand" href="#">Site</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/index.php?page=1">Туры</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?page=2">Комментарии</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?page=3">Регистрация</a>
        </li>
        <?php if(isset($_SESSION['admin'])):?>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?page=4">Консоль администратора</a>
        </li>
        <?php endif;?>
      </ul>
      
    </div>    
  </div>
  <?php if(isset($_SESSION['user'])):?>
    <div class="col-md-1 text-end">
      <form action = "index.php" method = 'POST'>
        <button type="submit" class="btn btn-outline-primary me-2" name = 'out_btn'>Logout</button>
      </form>
    </div>     
  <?php endif?>
  <div class="col-md-1 text-end">
    <a href="/index.php?page=5">
    <button type="button" class="btn btn-outline-primary me-2">Login</button>    
    </a>        
  </div>   
  
  