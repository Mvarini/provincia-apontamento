<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>EPI</title>
    @vite('resources/scss/app.scss')

    <style>
        /* Margens padrão para todas as páginas */
        @page {
            margin-top: 50px;   /* margem superior */
            margin-right: 30px;
            margin-bottom: 50px;
            margin-left: 30px;
        }

        /* Sobrescreve apenas a primeira página */
        @page :first {
            margin-top: 0; /* sem margem superior na primeira página */
        }
    </style>

</head>
<body class="body-report">
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h1>Logster - Movimentação de EPI CNC</h1>
        </div>
    </div>

    <div class="row">
        @foreach($ppeMovements as $ppeMovement)
            <div class="col-md-12">
                <div class="card no-break mb-3">
                    <div class="card-body">
                        <p class="fw-bold mb-0">{{ $ppeMovement->employee->name }}</p>
                        <div class="row text-card-data">
                            <div class="d-flex align-items-baseline">
                                <span class="fw-bold label-col-identificacao">Data:</span>
                                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $ppeMovement->date)->format('d/m/Y') }}</span>
                            </div>

                            <div class="d-flex align-items-baseline">
                                <span class="fw-bold label-col-identificacao">EPI:</span>
                                <span>{{ $ppeMovement->ppe->name }}</span>
                            </div>

                            @if($ppeMovement->size)
                                <div class="d-flex align-items-baseline">
                                    <span class="fw-bold label-col-identificacao">Tamanho:</span>
                                    <span>{{ $ppeMovement->size }}</span>
                                </div>
                            @endif

                            <div class="d-flex align-items-baseline">
                                <span class="fw-bold label-col-identificacao">Qtde:</span>
                                <span>{{ $ppeMovement->quantity }}</span>
                            </div>
                            {{--                            @if(!$loop->last)--}}
                            {{--                                <hr/>--}}
                            {{--                            @endif--}}
                        </div>
                        {{--                        @endforeach--}}
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Quebra de página --}}
        {{--        <div class="task-page-container-before"></div>--}}
        {{--        <div class="margin-top-break">--}}

        <div class="col-md-12">
            <div class="card no-break">
                <div class="card-body">
                    <p class="fw-bold">Reduzida - Total por EPI tamanho e quantidade</p>
                    <div class="row text-card-data">
                        @foreach($totais as $chave => $qtd)
                            <div class="col-md-4">
                                <p class="mb-0"><strong></strong> {{ $chave }}</p>
                                <p class="mb-3"><strong>Qtde:</strong> {{ $qtd }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
