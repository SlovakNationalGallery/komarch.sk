<div>
    <table>
        @foreach ($days as $day => $times)
        <tr>
            <td class="w-32 xl:w-24">{{ $day }}</td>
            <td>{!! $times !!}</td>
        <tr>
        @endforeach
    </table>
    <span class="block mt-5">(Práve teraz máme {{ ($is_open) ? 'otvorené' : 'zatvorené' }})</span>
</div>