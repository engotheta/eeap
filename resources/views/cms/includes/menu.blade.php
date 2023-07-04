<ul class="nav ega-inner-navbar">

    {{-- @if(permission('*. .*')) --}}
      <li class="nav-item ega-menu-caption">
          <label>Analytics</label>
      </li>

      <li data-username="dashboard Default cms" class="nav-item @php activeLink(['cms']) @endphp">
          <a href="{{ url('/cms')}}" class="nav-link ">
            <span class="ega-micon"><i class="feather icon-home"></i></span>
            <span class="ega-mtext">Dashboard</span>
          </a>
      </li>
    {{-- @endif --}}

    @if(permission(['*.staffemail.*','*.quick_links.*', '*.related_links.*','*.external_links.*','*.sponsors.*','*.social_links.*',
                  '*.publication.*','*.pressreleases.*','*.publication_categories.*','*.tender.*','*.vacancies.*','*.galleries.*',
                  '*.administration.*','*.administration_categories.*','*.management-groups.*','*.events.*','*.sports.*','*.event-categories.*',
                  '*.pages.*','*.page-categories.*','*.faq.*']))
      <li class="nav-item ega-menu-caption">
          <label>Site Contents</label>
      </li>
    @endif
    
    @if(permission(['*.backgrounds.*','*.campaigns.*','*.events.*','*.news.*','*.galleries.*','*.sliders.*']))
    <li data-username="backgrounds sliders news events galleries gallery photos videos audios media" class="nav-item ega-hasmenu
      @php activeLink(['backgrounds','sliders','news','galleries','media','events']) @endphp">
        <a href="javascript:" class="nav-link ">
          <span class="ega-micon"><i class="fas fa-camera-retro"></i></span><span class="ega-mtext">Media Center</span></a>
        <ul class="ega-submenu">

          {{-- @if(permission('*.welcome.*'))
            <li class="@php activeLink(['welcome']) @endphp"><a href="{{ route('cms.welcome.index') }}">Welcome Note</a></li>
          @endif --}}

          {{-- @if(permission('*.dg_messages.*'))
            <li class="@php activeLink(['dg_messages']) @endphp"><a href="{{route('cms.dg_messages.index')}}">Commissioner's Desk</a></li>
          @endif --}}

          @if(permission('*.news.*'))
            <li class="@php activeLink(['news']) @endphp"><a href="{{ url('cms/news') }}"> News</a></li>
          @endif

          @if(permission('*.events.*'))
           <li class="@php activeLink(['events']) @endphp"><a href="{{ url('cms/events') }}"> Events</a></li>
          @endif  
          
          {{-- 
          
           @if(permission('*.announcements.*'))
           <li class="@php activeLink(['events']) @endphp"><a href="{{ url('cms/announcements') }}"> Adverstisements</a></li>
          @endif  

          @if(permission('*.quickinfos.*'))
            <li class="@php activeLink(['quickinfos']) @endphp"><a href="{{route('cms.quickinfos.index')}}">Quick Info</a></li>
          @endif

          @if(permission('*.quotes.*'))
            <li class="@php activeLink(['quotes']) @endphp"><a href="{{route('cms.quotes.index')}}">Quotes</a></li>
          @endif --}}

          @if(permission('*.press_releases.*'))
            <li class="@php activeLink(['press_releases']) @endphp"><a href="{{route('cms.press_releases.index')}}">Press Releases</a></li>
          @endif

          {{-- @if(permission('*.speeches.*'))
            <li class="@php activeLink(['speeches']) @endphp"><a href="{{route('cms.speeches.index')}}">Speeches</a></li>
          @endif --}}

          @if(permission('*.galleries.*'))
           <li class="@php activeLink(['galleries', 'media']) @endphp"><a href="{{ url('cms/galleries') }}"> Galleries</a></li>
          @endif

          {{-- @if(permission('*.backgrounds.*'))
            <li class="@php activeLink(['backgrounds']) @endphp"><a href="{{ url('cms/backgrounds') }}"> Backgrounds</a></li>
          @endif --}}

        
          
        </ul>
    </li>
    @endif

    @if(permission(['*.pages.*']))
    <li data-username="pages" class="nav-item @php activeLink(['pages']) @endphp">
        <a href="{{ url('cms/pages') }}" class="nav-link">
          <span class="ega-micon"><i class="feather icon-copy"></i></span>
          <span class="ega-mtext">Pages</span>
        </a>
    </li>
    @endif

    @if(permission('*.documents.*','*.document-categories.*'))
    <li data-username="documents" class="nav-item @php activeLink(['document-categories','documents']) @endphp">
        <a href="{{ url('/cms/document-categories') }}" class="nav-link">
          <span class="ega-micon"><i class="feather icon-file-text"></i></span>
          <span class="ega-mtext">Publications</span>
        </a>
    </li>
    @endif
    

    @if(permission(['*.online_services.*','*.more-infos.*','*.agriculture-maps.*','*.faqs.*','*.hospitals.*','*.passengers.*','*.partners.*','*.stakeholders.*',
    '*.services.*','*.trainings.*','*.archievements.*','*.product_categories.*','*.products.*','*.warehouses.*','*.operators.*','*.colateral_managers.*','*.online_services.*','*.howdois.*','*.howdois.*']))
     <li data-username="online services passengers information corner how do i partners"
         class="nav-item ega-hasmenu @php activeLink(['online_services' ,'agriculture-maps','more-infos','stakeholder-categories','achievements','partners','passengers','operators','services','warehouses','colateral_managers','trainings','products','product_categories']) @endphp">
         <a href="javascript:" class="nav-link">
           <span class="ega-micon"><i class="fa fa-cart-plus"></i></span><span class="ega-mtext">{{label('lbl_site_title_short')}} Details</span></a>
         <ul class="ega-submenu">
          
          @if(permission('*.services.*'))
              <li class="@php activeLink(['services']) @endphp"><a href="{{route('cms.services.index')}}"> Actions</a></li>
          @endif
      
          {{-- @if(permission('*.licensed-entities.*','*.licensed-entity-categories.*'))
            <li data-username="licensed-entities" class="nav-item @php activeLink(['licensed-entity-categories','licensed-entities']) @endphp">
                <a href="{{ url('/cms/licensed-entity-categories') }}" class="nav-link">
                  <span class="ega-micon"><i class="feather icon-file-text"></i></span> 
                </a>
            </li>
          @endif --}}

          {{-- @if(permission('*.stakeholders.*','*.stakeholder-categories.*'))
            <li data-username="stakeholders" class="nav-item @php activeLink(['stakeholder-categories','stakeholders']) @endphp">
                <a href="{{ url('/cms/stakeholder-categories') }}" class="nav-link">
                  <span class="ega-mtext">Stakeholders</span>
                </a>
            </li>
          @endif --}}

          {{-- @if(permission('*.agriculture-maps.*'))
          <li data-username="stakeholders" class="nav-item @php activeLink(['agriculture-maps']) @endphp">
              <a href="{{ url('/cms/agriculture-maps') }}" class="nav-link">
                <span class="ega-mtext">Agriculture Maps</span>
              </a>
          </li>
           @endif --}}

          @if(permission('*.partners.*'))
            <li class="@php activeLink(['partners']) @endphp"><a href="{{route('cms.partners.index')}}"> Partners </a></li>
          @endif

          @if(permission('*.more-infos.*'))
            <li class="@php activeLink(['more-infos']) @endphp"><a href="{{ url('cms/more-infos') }}"> Homepage Informations</a></li>
          @endif

           {{-- @if(permission('*.operators.*'))
             <li class="@php activeLink(['operators']) @endphp"><a href="{{url('/cms/operators')}}"> Operators</a></li>
           @endif
           
           @if(permission('*.warehouses.*'))
             <li class="@php activeLink(['warehouses']) @endphp"><a href="{{url('/cms/warehouses')}}"> Warehouses</a></li>
           @endif
 
           @if(permission('*.colateral_managers.*'))
             <li class="@php activeLink(['colateral_managers']) @endphp"><a href="{{url('/cms/colateral_managers')}}"> Colateral Managers</a></li>
           @endif --}}
 
           {{-- @if(permission('*.trainings.*'))
             <li class="@php activeLink(['trainings']) @endphp"><a href="{{url('/cms/trainings')}}"> Trainings</a></li>
           @endif
 
           @if(permission('*.product_categories.*'))
             <li class="@php activeLink(['product_categories']) @endphp"><a href="{{route('cms.product_categories.index')}}"> Products Categories</a></li>
           @endif
 
           @if(permission('*.products.*'))
             <li class="@php activeLink(['products']) @endphp"><a href="{{route('cms.products.index')}}"> Products</a></li>
           @endif
                 
           @if(permission('*.achievements.*'))
             <li class="@php activeLink(['achievements']) @endphp"><a href="{{route('cms.achievements.index')}}"> Achievements</a></li>
           @endif
               
          
           @if(permission('*.online_services.*'))
             <li class="@php activeLink(['online_services']) @endphp"><a href="{{ url('cms/online_services') }}">Online Services</a>  </li>
           @endif
 
           @if(permission('*.hospitals.*'))
             <li class="@php activeLink(['hospitals']) @endphp"><a href="{{url('/cms/hospitals')}}"> Hospitals</a></li>
           @endif
    --}}
         </ul>
     </li>
     @endif 
   

    {{-- @if(permission('*.menu.*'))
      <li class="nav-item ega-menu-caption">
          <label>Site Links</label>
      </li>
    @endif --}}

   @if(permission(['*.organogram.*','*.administration.*','*.administration_categories.*','*.administration_categories_members.*']))
     <li data-username="organogram administration management members" class="nav-item ega-hasmenu @php activeLink(['organogram','administration','administration_categories','administration_categories_members']) @endphp">
         <a href="javascript:" class="nav-link ">
           <span class="ega-micon"><i class="feather icon-users"></i></span>
           <span class="ega-mtext"> Members </span>
         </a>
         <ul class="ega-submenu">
 
           {{-- @if(permission('*.organogram.*'))
           <li class="@php activeLink(['organogram']) @endphp"><a href="{{ url('cms/organogram') }}"> Organogram</a></li>
           @endif --}}
           
           @if(permission('*.administration.*'))
           <li class="@php activeLink(['administration']) @endphp"><a href="{{ url('cms/administration') }}">Members Info</a></li>
           @endif
 
           @if(permission('*.administration_categories.*'))
           <li class="@php activeLink(['administration_categories']) @endphp"><a href="{{ url('cms/administration_categories') }}"> Members Categories</a></li>
           @endif
 
         </ul>
     </li>
    @endif     
    

    @if(permission(['*.menu.*','*.menu-items.*','*.social_links.*','*.about_links.*','*.important_links.*','*.related_links.*','*.quick_links.*','*.support_links.*','*.media_links.*']))
    <li data-username="menu menu-items social_links  related_links quick_links support_links " class="nav-item ega-hasmenu
      @php activeLink(['menu','menu-items','social_links','quick_links','support_links','important_links',
      'about_links','related_links','home_links','media_links']) @endphp">
        <a href="javascript:" class="nav-link ">
          <span class="ega-micon"><i class="feather icon-link-2"></i></span>
          <span class="ega-mtext">Navigation</span>
        </a>
        <ul class="ega-submenu">
 
          @if(permission('*.menu.*'))
          <li data-username="menu menu-items" class="nav-item @php activeLink(['menu','menu-items']) @endphp">
            <a href="{{ url('cms/menu') }}" class="nav-link">
              <span class="ega-mtext">Menu</span>
            </a>
          </li>
          @endif

          {{-- @if(permission('*.about_links.*'))
            <li class="@php activeLink(['about_links']) @endphp"><a href="{{ url('cms/about_links') }}">About Links</a>  </li>
          @endif

          @if(permission('*.support_links.*'))
            <li class="@php activeLink(['support_links']) @endphp"><a href="{{ url('cms/support_links') }}">Consumer Services Links</a>  </li>
          @endif 
          
          @if(permission('*.related_links.*'))
            <li class="@php activeLink(['related_links']) @endphp"><a href="{{url('/cms/related_links')}}"> Public Relations Links</a></li>
          @endif --}}
        
          {{-- @if(permission('*.media_links.*'))
            <li class="@php activeLink(['media_links']) @endphp"><a href="{{url('/cms/media_links')}}"> Media Links</a></li>
          @endif --}}

          {{-- @if(permission('*.quick_links.*'))
            <li class="@php activeLink(['quick_links']) @endphp"><a href="{{ url('cms/quick_links') }}">Quick Links</a> </li>
          @endif 

          @if(permission('*.important_links.*'))
            <li class="@php activeLink(['important_links']) @endphp"><a href="{{ url('cms/important_links') }}">Important Links</a>  </li>
          @endif --}}

          @if(permission('*.social_links.*'))
            <li class="@php activeLink(['social_links']) @endphp"><a href="{{ url('cms/social_links') }}">Social Links</a>  </li>
          @endif
        </ul>
    </li>
    @endif

    
    @if(permission(['*.howdois.*','*.faqs.*','*.complaints.*']))
    <li data-username="howdois faqs complaints " class="nav-item ega-hasmenu @php activeLink(['howdois','faqs','complaints']) @endphp">
        <a href="javascript:" class="nav-link ">
          <span class="ega-micon"><i class="feather icon-inbox"></i></span>
          <span class="ega-mtext"> Visitors Info</span>
        </a>
        <ul class="ega-submenu">
 
          {{-- @if(permission('*.howdois.*'))
            <li class="@php activeLink(['howdois']) @endphp"><a href="{{ url('cms/howdois') }}">How Do I?</a>  </li>
          @endif  --}}

          {{-- @if(permission('*.complaints.*'))
          <li data-username="feedback complaints" class="nav-item @php activeLink(['feedback','feedbacks','complaints']) @endphp">
            <a href="{{ url('cms/feedbacks') }}" class="nav-link">
              <span class="ega-mtext">Feedback</span>
            </a>
          </li>
          @endif --}}
          
          @if(permission('*.faqs.*'))
            <li class="@php activeLink(['faqs']) @endphp"><a href="{{url('/cms/faqs')}}"> FAQs</a></li>
          @endif
          
        </ul>
    </li>
    @endif    

    
    @if(permission(['*.googlemaps.*','*.seo.*','*.users.*','*.roles.*','*.translations.*']))
      <li class="nav-item ega-menu-caption">
          <label>Settings</label>
      </li>
    @endif

    @if(permission('*.translations.*'))
      <li data-username="translation languages" class="nav-item @php activeLink(['translations']) @endphp">
          <a href="{{ url('cms/translations') }}" class="nav-link">
            <span class="ega-micon"><i class="feather icon-file-text"></i></span>
            <span class="ega-mtext">Translations</span>
          </a>
      </li>
    @endif

    @if(permission(['*.preferences.*','*.regional_office.*','*.googlemaps.*','*.seo.*']))
      <li data-username="preferences regional office google map seo contacts site settings" class="nav-item ega-hasmenu @php activeLink(['preferences','regional_office','seo','googlemaps']) @endphp">
        <a href="javascript:" class="nav-link ">
          <span class="ega-micon"><i class="feather icon-settings"></i></span><span class="ega-mtext">Site Settings</span></a>
        <ul class="ega-submenu">

          {{-- @if(permission('*.regional_office.*'))
            <li class="@php activeLink(['regional_office']) @endphp"><a href="{{ url('cms/regional_office')}}">Contacts Us Details</a></li>
          @endif --}}

          {{-- @if(permission('*.googlemaps.*'))
            <li class="@php activeLink(['googlemaps']) @endphp"><a href="{{ url('cms/googlemaps')}}">Google Map</a> </li>
          @endif --}}

          @if(permission('*.seo.*'))
            <li class="@php activeLink(['seo']) @endphp"><a href="{{ url('cms/seo')}}">SEO</a></li>
          @endif

          {{-- @if(permission('*.preferences.*'))
            <li class="@php activeLink(['preferences']) @endphp"><a href="{{ url('cms/preferences')}}">Preferences</a></li>
          @endif --}}

        </ul>
    </li>
    @endif

    @if(permission(['*.users.*','*.roles.*']))
      <li data-username="role users administration" class="nav-item ega-hasmenu @php activeLink(['user-registration-form','roles']) @endphp">
        <a href="javascript:" class="nav-link ">
          <span class="ega-micon"><i class="feather icon-users"></i></span><span class="ega-mtext">Users & Roles</span></a>
        <ul class="ega-submenu">
          @if(permission('*.users.*'))
            <li><a href="{{route('cms.users.create-user-form')}}">Users</a></li>
          @endif

          @if(permission('*.roles.*'))
            <li class="@php activeLink(['roles']) @endphp"><a href="{{url('cms/roles')}}">Roles</a></li>
          @endif

          @if(permission('*.logs.*'))
            <li><a href="{{url('cms/logs')}}">Logs</a></li>
          @endif

        </ul>
    </li>
    @endif


   

</ul>
