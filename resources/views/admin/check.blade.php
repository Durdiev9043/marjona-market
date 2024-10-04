<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap">
    <style type="text/css">
        * {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 0.8rem;
        }

    </style>
    <title>Resume</title>
    <style>
        @php $height = ((count($pp) ?: 1) * 3) + 10  @endphp
        @page {
            size: 7cm {{ $height }}cm;
            margin: 0;
        }

        .content-wrapper {
            height: auto;
            width: 7cm !important;
        }
    </style>
</head>
<body style="width: 7cm !important;height: auto;">
<div class="content-wrapper" style="margin: 0 auto;display: block;">
    <h3 ALIGN="center">MARJONA <br>ONLINE MARKET</h3>
    Buyurtma haqida ma'lumot
    <table width="100%" border="1">
        <tr>
            <td colspan="2">
                <img src="" style="width:200px;">
            </td>
        </tr>
        <tr>
            <td>Buyurtma raqami:</td>
            <td>{{$order->id}}</td>
        </tr>
        <tr>
            <td>Tel raqam:</td>
            <td>{{$order->user->phone}}</td>
        </tr>
        <tr>
            <td>Manzili:</td>
            <td>{{$order->address_name}}</td>
        </tr>
    </table>
    <?php
    $tt = 0;
    ?>
    @foreach($pp as $item)
            <?php
            $tt = $tt + $item->total_price;
            ?>
        <div style="position: relative;">
            <b>{{ $item->product->name}} </b><br> <b> {{$item->count ?: $item->miqdor}}
                *{{ $item->total_price / ($item->count ?: 1)}}={{$item->total_price}}</b> &nbsp;&nbsp;&nbsp;
            <span style="font-size: 13px">{{ $item->product->code }} //  {{ $item->product->id }}</span>
            <hr>
        </div>
    @endforeach
    Yetkazib berish:
    @if($order->type == 1)
        8 000 so'm
        <br>
        Hammasi: {{$tt + 80000}} so'm
    @elseif($tt > 70000)
        0 so'm
        <br>
        Hammasi: {{$tt}} so'm
        <br>
        <hr>
    @else
        Yetkazib berish:
        5 000 so'm
        <br>
        Hammasi: {{$tt + 5000}} so'm <br>
        <hr>
    @endif
    <h4 ALIGN="center">Xaridingiz uchun raxmat!</h4>
</div>
</body>
</html>
