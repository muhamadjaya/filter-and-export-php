<?php

$connect = new PDO("mysql:host=localhost;dbname=pelaporan", "root", "");
$start_date_error = '';
$end_date_error = '';


if(isset($_POST["export"]))
{
    if(empty($_POST["from_date"]))
    {
        $start_date_error = '<label class="text-danger">Start Date is required</label>';
    } 
    
    else if(empty($_POST["to_date"]))
    {
        $end_date_error = '<label class="text-danger">End Date is required</label>';
    }
    
    else
    {
        $file_name = 'Pelaporan Pusdafil Info'.date('dmY').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");
        $file = fopen('php://output', 'w');
        $header = array("Fdc Submit", "Date");
 

        fputcsv($file, $header);
        $date1 = date("Y-m-d", strtotime($_POST['from_date']));
        $date2 = date("Y-m-d", strtotime($_POST['to_date']));
        $query = "SELECT * FROM pusdafil_info WHERE date(`date`) BETWEEN '$date1' AND '$date2' ORDER BY date(`date`) desc";

        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        foreach($result as $row){
           $data = array();
           $data[] = $row["pusdafil_submit"];
           // $data[] = $row["date"];
           fputcsv($file, $data);
        }
  
        fclose($file);
        exit;
    }
}

$query = "SELECT * FROM pusdafil_info ORDER BY `date` DESC";

$statement = $connect->prepare($query);
$statement->execute();
ini_set('memory_limit', '-1');
$result = $statement->fetchAll();
?>



