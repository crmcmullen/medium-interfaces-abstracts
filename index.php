<?php

require_once ('customers.php');

$cCustomers = new Customers;
$allCustomers = 0;

$res = $cCustomers->getList($allCustomers);

// if response is successful, display results.
if ($res['response'] === '200' || '204') {
    echo '<h1>CUSTOMER LIST</h1>';
    echo '<table>';
    echo '<tr>';
    echo '<th style="text-align: left; width: 200px;">Customer Number</th>';
    echo '<th style="text-align: left; width: 200px;">Customer Name</th>';
    echo '</tr>';
    
    if (isset($res['dataArray'])) {
        // if a customer list exists
        foreach($res['dataArray'] as $result) {
            echo '<tr>';
            echo '<td><a href="customerOrders.php?cn=' . $result['customerNumber'] . '">' . $result['customerNumber'] . '</a></td>';
            echo '<td>' . $result['customerName'] . '</td>';
            echo '</tr>';
        }
    } else {
        // no customers in list.
        echo '<tr><td colspan="2">No customers included in this list.</td></tr>';
    }

    echo '</table>';

} else {
    echo 'Unable to display results.';
}