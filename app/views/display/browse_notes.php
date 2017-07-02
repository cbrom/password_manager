
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
                        <li><a href="vault">Vault</a></li>
                        <li><a href="notes" class='is-active'>Notes</a></li>
                        <li><a href="form_fills">Form Fills</a></li>
                      </ul>
                    </li>
                  </ul>
                      
                </aside>
            </p>
          </div>
          <div class="column">

<?php
  //var_dump($data['data'][0]->getOriginal()['title']);
  $notes = $data['data'];
  $number = $notes->count();
  $index = 0;
  while($index < $number)
  {
    $note = $notes[$index]->getOriginal();
    $title = $note['title'];
    $content = $note['content'];
    $id = $note['id'];
    if ($index %2 == 0)
    {
?>
            <div class="columns">
              <div class="column">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title"><?=$title?></h3>
                    <span class="card-header-icon"> <i class="fa fa-angle-right"></i> </span>
                  </div>
                  <div class="card-content">
                    <p class="subtitle">
                      <?=$content?>
                    </p>
                  </div>
                  <footer class="card-footer">
                    <p class="card-footer-item">
                      <span>
                        <a class="button is-outlined is-dark">Edit</a>
                      </span>
                    </p>
                    <p class="card-footer-item">
                      <span>
                        <a href=<?php echo "../notes/deleteNote/" . $id ?> class="button is-outlined is-dark">Delete</a>
                      </span>
                    </p>
                  </footer>
                </div>
              </div>
<?php
    } else {
?>
              <div class="column">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title"><?=$title?></h3>
                    <span class="card-header-icon"> <i class="fa fa-angle-right"></i> </span>
                  </div>
                  <div class="card-content">
                    <p class="subtitle">
                      <?=$content?>
                    </p>
                  </div>
                  <footer class="card-footer">
                    <p class="card-footer-item">
                      <span>
                        <a class="button is-outlined is-dark">Edit</a>
                      </span>
                    </p>
                    <p class="card-footer-item">
                      <span>
                        <a href=<?php echo "../notes/deleteNote/" . $id ?> class="button is-outlined is-dark">Delete</a>
                      </span>
                    </p>
                  </footer>
                </div>
              </div>
            </div>

<?php
    }
    $index++;
  }

  if ($number %2 != 0)
  {
    echo "<div class='column'></div>";
    echo "</div>";
  }
?>          
            <!-- <div class="columns">
              <div class="column">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">Item1</h3>
                    <span class="card-header-icon"> <i class="fa fa-angle-right"></i> </span>
                  </div>
                  <div class="card-content">
                    <p class="title">
                      “There are two hard things in computer science: cache invalidation, naming things, and off-by-one errors.”
                    </p>
                    <p class="subtitle">
                      Jeff Atwood
                    </p>
                  </div>
                  <footer class="card-footer">
                    <p class="card-footer-item">
                      <span>
                        <a class="button is-outlined is-dark">Edit</a>
                      </span>
                    </p>
                    <p class="card-footer-item">
                      <span>
                        <a class="button is-outlined is-dark">Delete</a>
                      </span>
                    </p>
                  </footer>
                </div>
              </div>

              <div class="column">
                <div class="card">
                  <div class="card-content">
                    <p class="title">
                      “There are two hard things in computer science: cache invalidation, naming things, and off-by-one errors.”
                    </p>
                    <p class="subtitle">
                      Jeff Atwood
                    </p>
                  </div>
                  <footer class="card-footer">
                    <p class="card-footer-item">
                      <span>
                        <a class="button is-outlined is-dark">Edit</a>
                      </span>
                    </p>
                    <p class="card-footer-item">
                      <span>
                        <a class="button is-outlined is-dark">Delete</a>
                      </span>
                    </p>
                  </footer>
                </div>
              </div>
            </div> -->

            <form method="Post" action="../notes/save">
              <div class="field">
                <label class="label">New Note</label>
                <p class="control">
                  <input name="noteTitle" class="input" type="text" placeholder="Note title" value="">
                </p>
              </div>

              <div class="field">
                
                <p class="control">
                  <textarea name="note" class="textarea" placeholder="Note here"></textarea>
                </p>
              </div>
              <div class="field">
                <p class="control">
                  <input class="button is-active" type="submit" value="Save Note">
                </p>
                
              </div>
            </form>
                
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