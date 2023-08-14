@forelse($products as $product)
    <tr>
        <td data-th="Product">
            @foreach($product->images as $img)
                <img src="/products/{{$img->path}}"
                     width="100" height="100"
                     class="img-responsive"/>
            @endforeach
            {{ $product->product }}
        </td>
        <input type="hidden" name="price" value="{{$product->price}}">
        <td data-th="Price" class="price">${{$product->price}}</td>
        <td data-th="Quantity">
            <input type="number" min="1"
                   value="1"
                   data-productid="{{ $product->pk_products }}"
                   id="quantity_{{ $product->pk_products }}"
                   class="form-control quantity"/>
        </td>
        <td data-th="Subtotal" class="text-center">$<span
                class="product-subtotal_{{$product->pk_products}}"
                data-productid="{{$product->pk_products}}"></span>
        </td>
        <td class="actions" data-th="">
            <button type="button"
                    class="btn btn-info btn-sm product-add-to-cart"
                    data-id="{{ $product->pk_products }}">
                Add to Cart
            </button>
            <!--  <button type="button"
                      class="btn btn-danger btn-sm remove-from-cart"
                      data-id=""><i
                      class="fa fa-trash-o"></i>
              </button>-->

            <i class="fa fa-circle-o-notch fa-spin btn-loading"
               style="font-size:24px; display: none"></i>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="100%">No data found!</td>
    </tr>
@endforelse
