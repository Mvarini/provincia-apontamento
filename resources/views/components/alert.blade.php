{{--@if(session('success'))--}}
{{--    <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--        {{ session('success') }}--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
{{--@endif--}}

{{--@if(session('error'))--}}
{{--    <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--        {{ session('error') }}--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
{{--@endif--}}

{{--Erro do request - formulário--}}
{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                {{ $error }}<br>--}}
{{--            @endforeach--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
{{--@endif--}}

{{---------------------------------------------}}

{{--Utilizando o SweetAlert 2--}}
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Pronto',
                html: '{{ session('success') }}',
                icon: 'success'
            });
        })
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Erro',
                html: '{{ session('error') }}',
                icon: 'error'
            });
        })
    </script>
@endif

@if ($errors->any())
    @php
        $message = '';
        foreach ($errors->all() as $error){
            $message .= $error . '<br>';
        }
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: "Atenção!",
                    html: '{!! $message !!}',
                    icon: "warning"
                });
            }
        )
    </script>
@endif
