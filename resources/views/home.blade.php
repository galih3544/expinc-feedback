    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body {
                background-color: #0079FB;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            }
            #container{
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                position: absolute;
                width: 90vw;
                height: 90vh;
                border-radius: 10px;
                background-color: white;
                overflow: hidden;
            }

            #navbar{
                padding: 20px;  
                padding-left: 30px;
                padding-right: 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            #box_timer {
                display: inline-block;
                background-color: #CCE5FF;
                border-radius: 10px;
                color: #3166A2;
            }

            #timer_style {
                font-size: 24px;
                font-weight: bold;
                color: white;
                padding: 2px;
                border-radius: 10px;
                background-color: #333;
                margin-left: 5px;
            }

            h1 {
                margin-bottom: 10px;
            }

            input[type="radio"] {
                margin-bottom: 5px;
            }

            label {
                display: block;
                padding: 8px;
                background-color: #F0F8FF;
                border: 1px solid #0079FB;
                cursor: pointer;
                border-radius: 10px;
            }

            input[type="radio"]:checked+label {
                background-color: #0079FB;
                color: #fff;
            }

            input[type="radio"] {
                margin-bottom: 5px;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            input[type="radio"]:checked+label {
                background-color: #0079FB;
                color: #fff;
            }

            #container_soal {
                margin: 30px;
            }

            #container_footer {
                margin-top: 20px;
                height: 50%;
                padding: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: space-around;
                align-content: center;
            }

            #nextQuestionBtn {
                height: fit-content;
                background-color: #007BFF;
                padding: 20px;
                border: none;
            }

            #text {
                font: bold;
                size: 10px;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <div id="navbar">
                <h1>Quiz Application</h1>
                <div id="box_timer">
                    <h3>Time left <span id="timer_style">00</span></h3>
                </div>
            </div>

            <div id="container_soal">
                <h1>{{ $data->question_text }}</h1>
                
                <input type="radio" name="jawaban" value="{{ $data->answer1 }}" id="option1">
                <label for="option1">{{ $data->answer1 }}</label>
            
                <input type="radio" name="jawaban" value="{{ $data->answer2 }}" id="option2">
                <label for="option2">{{ $data->answer2 }}</label>
            
                <input type="radio" name="jawaban" value="{{ $data->answer3 }}" id="option3">
                <label for="option3">{{ $data->answer3 }}</label>
            
                <input type="radio" name="jawaban" value="{{ $data->answer4 }}" id="option4">
                <label for="option4">{{ $data->answer4 }}</label>
            </div>

            <div id="container_footer">
                <h3>1 of 5 question</h3>
                <button id="nextQuestionBtn" style="background-color: #0079FB; border: none; color: white; font-weight: bold; border-radius: 0; transition: background-color 0.3s;">
                    <span id="text">Next Question</span>
                </button>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
$(document).ready(function() {
    var timerSeconds = 20;
    var timerInterval;

    function startTimer() {
        timerInterval = setInterval(function() {
            $('#timer_style').text(timerSeconds);
            
            if (timerSeconds === 0) {
                clearInterval(timerInterval); 
                alert("Waktu Habis");
                location.reload();
            }

            timerSeconds--;
        }, 1000);
    }

    startTimer();

    $('#nextQuestionBtn').on('click', function() {
        clearInterval(timerInterval);

        timerSeconds = 20;

        $(this).prop('disabled', true);

        startTimer();
    });

    $('input[name=jawaban]').on('change', function() {
        clearInterval(timerInterval);
        
            $('#nextQuestionBtn').prop('disabled', false);
        });
    });

    $('#nextQuestionBtn').on('click', function() {
        var selectedAnswer = $('input[name=jawaban]:checked').val();

        $.ajax({
            type: 'POST',
            url: '/kirim_jawaban/' + {{ $data->id }},
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                jawaban: selectedAnswer
            },
            success: function(response) {
                $('label').css('border', '1px solid #0079FB');

                if (response.status === 'benar') {
                    $('label[for="option' + response.id + '"]').css('border', '2px solid green');
                    location.reload();
                } else {
                    $('label[for="option' + response.id + '"]').css('border', '2px solid red');
                    location.reload();
                }

                console.log(response);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });


    </script>
    </html>