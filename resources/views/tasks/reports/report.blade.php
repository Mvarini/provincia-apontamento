<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Apontamento</title>
    @vite('resources/scss/app.scss')
</head>
<body class="body-report">
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1>Relatório de Apontamento - CNC</h1>
        </div>
    </div>

    <div class="row">
        @foreach($tasks as $task)
            <div class="task-page-container @if(!$loop->first) margin-top-break @endif">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="fw-bold">Identificação</p>
                            <div class="row text-card-data">

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-identificacao">Data:</span>
                                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $task->date)->format('d/m/Y') }}</span>
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-identificacao">Lote:</span>
                                    <span>{{ $task->batch_number }}</span>
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-identificacao">Máquina:</span>
                                    <span>{{ $task->machine->name }}</span>
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-identificacao">Produto:</span>
                                    <span>{{ $task->product->name }}</span>
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span
                                        class="fw-bold label-col-identificacao">Operador:</span>
                                    <span>{{ $task->employee->name }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="fw-bold">Dados</p>
                            <div class="row text-card-data">

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">Tempo de produção:</span>
                                    @if($task->production_minute)
                                        <span>{{ $task->production_minute }} minutos</span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">Tempo por peça:</span>
                                    @if($task->piece_second)
                                        <span>{{ $task->piece_second }} segundos</span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">Quantidade realizada:</span>
                                    @if($task->amount_carried)
                                        <span>{{ $task->amount_carried }} peças</span>
                                    @else
                                        <span> N/A </span>
                                    @endif

                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">Quantidade Prevista:</span>
                                    @if($task->expected_quantity)
                                        <span>{{ $task->expected_quantity}}
                                            @if( $task->expected_quantity == 1)
                                                peça
                                            @else
                                                peças
                                            @endif
                                    </span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">% produtividade:</span>
                                    @if($task->productivity)
                                        <span>{{ $task->productivity}}%</span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">Peças para descarte:</span>
                                    @if($task->discard_quantity)
                                        <span>{{ $task->discard_quantity }}
                                            @if( $task->discard_quantity > 1)
                                                peças
                                            @elseif($task->discard_quantity == 1)
                                                peça
                                            @else
                                            @endif
                                    </span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">Finalizar o lote:</span>
                                    @if($task->missing_quantity)
                                        <span>{{ $task->missing_quantity }}
                                            @if( $task->missing_quantity == 1)
                                                peça
                                            @else
                                                peças
                                            @endif
                                    </span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>


                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-dados">Tempo de roteiro:</span>
                                    @if($task->script_time)
                                        <span>{{ $task->script_time }} segundos</span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="fw-bold">Ocorrências de paradas</p>
                            <div class="row text-card-data">
                                @if(!$task->taskBreakdowns->isEmpty())
                                    @foreach($task->taskBreakdowns as $taskBreakdown)
                                        <div class="d-flex align-items-baseline">
                                            <span
                                                class="label-col-paradas">{{ $taskBreakdown->machineBreakdown->name }}</span>
                                            <span>{{ $taskBreakdown->duration }} minutos</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-card-data">
                                        Não houve ocorrências.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
