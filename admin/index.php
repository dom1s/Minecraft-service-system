<?php session_start();
require_once("../duombaze/connect.php");
require_once("../funkcijos.php");
require_once("../duombaze/kintamieji.php");
?>
<?php
	$nick = $_SESSION['admin'];
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	} else {
		$id = "";
	}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Paslaugų administravimas</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/stilius.css" rel="stylesheet">
</head>


<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card bg-white">
                <div class="card-body p-5">


                          <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]){?>

                            <h2 class="fw-bold mb-2 text-uppercase ">Paslaugų sistemos valdymas</h2>
                                <p class=" mb-5">Prisijungta su vartotoju: <?echo "$nick"?></p>

                                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                  </button>

                                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                      <li class="nav-item active">
                                        <a class="nav-link" href="index.php">Instaliavimas</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="index.php?id=serveris">Serveris</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="index.php?id=weboptions">Tinklalapio nustatymai</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="index.php?id=paysera">Paysera</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="index.php?id=newservice">Pridėti paslaugą</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="index.php?id=deleteservice">Ištrinti paslaugą</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="index.php?id=setcmd">Komandų nustatymas</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="index.php?id=adminsettings">Admin nustatymai</a>
                                      </li>
                                      <button class="btn btn-sm btn-primary" type="button"><a href="?atsijungti=1" style="text-decoration: none; color: white;">Atsijungti</a></button>
                                    </ul>
                                  </div>
                                </nav>

						                <?php if($id == ""){ ?>
                              <!-- Instaliavimo/index skiltis -->
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Nustatymas</th>
                                    <th scope="col">Būsena</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Paysera duomenų nustatymai</td>
                                    <td><?php echo $payserabusena; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Serverio nustatymai</td>
                                    <td><?php echo $serveriobusena; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Admin prisijungimų pakeitimas</td>
                                    <td><?php echo $adminduomenis; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Pasikeiskite tinklalapio nustatymus</td>
                                    <td><?php echo $tinklapiobusena;?></td>
                                  </tr>
                                </tbody>
                              </table>




                              <!-- Serverio nustatymai -->
                              <?php }if($id == "serveris"){ ?>
                                <div class="container" style="margin-top: 40px;">
                                  <div class="col-6">
                                    <form method="POST">
                                      <div class="mb-3">
                                        <label class="form-label">Serverio IP adresas</label>
                                        <input type="text" class="form-control" name="ip" placeholder="Įveskite serverio IP adresą...">
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label">Serverio RCON port</label>
                                        <input type="text" class="form-control" name="port" placeholder="Įveskite serverio RCON portą...">
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label">Serverio RCON slaptažodis</label>
                                        <input type="password" class="form-control" name="rcon" placeholder="Įveskite serverio RCON slaptažodį...">
                                      </div>
                                      <button type="submit" class="btn btn-primary" name="serveris">Keisti duomenis</button>
                                      <?php 
                                        if(isset($_POST['serveris'])){
                                          $ip = trim(mysqli_escape_string($con,$_POST['ip']));
                                          $port = trim(mysqli_escape_string($con,$_POST['port']));
                                          $rcon = trim(mysqli_escape_string($con,$_POST['rcon']));
                                          if($ip == "" OR $port == "" OR $rcon == ""){ $klaida = "Paliktas tusčias laukelis..";}
                                          else {
                                            if($ipas == ""){
                                              $irasom = "INSERT INTO serveris(ip, port, rcon) VALUES ('$ip','$port', '$rcon')";
                                            } else {
                                              $irasom = "UPDATE serveris SET ip='$ip', port='$port', rcon='$rcon'";
                                            }
                                            if ($con->query($irasom) === TRUE){
                                              $klaida = "Serverio nustatymai pakeisti!";
                                            }
                                          }
                                          echo $klaida;
                                        }
                                      ?>
                                    </form>
                                  </div>
                                </div>



                                <!-- Tinklalapio nustatymai -->
                                <?php } if($id == "weboptions"){ ?>
                                  <br><h3>Dabartiniai nustatymai</h3>
                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <td>Tinklalapio pavadinimas</td>
                                        <td><?php echo $title;?></td>
                                      </tr>
                                      <tr>
                                        <td>El.paštas</td>
                                        <td><?php echo $email;?></td>
                                      </tr>
                                      <tr>
                                        <td>Discord serverio nuoroda</td>
                                        <td><?php echo $skype;?></td>
                                      </tr>
                                      <tr>
                                        <td>Telefono numeris</td>
                                        <td><?php echo $telnr;?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <br><h3>Nustatymų keitimas</h3>
                                  <div class="container">
                                  <div class="col-6">
                                    <form method="POST">
                                      <div class="mb-3">
                                        <label class="form-label">Tinklalapio pavadinimas</label>
                                        <input type="text" class="form-control" name="title" placeholder="Įveskite tinklalapio pavadinimą...">
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label">Tinklapyje rodomas el.pašto adresas</label>
                                        <input type="email" class="form-control" name="email" placeholder="Įveskite el. pašto adresą...">
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label">Discord serverio adresas</label>
                                        <input type="text" class="form-control" name="skype" placeholder="Įveskite discord serverio adresą...">
                                      </div>
                                      <div class="mb-3">
                                        <label class="form-label">Tinklapyje rodomas telefono numeris</label>
                                        <input type="tel" class="form-control" name="telnr" placeholder="Įveskite telefono numerį...">
                                      </div>
                                      <button type="submit" class="btn btn-primary" name="nustatymai">Keisti duomenis</button>
                                      <?php 
                                        if(isset($_POST['nustatymai'])){
                                          $titles = trim(mysqli_escape_string($con,$_POST['title']));
                                          $emails = trim(mysqli_escape_string($con,$_POST['email']));
                                          $skypes = trim(mysqli_escape_string($con,$_POST['skype']));
                                          $telnrs = trim(mysqli_escape_string($con,$_POST['telnr']));
                                          if($titles == ""){ $titles = $title; }
                                          if($emails == ""){ $emails = $email; }
                                          if($skypes == ""){ $skypes = $skype; }
                                          if($telnrs == ""){ $telnrs = $telnr; }
                                          $irasom = "UPDATE tinklapis SET title='$titles', elpastas='$emails', telnr='$telnrs', skype='$skypes'";
                                          if ($con->query($irasom) === TRUE){
                                            echo "Pakeitimai įrašomi..";
                                          }
                                        }
                                        echo $klaida;
                                      ?>
                                    </form>
                                  </div>
                                </div>
                                


                                <!-- Admin nustatymai -->
                                <?php } if($id == "adminsettings"){ ?>
                                  <div class="container" style="margin-top: 40px;">
                                    <div class="col-6">
                                      <form method="POST" action="index.php?id=adminsettings">
                                        <div class="mb-3">
                                          <label class="form-label">Naujas administratoriaus slapyvardis</label>
                                          <input type="text" class="form-control" name="newnick" placeholder="Įveskite slapyvardį...">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Naujas administratoriaus slaptažodis</label>
                                          <input type="password" class="form-control" name="newpass" placeholder="Įveskite slaptažodį...">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="changeadmin">Keisti duomenis</button>
                                        <?php 
                                          if(isset($_POST['changeadmin'])){
                                            $newnick = trim(mysqli_escape_string($con,$_POST['newnick']));
                                            $newpass = trim(mysqli_escape_string($con,$_POST['newpass']));
                                            $newpasscode = hash('sha512', $newpass);
                                            if($newnick == "" or $newpass == ""){ $klaida = "Duomenys nepakeisti, nes paliktas tusčias laukelis";}
                                            else {
                                            $irasom = "UPDATE admin SET name='$newnick', password='$newpasscode'";
                                              if ($con->query($irasom) === TRUE){
                                                $klaida = "Duomenys sėkmingai pakeisti";
                                              }
                                            $klaida = "Duomenys sėkmingai pakeisti";
                                            }
                                          }
                                          echo $klaida;
                                        ?>
                                      </form>
                                    </div>
                                  </div>
                                                                  


                                <!-- Paysera nustatymai -->
                                <?php } if($id == "paysera"){ ?>
                                  <div class="container" style="margin-top: 40px;">
                                    <div class="col-6">
                                      <form method="POST" action="index.php?id=paysera">
                                        <div class="mb-3">
                                          <label class="form-label">Paysera projekto ID</label>
                                          <input type="text" class="form-control" name="projectid" placeholder="Įveskite payseros projekto ID...">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Paysera projekto slaptažodis</label>
                                          <input type="text" class="form-control" name="projectpassword" placeholder="Įveskite payseros projekto slaptažodį...">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="paysera">Keisti duomenis</button>
                                        <?php
                                          if(isset($_POST['paysera'])){
                                              $projectid = trim(mysqli_escape_string($con,$_POST['projectid']));
                                              $projectpassword = trim(mysqli_escape_string($con,$_POST['projectpassword']));
                                              if($projectid == "" or $projectpassword == ""){ $klaida = "Duomenys nenustatyti, nes paliktas tusčias laukelis";}
                                              else {
                                                if($project == "" or $projectpass == ""){
                                                  $irasom = "INSERT INTO paysera(projectid, sign_password) VALUES ('$projectid','$projectpassword')";
                                                } else {
                                                  $irasom = "UPDATE paysera SET projectid='$projectid', sign_password='$projectpassword'";
                                                }
                                                if ($con->query($irasom) === TRUE){
                                                  $klaida = "Projekto duomenys įrašyti";
                                                }
                                              }
                                            }
                                            echo $klaida;
                                        ?>
                                      </form>
                                    </div>
                                  </div>
                                                                                                    


                                <!-- Pridėti paslaugą -->
                                <?php } if($id == "newservice"){ ?>
                                  <div class="container" style="margin-top: 20px;">
                                  <span class="badge rounded-pill text-bg-primary" style="margin-bottom: 20px;">Sukūrus paslaugą nueikite į skiltį paslaugų komandos ir nustatykite šios paslaugos cmd komandas</span>
                                    <div class="col-6">
                                      <form method="POST" onSubmit="window.location.reload()">

                                        <div class="mb-3">
                                          <label class="form-label">Paslaugos pavadinimas</label>
                                          <input type="text" class="form-control" name="paslauga">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Paslaugos kaina, nerašykite € simbolio, tik skaičių</label>
                                          <input type="text" class="form-control" name="kaina">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Nurodykite žaidėjam kiek dienų bus uždėta paslauga. Jei paslauga vienkartinė, nieko nerašykit, atvaizduos kaip visam laikui.</label>
                                          <input type="text" class="form-control" name="laikas">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">SMS žinutės raktažodis</label>
                                          <input type="text" class="form-control" name="raktazodis">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Numeris kuriuo bus siunčamas raktažodis</label>
                                          <input type="text" class="form-control" name="numeris">
                                        </div>
                                        <div class="mb-3">
                                          <label class="form-label">Trumpas aprašymas</label>
                                          <input type="text" class="form-control" name="subtekstas">
                                        </div>
                                        <div class="mb-3">
                                          <textarea rows="3" size="30" name="galimybes" class="form-control" placeholder="Ką gaus žaidėjas nusipirkes šią paslaugą? Paslaugas atskirti reikia per <li> žymes </li> pvz.: <li> Užrašas VIP - [name] </li>"></textarea> 
                                        </div>
							                          <h5> [nick] - Atvaizduos žaidėjo nick paslaugų sąraše</h5>
                                        <button type="submit" class="btn btn-primary" name="naujapaslauga">Pridėti paslaugą</button>
                                        <?php 
                                          if(isset($_POST['naujapaslauga'])){
                                            $paslauga = trim(mysqli_escape_string($con, $_POST['paslauga']));
                                            $kaina = trim(mysqli_escape_string($con, $_POST['kaina']));
                                            $laikas = trim(mysqli_escape_string($con, $_POST['laikas']));
                                            $raktazodis = trim(mysqli_escape_string($con, $_POST['raktazodis']));
                                            $numeris = trim(mysqli_escape_string($con, $_POST['numeris']));
                                            $subtekstas = trim(mysqli_escape_string($con, $_POST['subtekstas']));
                                            $galimybes = $_POST['galimybes'];
                                            
                                            if($paslauga == "" OR $kaina == "" or $raktazodis == "" or $numeris == "" or $galimybes == ""){ $klaida = "Būtina užpildyti laukelius: Pavadinimas, kaina, raktazodis, numeris, galimybes";}
                                            else {
                                              $irasom = "INSERT INTO paslaugos(pavadinimas, kaina, laikas, raktazodis, numeris, galimybes, subtekstas) VALUES ('$paslauga','$kaina', '$laikas', '$raktazodis', '$numeris', '$galimybes', '$subtekstas')";
                                              if ($con->query($irasom) === TRUE){
                                                $klaida = "Paslauga sėkmingai sukurta, dabar nueik nustatyt paslaugos cmd komandas";
                                              }
                                            }
                                          }
                                          echo $klaida;
                                        ?>
                                      </form>
                                    </div>
                                  </div>
                                                                                                                                      


                                <!-- Ištrinti paslaugą -->
                                <?php } if($id == "deleteservice"){ 
                                  $paslaugos = "SELECT * FROM paslaugos";
                                  $isgaunam = $con->query($paslaugos);
                                  if ($isgaunam->num_rows > 0) {
                                    echo '  
                                    <div class="container" style="margin-top: 20px;">
                                    <div class="col-12">
                                    <h5>Pasirinkite paslaugą, kurią norite ištrinti</h5>
                                    <form method="POST">
                                        <div class="form-group">
                                      <div class="input-group">
                                        <select class="form-control" name="trinam">';
                                      while($p = $isgaunam->fetch_assoc()) {
                                        echo '<option value="'.$p['cid'].'">ID:'.$p['cid'].' - '.$p['pavadinimas'].' / Kaina '.$p['kaina'].'€</option>';
                                      }
                                        echo'</select>
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="remove" style="margin-top: 10px;">Ištrinti</button>
                                    </div>
                                    </div>
                                    </form>
                                    ';
                                  } else {
                                    echo 'Paslaugų nėra';
                                  }
                                    if(isset($_POST['remove'])){
                                      $trinam = $_POST['trinam'];
                                      $delete = "DELETE FROM paslaugos WHERE cid = '$trinam'";
                                      if($trinam == ""){ $klaida = ""; }
                                      else {
                                        if($con->query($delete) === TRUE){
                                            $klaida = "Paslauga ištrinta, perkraukite puslapi, kad nebesimatytu ištrinta paslauga";
                                        }
                                      }
                                      echo $klaida;
                                    }
                                  ?>
                                                                                                                                                                    


                                <!-- Nustatom komandas -->
                                <?php } if($id == "setcmd"){
                                  								$paslaugos = "SELECT * FROM paslaugos";
                                                  $isgaunam = $con->query($paslaugos);
                                                  if ($isgaunam->num_rows > 0) {
                                                    
                                                  echo '  <form method="POST" onSubmit="window.location.reload()">
                                                      <div class="form-group">
                                                    <div class="input-group">
                                                     <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="Pasirinkite paslauga kuriai nustatoma cmd komanda">?</span></span>
                                                      <select class="form-control" name="id">';
                                                    while($p = $isgaunam->fetch_assoc()) {
                                                      echo '<option value="'.$p['cid'].'">ID:'.$p['cid'].' - '.$p['pavadinimas'].' / Kaina '.$p['kaina'].'€</option>';
                                                    }
                                                      echo'</select>
                                                    </div>
                                                  </div>';
                                                  }
                                              ?>
                                                  <div class="form-group">
                                                    <div class="input-group">
                                                     <span class="input-group-addon"> <span class="badge" data-toggle="tooltip" title="CMD komanda kuri bus įvykdoma įvykus sms išsiuntimui">?</span></span>
                                                      <input type="text" class="form-control" name="cmd" placeholder='pex user [nick] group add vip "" 2592000'>
                                                     </div>
                                                  </div>
                                                  <button type="submit" class="btn btn-info" name="setcmd">Nustatyti komandą</button>
                                                  
                                                  <h4><br>Pagalba kuriant komandas</h4>
                                                  <p class="text-warning">1. Svarbiausia yra nustatyti kintamajį <b>[nick]</b> rašant komandą, kitaip sistema nežinos kam uždėti nustatytą komandą</p>
                                                  <p class="text-success">2. Komandos pavyzdys:<br> <b>pex user [nick] group add vip "" 2592000</b><br>Štai šį komandą ivykdis vip uždėjima mėnesio laikotarpiui, būtinos kabūtes, jos reiškia kad ta paslauga bus uždėta visuose pasauliuose t.y. World, Nether ir kt.</p>
                                                  <p class="text-success">3. Komandos nebūtinai turi būti tokios, kad tik paslaugom uždėt, gali būti ir:<br><b> gamemode 1 [nick] - Uždės gamemode<br> pardon [nick] - Atblokuos žaidėją</b></p>
                                                  <p class="text-success">3. Rašyti vienu kartu vieną komanda, komandų pridėti galima N kartų vienai paslaugai</p>
                                                <?Php 
                                                  if(isset($_POST['setcmd'])){
                                                    $cid = $_POST['id'];
                                                    $cmd = $_POST['cmd'];
                                                    
                                                    if($cmd == ""){ $klaida = "Įrašyk komandą";}
                                                    else {
                                                      $irasom = "UPDATE paslaugos SET cmd='$cmd' WHERE cid = '$cid'";
                                                      if ($con->query($irasom) === TRUE){
                                                        $klaida = "CMD komanda įrašyta sėkmingai";
                                                      }
                                                    }
                                                    echo $klaida;
                                                  }
                                                ?>
                                              </form>
                                  










                              <!-- APACIA -->
                              <?php }} else { ?>
                                <form class="form-horizontal" method="POST">
                                  <div class="form-group">
                                  <label for="varas" class="col-sm-2 control-label">Slapyvardis</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" placeholder="Admin slapyvardis">
                                  </div>
                                  </div>
                                  <div class="form-group">
                                  <label for="varas" class="col-sm-2 control-label">Slaptažodis</label>
                                  <div class="col-sm-10">
                                    <input type="password" name="pass" class="form-control" placeholder="Admin slaptažodis">
                                  </div>
                                  </div>
                                  <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <input name="toliau" type="submit" class="btn btn-success" value="Tęsti">
                                  </div>
                                  </div>
                                </form>		

                              <?php } ?>
                              <?php 
                                if(isset($_POST['toliau'])){
                                  $name = $_POST['name'];
                                  $pas = $_POST['pass'];
                                  $pass = hash('sha512', $pas);
                                  if($name == $aname && $pass == $apas){
                                    $_SESSION["admin"] = $_POST['name'];
                                    reload();
                                  } else {
                                    $klaida = "Blogi duomenys...";
                                  }
                                  echo $klaida;
                                }
                              ?>
                              <?php if($_GET['atsijungti'] == 1){ session_destroy(); reload(); } else { echo""; } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
      
      <script src="../js/bootstrap.js"></script>
</body>

</html>