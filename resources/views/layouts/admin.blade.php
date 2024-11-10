<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <!-- Sidebar -->
  <div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/4 bg-gray-800 text-white h-screen">
      <div class="p-4">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
      </div>
      <nav class="mt-4">
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Dashboard</a>
        <a href="{{ route('patients.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Patients</a>
        <a href="{{ route('providers.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Providers</a>
        <a href="{{ route('services.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Services</a>
        <a href="{{ route('schedules.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Schedules</a>
        <a href="{{ route('appointments.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Appointments</a>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Settings</a>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">Logout</a>
      </nav>
    </div>

    <div>
      @yield('content')
    </div>
  </div>

  <!-- Toastr Notifications -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  @if(Session::has('success'))
  <script>
    toastr.success("{{ Session::get('success') }}")
  </script>
  @endif
  @if(Session::has('info'))
  <script>
    toastr.info("{{ Session::get('info') }}")
  </script>
  @endif
  @if(Session::has('error'))
  <script>
    toastr.error("{{ Session::get('error') }}")
  </script>
  @endif
</body>

</html>