<?php 
// include database connection file
include('db_config.php');

if(isset($_POST["from_date"], $_POST["to_date"])) {
    $orderData = "";
    $date1 = date("Y-m-d", strtotime($_POST['from_date']));
	$date2 = date("Y-m-d", strtotime($_POST['to_date']));
    $query = "SELECT * FROM fdc_info WHERE date(`date`) BETWEEN '$date1' AND '$date2' ORDER BY date(`date`) desc";
    $result = mysqli_query($con, $query);

    $orderData .='
    <table class="table table-bordered">  
    <tr>  
    <th width="40%">FDC Submit</th>  
    <th width="20%">Order No</th>  
    <th width="20%">Username</th>  
    <th width="20%">Date</th>   
    </tr>';

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))  
        {
            
            $fdc = substr($row["fdc_submit"], 0, 40);

            $tglpost = $row["date"];
            $tanggal = substr($tglpost,8,2);
            $bulan   = substr($tglpost,5,2);
            $tahun   = substr($tglpost,0,4);
            $tglan = date($tanggal.'-'.$bulan.'-'.$tahun);
                    
            $orderData .='
            <tr>  
            <td>'.$fdc.'...</td>  
            <td>'.$row["order_no"].'</td>  
            <td>'.$row["user_name"].'</td>  
            <td>'.$tglan.'</td>  
            </tr>';  
        }
    }
    else  
    {  
        $orderData .= '  
        <tr>  
        <td colspan="5">No Order Found</td>  
        </tr>';  
    }  
    $orderData .= '</table>';  
    echo $orderData;  
}
?>
