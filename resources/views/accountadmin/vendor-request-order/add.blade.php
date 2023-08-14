@extends('layouts.backend_new')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <form class="vendorRequestForm" method="post" action="/accountadmin/vendor-request-order/submit"
                  onsubmit="return checkForm()">
                @csrf
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
                                <li class="breadcrumb-item"><a href="/accountadmin">Home</a></li>
                                <li class="breadcrumb-item active"><a href="/accountadmin/vendor-request-order">Purchase Order</a></li>
                            </ol>
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"
                                    style="margin-top: -34px;"><i
                                    class="fa fa-plus-circle"></i>{{ isset($vendorOrder) && $vendor->vendor_request_order ? 'Edit Purchase Order' : 'Create New Purchase Order' }}
                            </button>
                        </div>
                    </div>
                    <ul class="nav nav-tabs customtab" role="tablist" id="myTab">
                        <li class="nav-item active"><a
                                class="nav-link {{ isset($tab) && $tab == 'vendor-request-order' ? '' : 'active' }}"
                                data-bs-toggle="tab" href="#vendor-request-order" role="tab"
                                aria-selected="true"><span
                                    class="hidden-sm-up"></span> <span class="hidden-xs-down">Vendor Request
                                    Order</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#itemstab" role="tab"
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
                                            {{ isset($VaseType) && $VaseType->pk_vase_type ? 'Edit Vase Type' : 'New Purchase Order' }}
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
                                                                                @if (old('pk_vendors') == $item->pk_vendors) selected @endif>
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
                                                                   value="{{ old('po_number') }}" required>
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
                                                                   value="{{ old('delivery_date_request') }}" required>
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
                                                                <option value=""> Select Location</option>
                                                                @if ($locations)
                                                                    @foreach ($locations as $item)
                                                                        <option value="{{ $item->pk_locations }}"
                                                                                @if (old('pk_locations') == $item->pk_locations) selected @endif>
                                                                            {{ $item->location_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                                <option value="other"
                                                                        @if (request()->pk_locations == 'other') selected @endif>
                                                                    Other
                                                                </option>
                                                            </select>
                                                            @error('pk_locations')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div id="address-section">
                                                            <div class="form-group">
                                                                <label for="location_name">Address</label>
                                                                <input type="text" name="address" id="autocomplete"
                                                                       class="form-control @error('address') is-invalid @enderror"
                                                                       value="{{ old('address') }}">
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
                                                                       value="{{ old('address_1') }}" maxlength="10">
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
                                                                       value="{{ old('city') }}">
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
                                                                       value="{{ old('zip') }}">
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
                                                                       value="{{ old('state_name') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Country</label>
                                                                <input id="country" type="text" name="country_name"
                                                                       class="form-control"
                                                                       value="{{ old('country_name') }}">
                                                            </div>
                                                        </div>
                                                        <!--                                                        <div class="form-group">
                                                            <label class="form-label">Active</label>
                                                            <input type="radio" name="active" value="1"
                                                                   checked="checked" class="form-check-input"
                                                            @if (request()->active)
                                                            {{ old('active') == '1' ? 'checked' : '' }}
                                                        @endif>
                                                            <label class="form-check-label" for="customRadio11"
                                                                   style="margin-left: 20px;">Yes</label>
                                                            <input type="radio" name="active" value="0"
                                                                   @if (request()->active)
                                                            {{ old('active') == '0' ? 'checked' : '' }}
                                                        @endif
                                                        class="form-check-input">
                                                 <label class="form-check-label" for="customRadio22"
                                                        style="margin-left: 20px;">No</label>
                                             </div>-->


                                                        <a href="/accountadmin/vendor-request-order"><input
                                                                class="btn btn-primary" type="button"
                                                                value="Cancel"></a>
                                                        <button type="button" class="btn btn-primary" id="addItemsBtn">
                                                            Add Items
                                                        </button>

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
                                            {{ isset($VaseType) && $VaseType->pk_vase_type ? 'Edit Vase Type' : 'New Purchase Order' }}
                                        </h4>
                                        <div class="tab-content br-n pn">
                                            <div id="navpills-1" class="tab-pane active">
                                                <div class="row justify-content-center">
                                                    <div class="form-group mx-2">
                                                        <label for="styles">Item</label>
                                                        <select name="pk_products" id="pk_products"
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
                                                            <option value="other"
                                                                    @if (request()->pk_products == 'other') selected @endif>
                                                                Other
                                                            </option>
                                                        </select>
                                                        @error('pk_products')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mx-2" id="temp_name_section"
                                                         style="display: none;">
                                                        <label for="temp_item_name">Item Name</label>

                                                        <input type="text" name="temp_item_name" id="temp_item_name"
                                                               class="form-control my-2 @error('temp_item_name') is-invalid @enderror"
                                                               value="{{ old('temp_item_name') }}"
                                                               placeholder="Item name">
                                                        @error('temp_item_name')
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
                                                               id="temp_price"
                                                               class="form-control temp_price @error('temp_price') is-invalid @enderror"
                                                               value="{{ old('temp_price') }}">
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

                                                        <a href="/accountadmin/vase-types/back">
                                                            <input class="btn btn-success btnAddItemToList"
                                                                   type="button"
                                                                   value="Add Item"></a>
                                                        <a href="/accountadmin/vendor-request-order"><input
                                                                class="btn btn-secondary" type="button"
                                                                value="Cancel"></a>
                                                    </div>


                                                </div>

                                                <div class="row justify-content-center tempItemTbl"
                                                     style="@if(!old('item_name')) display: none @endif">
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
                                                                @if (old('item_name'))
                                                                    @for ($i = 0; $i < count(old('item_name')); $i++)
                                                                        <tr>
                                                                            <input type="hidden" name="item_name[]"
                                                                                   value="{{ old('item_name')[$i] }}">
                                                                            <input type="hidden"
                                                                                   name="item_description[]"
                                                                                   value="{{ old('item_description')[$i] }}">
                                                                            <input type="hidden" name="item_price[]"
                                                                                   value="{{ old('item_price')[$i] }}">
                                                                            <input type="hidden"
                                                                                   name="item_quantity[]"
                                                                                   value="{{ old('item_quantity')[$i] }}">
                                                                            <input type="hidden" name="item_total[]"
                                                                                   value="{{ old('item_total')[$i] }}">
                                                                            <th>{{ old('item_name')[$i] }}</th>
                                                                            <td>{{ old('item_description')[$i] }}</td>
                                                                            <td>{{ old('item_price')[$i] }}</td>
                                                                            <td>{{ old('item_quantity')[$i] }}</td>
                                                                            <td>{{ old('item_total')[$i] }}</td>
                                                                            <td><a href="javascript:;"
                                                                                   class="tempItemRowRemoveBtn"><i
                                                                                        class="fa fa-remove text-danger">
                                                                                    </i></a></td>
                                                                        </tr>
                                                                    @endfor
                                                                @endif

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="text-center" id="save-button-section"
                                                     style="display: none;">
                                                    <a href="/accountadmin/vendor-request-order"><input
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
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#address-section").hide();
            $("#pk_locations").change(function () {
                var status = $(this).val();
                if (status == 'other') {
                    $("#address-section").show();
                } else {
                    $("#address-section").hide();
                }
            });
            $(".pk_products").change(function () {
                $('[name=temp_item_description]').val($(this).find('option:selected').data('description'));
                $('[name=temp_price]').val($(this).find('option:selected').data('price'));
                let optionsVal = $(this).val();
                if (optionsVal === 'other') {
                    $('#temp_name_section').show();
                } else {
                    $('#temp_name_section').hide();
                }
                calculateTotal();
            });

            $(document).on('keyup', '.temp_item_qty, .temp_price', function () {
                calculateTotal();
            });

            $(document).on('change', '.temp_item_qty, .temp_price', function () {
                calculateTotal();
            });

            function calculateTotal() {
                const temp_price = $('.temp_price').val() || 0;
                const temp_qty = $('[name=temp_item_qty]').val() || 0;
                let temp_total = parseFloat(temp_price) * parseFloat(temp_qty);
                $('[name=temp_total]').val(temp_total.toFixed(2));
            }

            $(document).on('click', '.btnAddItemToList', function (e) {
                e.preventDefault();
                const el = $('.pk_products').find('option:selected');
                const item = el.val();
                const name = item === 'other' ? $('#temp_item_name').val() : el.data('name');
                const price = el.data('price') || $('#temp_price').val() || 0;
                const description = el.data('description') || $('[name=temp_item_description]').val() || '';
                const quantity = $('[name=temp_item_qty]').val() || 0;
                const total = $('[name=temp_total]').val() || 0;

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
                html += `<tr>`;
                html += `<input type="hidden" name="item_name[]" value="${name}">`;
                html += `<input type="hidden" name="item_description[]" value="${description}">`;
                html += `<input type="hidden" name="item_price[]" value="${price}">`;
                html += `<input type="hidden" name="item_quantity[]" value="${quantity}">`;
                html += `<input type="hidden" name="item_total[]" value="${total}">`;
                html += `<th>${name}</th>`;
                html += `<td>${description}</td>`;
                html += `<td>${price}</td>`;
                html += `<td>${quantity}</td>`;
                html += `<td>${total}</td>`;
                html +=
                    `<td><a href="javascript:;" class="tempItemRowRemoveBtn"><i class="fa fa-remove text-danger"></></a></td>`;
                html += `</tr>`;

                $('.tempItemList').prepend(html);
                $('#save-button-section').show();
            });

            $(document).on('click', '.tempItemRowRemoveBtn', function (e) {
                e.preventDefault();
                $(this).closest("tr").remove();
                if (!$('.tempItemList').find('tr').length) {
                    $('.tempItemTbl').hide();
                    $('#save-button-section').hide();
                }
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

        $('#addItemsBtn').on('click', function (e) {
            e.preventDefault();

            $('#myTab a[href="#itemstab"]').tab('show');
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script src="/assets/address-auto-complete.js"></script>
@endsection
