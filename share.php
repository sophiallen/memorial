<!doctype html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="robots" content="noindex,nofollow" />
    <meta name="viewport" content="width=device-width">

    <title>Julia Marian Blaszcak</title>

    <link href="https://fonts.googleapis.com/css?family=Parisienne" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon-heart.ico">


    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <!--Remy Sharp Shim --> 
  <!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
  </script> 
  <![endif]-->
</head>
<body>
  <nav>
    <button class="mobile">Menu</button>
    <ul>
      <li><a href="index.html">Main</a></li>
      <li><a href="biography.html">Biography</a></li>
      <li><a href="album.html">Photo Album</a></li>
      <li><a href="memories.html">Memories</a></li>
      <li><a class="current" href="share.php">Share</a></li>
    </ul>
  </nav>
  <main>
    <div class="form-contain">
        <?php include 'includes/simple.php';?> 
    </div>
  </main>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript">
      $('button.mobile').on('click', function(){
      $('nav ul').slideToggle();
    });
</script>
</body>
</html>