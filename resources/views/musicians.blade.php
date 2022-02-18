<h1>Musicians</h1>
<ul>
    @foreach ($musicians as $musician)
        <li>Name: {{ $musician->first_name }} {{ $musician->last_name }} <br /> Instrument:
            {{ $musician->instrument }}<br />
            Website: {{ $musician->website }}
        </li>
        <br />
    @endforeach
</ul>
