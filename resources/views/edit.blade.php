<x-layout>
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update Product</h4>

          <x-flash-message class="alert-primary"/>

          <form class="forms-sample" action="/update/{{ $product->id }}" method="post">
            @csrf
            <x-input-form name="name" title="Name" value="{{ $product->name }}"/>
            <x-input-form name="qty" title="Qty" type="number" value="{{ $product->qty }}"/>
            <x-input-form name="min_qty" title="Min Qty" type="number" value="{{ $product->min_qty }}" />
            <x-input-form name="price" title="Price" type="number" value="{{ $product->price }}"/>
            <x-input-form name="baseprice" title="Baseprice" type="number" value="{{ $product->baseprice}}" />
            
            <button type="submit" class="btn btn-primary mr-2">Update</button>
          </form>
        </div>
    </div>
</x-layout>