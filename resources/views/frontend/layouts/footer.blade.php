<!--  footer -->
<footer id="fenghua_footer" >
        <!-- ************info_area*************** -->
        <section  class=" align-content-center info_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <a class="navbar-brand" href="index.html"><img src="{{ asset($footer_infos->first()->logo) }}" alt="網站 Logo" width="200px"></a>
                    </div>
                    <div class="col-md-4 text-center text-white-50 mt-2">
                        <p><span class="text-white-50">地址:</span> {{$footer_infos->first()->address}}</p>
                        <p><span class="text-white-50">聯絡電話:</span> {{$footer_infos->first()->phone}}</p>
                        <p><span class="text-white-50">Email:</span> {{$footer_infos->first()->email}}</p>
                    </div>
                    <div class="col-md-4 text-center">
                        @foreach($footer_socias as $footer_socia)
                            @if($footer_socia->status == 1)
                                <a href="{{ $footer_socia->url }}" class="text-decoration-none">
                                    <i class="{{ $footer_socia->icon }} text-white p-3">
                                        <span>{{ $footer_socia->name }}</span>
                                    </i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- ************Copyright*************** -->
        <section  class=" bg-op-colo1 mt-2 Copyright_area" >
            <div class="container">
                <div class="row">
                    <div class="col-12 text-white-50 text-center">
                        <p style="color: #C5C4C1;">Copyright © {{$footer_infos->first()->copyright}} {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </section>
</footer>
