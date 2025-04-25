@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<footer class="first-footer rec-pro">
  <div class="top-footer">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6">
          <div class="netabout row justify-content-center">
            <a href="{{ route('index') }}" class="logo">
              <img width="80px"
                src="{{ asset('/front/images/' . $setting->logo) }}"
                alt="netcom">
            </a>
          </div>
          <div class="contactus row justify-content-center">
            <ul>
              <li>
                <div class="info">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <p class="in-p">{{ $setting->address }}</p>
                </div>
              </li>
              <li>
                <div class="info">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <p class="in-p">{{ $setting->phone }}</p>
                </div>
              </li>
              <li>
                <div class="info">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <p class="in-p">{{ $setting->email }}</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="second-footer rec-pro">
    <div class="container-fluid sd-f d-flex" style="max-width: 1400px;">
      <div>
        <p>{{ $setting->copyright }}</p>
      </div>
      <ul class="netsocials">
        <li><a href="{{ $setting->facebook }}"><i class="fa fa-facebook"
              aria-hidden="true"></i></a></li>
        <li><a href="{{ $setting->youtube }}"><i class="fa fa-youtube"
              aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
</footer>
