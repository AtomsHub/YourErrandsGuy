@extends('admin.layouts')

@section('title', 'YourErrandsGuy - Order')

@section('content')

    <h5 class="headline-small mb-1 pt-4">Order Details</h5>
    <p class="label-medium mb-4">Order ID #{{ $order->id }}</p>

    <div class="row">
        <div class="col-md-8">
            <div class="rounded-col">
                <div class="row row-cols-4 progress-tracker">
                    <!-- Order Created -->
                    <div class="progress-step completed">
                        <div class="progress-circle"></div>
                        <div class="progress-line"></div>
                        <h5>Order Created</h5>
                        <p>Fri, 22 Nov 2024 5:50 PM</p>
                    </div>

                    <!-- Payment Successful -->
                    <div class="progress-step completed">
                        <div class="progress-circle"></div>
                        <div class="progress-line"></div>
                        <h5>Payment Successful</h5>
                        <p>Fri, 22 Nov 2024 5:50 PM</p>
                    </div>

                    <!-- On Delivery -->
                    <div class="progress-step active">
                        <div class="progress-circle"></div>
                        <div class="progress-line"></div>
                        <h5>On Delivery</h5>
                        <p>Fri, 22 Nov 2024 5:50 PM</p>
                    </div>

                    <!-- Order Delivered -->
                    <div class="progress-step">
                        <div class="progress-circle"></div>
                        <h5>Order Delivered</h5>
                        <p>Fri, 22 Nov 2024 5:50 PM</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <div class="rounded-col">
                        <table class="table table-borderless mb-0">
                            <thead>
                                <tr class="table-light text-center">
                                    <th>S/N</th>
                                    <th>Item Summary</th>
                                    <th>QTY</th>
                                    <th>Price</th>                                    
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $items = json_decode($order->items, true) ?? [];
                                @endphp
                        
                                @if (!empty($items) && is_array($items))
                                    @foreach ($items as $index => $item)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}.</td>
                        
                                            @switch($order->service_type)
                                                @case('Laundry')
                                                    <td>{{ $item['name'] }} ({{ $item['serviceName'] ?? '' }})</td>
                                                    <td>{{ $item['quantity'] }}x</td>
                                                    <td>₦{{ number_format($item['pricePerItem'] ?? 0) }}</td>
                                                    <td>₦{{ number_format($item['total'] ?? 0) }}</td>
                                                    @break
                        
                                                @case('Restaurant')
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['quantity'] }}x</td>
                                                    <td>₦{{ number_format($item['price'] ?? 0, 2) }}</td>
                                                    <td>₦{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</td>
                                                    @break
                        
                                                @case('Errands')
                                                    <td>{{ $item['description'] }}</td>
                                                    <td>{{ $item['quantity'] }}x</td>
                                                    <td>₦{{ number_format($item['rate'] ?? 0) }}</td>
                                                    <td>₦{{ number_format(($item['rate'] ?? 0) * ($item['quantity'] ?? 1)) }}</td>
                                                    @break
                        
                                                @case('Package')
                                                    <td colspan="4">{{ $item }}</td> {{-- Only display item name for Package --}}
                                                    @break
                                            @endswitch
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="5">No items found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <div class="rounded-col mt-4 bg-warning-subtle">
                <div class="d-flex flex-column flex-md-row gap-2 gap-md-4 align-items-center justify-content-center justify-content-md-between ">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="global-img">
                            <img src="/admin/assets/img/user.png" class=" " alt="">
                        </div>
                        <div class="">
                            <p class="caption-larger">Delivery Man</p>
                            <h5 class="label-medium">Sulaimon Yusuf</h5>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="bg-dark p-2 px-4 rounded-2 text-white text-center">
                            <i class="fa-solid fa-phone"></i>
                            <a href="#" class="text-white caption-larger">Telephone</a>
                            <h5 class="label-medium">+2348054194279</h5>
                        </div>
                        <div class="bg-dark p-2 px-4 rounded-2 text-white text-center">
                            <i class="fa-solid fa-truck"></i>
                            <a href="#" class="text-white caption-larger">Delivery Time</a>
                            <h5 class="label-medium">3.30am</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col mt-md-0 mt-4">
            <div class="rounded-col">
                <div class="d-flex gap-3 align-items-center justify-content-center">
                    <img src="/admin/assets/img/user.png" alt="" class="img-thumbnail border-0">
                    <p>Sodiq Oladiti</p>
                    <span class="btn-p rounded-3">Customer</span>
                </div>
                <div class="d-flex mt-4 mt-md-5 gap-2">
                    <i class="fa-solid fa-phone"></i>
                    <h5 class="label-medium">+234 805 419 4279</h5>
                </div>
                <div class="d-flex mt-3 gap-2">
                    <i class="fa-solid fa-location-dot"></i>
                    <h5 class="label-medium">Street 11, Rumuokoro Road, Rumuokoro, Port Harcourt.</h5>
                </div>
                <div class="mt-3 mt-md-5">
                    <h5 class="label-medium">Note Order</h5>
                    <p class="caption-larger mt-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur quos nesciunt quas maxime saepe perferendis minus soluta voluptates, quis porro illo. Facilis velit quibusdam repudiandae, nisi voluptate eius ex maxime!</p>
                </div>
            </div>
        </div>
    </div>
@endsection