<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #<?= $order->id ?></title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            padding: 20px; 
        }
        .invoice-box { 
            max-width: 800px; 
            margin: auto; 
            padding: 30px; 
            border: 1px solid #eee; 
            box-shadow: 0 0 10px #00000026; 
            font-size: 16px; 
            line-height: 24px; 
            color: #555; 
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
        }
        .table { 
            width: 100%; 
            text-align: left; 
            border-collapse: collapse; 
        }
        .table th, .table td { 
            border: 1px solid #ddd; 
            padding: 8px; 
        }
        .total { 
            font-weight: bold; 
            text-align: right; 
            margin-top: 20px; 
        }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <div class="header">
            <h1>MAVPOS</h1>
            <p>Hóa đơn thanh toán</p>
        </div>
        
        <p>
            <strong>Mã đơn:</strong> #<?= $order->id ?><br>
            <strong>Ngày:</strong> <?= $order->created_at ?><br>
            <strong>Nhân viên:</strong> <?= htmlspecialchars($order->staff_name) ?><br>
            <strong>Khách hàng:</strong> <?= htmlspecialchars($order->customer_name) ?> (<?= htmlspecialchars($order->phone) ?>)<br>
            <strong>Địa chỉ:</strong> <?= htmlspecialchars($order->address) ?>
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>SL</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item->product_name) ?></td>
                    <td><?= $item->quantity ?></td>
                    <td><?= number_format($item->unit_price) ?></td>
                    <td><?= number_format($item->total_price) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="total">
            Tổng cộng: <?= number_format($order->total_amount) ?> VND
        </div>
        
        <div class="no-print" style="margin-top: 20px; text-align: center;">
            <button onclick="window.print()">In hóa đơn</button>
            <a href="/posale">Quay lại</a>
        </div>
    </div>
</body>
</html>
