@php
    $generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
    $barcodesss = $generatorHTML->getBarcode($barcode, $generatorHTML::TYPE_CODE_128);
@endphp

<h3>Product: {{ $barcode }}</h3>

{!! $barcodesss !!}
