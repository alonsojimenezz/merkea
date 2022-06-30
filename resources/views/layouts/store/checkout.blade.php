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

<!-- checkout-area start -->
<section class="checkout-area pb-70 pt-50">
    <div class="container">
        <form action="#">
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkbox-form">
                        <h3>{{ __('Shipping Address') }}</h3>
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
                                    <select id="checkout-postalcode">
                                        <option value="">{{ __('Select your postal code') }}</option>
                                        @foreach ($postal_codes as $code)
                                            <option data-city="{{ $code->City }}" data-state="{{ $code->State }}"
                                                value="{{ $code->Id }}">
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
                                    <label>{{ __('City') }} <span class="required">*</span></label>
                                    <input type="text" id="checkout-city" placeholder="{{ __('City or Town') }}"
                                        disabled />
                                </div>
                            </div>
                            <div class="col-md-6 coverageByPostal d-none">
                                <div class="checkout-form-list">
                                    <label>{{ __('State') }} <span class="required">*</span></label>
                                    <input type="text" id="checkout-state" placeholder="" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 coverageByPostal d-none">
                                <div class="checkout-form-list">
                                    <label>{{ __('Phone') }} <span class="required">*</span></label>
                                    <input type="text" id="checkout-phone" placeholder="55 5566 7788" />
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="checkout-form-list create-acc">
                                    <input id="cbox" type="checkbox" />
                                    <label>Create an account?</label>
                                </div>
                                <div id="cbox_info" class="checkout-form-list create-account">
                                    <p>Create an account by entering the information below. If you are a returning
                                        customer please login at the top of the page.</p>
                                    <label>Account password <span class="required">*</span></label>
                                    <input type="password" placeholder="password" />
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Ship to a different address?</label>
                                    <input id="ship-box" type="checkbox" />
                                </h3>
                            </div>
                            <div id="ship-box-info">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="country-select">
                                            <label>Country <span class="required">*</span></label>
                                            <select>
                                                <option value="volvo">bangladesh</option>
                                                <option value="saab">Algeria</option>
                                                <option value="mercedes">Afghanistan</option>
                                                <option value="audi">Ghana</option>
                                                <option value="audi2">Albania</option>
                                                <option value="audi3">Bahrain</option>
                                                <option value="audi4">Colombia</option>
                                                <option value="audi5">Dominican Republic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Company Name</label>
                                            <input type="text" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" placeholder="Street address" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <input type="text"
                                                placeholder="Apartment, suite, unit etc. (optional)" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input type="text" placeholder="Town / City" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>State / County <span class="required">*</span></label>
                                            <input type="text" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Order Notes</label>
                                    <textarea id="checkout-mess" cols="30" rows="10"
                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
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
                                        <td><strong><span
                                                    class="amount">${{ number_format($total, 2) }}</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="payment-method coverageByPostal d-none">
                            {{-- <div class="accordion" id="checkoutAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="checkoutOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#bankOne" aria-expanded="true" aria-controls="bankOne">
                                            Direct Bank Transfer
                                        </button>
                                    </h2>
                                    <div id="bankOne" class="accordion-collapse collapse show"
                                        aria-labelledby="checkoutOne" data-bs-parent="#checkoutAccordion">
                                        <div class="accordion-body">
                                            Make your payment directly into our bank account. Please use your Order ID
                                            as the payment reference. Your order won’t be shipped until the funds have
                                            cleared in our account.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="paymentTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#payment" aria-expanded="false"
                                            aria-controls="payment">
                                            Cheque Payment
                                        </button>
                                    </h2>
                                    <div id="payment" class="accordion-collapse collapse"
                                        aria-labelledby="paymentTwo" data-bs-parent="#checkoutAccordion">
                                        <div class="accordion-body">
                                            Please send your cheque to Store Name, Store Street, Store Town, Store
                                            State / County, Store
                                            Postcode.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="paypalThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#paypal" aria-expanded="false"
                                            aria-controls="paypal">
                                            PayPal
                                        </button>
                                    </h2>
                                    <div id="paypal" class="accordion-collapse collapse"
                                        aria-labelledby="paypalThree" data-bs-parent="#checkoutAccordion">
                                        <div class="accordion-body">
                                            Pay via PayPal; you can pay with your credit card if you don’t have a
                                            PayPal account.
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="order-button-payment mt-20">
                                <button type="submit" id="checkout-button" class="t-y-btn t-y-btn-grey">{{__('Place Order')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- checkout-area end -->
