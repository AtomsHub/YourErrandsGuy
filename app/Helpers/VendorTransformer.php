<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class VendorTransformer
{
    /**
     * Transform vendors marked as "popular"
     */
    public static function transformPopular(Collection $vendors): Collection
    {
        return $vendors->map(function ($vendor, $index) {
            return [
                'id'   => $index + 1,
                'type' => strtolower($vendor->service_type),
                'details' => self::transformVendorDetails($vendor),
            ];
        });
    }

    /**
     * Transform restaurant vendors
     */
    public static function transformVendors(Collection $vendors): Collection
    {
        return $vendors->map(function ($vendor) {
            return self::transformVendorDetails($vendor);
        });
    }

    /**
     * Transform laundry vendors
     */
    public static function transformLaundries(Collection $laundries): Collection
    {
        return $laundries->map(function ($laundry) {
            return [
                'id'          => $laundry->id,
                'name'        => $laundry->name,
                'address'     => $laundry->address,
                'description' => $laundry->description,
                'image'       => 'https://yourerrandsguy.com.ng'.$laundry->image,
                'tag'         => $laundry->tag,
                'deliveryfee' => $laundry->deliveryfee,
                'items'       => $laundry->vitems->map(function ($item) {
                    return [
                        'id'   => $item->id,
                        'name' => $item->name,
                        'price' => [
                            'wash'   => (float) $item->wash,
                            'iron'   => (float) $item->iron,
                            'starch' => (float) $item->starch,
                        ],
                        'image'      => 'https://yourerrandsguy.com.ng'.$item->item->image ?? null,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                }),
            ];
        });
    }

    /**
     * Shared vendor details logic (restaurants & popular)
     */
    private static function transformVendorDetails($vendor): array
    {
        return [
            'id'          => $vendor->id,
            'name'        => $vendor->name,
            'address'     => $vendor->address,
            'description' => $vendor->description,
            'image'       => 'https://yourerrandsguy.com.ng'.$vendor->image ?? optional($vendor->vendorItems->first()->item)->image,
            'tag'         => $vendor->tag,
            'deliveryfee' => $vendor->deliveryfee,
            'items'       => $vendor->service_type === 'Laundry'
                ? $vendor->vitems->map(function ($item) {
                    return [
                        'id'   => $item->id,
                        'name' => $item->name,
                        'price' => [
                            'wash'   => (float) $item->wash,
                            'iron'   => (float) $item->iron,
                            'starch' => (float) $item->starch,
                        ],
                        'image'      => 'https://yourerrandsguy.com.ng'.$item->item->image ?? null,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                })
                : $vendor->vendorItems->map(function ($vendorItem) {
                    return [
                        'id'          => $vendorItem->item->id ?? null,
                        'vendor_id'   => $vendorItem->vendor_id,
                        'name'        => $vendorItem->item->name ?? null,
                        'price'       => $vendorItem->price ?? null,
                        'description' => $vendorItem->description ?? null,
                        'tag'         => $vendorItem->tag ?? null,
                        'image'       => 'https://yourerrandsguy.com.ng'.$vendorItem->item->image ?? null,
                        'created_at'  => $vendorItem->created_at ?? null,
                        'updated_at'  => $vendorItem->updated_at ?? null,
                    ];
                }),
        ];
    }
}
