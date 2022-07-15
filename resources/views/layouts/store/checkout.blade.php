{{-- <section class="coupon-area pb-30">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                    <div id="checkout-login" class="coupon-content">
                        <div class="coupon-info">
                            <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est
                                sit amet ipsum luctus.</p>
                            <form action="#">
                                <p class="form-row-first">
                                    <label>Username or email <span class="required">*</span></label>
                                    <input type="text" />
                                </p>
                                <p class="form-row-last">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="text" />
                                </p>
                                <p class="form-row">
                                    <button class="t-y-btn t-y-btn-grey" type="submit">Login</button>
                                    <label>
                                        <input type="checkbox" />
                                        Remember me
                                    </label>
                                </p>
                                <p class="lost-password">
                                    <a href="#">Lost your password?</a>
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input type="text" placeholder="Coupon Code" />
                                    <button class="t-y-btn t-y-btn-grey" type="submit">Apply Coupon</button>
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="checkout-area pb-70 pt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="your-order mb-30 ">
                    <h3>{{ __('Your order') }}</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">{{ __('Product') }}</th>
                                    <th class="product-total">{{ __('Total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cart as $item)
                                    @php
                                        $subtotal = ($item['price']->BasePrice - $item['price']->DiscountFixed) * $item['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $item['name'] }} <strong class="product-quantity"> ×
                                                {{ $item['quantity'] }}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">${{ number_format($subtotal, 2) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>{{ __('Cart Subtotal') }}</th>
                                    <td><span class="amount">${{ number_format($total, 2) }}</span></td>
                                </tr>
                                {{-- <tr class="shipping">
                                        <th>Shipping</th>
                                        <td>
                                            <ul>
                                                <li>
                                                    <input type="radio" name="shipping" />
                                                    <label>
                                                        Flat Rate: <span class="amount">$7.00</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="shipping" />
                                                    <label>Free Shipping:</label>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr> --}}
                                <tr class="order-total">
                                    <th>{{ __('Order Total') }}</th>
                                    <td><strong><span class="amount">${{ number_format($total, 2) }}</span></strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="delivery-pickup-method mt-50">
                        <div class="row">
                            <div class="col-12">
                                <div class="delivery-pickup-method-title">
                                    <h4>{{ __('Method of delivery') }}</h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-3"><input type="radio" name="delivery_method"
                                                    value="1" checked /></td>
                                            <td class="py-2 px-1">
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-solid" data-icon="person-biking-mountain"
                                                    class="svg-inline--fa fa-person-biking-mountain fa-w-20"
                                                    role="img" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 640 512">
                                                    <path
                                                        d="M400 96C426.5 96 448 74.5 448 48S426.5 0 400 0S352 21.5 352 48S373.5 96 400 96zM172.8 170.1C178.4 177 188.1 178 194.5 172.4L298.8 83.5c6.375-5.5 7-15.5 1.375-22.38C272 27.25 223.2 22.12 191.4 49.88L133.3 98.63C126.9 104.2 126.2 114.1 131.9 121L172.8 170.1zM240 352H234.8c-2.125-7.25-4.1-14.25-8.625-20.88l3.75-3.625c6.25-6.25 6.25-16.5 0-22.75L207.3 282.1c-6.25-6.25-16.5-6.25-22.75 0L180.9 285.9C174.2 282.2 167.2 279.4 160 277.3V272C160 263.1 152.9 256 144 256h-32C103.1 256 96 263.1 96 272v5.25c-7.25 2.125-14.25 4.1-20.88 8.625L71.5 282.1c-6.25-6.25-16.48-6.25-22.72 0L26.15 304.8c-6.25 6.25-6.25 16.5 0 22.75l3.725 3.625C26.25 337.8 23.38 344.8 21.25 352H16C7.125 352 0 359.1 0 368v32C0 408.9 7.125 416 16 416h5.25c2.125 7.25 4.1 14.25 8.625 20.88L26.12 440.5c-6.25 6.25-6.25 16.5 0 22.75l22.63 22.62c6.25 6.25 16.47 6.25 22.72 0l3.65-3.75C81.75 485.8 88.75 488.6 96 490.8V496C96 504.9 103.1 512 112 512h32C152.9 512 160 504.9 160 496v-5.25c7.25-2.125 14.25-4.1 20.88-8.625l3.675 3.75c6.25 6.25 16.45 6.25 22.7 0l22.62-22.62c6.25-6.25 6.25-16.5 0-22.75l-3.75-3.625C229.8 430.2 232.6 423.2 234.8 416H240C248.9 416 256 408.9 256 400v-32C256 359.1 248.9 352 240 352zM128 448c-35.38 0-64-28.62-64-64s28.62-64 64-64s64 28.62 64 64S163.4 448 128 448zM624 352h-5.25c-2.125-7.25-5-14.25-8.625-20.88l3.75-3.625c6.25-6.25 6.25-16.5 0-22.75l-22.62-22.62c-6.25-6.25-16.5-6.25-22.75 0l-3.625 3.75C558.3 282.2 551.3 279.4 544 277.3V272C544 263.1 536.9 256 528 256h-32C487.1 256 480 263.1 480 272v5.25c-7.25 2.125-14.25 4.1-20.88 8.625L455.5 282.1c-6.25-6.25-16.4-6.25-22.65 0l-22.6 22.62c-6.25 6.25-6.25 16.5 0 22.75l3.625 3.625C410.2 337.8 407.4 344.8 405.3 352H400c-8.875 0-16 7.125-16 16v32c0 8.875 7.125 16 16 16h5.25c2.125 7.25 4.1 14.25 8.625 20.88l-3.75 3.625c-6.25 6.25-6.25 16.5 0 22.75l22.62 22.62c6.25 6.25 16.47 6.25 22.73 0l3.65-3.75C465.8 485.8 472.8 488.6 480 490.8V496c0 8.875 7.125 16 16 16h32c8.875 0 16-7.125 16-16v-5.25c7.25-2.125 14.25-4.1 20.88-8.625l3.75 3.75c6.25 6.25 16.38 6.25 22.62 0l22.62-22.62c6.25-6.25 6.25-16.5 0-22.75l-3.75-3.625C613.8 430.2 616.6 423.2 618.8 416H624c8.875 0 16-7.125 16-16v-32C640 359.1 632.9 352 624 352zM512 448c-35.38 0-64-28.62-64-64s28.62-64 64-64s64 28.62 64 64S547.4 448 512 448zM396 217C401.6 221.5 408.8 224 416 224h64c17.62 0 32-14.38 32-32s-14.38-32-32-32h-52.75L356 103c-12-9.625-29.12-9.375-40.75 .625l-112 96c-7.625 6.625-11.75 16.25-11.12 26.25c.5 10 5.75 19.12 14.12 24.75L288 305.1V416c0 17.62 14.38 32 32 32s32-14.38 32-32V288c0-10.75-5.375-20.62-14.25-26.62L296.4 233.8l58.25-49.88L396 217z"
                                                        fill="currentColor" />
                                                </svg>
                                                {{ __('Home delivery') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-3"><input type="radio" name="delivery_method"
                                                    value="2" /></td>
                                            <td class="py-2 px-1">
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-solid" data-icon="shop"
                                                    class="svg-inline--fa fa-shop fa-w-20" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                    <path
                                                        d="M319.1 384H127.1V224H63.98L63.97 480c0 17.75 14.25 32 32 32h256c17.75 0 32-14.25 32-32l.0114-256H319.1V384zM634.6 142.2l-85.38-128c-6-9-16-14.25-26.63-14.25H117.3c-10.63 0-20.63 5.25-26.63 14.25l-85.25 128C-8.78 163.5 6.47 192 32.1 192h575.9C633.5 192 648.7 163.5 634.6 142.2zM511.1 496c0 8.75 7.25 16 16 16h32.01c8.75 0 16-7.25 16-16L575.1 224h-64.01L511.1 496z"
                                                        fill="currentColor" />
                                                </svg>

                                                {{ __('Store Pickup') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="schedule-delivery mt-30">
                        <div class="row">
                            <div class="col-12">
                                <div class="delivery-pickup-method-title">
                                    <h4>{{ __('Schedule Delivery / Pickup') }}</h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-3"><input type="radio" name="schedule_delivery_option"
                                                    value="1" checked /></td>
                                            <td class="py-2 px-1">
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-solid" data-icon="cart-shopping-fast"
                                                    class="svg-inline--fa fa-cart-shopping-fast fa-w-20" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                    <path
                                                        d="M239.1 416c-26.51 0-47.1 21.49-47.1 48S213.5 512 239.1 512s47.1-21.49 47.1-48S266.5 416 239.1 416zM527.1 416c-26.51 0-47.1 21.49-47.1 48s21.49 48 47.1 48s48-21.49 48-48S554.5 416 527.1 416zM633.5 44.73C627.4 36.64 618.1 32 607.1 32H185.1L183.6 19.51C181.4 8.189 171.5 0 160 0H87.1C74.75 0 64 10.75 64 23.1S74.75 48 87.1 48h52.14l60.28 316.5C202.6 375.8 212.5 384 224 384H552c13.25 0 24-10.75 24-23.1C576 346.7 565.3 336 552 336H243.9L234.7 288h318.4c14.28 0 26.84-9.474 30.76-23.21l54.86-191.1C641.5 63.05 639.6 52.83 633.5 44.73zM24 144h80C117.3 144 128 133.3 128 120C128 106.7 117.3 96 104 96h-80C10.75 96 0 106.7 0 120C0 133.3 10.75 144 24 144zM24 224h96C133.3 224 144 213.3 144 200c0-13.26-10.74-24-24-24h-96C10.75 176 0 186.7 0 200C0 213.3 10.75 224 24 224zM136 256h-112C10.75 256 0 266.7 0 280C0 293.3 10.75 304 24 304h112C149.3 304 160 293.3 160 280C160 266.7 149.3 256 136 256z"
                                                        fill="currentColor" />
                                                </svg>
                                                {{ __('As soon as possible') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-3"><input type="radio" name="schedule_delivery_option"
                                                    value="2" /></td>
                                            <td class="py-2 px-1">
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-solid" data-icon="calendar-clock"
                                                    class="svg-inline--fa fa-calendar-clock fa-w-18" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                    <path
                                                        d="M448 112C448 85.49 426.5 64 400 64H352V31.1C352 14.4 337.6 0 320 0C302.4 0 288 14.4 288 31.1V64H160V31.1C160 14.4 145.6 0 128 0S96 14.4 96 31.1V64H48C21.49 64 0 85.49 0 112V160h448V112zM432 224C352.4 224 288 288.4 288 368s64.38 144 144 144S576 447.6 576 368S511.6 224 432 224zM480 384h-54.25C420.4 384 416 379.6 416 374.3V304C416 295.2 423.2 288 432 288C440.8 288 448 295.2 448 304V352h32c8.838 0 16 7.162 16 16C496 376.8 488.8 384 480 384zM256 368C256 270.8 334.8 192 432 192H0v272C0 490.5 21.5 512 48 512h283C285.7 480.2 256 427.6 256 368z"
                                                        fill="currentColor" />
                                                </svg>

                                                {{ __('Schedule') }}
                                            </td>
                                        </tr>
                                        <tr id="schedule_section" class="d-none">
                                            <td colspan="2" class="ps-2 pt-3">
                                                <div class="d-flex">
                                                    <div class="btn-group me-2" role="group">
                                                        @php
                                                            $now = new DateTime();
                                                            $now->setTimezone(new DateTimeZone('America/Mexico_City'));
                                                            // $now->add(new DateInterval('PT9H'));
                                                            $now->add(new DateInterval('PT60M'));

                                                            $aux = new DateTime();
                                                            $aux->setTimezone(new DateTimeZone('America/Mexico_City'));

                                                            $aux->setTime(substr($branch_info->OpenHours, 0, 2), substr($branch_info->OpenHours, 3, 2), 0);

                                                            $hours = [];
                                                            while ($aux->format('H:i:s') <= $branch_info->CloseHours) {
                                                                array_push($hours, [
                                                                    'hour' => $aux->format('H:i'),
                                                                    'today' => $now->format('H:i') <= $aux->format('H:i') ? 'today' : '',
                                                                    'tomorrow' => $now->format('H:i:s') > $branch_info->OpenHours && $aux->format('H:i') < $now->format('H:i') ? 'tomorrow' : '',
                                                                ]);

                                                                $aux->add(new DateInterval('PT30M'));
                                                            }

                                                        @endphp
                                                        <input type="radio" class="btn-check" name="btntodaytomorrow"
                                                            id="btntoday" autocomplete="off" value="today"
                                                            @if ($now->format('H:i:s') <= $branch_info->CloseHours) checked @endif>
                                                        <label class="btn btn-outline-warning btn-sm pt-2"
                                                            for="btntoday">{{ __('Today') }}</label>

                                                        @if ($now->format('H:i:s') > $branch_info->OpenHours)
                                                            <input type="radio" class="btn-check"
                                                                name="btntodaytomorrow" id="btntomorrow"
                                                                autocomplete="off" value="tomorrow">
                                                            <label class="btn btn-outline-warning btn-sm pt-2"
                                                                for="btntomorrow">{{ __('Tomorrow') }}</label>
                                                        @endif

                                                    </div>
                                                    <div>
                                                        <div class="input-group mb-0">
                                                            <select id="schedule_time" class="form-control nonice">
                                                                @foreach ($hours as $hour)
                                                                    <option value="{{ $hour['hour'] }}"
                                                                        class="{{ $hour['today'] }} {{ $hour['tomorrow'] }} {{ $hour['tomorrow'] != '' ? 'd-none' : '' }}"
                                                                        {{ $hour['tomorrow'] != '' ? 'disabled' : '' }}>
                                                                        {{ $hour['hour'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="input-group-text" for="schedule_time">
                                                                hrs
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="alert alert-warning d-flex align-items-center mt-5"
                                                    role="alert">
                                                    <svg width="30" aria-hidden="true" focusable="false"
                                                        data-prefix="fa-solid" data-icon="triangle-exclamation"
                                                        class="svg-inline--fa fa-triangle-exclamation fa-w-16"
                                                        role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <div class="ps-2">
                                                        {{ __('Programming times are not exact and depend on branch office hours') }}
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="payment-method">
                        <div class="row">
                            <div class="col-12">
                                <div class="payment-method-title">
                                    <h4>{{ __('Payment Method') }}</h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-3"><input type="radio" name="payment_method"
                                                    value="1" checked /></td>
                                            <td class="py-2 px-1">
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-regular" data-icon="money-bills"
                                                    class="svg-inline--fa fa-money-bills fa-w-20" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                    <path
                                                        d="M367.1 112c-44.19 0-80 42.98-80 96s35.81 96 80 96c44.18 0 80-42.98 80-96S412.2 112 367.1 112zM640 96v224c0 35.35-28.65 64-64 64H160c-35.35 0-64-28.65-64-64V96c0-35.35 28.65-64 64-64H576C611.3 32 640 60.65 640 96zM592 272.8V143.2C589.4 143.6 586.7 144 584 144c-30.93 0-56-25.07-56-56c0-2.762 .5469-5.359 .9551-8H207C207.5 82.64 208 85.24 208 88c0 30.93-25.07 56-56 56c-2.742 0-5.363-.4414-7.998-.8242v129.6C146.6 272.4 149.3 272 152 272c30.93 0 56 25.07 56 56c0 2.762-.5449 5.359-.9531 8h321.9C528.5 333.4 528 330.8 528 328c0-30.93 25.07-56 56-56C586.7 272 589.4 272.4 592 272.8zM512 480H120C53.83 480 0 426.2 0 360v-240C0 106.8 10.75 96 24 96S48 106.8 48 120v240c0 39.7 32.3 72 72 72H512c13.25 0 24 10.75 24 24S525.3 480 512 480z"
                                                        fill="currentColor" />
                                                </svg>
                                                {{ __('Cash on delivery') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-3"><input type="radio" name="payment_method"
                                                    value="2" /></td>
                                            <td class="py-2 px-1">
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-brands" data-icon="cc-amex"
                                                    class="svg-inline--fa fa-cc-amex fa-w-18" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                    <path
                                                        d="M325.1 167.8c0-16.4-14.1-18.4-27.4-18.4l-39.1-.3v69.3H275v-25.1h18c18.4 0 14.5 10.3 14.8 25.1h16.6v-13.5c0-9.2-1.5-15.1-11-18.4 7.4-3 11.8-10.7 11.7-18.7zm-29.4 11.3H275v-15.3h21c5.1 0 10.7 1 10.7 7.4 0 6.6-5.3 7.9-11 7.9zM279 268.6h-52.7l-21 22.8-20.5-22.8h-66.5l-.1 69.3h65.4l21.3-23 20.4 23h32.2l.1-23.3c18.9 0 49.3 4.6 49.3-23.3 0-17.3-12.3-22.7-27.9-22.7zm-103.8 54.7h-40.6v-13.8h36.3v-14.1h-36.3v-12.5h41.7l17.9 20.2zm65.8 8.2l-25.3-28.1L241 276zm37.8-31h-21.2v-17.6h21.5c5.6 0 10.2 2.3 10.2 8.4 0 6.4-4.6 9.2-10.5 9.2zm-31.6-136.7v-14.6h-55.5v69.3h55.5v-14.3h-38.9v-13.8h37.8v-14.1h-37.8v-12.5zM576 255.4h-.2zm-194.6 31.9c0-16.4-14.1-18.7-27.1-18.7h-39.4l-.1 69.3h16.6l.1-25.3h17.6c11 0 14.8 2 14.8 13.8l-.1 11.5h16.6l.1-13.8c0-8.9-1.8-15.1-11-18.4 7.7-3.1 11.8-10.8 11.9-18.4zm-29.2 11.2h-20.7v-15.6h21c5.1 0 10.7 1 10.7 7.4 0 6.9-5.4 8.2-11 8.2zm-172.8-80v-69.3h-27.6l-19.7 47-21.7-47H83.3v65.7l-28.1-65.7H30.7L1 218.5h17.9l6.4-15.3h34.5l6.4 15.3H100v-54.2l24 54.2h14.6l24-54.2v54.2zM31.2 188.8l11.2-27.6 11.5 27.6zm477.4 158.9v-4.5c-10.8 5.6-3.9 4.5-156.7 4.5 0-25.2.1-23.9 0-25.2-1.7-.1-3.2-.1-9.4-.1 0 17.9-.1 6.8-.1 25.3h-39.6c0-12.1.1-15.3.1-29.2-10 6-22.8 6.4-34.3 6.2 0 14.7-.1 8.3-.1 23h-48.9c-5.1-5.7-2.7-3.1-15.4-17.4-3.2 3.5-12.8 13.9-16.1 17.4h-82v-92.3h83.1c5 5.6 2.8 3.1 15.5 17.2 3.2-3.5 12.2-13.4 15.7-17.2h58c9.8 0 18 1.9 24.3 5.6v-5.6c54.3 0 64.3-1.4 75.7 5.1v-5.1h78.2v5.2c11.4-6.9 19.6-5.2 64.9-5.2v5c10.3-5.9 16.6-5.2 54.3-5V80c0-26.5-21.5-48-48-48h-480c-26.5 0-48 21.5-48 48v109.8c9.4-21.9 19.7-46 23.1-53.9h39.7c4.3 10.1 1.6 3.7 9 21.1v-21.1h46c2.9 6.2 11.1 24 13.9 30 5.8-13.6 10.1-23.9 12.6-30h103c0-.1 11.5 0 11.6 0 43.7.2 53.6-.8 64.4 5.3v-5.3H363v9.3c7.6-6.1 17.9-9.3 30.7-9.3h27.6c0 .5 1.9.3 2.3.3H456c4.2 9.8 2.6 6 8.8 20.6v-20.6h43.3c4.9 8-1-1.8 11.2 18.4v-18.4h39.9v92h-41.6c-5.4-9-1.4-2.2-13.2-21.9v21.9h-52.8c-6.4-14.8-.1-.3-6.6-15.3h-19c-4.2 10-2.2 5.2-6.4 15.3h-26.8c-12.3 0-22.3-3-29.7-8.9v8.9h-66.5c-.3-13.9-.1-24.8-.1-24.8-1.8-.3-3.4-.2-9.8-.2v25.1H151.2v-11.4c-2.5 5.6-2.7 5.9-5.1 11.4h-29.5c-4-8.9-2.9-6.4-5.1-11.4v11.4H58.6c-4.2-10.1-2.2-5.3-6.4-15.3H33c-4.2 10-2.2 5.2-6.4 15.3H0V432c0 26.5 21.5 48 48 48h480.1c26.5 0 48-21.5 48-48v-90.4c-12.7 8.3-32.7 6.1-67.5 6.1zm36.3-64.5H575v-14.6h-32.9c-12.8 0-23.8 6.6-23.8 20.7 0 33 42.7 12.8 42.7 27.4 0 5.1-4.3 6.4-8.4 6.4h-32l-.1 14.8h32c8.4 0 17.6-1.8 22.5-8.9v-25.8c-10.5-13.8-39.3-1.3-39.3-13.5 0-5.8 4.6-6.5 9.2-6.5zm-57 39.8h-32.2l-.1 14.8h32.2c14.8 0 26.2-5.6 26.2-22 0-33.2-42.9-11.2-42.9-26.3 0-5.6 4.9-6.4 9.2-6.4h30.4v-14.6h-33.2c-12.8 0-23.5 6.6-23.5 20.7 0 33 42.7 12.5 42.7 27.4-.1 5.4-4.7 6.4-8.8 6.4zm-42.2-40.1v-14.3h-55.2l-.1 69.3h55.2l.1-14.3-38.6-.3v-13.8H445v-14.1h-37.8v-12.5zm-56.3-108.1c-.3.2-1.4 2.2-1.4 7.6 0 6 .9 7.7 1.1 7.9.2.1 1.1.5 3.4.5l7.3-16.9c-1.1 0-2.1-.1-3.1-.1-5.6 0-7 .7-7.3 1zm20.4-10.5h-.1zm-16.2-15.2c-23.5 0-34 12-34 35.3 0 22.2 10.2 34 33 34h19.2l6.4-15.3h34.3l6.6 15.3h33.7v-51.9l31.2 51.9h23.6v-69h-16.9v48.1l-29.1-48.1h-25.3v65.4l-27.9-65.4h-24.8l-23.5 54.5h-7.4c-13.3 0-16.1-8.1-16.1-19.9 0-23.8 15.7-20 33.1-19.7v-15.2zm42.1 12.1l11.2 27.6h-22.8zm-101.1-12v69.3h16.9v-69.3z"
                                                        fill="currentColor" />
                                                </svg>
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-brands" data-icon="cc-visa"
                                                    class="svg-inline--fa fa-cc-visa fa-w-18" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                    <path
                                                        d="M470.1 231.3s7.6 37.2 9.3 45H446c3.3-8.9 16-43.5 16-43.5-.2.3 3.3-9.1 5.3-14.9l2.8 13.4zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM152.5 331.2L215.7 176h-42.5l-39.3 106-4.3-21.5-14-71.4c-2.3-9.9-9.4-12.7-18.2-13.1H32.7l-.7 3.1c15.8 4 29.9 9.8 42.2 17.1l35.8 135h42.5zm94.4.2L272.1 176h-40.2l-25.1 155.4h40.1zm139.9-50.8c.2-17.7-10.6-31.2-33.7-42.3-14.1-7.1-22.7-11.9-22.7-19.2.2-6.6 7.3-13.4 23.1-13.4 13.1-.3 22.7 2.8 29.9 5.9l3.6 1.7 5.5-33.6c-7.9-3.1-20.5-6.6-36-6.6-39.7 0-67.6 21.2-67.8 51.4-.3 22.3 20 34.7 35.2 42.2 15.5 7.6 20.8 12.6 20.8 19.3-.2 10.4-12.6 15.2-24.1 15.2-16 0-24.6-2.5-37.7-8.3l-5.3-2.5-5.6 34.9c9.4 4.3 26.8 8.1 44.8 8.3 42.2.1 69.7-20.8 70-53zM528 331.4L495.6 176h-31.1c-9.6 0-16.9 2.8-21 12.9l-59.7 142.5H426s6.9-19.2 8.4-23.3H486c1.2 5.5 4.8 23.3 4.8 23.3H528z"
                                                        fill="currentColor" />
                                                </svg>
                                                <svg aria-hidden="true" width="22" focusable="false"
                                                    data-prefix="fa-brands" data-icon="cc-mastercard"
                                                    class="svg-inline--fa fa-cc-mastercard fa-w-18" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                    <path
                                                        d="M482.9 410.3c0 6.8-4.6 11.7-11.2 11.7-6.8 0-11.2-5.2-11.2-11.7 0-6.5 4.4-11.7 11.2-11.7 6.6 0 11.2 5.2 11.2 11.7zm-310.8-11.7c-7.1 0-11.2 5.2-11.2 11.7 0 6.5 4.1 11.7 11.2 11.7 6.5 0 10.9-4.9 10.9-11.7-.1-6.5-4.4-11.7-10.9-11.7zm117.5-.3c-5.4 0-8.7 3.5-9.5 8.7h19.1c-.9-5.7-4.4-8.7-9.6-8.7zm107.8.3c-6.8 0-10.9 5.2-10.9 11.7 0 6.5 4.1 11.7 10.9 11.7 6.8 0 11.2-4.9 11.2-11.7 0-6.5-4.4-11.7-11.2-11.7zm105.9 26.1c0 .3.3.5.3 1.1 0 .3-.3.5-.3 1.1-.3.3-.3.5-.5.8-.3.3-.5.5-1.1.5-.3.3-.5.3-1.1.3-.3 0-.5 0-1.1-.3-.3 0-.5-.3-.8-.5-.3-.3-.5-.5-.5-.8-.3-.5-.3-.8-.3-1.1 0-.5 0-.8.3-1.1 0-.5.3-.8.5-1.1.3-.3.5-.3.8-.5.5-.3.8-.3 1.1-.3.5 0 .8 0 1.1.3.5.3.8.3 1.1.5s.2.6.5 1.1zm-2.2 1.4c.5 0 .5-.3.8-.3.3-.3.3-.5.3-.8 0-.3 0-.5-.3-.8-.3 0-.5-.3-1.1-.3h-1.6v3.5h.8V426h.3l1.1 1.4h.8l-1.1-1.3zM576 81v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V81c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM64 220.6c0 76.5 62.1 138.5 138.5 138.5 27.2 0 53.9-8.2 76.5-23.1-72.9-59.3-72.4-171.2 0-230.5-22.6-15-49.3-23.1-76.5-23.1-76.4-.1-138.5 62-138.5 138.2zm224 108.8c70.5-55 70.2-162.2 0-217.5-70.2 55.3-70.5 162.6 0 217.5zm-142.3 76.3c0-8.7-5.7-14.4-14.7-14.7-4.6 0-9.5 1.4-12.8 6.5-2.4-4.1-6.5-6.5-12.2-6.5-3.8 0-7.6 1.4-10.6 5.4V392h-8.2v36.7h8.2c0-18.9-2.5-30.2 9-30.2 10.2 0 8.2 10.2 8.2 30.2h7.9c0-18.3-2.5-30.2 9-30.2 10.2 0 8.2 10 8.2 30.2h8.2v-23zm44.9-13.7h-7.9v4.4c-2.7-3.3-6.5-5.4-11.7-5.4-10.3 0-18.2 8.2-18.2 19.3 0 11.2 7.9 19.3 18.2 19.3 5.2 0 9-1.9 11.7-5.4v4.6h7.9V392zm40.5 25.6c0-15-22.9-8.2-22.9-15.2 0-5.7 11.9-4.8 18.5-1.1l3.3-6.5c-9.4-6.1-30.2-6-30.2 8.2 0 14.3 22.9 8.3 22.9 15 0 6.3-13.5 5.8-20.7.8l-3.5 6.3c11.2 7.6 32.6 6 32.6-7.5zm35.4 9.3l-2.2-6.8c-3.8 2.1-12.2 4.4-12.2-4.1v-16.6h13.1V392h-13.1v-11.2h-8.2V392h-7.6v7.3h7.6V416c0 17.6 17.3 14.4 22.6 10.9zm13.3-13.4h27.5c0-16.2-7.4-22.6-17.4-22.6-10.6 0-18.2 7.9-18.2 19.3 0 20.5 22.6 23.9 33.8 14.2l-3.8-6c-7.8 6.4-19.6 5.8-21.9-4.9zm59.1-21.5c-4.6-2-11.6-1.8-15.2 4.4V392h-8.2v36.7h8.2V408c0-11.6 9.5-10.1 12.8-8.4l2.4-7.6zm10.6 18.3c0-11.4 11.6-15.1 20.7-8.4l3.8-6.5c-11.6-9.1-32.7-4.1-32.7 15 0 19.8 22.4 23.8 32.7 15l-3.8-6.5c-9.2 6.5-20.7 2.6-20.7-8.6zm66.7-18.3H408v4.4c-8.3-11-29.9-4.8-29.9 13.9 0 19.2 22.4 24.7 29.9 13.9v4.6h8.2V392zm33.7 0c-2.4-1.2-11-2.9-15.2 4.4V392h-7.9v36.7h7.9V408c0-11 9-10.3 12.8-8.4l2.4-7.6zm40.3-14.9h-7.9v19.3c-8.2-10.9-29.9-5.1-29.9 13.9 0 19.4 22.5 24.6 29.9 13.9v4.6h7.9v-51.7zm7.6-75.1v4.6h.8V302h1.9v-.8h-4.6v.8h1.9zm6.6 123.8c0-.5 0-1.1-.3-1.6-.3-.3-.5-.8-.8-1.1-.3-.3-.8-.5-1.1-.8-.5 0-1.1-.3-1.6-.3-.3 0-.8.3-1.4.3-.5.3-.8.5-1.1.8-.5.3-.8.8-.8 1.1-.3.5-.3 1.1-.3 1.6 0 .3 0 .8.3 1.4 0 .3.3.8.8 1.1.3.3.5.5 1.1.8.5.3 1.1.3 1.4.3.5 0 1.1 0 1.6-.3.3-.3.8-.5 1.1-.8.3-.3.5-.8.8-1.1.3-.6.3-1.1.3-1.4zm3.2-124.7h-1.4l-1.6 3.5-1.6-3.5h-1.4v5.4h.8v-4.1l1.6 3.5h1.1l1.4-3.5v4.1h1.1v-5.4zm4.4-80.5c0-76.2-62.1-138.3-138.5-138.3-27.2 0-53.9 8.2-76.5 23.1 72.1 59.3 73.2 171.5 0 230.5 22.6 15 49.5 23.1 76.5 23.1 76.4.1 138.5-61.9 138.5-138.4z"
                                                        fill="currentColor" />
                                                </svg>

                                                {{ __('Credit/Debit Card on Delivery') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkbox-form">
                    <h3 id="title-shipping">{{ __('Shipping address and contact details') }}</h3>
                    <h3 id="title-no-shipping" class="d-none">{{ __('Contact details') }}</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="checkout-form-list">
                                <label>{{ __('Full Name') }} <span class="required">*</span></label>
                                <input type="text" id="checkout-fullname" placeholder="" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkout-form-list">
                                <label>{{ __('Email address') }} <span class="required">*</span></label>
                                <input type="email" id="checkout-email" placeholder="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>{{ __('Phone') }} <span class="required">*</span></label>
                                <input type="text" id="checkout-phone" placeholder="55 5566 7788" />
                            </div>
                        </div>
                        <div id="delivery_direction">
                            <div class="col-12">
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <svg aria-hidden="true" width="35" height="35" focusable="false"
                                        data-prefix="fa-duotone" data-icon="envelopes-bulk"
                                        class="svg-inline--fa fa-envelopes-bulk fa-w-20" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <defs>
                                            <style>
                                                .fa-secondary {
                                                    opacity: .4
                                                }
                                            </style>
                                        </defs>
                                        <g class="fa-group">
                                            <path class="fa-primary"
                                                d="M191.9 448.6c-9.766 0-19.48-2.969-27.78-8.891L32 340.2V480c0 17.62 14.38 32 32 32h256c17.62 0 32-14.38 32-32v-139.8L220.2 439.5C211.7 445.6 201.8 448.6 191.9 448.6zM320 256H64C46.38 256 32 270.4 32 288v12.18l151 113.8c5.25 3.719 12.7 3.734 18.27-.25L352 300.2V288C352 270.4 337.6 256 320 256zM480 224v64h64V224H480z"
                                                fill="currentColor" />
                                            <path class="fa-secondary"
                                                d="M192 192c0-35.25 28.75-64 64-64h224V32c0-17.62-14.38-32-32-32H128C110.4 0 96 14.38 96 32v192h96V192zM576 160H256C238.4 160 224 174.4 224 192v32h96c33.25 0 60.63 25.38 63.75 57.88L384 416h192c17.62 0 32-14.38 32-32V192C608 174.4 593.6 160 576 160zM544 288h-64V224h64V288zM183 413.9L32 300.2v40.06l132.1 99.51c8.297 5.922 18.02 8.891 27.78 8.891c9.859 0 19.78-3.031 28.33-9.141L352 340.2V300.2l-150.7 113.5C195.7 417.7 188.3 417.7 183 413.9z"
                                                fill="currentColor" />
                                        </g>
                                    </svg>
                                    <div class="ps-2">
                                        {{ __('The branch you chose covers the following zip codes. If you do not see your zip code, we invite you to visit us at our physical branches') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="country-select">
                                    <label>{{ __('Postal Code') }} <span class="required">*</span></label>
                                    <select id="checkout-postalcode" class="nonice">
                                        <option value="">{{ __('Select your postal code') }}</option>
                                        @foreach ($postal_codes as $code)
                                            <option data-city="{{ $code->City }}"
                                                data-state="{{ $code->State }}" value="{{ $code->Id }}">
                                                {{ $code->PostalCode . ' - ' . $code->Colony }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 coverageByPostal d-none">
                                <div class="checkout-form-list">
                                    <label>{{ __('Address') }} <span class="required">*</span></label>
                                    <input type="text" id="checkout-address"
                                        placeholder="{{ __('Street and Number Address') }}" />
                                </div>
                            </div>
                            <div class="col-md-12 coverageByPostal d-none">
                                <div class="checkout-form-list">
                                    <label>{{ __('City') }}</label>
                                    <input type="text" style="background:#e2e2e2" id="checkout-city"
                                        placeholder="{{ __('City or Town') }}" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 coverageByPostal d-none">
                                <div class="checkout-form-list">
                                    <label>{{ __('State') }}</label>
                                    <input type="text" style="background:#e2e2e2" id="checkout-state"
                                        placeholder="" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-button-payment mt-20">
                    <button type="submit" id="checkout-button" class="t-y-btn">{{ __('Place Order') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
