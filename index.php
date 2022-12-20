<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => "no",
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => "no",
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];


$hotelsFilter = [];
$activeFilter = isset($_GET["park"]) || isset($_GET["star"]);


if ($activeFilter) {

  foreach ($hotels as $hotel) {
    $push = true;
    if ( $_GET["park"] === "si") {
      $_GET["park"] = true;
      
    } elseif ( $_GET["park"] === "no") {
      $_GET["park"] = "no" ;

    }
    if (isset($_GET["park"]) && !str_contains( $hotel["parking"], $_GET["park"])) {
      $push = false;
      

    } 
    if (isset($_GET["star"]) &&  $hotel["vote"] < $_GET["star"]) {
      $push = false;
    }
    if ($push) {
      $hotelsFilter[] = $hotel;
    }
  }
} else {
  $hotelsFilter = $hotels;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotels</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
  <section>
    <div class="container">
      <h1 class="pt-3 text-center text-danger">HOTEL'S</h1>
      <form action="" method="GET" class="my-5 border p-3">
    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label class="form-label">Scrivi (si) se vuoi cercare l'hotel con parcheggio parcheggio, oppure scrivi (no)</label>
          <input type="text" class="form-control" name="park" value="<?php echo $_GET["park"] ?? '' ?>">
        </div>
      </div>

      <div class="col-6">
        <div class="mb-3">
          <label class="form-label">Inserire da quante stelle deve partire l'hotel da cercare</label>
          <input type="number" class="form-control" name="star" value="<?php echo $_GET["star"] ?? '' ?>">
        </div>
      </div>
    </div>

    <button class="btn btn-danger">Cerca</button>
    <a class="btn btn-warning" href="index.php">Annulla</a>
  </form>
    </div>
  </section>

  <section>
    <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>Hotel's</th>
          <th>Descrizione</th>
          <th>Parcheggio</th>
          <th>Voto</th>
          <th>Distanza dal Centro</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($hotelsFilter as $hotel) {
        ?>
          <tr>
            <td><?php echo $hotel["name"] ?></td>
            <td><?php echo $hotel["description"] ?></td>
            <td><?php if($hotel["parking"] === true) {
            echo "Disponibile";
            } else {
            echo "Non Disponibile";
            }  ?></td>
            <td><?php echo $hotel["vote"] . " &#9733;" ?></td>
            <td><?php echo $hotel["distance_to_center"] . " Km" ?></td>
           
          </tr>
        <?php
        }
        ?>

      </tbody>
    </div>
  </section>
</body>
</html>