@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-warning">
            make sure if u left this site for 30 u will be logout
        </div>
        <div class="card">
            <div class="card-header">
                generate orders
                <a href="{{ route('generate-orders') }}" class="float-right btn btn-success"> <i class="fa fa-plus fa-fw"></i> </a>
            </div>
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($tableTbody)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>status</th>
                                    @foreach ($tableThead as $row)
                                        <th>{{ $row }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <td rowspan="6" style="vertical-align: middle;">orders</td>
                                @foreach ($tableTbody as $status => $counts)
                                    <tr>
                                        <td>{{ $status }}</td>
                                        @foreach ($counts as $item)
                                            <td>{{ $item }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info"> there is no orders generated</div>
                @endif
                {{-- <pre> {!! print_r($tableTbody) !!} </pre> --}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var inactivityTime = function () {
            var time;
            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeydown = resetTimer;

            function logout() {
                document.getElementById('logout-form').submit();
                alert("You are now logged out.")
            }

            function resetTimer() {
                clearTimeout(time);
                time = setTimeout(logout, miliseconds(0 , 30, 0))
            }
        };
        window.onload = function() {
            inactivityTime();
        }

        function miliseconds(hrs,min,sec) {
            return((hrs* 60 * 60 +min * 60 + sec) *1000);
        }
    </script>
@endsection
