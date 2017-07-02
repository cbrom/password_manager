
<!doctype html>
<html>
    <head>
        <title>index</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link type="text/css" rel="stylesheet" href="../public/css/bulma.css" />
        <link type='text/css' rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    </head>

  <body>
    <div id="app" class="container">

      <nav class="nav has-shadow">
        <div class="container">
          <div class="nav-left">
            <a href="/home" class="nav-item is-tab is-hidden-mobile is-active">PSD MGR</a>
          </div>
          <span class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
          </span>
          <div class="nav-right nav-menu">
            <a href="/home" class="nav-item is-tab is-hidden-tablet is-active">Home</a>
          </div>
        </div>
      </nav>

      <div class="container">
        <div class="columns" style="margin-top:10px">
          <div class="column is-one-quarter" style="margin-top:-60px">
            <p class="notification">
              <aside class="menu">
                  <p class="menu-label">
                    Repository
                  </p>
                  <ul class="menu-list">
                    <li>
                      <a class="">Display</a>
                      <ul>
                        <li><a href="vault" class='is-active'>Vault</a></li>
                        <li><a href="notes">Notes</a></li>
                        <li><a href="form_fills">Form Fills</a></li>
                      </ul>
                    </li>
                  </ul>
                      
                </aside>
            </p>

            <form method="Post" action="../sites/addSite">      
              <div id="facebook" class="card-content" style="height:auto !important;">

                <div class="card-content-box">
                  

                  <div class="field">
                    <label class="label">Site</label>
                    <p class="control">
                      <input name="url" class="input" type="text" placeholder="url">
                    </p>
                  </div>

                  <div class="field">
                    <label class="label">User Name</label>
                    <p class="control">
                      <input name="username" class="input" type="text" placeholder="user name" >
                    </p>
                  </div>
                  <div class="field">
                    <label class="label">Password</label>
                    <p class="control">
                      <input name="password" class="input" type="password" placeholder="password">
                    </p>
                  </div>

                  <div class="field">
                  <p class="control">
                    <span class="select">
                      <select name="folderid">
                        <option value="1">Educational</option>
                        <option value="2">Public</option>
                        <option value="3">One Time</option>
                      </select>
                    </span>
                  </p>
                </div>
                  
                </div>

              </div>
              <footer class="card-footer">
                <input type="submit" class="button is-dark card-footer-item" value="Add Site">
              </footer>
            </form>

            <hr>

            <form method="Post" action="../home/addFolder">      
              <div id="facebook" class="card-content" style="height:auto !important;">

                <div class="card-content-box">
                  

                  <div class="field">
                    <label class="label">Folder Name</label>
                    <p class="control">
                      <input name="foldername" class="input" type="text" placeholder="folder name">
                    </p>
                  </div>
                  
                </div>

              </div>
              <footer class="card-footer">
                <input type="submit" class="button is-dark card-footer-item" value="Add Folder">
              </footer>
            </form>

          </div>

          <div class="column">
            

<?php
  $folder_count = $data['data']['folders']->count();
  $site_count = $data['data']['sites']->count();

  $folders = $data['data']['folders'];
  $sites = $data['data']['sites'];

  $index = 0;
  while($index < $folder_count)
  {
    $folder = $folders[$index];

    //print one collapsible

?>
            <div class="collapse"> 

              <collapse-item title="Folder One">
                <div class="card collapse-item collapse-open">

                  <header class="card-header">
                    <p class="card-header-title">
                      <?=$folder->foldername?>
                    </p>
                    <a class="card-header-icon" onclick="collapse(<?php echo $folder->id?>)">
                      <span class="icon">
                        <i class="fa fa-angle-down"></i>
                      </span>
                    </a>
                  </header>

                <?php echo "<div id=" . $folder->id . " class='content is-hidden'>"  ?>
                <!-- <div id="folder-one" class="content is-hidden"> -->
                

<?php
  $site_index = 0;
  while($site_index < $site_count)
  {
    $site = $sites[$site_index];
    if ($site->folder_id == $folder->id)
    {
?>

                    <form method="POST" <?php echo "action='../sites/editSite/" . $site->id ."'"?>>
                    
                      <div id="facebook" class="card-content" style="height:auto !important;">

                        <div class="card-content-box">
                          

                          <div class="field">
                            <label class="label">Site</label>
                            <p class="control">
                              <input name="url" class="input" type="text" placeholder="url" value=<?=$site->url?>>
                            </p>
                          </div>

                          <div class="field">
                            <label class="label">User Name</label>
                            <p class="control">
                              <input name="username" class="input" type="text" placeholder="user name" value=<?=$site->username?>>
                            </p>
                          </div>
                          <div class="field">
                            <label class="label">Password</label>
                            <p class="control">
                              <input name="password" class="input" type="password" placeholder="password" value=<?=$site->password?>>
                            </p>
                          </div>

                          <div class="columns">
                            <div class="column">
                              <input type="submit" class="button card-footer-item" value="Save">
                            </div>
                            <div class="column">
                              <a href=<?php echo "../sites/deleteSite/" . $site->id ?> class="card-footer-item">Delete</a>
                            </div>
                          </div>
                          <hr>
                          
                        </div>

                      </div>
                      <hr>
                    </form>

<?php
      //print form fill
    }
    $site_index++;
  }

?>
                    
                      
                  </div>
                </div>
                  
              </collapse-item> 

            </div>
<?php
    $index++;
  }

?>

            <div class="collapse"> 
<!--               <collapse-item title="Folder x">
                <div class="card collapse-item collapse-open">

                  <form method="Post" action="#">
                    <header class="card-header">
                      <p class="card-header-title">
                        Component
                      </p>
                      <a class="card-header-icon">
                        <span class="icon">
                          <i class="fa fa-angle-down"></i>
                        </span>
                      </a>
                    </header>
                    <div class="card-content " style="height:auto !important;">

                      <div class="card-content-box">
                        <label>Site Url: https://www.facebook.com</label>
                        <div class="field">
                          <label class="label">User Name</label>
                          <p class="control">
                            <input class="input" type="text" placeholder="user name" value="kj@gmail.com">
                          </p>
                        </div>
                        <div class="field">
                          <label class="label">Password</label>
                          <p class="control">
                            <input class="input" type="password" placeholder="password" value="password is l">
                          </p>
                        </div>
                        
                      </div>

                    </div>
                    <footer class="card-footer">
                      <a class="card-footer-item">Save</a>
                      <a class="card-footer-item">Edit</a>
                      <a class="card-footer-item">Delete</a>
                    </footer>
                  </form>

                  <form method="Post" action="#">
                    <header class="card-header">
                      <p class="card-header-title">
                        Component
                      </p>
                      <a class="card-header-icon">
                        <span class="icon">
                          <i class="fa fa-angle-down"></i>
                        </span>
                      </a>
                    </header>
                    <div class="card-content " style="height:auto !important;">

                      <div class="card-content-box">
                        <label>Site Url: https://www.facebook.com</label>
                        <div class="field">
                          <label class="label">User Name</label>
                          <p class="control">
                            <input class="input" type="text" placeholder="user name" value="kj@gmail.com">
                          </p>
                        </div>
                        <div class="field">
                          <label class="label">Password</label>
                          <p class="control">
                            <input class="input" type="password" placeholder="password" value="password is l">
                          </p>
                        </div>
                        
                      </div>

                    </div>
                    <footer class="card-footer">
                      <a class="card-footer-item">Save</a>
                      <a class="card-footer-item">Edit</a>
                      <a class="card-footer-item">Delete</a>
                    </footer>
                  </form>
                    
                </div>
              </collapse-item> -->

              <collapse-item title="Folder One">
                <div class="card collapse-item collapse-open">

                  <header class="card-header">
                    <p class="card-header-title">
                      Folder One
                    </p>
                    <a class="card-header-icon" onclick="collapse('folder-one')">
                      <span class="icon">
                        <i class="fa fa-angle-down"></i>
                      </span>
                    </a>
                  </header>

                <div id="folder-one" class="content is-hidden">
                

                    <form method="Post" action="#">
                    
                      <div id="facebook" class="card-content" style="height:auto !important;">

                        <div class="card-content-box">
                          <label>Site Url: https://www.facebook.com</label>
                          <div class="field">
                            <label class="label">User Name</label>
                            <p class="control">
                              <input class="input" type="text" placeholder="user name" value="kj@gmail.com">
                            </p>
                          </div>
                          <div class="field">
                            <label class="label">Password</label>
                            <p class="control">
                              <input class="input" type="password" placeholder="password" value="password is l">
                            </p>
                          </div>
                          
                        </div>

                      </div>
                      <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                      </footer>
                    </form>

                    <form method="Post" action="#">
                      <div class="card-content " style="height:auto !important;">

                        <div class="card-content-box">
                          <label>Site Url: https://www.facebook.com</label>
                          <div class="field">
                            <label class="label">User Name</label>
                            <p class="control">
                              <input class="input" type="text" placeholder="user name" value="kj@gmail.com">
                            </p>
                          </div>
                          <div class="field">
                            <label class="label">Password</label>
                            <p class="control">
                              <input class="input" type="password" placeholder="password" value="password is l">
                            </p>
                          </div>
                          
                        </div>

                      </div>
                      <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                      </footer>
                    </form>
                      
                  </div>
                </div>
                  
              </collapse-item> 

            </div>

<!--             <div class="collapse"> 

              <collapse-item title="Folder One">
                <div class="card collapse-item collapse-open">

                  <header class="card-header">
                    <p class="card-header-title">
                      Folder One
                    </p>
                    <a class="card-header-icon" onclick="collapse('folder-one')">
                      <span class="icon">
                        <i class="fa fa-angle-down"></i>
                      </span>
                    </a>
                  </header>

                <div id="folder-one" class="content is-hidden">
                

                    <form method="Post" action="#">
                    
                      <div id="facebook" class="card-content" style="height:auto !important;">

                        <div class="card-content-box">
                          <label>Site Url: https://www.facebook.com</label>
                          <div class="field">
                            <label class="label">User Name</label>
                            <p class="control">
                              <input class="input" type="text" placeholder="user name" value="kj@gmail.com">
                            </p>
                          </div>
                          <div class="field">
                            <label class="label">Password</label>
                            <p class="control">
                              <input class="input" type="password" placeholder="password" value="password is l">
                            </p>
                          </div>
                          
                        </div>

                      </div>
                      <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                      </footer>
                    </form>

                    <form method="Post" action="#">
                      <div class="card-content " style="height:auto !important;">

                        <div class="card-content-box">
                          <label>Site Url: https://www.facebook.com</label>
                          <div class="field">
                            <label class="label">User Name</label>
                            <p class="control">
                              <input class="input" type="text" placeholder="user name" value="kj@gmail.com">
                            </p>
                          </div>
                          <div class="field">
                            <label class="label">Password</label>
                            <p class="control">
                              <input class="input" type="password" placeholder="password" value="password is l">
                            </p>
                          </div>
                          
                        </div>

                      </div>
                      <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                      </footer>
                    </form>
                      
                  </div>
                </div>
                  
              </collapse-item> 

            </div> -->

          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function collapse(id){
        divEl = document.getElementById(id);
        if(divEl.getAttribute('class') == "content is-hidden")
        {
          divEl.setAttribute('class','content');
          //alert(divEl.getAttribute('class'));
        } else {
          divEl.setAttribute('class','content is-hidden');
          //alert(divEl.getAttribute('class'));
          
      }
        }
    </script>

  </body>

</html>