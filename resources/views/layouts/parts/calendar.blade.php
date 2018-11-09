@if(count($calendars) > 0)
<div class="sidebar_title_container">
    <div class="sidebar_title">Calendar</div>
    <div class="sidebar_slider_nav">
        <div class="custom_nav_container sidebar_slider_nav_container">
            <div class="custom_prev custom_prev_events">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                    <polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
                </svg>
            </div>
            <ul class="custom_dots custom_dots_events">
                @foreach($calendars->chunk(5) as $events)
                <li class="custom_dot custom_dot_events @if($loop->first) active @endif"><span></span></li>
                @endforeach
            </ul>
            <div class="custom_next custom_next_events">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                    <polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
                </svg>
            </div>
        </div>
    </div>
</div>
<div class="sidebar_section_content">
    <div class="sidebar_slider_container">
        <div class="owl-carousel owl-theme sidebar_slider_events">
            @foreach($calendars->chunk(5) as $events)
            <div class="owl-item">
                @foreach($events as $event)
                <div class="side_post">
                    <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                        <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">{{ date('d', strtotime($event->date)) }}</div>
                            <div class="event_month">{{ date('M', strtotime($event->date)) }}</div>
                        </div>
                        <div class="side_post_content">
                            <div class="side_post_title future-text mt-2">{{ $event->title }}</div>
                            <div class="side_post_title future-text">{{ date('H:i', strtotime($event->start_hour)) }} - {{ date('H:i', strtotime($event->end_hour)) }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
