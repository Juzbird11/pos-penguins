<x-layout>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="m-0 d-flex align-items-center">Out of Stock</h4>
                <form method="get" class="col-7 col-lg-4">
                  <x-search />
                </form>
            </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Barcode</th>
                  <th>Name</th>
                  <th class="text-danger">Min Qty</th>
                  <th>Qty</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                <tr>
                  <td>{{ $product->barcode }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->min_qty }}</td>
                  <td>{{ $product->qty }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</x-layout>