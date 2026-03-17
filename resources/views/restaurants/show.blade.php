<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }} - Menu Items</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-4">
            <a href="/admin" class="text-blue-500 hover:underline">&larr; Back to Restaurants</a>
        </div>
        <h1 class="text-4xl font-bold mb-2">{{ $restaurant->name }}</h1>
        <p class="text-gray-600 mb-8">{{ $restaurant->address }} | {{ $restaurant->phone }} | {{ $restaurant->opening_hours }}</p>
        
        <h2 class="text-2xl font-semibold mb-4">Menu Items</h2>
        <div class="bg-white shadow rounded-lg p-6">
            <table class="min-w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-3">Name</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Description</th>
                        <th class="py-3">Price</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($restaurant->menuItems as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4">{{ $item->name }}</td>
                        <td class="py-4 capitalize">{{ $item->category }}</td>
                        <td class="py-4 text-gray-500">{{ $item->description }}</td>
                        <td class="py-4">${{ number_format($item->price, 2) }}</td>
                        <td class="py-4 text-sm">
                            @if($item->is_available)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Available</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Sold Out</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
