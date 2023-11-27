<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('admin/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/assets/js/app.js')}}"></script>
<script src="{{asset('admin/assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/form-element-select.js')}}"></script>
{{--toastr--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(\Illuminate\Support\Facades\Session::has('success'))
    toastr.success("{{\Illuminate\Support\Facades\Session::get('success')}}", 'Success', {timeOut: 3000});
    @endif

    @if(\Illuminate\Support\Facades\Session::has('error'))
    toastr.error('{{\Illuminate\Support\Facades\Session::get('error')}}', 'Error', {timeOut: 3000});
    @endif
</script>
<!-- Load jQuery from CDN so can run demo immediately -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{asset('build/js/countrySelect.js')}}"></script>
<script>
    $("#country_selector").countrySelect({
        // defaultCountry: "jp",
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // responsiveDropdown: true,
        preferredCountries: ['ca', 'gb', 'us']
    });
</script>
