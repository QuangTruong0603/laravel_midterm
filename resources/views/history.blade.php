<head>
    <title>History</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2>Sleep Records History</h2>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Sleep Time</th>
                    <th>Wake Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $sleep)
                    <tr data-date="{{ dateFormat($sleep->sleep_date) }}">
                        <td>{{ dateFormat($sleep->sleep_date) }}</td>
                        <td>{{ timeFormat($sleep->sleep_time) }}</td>
                        <td>{{ timeFormat($sleep->wake_time) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
