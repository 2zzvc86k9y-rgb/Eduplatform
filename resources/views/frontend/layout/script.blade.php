@php
    $setting = App\Models\SiteSetting::find(1);
    $currencySymbol = $setting->currency; // Replace 'currency_symbol' with the actual field name in your database
@endphp



{{--  wishlist work start  --}}

<script type="text/javascript">
var currencySymbol = "{{ $currencySymbol }}"; // Pass the PHP variable to JavaScript

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addToWishList(course_id) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "/add-to-wishlist/" + course_id,
            success: function(data, textStatus, jqXHR) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });

                if (jqXHR.status === 200) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                } else if (jqXHR.status === 409) {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            },
            error: function(jqXHR) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000
                });

                if (jqXHR.status === 401) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please login first'
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'This Course has already been added to the wishlist'
                    });
                }
            }
        });
    }
</script>

{{--  wishlist work end --}}


<script type="text/javascript">

   function wishlist(){
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/get-wishlish-course/',

        success:function(response){
            $('#wishlistquantity').text(response.wishlistquantity);
            var rows = "";

            $.each(response.wishlist, function(key,value){
                rows += `
                <div class="col-lg-4 responsive-column-half">
            <div class="card card-item">
                <div class="card-image">
                    <a href="/course/details/${value.course.id}/${value.course.course_name_slug}" class="d-block">
                        <img class="card-img-top" src="/${value.course.course_image}" alt="Card image cap">
                    </a>

                </div><!-- end card-image -->
                <div class="card-body">
                    <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">${value.course.label}</h6>
                    <h5 class="card-title"><a href="/course/details/${value.course.id}/${value.course.course_name_slug}">${value.course.course_name}</a></h5>

                    <div class="d-flex justify-content-between align-items-center">


                        ${value.course.discount_price == null ? `<p class="text-black card-price font-weight-bold">${currencySymbol}${value.course.discount_price}</p>` : `<p class="text-black card-price font-weight-bold">${currencySymbol}${value.course.discount_price} <span class="before-price font-weight-medium">${currencySymbol}${value.course.selling_price}</span></p>` }
                        <div class="shadow-sm cursor-pointer icon-element icon-element-sm" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist" id="${value.id}" onclick="removeWishList(this.id)"><i class="la la-heart"></i></div>
                    </div>
                </div>
            </div>
        </div>   `
            });

         $('#wishlist').html(rows);

        }
    })
   }
   wishlist();





    //    remove WishList
    function removeWishList(id){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/remove-wishlist/'+id,
            success:function(response){
                wishlist();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: response.success
                });
            }
        })
    }


</script>


{{-- add to cart js  --}}

<script type="text/javascript">
    function addToCart(course_id, course_name, instructor_id, course_name_slug) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                _token: '{{csrf_token()}}',
                course_name: course_name,
                course_name_slug: course_name_slug,
                instructor_id: instructor_id
            },
            url: "/cart/data/store/" + course_id,
            success: function(data) {
                addToMiniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                } else if (data.error) {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            }
        });
    }
</script>




{{-- add Mini cart js  --}}

<script type="text/javascript">
    function addToMiniCart() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/course/mini/cart/',


            success: function(response){
                $('span[id="cartsubtotal"]').text(response.cartTotal);
                $('span[id="cartquantity"]').text(response.cartQty);
                var minicart = "";
                $.each(response.carts, function(key, value) {
                    minicart += `<li class="media media-card">
                            <a href="shopping-cart.html" class="media-img">
                                <img src="/${value.options.image}" alt="Cart image">
                            </a>
                            <div class="media-body">
                                <h5><a href="/course/details/${value.id}/${value.options.slug}">${value.name}</a></h5>
                                <div class="d-flex justify-content-between">
                                    <span class="d-block fs-14">${currencySymbol}${value.price}</span>
                                <a type="submit" id="${ value.rowId }" onclick="miniCartRemove(this.id)"><i class="la la-times"></i></a>
                                </div>
                            </div>
                    </li>
                    `
                });

                $('#minicart').html(minicart);
            }
        })
    }

    addToMiniCart();


    // remove miniCartRemove
    function miniCartRemove(rowId){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/mini-cart-remove/'+rowId,
            success:function(response){
                addToMiniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: response.success
                });
            }
        })
    }

</script>




{{-- start my cart page course  --}}

<script type="text/javascript">
    function myCart(){
        $.ajax({
            type: "GET",
            url: "/get-cart-course/",
            dataType: "JSON",
            success: function (response){
                $('span[id="cartsubtotal"]').text(response.cartTotal);
                $('span[id="total"]').text(response.cartTotal);

                var rows = "";
                $.each(response.carts, function(key, value) {
                    rows += `<tr>
                        <th scope="row">
                            <div class="media media-card">
                                <a href="/course/details/${value.id}/${value.options.slug}" class="mr-0 media-img">
                                    <img src="/${value.options.image}" alt="Cart image">
                                </a>
                            </div>
                        </th>
                        <td>
                            <a href="/course/details/${value.id}/${value.options.slug}" class="text-black font-weight-semi-bold">${value.name}</a>
                        </td>
                        <td>
                            <ul class="generic-list-item font-weight-semi-bold">
                                <li class="text-black lh-18">${currencySymbol}${value.price}</li>
                            </ul>
                        </td>
                        <td>
                            <div class="quantity-item d-flex align-items-center">
                                <input class="qtyInput" type="text" name="qty-input" value="1">
                            </div>
                        </td>
                        <td>
                            <button type="button" class="border-0 shadow-sm icon-element icon-element-xs" data-toggle="tooltip" data-placement="top" title="Remove" id="${value.rowId}" onclick="removecourse(this.id)">
                                <i class="la la-times"></i>
                            </button>
                        </td>
                    </tr>`;
                });
                $('#cartpage').html(rows);
            }
        });
    }

    myCart();

    // Remove Cart course
    function removecourse(rowId){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/cart-course-remove/' + rowId,
            success: function(response) {
                cuponCalculation();
                myCart();
                addToMiniCart();

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: response.success
                });
            }
        });
    }


</script>
{{--  <button class="qtyBtn qtyDec"><i class="la la-minus"></i></button> --}}
{{--  <button class="qtyBtn qtyInc"><i class="la la-plus"></i></button> --}}


{{-- start instructor cupon cart page course  --}}

<script type="text/javascript">
    function applyInsCupon(){
           var cupon_name = $('#cupon_name').val();
           var course_id = $('#course_id').val();
           var instructor_id = $('#instructor_id').val();
           $.ajax({
               type: 'POST',
               dataType: 'json',
               data: {
                   cupon_name: cupon_name,
                   course_id:course_id,
                   instructor_id:instructor_id,
               },
               url: "/instructor-apply-cupon",
               success: function(data) {
                   cuponCalculation(); // Recalculate totals after applying the coupon
                   addToMiniCart();
                   myCart();
                   if (data.validity == true) {
                       $('#cuponField').hide();
                   }

                   const Toast = Swal.mixin({
                       toast: true,
                       position: 'top-end',
                       showConfirmButton: false,
                       timer: 3000
                   });
                   if (data.success) {
                       Toast.fire({
                           icon: 'success',
                           title: data.success
                       });

                   } else if (data.error) {
                       Toast.fire({
                           icon: 'error',
                           title: data.error
                       });
                   }
               }
           })
       }



</script>


{{-- start apply cupon front  page course  --}}

<script type="text/javascript">

    function applyCupon(){
            var cupon_name = $('#cupon_name').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    cupon_name: cupon_name
                },
                url: "/apply-cupon",
                success: function(data) {
                    if (data.validity == true) {
                        $('#cuponField').hide();
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if (data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                        cuponCalculation(); // Recalculate totals after applying the coupon
                    } else if (data.error) {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }





        //start cupon calculation

        function cuponCalculation(){
            $.ajax({
                type: 'GET',
                url: "/cupon-calculation",
                dataType: 'json',

                success:function(data){
                    

                    if(data.total){
                        $('#cuponCalField').html(`<h3 class="pb-3 fs-18 font-weight-bold">Cart Totals</h3>
                        <div class="divider"><span></span></div>
                        <ul class="pb-4 generic-list-item">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">${currencySymbol} </span>
                                <span >${data.total}</span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Total: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">${currencySymbol} </span>
                                <span >${data.total}</span>
                            </div>
                        </li>
                        </ul>




                            `
                        )
                    }
                    else{
                        $('#cuponCalField').html(`<h3 class="pb-3 fs-18 font-weight-bold">Cart Totals</h3>
                        <div class="divider"><span></span></div>
                        <ul class="pb-4 generic-list-item">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">${currencySymbol} </span>
                                <span >${data.subtotal}</span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Coupon Name: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1"></span>
                                <span >${data.cupon_name} <button type="button" class="border-0 shadow-sm icon-element icon-element-xs" data-toggle="tooltip"  onclick="removeCupon()">
                                <i class="la la-times"></i>
                            </button></span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Discount Price: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span >${data.cupon_discount}</span>
                                <span class="m-1">% </span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Grand Total: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">${currencySymbol} </span>
                                <span >${data.total_amount}</span>
                            </div>
                        </li>
                        </ul>



                            `
                        );
                    }

                }
            })
        }
        cuponCalculation();
</script>
{{-- start apply cupon front  page course  --}}
{{--
<script type="text/javascript">

    function applyInsCupon(){
        var cupon_name = $('#cupon_name').val();
           var course_id = $('#course_id').val();
           var instructor_id = $('#instructor_id').val();
           $.ajax({
               type: 'POST',
               dataType: 'json',
               data: {
                   cupon_name: cupon_name,
                   course_id:course_id,
                   instructor_id:instructor_id,
               },
               url: "/instructor-apply-cupon",
               success: function(data) {
                   cuponCalculation(); // Recalculate totals after applying the coupon
                   addToMiniCart();
                   myCart();
                   if (data.validity == true) {
                       $('#cuponField').hide();
                   }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if (data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                        cuponCalculation(); // Recalculate totals after applying the coupon
                    } else if (data.error) {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }





        //start cupon calculation

        function cuponCalculation(){
            $.ajax({
                type: 'GET',
                url: "/cupon-calculation",
                dataType: 'json',

                success:function(data){
                  

                    if(data.total){
                        $('#cuponCalField').html(`<h3 class="pb-3 fs-18 font-weight-bold">Cart Totals</h3>
                        <div class="divider"><span></span></div>
                        <ul class="pb-4 generic-list-item">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">$ </span>
                                <span >${data.total}</span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Total: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">$ </span>
                                <span >${data.total}</span>
                            </div>
                        </li>
                        </ul>




                            `
                        )
                    }
                    else{
                        $('#cuponCalField').html(`<h3 class="pb-3 fs-18 font-weight-bold">Cart Totals</h3>
                        <div class="divider"><span></span></div>
                        <ul class="pb-4 generic-list-item">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">$ </span>
                                <span >${data.subtotal}</span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Coupon Name: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1"></span>
                                <span >${data.cupon_name} <button type="button" class="border-0 shadow-sm icon-element icon-element-xs" data-toggle="tooltip"  onclick="removeCupon()">
                                <i class="la la-times"></i>
                            </button></span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Discount Price: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span >${data.cupon_discount}</span>
                                <span class="m-1">% </span>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Grand Total: </span>
                            <div class="d-flex align-items-center font-weight-semi-bold">
                                <span class="m-1">$ </span>
                                <span >${data.total_amount}</span>
                            </div>
                        </li>
                        </ul>



                            `
                        );
                    }

                }
            })
        }
        cuponCalculation();
</script> --}}








{{-- end my cart page course  --}}











{{-- start removeCupon  page course  --}}

<script type="text/javascript">

    function removeCupon(){
        $.ajax({
            type: 'GET',
            url: "/cupon-remove",
            dataType: 'json',

            success:function(data){
                cuponCalculation();
                $('#cuponField').show();
                $('#cupon_name').val('');

                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if (data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                    } else if (data.error) {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        });
                    }
            }
        });
    }
</script>




{{-- start Buy this curse  --}}


<script type="text/javascript">
    function buyThisCourse(course_id, course_name, instructor_id, course_name_slug) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                _token: '{{csrf_token()}}',
                course_name: course_name,
                course_name_slug: course_name_slug,
                instructor_id: instructor_id
            },
            url: "/buy/this/course/" + course_id,
            success: function(data) {
                addToMiniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                    //redirect to the checkout page
                    window.location.href = '/checkout';
                } else if (data.error) {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            }
        });
    }
</script>









