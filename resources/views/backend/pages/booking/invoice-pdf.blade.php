<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $reservation->booking_id }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 14px; margin: 0; padding: 20px; }
        .invoice-title { font-size: 24px; font-weight: bold; }
        .invoice-header, .invoice-summary, .table { width: 100%; margin-bottom: 20px; }
        .table { border-collapse: collapse; width: 100%; }
        .table, .table th, .table td { border: 1px solid black; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .mb-2 { margin-bottom: 10px; }
        .section-title { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1 class="gradient-text">HOTEL RAJMAHAL KUAKATA</h1>
        <h2 class="invoice-title">Invoice</h2>
        <p>Booking ID: #{{ $reservation->booking_id }}</p>
    </div>

    <!-- Customer & Payment Details -->
    <table class="invoice-summary">
        <tr>
            <td>
                <strong>Billed To:</strong><br>
                {{ $reservation->customer->name ?? 'N/A' }}<br>
                {{ $reservation->customer->email ?? 'N/A' }}<br>
                {{ $reservation->customer->phone_number ?? 'N/A' }}<br>
                {{ $reservation->address->city ?? 'N/A' }}, {{ $reservation->address->postal_code ?? '' }}<br>
                {{ $reservation->address->address ?? 'N/A' }}
            </td>
            <td class="text-right">
                <strong>Payment Method:</strong><br>
                {{ $reservation->payment->payment_method ?? 'N/A' }}
            </td>
        </tr>
    </table>

    <!-- Booking Summary -->
    <h3 class="section-title">Booking Summary</h3>
    <table class="table">
        <tr>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Adults</th>
            <th>Children</th>
            <th>Days</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>{{ $reservation->check_in_date ?? 'N/A' }}</td>
            <td>{{ $reservation->check_out_date ?? 'N/A' }}</td>
            <td>{{ $reservation->adults ?? 0 }}</td>
            <td>{{ $reservation->children ?? 0 }}</td>
            <td>{{ $reservation->day_range ?? 'N/A' }}</td>
            <td>{{ $reservation->status ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Payment Summary -->
    <h3 class="section-title">Payment Summary</h3>
    <table class="table">
        <tr>
            <th>Total Amount</th>
            <th>Actual Amount</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
            <th>Payment Status</th>
        </tr>
        <tr>
            <td>{{ number_format($reservation->payment->total_amount ?? 0, 2) }} Tk</td>
            <td>{{ number_format($reservation->payment->actual_amount ?? 0, 2) }} Tk</td>
            <td>{{ number_format($reservation->payment->paid_amount ?? 0, 2) }} Tk</td>
            <td>{{ number_format($reservation->payment->due_amount ?? 0, 2) }} Tk</td>
            <td>{{ $reservation->payment->status ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Assigned Rooms -->
    <h3 class="section-title">Assigned Rooms</h3>
    <table class="table">
        <tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Class</th>
        </tr>
        @forelse ($reservation->assign_rooms as $room)
        <tr>
            <td>{{ $room->room_info->room_number ?? 'N/A' }}</td>
            <td>{{ $room->room_info->room_type ?? 'N/A' }}</td>
            <td>{{ $room->room_info->room_class->name ?? 'N/A' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">No assigned rooms</td>
        </tr>
        @endforelse
    </table>

    <!-- Total Amount -->
    <h3 class="section-title">Final Amount</h3>
    <table class="table">
        <tr>
            <th>Total</th>
            <td class="text-right"><strong>{{ number_format($reservation->payment->total_amount ?? 0, 2) }} Tk</strong></td>
        </tr>
    </table>

</body>
</html>
