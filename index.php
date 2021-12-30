<!DOCTYPE HTML>
<html>

<head>
  <title>Arvontakone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php
  //Alustetaan muuttujat
  $minArvo = "";
  $maxArvo = "";
  $numLkm = "";
  $numerot = array();
  $x = 1;

  //Haetaan syötetyt arvot
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minArvo = $_POST["minArvo"];
    $maxArvo = $_POST["maxArvo"];
    $numLkm = $_POST["numLkm"];
  }

  ?>
  <div class="container mt-3">
    <h2>Lotto/Keno arvonta </h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="mb-3">
        <label for="peli">Peli:</label>
        <select id="peli" class="form-control" onChange="update()">
          <option value="keno">Keno</option>
          <option value="lotto">Lotto</option>
        </select>
        <label for="NumeroidenMäärät">Montako numeroa?</label> <input type="number" class="form-control" id="numerot" name="numLkm" onChange="checkking()" value="<?php echo $numLkm ?>"> <span id="error"></span>
        <label for="Alkunumerot">Lähtönumero:</label> <input type="number" class="form-control" id="minimi" name="minArvo" value="<?php echo $minArvo ?>">
        <label for="LoppuNumerot">Loppunumero:</label> <input type="number" class="form-control" id="maksimi" name="maxArvo" value="<?php echo $maxArvo ?>">
      </div>
      <input type="submit" name="submit" class="btn btn-primary" value="Arvo numerot">

    </form>

    <script type="text/javascript">
      //Automaattinen täyttö pelivalinnasta riippuen
      function update() {
        let select = document.getElementById('peli');
        let option = select.options[select.selectedIndex];

        switch (option.value) {
          case "keno":
            document.getElementById('minimi').value = 1;
            document.getElementById('maksimi').value = 70;
            break;
          case "lotto":
            document.getElementById('numerot').value = 7;
            document.getElementById('minimi').value = 1;
            document.getElementById('maksimi').value = 40;
            break;
          default:
            document.getElementById('numerot').value = "";
            document.getElementById('minimi').value = "";
            document.getElementById('maksimi').value = "";
        }
      }
      update()

      function checkking() {
        let a = document.getElementById('numerot').value;
        let b = document.getElementById('error');
        let c = document.getElementById('maksimi').value;
        if (a > 34) {
          b.innerHTML = a + c;
        } else {
          b.innerHTML = "";
        }
      }
    </script>

    <?php
    //Arvotaan numerot
    while ($x <= $numLkm) {
      $uusiNum = random_int($minArvo, $maxArvo);

      if (in_array($uusiNum, $numerot)) {
      } else {
        array_push($numerot, $uusiNum);
        $x++;
      }
    }
    sort($numerot);
    for ($x = 0; $x < count($numerot); $x++) {
      echo $numerot[$x];
      echo "<br>";
    }


    ?>
  </div>


</body>

</html>