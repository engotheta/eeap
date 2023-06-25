 
  <div class="chatbot-container d-none d-md-block overflow-hidden" style="position:fixed; bottom:0; right:1em; z-index:999; width:100%; min-width:300px; max-width:540px">
    <div class="mr-lg-4 d-flex flex-column align-items-end">
      <div class="bot-header w-100 cursor-pointer d-flex justify-content-between align-items-center py-0 overflow-hidden "> 
        <div class="col h-40 d-flex align-items-center bot-header-text  bg-primary text-white" style="min-width:260px"> Online Help </div> 
        <div class="bot-toggle bg-primary d-flex align-items-center justify-content-center py-3 px-3 box-40">
          <i class="when-inactive text-white fa fa-comment-dots "></i>
          <i class="position-absolute when-active text-white fa fa-times "></i>
        </div>
      </div>
      <div class="bot-body w-100 px-3 bg-white box-shadow border border-top-0"> 
        <small class="text-faded d-block mb-2 "> 
          {{label('lbl_site_motto')}}
        </small>
        <form class="faq-form "  method="POST" action="{{route('complaints.store')}}" accept-charset="UTF-8"style="min-height: 250px">
          @csrf
          <!-- <div class="form-group no-faq">
            <textarea type="text" class="form-control py-2" id="inputAddress2" placeholder="Something is coming..." style="resize:none">Subject</textarea>
         </div> -->

         <div class="form-group no-faq d-none move-left" style="--order:2">
            <div class="d-flex bg-primary-very-faded border-faded align-items-center">
                <span class="fa fa-bullseye text-primary border-right border-color-primary  px-2"></span>
                <input name="subject" type="text" class="form-control bg-none border-0 py-3 col" id="inputName" placeholder="Subject" requireddd>
            </div>
         </div>

          <div class="form-group " >
            <div id="wrapper" class="w-100">
              <select id="selectFaqList" name="select" class="w-100" >
                @foreach($faqs as $key => $faq)
                  <option class="w-100" value="faq_{{$key}}"> {{$faq->question}}</option>
                @endforeach
              </select>
            </div>
          </div>
  
          <div class="faq-ans move-left p-3 bg-light-slight border-faded d-none" style="--order:2"></div>
  
          <div class="form-group no-faq d-none move-left" style="--order:2">
                <div class="d-flex bg-primary-very-faded border-faded align-items-center">
                    <div class="fa fa-user text-primary border-right border-color-primary  px-2"></div>
                    <input name="first_name" type="text" class="form-control bg-none border-0 py-3 col" id="inputName" placeholder="Full name" requireddd>
                </div>
          </div>
  
          <div class="form-group no-faq d-none move-left" style="--order:1.5">
            <div class="d-flex bg-primary-very-faded border-faded align-items-center">
                <span class="fa fa-phone text-primary border-right border-color-primary px-2"></span>
                <input name="phone" type="text" class="form-control bg-none border-0 py-3" id="inputphone" placeholder="Your phone number" requireddd>
            </div>
          </div>
  
          <div class="form-group no-faq d-none move-left" style="--order:3">
            <div class="d-flex align-items-center bg-primary-very-faded border-faded">
                <span class="fa fa-paper-plane text-primary border-right border-color-primary px-2"></span>
                <input name="email" type="text" class="form-control bg-none border-0 py-3" id="inputEmail" placeholder="Your email address" requireddd>
            </div>
          </div>

          {{-- <div class="form-group position-relative mt-2 no-faq d-none move-left" style="--order:2; overflow:hidden">
            <div class="g-recaptcha" data-sitekey="{{$seo->recaptcha_site_key}}"></div>
          </div> --}}
  
          <button type="submit" disabled class="btn btn-primary submit-faq d-none move-left" style="--order:3.5"><span> send </span><span class="fa pl-2 fa-arrow-right"></span></button>
        </form>    
      </div>
    </div>
  </div>
  
  <div class="d-none">
    @foreach($faqs as $key => $faq)
      <div class="answered-faq" id="faq_{{$key}}" data-faq="{{$faq->question}}" data-ans="{!!$faq->answer!!}" ></div>
    @endforeach
  </div>