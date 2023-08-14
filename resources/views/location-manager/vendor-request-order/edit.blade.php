@extends('layouts.backend_new')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <form class="vendorRequestForm" method="post" action="/locationmanager/vendor-order-request/update"
                onsubmit="return checkForm()">
                @csrf
                <input type="hidden" name="pk_purchase_order" value="{{ $vendorOrder->pk_purchase_order }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('message'))
                    <p class="alert alert-{{ Session::get('messageType') }}">
                        {{ Session::get('message') }}</p>
                @endif
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Dashboard</h4>
                    </div>

                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="/locationmanager">Home</a></li>
                                <li class="breadcrumb-item active"><a href="/locationmanager/vendor-order-request">Vendor
                                        Request
                                        Order</a></li>
                            </ol>
                        </div>
                    </div>
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item active"> <a
                                class="nav-link {{ isset($tab) && $tab == 'vendor-request-order' ? '' : 'active' }}"
                                data-bs-toggle="tab" href="#vendor-request-order" role="tab" aria-selected="true"><span
                                    class="hidden-sm-up"></span> <span class="hidden-xs-down">Vendor Request
                                    Order</span></a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#itemstab" role="tab"
                                aria-selected="false"><span class="hidden-sm-up"></span> <span
                                    class="hidden-xs-down">Items</span></a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane p-20 active" id="vendor-request-order" role="vendor-request-order">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" style="text-align: center;">
                                            Update Vendor Order Request
                                        </h4>
                                        <div class="tab-content br-n pn">
                                            <div id="navpills-1" class="tab-pane active">
                                                <div class="row">

                                                    <div style="margin-left: 550px;">

                                                        <div class="form-group">
                                                            <label for="styles">Vendor</label>
                                                            <select name="pk_vendors"
                                                                class="form-control @error('pk_vendors') is-invalid @enderror"
                                                                required>
                                                                <option value=""> Select Vendor</option>
                                                                @if ($vendors)
                                                                    @foreach ($vendors as $item)
                                                                        <option value="{{ $item->pk_vendors }}"
                                                                            @if ($vendorOrder->pk_vendors == $item->pk_vendors) selected @endif>
                                                                            {{ $item->vendor_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('pk_vendors')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">PO Number</label>
                                                            <input type="text" name="po_number"
                                                                class="form-control @error('po_number') is-invalid @enderror"
                                                                value="{{ $vendorOrder->po_number }}" required>
                                                            @error('po_number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Delivery Date Request</label>
                                                            <input type="date" name="delivery_date_request"
                                                                class="form-control @error('delivery_date_request') is-invalid @enderror"
                                                                value="{{ $vendorOrder->delivery_date_request }}" required>
                                                            @error('delivery_date_request')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="styles">Location</label>
                                                            <select name="pk_locations" id="pk_locations"
                                                                class="form-control @error('pk_locations') is-invalid @enderror"
                                                                required>
                                                                <option value=""> Select Vendor</option>
                                                                @if ($vendors)
                                                                    @foreach ($vendors as $item)
                                                                        <option value="{{ $item->pk_vendors }}"
                                                                            @if ($vendorOrder->pk_locations == $item->pk_vendors) selected @endif>
                                                                            {{ $item->vendor_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                <option value="other"
                                                                    @if ($vendorOrder->pk_locations == 'other') selected @endif>Other
                                                                </option>
                                                            </select>
                                                            @error('pk_locations')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div id="address-section" style=" display: @if($vendorOrder->pk_locations == 'other') block @else none @endif ">
                                                            <div class="form-group">
                                                                <label for="location_name">Address</label>
                                                                <input type="text" name="address" id="autocomplete"
                                                                    class="form-control @error('address') is-invalid @enderror"
                                                                    value="{{ $vendorOrder->shipping_address }}">
                                                                @error('address')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="location_name">Ste#</label>
                                                                <input type="text" name="address_1" id="address_1"
                                                                    class="form-control @error('address_1') is-invalid @enderror"
                                                                    value="{{ $vendorOrder->shipping_address_1 }}"
                                                                    maxlength="10">
                                                                @error('address_1')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="location_name">City</label>
                                                                <input type="text" name="city" id="locality"
                                                                    class="form-control @error('city') is-invalid @enderror"
                                                                    value="{{ $vendorOrder->shipping_city }}">
                                                                @error('city')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="location_name">Zip</label>
                                                                <input type="text" name="zip" id="postal_code"
                                                                    class="form-control @error('zip') is-invalid @enderror"
                                                                    value="{{ $vendorOrder->shipping_zip }}">
                                                                @error('zip')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">State</label>
                                                                <input id="administrative_area_level_1" type="text"
                                                                    name="state_name" class="form-control"
                                                                    value="{{ $vendorOrder->shipping_state }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Country</label>
                                                                <input id="country" type="text" name="country_name"
                                                                    class="form-control"
                                                                    value="{{ $vendorOrder->shipping_country }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Active</label>
                                                            <input type="radio" name="active" value="1"
                                                                checked="checked" class="form-check-input"
                                                                @if (request()->active) {{ old('active') == '1' ? 'checked' : '' }} @endif>
                                                            <label class="form-check-label" for="customRadio11"
                                                                style="margin-left: 20px;">Yes</label>
                                                            <input type="radio" name="active" value="0"
                                                                @if (request()->active) {{ old('active') == '0' ? 'checked' : '' }} @endif
                                                                class="form-check-input">
                                                            <label class="form-check-label" for="customRadio22"
                                                                style="margin-left: 20px;">No</label>
                                                        </div>


                                                        <a href="/locationmanager/vendor-order-request"><input
                                                                class="btn btn-primary" type="button"
                                                                value="Cancel"></a>
                                                        <input class="btn btn-primary" type="submit" value="Submit">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane p-20" id="itemstab" role="vendor-request-order">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" style="text-align: center;">
                                            Update Vendor Order Request
                                        </h4>
                                        <div class="tab-content br-n pn">
                                            <div id="navpills-1" class="tab-pane active">
                                                <input type="hidden" class="ref" value="">
                                                <div class="row justify-content-center">
                                                    <div class="form-group mx-2">
                                                        <label for="styles">Item</label>
                                                        <select name="pk_products"
                                                            class="form-control pk_products @error('pk_products') is-invalid @enderror">
                                                            <option value=""> Select Item</option>
                                                            @if ($products)
                                                                @foreach ($products as $item)
                                                                    <option value="{{ $item->pk_products }}"
                                                                        data-name="{{ $item->product }}"
                                                                        data-price="{{ $item->price }}"
                                                                        data-description="{{ $item->description }}"
                                                                        @if (request()->pk_products == $item->pk_products) selected @endif>
                                                                        {{ $item->product }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('pk_products')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mx-2">
                                                        <label for="description">Item Description</label>
                                                        <input type="text" name="temp_item_description"
                                                            class="form-control @error('temp_item_description') is-invalid @enderror"
                                                            value="{{ old('temp_item_description') }}">
                                                        @error('temp_item_description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mx-2">
                                                        <label for="temp_item_qty">Order Qty</label>
                                                        <input type="number" step="any" name="temp_item_qty"
                                                            class="form-control temp_item_qty @error('temp_item_qty') is-invalid @enderror"
                                                            value="{{ old('temp_item_qty') }}">
                                                        @error('temp_item_qty')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mx-2">
                                                        <label for="styles">Rate</label>
                                                        <input type="number" step="any" name="temp_price"
                                                            class="form-control temp_price @error('temp_price') is-invalid @enderror"
                                                            value="{{ old('temp_price') }}" readonly>
                                                        @error('temp_price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mx-2">
                                                        <label for="styles">Total</label>
                                                        <input type="number" step="any" name="temp_total"
                                                            class="form-control @error('temp_total') is-invalid @enderror"
                                                            value="{{ old('temp_total') }}">
                                                        @error('temp_total')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mx-2">
                                                        <label for="styles">&nbsp;</label>

                                                        <a href="/locationmanager/vendor-order-request">
                                                            <input class="btn btn-success btnAddItemToList" type="button"
                                                                value="Add Item"></a>
                                                        <a href="/locationmanager/vendor-order-request"><input
                                                                class="btn btn-secondary" type="button"
                                                                value="Cancel"></a>
                                                    </div>



                                                </div>

                                                <div class="row justify-content-center tempItemTbl"
                                                    style="@if (!count($vendorOrder->items)) display: none @endif">
                                                    <div class="col-lg-8">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Item Name</th>
                                                                        <th scope="col">Item Description</th>
                                                                        <th scope="col">Price</th>
                                                                        <th scope="col">Order Qty</th>
                                                                        <th scope="col">Total</th>
                                                                        <th scope="col"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="tempItemList">
                                                                    @if ($vendorOrder->items)
                                                                        @foreach ($vendorOrder->items as $item)
                                                                            <tr
                                                                                class="itemRef{{ $item->pk_purchase_order_items }}">
                                                                                <input type="hidden" name="item_name[]"
                                                                                    value="{{ $item->name }}"
                                                                                    class="item_name">
                                                                                <input type="hidden"
                                                                                    name="item_description[]"
                                                                                    value="{{ $item->description }}"
                                                                                    class="item_description">
                                                                                <input type="hidden" name="item_price[]"
                                                                                    value="{{ $item->price }}"
                                                                                    class="item_price">
                                                                                <input type="hidden"
                                                                                    name="item_quantity[]"
                                                                                    value="{{ $item->quantity }}"
                                                                                    class="item_quantity">
                                                                                <input type="hidden" name="item_total[]"
                                                                                    value="{{ $item->total }}"
                                                                                    class="item_total">
                                                                                <th>{{ $item->name }}</th>
                                                                                <td>{{ $item->description }}</td>
                                                                                <td>{{ $item->price }}</td>
                                                                                <td>{{ $item->quantity }}</td>
                                                                                <td>{{ $item->total }}</td>
                                                                                <td>
                                                                                    <a href="javascript:;"
                                                                                        class="tempItemRowEditBtn"
                                                                                        data-ref="{{ $item->pk_purchase_order_items }}"><i
                                                                                            class="fa fa-pencil text-info"></i>
                                                                                    </a>
                                                                                    <a href="javascript:;"
                                                                                        class="tempItemRowRemoveBtn"><i
                                                                                            class="fa fa-remove text-danger"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#pk_locations").change(function() {
                var status = $(this).val();
                if (status == 'other') {
                    $("#address-section").show();
                } else {
                    $("#address-section").hide();
                }
            });
            $(".pk_products").change(function() {
                $('[name=temp_item_description]').val($(this).find('option:selected').data('description'));
                $('[name=temp_price]').val($(this).find('option:selected').data('price'));
                calculateTotal();
            });

            $(document).on('keyup', '.temp_item_qty, .temp_price', function() {
                calculateTotal();
            });

            function calculateTotal() {
                const temp_price = $('.temp_price').val() || 0;
                const temp_qty = $('[name=temp_item_qty]').val() || 0;
                let temp_total = parseFloat(temp_price) * parseFloat(temp_qty);
                $('[name=temp_total]').val(temp_total.toFixed(2));
            }

            $(document).on('click', '.btnAddItemToList', function(e) {
                e.preventDefault();
           
                const el = $('.pk_products').find('option:selected');
                const item = el.val();

                const name = el.data('name');
                const price = el.data('price');
                const description = el.data('description') || '';
                const quantity = $('[name=temp_item_qty]').val() || 0;
                const total = $('[name=temp_total]').val() || 0;
                const ref = $('.ref').val() || '';

                if (!item || item == '') {
                    alert('Please select item.');
                    return false;
                }

                if (!quantity) {
                    alert('Quantity required.');
                    return false;
                }
                $('.tempItemTbl').show();

                let html = '';
                html += `<tr class="itemRef${ref}">`;
                html += `<input type="hidden" class="item_name" name="item_name[]" value="${name}">`;
                html +=
                    `<input type="hidden" class="item_description" name="item_description[]" value="${description}">`;
                html += `<input type="hidden" class="item_price" name="item_price[]" value="${price}">`;
                html +=
                    `<input type="hidden" class="item_quantity" name="item_quantity[]" value="${quantity}">`;
                html += `<input type="hidden" class="item_total" name="item_total[]" value="${total}">`;
                html += `<th>${name}</th>`;
                html += `<td>${description}</td>`;
                html += `<td>${price}</td>`;
                html += `<td>${quantity}</td>`;
                html += `<td>${total}</td>`;
                html += `<td>`;
                if (ref) {
                    html +=
                        `<a href="javascript:;" class="tempItemRowEditBtn" data-ref="${ref}"><i class="fa fa-pencil text-info"></i></a>`;
                }
                html +=
                    `<a href="javascript:;" class="tempItemRowRemoveBtn"><i class="fa fa-remove text-danger"></i></a>`;
                html += `</td>`;
                html += `</tr>`;

                if (ref) {
                    $('.ref').val('');
                    $(`.itemRef${ref}`).replaceWith(html);
                } else {
                    $('.tempItemList').prepend(html);
                }
            });

            $(document).on('click', '.tempItemRowRemoveBtn', function(e) {
                e.preventDefault();
                $(this).closest("tr").remove();
            });

            $(document).on('click', '.tempItemRowEditBtn', function(e) {
                e.preventDefault();
                $('.ref').val($(this).data('ref'));

                const item_name = $(this).closest("tr").find('.item_name').val();
                $(".pk_products option[data-name='" + item_name + "']").prop("selected", true);

                const item_description = $(this).closest("tr").find('.item_description').val();
                $('[name=temp_item_description]').val(item_description);

                const item_price = $(this).closest("tr").find('.item_price').val();
                $('[name=temp_price]').val(item_price);

                const item_quantity = $(this).closest("tr").find('.item_quantity').val();
                $('[name=temp_item_qty]').val(item_quantity);


                const item_total = $(this).closest("tr").find('.item_total').val();
                $('[name=temp_total]').val(item_total);
            });
        });

        function checkForm() {

            const pk_locations = $('#pk_locations').find('option:selected').val();
            if (pk_locations == 'other') {
                if (!$('[name=address]').val()) {
                    alert('Location address required');
                    return false;
                }
                if (!$('[name=city]').val()) {
                    alert('Location city required');
                    return false;
                }
                if (!$('[name=zip]').val()) {
                    alert('Location zip required');
                    return false;
                }
                if (!$('[name=state_name]').val()) {
                    alert('Location state name required');
                    return false;
                }
                if (!$('[name=country_name]').val()) {
                    alert('Location country name required');
                    return false;
                }
            }

            if (!$('[name^="item_name"]').length) {
                alert('Please select an item');
                return false;
            }
        }
    </script>

@endsection
