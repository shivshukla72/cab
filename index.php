<?php include 'header.php'; ?>
<div class="container-fluid background image-fluid">
  <div class="container text-center py-5 heading">
    <h2 class=" heading1">Book a CedCab to Your Destination in town</h2>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-lg-6  formdiv pt-2 mb-3 ">
        <form action="" method="POST" id="submit">
          <div class="text-center">
            <button class="btn button1"><b>CEDCAB</b></button>
          </div>
          <div class="text-center py-2">
            <h3><b>Your everyday travel partner</h3>
            <p>AC Cabs for point to point travel</p>
          </div>
          <div>
            <label for="pickup" class="form-label">PICKUP</label>
            <select name="pickup" id="pickup" class="form-control locations">
              <option value="">Current Location</option>
              <option value="Charbagh">Charbagh</option>
              <option value="IndraNagar">Indra Nagar</option>
              <option value="BBD">BBD</option>
              <option value="Barabanki">Barabanki</option>
              <option value="Faizabad">Faizabad</option>
              <option value="Basti">Basti</option>
              <option value="Gorakhpur">Gorakhpur</option>

            </select>
          </div>
          <div>
            <label for="drop" class="form-label">DROP</label>
            <select name="drop" id="drop" class="form-control locations">
              <option value="">Drop Location</option>
              <option value="Charbagh">Charbagh</option>
              <option value="IndraNagar">Indra Nagar</option>
              <option value="BBD">BBD</option>
              <option value="Barabanki">Barabanki</option>
              <option value="Faizabad">Faizabad</option>
              <option value="Basti">Basti</option>
              <option value="Gorakhpur">Gorakhpur</option>

            </select>
          </div>
          <div>
            <label for="cabtype">CAB TYPE</b></label>
            <select name="cabtype" id="cabtype" class="form-control cabtype">
              <option value="">Cab type</option>
              <option value="cedmicro">CedMicro</option>
              <option value="cedmini">CedMini</option>
              <option value="cedroyal">CedRoyal</option>
              <option value="cedsuv">CedSUV</option>
            </select>
          </div>
          <div>
            <input type="number" class="form-control my-2" name="weight" id="weight" placeholder="Luggage   Enter wieght in KG">

          </div>
          <div>
            <input type="submit" class="form-control mb-2 button2" value="Calculate Fare" data-toggle="modal" data-target="#mymodal">
          </div>
        </form>
      </div>
      <div class="col-sm-6 col-lg-6 resultdiv">
        <div class="modal tabindex=" -1" id="mymodal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-tittle">CedCab Fare</h4>

              </div>
              <div class="modal-body">
                <p id="pickups"></p>
                <p id="drops"></p>
                <p id="distances"></p>
                <p id="weights"></p>
                <p id="rates"></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>

<script>
  var dis;
  $(".locations").on('change', function() {
    var selected = $(this).val();
    var others = $(".locations").not(this);
    console.log(others);
    others.find('option').prop('disabled', false);
    others.find('option[value=' + selected + ']').prop('disabled', true);
  });
  $(".cabtype").on('change', function() {

    var cab = document.getElementById('cabtype').value;
    console.log(cab);
    if (cab == 'cedmicro') {
      $("#weight").prop('disabled', true);
      $("#weight").prop('placeholder', "Micro Cabs not allowed luggage");


    } else {
      $("#weight").prop('disabled', false);
      $("#weight").prop('placeholder', "Luggage   Enter wieght in KG");
    }
  });
  $(document).ready(function() {


    $("#submit").submit(function(evt) {

      evt.preventDefault();


      var pickup = document.getElementById('pickup').value;
      var drop = document.getElementById('drop').value;
      var cabtype = document.getElementById('cabtype').value;
      var weight = document.getElementById('weight').value;
      $.ajax({
        url: 'calculate1.php',
        type: 'post',
        dataType: 'JSON',
        data: {
          'pickup': pickup,
          'drop': drop,
          'cabtype': cabtype,
          'weight': weight
        },

        success: function(response) {
          console.log(response);
          document.getElementById('pickups').innerHTML = "Pickup:" + response['pickup'];
          document.getElementById('drops').innerHTML = "Drop:" + response['drop'];
          document.getElementById('weights').innerHTML = "Luggage Weight:" + response['weight'] + "KG";
          document.getElementById('distances').innerHTML = "Distance:" + response['distances'] + "KM.";
          document.getElementById('rates').innerHTML = "Amount: Rs" + response['rate'];

        }

      })


    })

  });
</script>

</html>