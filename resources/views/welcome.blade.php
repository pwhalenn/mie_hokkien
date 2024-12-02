<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MieHokkien</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-yellow-500 text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold">Welcome to MieHokkien</h1>
            <p class="text-lg mt-2">Delicious noodles, delightful articles.</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Articles Section -->
            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold mb-4">Latest Articles</h2>
                @forelse($articles as $articles)
                    <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                        <h3 class="text-xl font-semibold">{{ $article->title }}</h3>
                        <p class="text-gray-700 text-sm mt-2">{{ Str::limit($article->content, 100, '...') }}</p>
                        <a href="{{ route('article.show', $article->id) }}" class="text-yellow-500 mt-2 inline-block">Read More</a>
                    </div>
                @empty
                    <p>No articles found.</p>
                @endforelse

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $articles->links() }}
                </div>
            </div>

            <!-- Sidebar Section -->
            <aside>
                <h2 class="text-2xl font-bold mb-4">About Us</h2>
                <p class="bg-white shadow-md rounded-lg p-4">
                    MieHokkien brings you the best noodle dishes and exciting reads. Discover more about our food, culture, and recipes!
                </p>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} MieHokkien. All rights reserved.</p>
    </footer>
</body>
</html>