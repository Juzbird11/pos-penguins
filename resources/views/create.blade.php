<x-layout>
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Product</h4>

          <x-flash-message class="alert-success"/>

          <form class="forms-sample" action="/store" method="post">
            @csrf
            <x-input-form name="barcode" title="Barcode"/>
            <x-input-form name="name" title="Name"/>
            <x-input-form name="qty" title="Qty" type="number"/>
            <x-input-form name="min_qty" title="Min Qty" type="number" />
            <x-input-form name="price" title="Price" type="number"/>
            <x-input-form name="baseprice" title="Baseprice" type="number" />
            
            <button type="submit" class="btn btn-success mr-2">Create</button>
          </form>
        </div>
    </div>
</x-layout>