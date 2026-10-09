<?php

/* SELECT 
  CASE 
    WHEN paiement_type = 'cash' THEN 'cash'
    ELSE 'non-cash'
  END AS paiement_type,
  COUNT(*) AS total_orders
FROM (
  SELECT paiement_type FROM orders
  UNION ALL
  SELECT paiement_type FROM normal_orders
  UNION ALL
  SELECT paiement_type FROM menu_pers
) AS all_data
GROUP BY 
  CASE 
    WHEN paiement_type = 'cash' THEN 'cash'
    ELSE 'non-cash'
  END; */

/*SELECT COUNT(*) AS total_orders
FROM(SELECT date_order FROM orders
UNION ALL
SELECT date_order FROM normal_orders
UNION ALL
SELECT date_order FROM menu_pers) AS all_date; */

/* SELECT 100 * (SELECT COUNT(*)FROM orders)/(SELECT COUNT(*) AS total_orders FROM(SELECT date_order FROM orders UNION ALL SELECT date_order FROM normal_orders UNION ALL SELECT date_order FROM menu_pers) AS all_date)AS result 
UNION ALL SELECT 100 * (SELECT COUNT(*)FROM menu_pers)/(SELECT COUNT(*) AS total_orders FROM(SELECT date_order FROM orders UNION ALL SELECT date_order FROM normal_orders UNION ALL SELECT date_order FROM menu_pers) AS all_date)AS result 
UNION ALL SELECT 100 * (SELECT COUNT(*)FROM normal_orders)/(SELECT COUNT(*) AS total_orders FROM(SELECT date_order FROM orders UNION ALL SELECT date_order FROM normal_orders UNION ALL SELECT date_order FROM menu_pers) AS all_date)AS result;
 */

/*  SELECT 100 * ((SELECT COUNT(*)FROM orders)+(SELECT COUNT(*)FROM menu_pers))/(SELECT COUNT(*) AS total_orders FROM
(SELECT date_order FROM orders 
UNION ALL SELECT date_order FROM normal_orders UNION ALL SELECT date_order FROM menu_pers) AS all_date)AS result  
UNION ALL SELECT 100 * (SELECT COUNT(*)FROM normal_orders)/(SELECT COUNT(*) AS total_orders FROM(SELECT date_order FROM orders UNION ALL SELECT date_order FROM normal_orders UNION ALL SELECT date_order FROM menu_pers) AS all_date)AS result; */





/* SELECT 100 * ((SELECT COUNT(*)FROM orders)+(SELECT COUNT(*)FROM menu_pers))/(SELECT COUNT(*) AS total_orders FROM
(SELECT date_order FROM orders 
UNION ALL SELECT date_order FROM normal_orders UNION ALL SELECT date_order FROM menu_pers) AS all_date)AS result  
UNION ALL SELECT 100 * (SELECT COUNT(*)FROM normal_orders)/(SELECT COUNT(*) AS total_orders FROM(SELECT date_order FROM orders UNION ALL SELECT date_order FROM normal_orders UNION ALL SELECT date_order FROM menu_pers) AS all_date)AS result
UNION ALL
SELECT 
  ROUND(COUNT(*) * 100.0 / total.total_count, 2) AS percentage
FROM (
  SELECT paiement_type FROM orders
  UNION ALL
  SELECT paiement_type FROM normal_orders
  UNION ALL
  SELECT paiement_type FROM menu_pers
) AS all_data,
(
  SELECT COUNT(*) AS total_count
  FROM (
    SELECT paiement_type FROM orders
    UNION ALL
    SELECT paiement_type FROM normal_orders
    UNION ALL
    SELECT paiement_type FROM menu_pers
  ) AS total_data
) AS total
GROUP BY 
  CASE 
    WHEN paiement_type = 'cash' THEN 'cash'
    ELSE 'non-cash'
  END; */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{  
    public function getTopMenus()
{
    $topMenus = DB::select("
        SELECT m.id_menu, m.name, m.image, m.type, SUM(o.total_quantity) AS total_orders
        FROM menus m
        JOIN (
            SELECT id_menu, SUM(quantity) AS total_quantity
            FROM orders
            GROUP BY id_menu
            UNION ALL
            SELECT id_menu, SUM(quantity) AS total_quantity
            FROM normal_orders
            GROUP BY id_menu
        ) o ON m.id_menu = o.id_menu
        GROUP BY m.id_menu, m.name, m.image, m.type
        ORDER BY total_orders DESC
        LIMIT 5
    ");

    return response()->json($topMenus);
}

    public function ordersByDate(Request $request)
{
    $dates = DB::select("
        SELECT 
    CASE
        WHEN DAY(date_order) <= 7 THEN 'Week 1'
        WHEN DAY(date_order) <= 14 THEN 'Week 2'
        WHEN DAY(date_order) <= 21 THEN 'Week 3'
        WHEN DAY(date_order) <= 28 THEN 'Week 4'
        ELSE 'Remaining Days (29-31)'
    END AS week_period,
    COUNT(*) AS total_orders
    FROM (
        SELECT date_order FROM orders
        WHERE MONTH(date_order) = MONTH(CURDATE()) AND YEAR(date_order) = YEAR(CURDATE())
        UNION ALL
        SELECT date_order FROM menu_pers
        WHERE MONTH(date_order) = MONTH(CURDATE()) AND YEAR(date_order) = YEAR(CURDATE())
        UNION ALL
        SELECT date_order FROM normal_orders
        WHERE MONTH(date_order) = MONTH(CURDATE()) AND YEAR(date_order) = YEAR(CURDATE())
    ) AS all_dates
    GROUP BY week_period
    ORDER BY week_period;
    ");

    if ($request->ajax()) {
        return response()->json(['status' => 'success', 'data' => $dates]);
    }
    return response()->json(['status' => 'success', 'data' => $dates]);

    //return view('report.orders_by_date', compact('dates'));
}

public function payement_Order(Request $request)
{
    $data = DB::select("
                WITH total_orders AS (
            SELECT COUNT(*) AS total_count
            FROM (
                SELECT date_order FROM orders
                UNION ALL
                SELECT date_order FROM normal_orders
                UNION ALL
                SELECT date_order FROM menu_pers
            ) AS all_orders
        ),
        total_payments AS (
            SELECT COUNT(*) AS total_count
            FROM (
                SELECT paiement_type FROM orders
                UNION ALL
                SELECT paiement_type FROM normal_orders
                UNION ALL
                SELECT paiement_type FROM menu_pers
            ) AS all_payments
        ),
        online_order_total AS (
            SELECT COUNT(*) AS count
            FROM (
                SELECT date_order FROM orders
                UNION ALL
                SELECT date_order FROM menu_pers
            ) AS online_orders
        ),
        normal_order_total AS (
            SELECT COUNT(*) AS count
            FROM normal_orders
        )
        SELECT 'Online Order' AS label,
            ROUND((SELECT count FROM online_order_total) * 100.0 / (SELECT total_count FROM total_orders), 2) AS percentage

        UNION ALL

        SELECT 'Normal Order',
            ROUND((SELECT count FROM normal_order_total) * 100.0 / (SELECT total_count FROM total_orders), 2)

        UNION ALL

        SELECT payment_type_group.label,
            ROUND(COUNT(*) * 100.0 / (SELECT total_count FROM total_payments), 2)
        FROM (
            SELECT CASE
                    WHEN paiement_type = 'cash' THEN 'Cash'
                    ELSE 'Non-Cash'
                END AS label
            FROM (
                SELECT paiement_type FROM orders
                UNION ALL
                SELECT paiement_type FROM normal_orders
                UNION ALL
                SELECT paiement_type FROM menu_pers
            ) AS payments
        ) AS payment_type_group
        GROUP BY payment_type_group.label;



    
    ");

    if ($request->ajax()) {
        return response()->json(['status' => 'success', 'data' => $data]);
    }
    return response()->json(['status' => 'success', 'data' => $data]);
    //return view('home', compact('data'));
}
}
