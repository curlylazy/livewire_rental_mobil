<?php

use App\Models\AkunModel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\Attributes\Modelable;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

new class extends Component
{

};

?>

{{-- *** Views --}}
<div>
    <section class="container my-5">
        <div class="catalog-banner p-5 text-white">
            <div class="catalog-overlay"></div>
            <div class="catalog-content col-lg-7">
                <h2 class="fw-bold mb-3">
                    Download Our Product Catalog
                </h2>

                <p class="mb-4 fs-5">
                    Discover our curated collection of premium handcrafted products
                    from <strong>Bali Craft Supplier</strong>.
                    Explore unique designs crafted with quality and authenticity.
                </p>

                <a href="{{ url("cetak/katalog") }}" class="btn btn-catalog btn-lg px-4">
                    📥 Download Catalog
                </a>
            </div>
        </div>
    </section>
</div>

{{-- *** Style --}}
<style>
    .catalog-banner {
        position: relative;
        background-image: url('/banner-katalog.jpg');
        background-size: cover;
        background-position: center;
        border-radius: 20px;
        overflow: hidden;
        min-height: 340px;
    }

    .catalog-overlay {
        position: absolute;
        inset: 0;
        background: rgba(18, 70, 55, 0.75);
    }

    .catalog-content {
        position: relative;
        z-index: 2;
    }

    .btn-catalog {
        background-color: #ffffff;
        color: #124637;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-catalog:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }
</style>
