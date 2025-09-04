@extends('layouts.app')

@section('content')
<div class="dashboard-content p-3 p-md-4">
    <div class="row g-4 mt-4">
        <div class="col">
            <div class="rounded-col">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="headline-small">Delivery Fees</p>
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDeliveryFeeModal">
                        Add Delivery Fee
                    </button>
                </div>

                <div class="mt-4">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr class="table-light">
                                    <th>Vendor ID</th>
                                    <th>Landmark</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fees as $fee)
                                <tr>
                                    <td>{{ $fee->vendor_id }}</td>
                                    <td>{{ $fee->landmark }}</td>
                                    <td>{{ $fee->price }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="me-2 edit-delivery-fee"
                                               data-id="{{ $fee->id }}"
                                               data-vendor="{{ $fee->vendor_id }}"
                                               data-landmark="{{ $fee->landmark }}"
                                               data-price="{{ $fee->price }}"
                                               data-url="{{ route('delivery-fees.update', $fee->id) }}"
                                               data-bs-toggle="modal"
                                               data-bs-target="#editDeliveryFeeModal">
                                                <i class="fas fa-edit text-success"></i>
                                            </a>
                                            <form method="POST" action="{{ route('delivery-fees.destroy', $fee->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 m-0">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Delivery Fee Modal --}}
@include('admin.delivery_fees.partials.add')
{{-- Edit Delivery Fee Modal --}}
@include('admin.delivery_fees.partials.edit')
@endsection
