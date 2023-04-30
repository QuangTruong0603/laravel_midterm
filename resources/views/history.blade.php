<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>History</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/history">Sleep History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/statistics">Sleep Statistics</a>
        </li>
      </ul>
      @if($user)
      <span class="navbar-text ml-auto">
        <h6 class="my-0">Welcome, {{ $user->full_name }}</h6>
      </span>
@else
      <span class="navbar-text ml-auto">
        <a class="btn btn-outline-primary" href="/login">Log in</a>
        <a class="btn btn-primary ml-2" href="/signup">Sign up</a>
      </span>
@endif
    </div>
  </nav>
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
        <td>{{dateFormat($sleep->sleep_date)}}</td>
        <td>{{timeFormat($sleep->sleep_time)}}</td>
        <td>{{timeFormat($sleep->wake_time)}}</td>
      </tr>
      @endforeach
  </tbody>
</table>
