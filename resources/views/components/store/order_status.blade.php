@if ($status == 1)
    <div class="col-12">
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg aria-hidden="true" width="25" height="25" focusable="false" data-prefix="fa-duotone"
                data-icon="hourglass" class="svg-inline--fa fa-hourglass fa-w-12" role="img"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <defs>
                    <style>
                        .fa-secondary {
                            opacity: .4
                        }
                    </style>
                </defs>
                <g class="fa-group">
                    <path class="fa-primary"
                        d="M272 128H111.1L192 234.7L272 128zM32 64h320c17.67 0 32-14.33 32-32c0-17.67-14.33-32-32-32H32C14.33 0 0 14.33 0 32C0 49.67 14.33 64 32 64zM352 448h-64v-21.34c0-13.75-4.545-27.39-12.8-38.4L272 384H111.1l-3.199 4.266C100.5 399.3 96 412.9 96 426.7V448H32c-17.67 0-32 14.33-32 32c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32C384 462.3 369.7 448 352 448z"
                        fill="currentColor" />
                    <path class="fa-secondary"
                        d="M288 64h64v21.33c0 27.7-8.982 54.64-25.6 76.8L256 256l70.4 93.87C343 372 352 398.1 352 426.7V448h-64v-21.34c0-13.75-4.545-27.39-12.8-38.4L192 277.3l-83.2 110.9C100.5 399.3 96 412.9 96 426.7V448H32v-21.34c0-27.7 8.982-54.64 25.6-76.8L128 256L57.6 162.1C40.98 139.1 32 113 32 85.33V64h64v21.33c0 13.76 4.545 27.39 12.8 38.4L192 234.7l83.2-110.9C283.5 112.7 288 99.09 288 85.33V64z"
                        fill="currentColor" />
                </g>
            </svg>
            <div class="ps-2 fs-6">
                {{ __('We are checking your order. We will contact you shortly for confirmation.') }}
            </div>
        </div>
    </div>
@elseif ($status == 2)
    <div class="col-12">
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <svg aria-hidden="true" width="25" height="25" focusable="false" data-prefix="fa-duotone"
                data-icon="person-biking-mountain" class="svg-inline--fa fa-person-biking-mountain fa-w-20"
                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                <defs>
                    <style>
                        .fa-secondary {
                            opacity: .4
                        }
                    </style>
                </defs>
                <g class="fa-group">
                    <path class="fa-primary"
                        d="M400 96C426.5 96 448 74.5 448 48S426.5 0 400 0S352 21.5 352 48S373.5 96 400 96zM480 160h-52.75L356 103c-12-9.625-29.12-9.375-40.75 .625l-112 96C195.6 206.3 191.5 215.9 192.1 225.9c.5 10 5.75 19.12 14.12 24.75L288 305.1V416c0 17.62 14.38 32 32 32s32-14.38 32-32V288c0-10.75-5.375-20.62-14.25-26.62L296.4 233.8l58.25-49.88L396 217C401.6 221.5 408.8 224 416 224h64c17.62 0 32-14.38 32-32S497.6 160 480 160z"
                        fill="currentColor" />
                    <path class="fa-secondary"
                        d="M624 352h-5.25c-2.125-7.25-5-14.25-8.625-20.88l3.75-3.625c6.25-6.25 6.25-16.5 0-22.75l-22.62-22.62c-6.25-6.25-16.5-6.25-22.75 0l-3.625 3.75C558.3 282.3 551.3 279.4 544 277.3V272C544 263.1 536.9 256 528 256h-32C487.1 256 480 263.1 480 272v5.25c-7.25 2.125-14.25 5-20.88 8.625L455.5 282.1c-6.25-6.25-16.4-6.25-22.65 0l-22.6 22.62c-6.25 6.25-6.25 16.5 0 22.75l3.625 3.625C410.3 337.8 407.4 344.8 405.3 352H400c-8.875 0-16 7.125-16 16v32c0 8.875 7.125 16 16 16h5.25c2.125 7.25 5 14.25 8.625 20.88l-3.75 3.625c-6.25 6.25-6.25 16.5 0 22.75l22.62 22.62c6.25 6.25 16.48 6.25 22.73 0l3.65-3.75C465.8 485.8 472.8 488.6 480 490.8V496c0 8.875 7.125 16 16 16h32c8.875 0 16-7.125 16-16v-5.25c7.25-2.125 14.25-5 20.88-8.625l3.75 3.75c6.25 6.25 16.38 6.25 22.62 0l22.62-22.62c6.25-6.25 6.25-16.5 0-22.75l-3.75-3.625C613.8 430.3 616.6 423.3 618.8 416H624c8.875 0 16-7.125 16-16v-32C640 359.1 632.9 352 624 352zM512 448c-35.38 0-64-28.62-64-64s28.62-64 64-64s64 28.62 64 64S547.4 448 512 448zM191.4 49.88L133.3 98.63C126.9 104.3 126.3 114.1 131.9 121l40.88 49.13C178.4 177 188.1 178 194.5 172.4L298.8 83.5C305.1 78 305.8 68 300.1 61.12C272 27.25 223.3 22.13 191.4 49.88zM240 352H234.8c-2.125-7.25-5-14.25-8.625-20.88l3.75-3.625c6.25-6.25 6.25-16.5 0-22.75L207.3 282.1c-6.25-6.25-16.5-6.25-22.75 0L180.9 285.9C174.3 282.3 167.3 279.4 160 277.3V272C160 263.1 152.9 256 144 256h-32C103.1 256 96 263.1 96 272v5.25c-7.25 2.125-14.25 5-20.88 8.625L71.5 282.1c-6.25-6.25-16.47-6.25-22.72 0L26.15 304.8c-6.25 6.25-6.25 16.5 0 22.75l3.725 3.625C26.25 337.8 23.37 344.8 21.25 352H16C7.125 352 0 359.1 0 368v32C0 408.9 7.125 416 16 416h5.25c2.125 7.25 5 14.25 8.625 20.88L26.12 440.5c-6.25 6.25-6.25 16.5 0 22.75l22.63 22.62c6.25 6.25 16.47 6.25 22.72 0l3.65-3.75C81.75 485.8 88.75 488.6 96 490.8V496C96 504.9 103.1 512 112 512h32C152.9 512 160 504.9 160 496v-5.25c7.25-2.125 14.25-5 20.88-8.625l3.675 3.75c6.25 6.25 16.45 6.25 22.7 0l22.62-22.62c6.25-6.25 6.25-16.5 0-22.75l-3.75-3.625C229.8 430.3 232.6 423.3 234.8 416H240C248.9 416 256 408.9 256 400v-32C256 359.1 248.9 352 240 352zM128 448c-35.38 0-64-28.62-64-64s28.62-64 64-64s64 28.62 64 64S163.4 448 128 448z"
                        fill="currentColor" />
                </g>
            </svg>
            <div class="ps-2 fs-6">
                {{ __('We have validated your order and now it is on its way to your address') }}
            </div>
        </div>
    </div>
@elseif ($status == 3)
    <div class="col-12">
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg aria-hidden="true" width="25" height="25" focusable="false" data-prefix="fa-duotone"
                data-icon="location-check" class="svg-inline--fa fa-location-check fa-w-12" role="img"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <defs>
                    <style>
                        .fa-secondary {
                            opacity: .4
                        }
                    </style>
                </defs>
                <g class="fa-group">
                    <path class="fa-primary"
                        d="M293.9 166.9L176.8 283.3c-6.326 6.287-16.58 6.287-22.9 0L90.08 219.9c-6.326-6.281-6.326-16.48 0-22.77l11.44-11.38c6.328-6.289 16.59-6.289 22.91 0l40.89 40.65l94.24-93.66c6.328-6.287 16.58-6.287 22.9 0l11.45 11.38C300.3 150.4 300.3 160.6 293.9 166.9z"
                        fill="currentColor" />
                    <path class="fa-secondary"
                        d="M192 0C85.97 0 0 85.97 0 192c0 77.41 26.97 99.03 172.3 309.7c9.531 13.77 29.91 13.77 39.44 0C357 291 384 269.4 384 192C384 85.97 298 0 192 0zM293.9 166.9L176.8 283.3c-6.326 6.287-16.58 6.287-22.9 0L90.08 219.9c-6.326-6.281-6.326-16.48 0-22.77l11.44-11.38c6.328-6.289 16.59-6.289 22.91 0l40.89 40.65l94.24-93.66c6.328-6.287 16.58-6.287 22.9 0l11.45 11.38C300.3 150.4 300.3 160.6 293.9 166.9z"
                        fill="currentColor" />
                </g>
            </svg>
            <div class="ps-2 fs-6">
                {{ __('We have delivered your order to the address. Thanks for your purchase') }}
            </div>
        </div>
    </div>
@elseif ($status == 4)
    <div class="col-12">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg aria-hidden="true" width="25" height="25" focusable="false" data-prefix="fa-duotone"
                data-icon="rectangle-xmark" class="svg-inline--fa fa-rectangle-xmark fa-w-16" role="img"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <defs>
                    <style>
                        .fa-secondary {
                            opacity: .4
                        }
                    </style>
                </defs>
                <g class="fa-group">
                    <path class="fa-primary"
                        d="M289.9 255.1l47.03-47.03c9.375-9.375 9.375-24.56 0-33.94s-24.56-9.375-33.94 0L256 222.1L208.1 175c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l47.03 47.03L175 303c-9.375 9.375-9.375 24.56 0 33.94c9.373 9.373 24.56 9.381 33.94 0L256 289.9l47.03 47.03c9.373 9.373 24.56 9.381 33.94 0c9.375-9.375 9.375-24.56 0-33.94L289.9 255.1z"
                        fill="currentColor" />
                    <path class="fa-secondary"
                        d="M448 32H64C28.65 32 0 60.66 0 96v320c0 35.34 28.65 64 64 64h384c35.35 0 64-28.66 64-64V96C512 60.66 483.3 32 448 32zM336.1 303c9.375 9.375 9.375 24.56 0 33.94c-9.381 9.381-24.56 9.373-33.94 0L256 289.9l-47.03 47.03c-9.381 9.381-24.56 9.373-33.94 0c-9.375-9.375-9.375-24.56 0-33.94l47.03-47.03L175 208.1c-9.375-9.375-9.375-24.56 0-33.94s24.56-9.375 33.94 0L256 222.1l47.03-47.03c9.375-9.375 24.56-9.375 33.94 0s9.375 24.56 0 33.94l-47.03 47.03L336.1 303z"
                        fill="currentColor" />
                </g>
            </svg>
            <div class="ps-2 fs-6">
                {{ __("Your order has been cancelled. We're sorry for the inconvinience.") }}
            </div>
        </div>
    </div>
@endif
