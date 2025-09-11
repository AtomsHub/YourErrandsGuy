@extends('admin.layouts')

@section('title', 'YourErrandsGuy - Order')

@section('content')




    <h5 class="headline-small mb-1 pt-4">Order Details</h5>
    <p class="label-medium mb-4">Order ID #{{ $order->id }}</p>

            @php
            $status = $order->status;

            $stepStatus = [
                'Make Payment' => in_array($status, ['Make Payment', 'Processing', 'Rider Dispatched', 'Completed']),
                'Processing' => in_array($status, ['Processing', 'Rider Dispatched', 'Completed']),
                'dispatched' => in_array($status, ['Rider Dispatched', 'Completed']),
                'delivered' => $status === 'Completed',
            ];
        @endphp

        <div class="row row-cols-4 progress-tracker">
            <!-- Order Created -->
            <div class="progress-step {{ $stepStatus['Make Payment'] ? 'completed' : '' }}">
                <div class="progress-circle"></div>
                <div class="progress-line"></div>
                <h5>Order Created</h5>
                <p>{{ optional($order->created_at)->format('D, d M Y g:i A') }}</p>
            </div>

            <!-- Payment Successful -->
            <div class="progress-step {{ $stepStatus['Processing'] ? 'completed' : '' }}">
                <div class="progress-circle"></div>
                <div class="progress-line"></div>
                <h5>Vendor Processing</h5>
                 <p>{{ optional($order->updated_at)->format('D, d M Y g:i A') }}</p>
                
            </div>

            <!-- Rider Dispatched -->
            <div class="progress-step {{ $stepStatus['dispatched'] ? 'completed' : '' }}">
                <div class="progress-circle"></div>
                <div class="progress-line"></div>
                <h5>Rider Dispatched</h5>
                 <p>{{ optional($order->assigned_at)->format('D, d M Y g:i A') }}</p>
                
            </div>

            <!-- Delivered -->
            <div class="progress-step {{ $stepStatus['delivered'] ? 'completed' : '' }}">
                <div class="progress-circle"></div>
                <h5>Order Delivered</h5>
                 <p>{{ optional($order->completed_at)->format('D, d M Y g:i A') }}</p>
                
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
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#assignDispatcherModal">
                            Assign Dispatcher
                        </button>

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

                            <h5 class="label-medium">
                                {{ $order->dispatcher?->full_name ?? 'Not Yet Assigned' }}
                            </h5>

                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="bg-dark p-2 px-4 rounded-2 text-white text-center">
                            <i class="fa-solid fa-phone"></i>
                            <a href="#" class="text-white caption-larger">Telephone</a>
                            <h5 class="label-medium">
                                {{ $order->dispatcher?->phone_number ?? 'N/A' }}
                            </h5>

                        </div>
                        <div class="bg-dark p-2 px-4 rounded-2 text-white text-center">
                            <i class="fa-solid fa-truck"></i>
                            <a href="#" class="text-white caption-larger">Delivery Time</a>
                            <h5 class="label-medium">
                                {{ $order->assigned_at ?? 'N/A' }}
                            </h5>

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

     <!-- Assign Dispatcher Modal -->
<div class="modal fade" id="assignDispatcherModal" tabindex="-1" aria-labelledby="assignDispatcherLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.orders.assign.dispatcher') }}">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Dispatcher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Dispatchers</label>

                        <select class="form-select" name="dispatcher_id" required>
                            <option value="">-- Select Dispatcher --</option>
                            @foreach ($approved as $dispatcher)
                                <option value="{{ $dispatcher->id }}">{{ $dispatcher->full_name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign Dispatcher</button>
                </div>
            </div>
        </form>
    </div>
</div>

    </div>
@endsection
