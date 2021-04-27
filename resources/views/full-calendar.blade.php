@extends('layout.app')
@section('page_css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link rel="stylesheet" href="public/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="public/assets/css/cal_style.css" />
    <link rel="stylesheet" href="public/assets/css/yearview.css" />
    {{-- for year picker --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    

    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css">
    <script type='text/javascript' src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css">



    <style>
        #footer {
            position: relative;
        }
        .btn-group{
            margin: auto;
            display: flex;
            flex-direction: row;
            justify-content: center;
            padding-bottom: 15px;
        }
    </style>
    
@endsection
@section('content')
<div class="container">
    <div id="BtnGroup" class="btn-group">
        @foreach ($data['zodiac_list'] as $key => $value)
            @if($key == $data['lucky_zodiac'])
                <button type="button" id="button".{{ $key }} value="{{ $key }}" class="btn btn-default" title="Lucky zodiac of the year" style="color: green">&#x2605; {{ $value }} &#x2605;</button> 
            @else 
            <button type="button" id="button".{{ $key }} value="{{ $key }}" class="btn btn-default">{{ $value }}</button>   
            @endif
        @endforeach
    </div>
    <div id="best_month"></div>
    <div id="calendar"></div>
</div>
@endsection

@section('page_js')
<!-- page script -->
<script src="public/assets/js/fullcalendar.js"></script>
<script>
$(document).ready(function() {
    var year = {{$data['year']}}+'-'+'01'+'-'+'01';    
    var calendar = $('#calendar').fullCalendar({
    // put your options and callbacks here
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'year,month,basicWeek,basicDay'

    },
    timezone: 'local',
    height: "auto",
    selectable: true,
    dragabble: true,
    defaultView: 'year',
    yearColumns: 3,
    defaultDate: year, 

    durationEditable: true,
    bootstrap: false,

    })

    window.onload = function () {
        $('#BtnGroup button').on('click', function() {
            var this_year_horoscope = <?php echo json_encode($data['decoded']); ?>;
            var best_month_list = <?php echo json_encode($data['best_month']); ?>;
            var year = {{$data['year']}}+'-'+'01'+'-'+'01';   
            var zodiac_selected = $(this).attr('value');

            for (i = 0; i <= 12; i++) {
                if(i == zodiac_selected){
                    var details_in_array = this_year_horoscope[i]; 
                    var current_best_month = best_month_list[i];
             
                }
            } 
            const horos_dates = Object.keys(details_in_array);
            const horos_scores = Object.values(details_in_array);

            
            $('#calendar').fullCalendar('destroy'); 
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'year,month,basicWeek,basicDay',


                },
                
                timezone: 'local',
                height: "auto",
                selectable: true,
                dragabble: true,
                defaultView: 'year',
                yearColumns: 3,
                defaultDate: year, 
                durationEditable: true,
                bootstrap: false,     
                    

                

                dayRender: function (date, cell) {
                    
                //end of indicating best month
                var strDay = moment(date._d).format('YYYY-MM-DD');
                for(i=0 ; i<= horos_dates.length; i++){                    
                    if(strDay == horos_dates[i]){
                        //console.log(horos_scores[i].score);
                        switch (horos_scores[i].score) {
                        case 1:
                            cell.css("background", "#FF0000");
                            break;
                        case 2:
                            cell.css("background", "#FF6600");
                            break;
                        case 3:
                            cell.css("background", "#FF9900");
                            break;
                        case 4:
                            cell.css("background", "#FFCC00");
                            break;
                        case 5:
                            cell.css("background", "#FFFF00");
                            break;
                        case 6:
                            cell.css("background", "#CCFF00");
                            break;
                        case 7:
                            cell.css("background", "#99FF00");
                            break;
                        case 8:
                            cell.css("background", "#66FF00");
                            break;
                        case 9:
                            cell.css("background", "#33FF00");
                            break;
                        case 10:
                            cell.css("background", "#00FF00");
                            break;
                        }
                        
                    }
                }

                },
                eventAfterAllRender: function(view) {
                    var month_list = <?php echo json_encode($data['month']); ?>;
                    //console.log(current_best_month);
                    if ($('.label').length == 0) {
                        //$('.fc-center').after(content: " (" attr(month_list) ")";
                       
                        $('.fc-center').after('<div class="label success" style="font-color: red;">Your Best month:'+  month_list[current_best_month] + '</div>');
                    }
                },

            })  
        
        });
        

    }
});


</script>\
@endsection

