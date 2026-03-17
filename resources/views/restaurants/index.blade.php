<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold mb-8">Admin Dashboard - Restaurants</h1>
        
        <div class="bg-white shadow rounded-lg p-6">
            <table class="min-w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-3">Name</th>
                        <th class="py-3">Address</th>
                        <th class="py-3">Phone</th>
                        <th class="py-3">Opening Hours</th>
                        <th class="py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($restaurants as $restaurant)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4">{{ $restaurant->name }}</td>
                        <td class="py-4">{{ $restaurant->address }}</td>
                        <td class="py-4">{{ $restaurant->phone }}</td>
                        <td class="py-4">{{ $restaurant->opening_hours }}</td>
                        <td class="py-4">
                            <a href="/admin/restaurants/{{ $restaurant->id }}" class="text-blue-500 hover:underline">View Menu</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
