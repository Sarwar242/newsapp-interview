<footer class="footer">
    <div class="d-flex justify-content-between">
        <span class="float-none float-sm-left d-block mt-1 mt-sm-0 text-center text-primary"> Copyright © 2023.
            @if(settings('copyright_url'))
                <a class="text-primary font-weight-bold" href="{{ settings('copyright_url') }}" target="_blank">{{ settings('copyright') }} </a>
            @else
            N/A
            @endif
            All rights reserved.
        </span>
        <span class="float-none float-sm-left d-block mt-1 mt-sm-0 text-center text-primary"> 1.0 </span>

        {{-- Don't use web solution firm text or logo anywhere in this website --}}
    </div>
</footer>
