@component('mail::message')
# Hola {{ $r['name'] ?? 'Cliente de Merkea Mini Market' }},

Agradecemos su preferencia y confirmamos que su pedido ha sido registrado con los siguientes productos:
@php
$total = 0;
@endphp
@component('mail::table')
| Producto | Cantidad | Subtotal |
| :------ |:---:| ---:|
@foreach ($cart as $item)
|{{ $item['name'] }}|{{ $item['quantity'] }}|${{ number_format(($item['price']->BasePrice - $item['price']->DiscountFixed) * $item['quantity'], 2) }}|
@php
$total += ($item['price']->BasePrice - $item['price']->DiscountFixed) * $item['quantity'];
@endphp
@endforeach
||| ${{ number_format($total, 2) }}|
@endcomponent

@component('mail::panel')
Sus productos serán entregados en <strong>{{$r['address'] ?? ''}}</strong>, que es la dirección que nos proporcionó en el momento de su pedido.
@endcomponent

@component('mail::button', ['url' => route('store.order',['order' => 123]), 'color' => 'info'])
Ver Pedido
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
