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
                    <button type="button" class="btn btn-primary btn-lg" id="new-entry-btn">New User/Admin</button>
                </div>
            </div>
        </div>

        <form action="/adminHome" method="post" class="form-group" id="new-entry-form" style="display:none;">
            @csrf
            <div class="form-group">
                <label for="date">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="userType">User Type:</label>
                <select name="userType" id="userType" class="form-control">
                    <option value="ADM">Admin</option>
                    <option value="USR">User</option>
                </select>
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr data-date="{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->userType }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <form action="{{ route('editUser') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <label for="date">Name:</label>
                                        <input type="text" name="name" value="{{ $user->name }}" required>
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" value="{{ $user->email }}" required>
                                        <div class="form-group">
                                        <label for="userType">User Type:</label>
                                        <select name="userType" id="userType" class="form-control">
                                            <option value="{{ $user->userType }}"> {{ $user->userType }}</option>
                                            <option value="ADM">Admin</option>
                                            <option value="USR">User</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                <form action="{{ route('removeUser') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
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
