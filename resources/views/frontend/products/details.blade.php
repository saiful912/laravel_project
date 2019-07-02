@extends('frontend.layouts.master')
@section('main')
    <main role="main">
        <div class="container">

            <br>
            <p class="text-center mb-5">Product Title</p>
            <hr>

            <div class="card">
                <div class="row">
                    <aside class="col-sm-5 border-right">
                        <article class="gallery-wrap">
                            <div>
                                <img src="{{$product->getFirstMediaUrl('products')}}" class="card-img-top" alt="{{$product->title}}}">
                            </div> <!-- slider-product.// -->
                        </article> <!-- gallery-wrap .end// -->
                    </aside>

                    <aside class="col-sm-7">
                        <article class="card-body p-5">
                            <h3 class="title mb-3">{{$product->title}}</h3>

                            <p class="price-detail-wrap">
                            <span class="price h3 text-warning">
                                <span class="currency">Price : </span>
                                <span class="num">
                                      @if($product->sale_price != null && $product->sale_price > 0)
                                        BDT <strike>{{$product->sale_price}}</strike> BDT {{$product->sale_price}}
                                    @else
                                        BDT {{$product->price}}
                                    @endif
                                </span>
                            </span>
                            </p> <!-- price-detail-wrap .// -->

                            <dl class="item-property">
                                <dt>Description</dt>
                                <dd><p>{{$product->description}}</p></dd>
                            </dl>
                            <hr>

                            <form action="{{route('cart.add')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="btn btn-lg btn-outline-primary text-uppercase">
                                    <i class="fas fa-shopping-cart"></i>Add to Cart
                                </button>
                            </form>
                        </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card.// -->

        </div>
        <!--container.//-->
    </main>
    @endsection