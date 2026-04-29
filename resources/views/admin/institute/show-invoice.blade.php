<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        .invoice-wrapper {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: #1565c0;
            color: #fff;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 {
            margin: 0;
        }

        .content {
            padding: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .box {
            background: #f9fafc;
            padding: 15px;
            border-radius: 8px;
        }

        .box h4 {
            margin-bottom: 8px;
            color: #1565c0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background: #1565c0;
            color: #fff;
            padding: 10px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .total {
            text-align: right;
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            padding: 20px 30px;
            background: #f9fafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .paid {
            background: #28a745;
            color: #fff;
        }

        .pending {
            background: #ffc107;
            color: #000;
        }

        .print-btn {
            background: #1565c0;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="invoice-wrapper">

        <!-- HEADER -->
        <div class="header">
            <div>
                <h2>Invoice</h2>
                <small>Order: {{ $payment->order_id }}</small><br>
                <small>{{ $payment->created_at->format('d M Y') }}</small>
            </div>

            @if($payment->institute->logo)
                <img src="{{ asset('storage/' . $payment->institute->logo) }}" height="60">
            @endif
        </div>

        <!-- CONTENT -->
        <div class="content">

            <div class="grid">

                <!-- Institute -->
                <div class="box">
                    <h4>Institute Details</h4>
                    <strong>{{ $payment->institute->name }}</strong><br>
                    {{ $payment->institute->city->name ?? '' }},
                    {{ $payment->institute->state->name ?? '' }}<br>
                    {{ $payment->institute->mobile }}<br>
                    {{ $payment->institute->owner_email }}
                </div>

                <!-- Billing -->
                @if($payment->institute->gst_invoice)
                    <div class="box">
                        <h4>Billing Details</h4>
                        {{ $payment->institute->business_name }}<br>
                        GSTIN: {{ $payment->institute->gstin }}<br>
                        {{ $payment->institute->billing_address }}<br>
                        {{ $payment->institute->invoice_email }}
                    </div>
                @endif

            </div>

            <!-- TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Duration</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->instituteplan->plan->name ?? '-' }}</td>
                        <td>
                            {{ optional($payment->instituteplan)->start_date?->format('d M Y') }}
                            -
                            {{ optional($payment->instituteplan)->expiry_date?->format('d M Y') }}
                        </td>
                        <td>₹{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="total">
                Total: ₹{{ number_format($payment->amount, 2) }}
            </div>

        </div>

        <!-- FOOTER -->
        <div class="footer">

            <div>
                Method: {{ ucfirst($payment->method ?? 'Online') }}<br>
                Payment ID: {{ $payment->payment_id ?? '-' }}
            </div>

            <div>
                Status:
                <span class="badge {{ $payment->status == 'paid' ? 'paid' : 'pending' }}">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>

            <button class="print-btn" onclick="window.print()">Print</button>

        </div>

    </div>

</body>

</html>