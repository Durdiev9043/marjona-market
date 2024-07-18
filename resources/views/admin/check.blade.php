<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resume</title>
    <style>
        /*@page { size: auto 8cm landscape; }*/
        @php $height = ((count($pp) ?: 1) * 3) + 10  @endphp
        @page {
            size:  7cm {{ $height }}cm;
            margin: 0; /* Kenar boşluğunu sıfırlayın */
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
$tt=0;
?>
    @foreach($pp as $item)
            <?php
            $tt=$tt+$item->total_price;
            ?>
        <div style="position: relative;">
        <b>{{ $item->product->name}} </b><br> <b style="position: absolute; right: 10px;top: 5px"> {{$item->count}}*{{ $item->total_price / ($item->count ?: 1)}}={{$item->total_price}}</b>
<span style="font-size: 13px">{{ $item->product->code }} //  {{ $item->product->id }}</span><hr>
        </div>
    @endforeach
    Hammasi: {{$tt}} so'm <br>
    To'lov turi:  <hr>
    <h4 ALIGN="center">Xaridingiz uchun raxmat!</h4>
</div>
</body>
</html>
