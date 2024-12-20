<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Test Queue</title>
</head>
<body>
  @if(session('success'))
      <script>
          alert('{{ session('success') }}');
      </script>
  @endif

  @if(session('error'))
      <script>
          alert('{{ session('error') }}');
      </script>
  @endif
  <form action="{{ route('test_queue.post') }}" method="post">
    @csrf
    <p>Test Queue Menggunakan Laravel Horizon</p>
    <input type="email" name="email" id="email" placeholder="Masukan Email">
    <button type="submit">Send</button>
  </form>
</body>
</html>
