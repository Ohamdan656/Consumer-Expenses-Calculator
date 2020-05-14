<?php

$url = 'https://rs-coding-exercise.s3.amazonaws.com/2020/orders-2020-02-10.json';
$response = json_decode(file_get_contents($url), true);

//TASK 1
$lenOfOrders = count($response['orders']);
$expensiveOrder = 0;
for($i=0;$i<$lenOfOrders;$i++){
    if ($response['orders'][$i]['total_price']>$expensiveOrder){
        $expensiveOrder = $response['orders'][$i]['total_price'];
    }
}
echo "Most expensive order = ".$expensiveOrder."<br>";

//TASK 2
$year = date('Y');
$sumYear1 = 0;
$sumYear2 = 0;
$sumYear3 = 0;

for($i=0;$i<$lenOfOrders;$i++){

    if(strpos($response['orders'][$i]['created_date'],$year)!==false){
        $sumYear1 = $sumYear1+$response['orders'][$i]['total_price'];
    }

}
$year-=1;
$year="".$year;
for($i=0;$i<$lenOfOrders;$i++){
    if(strpos($response['orders'][$i]['created_date'],$year)!==false){
        $sumYear2 = $sumYear2+$response['orders'][$i]['total_price'];
    }

}
$year-=1;
$year="".$year;
for($i=0;$i<$lenOfOrders;$i++){

    if(strpos($response['orders'][$i]['created_date'],$year)!==false){
        $sumYear3 = $sumYear3+$response['orders'][$i]['total_price'];
    }

}
echo "Total price of orders in 2018 = ".$sumYear3."<br>";
echo "Total price of orders in 2019 = ".$sumYear2."<br>";
echo "Total price of orders in 2020 = ".$sumYear1."<br>";

//TASK 3

$lenOfCustomers = count($response['customers']);
$customers = array();
$customersName = array();
$mostOrderCustId;
$mostOrders = 0;

for($i=0;$i<$lenOfCustomers;$i++){
    $custId = $response['customers'][$i]['id'];
    $customers[$custId] = 0;
    $customersName[$custId] = $response['customers'][$i]['name'];
    for($i=0;$i<$lenOfOrders;$i++){
        if ($response['orders'][$i]['customer_id']==$custId){
            $customers[$custId]++;
        }
    }

}
$maxOrderId = array_keys($customers, max($customers));
echo "Customer with most orders = ".$maxOrderId[0]." ".$customersName[$maxOrderId[0]];

?>