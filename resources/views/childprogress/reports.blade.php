@extends('master')
@section('content')
<div class="animated fadeIn">
    <div class="card-columns cols-2">
        <div class="card">
            <div class="card-header">
                Question and Answer
                {{-- <div class="card-actions"></div> --}}
            </div>
            <div class="card-block">
                <div class="chart-wrapper">
                    <canvas id="canvas-qna"></canvas>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Pronunciation
                {{-- <div class="card-actions"></div> --}}
            </div>
            <div class="card-block">
                <div class="chart-wrapper">
                    <canvas id="canvas-pro"></canvas>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Writing
                <div class="card-actions"></div>
            </div>
            <div class="card-block">
                <div class="chart-wrapper">
                    <canvas id="canvas-wri"></canvas>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Coloring
                <div class="card-actions"></div>
            </div>
            <div class="card-block">
                <div class="chart-wrapper">
                    <canvas id="canvas-color"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('categories_js')
    <script type="text/javascript">
        
        $(document).ready(function(e) {

            $(function() {

                var child_id = '<?= $child_id; ?>';
                var url = '<?= url() . "/api/childprogress/{childId}/child" ?>'.replace('{childId}', child_id);

                /** Charts */   
                var options = {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }

                var type = 'bar';
                var labels = ["Correct", "Incorrect"];
                var colors = [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ];
                
                var qna = [];
                var pronunciation = [];
                var writing = [];
                var coloring = [];
                $.ajax({
                  url: url,
                  method: "GET",
                  dataType: "json",
                  success: function (res) {
                    $.each(res.data, function(k,v) {
                        if (k == 'qna') {
                            qna.push(v.correct);
                            qna.push(v.incorrect)

                        } else if (k == 'coloring') {
                            coloring.push(v.correct);
                            coloring.push(v.incorrect);
                        } else if (k == 'writing') {
                            writing.push(v.correct);
                            writing.push(v.incorrect);
                        } else if (k == 'pronunciation') {
                            pronunciation.push(v.correct);
                            pronunciation.push(v.incorrect);
                        }

                        /** Questions and Answers */
                        var ctx_qna = document.getElementById("canvas-qna");
                        var chqna = new Chart(ctx_qna, {
                            type: type,
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: '# of Correct/Incorrect Answers',
                                    data: qna,
                                    backgroundColor: colors,
                                    borderColor: colors,
                                    borderWidth: 1
                                }]
                            },
                            options: options
                        });

                        /** Pronunciation */
                        var ctx_pro = document.getElementById("canvas-pro");
                        var chpro = new Chart(ctx_pro, {
                            type: type,
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: '# of Correct/Incorrect Answers',
                                    data: pronunciation,
                                    backgroundColor: colors,
                                    borderColor: colors,
                                    borderWidth: 1
                                }]
                            },
                            options: options
                        });

                        /** Writing */
                        var ctx_wri = document.getElementById("canvas-wri");
                        var chwri = new Chart(ctx_wri, {
                            type: type,
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: '# of Correct/Incorrect Answers',
                                    data: writing,
                                    backgroundColor: colors,
                                    borderColor: colors,
                                    borderWidth: 1
                                }]
                            },
                            options: options
                        });

                        /** Color */
                        var ctx_color = document.getElementById("canvas-color");
                        var chwri = new Chart(ctx_color, {
                            type: type,
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: '# of Correct/Incorrect Answers',
                                    data: coloring,
                                    backgroundColor: colors,
                                    borderColor: colors,
                                    borderWidth: 1
                                }]
                            },  
                            options: options
                        });

                    })


                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus)
                  }
                });

            });
        });
    </script>

@endsection

