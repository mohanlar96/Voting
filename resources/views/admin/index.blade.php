@extends('Master.template')

@section('body')
    <div class="container admin" id = "header">
        <div class="row text-center">
            @foreach($results as $type => $contestants)
                <h1>{{ucwords($type)}} Final Results</h1>
                <table class="table table-responsive table-bordered">
                    <tr class = "thead">
                        <th>Waist Number</th>
                        <th>Name</th>
                        <th>Vote Count</th>
                        <th>Rank</th>
                    </tr>

                    <?php $i = 0;?>
                    @foreach($contestants as $contestant)
                        <tr>
                            <td>{{$contestant['waist_number']}}</td>
                            <td>{{$contestant['name']}}</td>
                            <td>{{$contestant['vote_count']}}</td>
                            @if($i === 0)
                                <td>First</td>
                            @elseif($i === 1)
                                <td>Second</td>
                            @elseif($i === 2)
                                <td>Third</td>
                            @else
                                <td>-</td>
                            @endif
                    </tr>
                        <?php ++$i; ?>
                    @endforeach
                </table>
                <hr style = "border: 2px dotted white;">
            @endforeach
        </div>
    </div>


@endsection