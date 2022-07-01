<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories as ModelsProductCategories;
use App\Models\Products as ModelsProducts;
use App\Models\BranchOffices as ModelsBranchOffices;
use App\Models\ProductImages as ModelsProductImages;
use App\Models\PostalCoverage as ModelsPostalCoverage;
use App\Models\Orders as ModelsOrders;
use App\Models\OrderItems as ModelsOrderItems;
use App\Mail\OrderComplete;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Store extends Controller
{
    public function index()
    {
        session()->put('branch', (session()->has('branch')) ? session('branch') : 1);
        return view('store.index', [
            'featured_products' => ModelsProducts::getFeaturedProducts(session('branch')),
            'categories' => ModelsProductCategories::getActivesTree(),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch')
        ]);
    }

    public function show_department(Request $request, $department)
    {
        session()->put('branch', (session()->has('branch')) ? session('branch') : 1);
        $department = ModelsProductCategories::where('Slug', $department)->whereNull('ParentId')->first();

        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'products' => ModelsProducts::getProductsByDepartment(
                $department->Slug,
                $request->input('order', 'name'),
                $request->input('direction', 'asc'),
                $request->input('limit', 12),
                $request->input('page', 1),
                session('branch')
            ),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => $department->Name,
                    'url' => route('store.department', $department->Slug)
                ]
            ]
        ];

        return view('store.department', $viewArray);
    }

    public function show_category(Request $request, $category)
    {
        session()->put('branch', (session()->has('branch')) ? session('branch') : 1);
        $category = ModelsProductCategories::where('Slug', $category)->whereNotNull('ParentId')->first();
        $department = ModelsProductCategories::where('Id', $category->ParentId)->first();

        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'products' => ModelsProducts::getProductsByCategory(
                $category->Id,
                $request->input('order', 'name'),
                $request->input('direction', 'asc'),
                $request->input('limit', 12),
                $request->input('page', 1),
                $request->input('branchId', 1)
            ),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => $department->Name,
                    'url' => route('store.department', $department->Slug),
                    'child' => [
                        'text' => $category->Name,
                        'url' => route('store.category', $category->Slug)
                    ]
                ]
            ]
        ];

        return view('store.department', $viewArray);
    }

    public function show_search(Request $request)
    {
        session()->put('branch', (session()->has('branch')) ? session('branch') : 1);
        if (!is_null($request->input('department')) && $request->input('department') > 0) {
            $department = ModelsProductCategories::where('Id', $request->input('department'))->whereNull('ParentId')->first();
            $child = [
                'text' => $department->Name,
                'url' => route('store.department', $department->Slug),
                'child' => [
                    'text' => __('Searching') . ': ' . ($request->input('query') != '' ? $request->input('query') : __('Empty Query')),
                    'url' => '#'
                ]
            ];
        } else {
            $child = [
                'text' => __('Searching') . ': ' . ($request->input('query') != '' ? $request->input('query') : __('Empty Query')),
                'url' => '#'
            ];
        }

        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'products' => ModelsProducts::getProductsBySearch(
                $request->input('query', ''),
                $request->input('department', null),
                $request->input('order', 'name'),
                $request->input('direction', 'asc'),
                $request->input('limit', 12),
                $request->input('page', 1),
                $request->input('branchId', 1)
            ),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => $child
            ],
            'is_search' => true
        ];

        return view('store.department', $viewArray);
    }

    public function show_product($slug)
    {
        session()->put('branch', (session()->has('branch')) ? session('branch') : 1);
        $product = ModelsProducts::productStore($slug, session('branch'));
        $product->price = ModelsProducts::productPrice($product->Id, session('branch'));
        $product->stock = ModelsProducts::productStock($product->Id, session('branch'));
        $product->gallery = ModelsProductImages::where('ProductId', $product->Id)->get();

        if (session()->has('cart')) {
            $cart = session('cart');
            if (array_key_exists($product->Id, $cart)) {
                $product->stock->Quantity = $product->stock->Quantity - $cart[$product->Id]['quantity'];
            }
        }

        return view('store.product', [
            'product' => $product,
            'categories' => ModelsProductCategories::getActivesTree(),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => $product->DepartmentName ?? __('Unknown'),
                    'url' => route('store.department', $product->DepartmentSlug ?? '#'),
                    'child' => [
                        'text' => $product->CategoryName ?? __('Unknown'),
                        'url' => route('store.category', $product->CategorySlug ?? '#'),
                        'child' => [
                            'text' => $product->Name,
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function show_cart()
    {
        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => __('Cart'),
                    'url' => route('store.cart')
                ]
            ],
            'cart' => session()->has('cart') ? session()->get('cart') : []
        ];

        return view('store.cart', $viewArray);
    }

    public function changeBranch(Request $request)
    {
        try {
            session()->put('branch', $request->input('branch'));
            session()->forget('cart');
            return $this->jsonResponse(200, "success", [
                'branch2' => session()->get('branch')
            ]);
        } catch (\Throwable $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $product = ModelsProducts::where('Id', $request->input('pid'))->first();
            $product->price = ModelsProducts::productPrice($product->Id, session('branch'));
            $product->stock = ModelsProducts::productStock($product->Id, session('branch'));

            $arrayData =  [
                'id' => $product->Id,
                'key' => $product->Key,
                'name' => $product->Name,
                'granel' => $product->Granel,
                'slug' => $product->Slug,
                'price' => $product->price,
                'stock' => $product->stock,
                'image' => $product->Image,
                'quantity' => $request->input('quantity', 1)
            ];

            if (session()->has('cart')) {
                $cart = session()->get('cart');
                if (!array_key_exists($product->Id, $cart)) {
                    $cart[$product->Id] = $arrayData;
                } else {
                    $cart[$product->Id]['quantity'] += $request->input('quantity', 1);
                }
            } else {
                $cart = [
                    $product->Id => $arrayData
                ];
            }

            session()->put('cart', $cart);

            return $this->jsonResponse(200, "success", [
                'cart' => session()->get('cart'),
                'view' => view('layouts.store.cart_mini')->render(),
                'button' => '<a class="t-y-btn t-y-btn-border mb-10" href="' . route('store.cart') . '">' . __('View in cart') . '</a>'
            ]);
        } catch (\Throwable $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        try {
            foreach ($request->input('items') as $item) {
                $product = ModelsProducts::where('Id', $item['pid'])->first();
                $product->price = ModelsProducts::productPrice($product->Id, session('branch'));
                $product->stock = ModelsProducts::productStock($product->Id, session('branch'));

                $arrayData =  [
                    'id' => $product->Id,
                    'key' => $product->Key,
                    'name' => $product->Name,
                    'slug' => $product->Slug,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'image' => $product->Image,
                    'quantity' => $item['quantity']
                ];

                if (session()->has('cart')) {
                    $cart = session()->get('cart');
                    if (!array_key_exists($product->Id, $cart)) {
                        $cart[$product->Id] = $arrayData;
                    } else {
                        $cart[$product->Id]['quantity'] = $item['quantity'];
                    }
                } else {
                    $cart = [
                        $product->Id => $arrayData
                    ];
                }
                session()->put('cart', $cart);
            }

            return $this->jsonResponse(200, "success");
        } catch (\Throwable $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            if (session()->has('cart')) {
                $cart = session()->get('cart');
                if (array_key_exists($request->input('pid'), $cart)) {
                    unset($cart[$request->input('pid')]);
                }
                session()->put('cart', $cart);
            }

            return $this->jsonResponse(200, "success", [
                'cart' => session()->get('cart'),
                'view' => view('layouts.store.cart_mini')->render()
            ]);
        } catch (\Throwable $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function emptyCart()
    {
        try {
            session()->forget('cart');
            return $this->jsonResponse(200, "success", [
                'view' => view('layouts.store.cart_mini')->render()
            ]);
        } catch (\Throwable $e) {
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function checkout()
    {
        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'postal_codes' => ModelsPostalCoverage::getActivesByBranch(session('branch')),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => __('Checkout'),
                    'url' => route('store.checkout')
                ]
            ],
            'cart' => session()->has('cart') ? session()->get('cart') : []
        ];

        return view('store.checkout', $viewArray);
    }

    public function completeOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            $slug = Str::uuid()->toString();
            while (ModelsOrders::where('Slug', $slug)->count() > 0) {
                $slug = Str::uuid()->toString();
            }

            $order = ModelsOrders::create([
                'BranchId' => session('branch'),
                'StatusId' => 1,
                'Name' => $request->input('name'),
                'Email' => $request->input('email'),
                'Phone' => $request->input('phone'),
                'Address' => $request->input('address'),
                'PostalCodeId' => $request->input('postalcode'),
                'Slug' => $slug
            ]);

            $cart = session()->get('cart');

            foreach ($cart as $item) {
                ModelsOrderItems::create([
                    'OrderId' => $order->Id ?? $order->id,
                    'ProductId' => $item['id'],
                    'Quantity' => $item['quantity'],
                    'BasePrice' => $item['price']->BasePrice,
                    'Discount' => $item['price']->DiscountFixed
                ]);
            }


            Mail::to($request->input('email'))->bcc('ajimenez@siccob.com.mx')->send(new OrderComplete($order));

            session()->forget('cart');
            DB::commit();

            return $this->jsonResponse(200, "success", [
                'url' => route('store.order', ['order' => $order->Slug])
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function show_order($order)
    {
        $viewArray = [
            'categories' => ModelsProductCategories::getActivesTree(),
            'branches' => ModelsBranchOffices::getActives(),
            'branch' => session('branch'),
            'postal_codes' => ModelsPostalCoverage::getActivesByBranch(session('branch')),
            'breadcrumbs' => [
                'text' => __('Home'),
                'url' => route('store.home'),
                'child' => [
                    'text' => __('Order'),
                    'url' => route('store.checkout')
                ]
            ],
            'cart' => session()->has('cart') ? session()->get('cart') : []
        ];

        return view('store.order', $viewArray);
    }
}
