<?php
session_start();

if ( !isset($_SESSION["username"]) ) {
  header("Location: login.php");
  exit;
}

include('db_config.php');
include('export_pusdafil.php');

$query = "SELECT * FROM pusdafil_info ORDER BY date(`date`) desc";  
$result = mysqli_query($con, $query);  
?>

<html>

<head>
  <title>Pelaporan Pusdafil Info</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
<div role="navigation" class="navbar navbar-default navbar-static-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.php" class="navbar-brand">PELAPORAN</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">FDC</a></li>
           <li class="active"><a href="pusdafil.php">PUSDAFIL</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="logout.php">LOGOUT</a></li>
          </ul>         
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container" style="min-height:500px;">
  <div class="container">
    <h3>Pusdafil Info</h3>
    </br>
    <div class="row">
        <form method="post">
      
            <div class="col-md-3">
              <input type="text" name="from_date" id="from_date" class="form-control dateFilter" placeholder="From Date" autocomplete="off" />
              <?php echo $start_date_error; ?>
            </div>
            <div class="col-md-3">
              <input type="text" name="to_date" id="to_date" class="form-control dateFilter" placeholder="To Date" autocomplete="off" />
              <?php echo $end_date_error; ?>
            </div>
            <div class="col-md-4">
              <input type="button" name="search" id="btn_search" value="Search" class="btn btn-primary" />
              <a href="pusdafil.php" class="btn btn-success">Refresh</a>
              <input type="submit" name="export" value="Export" class="btn btn-default"/>
            </div>
        </form>
    
    </div>
 
    </br>
    <div class="row">
      <div class="col-md-12">
        <div id="pusdafil_table">
          <table class="table table-bordered">
            <tr>
              <th width="40%">Pusdafil Submit</th>
              <th width="20%">Date</th>
            </tr>
            <?php
            while($row = mysqli_fetch_array($result))  
            {  
            ?>  
              <tr>  
                  <td><?= substr($row["pusdafil_submit"], 0, 40); ?>...</td> 
                  <td>
                    <?php
                      $tglpost = $row["date"];

                      $tanggal = substr($tglpost,8,2);
                      $bulan   = substr($tglpost,5,2);
                      $tahun   = substr($tglpost,0,4);

                      $tglan = date($tanggal.'-'.$bulan.'-'.$tahun);

                      echo $tglan;
                    ?>
                  </td>
              </tr>  
            <?php  
            }  
            ?>
          </table>
        </div>
      </div>
    </div>

  </div>
  <script>
    $(document).ready(function () {

      $('.dateFilter').datepicker({
        dateFormat: "dd-mm-yy"
      });

      $('#btn_search').click(function () {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
          $.ajax({
            url: "search_pusdafil.php",
            method: "POST",
            data: { from_date: from_date, to_date: to_date },
            success: function (data) {
              $('#pusdafil_table').html(data);
            }
          });
        }
        else {
          alert("Please Select the Date");
        }
      });
    });
  </script>
</body>

</html>