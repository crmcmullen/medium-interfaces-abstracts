<?php

require_once ('orders.php');

$cOrders = new Orders;

$res = $cOrders->getList($_GET['cn']);

// if response is successful, display results.
if ($res['response'] === '200' || '204') {
    echo '<h1>CUSTOMER ORDERS LIST</h1>';
    echo '<table>';
    echo '<tr>';
    echo '<th style="text-align: left; width: 200px;">Order Number</th>';
    echo '<th style="text-align: left; width: 200px;">Order Date</th>';
    echo '<th style="text-align: left; width: 150px;">Status</th>';
    echo '</tr>';

    if (isset($res['dataArray'])) {
        // if this customer has orders
        foreach($res['dataArray'] as $result) {
            echo '<tr>';
            echo '<td>' . $result['orderNumber'] . '</a></td>';
            echo '<td>' . $result['orderDate'] . '</td>';
            echo '<td>' . $result['status'] . '</td>';
            echo '</tr>';
        }
    } else {
        // no orders
        echo '<tr><td colspan="3">Customer has no orders.</td></tr>';
    }

    echo '</table>';
    echo '<br /><br />';
    echo '<a href="index.php"><< BACK TO CUSTOMER LIST</a>';

} else {
    echo 'Unable to display results.';
}