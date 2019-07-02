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
                                <span class="currency">BDT </span>
                                <span class="num">
                                    {{$product->price}}
                                </span>
                            </span>
                            </p> <!-- price-detail-wrap .// -->

                            <dl class="item-property">
                                <dt>Description</dt>
                                <dd><p>{{$product->description}}</p></dd>
                            </dl>
                            <hr>

                            <form action="/cart" method="post">
                                <input type="hidden" name="id" value="1">
                                <button type="submit" class="btn btn-lg btn-outline-primary text-uppercase">
                                    Add to Cart
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