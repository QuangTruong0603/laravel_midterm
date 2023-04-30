<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <button type="button" class="btn btn-primary btn-lg" id="new-entry-btn">+ New Entry</button>
                </div>
            </div>
        </div>

        <form action="/home" method="post" class="form-group" id="new-entry-form" style="display:none;">
            @csrf
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" required>
            </div>
            <div class="form-group">
                <label for="sleep_time">Sleep Time:</label>
                <input type="time" class="form-control" name="sleep_time" required>
            </div>
            <div class="form-group">
                <label for="wake_time">Wake Time:</label>
                <input type="time" class="form-control" name="wake_time" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Sleep Record</button>
        </form>
        <script>
            $(document).ready(function() {
                $("#new-entry-btn").click(function() {
                    $("#new-entry-form").toggle();
                });
            });
        </script>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Sleep Time</th>
                    <th>Wake Time</th>
                    <th>Total Sleep Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $sleep)
                    <tr data-date="{{ dateFormat($sleep->sleep_date) }}">
                        <td>{{ dateFormat($sleep->sleep_date) }}</td>
                        <td>{{ timeFormat($sleep->sleep_time) }}</td>
                        <td>{{ timeFormat($sleep->wake_time) }}</td>
                        <td>{{ totalSleepTime($sleep->sleep_time, $sleep->wake_time) }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <form action="{{ route('editSleep') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $sleep->id }}">
                                    <label for="date">Date:</label>
                                    <input type="date" name="date" value="{{ dateFormat($sleep->sleep_date) }}"
                                        required>
                                    <label for="sleep_time">Sleep Time:</label>
                                    <input type="time" name="sleep_time" value="{{ timeFormat($sleep->sleep_time) }}"
                                        required>
                                    <label for="wake_time">Wake Time:</label>
                                    <input type="time" name="wake_time" value="{{ timeFormat($sleep->wake_time) }}"
                                        required>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <form action="{{ route('removeSleep') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $sleep->id }}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
