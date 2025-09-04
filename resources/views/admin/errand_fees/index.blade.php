@extends('layouts.app')

@section('content')
<div class="dashboard-content p-3 p-md-4">
    <div class="row g-4 mt-4">
        <div class="col">
            <div class="rounded-col">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="headline-small">Errands Package Delivery Fees</p>
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addErrandFeeModal">
                        Add Errand Fee
                    </button>
                </div>

                <div class="mt-4">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr class="table-light">
                                    <th>Pickup</th>
                                    <th>Dropoff</th>
                                    <th>Vendor ID</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fees as $fee)
                                <tr>
                                    <td>{{ $fee->pickup }}</td>
                                    <td>{{ $fee->dropoff }}</td>
                                    <td>{{ $fee->vendor_id }}</td>
                                    <td>{{ $fee->price }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="me-2 edit-errand-fee"
                                               data-id="{{ $fee->id }}"
                                               data-pickup="{{ $fee->pickup }}"
                                               data-dropoff="{{ $fee->dropoff }}"
                                               data-vendor="{{ $fee->vendor_id }}"
                                               data-price="{{ $fee->price }}"
                                               data-url="{{ route('errand-fees.update', $fee->id) }}"
                                               data-bs-toggle="modal"
                                               data-bs-target="#editErrandFeeModal">
                                                <i class="fas fa-edit text-success"></i>
                                            </a>
                                            <form method="POST" action="{{ route('errand-fees.destroy', $fee->id) }}">
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

{{-- Add Errand Fee Modal --}}
@include('admin.errand_fees.partials.add')
{{-- Edit Errand Fee Modal --}}
@include('admin.errand_fees.partials.edit')
@endsection
