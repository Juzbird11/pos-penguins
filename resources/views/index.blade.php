<style>
  .fw {
    width: 40%;
    min-width: 140px;
  }
</style>

<x-layout>
    <div class="row">
        <div class="col-lg-8">
          @if(!$sale)
          <div class="card mb-2">
            <div class="card-body">
              <form action="/sale/create" method="post">
                <div class="input-group mb-2 mr-sm-2">
                  @csrf
                  <input type="text" class="form-control" placeholder="Customer" name="customer" autocomplete="off" required>
                  <div class="input-group-prepend">
                      <button class="btn btn-info">
                          <i class="mdi mdi-cart"></i>
                      </button>
                  </div>
              </div>
              </form>
            </div>
          </div>
          @endif

            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                      <h4 class="m-0 d-flex align-items-center">In Stock</h4>
                        
                      <form method="get" class="col-7 col-lg-4">
                        <x-search />
                      </form>
                    </div>

                    <x-flash-message class="alert-danger"/>

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            @if($sale)
                              <th>Add to Sale</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                          <tr>
                            <td>{{ $product->barcode }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->price }}</td>
                            @if($sale)
                              <td class="fw">
                                <form action="/sale/add-product/{{ $sale->id }}/{{ $product->id }}" method="post">
                                  <div class="input-group mb-2 mr-sm-2">
                                      @csrf
                                      <input type="number" class="form-control" placeholder="Qty" name="qty" min="1" autocomplete="off" required>
                                      <div class="input-group-prepend">
                                          <button class="btn btn-primary">
                                              <i class="mdi mdi-cart-plus"></i>
                                          </button>
                                      </div>
                                  </div>
                                </form>
                              </td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                      <x-paginator :type="$products" />
                    </div>
                </div>
            </div>
        </div>
        @if($sale)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                      <table>
                        <tr>
                          <th>Invoice No.</th>
                          <td>:</td>
                          <td>{{ $sale->invoice_no }}</td>
                        </tr>

                        <tr>
                          <th>Customer</th>
                          <td>:</td>
                          <td>{{ $sale->customer }}</td>
                        </tr>
                      </table>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Qty</th>
                          <th>Price</th>
                          <th>Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $total = 0;
                        @endphp

                        @foreach($sale->products as $product)
                        <tr>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->pivot->qty }}</td>
                          <td>{{ $product->pivot->price }}</td>
                          <td>{{ $product->pivot->qty * $product->pivot->price }}</td>
                          <td>
                            <form action="/sale/remove-product/{{$sale->id}}/{{$product->id}}" method="post">
                              @csrf
                              <button class="btn-danger">x</button>
                            </form>
                          </td>
                        </tr>
                          @php
                            $total += $product->pivot->qty * $product->pivot->price;                        
                          @endphp
                        @endforeach
                      </tbody>

                      <tfoot>
                        <tr>
                          <th colspan="2">Total(mmk)</th>
                          <th colspan="3">{{ $total }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <div class="card-footer">
                  <form action="/sale/confirm/{{$sale->id}}" method="post">
                    @csrf
                    <input type="hidden" name="total" value="{{ $total }}">
                    <button class="btn btn-success">Confirm</button>
                  </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-layout>
<script>
  $("#createSale").on("click", function() {
    return confirm("Are you sure?");
  })
</script>