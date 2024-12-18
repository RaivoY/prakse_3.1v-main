<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col justify-center items-center min-h-screen bg-gray-100">
    <header class="w-full bg-gray-800 text-white text-center py-4">
        <h1 class="text-2xl">Admin Panel</h1>
    </header>
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h2 class="text-xl font-semibold mb-4">All Submissions</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('search') }}" class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="email" class="block text-gray-700">Search by email:</label>
                <input type="email" name="email" placeholder="Email" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="topic" class="block text-gray-700">Filter by topic:</label>
                <select name="topic" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select Topic</option>
                    <option value="tech">Tech</option>
                    <option value="sales">Sales</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="priority" class="block text-gray-700">Filter by priority:</label>
                <select name="priority" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select Priority</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="sort" class="block text-gray-700">Sort by date:</label>
                <select name="sort" class="w-full p-2 border border-gray-300 rounded">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class="w-full px-2">
                <button type="submit" class="w-full bg-gray-800 text-white p-2 rounded hover:bg-gray-700">Search</button>
            </div>
        </form>

        <a href="{{ route('export.form_submissions') }}" class="block w-full bg-blue-600 text-white text-center py-2 rounded mb-6 hover:bg-blue-500">Export Submissions to CSV</a>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Comment</th>
                    <th class="border p-2">Topics</th>
                    <th class="border p-2">Priority</th>
                    <th class="border p-2">Date</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submissions as $submission)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-2">{{ $submission->email }}</td>
                        <td class="border p-2">{{ $submission->comments }}</td>
                        <td class="border p-2">{{ $submission->topic }}</td>
                        <td class="border p-2">{{ $submission->priority }}</td>
                        <td class="border p-2">{{ $submission->created_at }}</td>
                        <td class="border p-2">
                            <select class="status-dropdown" data-id="{{ $submission->id }}">s
                                <option value="new" {{ $submission->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="process" {{ $submission->status == 'process' ? 'selected' : '' }}>Processing</option>
                                <option value="sorted" {{ $submission->status == 'sorted' ? 'selected' : '' }}>Sorted</option>
                                <option value="closed" {{ $submission->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $submissions->links() }}
        </div>
    </div>
    <footer class="w-full bg-gray-800 text-white text-center py-4 mt-6">
        <p>© 2024 Admin Panel</p>
    </footer>

    <script>
        document.querySelectorAll('.status-dropdown').forEach(dropdown => {
            dropdown.addEventListener('change', function() {
                let status = this.value;
                let id = this.getAttribute('data-id');
    
                fetch('{{ route('update.status') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully.');
                    }
                });
            });
        });
    </script>
    
</body>
</html>
