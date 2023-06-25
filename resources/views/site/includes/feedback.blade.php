@if(!empty($seo->recaptcha_site_key) && !empty($seo->recaptcha_secret_key))
    <div class="chatbot-container d-none d-sm-block" style="position:fixed; bottom:0; right:1em; z-index:999; width:100%; min-width:300px; max-width:350px">
        <div class="mr-lg-4 shadow-lg">
        <div class="chatbot-header cursor-pointer d-flex justify-content-between align-items-center py-0 overflow-hidden  bg-dark shadow text-white" style="border-radius:15px 15px 0 0"> 
            <div class="py-2 px-3"> {{label('lbl_feedbacks')}} </div> 
            <div class="chatbot-toggle d-flex align-items-center justify-content-center py-3 px-3"> <i class="fa fa-chevron-down  toggle-arrow"> </i> </div>
        </div>
        <div class="chatbot-body bg-white box-shadow p-3 p-lg-4 border border-top-0"> 
            <p class="text-faded"> 
                {{label('lbl_feedback')}}
            <p>
            <form class=""  method="POST" action="{{url('complaints')}}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="first_name" type="text" class="form-control rounded py-3" id="first_name" placeholder="{{label('lbl_fullname')}}" autocomplete="off" required>
                </div>
        
                <div class="form-group">
                    <input name="email" type="email" class="form-control rounded py-3" id="email" placeholder="{{label('lbl_email')}}" autocomplete="off" required>
                </div>
        
                <div class="form-group">
                    <textarea name="message" type="text" class="form-control rounded py-2" id="message" placeholder="{{label('lbl_message')}}" style="resize:none" autocomplete="off" required></textarea>
                </div>
        
                {{-- <div class="form-group position-relative" style="overflow:hidden">
                    <div class="g-recaptcha" data-sitekey="{{$seo->recaptcha_site_key}}"></div>
                </div> --}}
        
                <button type="submit" class="btn btn-primary rounded"><span> {{label('lbl_submit')}} </span><span class="fa pl-2 fa-arrow-right"></span></button>
            </form>
        </div>
        </div>
    </div>
@endif