<?php
if (isset($_POST['pickup'])) {
  $pickup1 = $_POST['pickup'];
  $drop1 = $_POST['drop'];
  $cabtype1 = $_POST['cabtype'];
  $weight1 = $_POST['weight'];
  $obj = new cabs($pickup1, $drop1, $cabtype1, $weight1);
  $obj->distance();
  $obj->typeOfCab();
}
class cabFare
{
  public $pickup,$drop,$cabtype,$weight;
  public $value1,$value2,$luggageRate,$finalrate, $distances;
  function __construct($val1, $val2, $val3, $val4)
  {
    $this->pickup = $val1;
    $this->drop = $val2;
    $this->cabtype = $val3;
    $this->weight = $val4;
  }
  public $locations = ['Charbagh' => 0,
                       'IndraNagar' => 10,
                        'BBD' => 30, 'Barabanki' => 60,
                         'Faizabad' => 100,
                          'Basti' => 150, 'Gorakhpur' => 210];
  
  public function distance()
  {
    foreach ($this->locations as $key => $value) {
      if ($key == $this->pickup) {
        $value1 = $value;
      }
    }
    foreach ($this->locations as $key => $value) {
      if ($key == $this->drop) {
        $value2 = $value;
      }
    }
    $this->distances = abs($value2 - $value1);
  }

  public function microcab()
  {
    if ($this->distances <= 10) {
      $finalrate = (($this->distances * 13.50) + 50);
    } elseif ($this->distances > 10 && $this->distances <= 60) {
      $finalrate = (($this->distances - 10) * 12 + (13.50 * 10) + 50);
    } elseif ($this->distances > 60 && $this->distances <= 160) {
      $finalrate = (($this->distances - 60) * 10.20 + (50 * 12) + (10 * 13.50) + 50);
    } elseif ($this->distances > 160) {
      $finalrate = (($this->distances - 160) * 8.50 + (100 * 10.20) + (50 * 12) + (10 * 13.50) + 50);
    }
    $result = ['distances' => $this->distances, 'pickup' => $this->pickup, 'drop' => $this->drop, 'weight' => $this->weight, 'rate' => $finalrate];
    echo json_encode($result);
  }
  public function minicab()
  {
    if ($this->distances <= 10) {
      $finalrate = (($this->distances * 14.50) + 150+$this->luggageRate);
    } elseif ($this->distances > 10 && $this->distances <= 60) {
      $finalrate = (($this->distances - 10) * 13 + (14.50 * 10) + 150+$this->luggageRate);
    } elseif ($this->distances > 60 && $this->distances <= 160) {
      $finalrate = (($this->distances - 60) * 11.20 + (50 * 13) + (10 * 14.50) + 150+$this->luggageRate);
    } elseif ($this->distances > 160) {
      $finalrate = (($this->distances - 160) * 9.50 + (100 * 11.20) + (50 * 13) + (10 * 14.50) + 150+$this->luggageRate);
    }

    $result = ['distances' => $this->distances, 'pickup' => $this->pickup, 'drop' => $this->drop, 'weight' => $this->weight, 'rate' => $finalrate];
    echo json_encode($result);
  }
  public function royalcab()
  {
    if ($this->distances <= 10) {
      $finalrate = (($this->distances * 15.50) + 200+$this->luggageRate);
    } elseif ($this->distances > 10 && $this->distances <= 60) {
      $finalrate = (($this->distances - 10) * 14 + (15.50 * 10) + 200+$this->luggageRate);
    } elseif ($this->distances > 60 && $this->distances <= 160) {
      $finalrate = (($this->distances - 60) * 12.20 + (50 * 14) + (10 * 15.50) + 200+$this->luggageRate);
    } elseif ($this->distances > 160) {
      $finalrate = (($this->distances - 160) * 10.50 + (100 * 12.20) + (50 * 14) + (10 * 15.50) + 200+$this->luggageRate);
    }

    $result = ['distances' => $this->distances, 'pickup' => $this->pickup, 'drop' => $this->drop, 'weight' => $this->weight, 'rate' => $finalrate];
    echo json_encode($result);
  }
  public function suvcab()
  {
    if ($this->distances <= 10) {
      $finalrate = (($this->distances * 16.50) + 250+(2*($this->luggageRate)));
    } elseif ($this->distances > 10 && $this->distances <= 60) {
      $finalrate = (($this->distances - 10) * 15 + (16.50 * 10) + 250+(2*($this->luggageRate)));
    } elseif ($this->distances > 60 && $this->distances <= 160) {
      $finalrate = (($this->distances - 60) * 13.20 + (50 * 15) + (10 * 16.50) + 250+(2*($this->luggageRate)));
    } elseif ($this->distances > 160) {
      $finalrate = (($this->distances - 160) * 11.50 + (100 * 13.20) + (50 * 15) + (10 * 16.50) + 250+(2*($this->luggageRate)));
    }

    $result = ['distances' => $this->distances, 'pickup' => $this->pickup, 'drop' => $this->drop, 'weight' => $this->weight, 'rate' => $finalrate];
    echo json_encode($result);
  }
}
class cabs extends cabFare
{
  public function typeOfCab()
  {
    switch ($this->cabtype) {
      case 'cedmicro':
        $this->microcab();
        break;
      case 'cedmini':
        $this->luggagePrice();
        $this->minicab();
        break;
      case 'cedroyal':
        $this->luggagePrice();
        $this->royalcab();
        break;
      case 'cedsuv':
        $this->luggagePrice();
        $this->suvcab();
        break;
    }
  }
  public function luggagePrice()
  {
    if($this->weight<=10)
         {
           $this->luggageRate=50;
         }
         elseif($this->weight>10 && $this->weight<=20)
         {
           $this->luggageRate=100;
         }
        elseif($this->weight>20)
        {
          $this->luggageRate=200;
        }
  }
}
